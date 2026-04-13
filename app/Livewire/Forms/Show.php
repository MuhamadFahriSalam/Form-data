<?php

namespace App\Livewire\Forms;

use App\Models\Form;
use App\Models\FormSubmission;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Show extends Component
{
    use WithFileUploads;

    public Form $form;
    public array $answers = [];
    public bool $alreadySubmitted = false;

    // Method untuk inisialisasi data form dan jawaban jika sudah pernah submit
    public function mount(Form $form): void
    {
        $this->form = $form->load(['questions' => function ($q) {
            $q->orderBy('sort_order');
        }]);

        $submission = FormSubmission::where('form_id', $form->id)
            ->where('user_id', auth()->id())
            ->with('answers')
            ->first();

        foreach ($this->form->questions as $question) {
            $this->answers[$question->id] = $question->type === 'checkbox' ? [] : null;
        }

        // 🔥 kalau sudah pernah isi → load jawaban lama
        if ($submission) {
            $this->alreadySubmitted = true;

            foreach ($submission->answers as $answer) {
                $value = json_decode($answer->answer, true);

                $this->answers[$answer->form_question_id] =
                    is_array($value) ? $value : $answer->answer;
            }
        }
    }

    protected function rules(): array
    {
        $rules = [];

        foreach ($this->form->questions as $question) {
            $key = "answers.{$question->id}";

            $rules[$key] = match ($question->type) {
                'checkbox' => $question->is_required
                    ? ['required', 'array', 'min:1']
                    : ['nullable', 'array'],

                'date' => $question->is_required
                    ? ['required', 'date']
                    : ['nullable', 'date'],

                'email' => $question->is_required
                    ? ['required', 'email']
                    : ['nullable', 'email'],

                'number' => $question->is_required
                    ? ['required', 'numeric']
                    : ['nullable', 'numeric'],

                'file' => $question->is_required
                    ? ['required', 'file', 'max:2048']
                    : ['nullable', 'file', 'max:2048'],

                default => $question->is_required
                    ? ['required']
                    : ['nullable'],
            };
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
            $messages["{$key}.email"] = 'Format email tidak valid.';
            $messages["{$key}.numeric"] = 'Harus berupa angka.';
            $messages["{$key}.file"] = 'File tidak valid.';
            $messages["{$key}.max"] = 'Ukuran file maksimal 2MB.';
        }

        return $messages;
    }

    // Method untuk menyimpan jawaban form
    public function submit(): void
    {
        // Cek apakah form masih aktif dan belum ditutup
        if (! $this->form->is_active || $this->form->status !== 'open') {
            abort(403, 'Form tidak tersedia.');
        }

        $this->validate();

        // Gunakan transaction untuk memastikan data konsisten
        DB::transaction(function () {

            // Cek apakah sudah pernah submit, kalau sudah hapus jawaban lama dan buat baru
            $submission = FormSubmission::where('form_id', $this->form->id)
                ->where('user_id', auth()->id())
                ->first();

            // Kalau belum pernah submit, buat baru. Kalau sudah, hapus jawaban lama dan buat baru (update)
            if (!$submission) {
                $submission = FormSubmission::create([
                    'form_id' => $this->form->id,
                    'user_id' => auth()->id(),
                ]);
            } else {
                $submission->answers()->delete();
            }

            // Simpan jawaban untuk setiap pertanyaan
            foreach ($this->form->questions as $question) {
                $answer = $this->answers[$question->id] ?? null;

                if ($question->type === 'file' && $answer) {
                    $answer = $answer->store('form-answers', 'public');
                } elseif (is_array($answer)) {
                    $answer = json_encode($answer);
                }

                $submission->answers()->create([
                    'form_question_id' => $question->id,
                    'answer' => $answer,
                ]);
            }
        });

        // Flash message sukses
        session()->flash('success', 'Jawaban berhasil diperbarui!');

        // ✅ Livewire redirect (tanpa return)
        $this->redirect(route('user.dashboard'));
    }

    // Method untuk menampilkan detail jawaban responden
    public function render()
    {
        return view('livewire.forms.show')
            ->layout('layouts.app');
    }
}
