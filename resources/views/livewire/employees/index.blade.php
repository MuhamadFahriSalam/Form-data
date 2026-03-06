<div class="max-w-7xl mx-auto p-6 space-y-6">

    @if (session('success'))
        <div class="p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="p-3 bg-red-100 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="rounded-xl bg-gray-900 px-6 py-6 shadow">
        <div class="lg:flex lg:items-center lg:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl/7 font-bold text-white sm:truncate sm:text-3xl sm:tracking-tight">
                    Data Karyawan
                </h2>

                <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:gap-x-6">
                    <div class="mt-2 flex items-center text-sm text-gray-300">Total: {{ $employees->total() }} data</div>
                </div>
            </div>

            <div class="mt-5 flex flex-wrap lg:mt-0 lg:ml-4 gap-3 items-center">
                <div class="relative">
                    <input
                        type="text"
                        wire:model.live="search"
                        placeholder="Cari NIK, nama, email, departemen..."
                        class="w-80 rounded-md border border-white/20 bg-white/10 px-4 py-2 text-sm text-white placeholder:text-gray-300 focus:border-white/40 focus:outline-none"
                    >
                </div>

                <button
                    type="button"
                    class="inline-flex items-center rounded-md bg-white/10 px-3 py-2 text-sm font-semibold text-white ring-1 ring-inset ring-white/10 hover:bg-white/20"
                    wire:click="exportExcel"
                    wire:loading.attr="disabled"
                    wire:target="exportExcel"
                >
                    Export
                </button>

                <label
                    for="importFileInput"
                    class="inline-flex cursor-pointer items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-500"
                >
                    Import
                </label>

                <input
                    id="importFileInput"
                    type="file"
                    wire:model="importFile"
                    accept=".xlsx,.xls,.csv"
                    class="hidden"
                >
            </div>
        </div>
    </div>

    <div class="relative overflow-x-auto bg-white shadow rounded-lg border border-gray-200">
        @error('importFile')
            <div class="mx-4 mt-4 text-sm text-red-600">{{ $message }}</div>
        @enderror

        <div wire:loading wire:target="importFile" class="mx-4 mt-4 text-sm text-blue-600">
            Mengunggah file...
        </div>

        <div wire:loading wire:target="importExcel" class="mx-4 mt-4 text-sm text-blue-600">
            Mengimpor data Excel...
        </div>

        <table class="w-full text-sm text-left text-gray-700">
            <thead class="text-sm bg-gray-100 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 font-medium">No</th>
                    <th class="px-6 py-3 font-medium">NIK</th>
                    <th class="px-6 py-3 font-medium">Nama</th>
                    <th class="px-6 py-3 font-medium">Email</th>
                    <th class="px-6 py-3 font-medium">No HP</th>
                    <th class="px-6 py-3 font-medium">Jabatan</th>
                    <th class="px-6 py-3 font-medium">Departemen</th>
                    <th class="px-6 py-3 font-medium">Status</th>
                    <th class="px-6 py-3 font-medium text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($employees as $index => $e)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employees->firstItem() + $index }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $e->nik }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $e->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $e->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $e->no_hp }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $e->jabatan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $e->departemen }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $e->status }}</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <button
                                type="button"
                                class="font-medium text-blue-600 hover:underline mr-3"
                                wire:click="edit({{ $e->id }})"
                            >
                                Edit
                            </button>

                            <button
                                type="button"
                                class="font-medium text-red-600 hover:underline"
                                onclick="return confirm('Hapus data ini?')"
                                wire:click="delete({{ $e->id }})"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="px-6 py-4 text-center text-gray-500">
                            Belum ada data
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4">
            {{ $employees->links() }}
        </div>
    </div>
</div>