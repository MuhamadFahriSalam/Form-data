<div class="mt-6">
    <h2 class="text-xl font-semibold mb-4">Form Tersedia</h2>

    @if ($forms->count())
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($forms as $form)
                <div class="bg-white shadow rounded-xl p-5 border">
                    <h3 class="text-lg font-bold text-gray-800">
                        {{ $form->title }}
                    </h3>

                    <p class="text-sm text-gray-600 mt-2">
                        {{ $form->description ?: 'Tidak ada deskripsi.' }}
                    </p>

                    <div class="mt-4">
                        <a href="{{ route('forms.show', $form->id) }}"
                           class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Isi Form
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 px-4 py-3 rounded-lg">
            Belum ada form yang tersedia.
        </div>
    @endif
</div>
