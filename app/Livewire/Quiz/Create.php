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
            'title' => 'required',
            'description' => 'nullable',
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',
        ]);

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
        session()->flash('success', 'Quiz berhasil dibuat!');

        return redirect()->route('admin.dashboard');
    }

    // Render method untuk menampilkan form create quiz
    public function render()
    {
        return view('livewire.quiz.create')
            ->layout('layouts.app');
    }
}