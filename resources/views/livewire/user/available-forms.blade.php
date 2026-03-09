<div class="mt-6">
    <h2 class="text-xl font-semibold text-slate-800 mb-6">
        Form Tersedia
    </h2>

    @if ($forms->count())
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($forms as $form)

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-lg hover:-translate-y-1">

                    <!-- Gradient header -->
                    <div class="h-2 bg-gradient-to-r from-violet-500 to-indigo-500"></div>

                    <div class="p-6 flex flex-col h-full">

                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-slate-800">
                                {{ $form->title }}
                            </h3>

                            <p class="text-sm text-slate-500 mt-2">
                                {{ $form->description ?: 'Tidak ada deskripsi.' }}
                            </p>
                        </div>

                        <!-- Button -->
                        <div class="mt-6">
                            <a href="{{ route('forms.show', $form->id) }}"
                               class="inline-flex items-center justify-center rounded-xl bg-violet-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-violet-700 focus:ring-2 focus:ring-violet-400">
                                Isi Form
                            </a>
                        </div>

                    </div>
                </div>

            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="flex flex-col items-center justify-center rounded-2xl border border-slate-200 bg-white p-8 text-center shadow-sm">

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 mb-3">
                📄
            </div>

            <h3 class="text-sm font-semibold text-slate-700">
                Belum ada form tersedia
            </h3>

            <p class="text-xs text-slate-500 mt-1">
                Form akan muncul di sini ketika admin membuatnya.
            </p>

        </div>
    @endif
</div>