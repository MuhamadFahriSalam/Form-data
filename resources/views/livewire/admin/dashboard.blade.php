
    <div class="min-h-screen bg-gradient-to-b from-slate-50 via-white to-slate-100">
        <!-- Template Section -->
        <section class="border-b border-slate-200/80 bg-white/70 backdrop-blur">
            <div class="mx-auto max-w-7xl px-6 py-10 lg:px-10">
                <div class="mb-8 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold tracking-tight text-slate-900 md:text-3xl">
                            Mulai formulir baru
                        </h2>
                        <p class="mt-1 text-sm text-slate-500">
                            Pilih template untuk mulai lebih cepat
                        </p>
                    </div>

                    <a href="{{ route('forms.create') }}"
                       class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm transition hover:-translate-y-0.5 hover:border-violet-300 hover:text-violet-700 hover:shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Buat Baru
                    </a>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-5">
                    <!-- Form kosong -->
                    <a href="{{ route('forms.create') }}" class="group flex flex-col h-full">
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-violet-300 hover:shadow-xl">
                            <div class="flex h-52 items-center justify-center bg-gradient-to-br from-violet-50 via-white to-fuchsia-50">
                                <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-violet-600 text-5xl font-light text-white shadow-lg shadow-violet-200 transition group-hover:scale-105">
                                    +
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 min-h-[56px]">
                            <p class="text-base font-semibold text-slate-900">Formulir kosong</p>
                            <p class="mt-1 text-sm text-slate-500">Mulai dari halaman kosong</p>
                        </div>
                    </a>

                    <!-- Template 1 -->
                    <div class="group flex flex-col h-full cursor-pointer">
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-emerald-300 hover:shadow-xl">
                            <div class="h-3 bg-gradient-to-r from-emerald-500 to-green-400"></div>
                            <div class="flex h-52 flex-col justify-start bg-gradient-to-br from-emerald-50 to-white p-4">
                                <div class="mb-4 h-3 w-2/3 rounded-full bg-emerald-200"></div>
                                <div class="space-y-3">
                                    <div class="h-10 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                    <div class="h-10 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                    <div class="h-10 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 min-h-[56px]">
                            <p class="text-base font-semibold text-slate-900">Informasi Kontak</p>
                            <p class="mt-1 text-sm text-slate-500">Form sederhana untuk data kontak</p>
                        </div>
                    </div>

                    <!-- Template 2 -->
                    <div class="group flex flex-col h-full cursor-pointer">
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-sky-300 hover:shadow-xl">
                            <div class="h-3 bg-gradient-to-r from-sky-500 to-cyan-400"></div>
                            <div class="flex h-52 flex-col justify-start bg-gradient-to-br from-sky-50 to-white p-4">
                                <div class="mb-4 h-3 w-1/2 rounded-full bg-sky-200"></div>
                                <div class="space-y-3">
                                    <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                    <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                    <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                    <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 min-h-[56px]">
                            <p class="text-base font-semibold text-slate-900">RSVP</p>
                            <p class="mt-1 text-sm text-slate-500">Cocok untuk konfirmasi kehadiran</p>
                        </div>
                    </div>

                    <!-- Template 3 -->
                    <div class="group flex flex-col h-full cursor-pointer">
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-fuchsia-300 hover:shadow-xl">
                            <div class="h-3 bg-gradient-to-r from-fuchsia-500 to-violet-400"></div>
                            <div class="flex h-52 flex-col justify-start bg-gradient-to-br from-fuchsia-50 to-white p-4">
                                <div class="mb-4 h-3 w-1/2 rounded-full bg-fuchsia-200"></div>
                                <div class="space-y-3">
                                    <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                    <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                    <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                    <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 min-h-[56px]">
                            <p class="text-base font-semibold text-slate-900">Undangan Pesta</p>
                            <p class="mt-1 text-sm text-slate-500">Template acara yang lebih menarik</p>
                        </div>
                    </div>

                    <!-- Template 4 -->
                    <div class="group flex flex-col h-full cursor-pointer">
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-amber-300 hover:shadow-xl">
                            <div class="h-3 bg-gradient-to-r from-amber-500 to-orange-400"></div>
                            <div class="flex h-52 flex-col justify-start bg-gradient-to-br from-amber-50 to-white p-4">
                                <div class="mb-4 h-3 w-3/4 rounded-full bg-amber-200"></div>
                                <div class="space-y-3">
                                    <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                    <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                    <div class="h-3 w-1/3 rounded-full bg-amber-100"></div>
                                    <div class="h-10 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 min-h-[56px]">
                            <p class="text-base font-semibold text-slate-900">Pendaftaran</p>
                            <p class="mt-1 text-sm text-slate-500">Untuk registrasi peserta atau user</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Recent Forms -->
<section class="mx-auto max-w-7xl px-6 py-10 lg:px-10">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-semibold tracking-tight text-slate-900 md:text-3xl">
                Formulir terbaru
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Semua form yang baru dibuat akan tampil di sini
            </p>
        </div>
    </div>

    @if ($forms->count() > 0)
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($forms as $form)
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_10px_40px_rgba(15,23,42,0.06)]">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">
                            {{ $form->title }}
                        </h3>

                        <p class="mt-2 text-sm text-slate-500">
                            {{ $form->description ?: 'Tidak ada deskripsi.' }}
                        </p>
                    </div>

                    <div class="mt-4 text-xs text-slate-400">
                        Dibuat: {{ $form->created_at->format('d M Y H:i') }}
                    </div>

                    <div class="mt-6 flex gap-3">
                        <a href="#"
                           class="inline-flex items-center rounded-xl bg-violet-600 px-4 py-2 text-sm font-medium text-white hover:bg-violet-700">
                            Lihat
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-[0_10px_40px_rgba(15,23,42,0.06)]">
            <div class="relative px-6 py-20 text-center sm:px-10 sm:py-24">
                <div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-r from-violet-500/10 via-fuchsia-500/10 to-sky-500/10"></div>

                <div class="relative mx-auto flex h-20 w-20 items-center justify-center rounded-2xl bg-violet-100 text-violet-600 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M19.5 14.25v-8.625a1.125 1.125 0 0 0-1.125-1.125H5.625A1.125 1.125 0 0 0 4.5 5.625v12.75A1.125 1.125 0 0 0 5.625 19.5H12m3-8.25h-6m6 3h-6m3 3h-3m9 1.5 3-3m0 0-3-3m3 3H15" />
                    </svg>
                </div>

                <h3 class="relative mt-6 text-3xl font-semibold tracking-tight text-slate-900 sm:text-4xl">
                    Belum ada formulir
                </h3>

                <p class="relative mx-auto mt-3 max-w-2xl text-base leading-7 text-slate-500 sm:text-lg">
                    Pilih formulir kosong atau gunakan template yang tersedia untuk mulai membuat form admin yang lebih cepat dan rapi.
                </p>

                <div class="relative mt-8 flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('forms.create') }}"
                       class="inline-flex items-center gap-2 rounded-xl bg-violet-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-violet-200 transition duration-200 hover:-translate-y-0.5 hover:bg-violet-700 focus:outline-none focus:ring-4 focus:ring-violet-200">
                        Buat Form
                    </a>

                    <a href="{{ route('employees.index') }}"
                       class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-slate-300 hover:bg-slate-50 hover:text-slate-900 focus:outline-none focus:ring-4 focus:ring-slate-200">
                        Kelola Karyawan
                    </a>
                </div>
            </div>
        </div>
    @endif
</section>
    </div>

