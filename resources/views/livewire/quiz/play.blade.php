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

                {{-- PROGRESS --}}
                <div class="mb-6">
                    <div class="w-full bg-slate-200 rounded-full h-2">
                        <div
                            class="bg-emerald-600 h-2 rounded-full transition-all duration-300"
                            style="width: {{ (($currentQuestion + 1) / count($quiz->questions)) * 100 }}%"
                        ></div>
                    </div>
                    <p class="text-sm text-slate-500 mt-2">
                        Soal {{ $currentQuestion + 1 }} dari {{ count($quiz->questions) }}
                    </p>
                </div>

                <form wire:submit.prevent="submit">

                    @php
                        $question = $quiz->questions[$currentQuestion];
                    @endphp

                    {{-- QUESTION CARD --}}
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">

                        <p class="mb-4 text-sm font-semibold text-slate-800">
                            {{ $currentQuestion + 1 }}. {{ $question->question }}
                        </p>

                        {{-- RADIO --}}
                        @if (!$question->is_multiple)
                            <div class="space-y-3">
                                @foreach ($question->options as $option)
                                    <label class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 transition hover:border-emerald-300 hover:bg-emerald-50">
                                        <input
                                            type="radio"
                                            wire:model="answers.{{ $question->id }}"
                                            value="{{ $option->id }}"
                                            class="h-4 w-4 text-emerald-600 focus:ring-emerald-500"
                                        >
                                        <span>{{ $option->text }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @endif

                        {{-- CHECKBOX --}}
                        @if ($question->is_multiple)
                            <div class="space-y-3">
                                @foreach ($question->options as $option)
                                    <label class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 transition hover:border-emerald-300 hover:bg-emerald-50">
                                        <input
                                            type="checkbox"
                                            wire:model="answers.{{ $question->id }}.{{ $option->id }}"
                                            value="1"
                                            class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        >
                                        <span>{{ $option->text }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- ACTION --}}
                    <div class="flex items-center justify-between mt-8">

                        {{-- KIRI: PREV --}}
                        <button
                            type="button"
                            wire:click="prev"
                            class="inline-flex items-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-100 disabled:opacity-50"
                            @if($currentQuestion == 0) disabled @endif
                        >
                            Sebelumnya
                        </button>

                        {{-- KANAN: NEXT / SUBMIT --}}
                        <div>
                            @if($currentQuestion < count($quiz->questions) - 1)
                                <button
                                    type="button"
                                    wire:click="next"
                                    class="inline-flex items-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-900/30 transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100"
                                >
                                    Selanjutnya
                                </button>
                            @else
                                <button
                                    type="submit"
                                    class="inline-flex items-center rounded-2xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-900/30 transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                                >
                                    Submit Jawaban
                                </button>
                            @endif
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>