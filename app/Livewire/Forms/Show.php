<?php

namespace App\Livewire\Forms;

use App\Models\Form;
use App\Models\FormSubmission;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Show extends Component
{
    public Form $form;
    public array $answers = [];

    public function mount(Form $form): void
    {
        $this->form = $form->load(['questions' => function ($q) {
            $q->orderBy('sort_order');
        }]);

        foreach ($this->form->questions as $question) {
            $this->answers[$question->id] = $question->type === 'checkbox' ? [] : '';
        }
    }

    protected function rules(): array
    {
        $rules = [];

        foreach ($this->form->questions as $question) {
            $key = "answers.{$question->id}";

            if ($question->is_required) {
                $rules[$key] = match ($question->type) {
                    'checkbox' => ['required', 'array', 'min:1'],
                    'date' => ['required', 'date'],
                    default => ['required', 'string'],
                };
            } else {
                $rules[$key] = match ($question->type) {
                    'checkbox' => ['nullable', 'array'],
                    'date' => ['nullable', 'date'],
                    default => ['nullable'],
                };
            }
        }

        return $rules;
    }

    public function submit(): void
    {
        $this->validate();

        DB::transaction(function () {
            $submission = FormSubmission::create([
                'form_id' => $this->form->id,
            ]);

            foreach ($this->form->questions as $question) {
                $answer = $this->answers[$question->id] ?? null;

                if (is_array($answer)) {
                    $answer = json_encode($answer);
                }

                $submission->answers()->create([
                    'form_question_id' => $question->id,
                    'answer' => $answer,
                ]);
            }
        });

        session()->flash('success', 'Jawaban berhasil dikirim.');

        foreach ($this->form->questions as $question) {
            $this->answers[$question->id] = $question->type === 'checkbox' ? [] : '';
        }
    }

    public function render()
    {
        return view('livewire.forms.show')
            ->layout('layouts.app');
    }
}