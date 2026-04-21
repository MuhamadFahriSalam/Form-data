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
    public bool $showConfirm = false;
    public bool $showResult = false;
    public bool $isEditMode = false;
    public int $attemptCount = 0;
    public int $maxAttempt = 3;

    // Method untuk inisialisasi data form dan jawaban jika sudah pernah submit
    public function mount(Form $form): void
    {
        // load form dulu
        $this->form = $form->load(['questions' => fn($q) => $q->orderBy('sort_order')]);

        // hitung attempt
        $this->attemptCount = FormSubmission::where('form_id', $form->id)
            ->where('user_id', auth()->id())
            ->count();

        // ambil submission terakhir
        $submission = FormSubmission::where('form_id', $form->id)
            ->where('user_id', auth()->id())
            ->latest()
            ->with('answers')
            ->first();

        // default kosong
        foreach ($this->form->questions as $question) {
            $this->answers[$question->id] = $question->type === 'checkbox' ? [] : null;
        }

        // kalau ada submission
        if ($submission) {
            $this->alreadySubmitted = true;
            $this->showResult = true;

            foreach ($submission->answers as $answer) {
                $value = json_decode($answer->answer, true);

                $this->answers[$answer->form_question_id] =
                    is_array($value) ? $value : $answer->answer;
            }
        }
    }

    // Method untuk mendefinisikan aturan validasi dinamis berdasarkan tipe pertanyaan
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

    // Custom validation messages untuk setiap pertanyaan
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

        // Cek apakah sudah pernah submit dan belum mencapai batas maksimal
        if (!$this->isEditMode && $this->attemptCount >= $this->maxAttempt) {
            session()->flash('error', 'Batas maksimal pengisian sudah tercapai.');
            return;
        }

        // Gunakan transaction untuk memastikan data konsisten
        DB::transaction(function () {

            if ($this->isEditMode) {
                // ✏️ EDIT → update data lama
                $submission = FormSubmission::where('form_id', $this->form->id)
                    ->where('user_id', auth()->id())
                    ->first();

                // hapus jawaban lama → isi ulang
                $submission->answers()->delete();

            } else {
                // 🔁 ISI ULANG → buat submission baru
                $submission = FormSubmission::create([
                    'form_id' => $this->form->id,
                    'user_id' => auth()->id(),
                ]);
            }

            // simpan jawaban
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

        // ✅ UPDATE COUNT LANGSUNG
        $this->attemptCount = FormSubmission::where('form_id', $this->form->id)
            ->where('user_id', auth()->id())
            ->count();

        // Flash message sukses
        session()->flash('success', 'Jawaban berhasil diperbarui!');

        $this->showConfirm = false;
        $this->showResult = true;
        session()->flash('success', 'Jawaban berhasil dikirim!');

        // ✅ Livewire redirect (tanpa return)
        // $this->redirect(route('user.dashboard'));
    }

    // Method untuk memulai ulang form (reset jawaban)
    public function startAgain(): void
    {
        // ❌ kalau sudah 3x
        if ($this->attemptCount >= $this->maxAttempt) {
            session()->flash('error', 'Anda sudah mencapai batas maksimal 3 kali pengisian.');
            return;
        }

        foreach ($this->form->questions as $question) {
            $this->answers[$question->id] = $question->type === 'checkbox' ? [] : null;
        }

        $this->isEditMode = false;
        $this->showConfirm = false;
        $this->showResult = false;
        $this->alreadySubmitted = false;
    }
        
    // Method untuk membatalkan edit dan tetap melihat jawaban lama
    public function continueEdit(): void
    {
        $this->isEditMode = true;
        $this->showConfirm = false;

        $this->showResult = false;
    }

    // Method untuk menampilkan detail jawaban responden
    public function render()
    {
        return view('livewire.forms.show')
            ->layout('layouts.app');
    }
}
