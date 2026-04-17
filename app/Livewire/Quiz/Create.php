<?php

namespace App\Livewire\Quiz;

use Livewire\Component;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizOption;

class Create extends Component
{
    public $title;
    public $questions = [];
    public $description;
    public $start_at;
    public $end_at;

    // Inisialisasi dengan 1 question dan 2 options
    public function mount()
    {
        $this->questions = [
            [
                'question' => '',
                'is_multiple' => false,
                'options' => [
                    ['text' => '', 'is_correct' => false],
                    ['text' => '', 'is_correct' => false],
                ]
            ]
        ];
    }

    // Tambah question baru
    public function addQuestion()
    {
        $this->questions[] = [
            'question' => '',
            'is_multiple' => false,
            'options' => [
                ['text' => '', 'is_correct' => false],
                ['text' => '', 'is_correct' => false],
            ]
        ];
    }

    // Hapus question
    public function removeQuestion($qIndex)
    {
        unset($this->questions[$qIndex]);
        $this->questions = array_values($this->questions);
    }

    // Tambah option untuk question tertentu
    public function addOption($qIndex)
    {
        $this->questions[$qIndex]['options'][] = [
            'text' => '',
            'is_correct' => false
        ];
    }

    // Hapus option untuk question tertentu
    public function removeOption($qIndex, $oIndex)
    {
        if (count($this->questions[$qIndex]['options']) <= 2) {
            return;
        }

        unset($this->questions[$qIndex]['options'][$oIndex]);
        $this->questions[$qIndex]['options'] =
            array_values($this->questions[$qIndex]['options']);
    }

    // Toggle correct option, dengan logika untuk single/multiple choice
    public function toggleCorrect($qIndex, $oIndex)
    {
        $isMultiple = $this->questions[$qIndex]['is_multiple'];

        if (!$isMultiple) {
            foreach ($this->questions[$qIndex]['options'] as $i => $opt) {
                $this->questions[$qIndex]['options'][$i]['is_correct'] = false;
            }
        }

        $this->questions[$qIndex]['options'][$oIndex]['is_correct'] =
            !$this->questions[$qIndex]['options'][$oIndex]['is_correct'];
    }

    // Simpan quiz beserta questions dan optionsnya
    public function save()
    {
        $this->validate([
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:5',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
        ], [
            'title.required' => 'Judul wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'start_at.required' => 'Tanggal mulai wajib diisi',
            'end_at.required' => 'Tanggal berakhir wajib diisi',
            'end_at.after' => 'Tanggal berakhir harus setelah tanggal mulai',
        ]);

        // 🔥 VALIDASI SETIAP PERTANYAAN & OPSI
        foreach ($this->questions as $qIndex => $q) {

            // ❌ Pertanyaan kosong
            if (trim($q['question']) === '') {
                $this->addError(
                    'questions.' . $qIndex . '.question',
                    'Pertanyaan tidak boleh kosong'
                );
            }
        }

        // 🔥 VALIDASI SETIAP SOAL
        foreach ($this->questions as $qIndex => $q) {

            $hasCorrect = false;

            // 🔥 VALIDASI PERTANYAAN KOSONG
            foreach ($q['options'] as $oIndex => $opt) {

                // ❌ VALIDASI OPSI KOSONG
                if (trim($opt['text']) === '') {
                    $this->addError(
                        'questions.' . $qIndex . '.options.' . $oIndex,
                        'Opsi tidak boleh kosong'
                    );
                }

                // ❌ VALIDASI: centang tapi kosong
                if ($opt['is_correct'] && trim($opt['text']) === '') {
                    $this->addError(
                        'questions.' . $qIndex . '.options.' . $oIndex,
                        'Tidak boleh mencentang opsi kosong'
                    );
                }

                // cek jawaban benar
                if ($opt['is_correct'] && trim($opt['text']) !== '') {
                    $hasCorrect = true;
                }
            }

            // ❌ tidak ada jawaban benar
            if (!$hasCorrect) {
                $this->addError(
                    'questions.' . $qIndex . '.correct',
                    'Soal ini wajib memiliki minimal 1 jawaban benar ✔'
                );
            }
        }

        // 🔥 STOP kalau ada error
        if ($this->getErrorBag()->isNotEmpty()) {
            return;
        }

        // 🔥 SIMPAN QUIZ
        $quiz = Quiz::create([
            'title' => $this->title,
            'description' => $this->description,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
        ]);

        // 🔥 SIMPAN QUESTIONS & OPTIONS
        foreach ($this->questions as $q) {

            if (trim($q['question']) === '') continue;

            // 🔥 SIMPAN QUESTION
            $question = QuizQuestion::create([
                'quiz_id' => $quiz->id,
                'question' => $q['question'],
                'is_multiple' => $q['is_multiple'] ?? false,
            ]);

            foreach ($q['options'] as $opt) {

                if (trim($opt['text']) === '') continue;

                // 🔥 SIMPAN OPTION
                QuizOption::create([
                    'question_id' => $question->id,
                    'text' => $opt['text'],
                    'is_correct' => $opt['is_correct']
                ]);
            }
        }

        // 🔥 FLASH MESSAGE
        session()->flash('quiz_success', true);

        $this->dispatch('quiz-saved');
    }

    // Render method untuk menampilkan form create quiz
    public function render()
    {
        return view('livewire.quiz.create')
            ->layout('layouts.app');
    }
}