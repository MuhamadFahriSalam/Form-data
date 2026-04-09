<?php

namespace App\Exports;

use App\Models\QuizAttempt;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QuizResultsExport implements FromCollection, WithHeadings
{
    protected $quizId;

    public function __construct($quizId)
    {
        $this->quizId = $quizId;
    }

    public function collection()
    {
        return QuizAttempt::with('user')
            ->where('quiz_id', $this->quizId)
            ->get()
            ->map(function ($item, $index) {
                return [
                    'No' => $index + 1,
                    'Nama' => $item->user->name ?? '-',
                    'Email' => $item->user->email ?? '-',
                    'Score' => $item->score,
                    'Tanggal' => $item->created_at->format('d-m-Y H:i'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Email',
            'Score',
            'Tanggal'
        ];
    }
}