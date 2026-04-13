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
                    <a
                        href="{{ route('user.dashboard') }}"
                        class="inline-flex items-center rounded-2xl border border-white/20 bg-white/10 px-5 py-3 text-sm font-semibold text-white backdrop-blur transition hover:bg-white/20 hover:border-white/30 focus:outline-none focus:ring-4 focus:ring-white/20"
                    >
                        ← Kembali
                    </a>
                </div>
            </div>

            {{-- CONTENT --}}
            <div class="px-6 py-8 sm:px-8">

                {{-- 🔥 KONFIRMASI ULANG QUIZ --}}
                @if ($showConfirm)
                    <div class="mb-6 max-w-xl mx-auto">
                        <div class="relative overflow-hidden rounded-3xl 
                            bg-gradient-to-br from-blue-600 via-blue-500 to-white 
                            border border-blue-200 shadow-xl p-8 text-center">

                            <!-- DECORATION -->
                            <div class="absolute -top-16 -right-16 w-40 h-40 bg-blue-300/30 rounded-full blur-3xl"></div>
                            <div class="absolute -bottom-16 -left-16 w-40 h-40 bg-white/50 rounded-full blur-3xl"></div>

                            <!-- ICON -->
                            <div class="flex justify-center mb-4">
                                <div class="flex items-center justify-center w-16 h-16 rounded-full 
                                    bg-white text-blue-600 shadow-lg">
                                    ⚡
                                </div>
                            </div>

                            <!-- TITLE -->
                            <h2 class="text-xl font-bold text-white tracking-wide">
                                Anda sudah mengisi quiz ini
                            </h2>

                            <!-- TOTAL SCORE -->
                            @if($totalScore > 0)
                            <div class="mt-5 p-5 rounded-2xl 
                                bg-white shadow-md border border-blue-100">

                                <p class="text-sm text-blue-600">
                                    📊 Total Score Anda
                                </p>

                                <p class="text-4xl font-extrabold text-blue-700 mt-1">
                                    {{ $totalScore }}
                                </p>

                                <p class="text-xs text-slate-500 mt-1">
                                    Dari {{ $attemptCount }} percobaan
                                </p>
                            </div>
                            @endif

                            <!-- DESC -->
                            <p class="text-sm text-blue-100 mt-4">
                                Apakah Anda ingin mengisi quiz lagi?
                            </p>

                            <!-- ATTEMPT INFO -->
                            <div class="flex flex-wrap justify-center gap-2 mt-4">

                                <span class="px-3 py-1 text-xs rounded-full 
                                    bg-white text-blue-600 border border-blue-200">
                                    Percobaan: {{ $attemptCount }} / {{ $maxAttempt }}
                                </span>

                                <span class="px-3 py-1 text-xs rounded-full 
                                    bg-blue-100 text-blue-700 border border-blue-200">
                                    Total attempt: {{ $attemptCount }}x
                                </span>

                            </div>

                            <!-- ACTION -->
                            <div class="flex flex-col sm:flex-row justify-center gap-3 mt-6">

                                <!-- BUTTON ULANG -->
                                <button
                                    wire:click="startAgain"
                                    @if($attemptCount >= $maxAttempt) disabled @endif
                                    class="flex items-center justify-center gap-2 px-6 py-3 rounded-xl 
                                    bg-white text-blue-600 font-semibold 
                                    hover:bg-blue-50 shadow-md transition
                                    disabled:bg-gray-300 disabled:text-gray-500 disabled:cursor-not-allowed"
                                >
                                    🔁 Isi Lagi
                                </button>

                                <!-- BUTTON KEMBALI -->
                                <a
                                    href="{{ route('user.dashboard') }}"
                                    class="flex items-center justify-center gap-2 px-6 py-3 rounded-xl 
                                    bg-blue-700 text-white font-medium 
                                    hover:bg-blue-800 shadow-md transition"
                                >
                                    ← Kembali
                                </a>
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
                                        @foreach ($question->options as $option)
                                            <label class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm cursor-pointer hover:bg-blue-50">
                                                
                                                <input
                                                    type="radio"
                                                    name="question_{{ $question->id }}"
                                                    wire:model.live="answers.{{ $question->id }}"
                                                    value="{{ $option->id }}"
                                                >
                                                <span>{{ $option->text }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- ACTION --}}
                                <div class="flex items-center justify-between mt-8">

                                    {{-- PREV --}}
                                    <button
                                        type="button"
                                        wire:click="prev"
                                        class="px-5 py-2 bg-gray-200 rounded-xl"
                                        @if($currentQuestion == 0) disabled @endif
                                    >
                                        Sebelumnya
                                    </button>

                                    {{-- NEXT / SUBMIT --}}
                                    @if($currentQuestion < count($quiz->questions) - 1)
                                        <button
                                            type="button"
                                            wire:click="next"
                                            class="px-5 py-2 bg-blue-600 text-white rounded-xl"
                                        >
                                            Selanjutnya
                                        </button>
                                    @else
                                        <button
                                            type="submit"
                                            class="px-5 py-2 bg-green-600 text-white rounded-xl"
                                        >
                                            Submit Jawaban
                                        </button>
                                    @endif
                                </div>
                            </form>
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