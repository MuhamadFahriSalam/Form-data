<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\Form;

class Respondents extends Component
{
    public Form $form;

    public function mount(Form $form)
    {
        $this->form = $form->load([
            'submissions.user'
        ]);
    }

    public function render()
    {
        $respondents = $this->form->submissions()
            ->with('user')
            ->latest()
            ->get();

        return view('livewire.forms.respondents', [
            'respondents' => $respondents
        ]);
    }
}