<div class="min-h-screen bg-slate-50">
    <div class="mx-auto max-w-6xl px-6 py-10">

        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">
                    Pengisi Form
                </h1>

                <p class="text-slate-500 mt-1">
                    {{ $form->title }}
                </p>
            </div>

            <a
                href="{{ route('dashboard') }}"
                class="rounded-xl border px-4 py-2 text-sm hover:bg-slate-100"
            >
                Kembali
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow border overflow-hidden">

                                        <table class="w-full text-sm">
                                            <thead class="bg-slate-100 text-slate-600">
                                                <tr>
                                                    <th class="px-6 py-4 text-left">No</th>
                                                    <th class="px-6 py-4 text-left">Nama</th>
                                                    <th class="px-6 py-4 text-left">Email</th>

                                                    {{-- Header pertanyaan --}}
                                                    @foreach ($questions as $question)
                                                        <th class="px-6 py-4 text-left min-w-[160px]">
                                                            {{ $question->question }}
                                                        </th>
                                                    @endforeach

                                                    <th class="px-6 py-4 text-left">Waktu Isi</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @forelse ($respondents as $index => $submission)
                                                    <tr class="border-t hover:bg-slate-50">

                                                        {{-- No --}}
                                                        <td class="px-6 py-4">
                                                            {{ $index + 1 }}
                                                        </td>

                                                        {{-- Nama --}}
                                                        <td class="px-6 py-4 font-medium">
                                                            {{ $submission->user->name ?? 'User' }}
                                                        </td>

                                                        {{-- Email --}}
                                                        <td class="px-6 py-4 text-slate-600">
                                                            {{ $submission->user->email ?? '-' }}
                                                        </td>

                                                        {{-- Jawaban --}}
                                                        @foreach ($questions as $question)

                                                            @php
                                                                $answer = $submission->answers->firstWhere('form_question_id', $question->id);
                                                                $value = $answer->answer ?? null;
                                                                $decoded = json_decode($value, true);
                                                            @endphp

                                                            <td class="px-6 py-4 text-slate-600 whitespace-pre-line">

                                                                {{-- Checkbox --}}
                                                                @if ($question->type === 'checkbox' && is_array($decoded))
                                                                    {{ implode(', ', $decoded) }}

                                                                {{-- Date --}}
                                                                @elseif ($question->type === 'date' && !empty($value))
                                                                    {{ \Carbon\Carbon::parse($value)->format('d M Y') }}

                                                                {{-- Select / Radio --}}
                                                                @elseif ($question->type === 'select' || $question->type === 'radio')
                                                                    {{ $value }}

                                                                {{-- Text / Textarea --}}
                                                                @elseif (!empty($value))
                                                                    {{ $value }}

                                                                @else
                                                                    -
                                                                @endif

                                                            </td>

                                                        @endforeach

                                                        {{-- Waktu isi --}}
                                                        <td class="px-6 py-4 text-slate-600">
                                                            {{ $submission->created_at->format('d M Y H:i') }}
                                                        </td>

                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="{{ 4 + $questions->count() }}" class="text-center py-10 text-slate-500">
                                                            Belum ada user yang mengisi form
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>


        </div>

    </div>
</div>
