@component('layouts.app', ['title' => 'Quiz Ditutup'])

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-violet-50">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        <!-- HEADER (SAMA STYLE FORM 🔥) -->
        <div class="relative mb-8 overflow-hidden rounded-[2rem] border border-white/20 bg-gradient-to-r from-slate-950 via-slate-900 to-violet-900 shadow-[0_20px_70px_rgba(15,23,42,0.18)]">

            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.16),transparent_30%)]"></div>
            <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-violet-500/20 blur-3xl"></div>
            <div class="absolute -bottom-20 left-0 h-52 w-52 rounded-full bg-fuchsia-500/10 blur-3xl"></div>

            <div class="relative px-6 py-8 sm:px-8 lg:px-10">

                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                    <div class="max-w-2xl">
                        <h1 class="mt-4 text-3xl font-bold text-white sm:text-4xl lg:text-5xl">
                            Quiz yang Sudah Ditutup
                        </h1>

                        <p class="mt-3 text-sm text-slate-200 sm:text-base">
                            Daftar quiz yang telah melewati batas waktu pengerjaan.
                        </p>
                    </div>

                    <!-- BACK TO DASHBOARD -->
                    <div>
                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl 
                                bg-white/10 text-white font-semibold text-sm
                                border border-white/20 backdrop-blur-md
                                transition duration-300
                                hover:bg-white/20 hover:-translate-y-0.5"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                class="h-4 w-4 text-white"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" 
                                    d="M15 19l-7-7 7-7" />
                            </svg>

                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- TITLE + COUNT -->
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">

            <div>
                <h2 class="text-2xl font-bold text-slate-900 sm:text-3xl">
                    Riwayat Quiz Ditutup
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Semua quiz yang sudah berakhir.
                </p>
            </div>

            <div class="inline-flex items-center gap-2 rounded-2xl border border-purple-100 bg-white px-4 py-2 text-sm shadow-sm">
                <span class="h-2.5 w-2.5 rounded-full bg-purple-500"></span>
                <span class="font-medium text-slate-600">Total:</span>
                <span class="font-bold text-slate-900">{{ $closedQuiz->count() }} quiz</span>
            </div>
        </div>

        <!-- LIST QUIZ -->
        @if ($closedQuiz->count())

            <div class="flex gap-6 overflow-x-auto pb-4 snap-x snap-mandatory scroll-smooth">

                @foreach ($closedQuiz as $quiz)

                <a href="{{ route('quiz.results', $quiz->uuid) }}"
                class="min-w-[320px] max-w-[320px] h-[420px] flex-shrink-0 snap-start
                        flex flex-col justify-between
                        group relative overflow-hidden rounded-[1.75rem]
                        border border-slate-200/70 bg-white/90 p-6 shadow
                        transition duration-300 hover:-translate-y-1.5 hover:shadow-xl">

                    <!-- TOP LINE -->
                    <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-fuchsia-500 to-violet-400"></div>

                    <!-- CONTENT ATAS -->
                    <div>

                        <!-- HEADER -->
                        <div class="mb-4 flex justify-between items-start">

                            <div class="flex gap-3">
                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-violet-100 to-fuchsia-100 text-violet-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                        class="h-5 w-5"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M9 12h6M9 16h4M7 4h7l5 5v11a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M15 3v6h6" />
                                    </svg>
                                </div>

                                <div>
                                    <h3 class="text-base font-bold text-slate-900 line-clamp-2 group-hover:text-violet-700 transition">
                                        {{ $quiz->title }}
                                    </h3>

                                    <p class="text-xs text-slate-500">
                                        {{ $quiz->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>

                            <span class="text-xs bg-red-50 text-red-600 px-2 py-1 rounded-full font-semibold">
                                Ditutup
                            </span>

                        </div>

                        <!-- DESC -->
                        <div class="bg-slate-50 p-3 rounded-xl text-xs text-slate-600 line-clamp-2">
                            {{ $quiz->description ?: 'Tidak ada deskripsi quiz.' }}
                        </div>

                        <!-- INFO -->
                        <div class="mt-4 border rounded-xl p-3 text-xs bg-white">

                            <div class="flex justify-between border-b pb-1">
                                <span>Mulai</span>
                                <span>
                                    {{ $quiz->start_at ? \Carbon\Carbon::parse($quiz->start_at)->format('d M Y H:i') : '-' }}
                                </span>
                            </div>

                            <div class="flex justify-between pt-1">
                                <span>Ditutup</span>
                                <span class="text-red-600">
                                    {{ $quiz->end_at ? \Carbon\Carbon::parse($quiz->end_at)->format('d M Y H:i') : '-' }}
                                </span>
                            </div>
                        </div>

                        <!-- STATS -->
                        <div class="mt-4 grid grid-cols-2 gap-2">

                            <div class="bg-slate-50 p-3 rounded-xl border">
                                <p class="text-[11px]">Soal</p>
                                <p class="text-lg font-bold">{{ $quiz->questions_count }}</p>
                            </div>

                            <div class="bg-violet-50 p-3 rounded-xl border border-violet-100">
                                <p class="text-[11px] text-violet-600">Status</p>
                                <p class="text-xs font-bold text-violet-700">
                                    Selesai
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- BUTTON (PASTI RATA BAWAH) -->
                    <div class="mt-4">
                        <span class="block text-center bg-gradient-to-r from-violet-600 to-fuchsia-500 text-white py-2 rounded-xl text-sm font-semibold">
                            Lihat Hasil →
                        </span>
                    </div>
                </a>
                @endforeach
            </div>

        @else
            <div class="text-center py-20 bg-white rounded-3xl shadow">
                <h3 class="text-2xl font-bold text-slate-800">
                    Belum ada quiz ditutup
                </h3>
                <p class="text-slate-500 mt-2">
                    Quiz yang selesai akan muncul di sini.
                </p>
            </div>
        @endif
    </div>
</div>
@endcomponent