<div class="min-h-screen bg-gradient-to-b from-slate-50 via-white to-slate-100">
    <div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

{{-- Header Form --}}
<div class="mb-6 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-[0_10px_40px_rgba(15,23,42,0.06)]">
    <div class="h-2 bg-gradient-to-r from-violet-500 via-fuchsia-500 to-sky-500"></div>

    <div class="space-y-6 p-6 sm:p-8">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                Buat Form
            </h1>
            <p class="mt-2 text-sm text-slate-500">
                Susun pertanyaan form dengan tampilan yang rapi dan mudah dipahami.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-5">

            {{-- Judul --}}
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Judul Form
                </label>
                <input
                    type="text"
                    wire:model.defer="title"
                    class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-violet-400 focus:ring-4 focus:ring-violet-100"
                    placeholder="Masukkan judul form"
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
                    class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-violet-400 focus:ring-4 focus:ring-violet-100"
                    placeholder="Masukkan deskripsi form"
                ></textarea>
                @error('description')
                    <div class="mt-2 text-sm font-medium text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Waktu Form --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Waktu Mulai --}}
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Waktu Mulai
                    </label>
                    <input
                        type="datetime-local"
                        wire:model.defer="start_at"
                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition focus:border-violet-400 focus:ring-4 focus:ring-violet-100"
                    >
                    @error('start_at')
                        <div class="mt-2 text-sm font-medium text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Batas Akhir --}}
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Batas Akhir Pengisian
                    </label>
                    <input
                        type="datetime-local"
                        wire:model.defer="end_at"
                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition focus:border-violet-400 focus:ring-4 focus:ring-violet-100"
                    >
                    @error('end_at')
                        <div class="mt-2 text-sm font-medium text-red-600">{{ $message }}</div>
                    @enderror
                </div>

            </div>

        </div>
    </div>
</div>
        {{-- Daftar Pertanyaan --}}
        <div class="space-y-6">
            @foreach ($questions as $index => $item)
                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-[0_10px_30px_rgba(15,23,42,0.05)] transition hover:shadow-[0_16px_40px_rgba(15,23,42,0.08)]">
                    <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50/70 px-6 py-4">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-wide text-violet-600">
                                Pertanyaan {{ $index + 1 }}
                            </p>
                            <p class="mt-1 text-sm text-slate-500">
                                Atur isi pertanyaan, tipe jawaban, dan opsi jika diperlukan.
                            </p>
                        </div>

                        <button
                            type="button"
                            wire:click="removeQuestion({{ $index }})"
                            class="inline-flex items-center rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-100 focus:outline-none focus:ring-4 focus:ring-red-100"
                        >
                            Hapus
                        </button>
                    </div>

                    <div class="space-y-6 p-6">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Teks Pertanyaan
                            </label>
                            <input
                                type="text"
                                wire:model.defer="questions.{{ $index }}.question"
                                class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-violet-400 focus:ring-4 focus:ring-violet-100"
                                placeholder="Tulis pertanyaan"
                            >
                            @error('questions.'.$index.'.question')
                                <div class="mt-2 text-sm font-medium text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Tipe Jawaban
                                </label>
                                <select
                                    wire:model.live="questions.{{ $index }}.type"
                                    class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition focus:border-violet-400 focus:ring-4 focus:ring-violet-100"
                                >
                                    <option value="text">Text</option>
                                    <option value="textarea">Textarea</option>
                                    <option value="radio">Pilihan Ganda</option>
                                    <option value="checkbox">Checkbox</option>
                                    <option value="date">Tanggal</option>
                                </select>
                            </div>

                            <div class="flex items-end">
                                <label class="inline-flex w-full items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                                    <span class="text-sm font-medium text-slate-700">Wajib diisi</span>
                                    <input
                                        type="checkbox"
                                        wire:model="questions.{{ $index }}.is_required"
                                        class="h-4 w-4 rounded border-slate-300 text-violet-600 focus:ring-violet-500"
                                    >
                                </label>
                            </div>
                        </div>

                        {{-- Preview --}}
                        <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-5">
                            <div class="mb-4 flex items-center justify-between">
                                <h3 class="text-sm font-semibold text-slate-800">
                                    Preview Jawaban
                                </h3>
                                <span class="rounded-full bg-white px-3 py-1 text-xs font-medium text-slate-500 ring-1 ring-slate-200">
                                    {{ ucfirst($questions[$index]['type']) }}
                                </span>
                            </div>

                            <div class="space-y-3">
                                @if ($questions[$index]['type'] === 'text')
                                    <input
                                        type="text"
                                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-500 shadow-sm"
                                        placeholder="Jawaban singkat"
                                    >
                                @elseif ($questions[$index]['type'] === 'textarea')
                                    <div>
                                        <label class="mb-2 block text-sm font-medium text-slate-700">
                                            {{ $questions[$index]['question'] ?: 'Tulis jawaban Anda' }}
                                        </label>
                                        <textarea
                                            rows="4"
                                            class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-500 shadow-sm outline-none placeholder:text-slate-400"
                                            placeholder="Tulis jawaban panjang di sini..."
                                        ></textarea>
                                    </div>
                                @elseif ($questions[$index]['type'] === 'radio')
                                    <div class="space-y-3">
                                        @foreach ($questions[$index]['options'] as $opt)
                                            @if (trim($opt) !== '')
                                                <label class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm">
                                                    <input type="radio" class="border-slate-300 text-violet-600 focus:ring-violet-500">
                                                    <span>{{ $opt }}</span>
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>
                                @elseif ($questions[$index]['type'] === 'checkbox')
                                    <div class="space-y-3">
                                        @foreach ($questions[$index]['options'] as $opt)
                                            @if (trim($opt) !== '')
                                                <label class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm">
                                                    <input type="checkbox" class="rounded border-slate-300 text-violet-600 focus:ring-violet-500">
                                                    <span>{{ $opt }}</span>
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>
                                @elseif ($questions[$index]['type'] === 'date')
                                    <input
                                        type="date"
                                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-500 shadow-sm"
                                    >
                                @endif
                            </div>
                        </div>

                        {{-- Opsi Jawaban --}}
                        @if (in_array($questions[$index]['type'], ['radio', 'checkbox', 'select']))
                            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                                <div class="mb-4 flex items-center justify-between">
                                    <label class="block text-sm font-semibold text-slate-700">
                                        Pilihan Jawaban
                                    </label>

                                    <button
                                        type="button"
                                        wire:click="addOption({{ $index }})"
                                        class="inline-flex items-center rounded-xl bg-violet-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-violet-700 focus:outline-none focus:ring-4 focus:ring-violet-100"
                                    >
                                        + Tambah Opsi
                                    </button>
                                </div>

                                <div class="space-y-3">
                                    @foreach ($questions[$index]['options'] as $optIndex => $opt)
                                        <div class="flex items-center gap-3">
                                            <input
                                                type="text"
                                                wire:model.defer="questions.{{ $index }}.options.{{ $optIndex }}"
                                                class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-violet-400 focus:ring-4 focus:ring-violet-100"
                                                placeholder="Opsi jawaban"
                                            >

                                            <button
                                                type="button"
                                                wire:click="removeOption({{ $index }}, {{ $optIndex }})"
                                                class="inline-flex items-center rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-100 focus:outline-none focus:ring-4 focus:ring-red-100"
                                            >
                                                Hapus
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Actions --}}
        <div class="mt-8 flex flex-wrap gap-4">
            <button
                type="button"
                wire:click="addQuestion"
                class="inline-flex items-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:-translate-y-0.5 hover:border-violet-300 hover:text-violet-700 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-slate-100"
            >
                + Tambah Pertanyaan
            </button>

            <button
                type="button"
                wire:click="save"
                class="inline-flex items-center rounded-2xl bg-violet-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-violet-200 transition hover:-translate-y-0.5 hover:bg-violet-700 focus:outline-none focus:ring-4 focus:ring-violet-100"
            >
                Simpan Form
            </button>
        </div>
    </div>
</div>
