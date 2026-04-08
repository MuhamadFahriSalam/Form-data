<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Form;
use App\Models\Quiz;
use App\Models\User;

class Monitoring extends Component
{
    public function render()
    {
        $totalUsers = User::count();

        // FORM
        $forms = Form::withCount('submissions')->latest()->get();

        // QUIZ
        $quizzes = Quiz::withCount(['attempts', 'questions'])->latest()->get();

        return view('livewire.admin.monitoring', [
            'forms' => $forms,
            'quizzes' => $quizzes,
            'totalUsers' => $totalUsers
        ]);
    }
}