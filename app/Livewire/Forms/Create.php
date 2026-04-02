<?php

namespace App\Livewire\Forms;

use App\Models\Form;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class Create extends Component
{
    public string $title = '';
    public string $description = '';
    public ?string $start_at = null;
    public ?string $end_at = null;

    public array $questions = [];

    public string $status = 'draft'; // default draft

    // Initialize with one empty question
    public function mount(): void
    {
        $this->addQuestion();
    }

    // Method untuk menambahkan pertanyaan baru
    public function addQuestion(): void
    {
        $this->questions[] = [
            'question' => '',
            'type' => 'text',
            'is_required' => false,
            'options' => [''],
        ];
    }

    // Method untuk menghapus pertanyaan
    public function removeQuestion(int $index): void
    {
        unset($this->questions[$index]);
        $this->questions = array_values($this->questions);
    }

    // Method untuk menambahkan opsi ke pertanyaan pilihan
    public function addOption(int $questionIndex): void
    {
        $this->questions[$questionIndex]['options'][] = '';
    }

    // Method untuk menghapus opsi dari pertanyaan pilihan
    public function removeOption(int $questionIndex, int $optionIndex): void
    {
        unset($this->questions[$questionIndex]['options'][$optionIndex]);
        $this->questions[$questionIndex]['options'] = array_values($this->questions[$questionIndex]['options']);
    }

    // Validation rules
    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date', 'after:start_at'],

            'status' => ['required', Rule::in(['draft', 'published'])],

            'questions' => ['required', 'array', 'min:1'],
            'questions.*.question' => ['required', 'string', 'max:255'],
            'questions.*.type' => ['required', Rule::in(['text', 'textarea', 'radio', 'checkbox', 'select', 'date', 'number','file'])],
            'questions.*.is_required' => ['boolean'],
            'questions.*.options' => ['nullable', 'array'],
            'questions.*.options.*' => ['nullable', 'string', 'max:255'],
        ];
    }
    
    // Custom validation messages
    protected function messages(): array
    {
        return [
            'title.required' => 'Judul form wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',

            'start_at.required' => 'Waktu mulai wajib diisi.',
            'start_at.date' => 'Format waktu mulai tidak valid.',

            'end_at.required' => 'Batas akhir pengisian wajib diisi.',
            'end_at.date' => 'Format batas akhir tidak valid.',
            'end_at.after' => 'Batas akhir harus setelah waktu mulai.',

            'questions.required' => 'Minimal harus ada satu pertanyaan.',
            'questions.*.question.required' => 'Teks pertanyaan wajib diisi.',
        ];
    }

    // Method untuk menyimpan dengan status tertentu (draft atau published)
    public function saveAs(string $status): void
    {
        $this->status = $status;
        $this->save();
    }

    // Method untuk konfirmasi sebelum menyimpan
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $form = Form::create([
                'user_id' => auth()->id(),
                "uuid" => Str::uuid(),
                'title' => $this->title,
                'description' => $this->description,
                'is_active' => $this->status === 'published',
                'opens_at' => $this->start_at,
                'closes_at' => $this->end_at,

                // 'opens_at' => $this->start_at ?: null,
                // 'closes_at' => $this->end_at ?: null,
            ]);

            foreach ($this->questions as $index => $q) {
                $options = in_array($q['type'], ['radio', 'checkbox', 'select', 'file','number'])
                    ? array_values(array_filter($q['options'], fn ($item) => trim((string) $item) !== ''))
                    : null;

                $form->questions()->create([
                    'question' => $q['question'],
                    'type' => $q['type'],
                    'is_required' => $q['is_required'],
                    'options' => $options,
                    'sort_order' => $index + 1,
                ]);
            }
        });

        // Redirect ke dashboard setelah menyimpan
        session()->flash('success', 
            $this->status === 'published'
                ? 'Form berhasil dipublish.'
                : 'Form berhasil disimpan sebagai draft.'
        );

        $this->title = '';
        $this->description = '';
        $this->start_at = null;
        $this->end_at = null;
        $this->questions = [];
        $this->addQuestion();
    }

    // Render method
    public function render()
    {
        return view('livewire.forms.create')
            ->layout('layouts.app');
    }
}
