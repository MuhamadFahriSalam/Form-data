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
                        <th class="px-6 py-4 text-left">Waktu Isi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($respondents as $index => $submission)
                        <tr class="border-t hover:bg-slate-50">
                            <td class="px-6 py-4">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-6 py-4 font-medium">
                                {{ $submission->user->name ?? 'User' }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $submission->user->email ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $submission->created_at->format('d M Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-10 text-slate-500">
                                Belum ada user yang mengisi form
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

    </div>
</div>