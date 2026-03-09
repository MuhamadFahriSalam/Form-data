<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-slate-50 via-white to-slate-100">
        <div class="max-w-7xl mx-auto px-6 py-8">
            <!-- Header -->
            <div class="mb-8">
                <p class="mt-2 text-slate-500">
                    Silakan isi form yang tersedia.
                </p>
            </div>

            <!-- Card Section -->
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <!-- Form Card -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition overflow-hidden">
                    <div class="bg-gradient-to-r from-violet-500 to-indigo-500 h-2"></div>
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-slate-800">
                            Form Penilaian
                        </h2>
                        <p class="text-sm text-slate-500 mt-2">
                            Silakan isi form yang telah disediakan oleh admin.
                        </p>
                        <div class="mt-5">
                            <a href="#"
                               class="inline-flex items-center rounded-xl bg-violet-600 text-white px-4 py-2 text-sm font-medium hover:bg-violet-700 transition shadow-sm">
                                Isi Form
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Placeholder jika belum ada form -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 flex flex-col items-center justify-center text-center">
                    <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-slate-100 mb-3">
                        📄
                    </div>
                    <h3 class="text-sm font-semibold text-slate-700">
                        Belum ada form
                    </h3>
                    <p class="text-xs text-slate-500 mt-1">
                        Form akan muncul di sini ketika admin membuatnya.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>