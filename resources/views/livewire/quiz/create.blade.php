<div class="min-h-screen bg-slate-50">
    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

        <form wire:submit.prevent="save">

            {{-- HEADER --}}
            <div class="mb-8 overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-violet-900 to-indigo-800 shadow-lg">
                <div class="px-6 py-8 sm:px-8 lg:px-10 flex justify-between items-center">
                    <div class="flex items-center justify-between">

                        {{-- LEFT --}}
                        <div class="flex items-center gap-4">

                            {{-- ICON --}}
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M9 12h6m-6 4h6M9 8h6M5 6h.01M5 10h.01M5 14h.01M5 18h.01"/>
                                </svg>
                            </div>

                            {{-- TEXT --}}
                            <div>
                                <h1 class="text-3xl font-bold tracking-tight text-white">
                                    Buat Quiz
                                </h1>
                                <p class="mt-1 text-sm text-white/70">
                                    Susun pertanyaan dan jawaban quiz dengan mudah
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT --}}
                    <div class="rounded-2xl border border-white/10 bg-white/10 px-5 py-4 backdrop-blur-sm">
                        <p class="text-xs text-slate-200">Total Soal</p>
                        <p class="text-2xl font-bold text-white">
                            {{ count($questions) }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Informasi Quiz --}}
            <div class="mb-8 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5 sm:px-8">
                    <h2 class="text-lg font-semibold text-slate-900">
                        Informasi Quiz
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Isi judul, deskripsi, dan periode pengerjaan quiz.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-6 p-6 sm:p-8">
                    
                    {{-- Judul --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Judul Quiz
                        </label>
                        <input
                            type="text"
                            wire:model.defer="title"
                            placeholder="Masukkan judul quiz"
                            class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm shadow-sm focus:border-violet-400 focus:ring-4 focus:ring-violet-100 outline-none"
                        >
                        @error('title')
                            <div class="mt-2 text-sm font-medium text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Deskripsi
                        </label>
                        <textarea
                            wire:model.defer="description"
                            rows="4"
                            placeholder="Masukkan deskripsi quiz"
                            class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm shadow-sm focus:border-violet-400 focus:ring-4 focus:ring-violet-100 outline-none"
                        ></textarea>
                        @error('description')
                            <div class="mt-2 text-sm font-medium text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Waktu --}}
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Tanggal Mulai
                            </label>
                            <input
                                type="datetime-local"
                                wire:model.defer="start_at"
                                class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm shadow-sm focus:border-violet-400 focus:ring-4 focus:ring-violet-100 outline-none"
                            >
                            @error('start_at')
                                <div class="mt-2 text-sm font-medium text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Tanggal Berakhir
                            </label>
                            <input
                                type="datetime-local"
                                wire:model.defer="end_at"
                                class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm shadow-sm focus:border-violet-400 focus:ring-4 focus:ring-violet-100 outline-none"
                            >
                            @error('end_at')
                                <div class="mt-2 text-sm font-medium text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                </div>
            </div>

            {{-- PERTANYAAN --}}
            <div class="space-y-6">
                @foreach ($questions as $qIndex => $question)
                    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm hover:shadow-lg transition">

                        {{-- HEADER --}}
                        <div class="flex justify-between items-center px-6 py-5 bg-slate-50 border-b">
                            <div>
                                <p class="text-sm font-semibold text-violet-600">
                                    Pertanyaan {{ $qIndex + 1 }}
                                </p>
                                <p class="text-xs text-slate-500">
                                    Atur soal dan jawaban
                                </p>
                            </div>

                            @if(count($questions) > 1)
                                <button
                                    type="button"
                                    wire:click="removeQuestion({{ $qIndex }})"
                                    class="px-4 py-2 text-sm font-semibold text-red-600 bg-red-50 border border-red-200 rounded-xl hover:bg-red-100"
                                >
                                    Hapus
                                </button>
                            @endif
                        </div>

                        {{-- BODY --}}
                        <div class="p-6 space-y-5">

                            {{-- TEXTAREA --}}
                            <textarea
                                wire:model="questions.{{ $qIndex }}.question"
                                class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm shadow-sm focus:border-violet-400 focus:ring-4 focus:ring-violet-100 outline-none"
                                placeholder="Tulis pertanyaan..."
                            ></textarea>

                            {{-- VALIDASI PERTANYAAN KOSONG --}}
                            @error('questions.' . $qIndex . '.question')
                                <div class="text-sm text-red-500 font-semibold mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                            {{-- VALIDASI JAWABAN BENAR --}}
                            @error('questions.' . $qIndex . '.correct')
                                <div class="text-sm text-red-500 font-semibold mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                            {{-- OPSI --}}
                            <div class="space-y-3">
                                @foreach ($question['options'] as $oIndex => $option)
                                    <div class="flex items-center gap-3">

                                        <input
                                            type="text"
                                            wire:model="questions.{{ $qIndex }}.options.{{ $oIndex }}.text"
                                            class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm shadow-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-100 outline-none"
                                            placeholder="Opsi jawaban"
                                        >

                                        {{-- VALIDASI OPSI KOSONG --}}
                                        @error('questions.' . $qIndex . '.options.' . $oIndex)
                                            <div class="text-xs text-red-500 font-semibold">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <button
                                            type="button"
                                            wire:click="toggleCorrect({{ $qIndex }}, {{ $oIndex }})"
                                            class="px-4 py-2 text-sm font-semibold rounded-xl transition
                                            {{ $option['is_correct'] 
                                                ? 'bg-emerald-500 text-white shadow' 
                                                : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                                        >
                                            ✔
                                        </button>

                                        <button
                                            type="button"
                                            wire:click="removeOption({{ $qIndex }}, {{ $oIndex }})"
                                            class="px-3 py-2 bg-red-500 text-white rounded-xl hover:bg-red-600"
                                        >
                                            ✕
                                        </button>

                                    </div>
                                @endforeach
                            </div>

                            <button
                                type="button"
                                wire:click="addOption({{ $qIndex }})"
                                class="text-sm font-medium text-violet-600 hover:underline"
                            >
                                + Tambah Opsi
                            </button>

                            {{-- MULTIPLE --}}
                            <div class="pt-3 border-t">
                                <label class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                                    <span class="text-sm text-slate-700 font-medium">
                                        Multiple jawaban
                                    </span>
                                    <input
                                        type="checkbox"
                                        wire:model="questions.{{ $qIndex }}.is_multiple"
                                        class="h-4 w-4 text-violet-600"
                                    >
                                </label>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            {{-- ACTION --}}
            <div class="mt-8 flex flex-col gap-4 border-t border-slate-200 pt-6 sm:flex-row sm:items-center sm:justify-between">

                {{-- Kiri --}}
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-slate-100"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>

                {{-- Kanan --}}
                <div class="flex flex-col gap-3 w-full sm:w-auto sm:flex-row sm:items-center sm:gap-4">

                    <button
                        type="button"
                        wire:click="addQuestion"
                        class="w-full sm:w-auto inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-violet-300 hover:text-violet-700 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-slate-100"
                    >
                        + Tambah Pertanyaan
                    </button>

                    <button
                        type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center rounded-2xl bg-violet-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-violet-200 transition hover:bg-violet-700 focus:outline-none focus:ring-4 focus:ring-violet-100"
                        wire:loading.attr="disabled"
                    >
                        Simpan Quiz
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>