

<div class="max-w-3xl mx-auto p-6 space-y-6">
    {{-- Success --}}
    @if (session('success'))
        <div class="rounded-lg bg-green-100 px-4 py-3 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error --}}
    @if (session('error'))
        <div class="rounded-lg bg-red-100 px-4 py-3 text-red-800">
            {{ session('error') }}
        </div>
    @endif

    {{-- Sudah mengisi --}}
    @if ($alreadySubmitted)
        <div class="rounded-lg bg-yellow-100 px-4 py-3 text-yellow-800">
            Anda sudah mengisi form ini.
        </div>
    @endif
<div class="max-w-3xl mx-auto p-6 space-y-6">
    @if (session('success'))
        <div class="rounded-lg bg-green-100 px-4 py-3 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-xl bg-white shadow border border-gray-200 overflow-hidden">
        <div class="h-3 bg-indigo-600"></div>

        <div class="p-6 space-y-3">
            <h1 class="text-3xl font-bold text-gray-900">{{ $form->title }}</h1>

            @if ($form->description)
                <p class="text-gray-600">{{ $form->description }}</p>
            @endif
        </div>
    </div>

    <form wire:submit.prevent="submit" class="space-y-6">
        @foreach ($form->questions as $question)
            @php
                $field = 'answers.' . $question->id;
            @endphp

            <div class="rounded-xl bg-white shadow border border-gray-200 p-6 space-y-4">
                <div>
                    <label class="block text-lg font-medium text-gray-900 mb-2">
                        {{ $question->question }}

                        @if ($question->is_required)
                            <span class="text-red-500">*</span>
                            <span class="text-sm font-normal text-red-600">(wajib diisi)</span>
                        @endif
                    </label>

                    @if ($question->type === 'text')
                        <input
                            type="text"
                            wire:model.defer="{{ $field }}"
                            class="w-full rounded-lg border px-4 py-2 @error($field) border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            placeholder="Jawaban singkat"
                        >

                    @elseif ($question->type === 'textarea')
                        <textarea
                            wire:model.defer="{{ $field }}"
                            rows="4"
                            class="w-full rounded-lg border px-4 py-2 @error($field) border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            placeholder="Tulis jawaban di sini..."
                        ></textarea>

                    @elseif ($question->type === 'radio')
                        <div class="space-y-2">
                            @foreach ($question->options ?? [] as $option)
                                <label class="flex items-center gap-2 text-gray-700">
                                    <input
                                        type="radio"
                                        name="question_{{ $question->id }}"
                                        wire:model.defer="{{ $field }}"
                                        value="{{ $option }}"
                                        class="text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                    >
                                    <span>{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>

                    @elseif ($question->type === 'checkbox')
                        <div class="space-y-2">
                            @foreach ($question->options ?? [] as $option)
                                <label class="flex items-center gap-2 text-gray-700">
                                    <input
                                        type="checkbox"
                                        name="question_{{ $question->id }}[]"
                                        wire:model.defer="{{ $field }}"
                                        value="{{ $option }}"
                                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                    >
                                    <span>{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>

                    @elseif ($question->type === 'select')
                        <select
                            wire:model.defer="{{ $field }}"
                            class="w-full rounded-lg border px-4 py-2 @error($field) border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >
                            <option value="">Pilih jawaban</option>
                            @foreach ($question->options ?? [] as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>

                    @elseif ($question->type === 'date')
                        <input
                            type="date"
                            wire:model.defer="{{ $field }}"
                            class="w-full rounded-lg border px-4 py-2 @error($field) border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >
                    @endif

                    @error($field)
                        <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        @endforeach

        <div>
<button
    type="submit"
    @disabled($alreadySubmitted)
    class="rounded-lg bg-indigo-600 px-5 py-2 font-medium text-white hover:bg-indigo-500 disabled:bg-gray-400 disabled:cursor-not-allowed"
>
    Kirim Jawaban
</button>
        </div>
    </form>
</div>
</div>
