<div class="max-w-5xl mx-auto p-6 space-y-6">
    @if (session('success'))
        <div class="rounded-lg bg-green-100 px-4 py-3 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    <div class="rounded-xl bg-white shadow border border-gray-200 p-6 space-y-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Buat Form</h1>
            <p class="text-sm text-gray-500 mt-1">Susun pertanyaan form.</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Form</label>
            <input
                type="text"
                wire:model.defer="title"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="Masukkan judul form"
            >
            @error('title')
                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea
                wire:model.defer="description"
                rows="3"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="Masukkan deskripsi form"
            ></textarea>
            @error('description')
                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Daftar pertanyaan --}}
    @foreach ($questions as $index => $item)
        <div class="rounded-xl bg-white shadow border border-gray-200 p-6 space-y-4">
            <div class="flex items-start justify-between gap-4">
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Pertanyaan {{ $index + 1 }}
                    </label>
                    <input
                        type="text"
                        wire:model.defer="questions.{{ $index }}.question"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Tulis pertanyaan"
                    >
                    @error('questions.'.$index.'.question')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <button
                    type="button"
                    wire:click="removeQuestion({{ $index }})"
                    class="rounded-lg bg-red-100 px-3 py-2 text-sm font-medium text-red-700 hover:bg-red-200"
                >
                    Hapus
                </button>
            </div>

            {{-- Tipe jawaban dan preview --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Jawaban</label>
                    <select
                        wire:model.live="questions.{{ $index }}.type"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    >
                        <option value="text">Text</option>
                        <option value="textarea">Textarea</option>
                        <option value="radio">Pilihan Ganda</option>
                        <option value="checkbox">Checkbox</option>
                        <option value="date">Tanggal</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" wire:model="questions.{{ $index }}.is_required">
                        <span class="text-sm text-gray-700">Wajib diisi</span>
                    </label>
                </div>
            </div>

             {{-- Preview jawaban --}}
            <div class="space-y-3">
                @if ($questions[$index]['type'] === 'text')
                    <input
                        type="text"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 bg-gray-50 text-gray-500"
                        placeholder="Jawaban singkat"
                    >
                @elseif ($questions[$index]['type'] === 'textarea')
                    <div class="max-w-full">
                        <label class="block mb-2.5 text-sm font-medium text-heading">
                            {{ $questions[$index]['question'] ?: 'Your message' }}
                        </label>
                        <textarea
                            rows="4"
                            class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full p-3.5 shadow-xs placeholder:text-body"
                            placeholder="Write your thoughts here..."
                        ></textarea>
                    </div>
                @elseif ($questions[$index]['type'] === 'radio')
                    <div class="space-y-2">
                        @foreach ($questions[$index]['options'] as $opt)
                            @if (trim($opt) !== '')
                                <label class="flex items-center gap-2 text-sm text-gray-700">
                                    <input type="radio">
                                    <span>{{ $opt }}</span>
                                </label>
                            @endif
                        @endforeach
                    </div>
                @elseif ($questions[$index]['type'] === 'checkbox')
                    <div class="space-y-2">
                        @foreach ($questions[$index]['options'] as $opt)
                            @if (trim($opt) !== '')
                                <label class="flex items-center gap-2 text-sm text-gray-700">
                                    <input type="checkbox">
                                    <span>{{ $opt }}</span>
                                </label>
                            @endif
                        @endforeach
                    </div>
                @elseif ($questions[$index]['type'] === 'date')
                    <input
                        type="date"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 bg-gray-50 text-gray-500"
                    >
                @endif
            </div>

            {{-- Opsi jawaban untuk tipe pilihan ganda dan checkbox --}}
            @if (in_array($questions[$index]['type'], ['radio', 'checkbox', 'select']))
                <div class="space-y-3">
                    <label class="block text-sm font-medium text-gray-700">Pilihan Jawaban</label>

                    @foreach ($questions[$index]['options'] as $optIndex => $opt)
                        <div class="flex gap-2">
                            <input
                                type="text"
                                wire:model.defer="questions.{{ $index }}.options.{{ $optIndex }}"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2"
                                placeholder="Opsi jawaban"
                            >

                            <button
                                type="button"
                                wire:click="removeOption({{ $index }}, {{ $optIndex }})"
                                class="rounded-lg bg-red-100 px-3 py-2 text-sm text-red-700 hover:bg-red-200"
                            >
                                Hapus
                            </button>
                        </div>
                    @endforeach

                    <button
                        type="button"
                        wire:click="addOption({{ $index }})"
                        class="rounded-lg bg-indigo-100 px-4 py-2 text-sm font-medium text-indigo-700 hover:bg-indigo-200"
                    >
                        + Tambah Opsi
                    </button>
                </div>
            @endif
        </div>
    @endforeach

    <div class="flex flex-wrap gap-3">
        <button
            type="button"
            wire:click="addQuestion"
            class="rounded-lg bg-gray-200 px-4 py-2 font-medium text-gray-800 hover:bg-gray-300"
        >
            + Tambah Pertanyaan
        </button>

        <button
            type="button"
            wire:click="save"
            class="rounded-lg bg-indigo-600 px-5 py-2 font-medium text-white hover:bg-indigo-500"
        >
            Simpan Form
        </button>
    </div>
</div>