<div class="p-4 max-w-6xl mx-auto space-y-6">

    {{-- HEADER + BACK BUTTON --}}
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-xl font-bold text-slate-800">📊 Monitoring Dashboard</h1>
            <p class="text-xs text-slate-500">Analisis performa Form & Quiz</p>
        </div>

        <a href="{{ route('admin.dashboard') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-slate-800 px-4 py-2 text-sm text-white hover:bg-slate-700 transition">
            ← Kembali
        </a>

    </div>

    {{-- SUMMARY CARDS (LEBIH KECIL) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="p-4 rounded-xl bg-gradient-to-br from-violet-500 to-indigo-500 text-white shadow">
            <p class="text-xs opacity-80">Total User</p>
            <p class="text-xl font-bold mt-1">{{ $totalUsers }}</p>
        </div>

        <div class="p-4 rounded-xl bg-white shadow">
            <p class="text-xs text-slate-500">Total Form</p>
            <p class="text-xl font-bold text-slate-800 mt-1">{{ $forms->count() }}</p>
        </div>

        <div class="p-4 rounded-xl bg-white shadow">
            <p class="text-xs text-slate-500">Total Quiz</p>
            <p class="text-xl font-bold text-slate-800 mt-1">{{ $quizzes->count() }}</p>
        </div>

    </div>

    {{-- ================= CHART (LEBIH KECIL) ================= --}}
    <div class="bg-white p-4 rounded-xl shadow">
        <h2 class="text-sm font-semibold mb-2">📈 Progress Overview</h2>
        <div class="h-64"> {{-- 🔥 batasi tinggi --}}
            <canvas id="progressChart"></canvas>
        </div>
    </div>

    {{-- ================= FORM ================= --}}
    <div>
        <h2 class="text-lg font-semibold mb-3 text-slate-800">📄 Monitoring Form</h2>

        <div class="grid md:grid-cols-2 gap-3">

            @foreach($forms as $form)

                @php
                    $total = $totalUsers > 0 ? $totalUsers : 1;
                    $filled = $form->submissions_count;
                    $percent = round(($filled / $total) * 100);
                @endphp

                <div class="p-4 bg-white rounded-xl shadow hover:shadow-md transition">

                    <div class="flex justify-between mb-1">
                        <h3 class="text-sm font-semibold text-slate-800">{{ $form->title }}</h3>
                        <span class="text-xs font-bold text-violet-600">{{ $percent }}%</span>
                    </div>

                    <div class="h-1.5 bg-slate-200 rounded-full">
                        <div class="h-1.5 bg-violet-500 rounded-full"
                             style="width: {{ $percent }}%"></div>
                    </div>

                    <p class="text-[10px] text-slate-500 mt-1">
                        {{ $filled }} / {{ $totalUsers }} user
                    </p>

                </div>

            @endforeach

        </div>
    </div>

    {{-- ================= QUIZ ================= --}}
    <div>
        <h2 class="text-lg font-semibold mb-3 text-slate-800">🧠 Monitoring Quiz</h2>

        <div class="grid md:grid-cols-2 gap-3">

            @foreach($quizzes as $quiz)

                @php
                    $total = $totalUsers > 0 ? $totalUsers : 1;
                    $filled = $quiz->attempts_count;
                    $percent = round(($filled / $total) * 100);
                @endphp

                <div class="p-4 bg-white rounded-xl shadow hover:shadow-md transition">

                    <div class="flex justify-between mb-1">
                        <h3 class="text-sm font-semibold text-slate-800">{{ $quiz->title }}</h3>
                        <span class="text-xs font-bold text-emerald-600">{{ $percent }}%</span>
                    </div>

                    <div class="h-1.5 bg-slate-200 rounded-full">
                        <div class="h-1.5 bg-emerald-500 rounded-full"
                             style="width: {{ $percent }}%"></div>
                    </div>

                    <p class="text-[10px] text-slate-500 mt-1">
                        {{ $filled }} / {{ $totalUsers }} user
                    </p>

                </div>

            @endforeach

        </div>
    </div>

    {{-- ================= CHART SCRIPT ================= --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const ctx = document.getElementById('progressChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach($forms as $form)
                            "{{ $form->title }}",
                        @endforeach
                        @foreach($quizzes as $quiz)
                            "{{ $quiz->title }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach($forms as $form)
                                {{ round(($form->submissions_count / max($totalUsers,1)) * 100) }},
                            @endforeach
                            @foreach($quizzes as $quiz)
                                {{ round(($quiz->attempts_count / max($totalUsers,1)) * 100) }},
                            @endforeach
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false, // 🔥 biar bisa kecil
                    plugins: { legend: { display: false }},
                    scales: {
                        y: { beginAtZero: true, max: 100 }
                    }
                }
            });

        });
    </script>
</div>