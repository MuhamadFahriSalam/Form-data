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

                        <a href="{{ route('forms.respondents', $form->uuid) }}"
                        class="group relative overflow-hidden rounded-[1.75rem] border border-slate-200/70 bg-white/90 p-6 shadow transition duration-300 hover:-translate-y-1.5 hover:shadow-xl">

                            <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-red-500 to-rose-400"></div>

                            <div class="mb-5 flex justify-between items-start">
                                <div class="flex gap-4">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-100 text-red-600">
                                        📄
                                    </div>

                                    <div>
                                        <h3 class="text-lg font-bold text-slate-900">
                                            {{ $form->title }}
                                        </h3>
                                        <p class="text-sm text-slate-500">
                                            {{ $form->created_at->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>

                                <span class="text-xs bg-red-50 text-red-600 px-3 py-1 rounded-full font-semibold">
                                    Ditutup
                                </span>
                            </div>

                            <div class="bg-slate-50 p-4 rounded-2xl text-sm text-slate-600">
                                {{ $form->description ?? '-' }}
                            </div>

                            <div class="mt-5 border rounded-2xl p-4 text-sm bg-white">
                                <div class="flex justify-between border-b pb-2">
                                    <span>Mulai</span>
                                    <span>{{ $form->opens_at ? $form->opens_at->format('d M Y H:i') : '-' }}</span>
                                </div>

                                <div class="flex justify-between pt-2">
                                    <span>Ditutup</span>
                                    <span class="text-red-600">
                                        {{ $form->closes_at ? $form->closes_at->format('d M Y H:i') : '-' }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-5 grid grid-cols-2 gap-3">
                                <div class="bg-slate-50 p-4 rounded-2xl border">
                                    <p class="text-xs">Pengisi</p>
                                    <p class="text-xl font-bold">{{ $form->submissions_count }}</p>
                                </div>

                                <div class="bg-red-50 p-4 rounded-2xl border">
                                    <p class="text-xs text-red-600">Status</p>
                                    <p class="text-sm font-bold text-red-700">
                                        Selesai
                                    </p>
                                </div>
                            </div>

                            <div class="mt-6">
                                <span class="block text-center bg-red-500 text-white py-2.5 rounded-xl text-sm font-semibold">
                                    Lihat Pengisi →
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else

                <div class="text-center py-10 text-slate-500">
                    Belum ada form yang ditutup
                </div>
            @endif
        </div>
    </div>
@endcomponent