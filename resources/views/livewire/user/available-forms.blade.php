@section('title', 'Dashboard User')

<div class="min-h-screen bg-slate-50">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-violet-900 to-indigo-800 shadow-lg">
            <div class="px-6 py-8 sm:px-8 lg:px-10">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                    {{-- LEFT --}}
                    <div>
                        <h1 class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                            Selamat datang
                        </h1>
                        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-200 sm:text-base">
                            Lihat form dan quiz yang tersedia dan isi yang sedang dibuka langsung dari halaman ini.
                        </p>
                    </div>

                    {{-- RIGHT --}}
                    <div class="flex justify-end pr-6 sm:pr-10">
                        
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 max-w-md w-full">

                            {{-- FORM DIBUKA --}}
                            <div class="rounded-2xl border border-white/10 bg-white/10 px-5 py-4 backdrop-blur-sm">
                                <p class="text-xs font-medium uppercase tracking-wide text-slate-200">
                                    Form Dibuka
                                </p>
                                <p class="mt-2 text-2xl font-bold text-white">
                                    {{ $forms->where('status', 'open')->count() }}
                                </p>
                            </div>

                            {{-- QUIZ DIBUKA --}}
                            <div class="rounded-2xl border border-white/10 bg-white/10 px-5 py-4 backdrop-blur-sm">
                                <p class="text-xs font-medium uppercase tracking-wide text-slate-200">
                                    Quiz Dibuka
                                </p>
                                <p class="mt-2 text-2xl font-bold text-white">
                                    {{ $quizzes->where(function($q){
                                        return (!$q->start_at || $q->start_at <= now()) &&
                                            (!$q->end_at || $q->end_at >= now());
                                    })->count() }}
                                </p>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- Section --}}
        <div class="mt-8">

            {{-- Header & Filter --}}
            <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                {{-- Title --}}
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                        Form Tersedia
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Lihat form yang sedang dibuka untuk diisi. Form yang belum dibuka atau sudah ditutup tidak akan muncul di sini.
                    </p>
                </div>

                {{-- Filter Button --}}
                <div class="flex flex-wrap gap-2">

                    <button 
                        wire:click="$set('filter','all')"
                        class="px-4 py-2 rounded-xl border transition 
                        {{ $filter=='all' ? 'bg-violet-600 text-white border-violet-600' : 'bg-white text-slate-700 hover:bg-slate-100' }}">
                        Semua
                    </button>

                    <button 
                        wire:click="$set('filter','filled')"
                        class="px-4 py-2 rounded-xl border transition 
                        {{ $filter=='filled' ? 'bg-green-600 text-white border-green-600' : 'bg-white text-slate-700 hover:bg-slate-100' }}">
                        Sudah Diisi
                    </button>

                    <button 
                        wire:click="$set('filter','empty')"
                        class="px-4 py-2 rounded-xl border transition 
                        {{ $filter=='empty' ? 'bg-red-600 text-white border-red-600' : 'bg-white text-slate-700 hover:bg-slate-100' }}">
                        Belum Diisi
                    </button>
                </div>
            </div>
        </div>

            {{-- Form List --}} 
            @if ($forms->count())
                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($forms as $form)
                        <div class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                            <div class="h-2 bg-gradient-to-r from-violet-500 via-indigo-500 to-blue-500"></div>

                            <div class="flex h-full flex-col p-6">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <h3 class="text-lg font-semibold leading-6 text-slate-900 transition group-hover:text-violet-700">
                                            {{ $form->title }}
                                        </h3>
                                    </div>

                                    @if ($form->status === 'upcoming')
                                        <span class="shrink-0 rounded-full border border-yellow-200 bg-yellow-50 px-3 py-1 text-xs font-semibold text-yellow-700">
                                            Belum Dibuka
                                        </span>
                                    @elseif ($form->status === 'closed')
                                        <span class="shrink-0 rounded-full border border-red-200 bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                                            Sudah Ditutup
                                        </span>
                                    @else
                                        <span class="shrink-0 rounded-full border border-green-200 bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">
                                            Aktif
                                        </span>
                                    @endif
                                </div>

                                <p class="mt-4 text-sm leading-6 text-slate-500">
                                    {{ $form->description ?: 'Tidak ada deskripsi.' }}
                                </p>

                                <div class="mt-5 space-y-3 rounded-2xl bg-slate-50 p-4">
                                    <div class="flex items-center justify-between gap-4 text-sm">
                                        <span class="font-medium text-slate-600">Mulai</span>
                                        <span class="text-right text-slate-500">
                                            {{ $form->opens_at ? $form->opens_at->format('d M Y H:i') : '-' }}
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between gap-4 text-sm">
                                        <span class="font-medium text-slate-600">Batas akhir</span>
                                        <span class="text-right text-slate-500">
                                            {{ $form->closes_at ? $form->closes_at->format('d M Y H:i') : '-' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-6 pt-2">
                                    @if ($form->status === 'open')
                                        <a
                                            href="{{ route('forms.show', $form->uuid) }}"
                                            class="inline-flex w-full items-center justify-center rounded-2xl bg-violet-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-violet-700 focus:outline-none focus:ring-4 focus:ring-violet-200"
                                        >
                                            Isi Form
                                        </a>
                                    @elseif ($form->status === 'upcoming')
                                        <button
                                            type="button"
                                            disabled
                                            class="inline-flex w-full cursor-not-allowed items-center justify-center rounded-2xl bg-yellow-500 px-4 py-3 text-sm font-semibold text-white opacity-80"
                                        >
                                            Belum Dibuka
                                        </button>
                                    @else
                                        <button
                                            type="button"
                                            disabled
                                            class="inline-flex w-full cursor-not-allowed items-center justify-center rounded-2xl bg-red-500 px-4 py-3 text-sm font-semibold text-white opacity-80"
                                        >
                                            Sudah Ditutup
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center rounded-3xl border border-slate-200 bg-white px-6 py-14 text-center shadow-sm">
                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-2xl">
                        📄
                    </div>

                    <h3 class="text-lg font-semibold text-slate-800">
                        Belum ada form tersedia
                    </h3>

                    <p class="mt-2 max-w-md text-sm leading-6 text-slate-500">
                        Form akan muncul di sini ketika admin membuat form baru dan membukanya untuk user.
                    </p>
                </div>
            @endif
        </div>

        {{-- ================= QUIZ SECTION ================= --}}
        <div class="mt-12">

            {{-- 🔥 Container disatukan (judul + card) --}}
            <div class="mx-auto max-w-6xl px-2">

                {{-- Header --}}
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-slate-900">
                        Quiz Tersedia
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Kerjakan quiz yang tersedia untuk evaluasi atau psikotes.
                    </p>
                </div>

                @if ($quizzes->count())

                    {{-- Grid Quiz --}}
                    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($quizzes as $quiz)

                            @php
                                $now = now();
                                $status = 'active';

                                if ($quiz->start_at && $now->lt($quiz->start_at)) {
                                    $status = 'upcoming';
                                } elseif ($quiz->end_at && $now->gt($quiz->end_at)) {
                                    $status = 'ended';
                                }
                            @endphp

                            <div class="group flex flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

                                {{-- Top Gradient --}}
                                <div class="h-2 bg-gradient-to-r from-indigo-500 to-purple-500"></div>

                                {{-- Content --}}
                                <div class="p-6 flex flex-col flex-1">

                                    {{-- Title --}}
                                    <h3 class="text-lg font-semibold text-slate-900 line-clamp-2">
                                        {{ $quiz->title }}
                                    </h3>

                                    {{-- Description --}}
                                    <p class="mt-2 text-sm text-slate-500 line-clamp-3">
                                        {{ $quiz->description ?? 'Tidak ada deskripsi.' }}
                                    </p>

                                    {{-- Info --}}
                                    <div class="mt-4 space-y-1 text-xs text-slate-500">
                                        <p>📌 Soal: {{ $quiz->questions->count() }}</p>

                                        @if ($quiz->start_at)
                                            <p>🟢 Mulai: {{ \Carbon\Carbon::parse($quiz->start_at)->format('d M Y H:i') }}</p>
                                        @endif

                                        @if ($quiz->end_at)
                                            <p>🔴 Deadline: {{ \Carbon\Carbon::parse($quiz->end_at)->format('d M Y H:i') }}</p>
                                        @endif
                                    </div>

                                    {{-- Status (TANPA ENDED 🔥) --}}
                                    @php
                                        $now = now();
                                        $isUpcoming = $quiz->start_at && $now->lt($quiz->start_at);
                                    @endphp

                                    <div class="mt-4">
                                        @if ($isUpcoming)
                                            <span class="inline-block rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-600">
                                                Belum Dimulai
                                            </span>
                                        @else
                                            <span class="inline-block rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-600">
                                                Aktif
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Button --}}
                                    <div class="mt-auto pt-4">
                                        @if ($isUpcoming)
                                            <button
                                                disabled
                                                class="w-full rounded-2xl bg-gray-300 px-4 py-3 text-sm font-semibold text-white cursor-not-allowed"
                                            >
                                                Belum Tersedia
                                            </button>
                                        @else
                                            <a
                                                href="{{ route('quiz.play', $quiz->uuid) }}"
                                                class="inline-flex w-full justify-center rounded-2xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200"
                                            >
                                                Kerjakan Quiz
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                @else
                    <div class="rounded-2xl bg-white border p-6 text-center text-slate-500">
                        Belum ada quiz tersedia.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>