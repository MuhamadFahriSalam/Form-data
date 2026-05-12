
@section('title', $quiz->title)

<div class="min-h-screen bg-slate-50 py-10">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

        {{-- CARD --}}
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

            {{-- HEADER --}}
            <div class="bg-gradient-to-r from-blue-900 via-blue-700 to-slate-900 px-6 py-8 sm:px-8">
                
                <div class="flex items-center justify-between">
                    
                    <!-- KIRI: Judul -->
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
                            {{ $quiz->title }}
                        </h1>

                        <p class="mt-2 text-sm text-emerald-100">
                            Jawab setiap pertanyaan dengan benar
                        </p>
                    </div>

                    <!-- KANAN: Button Kembali -->
                    <div>
                        <a
                            href="{{ route('user.dashboard') }}"
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

                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            {{-- CONTENT --}}
            <div class="px-6 py-8 sm:px-8">

                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

                    {{-- ================= SIDEBAR ================= --}}
                    @if(!$showConfirm)

                        <div class="lg:col-span-1">

                            <div class="sticky top-5 rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">

                                {{-- TITLE --}}
                                <h3 class="text-lg font-bold text-slate-800">
                                    Progress Quiz
                                </h3>

                                {{-- STATS --}}
                                <div class="mt-5">

                                    {{-- HEADER --}}
                                    <div class="flex items-center justify-between mb-2">

                                        <p class="text-sm font-semibold text-slate-700">
                                            Persentase Jawaban
                                        </p>
                                    </div>

                                    {{-- PROGRESS BAR --}}
                                    <div class="w-full h-3 rounded-full bg-slate-200 overflow-hidden">

                                        <div
                                            class="h-full rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 transition-all duration-500"
                                            style="
                                                width: {{ count($quiz->questions) > 0 
                                                    ? ($this->answeredCount / count($quiz->questions)) * 100 
                                                    : 0 
                                                }}%;
                                            "
                                        ></div>
                                    </div>

                                    {{-- PERSEN --}}
                                    <p class="mt-2 text-xs text-slate-500 text-right">

                                        {{ count($quiz->questions) > 0
                                            ? round(($this->answeredCount / count($quiz->questions)) * 100)
                                            : 0
                                        }}% selesai

                                    </p>
                                </div>

                                {{-- NOMOR SOAL --}}
                                <div class="mt-6">

                                    <p class="mb-3 text-sm font-semibold text-slate-700">
                                        Nomor Soal
                                    </p>

                                    <div class="grid grid-cols-5 sm:grid-cols-5 lg:grid-cols-4 gap-3 justify-items-center">

                                        @foreach($quiz->questions as $index => $q)

                                            @php
                                                $answer = $answers[$q->id] ?? null;

                                                $isAnswered = false;

                                                if (is_array($answer)) {
                                                    $isAnswered = count(array_filter($answer)) > 0;
                                                } else {
                                                    $isAnswered = !is_null($answer);
                                                }
                                            @endphp

                                            <button
                                                type="button"
                                                wire:click="goToQuestion({{ $index }})"
                                                class="
                                                    h-10 w-10 rounded-xl text-sm font-bold transition

                                                    {{ $currentQuestion == $index
                                                        ? 'bg-blue-600 text-white shadow-lg scale-105'
                                                        : ($isAnswered
                                                            ? 'bg-green-100 text-green-700 hover:bg-green-200'
                                                            : 'bg-slate-100 text-slate-600 hover:bg-slate-200')
                                                    }}
                                                "
                                            >
                                                {{ $index + 1 }}
                                            </button>

                                        @endforeach

                                    </div>
                                </div>

                                {{-- KETERANGAN --}}
                                <div class="mt-6 space-y-3 border-t border-slate-100 pt-5">

                                    <div class="flex items-center gap-2 text-xs text-slate-600">

                                        <div class="h-3 w-3 rounded bg-blue-600"></div>

                                        <span>Soal aktif</span>
                                    </div>

                                    <div class="flex items-center gap-2 text-xs text-slate-600">

                                        <div class="h-3 w-3 rounded bg-green-200"></div>

                                        <span>Sudah dijawab</span>
                                    </div>

                                    <div class="flex items-center gap-2 text-xs text-slate-600">

                                        <div class="h-3 w-3 rounded bg-slate-200"></div>

                                        <span>Belum dijawab</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- ================= MAIN CONTENT ================= --}}
                    <div class="{{ !$showConfirm ? 'lg:col-span-3' : 'lg:col-span-4' }}">

                        {{-- 🔥 KONFIRMASI ULANG QUIZ --}}
                        @if ($showConfirm)

                            <div class="mb-6 max-w-xl mx-auto">

                                <div class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                                    {{-- ACCENT --}}
                                    <div class="h-2 bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-600"></div>

                                    <div class="p-6 text-center">

                                        {{-- ICON --}}
                                        <div class="flex justify-center mb-4">

                                            <div class="flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 shadow-sm">

                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="w-7 h-7"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="2">

                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                            </div>
                                        </div>

                                        {{-- TITLE --}}
                                        <h2 class="text-lg font-semibold text-slate-900">
                                            Anda sudah mengisi quiz ini
                                        </h2>

                                        {{-- SCORE --}}
                                        @if($hasAttempt)

                                            <div class="mt-5 rounded-2xl bg-slate-50 p-4 border border-slate-200">

                                                <p class="text-sm text-slate-600">
                                                    📊 Total Score Anda
                                                </p>

                                                <p class="text-3xl font-bold text-blue-600 mt-1">
                                                    {{ $totalScore }}
                                                </p>
                                            </div>
                                        @endif

                                        {{-- ACTION --}}
                                        <div class="flex flex-col sm:flex-row justify-center gap-3 mt-6">

                                            <a
                                                href="{{ route('user.dashboard') }}"
                                                class="flex items-center justify-center gap-2 px-5 py-2 rounded-2xl 
                                                bg-slate-100 text-slate-700 font-medium 
                                                hover:bg-slate-200 transition"
                                            >
                                                ← Kembali
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @else

                            {{-- ✅ ADA SOAL --}}
                            @if ($quiz->questions->count() > 0)

                                @php
                                    $question = $quiz->questions[$currentQuestion] ?? null;
                                @endphp

                                @if ($question)

                                    <form wire:submit.prevent="submit">

                                        {{-- QUESTION --}}
                                        <div
                                            wire:key="question-{{ $question->id }}"
                                            class="rounded-2xl border border-slate-200 bg-slate-50 p-5"
                                        >

                                            {{-- HEADER --}}
                                            <div class="flex items-center justify-between mb-4">

                                                <p class="text-sm font-semibold text-slate-800">

                                                    {{ $currentQuestion + 1 }}.
                                                    {{ $question->question }}
                                                </p>
                                            </div>

                                            {{-- MULTIPLE --}}
                                            @if($question->is_multiple)

                                                <span class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded">
                                                    Pilih lebih dari satu jawaban
                                                </span>
                                            @endif

                                            {{-- OPTIONS --}}
                                            <div class="space-y-3 mt-4">

                                                @foreach ($question->options as $option)

                                                    <label class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm cursor-pointer hover:bg-blue-50">

                                                        @if ($question->is_multiple)

                                                            <input
                                                                type="checkbox"
                                                                wire:model="answers.{{ $question->id }}"
                                                                value="{{ $option->id }}"
                                                                class="accent-blue-600"
                                                            >

                                                        @else

                                                            <input
                                                                type="radio"
                                                                name="question_{{ $question->id }}"
                                                                wire:model="answers.{{ $question->id }}"
                                                                value="{{ $option->id }}"
                                                                class="accent-blue-600"
                                                            >
                                                        @endif

                                                        <span>{{ $option->text }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- ACTION --}}
                                        <div class="mt-8 flex flex-col sm:flex-row gap-3 sm:justify-between">

                                            {{-- PREV --}}
                                            <button
                                                type="button"
                                                wire:click="prev"
                                                class="w-full sm:w-auto px-5 py-3 rounded-xl font-medium transition
                                                {{ $currentQuestion == 0
                                                    ? 'bg-gray-200 text-gray-400 cursor-not-allowed'
                                                    : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 shadow-sm' }}"
                                                @if($currentQuestion == 0) disabled @endif
                                            >
                                                Sebelumnya
                                            </button>

                                            {{-- NEXT / SUBMIT --}}
                                            @if($currentQuestion < count($quiz->questions) - 1)

                                                <button
                                                    type="button"
                                                    wire:click="next"
                                                    class="w-full sm:w-auto px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition"
                                                >
                                                    Selanjutnya
                                                </button>

                                            @else

                                                {{-- OPEN MODAL --}}
                                                <button
                                                    type="button"
                                                    wire:click.prevent="openSubmitModal"
                                                    class="w-full sm:w-auto px-5 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl font-semibold shadow-md transition"
                                                >
                                                    Submit Jawaban
                                                </button>
                                            @endif
                                        </div>
                                    </form>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>

                {{-- MODAL SUBMIT --}}
                @if($showSubmitModal)

                    <div
                        wire:ignore.self
                        wire:key="submit-modal"
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm px-4"
                    >

                        <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl border border-slate-200 p-6">

                            {{-- HEADER --}}
                            <div class="flex items-start gap-4">

                                {{-- ICON --}}
                                <div class="flex items-center justify-center w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 shrink-0">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-6 h-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 12l2 2 4-4M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                    </svg>
                                </div>

                                {{-- TEXT --}}
                                <div>

                                    <h2 class="text-lg font-bold text-slate-800">
                                        Konfirmasi Submit
                                    </h2>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Periksa kembali jawaban sebelum submit.
                                    </p>
                                </div>
                            </div>

                            {{-- STATUS --}}
                            @if($this->unansweredCount > 0)

                                <div class="mt-4 rounded-2xl border border-amber-200 bg-amber-50 p-3">

                                    <p class="text-sm text-amber-700">
                                        ⚠️ Masih ada {{ $this->unansweredCount }} soal belum dijawab.
                                    </p>
                                </div>

                            @else

                                <div class="mt-4 rounded-2xl border border-green-200 bg-green-50 p-3">

                                    <p class="text-sm text-green-700">
                                        ✅ Semua soal sudah dijawab.
                                    </p>
                                </div>
                            @endif

                            {{-- ACTION --}}
                            <div class="mt-6 flex flex-col sm:flex-row gap-3">

                                <button
                                    type="button"
                                    wire:click="closeSubmitModal"
                                    class="w-full sm:w-auto px-5 py-3 rounded-2xl bg-slate-100 text-slate-700 hover:bg-slate-200 transition"
                                >
                                    Periksa Lagi
                                </button>

                                <button
                                    type="button"
                                    wire:click="submit"
                                    wire:loading.attr="disabled"
                                    class="w-full sm:w-auto sm:ml-auto px-5 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition"
                                >

                                    <span wire:loading.remove wire:target="submit">
                                        Ya, Submit
                                    </span>

                                    <span wire:loading wire:target="submit">
                                        Mengirim...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>