<?php

namespace App\Livewire\Quiz;

use Livewire\Component;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizAnswer;
use App\Models\QuizOption;
use App\Models\QuizQuestion;
use Illuminate\Support\Facades\DB;

class Play extends Component
{
    public $quiz;
    public $answers = [];
    public $currentQuestion = 0;
    public $hasAttempt = false;
    public $showConfirm = false;
    public int $attemptCount = 0;
    public int $maxAttempt = 1;
    public $totalScore = 0;
    public $showSubmitModal = false;

    // Load quiz dan inisialisasi jawaban
    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz->load('questions.options');

        $this->attemptCount = QuizAttempt::where('quiz_id', $quiz->id)
            ->where('user_id', auth()->id())
            ->count();

        $this->hasAttempt = $this->attemptCount > 0;

        // 🔥 ambil TOTAL score semua percobaan
        if ($this->hasAttempt) {

            $this->totalScore = QuizAttempt::where('quiz_id', $quiz->id)
                ->where('user_id', auth()->id())
                ->sum('score'); // 🔥 ini yang penting

            $this->showConfirm = true;
        }

        foreach ($this->quiz->questions as $q) {
            $this->answers[$q->id] = $q->is_multiple ? [] : null;
        }
    }
    
    // NEXT
    public function next()
    {
        if ($this->currentQuestion < count($this->quiz->questions) - 1) {
            $this->currentQuestion++;
        }
    }

    // PREV
    public function prev()
    {
        if ($this->currentQuestion > 0) {
            $this->currentQuestion--;
        }
    }

    // SUBMIT
    public function submit()
    {
        $userId = auth()->id();

        // ❌ kalau sudah mencapai batas
        if ($this->attemptCount >= $this->maxAttempt) {
            session()->flash('error', 'Batas maksimal percobaan sudah tercapai.');
            return;
        }

        DB::transaction(function () use ($userId, &$score, &$correctCount, &$totalQuestions) {

            // ✅ buat attempt baru
            $attempt = QuizAttempt::create([
                'user_id' => $userId,
                'quiz_id' => $this->quiz->id,
                'score' => 0
            ]);

            $correctCount = 0;
            $totalQuestions = count($this->quiz->questions);

            foreach ($this->quiz->questions as $question) {

                $answer = $this->answers[$question->id] ?? null;

                // ✅ ambil jawaban benar
                $correctOptions = $question->options
                    ->where('is_correct', true)
                    ->pluck('id')
                    ->toArray();

                // 🔥 FIX: handle jawaban user
                if (is_array($answer)) {
                    $selectedOptions = $answer; // langsung ambil
                } else {
                    $selectedOptions = !is_null($answer) ? [$answer] : [];
                }

                // 🔥 bersihkan null
                $selectedOptions = array_filter($selectedOptions);

                // 🔥 safety extra (hindari null)
                $selectedOptions = array_filter($selectedOptions);

                sort($correctOptions);
                sort($selectedOptions);

                $isCorrect = $correctOptions == $selectedOptions;

                // ✅ simpan hanya jika ada jawaban
                if (!empty($selectedOptions)) {
                    foreach ($selectedOptions as $optionId) {

                        if (is_null($optionId)) continue; // double safety

                        QuizAnswer::create([
                            'attempt_id' => $attempt->id,
                            'question_id' => $question->id,
                            'option_id' => $optionId,
                            'is_correct' => in_array($optionId, $correctOptions)
                        ]);
                    }
                }

                // ✅ hitung benar
                if ($isCorrect) {
                    $correctCount++;
                }
            }

            // ✅ hitung score
            $score = round(($correctCount / $totalQuestions) * 100);

            $attempt->update([
                'score' => $score
            ]);
        });

        // 🔥 reset state
        $this->reset(['answers', 'currentQuestion']);

        return redirect()->route('user.dashboard')
            ->with('success', "Quiz selesai! Score: {$score} ({$correctCount}/{$totalQuestions})");
    }

    // 🔥 konfirmasi submit
    public function openSubmitModal()
    {
        $this->showSubmitModal = true;
    }

    // 🔥 tutup modal
    public function closeSubmitModal()
    {
        $this->showSubmitModal = false;
    }

    // 🔥 hitung jumlah pertanyaan yang sudah dijawab
    public function getAnsweredCountProperty()
    {
        $count = 0;

        foreach ($this->quiz->questions as $question) {

            $answer = $this->answers[$question->id] ?? null;

            if (is_array($answer)) {

                if (count(array_filter($answer)) > 0) {
                    $count++;
                }

            } else {

                if (!is_null($answer)) {
                    $count++;
                }
            }
        }

        return $count;
    }

    // 🔥 hitung jumlah pertanyaan yang belum dijawab
    public function getUnansweredCountProperty()
    {
        return count($this->quiz->questions) - $this->answeredCount;
    }
    
    // 🔥 mulai ulang quiz
    public function startAgain()
    {
        // ❌ kalau sudah 3x
        if ($this->attemptCount >= $this->maxAttempt) {
            session()->flash('error', 'Anda sudah mencapai batas maksimal 3 kali quiz.');
            return;
        }

        // reset jawaban dan current question
        $this->showConfirm = false;

        foreach ($this->quiz->questions as $q) {
            $this->answers[$q->id] = $q->is_multiple ? [] : null;
        }

        $this->currentQuestion = 0;
    }

    // Render
    public function render()
    {
        return view('livewire.quiz.play')
            ->layout('layouts.app');
    }
}