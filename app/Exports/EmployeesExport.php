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
                'user.quizAttempts',
                'user.formSubmissions'
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
            'Status Form',
        ];
    }

    public function map($employee): array
    {
        $user = $employee->user;

        $quizStatus = ($user && $user->quizAttempts->count() > 0)
            ? 'Sudah'
            : 'Belum';

        $formStatus = ($user && $user->formSubmissions->count() > 0)
            ? 'Sudah'
            : 'Belum';

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
            $formStatus,
        ];
    }

    // 🔥 STYLE EXCEL
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
            'A:J' => [
                'alignment' => [
                    'vertical' => 'center',
                ],
            ],
        ];
    }
}