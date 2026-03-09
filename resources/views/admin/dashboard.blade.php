<x-app-layout>
    <div class="min-h-screen bg-[#f8f9fa]">
        <!-- Template Section -->
        <div class="px-16 py-10 bg-[#f1f3f4] border-b border-gray-200">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-medium text-gray-800">Mulai formulir baru</h2>
                <button class="text-xl text-gray-600 hover:text-gray-800">Galeri template</button>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-5">
                <!-- Form kosong -->
                <a href="{{ route('forms.create') }}" class="group">
                    <div class="flex items-center justify-center h-48 bg-white border border-gray-300 rounded-lg shadow-sm group-hover:shadow-md group-hover:border-purple-400 transition">
                        <div class="text-7xl font-light text-gray-400">+</div>
                    </div>
                    <p class="mt-3 text-xl font-medium text-gray-800">Formulir kosong</p>
                </a>

                <!-- Card template -->
                <div class="group cursor-pointer">
                    <div class="h-48 overflow-hidden border border-gray-300 rounded-lg shadow-sm bg-[#dfe8d8] group-hover:shadow-md">
                        <div class="h-12 bg-green-600"></div>
                        <div class="p-4 space-y-3">
                            <div class="w-2/3 h-3 bg-white rounded"></div>
                            <div class="h-10 bg-white rounded"></div>
                            <div class="h-10 bg-white rounded"></div>
                            <div class="h-10 bg-white rounded"></div>
                        </div>
                    </div>
                    <p class="mt-3 text-xl font-medium text-gray-800">Informasi Kontak</p>
                </div>

                <div class="group cursor-pointer">
                    <div class="h-48 overflow-hidden border border-gray-300 rounded-lg shadow-sm bg-white group-hover:shadow-md">
                        <div class="h-12 bg-gray-200"></div>
                        <div class="p-4 space-y-3">
                            <div class="w-1/2 h-3 bg-gray-200 rounded"></div>
                            <div class="h-8 bg-gray-100 rounded"></div>
                            <div class="h-8 bg-gray-100 rounded"></div>
                            <div class="h-8 bg-gray-100 rounded"></div>
                        </div>
                    </div>
                    <p class="mt-3 text-xl font-medium text-gray-800">RSVP</p>
                </div>

                <div class="group cursor-pointer">
                    <div class="h-48 overflow-hidden border border-gray-300 rounded-lg shadow-sm bg-[#f1ebf5] group-hover:shadow-md">
                        <div class="h-12 bg-purple-100"></div>
                        <div class="p-4 space-y-3">
                            <div class="w-1/2 h-3 bg-white rounded"></div>
                            <div class="h-8 bg-white rounded"></div>
                            <div class="h-8 bg-white rounded"></div>
                            <div class="h-8 bg-white rounded"></div>
                        </div>
                    </div>
                    <p class="mt-3 text-xl font-medium text-gray-800">Undangan Pesta</p>
                </div>

                <div class="group cursor-pointer">
                    <div class="h-48 overflow-hidden border border-gray-300 rounded-lg shadow-sm bg-[#ede7f6] group-hover:shadow-md">
                        <div class="p-4 space-y-3">
                            <div class="w-3/4 h-3 bg-purple-200 rounded"></div>
                            <div class="h-8 bg-white rounded"></div>
                            <div class="h-8 bg-white rounded"></div>
                            <div class="w-1/3 h-3 bg-purple-100 rounded"></div>
                            <div class="h-10 bg-white rounded"></div>
                        </div>
                    </div>
                    <p class="mt-3 text-xl font-medium text-gray-800">Pendaftaran</p>
                </div>
            </div>
        </div>

        <!-- Recent Forms -->
        <div class="px-16 py-10">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-medium text-gray-800">Formulir terbaru</h2>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="flex flex-col items-center justify-center px-6 py-20 text-center">
                    <h3 class="mb-3 text-4xl font-medium text-gray-700">Belum ada formulir</h3>
                    <p class="max-w-2xl text-2xl text-gray-500">
                        Pilih formulir kosong atau pilih template lain di atas untuk memulai
                    </p>

                    <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                        <a href="{{ route('forms.create') }}"
                           class="px-6 py-3 text-white bg-purple-600 rounded-lg hover:bg-purple-700 transition">
                            Buat Form
                        </a>

                        <a href="{{ route('employees.index') }}"
                           class="px-6 py-3 text-purple-700 bg-purple-100 rounded-lg hover:bg-purple-200 transition">
                            Kelola Karyawan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>