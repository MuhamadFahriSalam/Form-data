<?php

namespace App\Livewire\Admin;

use App\Models\Form;
use Livewire\Component;

class Dashboard extends Component
{
public function render()
{
    $forms = Form::where('user_id', auth()->id())
        ->where(function ($q) {
            $q->whereNull('closes_at')
              ->orWhere('closes_at', '>=', now());
        })
        ->withCount('submissions')
        ->latest()
        ->get();

    return view('livewire.admin.dashboard', [
        'forms' => $forms,
    ]);
}
}
