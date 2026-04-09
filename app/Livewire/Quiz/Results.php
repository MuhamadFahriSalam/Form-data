<?php

namespace App\Livewire\Quiz;

use Livewire\Component;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\QuizResultsExport;

class Results extends Component
{
    public $quiz;

    // Mount method untuk menerima data quiz
    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    // Export hasil quiz ke Excel
    public function exportExcel()
    {
        return redirect()->route('quiz.export', $this->quiz->id);
    }

    // Render method untuk menampilkan hasil quiz
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