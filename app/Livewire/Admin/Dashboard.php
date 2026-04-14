<?php

namespace App\Livewire\Admin;

use App\Models\Form;
use App\Models\Quiz;
use Livewire\Component;

class Dashboard extends Component
{
    // Method publish form
    public function publish($id)
    {
        $form = Form::where('user_id', auth()->id())->findOrFail($id);

        $form->update([
            'is_active' => true
        ]);

        session()->flash('success', 'Form berhasil dipublish.');
    }

    public function render()
    {
        // ✅ Forms
        $forms = Form::where('user_id', auth()->id())
            ->where(function ($q) {
                $q->whereNull('closes_at')
                  ->orWhere('closes_at', '>=', now());
            })
            ->withCount('submissions')
            ->latest()
            ->get();

        // ✅ Quizzes
        $quizzes = Quiz::withCount(['questions', 'attempts'])
        ->where(function ($q) {
            $q->whereNull('end_at')
            ->orWhere('end_at', '>=', now());
        })
        ->latest()
        ->get();

        return view('livewire.admin.dashboard', [
            'forms' => $forms,
            'quizzes' => $quizzes,
        ]);
    }
}