<div class="mt-6">
    <h2 class="mb-6 text-xl font-semibold text-slate-800">
    <h2 class="mb-4 text-xl font-semibold">Form Tersedia</h2>
    <h2 class="text-xl font-semibold text-slate-800 mb-6">
        Form Tersedia
    </h2>

    @if ($forms->count())
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($forms as $form)
                <div class="rounded-xl border bg-white p-5 shadow">
                    <div class="flex items-start justify-between gap-3">
                        <h3 class="text-lg font-bold text-gray-800">
                            {{ $form->title }}
                        </h3>

                        @if ($form->status === 'upcoming')
                            <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                Belum Dibuka
                            </span>
                        @elseif ($form->status === 'closed')
                            <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                Sudah Ditutup
                            </span>
                        @else
                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Sedang Dibuka
                            </span>
                        @endif
                    </div>

                    <p class="mt-2 text-sm text-gray-600">
                        {{ $form->description ?: 'Tidak ada deskripsi.' }}
                    </p>

                    <div class="mt-3 space-y-1 text-xs text-gray-500">
                        <div>
                            Mulai:
                            {{ $form->opens_at ? $form->opens_at->format('d M Y H:i') : '-' }}
                        </div>
                        <div>
                            Batas akhir:
                            {{ $form->closes_at ? $form->closes_at->format('d M Y H:i') : '-' }}
                        </div>
                    </div>

                    <div class="mt-4">
                        @if ($form->status === 'open')
                            <a href="{{ route('forms.show', $form->id) }}"
                               class="inline-block rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                                Isi Form
                            </a>
                        @elseif ($form->status === 'upcoming')
                            <button
                                type="button"
                                disabled
                                class="inline-block cursor-not-allowed rounded-lg bg-yellow-500 px-4 py-2 text-white opacity-80">
                                Belum Dibuka
                            </button>
                        @else
                            <button
                                type="button"
                                disabled
                                class="inline-block cursor-not-allowed rounded-lg bg-red-500 px-4 py-2 text-white opacity-80">
                                Sudah Ditutup
                            </button>
                        @endif

            @foreach ($forms as $form)
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                    <!-- Gradient header -->
                    <div class="h-2 bg-gradient-to-r from-violet-500 to-indigo-500"></div>

                    <div class="p-6 flex flex-col h-full">

                        <!-- Header -->
                        <div class="flex items-start justify-between gap-3">
                            <h3 class="text-lg font-semibold text-slate-800">
                                {{ $form->title }}
                            </h3>

                            @if ($form->status === 'upcoming')
                                <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                    Belum Dibuka
                                </span>
                            @elseif ($form->status === 'closed')
                                <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                    Sudah Ditutup
                                </span>
                            @else
                                <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                    Sedang Dibuka
                                </span>
                            @endif
                        </div>

                        <!-- Description -->
                        <p class="mt-3 text-sm text-slate-500">
                            {{ $form->description ?: 'Tidak ada deskripsi.' }}
                        </p>

                        <!-- Date Info -->
                        <div class="mt-3 space-y-1 text-xs text-slate-500">
                            <div>
                                Mulai:
                                {{ $form->opens_at ? $form->opens_at->format('d M Y H:i') : '-' }}
                            </div>
                            <div>
                                Batas akhir:
                                {{ $form->closes_at ? $form->closes_at->format('d M Y H:i') : '-' }}
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="mt-6">
                            @if ($form->status === 'open')
                                <a href="{{ route('forms.show', $form->id) }}"
                                   class="inline-flex items-center justify-center rounded-xl bg-violet-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-violet-700 focus:ring-2 focus:ring-violet-400">
                                    Isi Form
                                </a>

                            @elseif ($form->status === 'upcoming')
                                <button
                                    type="button"
                                    disabled
                                    class="cursor-not-allowed rounded-xl bg-yellow-500 px-4 py-2 text-sm text-white opacity-80">
                                    Belum Dibuka
                                </button>

                            @else
                                <button
                                    type="button"
                                    disabled
                                    class="cursor-not-allowed rounded-xl bg-red-500 px-4 py-2 text-sm text-white opacity-80">
                                    Sudah Ditutup
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="rounded-lg border border-yellow-200 bg-yellow-50 px-4 py-3 text-yellow-700">
            Belum ada form yang tersedia.
        <!-- Empty State -->
        <div class="flex flex-col items-center justify-center rounded-2xl border border-slate-200 bg-white p-8 text-center shadow-sm">

            <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100">
                📄
            </div>

            <h3 class="text-sm font-semibold text-slate-700">
                Belum ada form tersedia
            </h3>

            <p class="mt-1 text-xs text-slate-500">
                Form akan muncul di sini ketika admin membuatnya.
            </p>
        </div>

    @endif
</div>