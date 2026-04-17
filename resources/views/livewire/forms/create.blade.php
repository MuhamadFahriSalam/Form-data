@section('title', 'Buat Form')

<div class="min-h-screen bg-slate-50">
    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- Hero Header --}}
        <div class="mb-8 overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-violet-900 to-indigo-800 shadow-lg">
            <div class="px-6 py-8 sm:px-8 lg:px-10">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h1 class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                            Buat Form Pertanyaan
                        </h1>
                        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-200 sm:text-base">
                            Susun pertanyaan, atur tipe jawaban, dan buat form yang rapi serta mudah diisi user.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-5 py-4 backdrop-blur-sm">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-200">
                                Total Pertanyaan
                            </p>
                            <p class="mt-2 text-2xl font-bold text-white">
                                {{ count($questions) }}
                            </p>
                        </div>

                        <div class="rounded-2xl border border-white/10 bg-white/10 px-5 py-4 backdrop-blur-sm">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-200">
                                Status Form
                            </p>
                            <p class="mt-2 text-sm font-semibold 
                                {{ $status === 'published' ? 'text-emerald-300' : 'text-yellow-300' }}">
                                
                                {{ $status === 'published' ? 'Published' : 'Draft' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Informasi Form --}}
        <div class="mb-8 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5 sm:px-8">
                <h2 class="text-lg font-semibold text-slate-900">
                    Informasi Form
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Isi judul, deskripsi, dan periode pengisian form.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 p-6 sm:p-8">
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

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Tanggal Mulai Pengisian
                        </label>
                        <input
                            type="datetime-local"
                            wire:model.defer="start_at"
                            required
                            class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition focus:border-violet-400 focus:ring-4 focus:ring-violet-100"
                        >
                        @error('start_at')
                            <div class="mt-2 text-sm font-medium text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Batas Akhir Pengisian
                        </label>
                        <input
                            type="datetime-local"
                            wire:model.defer="end_at"
                            required
                            class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition focus:border-violet-400 focus:ring-4 focus:ring-violet-100"
                        >
                        @error('end_at')
                            <div class="mt-2 text-sm font-medium text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Daftar Pertanyaan --}}
        <div class="space-y-6">
            @foreach ($questions as $index => $item)
                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:shadow-lg">
                    <div class="flex flex-col gap-4 border-b border-slate-100 bg-slate-50 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-wide text-violet-600">
                                Pertanyaan {{ $index + 1 }}
                            </p>
                            <p class="mt-1 text-sm text-slate-500">
                                Atur isi pertanyaan, jenis jawaban, dan opsi bila diperlukan.
                            </p>
                        </div>

                        <button
                            type="button"
                            wire:click="removeQuestion({{ $index }})"
                            class="inline-flex items-center justify-center rounded-xl border border-red-200 bg-red-50 p-2 text-red-600 transition hover:bg-red-100 focus:outline-none focus:ring-4 focus:ring-red-100"
                        >
                            <!-- Icon Trash -->
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke-width="1.5" 
                                stroke="currentColor" 
                                class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" 
                                    d="M6 7.5h12M9 7.5V6a1.5 1.5 0 011.5-1.5h3A1.5 1.5 0 0115 6v1.5M6 7.5l.75 12A1.5 1.5 0 008.25 21h7.5a1.5 1.5 0 001.5-1.5L18 7.5M10.5 11.25v6M13.5 11.25v6" />
                            </svg>
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
                                placeholder="Contoh: Seberapa puas Anda terhadap layanan kami?"
                            >
                            @error('questions.'.$index.'.question')
                                <div class="mt-2 text-sm font-medium text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                            <div class="lg:col-span-2">
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
                                    <option value="number">Number</option>
                                    <option value="file">File</option>
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
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                            <div class="mb-4 flex items-center justify-between">
                                <h3 class="text-sm font-semibold text-slate-800">
                                    Preview Jawaban
                                </h3>
                                <span class="rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-medium text-slate-500">
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
                                    <textarea
                                        rows="4"
                                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-500 shadow-sm"
                                        placeholder="Tulis jawaban panjang di sini..."
                                    ></textarea>
                                @elseif ($questions[$index]['type'] === 'radio')
                                    <div class="grid gap-3 md:grid-cols-2">
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
                                    <div class="grid gap-3 md:grid-cols-2">
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
                                @elseif ($questions[$index]['type'] === 'number')
                                    <input
                                        type="number"
                                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-500 shadow-sm"
                                        placeholder="Masukkan angka"
                                    >
                                @elseif ($questions[$index]['type'] === 'file')
                                    <input
                                        type="file"
                                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-500 shadow-sm"
                                    >
                                @endif
                            </div>
                        </div>

                        {{-- Opsi Jawaban --}}
                        @if (in_array($questions[$index]['type'], ['radio', 'checkbox', 'select']))
                            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                                <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700">
                                            Pilihan Jawaban
                                        </label>
                                        <p class="mt-1 text-xs text-slate-500">
                                            Tambahkan opsi yang akan dipilih user.
                                        </p>
                                    </div>

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
                                        <div class="flex flex-col gap-3 sm:flex-row">
                                            <input
                                                type="text"
                                                wire:model.defer="questions.{{ $index }}.options.{{ $optIndex }}"
                                                class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-violet-400 focus:ring-4 focus:ring-violet-100"
                                                placeholder="Opsi jawaban"
                                            >

                                            <button
                                                type="button"
                                                wire:click="removeOption({{ $index }}, {{ $optIndex }})"
                                                class="inline-flex items-center justify-center rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-100 focus:outline-none focus:ring-4 focus:ring-red-100"
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
                    type="button"
                    wire:click="saveAs('draft')"
                    class="w-full sm:w-auto inline-flex items-center justify-center rounded-2xl bg-slate-500 px-6 py-3 text-sm font-semibold text-white shadow transition hover:bg-slate-600"
                >
                    Simpan sebagai Draft
                </button>

                <button
                    type="button"
                    wire:click="saveAs('published')"
                    class="w-full sm:w-auto inline-flex items-center justify-center rounded-2xl bg-violet-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:bg-violet-700"
                >
                    Publish Form
                </button>
            </div>
        </div>
    </div>

    {{-- TOAST SUCCESS FORM --}}
    @if (session('form_success'))
        <div 
            x-data="{ show: true }"
            x-init="
                setTimeout(() => {
                    show = false;
                    window.location.href = '{{ route('admin.dashboard') }}';
                }, 2000)
            "
            x-show="show"
            x-transition
            class="fixed top-5 right-5 z-50 rounded-xl bg-emerald-500 px-5 py-3 text-white shadow-lg"
        >
            ✅ Form berhasil disimpan
        </div>
    @endif
</div>

