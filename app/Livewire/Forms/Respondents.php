<?php

namespace App\Livewire\Forms;

use App\Models\Form;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RespondentsExport;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class Respondents extends Component
{
    use WithPagination;

    public Form $form;
    public string $search = '';
    protected $paginationTheme = 'tailwind';
    public $selectedSubmission = null;
    public $showModal = false;

    // Method untuk inisialisasi data form dan pertanyaan terkait
    public function mount(Form $form): void
    {
        $this->form = $form->load('questions');
    }

    // Method untuk menampilkan detail jawaban responden
    public function showDetail($id)
    {
        $this->selectedSubmission = \App\Models\FormSubmission::with(['answers','user'])->find($id);
        $this->showModal = true;
    }

    // Method untuk menutup modal detail
    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedSubmission = null;
    }

    // Method untuk menutup modal detail
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    // Method untuk memformat jawaban berdasarkan tipe pertanyaan
    public function formatAnswer($question, $value): string
    {
        $decoded = json_decode($value, true);

        if ($question->type === 'checkbox' && is_array($decoded)) {
            return implode(', ', $decoded);
        }

        if ($question->type === 'date' && !empty($value)) {
            return \Carbon\Carbon::parse($value)->format('d M Y');
        }

        if ($question->type === 'file' && !empty($value)) {
            return Storage::url($value);
        }

        return !empty($value) ? $value : '-';
    }

    // Method untuk mengekspor data responden ke Excel
    public function exportRespondents()
    {
        $submissions = $this->form->submissions()
            ->with(['user', 'answers.question'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->whereHas('user', function ($userQuery) {
                        $userQuery->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('answers', function ($answerQuery) {
                        $answerQuery->where('answer', 'like', '%' . $this->search . '%');
                    });
                });
            })
            ->latest()
            ->get();

        $questions = $this->form->questions;
        $rows = [];

        $headers = ['No', 'Nama', 'Email'];

        foreach ($questions as $question) {
            $headers[] = $question->question;
        }

        $headers[] = 'Waktu Isi';
        $rows[] = $headers;

        foreach ($submissions as $index => $submission) {
            $row = [
                $index + 1,
                $submission->user->name ?? 'User',
                $submission->user->email ?? '-',
            ];

            foreach ($questions as $question) {
                $answer = $submission->answers->firstWhere('form_question_id', $question->id);
                $value = $answer->answer ?? null;

                $row[] = $this->formatAnswer($question, $value);
            }

            $row[] = optional($submission->created_at)->format('d M Y H:i') ?? '-';
            $rows[] = $row;
        }

        $filename = 'respondents-' . Str::slug($this->form->title) . '.xlsx';

        return Excel::download(new RespondentsExport($rows), $filename);
    }

    // Method untuk merender view dengan data responden dan pertanyaan terkait
    public function render()
    {
        $respondents = $this->form->submissions()
            ->with([
                'user',
                'answers.question',
            ])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->whereHas('user', function ($userQuery) {
                        $userQuery->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('answers', function ($answerQuery) {
                        $answerQuery->where('answer', 'like', '%' . $this->search . '%');
                    });
                });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.forms.respondents', [
            'respondents' => $respondents,
            'questions' => $this->form->questions,
        ]);
    }
}
