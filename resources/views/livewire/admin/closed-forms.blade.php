@component('layouts.app', ['title' => 'Form Ditutup'])

    {{-- Halaman ini menampilkan daftar form yang sudah melewati batas waktu pengisian (closes_at) dan tidak lagi dapat diisi oleh user. Admin dapat melihat detail form, jumlah pengisi, serta daftar responden yang sudah mengisi form tersebut. --}}
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-rose-50">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

            <div class="relative mb-8 overflow-hidden rounded-[2rem] border border-white/20 bg-gradient-to-r from-slate-950 via-slate-900 to-rose-900 shadow-[0_20px_70px_rgba(15,23,42,0.18)]">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.16),transparent_30%)]"></div>
                <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-rose-500/20 blur-3xl"></div>
                <div class="absolute -bottom-20 left-0 h-52 w-52 rounded-full bg-red-500/10 blur-3xl"></div>

                <div class="relative px-6 py-8 sm:px-8 lg:px-10">
                    <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                        <div class="max-w-2xl">
                            <h1 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl lg:text-5xl">
                                Form yang Sudah Ditutup
                            </h1>

                            <p class="mt-3 text-sm leading-7 text-slate-200 sm:text-base">
                                Daftar form yang masa pengisiannya telah berakhir dan tidak lagi dapat diisi oleh user.
                            </p>
                        </div>

                        <div>
                            <a
                                href="{{ route('admin.dashboard') }}"
                                class="inline-flex items-center gap-2 rounded-2xl border border-white/15 bg-white/10 px-5 py-3 text-sm font-semibold text-white backdrop-blur-md transition duration-300 hover:-translate-y-0.5 hover:bg-white/20"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19l-7-7 7-7" />
                                </svg>
                                Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                        Riwayat Form Ditutup
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Menampilkan seluruh form yang telah melewati batas waktu pengisian.
                    </p>
                </div>

                <div class="inline-flex w-fit items-center gap-2 rounded-2xl border border-red-100 bg-white px-4 py-2 text-sm shadow-sm">
                    <span class="inline-flex h-2.5 w-2.5 rounded-full bg-red-500"></span>
                    <span class="font-medium text-slate-600">Total:</span>
                    <span class="font-bold text-slate-900">{{ $closedForms->count() }} form</span>
                </div>
            </div>

            {{-- Daftar form yang sudah ditutup --}}
            @if ($closedForms->count())
                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($closedForms as $form)
                        <div class="group relative overflow-hidden rounded-[1.75rem] border border-slate-200/70 bg-white/90 p-6 shadow-[0_10px_30px_rgba(15,23,42,0.06)] backdrop-blur-sm transition duration-300 hover:-translate-y-1.5 hover:shadow-[0_18px_50px_rgba(15,23,42,0.10)]">
                            <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-red-500 via-rose-500 to-orange-400"></div>

                            <div class="mb-5 flex items-start justify-between gap-4">
                                <div class="flex items-start gap-4">
                                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-red-100 to-rose-100 text-red-600 shadow-inner">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 12H6" />
                                        </svg>
                                    </div>

                                    <div class="min-w-0">
                                        <h3 class="line-clamp-2 text-lg font-bold tracking-tight text-slate-900 transition group-hover:text-red-700">
                                            {{ $form->title }}
                                        </h3>
                                        <p class="mt-1 text-sm text-slate-500">
                                            Dibuat {{ $form->created_at->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>

                                <span class="shrink-0 rounded-full border border-red-200 bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                                    Ditutup
                                </span>
                            </div>

                            <div class="rounded-2xl bg-slate-50/80 p-4">
                                <p class="text-sm leading-6 text-slate-600">
                                    {{ $form->description ?: 'Tidak ada deskripsi untuk form ini.' }}
                                </p>
                            </div>

                            <div class="mt-5 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                                <div class="flex items-center justify-between gap-4 border-b border-slate-100 pb-3 text-sm">
                                    <span class="font-medium text-slate-600">Mulai</span>
                                    <span class="text-right font-semibold text-slate-800">
                                        {{ $form->opens_at ? $form->opens_at->format('d M Y H:i') : '-' }}
                                    </span>
                                </div>

                                <div class="flex items-center justify-between gap-4 pt-3 text-sm">
                                    <span class="font-medium text-slate-600">Ditutup</span>
                                    <span class="text-right font-semibold text-red-600">
                                        {{ $form->closes_at ? $form->closes_at->format('d M Y H:i') : '-' }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-5 grid grid-cols-2 gap-3">
                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                    <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-500">
                                        Total Pengisi
                                    </p>
                                    <p class="mt-2 text-2xl font-bold text-slate-900">
                                        {{ $form->submissions_count ?? 0 }}
                                    </p>
                                </div>

                                <div class="rounded-2xl border border-red-100 bg-gradient-to-br from-red-50 to-rose-50 p-4">
                                    <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-red-600">
                                        Status
                                    </p>
                                    <p class="mt-2 text-sm font-bold text-red-700">
                                        Pengisian Selesai
                                    </p>
                                </div>
                            </div>

                            <div class="mt-6 flex flex-wrap gap-3">
                                <a
                                    href="{{ route('forms.respondents', ['form' => $form->uuid]) }}"
                                    class="inline-flex items-center gap-2 rounded-2xl border border-sky-200 bg-sky-50 px-4 py-2.5 text-sm font-semibold text-sky-700 transition duration-300 hover:border-sky-300 hover:bg-sky-100"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12H9m12 0A9 9 0 1112 3a9 9 0 019 9z" />
                                    </svg>
                                    Lihat Pengisi
                                </a>

                                <button
                                    type="button"
                                    disabled
                                    class="inline-flex cursor-not-allowed items-center gap-2 rounded-2xl bg-gradient-to-r from-red-500 to-rose-500 px-4 py-2.5 text-sm font-semibold text-white opacity-80 shadow-sm"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 12H6" />
                                    </svg>
                                    Form Ditutup
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-[0_10px_30px_rgba(15,23,42,0.05)]">
                    <div class="px-6 py-20 text-center sm:px-10 sm:py-24">
                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-gradient-to-br from-red-100 to-rose-100 text-red-600 shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M18 12H6" />
                            </svg>
                        </div>

                        <h3 class="mt-6 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                            Belum ada form yang ditutup
                        </h3>

                        <p class="mx-auto mt-3 max-w-2xl text-base leading-7 text-slate-500 sm:text-lg">
                            Semua form yang sudah melewati masa pengisian akan muncul di halaman ini.
                        </p>

                        <div class="mt-8">
                            <a
                                href="{{ route('admin.dashboard') }}"
                                class="inline-flex items-center gap-2 rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
                            >
                                Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endcomponent