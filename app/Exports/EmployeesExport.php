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
            // 'Tanggal Masuk',
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

        // 🔥 DETAIL QUIZ (SEMUA)
        $quizTitles = '-';
        if ($user && $user->quizAttempts->count() > 0) {
            $quizTitles = $user->quizAttempts
                ->pluck('quiz.title')
                ->filter()
                ->unique()
                ->implode(', ');
        }

        // 🔥 DETAIL FORM (SEMUA)
        $formTitles = '-';
        if ($user && $user->formSubmissions->count() > 0) {
            $formTitles = $user->formSubmissions
                ->pluck('form.title')
                ->filter()
                ->unique()
                ->implode(', ');
        }

        return [
            $employee->npk,
            $employee->nama,
            $employee->email,
            $employee->no_hp,
            $employee->jabatan,
            $employee->departemen,
            // optional($employee->tanggal_masuk)->format('d-m-Y'),
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
            1 => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                ],
            ],

            'A:L' => [
                'alignment' => [
                    'vertical' => 'center',
                ],
            ],
        ];
    }
}