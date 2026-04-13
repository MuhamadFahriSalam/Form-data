@section('title', $form->title)

<div class="min-h-screen bg-slate-50 py-10">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form Details -->
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="bg-gradient-to-r from-slate-900 to-slate-700 px-6 py-8 sm:px-8">
                <h1 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
                    {{ $form->title }}
                </h1>

                @if ($form->description)
                    <p class="mt-2 text-sm leading-6 text-slate-200">
                        {{ $form->description }}
                    </p>
                @endif
            </div>

            <!-- Form Questions -->
            <div class="px-6 py-8 sm:px-8">

                {{-- 🔔 Info kalau sudah isi --}}
                @if ($alreadySubmitted)
                    <div class="mb-6 rounded-2xl border border-yellow-200 bg-yellow-50 px-5 py-4 text-sm text-yellow-700">
                        Anda sudah mengisi form ini. Anda bisa mengedit jawaban.
                    </div>
                @endif

                {{-- ❗ DEBUG kalau pertanyaan kosong --}}
                @if ($form->questions->count() == 0)
                    <div class="mb-6 text-red-500 font-semibold">
                        ❌ Tidak ada pertanyaan pada form ini
                    </div>
                @endif

                {{-- ✅ FORM SELALU MUNCUL --}}
                <form wire:submit="submit" class="space-y-6">

                      {{-- Loop pertanyaan --}}
                    @foreach ($form->questions as $index => $question)

                        @php
                            $options = is_array($question->options)
                                ? $question->options
                                : json_decode($question->options ?? '[]', true);
                        @endphp

                         {{--  Setiap jenis pertanyaan ditangani dengan kondisi berbeda --}}
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                            
                            <label class="mb-3 block text-sm font-semibold text-slate-800">
                                {{ $index + 1 }}. {{ $question->question }}
                                @if ($question->is_required)
                                    <span class="text-red-500">*</span>
                                @endif
                            </label>

                            {{-- TEXT --}}
                            @if ($question->type === 'text')
                                <input type="text"
                                    wire:model.defer="answers.{{ $question->id }}"
                                    class="w-full rounded-xl border px-4 py-3"
                                    placeholder="Tulis jawaban">

                            {{-- TEXTAREA --}}
                            @elseif ($question->type === 'textarea')
                                <textarea wire:model.defer="answers.{{ $question->id }}"
                                    class="w-full rounded-xl border px-4 py-3"></textarea>

                            {{-- EMAIL --}}
                            @elseif ($question->type === 'email')
                                <input type="email"
                                    wire:model.defer="answers.{{ $question->id }}"
                                    class="w-full rounded-xl border px-4 py-3">

                            {{-- NUMBER --}}
                            @elseif ($question->type === 'number')
                                <input type="number"
                                    wire:model.defer="answers.{{ $question->id }}"
                                    class="w-full rounded-xl border px-4 py-3">

                            {{-- DATE --}}
                            @elseif ($question->type === 'date')
                                <input type="date"
                                    wire:model.defer="answers.{{ $question->id }}"
                                    class="w-full rounded-xl border px-4 py-3">

                            {{-- SELECT --}}
                            @elseif ($question->type === 'select')
                                <select wire:model.defer="answers.{{ $question->id }}"
                                    class="w-full rounded-xl border px-4 py-3">
                                    <option value="">Pilih</option>
                                    @foreach ($options as $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                </select>

                            {{-- RADIO --}}
                            @elseif ($question->type === 'radio')
                                @foreach ($options as $option)
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio"
                                            name="question_{{ $question->id }}"
                                            wire:model.defer="answers.{{ $question->id }}"
                                            value="{{ $option }}"
                                            class="text-blue-600 focus:ring-blue-500">
                                        {{ $option }}
                                    </label>
                                @endforeach
                                
                            {{-- CHECKBOX --}}
                            @elseif ($question->type === 'checkbox')
                                @foreach ($options as $option)
                                    <label class="flex gap-2">
                                        <input type="checkbox"
                                            wire:model.defer="answers.{{ $question->id }}"
                                            value="{{ $option }}">
                                        {{ $option }}
                                    </label>
                                @endforeach

                            {{-- FILE --}}
                            @elseif ($question->type === 'file')
                                <input type="file"
                                    wire:model="answers.{{ $question->id }}"
                                    class="w-full border p-2">

                            @endif

                            {{-- ERROR --}}
                            @error('answers.' . $question->id)
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach

                    {{-- ACTION --}}
                    <div class="flex justify-between">
                        <a href="{{ route('user.dashboard') }}">← Kembali</a>

                        <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-xl">
                            {{ $alreadySubmitted ? 'Update Jawaban' : 'Kirim Jawaban' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
