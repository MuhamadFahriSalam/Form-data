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
            <div class="relative bg-gradient-to-r from-blue-700 via-indigo-700 to-blue-800 px-6 py-8 sm:px-8 text-white overflow-hidden rounded-3xl shadow-lg">

                <!-- DECORATION -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-blue-400/20 rounded-full blur-2xl"></div>

                <!-- TITLE -->
                <h1 class="text-2xl font-bold tracking-tight sm:text-3xl">
                    {{ $form->title }}
                </h1>

                <!-- DESCRIPTION -->
                @if ($form->description)
                    <p class="mt-2 text-sm leading-6 text-blue-200">
                        {{ $form->description }}
                    </p>
                @endif

            </div>

            <!-- Form Questions -->
            <div class="px-6 py-8 sm:px-8">

                {{-- 🔥 MODE PILIHAN (SEPERTI QUIZ) --}}
                @if ($showResult)
                    <div class="mb-6 max-w-xl mx-auto">
                        <div class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                            <!-- ACCENT LINE -->
                            <div class="h-2 bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-600"></div>

                            <div class="p-6 text-center">

                                <!-- ICON -->
                                <div class="flex justify-center mb-4">
                                    <div class="flex items-center justify-center w-14 h-14 rounded-2xl 
                                        bg-blue-100 text-blue-600 shadow-sm">

                                        <svg xmlns="http://www.w3.org/2000/svg" 
                                            class="w-7 h-7" 
                                            fill="none" 
                                            viewBox="0 0 24 24" 
                                            stroke="currentColor" 
                                            stroke-width="2">

                                            <path stroke-linecap="round" stroke-linejoin="round" 
                                                d="M9 12l2 2 4-4M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- TITLE -->
                                <h2 class="text-lg font-semibold text-slate-900">
                                    Anda sudah mengisi form ini
                                </h2>

                                <!-- DESC -->
                                <p class="text-sm text-slate-500 mt-2">
                                    Pilih aksi yang ingin dilakukan
                                </p>

                                <!-- ATTEMPT -->
                                <div class="mt-3 inline-block px-3 py-1 rounded-full 
                                    bg-blue-50 text-blue-600 text-xs border border-blue-200">
                                    Pengisian: {{ $attemptCount }} / {{ $maxAttempt }}
                                </div>

                                <!-- ACTION -->
                                <div class="flex flex-wrap justify-center gap-3 mt-6">

                                    <!-- 🔁 ISI KEMBALI (PRIMARY) -->
                                    <button
                                        wire:click="startAgain"
                                        @if($attemptCount >= $maxAttempt) disabled @endif
                                        class="px-5 py-2 rounded-2xl 
                                        bg-blue-600 text-white font-semibold
                                        hover:bg-blue-700
                                        shadow-sm hover:shadow-md
                                        transition-all duration-300
                                        disabled:bg-gray-300 disabled:text-gray-500 disabled:cursor-not-allowed"
                                    >
                                        🔁 Isi Kembali
                                    </button>

                                    <!-- ✏️ EDIT (SECONDARY) -->
                                    <button
                                        wire:click="continueEdit"
                                        @if($attemptCount >= $maxAttempt) disabled @endif
                                        class="px-5 py-2 rounded-2xl 
                                        bg-white text-blue-600 font-medium
                                        border border-blue-200
                                        hover:bg-blue-50 hover:border-blue-300
                                        transition-all duration-300
                                        disabled:bg-gray-200 disabled:text-gray-400 disabled:border-gray-200 disabled:cursor-not-allowed"
                                    >
                                        ✏️ Edit Jawaban
                                    </button>

                                    <!-- ⬅️ KEMBALI (OUTLINE) -->
                                    <a
                                        href="{{ route('user.dashboard') }}"
                                        class="px-5 py-2 rounded-2xl 
                                        bg-white text-slate-600 font-medium
                                        border border-slate-200
                                        hover:bg-slate-50 hover:border-slate-300
                                        transition-all duration-300"
                                    >
                                        ⬅️ Kembali
                                    </a>
                                </div>
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

                            {{-- QUESTION CARD --}}
                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">

                                <label class="mb-3 block text-sm font-semibold text-slate-800">
                                    {{ $index + 1 }}. {{ $question->question }}
                                    @if ($question->is_required)
                                        <span class="text-red-500">*</span>
                                    @endif
                                </label>

                                {{-- IMAGE --}}
                                @if($question->image)

                                    <div class="mb-4">

                                        <img
                                            src="{{ asset('storage/' . $question->image) }}"
                                            alt="Question Image"
                                            class="w-full max-w-2xl rounded-2xl border border-slate-200 object-cover shadow-sm"
                                        >
                                    </div>
                                @endif

                                {{-- TEXT --}}
                                @if ($question->type === 'text')
                                    <input type="text"
                                        wire:model.defer="answers.{{ $question->id }}"
                                        class="w-full rounded-xl border px-4 py-3">

                                {{-- TEXTAREA --}}
                                @elseif ($question->type === 'textarea')
                                    <textarea
                                        wire:model.defer="answers.{{ $question->id }}"
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

                                {{-- CHECKBOX --}}
                                @elseif ($question->type === 'checkbox')
                                    @foreach ($options as $option)
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox"
                                                wire:model.defer="answers.{{ $question->id }}"
                                                value="{{ $option }}">
                                            {{ $option }}
                                        </label>
                                    @endforeach

                                {{-- SELECT --}}
                                @elseif ($question->type === 'select')
                                    <select
                                        wire:model.defer="answers.{{ $question->id }}"
                                        class="w-full rounded-xl border px-4 py-3">
                                        <option value="">Pilih</option>
                                        @foreach ($options as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>

                                {{-- DATE --}}
                                @elseif ($question->type === 'date')
                                    <input type="date"
                                        wire:model.defer="answers.{{ $question->id }}"
                                        class="w-full rounded-xl border px-4 py-3">

                                {{-- NUMBER --}}
                                @elseif ($question->type === 'number')
                                    <input type="number"
                                        wire:model.defer="answers.{{ $question->id }}"
                                        class="w-full rounded-xl border px-4 py-3">

                                {{-- FILE --}}
                                @elseif ($question->type === 'file')
                                    <input type="file"
                                        wire:model="answers.{{ $question->id }}"
                                        class="w-full border p-2 rounded-xl">

                                @endif

                                {{-- ERROR --}}
                                @error('answers.' . $question->id)
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach

                        {{-- ACTION --}}
                        <div class="flex justify-between items-center">

                            <!-- BUTTON KEMBALI -->
                            <a href="{{ route('user.dashboard') }}"
                                class="inline-flex items-center gap-2 px-6 py-3 
                                    rounded-2xl bg-white text-slate-700 text-sm font-medium
                                    shadow-md border border-slate-200
                                    transition duration-300
                                    hover:shadow-lg hover:bg-slate-50">

                                <!-- ICON -->
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                    class="w-5 h-5 text-slate-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M15 19l-7-7 7-7" />
                                </svg>

                                Kembali
                            </a>

                            <!-- BUTTON SUBMIT -->
                            <button type="button"
                                wire:click="$set('showConfirm', true)"
                                class="bg-blue-600 text-white px-5 py-2 rounded-xl">
                                {{ $isEditMode ? 'Update Jawaban' : 'Kirim Jawaban' }}
                            </button>
                        </div>
                    </form>

                    <!-- MODAL KONFIRMASI -->
                    @if($showConfirm)
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
                                    <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-100 text-blue-600 shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                        </svg>
                                    </div>

                                    <div>
                                        <h2 class="text-sm sm:text-base font-semibold text-slate-800">
                                            Konfirmasi Pengiriman
                                        </h2>
                                        <p class="text-xs sm:text-sm text-slate-500 mt-1 leading-relaxed">
                                            Anda akan mengirim jawaban yang telah diisi.
                                        </p>
                                    </div>
                                </div>

                                <!-- INFO -->
                                <div class="rounded-xl bg-amber-50 border border-amber-200 p-3 mb-5">
                                    <p class="text-xs text-amber-700 leading-relaxed">
                                        Pastikan seluruh jawaban sudah diperiksa dengan benar sebelum dikirim.
                                    </p>
                                </div>

                                <!-- ACTION -->
                                <div class="flex flex-col gap-3 sm:flex-row sm:justify-between">

                                    <!-- BATAL (KIRI) -->
                                    <button 
                                        wire:click="$set('showConfirm', false)"
                                        class="w-full sm:w-auto px-4 py-2.5 rounded-xl text-sm font-medium 
                                            bg-slate-100 text-slate-700 
                                            hover:bg-slate-200 transition">
                                        Batal
                                    </button>

                                    <!-- KIRIM (KANAN) -->
                                    <button 
                                        wire:click="submit"
                                        wire:loading.attr="disabled"
                                        class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-sm font-medium 
                                            bg-blue-600 text-white 
                                            hover:bg-blue-700 
                                            transition shadow-sm ml-auto">

                                        <!-- hanya aktif saat submit -->
                                        <span wire:loading.remove wire:target="submit">
                                            Ya, Kirim
                                        </span>

                                        <span wire:loading wire:target="submit">
                                            Mengirim...
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>