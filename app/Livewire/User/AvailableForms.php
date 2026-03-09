<?php

namespace App\Livewire\User;

use App\Models\Form;
use Livewire\Component;

class AvailableForms extends Component
{
    public function render()
    {
        $forms = Form::query()
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('livewire.user.available-forms', [
            'forms' => $forms,
        ]);
    }
}