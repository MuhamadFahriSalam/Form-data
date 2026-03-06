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
            <div class="rounded-xl bg-white shadow border border-gray-200 p-6 space-y-4">
                <div>
                    <label class="block text-lg font-medium text-gray-900 mb-2">
                        {{ $question->question }}
                        @if ($question->is_required)
                            <span class="text-red-500">*</span>
                        @endif
                    </label>

                    @php
                        $field = "answers." . $question->id;
                    @endphp

                    @if ($question->type === 'text')
                        <input
                            type="text"
                            wire:model.defer="{{ $field }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2"
                            placeholder="Jawaban singkat"
                        >

                    @elseif ($question->type === 'textarea')
                        <textarea
                            wire:model.defer="{{ $field }}"
                            rows="4"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2"
                            placeholder="Tulis jawaban di sini..."
                        ></textarea>

                    @elseif ($question->type === 'radio')
                        <div class="space-y-2">
                            @foreach ($question->options ?? [] as $option)
                                <label class="flex items-center gap-2">
                                    <input
                                        type="radio"
                                        wire:model.defer="{{ $field }}"
                                        value="{{ $option }}"
                                    >
                                    <span>{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>

                    @elseif ($question->type === 'checkbox')
                        <div class="space-y-2">
                            @foreach ($question->options ?? [] as $option)
                                <label class="flex items-center gap-2">
                                    <input
                                        type="checkbox"
                                        wire:model.defer="{{ $field }}"
                                        value="{{ $option }}"
                                    >
                                    <span>{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>

                    @elseif ($question->type === 'select')
                        <select
                            wire:model.defer="{{ $field }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2"
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
                            class="w-full rounded-lg border border-gray-300 px-4 py-2"
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
                class="rounded-lg bg-indigo-600 px-5 py-2 font-medium text-white hover:bg-indigo-500"
            >
                Kirim Jawaban
            </button>
        </div>
    </form>
</div>