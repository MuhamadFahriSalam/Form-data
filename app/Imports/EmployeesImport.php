<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EmployeesImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        $employee = Employee::updateOrCreate(
            ['npk' => $row['npk']],
            [
                'nama' => $row['nama'] ?? null,
                'email' => $row['email'] ?? null,
                'no_hp' => $row['no_hp'] ?? null,
                'jabatan' => $row['jabatan'] ?? null,
                'departemen' => $row['departemen'] ?? null,
                'status' => $row['status'] ?? 'Kontrak',
                'alamat' => $row['alamat'] ?? null,
            ]
        );

        User::updateOrCreate(
            ['npk' => $row['npk']],
            [
                'name' => $row['nama'] ?? null,
                'email' => $row['email'] ?? null,
                'password' => Hash::make('aiia'),
                'role' => 'user',
            ]
        );

        return $employee;
    }

    public function rules(): array
    {
        return [
            '*.npk' => ['required', 'max:50'],
            '*.nama' => ['required', 'max:255'],
            '*.email' => ['nullable', 'email'],
            '*.status' => ['nullable', Rule::in(['Tetap', 'Kontrak', 'Magang'])],
        ];
    }
}
