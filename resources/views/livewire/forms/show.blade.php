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

                {{-- 🔥 MODE PILIHAN (SEPERTI QUIZ) --}}
                @if ($showConfirm)

                    <div class="mb-6 max-w-xl mx-auto">

                        <div class="rounded-3xl border border-yellow-200 bg-gradient-to-br from-yellow-50 via-white to-yellow-100 p-6 shadow-lg text-center">

                            <h2 class="text-lg font-bold text-slate-800">
                                Anda sudah mengisi quiz ini
                            </h2>

                            <p class="text-sm text-slate-500 mt-2">
                                Pilih aksi yang ingin dilakukan
                            </p>

                            <div class="flex flex-wrap justify-center gap-3 mt-5">

                                {{-- 🔁 ISI ULANG --}}
                                <button
                                    wire:click="startAgain"
                                    class="px-5 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition"
                                >
                                    🔁 Isi Ulang
                                </button>

                                {{-- ✏️ EDIT --}}
                                <button
                                    wire:click="continueEdit"
                                    class="px-5 py-2 rounded-xl bg-gray-200 text-gray-700 hover:bg-gray-300 transition"
                                >
                                    ✏️ Edit Jawaban
                                </button>

                                {{-- ⬅️ KEMBALI --}}
                                <a
                                    href="{{ route('user.dashboard') }}"
                                    class="px-5 py-2 rounded-xl bg-red-500 text-white hover:bg-red-600 transition"
                                >
                                    ⬅️ Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                @else

                    {{-- ❗ DEBUG kalau pertanyaan kosong --}}
                    @if ($form->questions->count() == 0)
                        <div class="mb-6 text-red-500 font-semibold">
                            ❌ Tidak ada pertanyaan pada form ini
                        </div>
                    @endif

                    {{-- ✅ FORM --}}
                    <form wire:submit="submit" class="space-y-6">

                        @foreach ($form->questions as $index => $question)

                            @php
                                $options = is_array($question->options)
                                    ? $question->options
                                    : json_decode($question->options ?? '[]', true);
                            @endphp

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
                                        class="w-full rounded-xl border px-4 py-3">

                                {{-- TEXTAREA --}}
                                @elseif ($question->type === 'textarea')
                                    <textarea wire:model.defer="answers.{{ $question->id }}"
                                        class="w-full rounded-xl border px-4 py-3"></textarea>

                                {{-- RADIO --}}
                                @elseif ($question->type === 'radio')
                                    @foreach ($options as $option)
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio"
                                                name="question_{{ $question->id }}"
                                                wire:model.defer="answers.{{ $question->id }}"
                                                value="{{ $option }}">
                                            {{ $option }}
                                        </label>
                                    @endforeach
                                @endif

                                @error('answers.' . $question->id)
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach

                        <div class="flex justify-between">
                            <a href="{{ route('user.dashboard') }}">← Kembali</a>

                            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-xl">
                                {{ $alreadySubmitted ? 'Update Jawaban' : 'Kirim Jawaban' }}
                            </button>
                        </div>

                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
