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

        {{-- ================= FORM SECTION ================= --}}
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

            {{-- Form List --}}
            @if ($forms->count())

                <div class="flex gap-4 px-1 sm:px-0 overflow-x-auto pb-4 snap-x snap-mandatory scroll-smooth">

                    @foreach ($forms as $form)

                    {{-- LOGIKA FILTERING: pertama filter berdasarkan status (upcoming, active, closed), lalu filter berdasarkan apakah sudah diisi atau belum (filled, empty) --}}
                    @php
                        $hasFilled = $form->submissions
                            ->where('user_id', auth()->id())
                            ->count() > 0;
                    @endphp

                    {{--  WRAPPER --}}
                    <div x-data="{ openModal: false }"
                        class="min-w-[100%] sm:min-w-[260px] sm:max-w-[300px] flex-shrink-0 snap-center">

                        <div class="group relative overflow-hidden rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

                            {{-- TOP GRADIENT --}}
                            <div class="absolute inset-x-0 top-0 h-2 bg-gradient-to-r from-indigo-500 to-purple-500"></div>

                            {{-- HEADER --}}
                            <div class="mb-4 flex items-start justify-between">

                                <div class="pr-2">
                                    <h3 class="line-clamp-1 text-base font-semibold text-slate-900">
                                        {{ $form->title }}
                                    </h3>
                                </div>

                                {{-- STATUS --}}
                                @if ($form->status === 'upcoming')
                                    <span class="whitespace-nowrap rounded-full bg-yellow-100 px-3 py-1 text-[11px] text-yellow-700">
                                        Belum Dibuka
                                    </span>
                                @elseif ($form->status === 'closed')
                                    <span class="whitespace-nowrap rounded-full bg-red-100 px-3 py-1 text-[11px] text-red-700">
                                        Ditutup
                                    </span>
                                @else
                                    <span class="whitespace-nowrap rounded-full bg-emerald-100 px-3 py-1 text-[11px] text-emerald-700">
                                        Aktif
                                    </span>
                                @endif

                            </div>

                            {{-- DESKRIPSI --}}
                            <p class="mb-4 line-clamp-2 text-sm text-slate-500">
                                {{ $form->description ?: 'Tidak ada deskripsi.' }}
                            </p>

                            {{-- INFO --}}
                            <div class="space-y-2 rounded-xl bg-slate-50 p-3 text-xs text-slate-500">

                                <div class="flex justify-between">
                                    <span>Mulai</span>
                                    <span>
                                        {{ $form->opens_at ? $form->opens_at->format('d M Y') : '-' }}
                                    </span>
                                </div>

                                <div class="flex justify-between">
                                    <span>Selesai</span>
                                    <span>
                                        {{ $form->closes_at ? $form->closes_at->format('d M Y') : '-' }}
                                    </span>
                                </div>
                            </div>

                            {{-- BUTTONS --}}
                            <div class="mt-5">

                                @if ($form->status === 'open')

                                    @if ($hasFilled)
                                        <button @click="openModal = true"
                                            class="block w-full rounded-xl bg-indigo-600 py-2.5 text-center text-sm font-semibold text-white transition hover:bg-indigo-700">
                                            Isi Kembali
                                        </button>
                                    @else
                                        <button @click="openModal = true"
                                            class="block w-full rounded-xl bg-indigo-600 py-2.5 text-center text-sm font-semibold text-white transition hover:bg-indigo-700">
                                            Isi Form
                                        </button>
                                    @endif

                                @elseif ($form->status === 'upcoming')
                                    <button disabled
                                        class="w-full rounded-xl bg-yellow-500 py-2.5 text-sm font-semibold text-white opacity-80">
                                        Belum Dibuka
                                    </button>

                                @else
                                    <button disabled
                                        class="w-full rounded-xl bg-red-500 py-2.5 text-sm font-semibold text-white opacity-80">
                                        Sudah Ditutup
                                    </button>
                                @endif
                            </div>
                        </div>

                        {{-- MODAL --}}
                        <div x-cloak x-show="openModal" x-transition.scale
                            class="fixed inset-0 z-50 flex items-center justify-center px-4 bg-black/20 backdrop-blur-md">

                            <div @click.outside="openModal = false"
                                class="w-full max-w-sm rounded-2xl bg-white p-4 shadow-xl sm:max-w-md sm:p-6">

                                <h2 class="mb-2 text-base font-bold sm:text-lg">
                                    ⚠️ Perhatian
                                </h2>

                                <p class="mb-3 text-sm">
                                    Sebelum mengisi form, harap baca instruksi dengan teliti.
                                </p>

                                <ul class="mb-4 list-disc space-y-1 pl-5 text-sm">
                                    <li>Pastikan data yang diisi sudah benar</li>
                                    <li>Form bisa diisi tiga kali</li>
                                    <li>Periksa kembali sebelum submit</li>
                                </ul>

                                <div class="flex flex-col gap-2 sm:flex-row sm:justify-end">
                                    <button @click="openModal = false"
                                        class="w-full rounded-xl bg-gray-200 px-4 py-2 sm:w-auto">
                                        Batal
                                    </button>

                                    <a href="{{ route('forms.show', $form->uuid) }}"
                                        class="w-full rounded-xl bg-violet-600 px-4 py-2 text-center text-white sm:w-auto">
                                        Lanjutkan
                                    </a>
                                </div>
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

                    <p class="mt-2 max-w-md text-sm text-slate-500">
                        Form akan muncul di sini ketika admin membuat form baru.
                    </p>
                </div>
            @endif
        </div>

        {{-- ================= QUIZ SECTION ================= --}}
        <div class="mt-12">

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

                {{-- List Quiz --}}
                {{-- ✅ LOGIKA FILTERING: pertama filter berdasarkan status (upcoming, active, ended), lalu filter berdasarkan apakah sudah diisi atau belum (filled, empty) --}}
                @php
                    $filteredQuizzes = $quizzes->filter(function ($quiz) use ($filter) {

                        $now = now();

                        // skip kalau sudah selesai
                        if ($quiz->end_at && $now->gt($quiz->end_at)) {
                            return false;
                        }

                        $hasAttempt = $quiz->attempts->isNotEmpty();

                        if ($filter === 'filled') {
                            return $hasAttempt;
                        }

                        if ($filter === 'empty') {
                            return !$hasAttempt;
                        }

                        return true;
                    });
                @endphp
                
                @if ($filteredQuizzes->count())

                    <div class="flex gap-4 px-1 sm:px-0 overflow-x-auto pb-4 snap-x snap-mandatory scroll-smooth">

                    @foreach ($filteredQuizzes as $quiz)

                            {{-- LOGIKA STATUS QUIZ: upcoming kalau start_at > now, ended kalau end_at < now, active kalau start_at <= now <= end_at (atau kalau start_at/end_at null) --}}
                            @php
                                $now = now();
                                $status = 'active';

                                if ($quiz->start_at && $now->lt($quiz->start_at)) {
                                    $status = 'upcoming';
                                } elseif ($quiz->end_at && $now->gt($quiz->end_at)) {
                                    $status = 'ended';
                                }

                                $isUpcoming = $quiz->start_at && $now->lt($quiz->start_at);

                                // ✅ PINDAHKAN KE SINI (TIDAK NESTED)
                                $attempt = $quiz->attempts->first();
                                $hasAttempt = $attempt !== null;
                            @endphp

                            {{-- WRAPPER --}}
                            <div x-data="{ openModal: false }"
                                class="min-w-[100%] sm:min-w-[260px] sm:max-w-[300px] flex-shrink-0 snap-center">

                                <div class="group relative flex flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

                                    {{-- Top Gradient --}}
                                    <div class="h-2 bg-gradient-to-r from-indigo-500 to-purple-500"></div>

                                    {{-- STATUS --}}
                                    <div class="absolute top-4 right-4">
                                        @if ($isUpcoming)
                                            <span
                                                class="inline-block rounded-full bg-yellow-100 px-3 py-1 text-[11px] font-medium text-yellow-600 shadow">
                                                Belum Dimulai
                                            </span>
                                        @elseif ($status === 'ended')
                                            <span
                                                class="inline-block rounded-full bg-red-100 px-3 py-1 text-[11px] font-medium text-red-600 shadow">
                                                Selesai
                                            </span>
                                        @else
                                            <span
                                                class="inline-block rounded-full bg-green-100 px-3 py-1 text-[11px] font-medium text-green-600 shadow">
                                                Aktif
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Content --}}
                                    <div class="p-6 flex flex-col flex-1">

                                        {{-- Title --}}
                                        <h3 class="text-lg font-semibold text-slate-900 line-clamp-2 pr-16">
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
                                                <p>🟢 Mulai:
                                                    {{ \Carbon\Carbon::parse($quiz->start_at)->format('d M Y H:i') }}</p>
                                            @endif

                                            @if ($quiz->end_at)
                                                <p>🔴 Deadline:
                                                    {{ \Carbon\Carbon::parse($quiz->end_at)->format('d M Y H:i') }}</p>
                                            @endif
                                        </div>

                                        {{-- Button --}}
                                        <div class="mt-auto pt-4">
                                            @if ($isUpcoming)
                                                <button disabled
                                                    class="w-full rounded-xl bg-gray-300 py-2.5 text-sm font-semibold text-white cursor-not-allowed">
                                                    Belum Tersedia
                                                </button>

                                            @elseif ($status === 'ended')
                                                <button disabled
                                                    class="w-full rounded-xl bg-red-500 py-2.5 text-sm font-semibold text-white cursor-not-allowed">
                                                    Sudah Selesai
                                                </button>

                                            @else
                                                @if ($hasAttempt)
                                                    <a href="{{ route('quiz.play', $quiz->uuid) }}"
                                                        class="block w-full rounded-xl bg-indigo-600 py-2.5 text-center text-sm font-semibold text-white transition hover:bg-indigo-700">
                                                        📊 Lihat Score
                                                    </a>
                                                @else
                                                    <button @click="openModal = true"
                                                        class="w-full rounded-xl bg-indigo-600 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
                                                        Kerjakan Quiz
                                                    </button>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- MODAL --}}
                                <div x-cloak x-show="openModal" x-transition.scale
                                    class="fixed inset-0 z-50 flex items-center justify-center px-4 bg-black/20 backdrop-blur-md">

                                    <div @click.outside="openModal = false"
                                        class="bg-white rounded-2xl p-4 sm:p-6 w-full max-w-sm sm:max-w-md shadow-xl">

                                        <h2 class="text-base sm:text-lg font-bold mb-2">
                                            ⚠️ Perhatian
                                        </h2>

                                        <p class="text-sm mb-3">
                                            Sebelum mengerjakan quiz, harap baca instruksi dengan teliti.
                                        </p>

                                        <ul class="text-sm list-disc pl-5 mb-4 space-y-1">
                                            <li>Quiz hanya bisa dikerjakan sekali</li>
                                            <li>Jawaban tidak bisa diubah setelah submit</li>
                                        </ul>

                                        <div class="flex flex-col sm:flex-row gap-2 sm:justify-end">
                                            <button @click="openModal = false"
                                                class="w-full sm:w-auto px-4 py-2 bg-gray-200 rounded-xl">
                                                Batal
                                            </button>

                                            <a href="{{ route('quiz.play', $quiz->uuid) }}"
                                                class="w-full sm:w-auto text-center px-4 py-2 bg-indigo-600 text-white rounded-xl">
                                                Lanjutkan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                @else
                    <div
                        class="flex flex-col items-center justify-center rounded-3xl border border-slate-200 bg-white px-6 py-14 text-center shadow-sm">
                        <div
                            class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-2xl">
                            📄
                        </div>

                        <h3 class="text-lg font-semibold text-slate-800">
                            Belum ada quiz tersedia
                        </h3>

                        <p class="mt-2 max-w-md text-sm text-slate-500">
                            Quiz akan muncul di sini ketika admin membuat quiz baru.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>