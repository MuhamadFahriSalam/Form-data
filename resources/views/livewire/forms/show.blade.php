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
                @if ($alreadySubmitted)
                    <div class="rounded-2xl border border-blue-200 bg-blue-50 px-5 py-4 text-sm text-blue-700">
                        Anda sudah mengisi form ini.
                    </div>
                @else
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

                                @if ($question->type === 'text')
                                    <input
                                        type="text"
                                        wire:model.defer="answers.{{ $question->id }}"
                                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                        placeholder="Tulis jawaban Anda"
                                    >
                                @elseif ($question->type === 'textarea')
                                    <textarea
                                        wire:model.defer="answers.{{ $question->id }}"
                                        rows="4"
                                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                        placeholder="Tulis jawaban Anda"
                                    ></textarea>
                                @elseif ($question->type === 'email')
                                    <input
                                        type="email"
                                        wire:model.defer="answers.{{ $question->id }}"
                                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                        placeholder="Masukkan email"
                                    >
                                @elseif ($question->type === 'number')
                                    <input
                                        type="number"
                                        wire:model.defer="answers.{{ $question->id }}"
                                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                        placeholder="Masukkan angka"
                                    >
                                @elseif ($question->type === 'date')
                                    <input
                                        type="date"
                                        wire:model.defer="answers.{{ $question->id }}"
                                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                    >
            @elseif ($question->type === 'file')
                <input
                    type="file"
                    wire:model="answers.{{ $question->id }}"
                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition file:mr-4 file:rounded-lg file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-blue-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                >
                <div wire:loading wire:target="answers.{{ $question->id }}" class="mt-2 text-sm text-blue-600">
                    Uploading...
                </div>

            @elseif ($question->type === 'number')
                <input
                    type="number"
                    wire:model.defer="answers.{{ $question->id }}"
                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    placeholder="Masukkan angka"
                >
                                @elseif ($question->type === 'select')
                                    <select
                                        wire:model.defer="answers.{{ $question->id }}"
                                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                    >
                                        <option value="">Pilih jawaban</option>
                                        @foreach ($options ?? [] as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                            @elseif ($question->type === 'radio')
                                <div class="space-y-3">
                                    @foreach ($options ?? [] as $option)
                                        <label class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 transition hover:border-blue-300 hover:bg-blue-50">
                                            <input
                                                type="radio"
                                                name="question_{{ $question->id }}"
                                                wire:model.defer="answers.{{ $question->id }}"
                                                value="{{ $option }}"
                                                class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"
                                            >
                                            <span>{{ $option }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @elseif ($question->type === 'checkbox')
                                    <div class="space-y-3">
                                        @foreach ($options ?? [] as $option)
                                            <label class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 transition hover:border-blue-300 hover:bg-blue-50">
                                                <input
                                                    type="checkbox"
                                                    wire:model.defer="answers.{{ $question->id }}"
                                                    value="{{ $option }}"
                                                    class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                                                >
                                                <span>{{ $option }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                @endif
                                @error('answers.' . $question->id)
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach

                        <!-- Form Actions -->
                        <div class="flex justify-between pt-4">
                            <a
                                href="{{ route('user.dashboard') }}"
                                class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-100 focus:outline-none focus:ring-4 focus:ring-slate-200"
                            >
                                ← Kembali
                            </a>
                            <button
                                type="submit"
                                class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200"
                            >
                                Kirim Jawaban
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
