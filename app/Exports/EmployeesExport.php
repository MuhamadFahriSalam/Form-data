<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Employee::orderBy('id', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'npk',
            'Nama',
            'Email',
            'No HP',
            'Jabatan',
            'Departemen',
            'Tanggal Masuk',
            'Status',
        ];
    }

    public function map($employee): array
    {
        return [
            $employee->npk,
            $employee->nama,
            $employee->email,
            $employee->no_hp,
            $employee->jabatan,
            $employee->departemen,
            $employee->tanggal_masuk,
            $employee->status,
        ];
    }
}
