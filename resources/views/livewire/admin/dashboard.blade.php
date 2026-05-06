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

                {{-- DROPDOWN buat baru --}} 
                <div x-data="{ open: false }" class="relative">
                    
                    {{-- BUTTON --}}
                    <button
                        @click="open = !open"
                        class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm transition hover:-translate-y-0.5 hover:border-violet-300 hover:text-violet-700 hover:shadow-md"
                    >
                        {{-- ICON PLUS --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>

                        Buat Baru

                        {{-- ICON ARROW --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- DROPDOWN --}}
                    <div
                        x-show="open"
                        @click.away="open = false"
                        x-transition
                        x-cloak
                        class="absolute right-0 z-50 mt-2 w-48 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-lg"
                    >

                        {{-- OPTION FORM --}}
                        <a
                            href="{{ route('forms.create') }}"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-slate-700 transition hover:bg-violet-50 hover:text-violet-700"
                        >
                            {{-- ICON FORM --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M9 12h6M9 16h6M9 8h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2Z" />
                            </svg>
                            Buat Form
                        </a>

                        {{-- OPTION QUIZ --}}
                        <a
                            href="{{ route('quiz.create') }}"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-slate-700 transition hover:bg-emerald-50 hover:text-emerald-700"
                        >
                            {{-- ICON QUIZ --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M9 9a3 3 0 116 0c0 1.5-1 2.2-2 2.8-.7.4-1 1-1 1.7" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M12 17h.01" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2Z" />
                            </svg>
                            Buat Quiz
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-5">
                {{-- Form kosong --}}
                <a href="{{ route('forms.create') }}" class="group flex h-full flex-col">
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-violet-300 hover:shadow-xl">

                        <div class="flex h-52 flex-col justify-center bg-gradient-to-br from-violet-50 via-white to-fuchsia-50 p-5">

                            {{-- ICON + HEADER --}}
                            <div class="mb-4 flex items-center gap-2">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-600 text-white shadow">
                                    {{-- ICON FORM --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M9 12h6M9 16h6M9 8h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2Z" />
                                    </svg>
                                </div>
                                <div class="h-3 w-1/2 rounded-full bg-violet-200"></div>
                            </div>

                            {{-- PREVIEW INPUT FORM --}}
                            <div class="space-y-3">

                                {{-- INPUT TEXT --}}
                                <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>

                                {{-- INPUT TEXT --}}
                                <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-slate-100"></div>

                                {{-- INPUT SELECT --}}
                                <div class="flex items-center gap-2 rounded-xl bg-white px-3 py-2 shadow-sm ring-1 ring-slate-100">
                                    <div class="h-3 w-1/3 rounded-full bg-slate-200"></div>
                                    <div class="ml-auto h-3 w-3 rounded-full bg-violet-400"></div>
                                </div>

                                {{-- BUTTON --}}
                                <div class="h-9 rounded-xl bg-violet-500 shadow-sm"></div>

                            </div>
                        </div>
                    </div>

                    <div class="mt-4 min-h-[56px]">
                        <p class="text-base font-semibold text-slate-900">Formulir kosong</p>
                        <p class="mt-1 text-sm text-slate-500">Mulai dari halaman kosong</p>
                    </div>
                </a>

                {{-- Quiz  --}}
                <a href="{{ route('quiz.create') }}" class="group flex h-full flex-col">
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-emerald-300 hover:shadow-xl flex flex-col h-52">

                        {{-- TOP BAR --}}
                        <div class="h-3 bg-gradient-to-r from-emerald-500 to-green-400"></div>

                        {{-- CONTENT (FIX: -mt-3 biar sejajar) --}}
                        <div class="flex flex-1 flex-col justify-center bg-gradient-to-br from-emerald-50 to-white p-5 -mt-14">

                            {{-- HEADER + ICON --}}
                            <div class="mb-4 flex items-center gap-2">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500 text-white shadow transition duration-300 group-hover:rotate-6">

                                    {{-- ICON QUIZ (QUESTION + CHECK) --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        
                                        {{-- QUESTION --}}
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M12 8a3 3 0 00-3 3h2a1 1 0 112 0c0 .5-.3.8-.8 1.1-.6.3-1.2.9-1.2 1.9" />
                                        
                                        {{-- DOT --}}
                                        <circle cx="12" cy="17" r="1" fill="currentColor" />

                                        {{-- CARD --}}
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2Z" />

                                        {{-- CHECK --}}
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M9 14l1.5 1.5L14 12" />
                                    </svg>

                                </div>

                                {{-- TITLE LINE --}}
                                <div class="h-3 w-1/2 rounded-full bg-emerald-200"></div>
                            </div>

                            {{-- OPTIONS PREVIEW --}}
                            <div class="space-y-3">

                                {{-- OPTION 1 --}}
                                <div class="flex items-center gap-3 rounded-xl bg-white px-3 py-2 shadow-sm ring-1 ring-slate-100">
                                    <div class="h-4 w-4 rounded-full border-2 border-emerald-400"></div>
                                    <div class="h-3 w-2/3 rounded-full bg-slate-200"></div>
                                </div>

                                {{-- OPTION 2 (SELECTED) --}}
                                <div class="flex items-center gap-3 rounded-xl bg-white px-3 py-2 shadow-sm ring-1 ring-emerald-200">
                                    <div class="flex h-4 w-4 items-center justify-center rounded-full border-2 border-emerald-500">
                                        <div class="h-2 w-2 rounded-full bg-emerald-500"></div>
                                    </div>
                                    <div class="h-3 w-1/2 rounded-full bg-slate-200"></div>
                                </div>

                                {{-- OPTION 3 --}}
                                <div class="flex items-center gap-3 rounded-xl bg-white px-3 py-2 shadow-sm ring-1 ring-slate-100">
                                    <div class="h-4 w-4 rounded border-2 border-emerald-400"></div>
                                    <div class="h-3 w-3/4 rounded-full bg-slate-200"></div>
                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- TEXT --}}
                    <div class="mt-4 min-h-[56px]">
                        <p class="text-base font-semibold text-slate-900">Quiz</p>
                        <p class="mt-1 text-sm text-slate-500">Buat soal quiz interaktif</p>
                    </div>
                </a>

                {{-- Template 4 --}}
                {{-- <div class="group flex h-full cursor-pointer flex-col">
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
                </div> --}}

                {{-- Kelola Karyawan --}}
                <a href="{{ route('employees.index') }}" class="group flex h-full flex-col">
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-sky-300 hover:shadow-xl">

                        <div class="flex h-52 flex-col justify-center bg-gradient-to-br from-sky-50 via-white to-blue-50 p-5">

                            {{-- HEADER --}}
                            <div class="mb-4 flex items-center gap-2">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-600 text-white shadow">
                                    {{-- ICON USER --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M16 14a4 4 0 10-8 0m8 0v1a4 4 0 01-8 0v-1m8 0a4 4 0 014 4v1H4v-1a4 4 0 014-4" />
                                    </svg>
                                </div>
                                <div class="h-3 w-1/2 rounded-full bg-sky-200"></div>
                            </div>

                            {{-- LIST KARYAWAN PREVIEW --}}
                            <div class="space-y-3">

                                {{-- ITEM 1 --}}
                                <div class="flex items-center gap-3 rounded-xl bg-white px-3 py-2 shadow-sm ring-1 ring-slate-100">
                                    <div class="h-8 w-8 rounded-full bg-sky-300"></div>
                                    <div class="flex-1">
                                        <div class="h-3 w-2/3 rounded-full bg-slate-200"></div>
                                        <div class="mt-1 h-2 w-1/3 rounded-full bg-slate-100"></div>
                                    </div>
                                </div>

                                {{-- ITEM 2 --}}
                                <div class="flex items-center gap-3 rounded-xl bg-white px-3 py-2 shadow-sm ring-1 ring-slate-100">
                                    <div class="h-8 w-8 rounded-full bg-sky-300"></div>
                                    <div class="flex-1">
                                        <div class="h-3 w-1/2 rounded-full bg-slate-200"></div>
                                        <div class="mt-1 h-2 w-1/4 rounded-full bg-slate-100"></div>
                                    </div>
                                </div>

                                {{-- ITEM 3 --}}
                                <div class="flex items-center gap-3 rounded-xl bg-white px-3 py-2 shadow-sm ring-1 ring-slate-100">
                                    <div class="h-8 w-8 rounded-full bg-sky-300"></div>
                                    <div class="flex-1">
                                        <div class="h-3 w-3/4 rounded-full bg-slate-200"></div>
                                        <div class="mt-1 h-2 w-1/3 rounded-full bg-slate-100"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="mt-4 min-h-[56px]">
                        <p class="text-base font-semibold text-slate-900">Kelola Karyawan</p>
                        <p class="mt-1 text-sm text-slate-500">Buat akun karyawan berdasarkan NPK dan list karyawan yang sudah mengisi form dan quiz</p>
                    </div>
                </a>

                {{-- Form Ditutup --}}
                <a href="{{ route('forms.closed') }}" class="group flex h-full flex-col">
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-red-300 hover:shadow-xl">

                        <div class="flex h-52 flex-col justify-center bg-gradient-to-br from-red-50 via-white to-rose-50 p-5">

                            {{-- HEADER --}}
                            <div class="mb-4 flex items-center gap-2">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-600 text-white shadow">
                                    {{-- ICON CLOSED FORM --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M9 12h6M9 16h4M7 4h7l5 5v11a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M15 3v6h6" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 6l12 12" /> <!-- tanda X -->
                                    </svg>
                                </div>
                                <div class="h-3 w-1/2 rounded-full bg-red-200"></div>
                            </div>

                            {{-- PREVIEW FORM (DISABLED STYLE) --}}
                            <div class="space-y-3 opacity-70">

                                {{-- INPUT --}}
                                <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-red-100"></div>

                                {{-- INPUT --}}
                                <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-red-100"></div>

                                {{-- SELECT --}}
                                <div class="flex items-center gap-2 rounded-xl bg-white px-3 py-2 shadow-sm ring-1 ring-red-100">
                                    <div class="h-3 w-1/3 rounded-full bg-slate-200"></div>
                                    <div class="ml-auto h-3 w-3 rounded-full bg-red-400"></div>
                                </div>

                                {{-- BUTTON DISABLED --}}
                                <div class="h-9 rounded-xl bg-red-300"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 min-h-[56px]">
                        <p class="text-base font-semibold text-slate-900">Form Ditutup</p>
                        <p class="mt-1 text-sm text-slate-500">Daftar formulir yang masa pengisiannya telah berakhir</p>
                    </div>
                </a>

                {{-- Quiz Ditutup --}}
                <a href="{{ route('quiz.closed.admin') }}" class="group flex h-full flex-col">
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-purple-300 hover:shadow-xl">

                        <div class="flex h-52 flex-col justify-center bg-gradient-to-br from-purple-50 via-white to-indigo-50 p-5">

                            <!-- HEADER -->
                            <div class="mb-4 flex items-center gap-2">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-600 text-white shadow">
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                        class="h-5 w-5"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M9 12h6M9 16h4M7 4h7l5 5v11a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M15 3v6h6" />
                                    </svg>
                                </div>
                                <div class="h-3 w-1/2 rounded-full bg-purple-200"></div>
                            </div>

                            <!-- PREVIEW -->
                            <div class="space-y-3 opacity-70">
                                <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-purple-100"></div>
                                <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-purple-100"></div>
                                <div class="h-8 rounded-xl bg-white shadow-sm ring-1 ring-purple-100"></div>
                                <div class="h-9 rounded-xl bg-purple-300"></div>
                            </div>

                        </div>
                    </div>

                    <div class="mt-4 min-h-[56px]">
                        <p class="text-base font-semibold text-slate-900">Quiz Ditutup</p>
                        <p class="mt-1 text-sm text-slate-500">
                            Daftar quiz yang sudah berakhir
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- Recent Forms --}}
    <section class="mx-auto max-w-7xl px-6 py-10 lg:px-10">

        <div class="mb-8 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900 md:text-3xl">
                    Formulir terbaru
                </h2>
                <p class="mt-2 text-sm text-slate-500">
                    Form yang baru dibuat
                </p>
            </div>

            <div class="flex items-center gap-4">
                <div class="px-4 py-2 text-sm bg-white border rounded-xl shadow-sm">
                    Total: {{ $forms->count() }} form
                </div>
            </div>
        </div>

        {{-- LIST FORM --}}
        @if ($forms->count() > 0)
            <div class="flex gap-6 overflow-x-auto pb-4 snap-x snap-mandatory scroll-smooth">

                @foreach ($forms as $form)
                <div class="min-w-[300px] max-w-[320px] flex-shrink-0 snap-start">

                    <div class="group rounded-3xl border border-slate-200 bg-white p-5 shadow-sm 
                                hover:-translate-y-1 hover:shadow-xl transition duration-300">

                        {{-- HEADER --}}
                        <div class="flex items-start justify-between mb-5">

                            <div class="pr-2">
                                <h3 class="text-base font-semibold text-slate-900 line-clamp-1">
                                    {{ $form->title }}
                                </h3>
                                <p class="text-xs text-slate-500 mt-1">
                                    {{ $form->created_at->format('d M Y') }}
                                </p>
                            </div>

                            {{-- STATUS BADGE (FIX SIZE & ALIGN) --}}
                            @if(!$form->is_active)
                                <span class="text-[11px] font-medium bg-gray-100 text-gray-600 px-3 py-1 rounded-full whitespace-nowrap">
                                    Draft
                                </span>
                            @else
                                <span class="text-[11px] font-medium bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full whitespace-nowrap">
                                    Published
                                </span>
                            @endif
                        </div>

                        {{-- INFO --}}
                        <div class="grid grid-cols-2 gap-3">

                            {{-- PENGISI --}}
                            <div class="rounded-2xl bg-slate-50 px-4 py-3">
                                <p class="text-xs text-slate-500">Pengisi</p>
                                <p class="mt-1 text-xl font-bold text-slate-900">
                                    {{ $form->submissions_count ?? 0 }}
                                </p>
                            </div>

                            {{-- STATUS --}}
                            <div class="rounded-2xl bg-emerald-50 px-4 py-3">
                                <p class="text-xs text-emerald-600">Status</p>
                                <p class="mt-1 text-sm font-semibold text-emerald-700">
                                    {{ ($form->submissions_count ?? 0) > 0 ? 'Ada Respon' : 'Belum Ada' }}
                                </p>
                            </div>
                        </div>

                        {{-- ACTION --}}
                        <div class="mt-5 flex gap-2">

                            <a href="{{ route('forms.edit', $form->uuid) }}"
                            class="flex-1 text-center text-sm font-medium px-3 py-2 rounded-xl border border-slate-200 
                                    hover:bg-slate-100 transition">
                                Edit
                            </a>

                            <a href="{{ route('forms.respondents', ['form' => $form->uuid]) }}"
                            class="flex-1 text-center text-sm font-medium px-3 py-2 rounded-xl bg-sky-50 text-sky-700 
                                    hover:bg-sky-100 transition">
                                Pengisi
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="flex flex-col items-center justify-center py-16 bg-white border border-slate-200 rounded-3xl shadow-sm">

                {{-- ICON --}}
                <div class="flex items-center justify-center w-16 h-16 mb-4 rounded-full bg-blue-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M9 12h6m-6 4h6M9 8h6M5 4h14a2 2 0 012 2v14l-4-3H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
                    </svg>
                </div>

                {{-- TEXT --}}
                <h3 class="text-lg font-semibold text-slate-800">
                    Belum ada form tersedia
                </h3>
                <p class="mt-2 text-sm text-slate-500 text-center max-w-md">
                    Form akan muncul di sini setelah admin membuat form baru.
                </p>
            </div>
        @endif
    </section>

    {{-- QUIZ TERBARU --}}
    <section class="mx-auto max-w-7xl px-6 py-10 lg:px-10">

        <div class="mb-8 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900 md:text-3xl">
                    Quiz terbaru
                </h2>
                <p class="mt-2 text-sm text-slate-500">
                    Quiz yang sudah dibuat
                </p>
            </div>

            <div class="flex items-center gap-4">
                <div class="px-4 py-2 text-sm bg-white border rounded-xl shadow-sm">
                    Total: {{ $quizzes->count() }} quiz
                </div>
            </div>
        </div>

        {{-- LIST QUIZ --}}
        @if ($quizzes->count() > 0)

            <div class="flex gap-6 overflow-x-auto pb-4 snap-x snap-mandatory scroll-smooth">

                @foreach ($quizzes as $quiz)
                <div class="min-w-[300px] max-w-[320px] flex-shrink-0 snap-start">

                    <div class="group rounded-3xl border border-slate-200 bg-white p-5 shadow-sm 
                                hover:-translate-y-1 hover:shadow-xl transition duration-300">

                        {{-- HEADER --}}
                        <div class="flex items-start justify-between mb-5">

                            <div class="pr-2">
                                <h3 class="text-base font-semibold text-slate-900 line-clamp-1">
                                    {{ $quiz->title }}
                                </h3>
                                <p class="text-xs text-slate-500 mt-1">
                                    {{ $quiz->created_at->format('d M Y') }}
                                </p>
                            </div>

                            {{-- BADGE --}}
                            <span class="text-[11px] font-medium bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full whitespace-nowrap">
                                Quiz
                            </span>
                        </div>

                        {{-- INFO --}}
                        <div class="grid grid-cols-2 gap-3">

                            {{-- PENGISI --}}
                            <div class="rounded-2xl bg-slate-50 px-4 py-3">
                                <p class="text-xs text-slate-500">Pengisi</p>
                                <p class="mt-1 text-xl font-bold text-slate-900">
                                    {{ $quiz->attempts_count }}
                                </p>
                            </div>

                            {{-- STATUS --}}
                            <div class="rounded-2xl bg-emerald-50 px-4 py-3">
                                <p class="text-xs text-emerald-600">Status</p>
                                <p class="mt-1 text-sm font-semibold text-emerald-700">
                                    Aktif
                                </p>
                            </div>

                        </div>

                        {{-- ACTION --}}
                        <div class="mt-5">
                            <a href="{{ route('quiz.results', $quiz->uuid) }}"
                            class="block w-full text-center text-sm font-medium px-3 py-2 rounded-xl border border-slate-200 
                                    hover:bg-slate-100 transition">
                                Lihat Hasil
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="flex flex-col items-center justify-center py-16 bg-white border border-slate-200 rounded-3xl shadow-sm">

                {{-- ICON --}}
                <div class="flex items-center justify-center w-16 h-16 mb-4 rounded-full bg-blue-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M9 12h6m-6 4h6M9 8h6M5 4h14a2 2 0 012 2v14l-4-3H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
                    </svg>
                </div>

                {{-- TEXT --}}
                <h3 class="text-lg font-semibold text-slate-800">
                    Belum ada quiz tersedia
                </h3>
                <p class="mt-2 text-sm text-slate-500 text-center max-w-md">
                    Quiz akan muncul di sini setelah admin membuat quiz baru.
                </p>
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

    <!-- Footer -->
    <footer class="mt-12">

        <div class="rounded-3xl border border-slate-200/80 bg-white/80 backdrop-blur-xl shadow-sm">

            <div class="px-6 py-6">

                <div class="flex flex-col items-center justify-center gap-3 text-center">

                    <!-- Copyright -->
                    <p class="text-sm text-slate-400 leading-relaxed">
                            © 2026 Developed by
                        <span class="font-semibold text-indigo-600">
                            FIREFOX ITD AIIA
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </footer>
</div>
