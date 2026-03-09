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
    public bool $alreadySubmitted = false;
    public function mount(Form $form): void
    {
        $this->form = $form->load(['questions' => function ($q) {
            $q->orderBy('sort_order');
        }]);

        $this->alreadySubmitted = FormSubmission::where('form_id', $form->id)
            ->where('user_id', auth()->id())
            ->exists();

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
                    default => ['required'],
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

    protected function messages(): array
    {
        $messages = [];

        foreach ($this->form->questions as $question) {
            $key = "answers.{$question->id}";

            $messages["{$key}.required"] = 'Harus diisi.';
            $messages["{$key}.min"] = 'Harus diisi.';
            $messages["{$key}.array"] = 'Harus diisi.';
            $messages["{$key}.date"] = 'Format tanggal tidak valid.';
        }

        return $messages;
    }

    public function submit(): void
    {
        if (! $this->form->is_active || $this->form->status !== 'open') {
            abort(403, 'Form tidak tersedia.');
        }

        if ($this->alreadySubmitted) {
            session()->flash('error', 'Anda sudah mengisi form ini.');
            return;
        }

        $this->validate();

        DB::transaction(function () {
            $submission = FormSubmission::create([
                'form_id' => $this->form->id,
                'user_id' => auth()->id(),
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

        $this->alreadySubmitted = true;

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
