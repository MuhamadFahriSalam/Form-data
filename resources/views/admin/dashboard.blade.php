<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold">Dashboard Admin</h1>
        <div class="mt-4 space-y-2">
            <a href="{{ route('employees.index') }}" class="text-blue-600 underline block">Kelola Karyawan</a>
            <a href="{{ route('forms.create') }}" class="text-blue-600 underline block">Buat Form</a>
        </div>
    </div>
</x-app-layout>