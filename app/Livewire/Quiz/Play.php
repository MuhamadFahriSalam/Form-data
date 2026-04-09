<?php

namespace App\Livewire\Quiz;

use Livewire\Component;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizAnswer;
use App\Models\QuizOption;
use App\Models\QuizQuestion;

class Play extends Component
{
    public $quiz;
    public $answers = [];
    public $currentQuestion = 0;

    // Load quiz dan inisialisasi jawaban
    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz->load('questions.options');

        foreach ($this->quiz->questions as $q) {
            if ($q->is_multiple) {
                $this->answers[$q->id] = [];
            } else {
                $this->answers[$q->id] = null;
            }
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

    // 🔥 Checkbox hanya 1 pilihan
    public function selectSingleCheckbox($questionId, $optionId)
    {
        $this->answers[$questionId] = [];
        $this->answers[$questionId][$optionId] = 1;
    }

    // SUBMIT
    public function submit()
    {
        $userId = auth()->id();

        $attempt = QuizAttempt::create([
            'user_id' => $userId,
            'quiz_id' => $this->quiz->id,
            'score' => 0
        ]);

        $score = 0;

        // 🔥 Evaluasi jawaban
        foreach ($this->answers as $questionId => $answer) {

            $question = QuizQuestion::with('options')->find($questionId);

            // 🔥 Ambil jawaban benar
            $correctOptions = $question->options
                ->where('is_correct', true)
                ->pluck('id')
                ->toArray();

            // 🔥 Jawaban user
            $selectedOptions = is_array($answer)
                ? array_keys(array_filter($answer))
                : [$answer];

            sort($correctOptions);
            sort($selectedOptions);

            $isCorrect = $correctOptions == $selectedOptions;

            // 🔥 Simpan jawaban user
            foreach ($selectedOptions as $optionId) {
                QuizAnswer::create([
                    'attempt_id' => $attempt->id,
                    'question_id' => $questionId,
                    'option_id' => $optionId,
                    'is_correct' => in_array($optionId, $correctOptions)
                ]);
            }

            // 🔥 Tambah skor kalau BENAR SEMUA
            if ($isCorrect) {
                $score++;
            }
        }

        // 🔥 Update skor attempt
        $attempt->update([
            'score' => $score
        ]);

        // 🔥 Redirect dengan pesan
        return redirect()->route('user.dashboard')
            ->with('success', 'Quiz selesai! Score: ' . $score);
    }

    // Render
    public function render()
    {
        return view('livewire.quiz.play')
            ->layout('layouts.app');
    }
}