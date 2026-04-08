<?php

namespace App\Livewire\User;

use App\Models\Form;
use App\Models\Quiz;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AvailableForms extends Component
{
    // Filter untuk menampilkan semua form, hanya yang sudah diisi, atau hanya yang belum diisi
    public $filter = 'empty'; // all | filled | empty


    // Method untuk mengubah filter
    public function render()
    {
        $userId = Auth::id();

        // ================= FORM =================
        $forms = Form::query()
            ->with(['submissions' => function ($q) use ($userId) {
                $q->where('user_id', $userId);
            }])
            ->where('is_active', true)
            ->where('closes_at', '>=', now())

            ->when($this->filter === 'filled', function ($query) use ($userId) {
                $query->whereHas('submissions', function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                });
            })

            ->when($this->filter === 'empty', function ($query) use ($userId) {
                $query->whereDoesntHave('submissions', function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                });
            })

            ->latest()
            ->get();


        // ================= QUIZ =================
        $quizzes = Quiz::with([
                'questions',
                'attempts' => function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                }
            ])

            ->when($this->filter === 'filled', function ($query) use ($userId) {
                $query->whereHas('attempts', function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                });
            })

            ->when($this->filter === 'empty', function ($query) use ($userId) {
                $query->whereDoesntHave('attempts', function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                });
            })

            ->latest()
            ->get();


        return view('livewire.user.available-forms', [
            'forms' => $forms,
            'quizzes' => $quizzes,
        ]);
    }
}