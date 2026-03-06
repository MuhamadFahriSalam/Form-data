<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EmployeesImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return Employee::updateOrCreate(
            ['nik' => $row['nik']],
            [
                'nama' => $row['nama'] ?? null,
                'email' => $row['email'] ?? null,
                'no_hp' => $row['no_hp'] ?? null,
                'jabatan' => $row['jabatan'] ?? null,
                'departemen' => $row['departemen'] ?? null,
                'tanggal_masuk' => $row['tanggal_masuk'] ?? null,
                'status' => $row['status'] ?? 'Kontrak',
                'alamat' => $row['alamat'] ?? null,
            ]
        );
    }

    public function rules(): array
    {
        return [
            '*.nik' => ['required', 'max:50'],
            '*.nama' => ['required', 'max:255'],
            '*.email' => ['nullable', 'email'],
            '*.status' => ['nullable', Rule::in(['Tetap', 'Kontrak', 'Magang'])],
        ];
    }
}