<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeesExport implements 
    FromCollection, 
    WithHeadings, 
    WithMapping, 
    ShouldAutoSize,
    WithStyles
{
    public function collection()
    {
        return Employee::with([
                'user.quizAttempts.quiz',
                'user.formSubmissions.form'
            ])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'NPK',
            'Nama',
            'Email',
            'No HP',
            'Jabatan',
            'Departemen',
            'Tanggal Masuk',
            'Status Karyawan',
            'Status Quiz',
            'Detail Quiz',
            'Status Form',
            'Detail Form',
        ];
    }

    public function map($employee): array
    {
        $user = $employee->user;

        // ✅ STATUS QUIZ
        $quizStatus = ($user && $user->quizAttempts->count() > 0)
            ? 'Sudah Mengisi'
            : 'Belum Mengisi';

        // ✅ STATUS FORM
        $formStatus = ($user && $user->formSubmissions->count() > 0)
            ? 'Sudah Mengisi'
            : 'Belum Mengisi';

        // 🔥 DETAIL QUIZ (BATASI 2)
        $quizTitles = '-';
        if ($user && $user->quizAttempts->count() > 0) {
            $titles = $user->quizAttempts
                ->pluck('quiz.title')
                ->filter()
                ->take(2);

            $more = $user->quizAttempts->count() - $titles->count();

            $quizTitles = $titles->implode(', ');
            if ($more > 0) {
                $quizTitles .= " (+$more lainnya)";
            }
        }

        // 🔥 DETAIL FORM (BATASI 2)
        $formTitles = '-';
        if ($user && $user->formSubmissions->count() > 0) {
            $titles = $user->formSubmissions
                ->pluck('form.title')
                ->filter()
                ->take(2);

            $more = $user->formSubmissions->count() - $titles->count();

            $formTitles = $titles->implode(', ');
            if ($more > 0) {
                $formTitles .= " (+$more lainnya)";
            }
        }

        return [
            $employee->npk,
            $employee->nama,
            $employee->email,
            $employee->no_hp,
            $employee->jabatan,
            $employee->departemen,
            optional($employee->tanggal_masuk)->format('d-m-Y'),
            $employee->status,
            $quizStatus,
            $quizTitles,
            $formStatus,
            $formTitles,
        ];
    }

    // 🎨 STYLE EXCEL
    public function styles(Worksheet $sheet)
    {
        return [
            // HEADER
            1 => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                ],
            ],

            // SEMUA DATA
            'A:L' => [
                'alignment' => [
                    'vertical' => 'center',
                ],
            ],
        ];
    }
}