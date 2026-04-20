<?php

namespace App\Livewire\Employees;

use App\Models\Employee;
use App\Models\EmployeeField;
use App\Models\EmployeeFieldValue;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeesExport;
use App\Imports\EmployeesImport;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public string $search = '';
    public int $perPage = 10;
    public ?int $editingId = null;

    public string $nik = '';
    public string $nama = '';
    public ?string $email = null;
    public ?string $no_hp = null;
    public ?string $jabatan = null;
    public ?string $departemen = null;
    public ?string $tanggal_masuk = null;
    public string $status = 'Kontrak';
    public ?string $alamat = null;

    public array $dynamicFields = [];
    public array $dynamicValues = [];

    public $importFile;


    // Reset pagination when search term changes
    public function updatedSearch(): void
    {
        $this->resetPage();
    }



    // Validation rules for employee form
    protected function rules(): array
    {
        $rules = [
            'nik' => ['required', 'string', 'max:50', Rule::unique('employees', 'nik')->ignore($this->editingId)],
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('employees', 'email')->ignore($this->editingId)],
            'no_hp' => ['nullable', 'string', 'max:30'],
            'jabatan' => ['nullable', 'string', 'max:100'],
            'departemen' => ['nullable', 'string', 'max:100'],
            'status' => ['required', Rule::in(['Tetap', 'Kontrak', 'Magang'])],
        ];

        foreach ($this->dynamicFields as $f) {
            $key = "dynamicValues.{$f['id']}";
            $required = (bool) $f['required'];

            $rules[$key] = match ($f['type']) {
                'checkbox' => $required ? 'required|array|min:1' : 'nullable|array',
                'number' => $required ? 'required|numeric' : 'nullable|numeric',
                'date' => $required ? 'required|date' : 'nullable|date',
                default => $required ? 'required' : 'nullable',
            };
        }

        return $rules;
    }

    // Reset form to default state
    public function resetForm(): void
    {
        $this->editingId = null;

        $this->nik = '';
        $this->nama = '';
        $this->email = null;
        $this->no_hp = null;
        $this->jabatan = null;
        $this->departemen = null;
        $this->status = 'Kontrak';

        $this->dynamicValues = [];
        $this->loadDynamicFields();

        $this->resetValidation();
    }

    // Load employee data into form for editing
    public function edit(int $id): void
    {
        $emp = Employee::with(['fieldValues.field'])->findOrFail($id);

        $this->editingId = $emp->id;
        $this->nik = $emp->nik;
        $this->nama = $emp->nama;
        $this->email = $emp->email;
        $this->no_hp = $emp->no_hp;
        $this->jabatan = $emp->jabatan;
        $this->departemen = $emp->departemen;
        $this->status = $emp->status;

        $this->dynamicValues = [];
        $this->loadDynamicFields();

        foreach ($emp->fieldValues as $fv) {
            $fieldType = $fv->field?->type;
            $val = $fv->value;

            if ($fieldType === 'checkbox' && $val) {
                $this->dynamicValues[$fv->field_id] = json_decode($val, true) ?? [];
            } else {
                $this->dynamicValues[$fv->field_id] = $val;
            }
        }

        $this->resetValidation();
    }

    // Save new or updated employee data
    public function save(): void
    {
        $data = $this->validate();

        DB::transaction(function () use ($data) {
            $employee = Employee::updateOrCreate(
                ['id' => $this->editingId],
                [
                    'nik' => $data['nik'],
                    'nama' => $data['nama'],
                    'email' => $data['email'],
                    'no_hp' => $data['no_hp'],
                    'jabatan' => $data['jabatan'],
                    'departemen' => $data['departemen'],
                    'status' => $data['status'],
                ]
            );

            foreach ($this->dynamicFields as $f) {
                $fid = $f['id'];
                $val = $this->dynamicValues[$fid] ?? null;

                if ($f['type'] === 'checkbox' && is_array($val)) {
                    $val = json_encode($val);
                }

                EmployeeFieldValue::updateOrCreate(
                    ['employee_id' => $employee->id, 'field_id' => $fid],
                    ['value' => $val]
                );
            }
        });

        session()->flash('success', $this->editingId ? 'Data karyawan diperbarui.' : 'Data karyawan ditambahkan.');
        $this->resetForm();
    }

    // Delete employee record
    public function delete(int $id): void
    {
        Employee::whereKey($id)->delete();
        session()->flash('success', 'Data karyawan dihapus.');

        if ($this->editingId === $id) {
            $this->resetForm();
        }
    }

    // Export employee data to Excel
    public function exportExcel()
    {
        return Excel::download(new EmployeesExport, 'data-karyawan.xlsx');
    }

    // Import employee data from Excel
    public function importExcel(): void
    {
        $this->validate([
            'importFile' => 'required|file|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new EmployeesImport, $this->importFile);

        $this->importFile = null;
        session()->flash('success', 'Data karyawan berhasil diimport.');
        $this->resetPage();
    }

    // Trigger import when file is uploaded
    public function updatedImportFile(): void
    {
        $this->importExcel();
    }

    // Render the component view with paginated employee data
    public function render()
    {
        $employees = Employee::query()
            ->with([
                'user.quizAttempts.quiz',
                'user.formSubmissions.form'
            ])
            ->when($this->search !== '', function ($q) {
                $q->where(function ($qq) {
                    $qq->where('npk', 'like', "%{$this->search}%")
                        ->orWhere('nama', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%")
                        ->orWhere('departemen', 'like', "%{$this->search}%")
                        ->orWhere('jabatan', 'like', "%{$this->search}%")
                        ->orWhere('status', 'like', "%{$this->search}%");
                });
            })
            ->orderByDesc('id')
            ->paginate($this->perPage);

        return view('livewire.employees.index', compact('employees'))
            ->layout('layouts.app');
    }
}
