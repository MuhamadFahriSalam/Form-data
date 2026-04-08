<div 
    x-data="{
        search: '',
    }"
    class="min-h-screen bg-gradient-to-b from-slate-50 via-white to-slate-100 py-10"
>
    <div class="mx-auto max-w-6xl px-4">

        {{-- HEADER --}}
        <div class="mb-8 overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-emerald-800 to-slate-900 shadow-lg">
            <div class="flex items-center justify-between px-6 py-6 text-white">

                <div>
                    <h1 class="text-2xl font-bold sm:text-3xl">
                        Hasil Quiz
                    </h1>
                    <p class="mt-1 text-sm text-white/70">
                        {{ $quiz->title }}
                    </p>
                </div>

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center rounded-xl bg-white/10 px-4 py-2 text-sm backdrop-blur hover:bg-white/20 transition"
                >
                    ← Kembali
                </a>
            </div>
        </div>

        {{-- STATS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            @php
            $totalUsers = \App\Models\User::count();
            $filled = $attempts->count();
            $percent = $totalUsers > 0 ? round(($filled / $totalUsers) * 100) : 0;
        @endphp

        <div class="bg-slate-900 text-white rounded-2xl p-4 shadow border border-slate-800">
            <p class="text-sm text-slate-400">Persentase Pengerjaan</p>
            <p class="text-2xl font-bold text-emerald-400">
                {{ $percent }}%
            </p>

            <div class="mt-2 h-2 bg-slate-700 rounded-full">
                <div class="h-2 bg-emerald-500 rounded-full"
                    style="width: {{ $percent }}%">
                </div>
            </div>
        </div>

            <div class="bg-slate-900 text-white rounded-2xl p-4 shadow border border-slate-800">
                <p class="text-sm text-slate-400">Total Peserta</p>
                <p class="text-2xl font-bold">{{ $attempts->count() }}</p>
            </div>

            <div class="bg-slate-900 text-white rounded-2xl p-4 shadow border border-slate-800">
                <p class="text-sm text-slate-500">Nilai Tertinggi</p>
                <p class="text-2xl font-bold text-emerald-600">
                    {{ $attempts->max('score') ?? 0 }}
                </p>
            </div>

            <div class="bg-slate-900 text-white rounded-2xl p-4 shadow border border-slate-800">
                <p class="text-sm text-slate-500">Rata-rata</p>
                <p class="text-2xl font-bold text-sky-600">
                    {{ round($attempts->avg('score'), 1) ?? 0 }}
                </p>
            </div>

        </div>

        {{-- SEARCH --}}
        <div class="mb-6">
            <input
                type="text"
                x-model="search"
                placeholder="Cari nama peserta..."
                class="w-full rounded-2xl border px-4 py-3 text-sm shadow-sm focus:ring-2 focus:ring-emerald-300"
            >
        </div>

        {{-- TABLE --}}
        <div class="overflow-hidden rounded-3xl border bg-white shadow">

            <div class="
                {{ $attempts->count() > 5 ? 'max-h-[450px] overflow-auto' : '' }}
            ">
            
                <table class="min-w-full text-sm">

                    {{-- HEADER --}}
                    <thead class="bg-slate-50 text-slate-500 text-xs uppercase {{ $attempts->count() > 5 ? 'sticky top-0 z-10' : '' }}">
                        <tr>
                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4 text-left">Peserta</th>
                            <th class="px-6 py-4 text-left">Score</th>
                            <th class="px-6 py-4 text-left">Tanggal</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @foreach ($attempts as $index => $attempt)
                            <tr
                                x-show="
                                    '{{ strtolower($attempt->user->name ?? '') }}'
                                    .includes(search.toLowerCase())
                                "
                                class="hover:bg-slate-50 transition"
                            >

                                {{-- RANK --}}
                                <td class="px-6 py-4 font-bold text-slate-600">
                                    {{ $index + 1 }}
                                </td>

                                {{-- USER --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">

                                        <div class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center font-bold text-emerald-700">
                                            {{ strtoupper(substr($attempt->user->name ?? 'U', 0, 1)) }}
                                        </div>

                                        <div>
                                            <p class="font-semibold text-slate-800">
                                                {{ $attempt->user->name ?? '-' }}
                                            </p>
                                            <p class="text-xs text-slate-500">
                                                {{ $attempt->user->email ?? '-' }}
                                            </p>
                                        </div>

                                    </div>
                                </td>

                                {{-- SCORE --}}
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-sm font-semibold text-emerald-700">
                                        {{ $attempt->score }}
                                    </span>
                                </td>

                                {{-- DATE --}}
                                <td class="px-6 py-4 text-slate-500">
                                    {{ $attempt->created_at->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>