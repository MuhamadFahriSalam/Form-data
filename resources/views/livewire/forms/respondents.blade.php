@section('title','pengisi-form')

<div class="max-w-7xl mx-auto p-6 space-y-6">

    {{-- NOTIFIKASI --}}
    @if (session('success'))
        <div class="p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="p-3 bg-red-100 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- HEADER --}}
    <div class="rounded-xl bg-gray-900 px-6 py-6 shadow">
        <div class="lg:flex lg:items-center lg:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl/7 font-bold text-white sm:truncate sm:text-3xl sm:tracking-tight">
                    Pengisi Form
                </h2>

                {{-- DESKRIPSI --}}
                <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:gap-x-6">
                    @php
                        $totalUsers = \App\Models\User::count();
                        $filled = method_exists($respondents, 'total') ? $respondents->total() : $respondents->count();
                        $percent = $totalUsers > 0 ? round(($filled / $totalUsers) * 100) : 0;
                    @endphp

                    <div class="mt-3 w-full">
                        <div class="flex justify-between text-sm text-gray-300">
                            <span>Persentase Pengisian</span>
                            <span>{{ $percent }}%</span>
                        </div>

                        <div class="mt-1 h-2 bg-white/20 rounded-full">
                            <div class="h-2 bg-green-400 rounded-full transition-all"
                                style="width: {{ $percent }}%">
                            </div>
                        </div>
                    </div>

                    <div class="mt-2 flex items-center text-sm text-gray-300">
                        Form: {{ $form->title }}
                    </div>
                    
                    <div class="mt-2 flex items-center text-sm text-gray-300">
                        Total: {{ method_exists($respondents, 'total') ? $respondents->total() : $respondents->count() }} data
                    </div>
                </div>
            </div>

            {{-- AKSI --}}
            <div class="mt-5 flex flex-wrap lg:mt-0 lg:ml-4 gap-3 items-center">
                <div class="relative">
                    <input
                        type="text"
                        wire:model.live="search"
                        placeholder="Cari nama, email, jawaban..."
                        class="w-80 rounded-md border border-white/20 bg-white/10 px-4 py-2 text-sm text-white placeholder:text-gray-300 focus:border-white/40 focus:outline-none"
                    >
                </div>

                <button
                    type="button"
                    wire:click="exportRespondents"
                    class="inline-flex items-center rounded-md bg-white/10 px-3 py-2 text-sm font-semibold text-white hover:bg-white/20"
                >
                    Export
                </button>

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-500"
                >
                    Kembali
                </a>
            </div>
        </div>
    </div>

    {{-- TABLE RESPONDENTS --}}
    <div class="relative overflow-x-auto bg-white shadow rounded-lg border border-gray-200">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="text-sm bg-gray-100 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 font-medium">No</th>
                    <th class="px-6 py-3 font-medium">Nama</th>
                    <th class="px-6 py-3 font-medium">Email</th>
                    <th class="px-6 py-3 font-medium">Aksi</th>
                    <th class="px-6 py-3 font-medium">Waktu Isi</th>
                </tr>
            </thead>

            {{-- DATA RESPONDEN --}}
            <tbody>
                @forelse ($respondents as $index => $submission)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ method_exists($respondents, 'firstItem') ? $respondents->firstItem() + $index : $index + 1 }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                            {{ $submission->user->name ?? 'User' }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $submission->user->email ?? '-' }}
                        </td>

                        <td class="px-6 py-4">
                            <button
                                wire:click="showDetail({{ $submission->id }})"
                                class="px-3 py-1.5 bg-blue-500 text-white rounded-lg text-sm hover:bg-blue-600"
                            >
                                Lihat Detail
                            </button>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $submission->created_at?->format('d M Y H:i') ?? '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- MODAL DETAIL JAWABAN --}}
        @if ($showModal && $selectedSubmission)
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

                <div class="bg-white w-[700px] max-h-[80vh] rounded-xl shadow-lg flex flex-col">
                    
                    {{-- HEADER --}}
                    <div class="flex justify-between items-center p-6 border-b">
                        <h2 class="text-lg font-bold">Detail Jawaban</h2>
                        <button wire:click="closeModal" class="text-gray-500 hover:text-black">✕</button>
                    </div>

                    {{-- CONTENT (SCROLL DI SINI) --}}
                    <div class="overflow-y-auto p-6 space-y-4">
                        <div>
                            <strong>Nama:</strong> {{ $selectedSubmission->user->name ?? '-' }}
                        </div>
                        <div>
                            <strong>Email:</strong> {{ $selectedSubmission->user->email ?? '-' }}
                        </div>

                        <hr>

                        @foreach ($questions as $question)
                            @php
                                $answer = $selectedSubmission->answers->firstWhere('form_question_id', $question->id);
                                $value = $answer->answer ?? null;
                                $decoded = json_decode($value, true);
                            @endphp

                            <div>
                                <strong>{{ $question->question }}</strong><br>

                                @if ($question->type === 'checkbox' && is_array($decoded))
                                    {{ implode(', ', $decoded) }}
                                @elseif ($question->type === 'date' && !empty($value))
                                    {{ \Carbon\Carbon::parse($value)->format('d M Y') }}
                                @elseif ($question->type === 'file' && !empty($value))
                                    <a href="{{ \Storage::url($value) }}" target="_blank" class="text-blue-500 underline">
                                        Lihat File
                                    </a>
                                @else
                                    {{ $value ?? '-' }}
                                @endif
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        @endif

        {{-- PAGINATION --}}
        @if (method_exists($respondents, 'links'))
            <div class="p-4">
                {{ $respondents->links() }}
            </div>
        @endif
    </div>
</div>
