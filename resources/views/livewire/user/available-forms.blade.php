<div class="mt-6">
    <h2 class="mb-4 text-xl font-semibold">Form Tersedia</h2>

    @if ($forms->count())
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
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
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="rounded-lg border border-yellow-200 bg-yellow-50 px-4 py-3 text-yellow-700">
            Belum ada form yang tersedia.
        </div>
    @endif
</div>
