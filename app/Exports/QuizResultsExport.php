<?php

namespace App\Exports;

use App\Models\QuizAttempt;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class QuizResultsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $quizId;

    // Constructor untuk menerima quizId
    public function __construct($quizId)
    {
        $this->quizId = $quizId;
    }

    // Ambil data quiz attempts untuk quiz tertentu
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

    // Definisikan header untuk kolom Excel
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

    // Styling untuk Excel
    public function styles(Worksheet $sheet)
    {
        return [
            // 🔥 HEADER BOLD
            1 => [
                'font' => ['bold' => true],
            ],

            // 🔥 CENTER KOLOM NO
            'A' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ],

            // 🔥 CENTER KOLOM SCORE
            'D' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ],
        ];
    }
}