<?php

namespace App\Livewire\User;

use App\Models\Form;
use App\Models\Quiz;
use Livewire\Component;

class AvailableForms extends Component
{
    public function render()
    {
        // FORM
        $forms = Form::query()
            ->where('is_active', true)
            ->where('closes_at', '>=', now())
            ->latest()
            ->get();

        // QUIZ
        $quizzes = Quiz::with('questions')->latest()->get();

        return view('livewire.user.available-forms', [
            'forms' => $forms,
            'quizzes' => $quizzes,
        ]);
    }
}