<?php

namespace App\Livewire\Quiz;

use Livewire\Component;
use App\Models\Quiz;
use App\Models\QuizAttempt;

class Results extends Component
{
    public $quiz;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function render()
    {
        $attempts = QuizAttempt::with('user')
            ->where('quiz_id', $this->quiz->id)
            ->latest()
            ->get();

        return view('livewire.quiz.results', [
            'attempts' => $attempts
        ])->layout('layouts.app');
    }
}