<div
    x-data="{
        openUsersModal: false,
        selectedFormTitle: '',
        selectedUsers: [],
        showUsers(title, users) {
            this.selectedFormTitle = title
            this.selectedUsers = users
            this.openUsersModal = true
        },
        closeUsers() {
            this.openUsersModal = false
            this.selectedFormTitle = ''
            this.selectedUsers = []
        }
    }"
    class="min-h-screen bg-gradient-to-b from-slate-50 via-white to-slate-100"
>
    {{-- Template Section --}}
    <section class="border-b border-slate-200/80 bg-white/70 backdrop-blur">
        <div class="mx-auto max-w-7xl px-6 py-10 lg:px-10">
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-semibold tracking-tight text-slate-900 md:text-3xl">
                        Mulai formulir baru
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Pilih template untuk mulai lebih cepat
                    </p>
                </div>

                <a
                    href="{{ route('forms.create') }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm transition hover:-translate-y-0.5 hover:border-violet-300 hover:text-violet-700 hover:shadow-md"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Buat Baru
                </a>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-5">
                {{-- Form kosong --}}
                <a href="{{ route('forms.create') }}" class="group flex h-full flex-col">
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-violet-300 hover:shadow-xl">
                        <div class="flex h-52 items-center justify-center bg-gradient-to-br from-violet-50 via-white to-fuchsia-50">
                            <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-violet-600 text-5xl font-light text-white shadow-lg shadow-violet-200 transition group-hover:scale-105">
                                +
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 min-h-[56px]">
                        <p class="text-base font-semibold text-slate-900">Formulir kosong</p>
                        <p class="mt-1 text-sm text-slate-500">Mulai dari halaman kosong</p>
                    </div>
                </a>

                {{-- Template 1 --}}
                <div class="group flex h-full cursor-pointer flex-col">
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-emerald-300 hover:shadow-xl">
                        <div class="h-3 bg-gradient-to-r from-emerald-500 to-green-400"></div>
                        <div class="flex h-52 flex-col justify-start bg-gradient-to-br from-emerald-50 to-white p-4">
                            <div class="mb-4 h-3 w-2/3 rounded-full bg-emerald-200"></div>
                            <div class="space-y-3">
                                <div class="h-10 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                <div class="h-10 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                <div class="h-10 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 min-h-[56px]">
                        <p class="text-base font-semibold text-slate-900">Informasi Kontak</p>
                        <p class="mt-1 text-sm text-slate-500">Form sederhana untuk data kontak</p>
                    </div>
                </div>

                {{-- Template 2 --}}
                <div class="group flex h-full cursor-pointer flex-col">
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-sky-300 hover:shadow-xl">
                        <div class="h-3 bg-gradient-to-r from-sky-500 to-cyan-400"></div>
                        <div class="flex h-52 flex-col justify-start bg-gradient-to-br from-sky-50 to-white p-4">
                            <div class="mb-4 h-3 w-1/2 rounded-full bg-sky-200"></div>
                            <div class="space-y-3">
                                <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 min-h-[56px]">
                        <p class="text-base font-semibold text-slate-900">RSVP</p>
                        <p class="mt-1 text-sm text-slate-500">Cocok untuk konfirmasi kehadiran</p>
                    </div>
                </div>

                {{-- Template 3 --}}
                <div class="group flex h-full cursor-pointer flex-col">
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-fuchsia-300 hover:shadow-xl">
                        <div class="h-3 bg-gradient-to-r from-fuchsia-500 to-violet-400"></div>
                        <div class="flex h-52 flex-col justify-start bg-gradient-to-br from-fuchsia-50 to-white p-4">
                            <div class="mb-4 h-3 w-1/2 rounded-full bg-fuchsia-200"></div>
                            <div class="space-y-3">
                                <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 min-h-[56px]">
                        <p class="text-base font-semibold text-slate-900">Undangan Pesta</p>
                        <p class="mt-1 text-sm text-slate-500">Template acara yang lebih menarik</p>
                    </div>
                </div>

                {{-- Template 4 --}}
                <div class="group flex h-full cursor-pointer flex-col">
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-amber-300 hover:shadow-xl">
                        <div class="h-3 bg-gradient-to-r from-amber-500 to-orange-400"></div>
                        <div class="flex h-52 flex-col justify-start bg-gradient-to-br from-amber-50 to-white p-4">
                            <div class="mb-4 h-3 w-3/4 rounded-full bg-amber-200"></div>
                            <div class="space-y-3">
                                <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                                <div class="h-3 w-1/3 rounded-full bg-amber-100"></div>
                                <div class="h-10 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 min-h-[56px]">
                        <p class="text-base font-semibold text-slate-900">Pendaftaran</p>
                        <p class="mt-1 text-sm text-slate-500">Untuk registrasi peserta atau user</p>
                    </div>
                </div>

                {{-- Kelola Karyawan --}}
                <a href="{{ route('employees.index') }}" class="group flex h-full flex-col">
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-sky-300 hover:shadow-xl">
                        <div class="flex h-52 items-center justify-center bg-gradient-to-br from-sky-50 via-white to-blue-50">
                            <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-sky-600 text-white shadow-lg shadow-sky-200 transition group-hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5V4H2v16h5m10 0v-5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v5m10 0H7m8-12h.01M9 8h.01" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 min-h-[56px]">
                        <p class="text-base font-semibold text-slate-900">Kelola Karyawan</p>
                        <p class="mt-1 text-sm text-slate-500">Daftar Karyawan yang sudah mengisi formulir</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- Recent Forms --}}
    <section class="mx-auto max-w-7xl px-6 py-10 lg:px-10">
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold tracking-tight text-slate-900 md:text-3xl">
                    Formulir terbaru
                </h2>
                <p class="mt-2 text-sm text-slate-500">
                    Form yang baru dibuat
                </p>
            </div>

            <div class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-600 shadow-sm">
                Total: {{ $forms->count() }} form
            </div>
        </div>

        @if ($forms->count() > 0)
            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($forms as $form)
                    <div class="group overflow-hidden rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-violet-200 hover:shadow-[0_18px_50px_rgba(15,23,42,0.10)]">
                        <div class="mb-5 flex items-start justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-violet-100 text-violet-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l3.414 3.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2Z" />
                                    </svg>
                                </div>

                                <div>
                                    <h3 class="text-lg font-semibold text-slate-900 transition group-hover:text-violet-700">
                                        {{ $form->title }}
                                    </h3>
                                    <p class="mt-1 text-sm text-slate-500">
                                        Dibuat {{ $form->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                                    Total Pengisi
                                </p>
                                <p class="mt-2 text-2xl font-bold text-slate-900">
                                    {{ $form->submissions_count ?? 0 }}
                                </p>
                            </div>

                            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4">
                                <p class="text-xs font-medium uppercase tracking-wide text-emerald-600">
                                    Status
                                </p>
                                <p class="mt-2 text-sm font-semibold text-emerald-700">
                                    {{ ($form->submissions_count ?? 0) > 0 ? 'Ada Respon' : 'Belum Ada' }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-5 rounded-2xl border border-slate-200 bg-white p-4">
                            <div class="mb-3 flex items-center justify-between">
                                <h4 class="text-sm font-semibold text-slate-800">
                                    User yang sudah mengisi
                                </h4>
                                <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600">
                                    {{ $form->submissions_count ?? 0 }} orang
                                </span>
                            </div>

                            <div class="space-y-2">
                                @forelse (($form->submissions ?? collect())->take(3) as $submission)
                                    <div class="flex items-center gap-3 rounded-xl border border-slate-100 bg-slate-50 px-3 py-2">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-violet-100 text-sm font-semibold text-violet-700">
                                            {{ strtoupper(substr($submission->user->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <div class="min-w-0">
                                            <p class="truncate text-sm font-medium text-slate-800">
                                                {{ $submission->user->name ?? 'User' }}
                                            </p>
                                            <p class="text-xs text-slate-500">
                                                Sudah mengisi formulir
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="rounded-xl border border-dashed border-slate-200 bg-slate-50 px-4 py-5 text-center text-sm text-slate-500">
                                        Belum ada user yang mengisi form ini.
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="mt-6 flex flex-wrap items-center gap-3">
                            <a
                                href="#"
                                class="inline-flex items-center gap-2 rounded-xl bg-violet-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-violet-700 focus:outline-none focus:ring-4 focus:ring-violet-200"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12H9m12 0A9 9 0 1 1 3 12a9 9 0 0 1 18 0Z" />
                                </svg>
                                Lihat Form
                            </a>

                            <a
                                href="{{ route('forms.respondents', $form->id) }}"
                                class="inline-flex items-center gap-2 rounded-xl border border-sky-200 bg-sky-50 px-4 py-2.5 text-sm font-medium text-sky-700 transition hover:bg-sky-100"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M17 20h5V4H2v16h5m10 0v-5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v5m10 0H7" />
                                </svg>
                                Lihat Pengisi
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                <div class="relative px-6 py-20 text-center sm:px-10 sm:py-24">
                    <div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-r from-violet-500/10 via-fuchsia-500/10 to-sky-500/10"></div>

                    <div class="relative mx-auto flex h-20 w-20 items-center justify-center rounded-2xl bg-violet-100 text-violet-600 shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M19.5 14.25v-8.625a1.125 1.125 0 0 0-1.125-1.125H5.625A1.125 1.125 0 0 0 4.5 5.625v12.75A1.125 1.125 0 0 0 5.625 19.5H12m3-8.25h-6m6 3h-6m3 3h-3m9 1.5 3-3m0 0-3-3m3 3H15" />
                        </svg>
                    </div>

                    <h3 class="relative mt-6 text-3xl font-semibold tracking-tight text-slate-900 sm:text-4xl">
                        Belum ada formulir
                    </h3>

                    <p class="relative mx-auto mt-3 max-w-2xl text-base leading-7 text-slate-500 sm:text-lg">
                        Semua form yang baru dibuat akan tampil di bagian ini.
                    </p>
                </div>
            </div>
        @endif
    </section>

    {{-- Modal User Pengisi --}}
    <div
        x-show="openUsersModal"
        x-transition.opacity
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 p-4"
    >
        <div
            @click.away="closeUsers()"
            class="w-full max-w-2xl overflow-hidden rounded-3xl bg-white shadow-2xl"
        >
            <div class="bg-gradient-to-r from-sky-500 via-cyan-500 to-violet-500 px-6 py-5 text-white">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-semibold">
                            Daftar Pengisi Form
                        </h3>
                        <p class="mt-1 text-sm text-white/80">
                            Form: <span class="font-medium" x-text="selectedFormTitle"></span>
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="closeUsers()"
                        class="rounded-xl bg-white/10 p-2 transition hover:bg-white/20"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="max-h-[70vh] overflow-y-auto p-6">
                <template x-if="selectedUsers.length > 0">
                    <div class="space-y-3">
                        <template x-for="(user, index) in selectedUsers" :key="index">
                            <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-11 w-11 items-center justify-center rounded-full bg-violet-100 text-sm font-semibold text-violet-700">
                                        <span x-text="user.name ? user.name.charAt(0).toUpperCase() : 'U'"></span>
                                    </div>

                                    <div>
                                        <p class="text-sm font-semibold text-slate-900" x-text="user.name"></p>
                                        <p class="text-xs text-slate-500" x-text="user.email"></p>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <p class="text-xs font-medium text-slate-500">Waktu isi</p>
                                    <p class="text-sm text-slate-700" x-text="user.submitted_at"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>

                <template x-if="selectedUsers.length === 0">
                    <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-6 py-10 text-center">
                        <p class="text-sm font-medium text-slate-600">
                            Belum ada user yang mengisi form ini.
                        </p>
                    </div>
                </template>
            </div>

            <div class="flex justify-end border-t border-slate-100 px-6 py-4">
                <button
                    type="button"
                    @click="closeUsers()"
                    class="rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-slate-700"
                >
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>