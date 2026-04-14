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

                    <a href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center gap-2 rounded-2xl border border-white/15 bg-white/10 px-5 py-3 text-sm font-semibold text-white backdrop-blur-md hover:bg-white/20 transition">
                        ← Kembali
                    </a>
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

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">

                @foreach ($closedQuiz as $quiz)

                <!-- CARD -->
                <a href="{{ route('quiz.results', $quiz->uuid) }}"
                   class="group relative overflow-hidden rounded-[1.75rem] border border-slate-200/70 bg-white/90 p-6 shadow transition duration-300 hover:-translate-y-1.5 hover:shadow-xl">

                    <!-- TOP LINE -->
                    <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-fuchsia-500 to-violet-400"></div>

                    <!-- HEADER -->
                    <div class="mb-5 flex justify-between items-start">

                        <div class="flex gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-violet-100 to-fuchsia-100 text-violet-600">
                                🎯
                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-violet-700 transition">
                                    {{ $quiz->title }}
                                </h3>

                                <p class="text-sm text-slate-500">
                                    Dibuat {{ $quiz->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>

                        <span class="text-xs bg-red-50 text-red-600 px-3 py-1 rounded-full font-semibold">
                            Ditutup
                        </span>

                    </div>

                    <!-- DESC -->
                    <div class="bg-slate-50 p-4 rounded-2xl text-sm text-slate-600">
                        {{ $quiz->description ?: 'Tidak ada deskripsi quiz.' }}
                    </div>

                    <!-- INFO -->
                    <div class="mt-5 border rounded-2xl p-4 text-sm bg-white">

                        <div class="flex justify-between border-b pb-2">
                            <span class="text-slate-500">Mulai</span>
                            <span class="font-semibold">
                                {{ $quiz->start_at ? \Carbon\Carbon::parse($quiz->start_at)->format('d M Y H:i') : '-' }}
                            </span>
                        </div>

                        <div class="flex justify-between pt-2">
                            <span class="text-slate-500">Ditutup</span>
                            <span class="text-red-600 font-semibold">
                                {{ $quiz->end_at ? \Carbon\Carbon::parse($quiz->end_at)->format('d M Y H:i') : '-' }}
                            </span>
                        </div>

                    </div>

                    <!-- STATS -->
                    <div class="mt-5 grid grid-cols-2 gap-3">

                        <div class="bg-slate-50 p-4 rounded-2xl border">
                            <p class="text-xs text-slate-500 uppercase">Soal</p>
                            <p class="text-xl font-bold">{{ $quiz->questions_count }}</p>
                        </div>

                        <div class="bg-violet-50 p-4 rounded-2xl border border-violet-100">
                            <p class="text-xs text-violet-600 uppercase">Status</p>
                            <p class="text-sm font-bold text-violet-700">
                                Selesai
                            </p>
                        </div>

                    </div>

                    <!-- ACTION -->
                    <div class="mt-6">
                        <span class="block text-center bg-gradient-to-r from-violet-600 to-fuchsia-500 text-white py-2.5 rounded-xl text-sm font-semibold">
                            Lihat Hasil →
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
        @else

        <!-- EMPTY -->
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