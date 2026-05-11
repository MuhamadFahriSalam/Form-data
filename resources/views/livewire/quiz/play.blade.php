
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

                {{-- 🔥 KONFIRMASI ULANG QUIZ --}}
                @if ($showConfirm)
                    <div class="mb-6 max-w-xl mx-auto">
                        <div class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                            <!-- ACCENT LINE -->
                            <div class="h-2 bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-600"></div>
                            <div class="p-6 text-center">

                                <!-- ICON -->
                                <div class="flex justify-center mb-4">
                                    <div class="flex items-center justify-center w-14 h-14 rounded-2xl 
                                        bg-blue-100 text-blue-600 shadow-sm">
                                        
                                        <!-- ICON -->
                                        <svg xmlns="http://www.w3.org/2000/svg" 
                                            class="w-7 h-7" 
                                            fill="none" 
                                            viewBox="0 0 24 24" 
                                            stroke="currentColor" 
                                            stroke-width="2">
                                            
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                
                                <!-- TITLE -->
                                <h2 class="text-lg font-semibold text-slate-900">
                                    Anda sudah mengisi quiz ini
                                </h2>

                                <!-- SCORE CARD -->
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

                                <!-- ACTION -->
                                <div class="flex flex-col sm:flex-row justify-center gap-3 mt-6">

                                    <!-- ⬅️ KEMBALI -->
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

                    {{-- ✅ CEK ADA SOAL ATAU TIDAK --}}
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

                                    <p class="mb-4 text-sm font-semibold text-slate-800">
                                        {{ $currentQuestion + 1 }}. {{ $question->question }}
                                    </p>

                                    <div class="space-y-3">

                                        {{-- INFO MULTIPLE --}}
                                        @if($question->is_multiple)
                                            <span class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded">
                                                Pilih lebih dari satu jawaban
                                            </span>
                                        @endif

                                        {{-- OPTIONS --}}
                                        @foreach ($question->options as $option)
                                            <label class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm cursor-pointer hover:bg-blue-50">

                                                @if ($question->is_multiple)
                                                    <!-- MULTIPLE -->
                                                    <input
                                                        type="checkbox"
                                                        wire:model="answers.{{ $question->id }}"
                                                        value="{{ $option->id }}"
                                                        class="accent-blue-600"
                                                    >
                                                @else
                                                    <!-- SINGLE -->
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
                                        <button
                                            type="button"
                                            wire:click="openSubmitModal"
                                            class="w-full sm:w-auto px-5 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl font-semibold shadow-md transition"
                                        >
                                            Submit Jawaban
                                        </button>
                                    @endif
                                </div>
                            </form>

                            {{-- MODAL KONFIRMASI QUIZ --}}
                            @if($showSubmitModal)
                                <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">

                                    <div class="
                                        w-full max-w-md
                                        mx-4
                                        bg-white
                                        rounded-2xl
                                        shadow-2xl border border-slate-200
                                        p-5 sm:p-6
                                        animate-scale-in
                                    ">

                                        <!-- HEADER -->
                                        <div class="flex items-start gap-3 mb-4">

                                            <!-- ICON -->
                                            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-100 text-blue-600 shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="w-5 h-5"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor">

                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                                </svg>
                                            </div>

                                            <!-- TITLE -->
                                            <div>
                                                <h2 class="text-sm sm:text-base font-semibold text-slate-800">
                                                    Konfirmasi Submit Quiz
                                                </h2>

                                                <p class="text-xs sm:text-sm text-slate-500 mt-1 leading-relaxed">
                                                    Pastikan jawaban quiz sudah diperiksa sebelum dikirim.
                                                </p>
                                            </div>
                                        </div>

                                        <!-- INFO STATUS -->
                                        <div class="rounded-xl bg-slate-50 border border-slate-200 p-4 mb-4 space-y-3">

                                            <!-- TOTAL -->
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="text-slate-600">
                                                    Total Soal
                                                </span>

                                                <span class="font-semibold text-slate-800">
                                                    {{ count($quiz->questions) }}
                                                </span>
                                            </div>

                                            <!-- SUDAH DIJAWAB -->
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="text-green-600">
                                                    Sudah Dijawab
                                                </span>

                                                <span class="font-semibold text-green-600">
                                                    {{ $this->answeredCount }}
                                                </span>
                                            </div>

                                            <!-- BELUM -->
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="text-red-500">
                                                    Belum Dijawab
                                                </span>

                                                <span class="font-semibold text-red-500">
                                                    {{ $this->unansweredCount }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- WARNING -->
                                        @if($this->unansweredCount > 0)
                                            <div class="rounded-xl bg-amber-50 border border-amber-200 p-3 mb-5">
                                                <p class="text-xs text-amber-700 leading-relaxed">
                                                    ⚠️ Masih ada {{ $this->unansweredCount }} soal yang belum dijawab.
                                                </p>
                                            </div>
                                        @else
                                            <div class="rounded-xl bg-green-50 border border-green-200 p-3 mb-5">
                                                <p class="text-xs text-green-700 leading-relaxed">
                                                    ✅ Semua soal sudah dijawab.
                                                </p>
                                            </div>
                                        @endif

                                        <!-- ACTION -->
                                        <div class="flex flex-col gap-3 sm:flex-row sm:justify-between">

                                            <!-- BATAL -->
                                            <button
                                                wire:click="closeSubmitModal"
                                                class="w-full sm:w-auto px-4 py-2.5 rounded-xl text-sm font-medium
                                                    bg-slate-100 text-slate-700
                                                    hover:bg-slate-200 transition"
                                            >
                                                Periksa Lagi
                                            </button>

                                            <!-- SUBMIT -->
                                            <button
                                                wire:click="submit"
                                                wire:loading.attr="disabled"
                                                class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-sm font-medium
                                                    bg-blue-600 text-white
                                                    hover:bg-blue-700
                                                    transition shadow-sm ml-auto"
                                            >

                                                <!-- NORMAL -->
                                                <span wire:loading.remove wire:target="submit">
                                                    Ya, Submit
                                                </span>

                                                <!-- LOADING -->
                                                <span wire:loading wire:target="submit">
                                                    Mengirim...
                                                </span>

                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                        @else
                            <div class="text-center text-red-500 font-semibold">
                                ❌ Soal tidak ditemukan
                            </div>
                        @endif
                        
                    @else
                        <div class="text-center text-red-500 font-semibold">
                            ❌ Quiz ini belum memiliki pertanyaan
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>