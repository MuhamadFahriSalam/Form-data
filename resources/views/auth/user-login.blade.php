<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine JS -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }

        /* Shake animation */
        @keyframes shake {
            0%,100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        .shake { animation: shake 0.3s; }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-blue-100 flex items-center justify-center">
    <div class="w-full max-w-md px-4" x-data="{ show: false, loading: false }">

        <!-- Card -->
        <div class="backdrop-blur-xl bg-white/80 shadow-2xl rounded-3xl border border-white/40 overflow-hidden transition-all duration-300 hover:shadow-blue-200"
            :class="{'shake': {{ $errors->any() ? 'true' : 'false' }}}">

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 px-6 py-7 text-white text-center relative">
                <div class="absolute inset-0 bg-white/10 backdrop-blur-sm"></div>

                <div class="relative">
                    <h1 class="text-2xl font-semibold tracking-wide">Welcome Back 👋</h1>
                    <p class="text-sm opacity-90 mt-1">Silakan login ke akun Anda</p>
                </div>
            </div>

            <!-- Form -->
            <div class="p-7 space-y-6">

                @if ($errors->any())
                    <div class="rounded-xl bg-red-50 border border-red-200 text-red-600 px-4 py-3 text-sm shadow-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('website.login') }}" class="space-y-6"
                    @submit="loading = true">
                    @csrf

                    <!-- NPK -->
                    <div class="relative">
                        <input
                            type="text"
                            name="npk"
                            value="{{ old('npk') }}"
                            maxlength="6"
                            inputmode="numeric"
                            placeholder=" "
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6)"
                            class="peer w-full rounded-xl border border-slate-200 px-4 pt-5 pb-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm"
                        >
                        <label class="absolute left-4 top-2 text-xs text-slate-500 transition-all 
                                    peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm 
                                    peer-placeholder-shown:text-slate-400 
                                    peer-focus:top-2 peer-focus:text-xs peer-focus:text-blue-500">
                            NPK
                        </label>
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <input
                            :type="show ? 'text' : 'password'"
                            name="password"
                            placeholder=" "
                            class="peer w-full rounded-xl border border-slate-200 px-4 pt-5 pb-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm"
                        >

                        <label class="absolute left-4 top-2 text-xs text-slate-500 transition-all 
                                    peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm 
                                    peer-placeholder-shown:text-slate-400 
                                    peer-focus:top-2 peer-focus:text-xs peer-focus:text-blue-500">
                            Password
                        </label>

                        <!-- Toggle -->
                        <button type="button"
                                @click="show = !show"
                                class="absolute right-3 top-3 text-slate-400 hover:text-blue-500">
                            👁
                        </button>
                    </div>

                    <!-- Remember -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2 text-slate-500">
                            <input type="checkbox" name="remember"
                                class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            Remember me
                        </label>

                        <a href="#" class="text-blue-500 hover:underline">
                            Lupa password?
                        </a>
                    </div>

                    <!-- Button -->
                    <button
                        type="submit"
                        class="w-full rounded-xl bg-gradient-to-r from-blue-600 to-blue-500 text-white py-3 font-semibold shadow-lg transition-all duration-300 hover:shadow-blue-300 active:scale-[0.97] flex items-center justify-center gap-2"
                        :disabled="loading"
                    >
                        <span x-show="!loading">Login</span>

                        <!-- Loading -->
                        <span x-show="loading" class="flex items-center gap-2">
                            <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="white" stroke-width="4"></circle>
                                <path class="opacity-75" fill="white"
                                    d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            Loading...
                        </span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center text-xs text-slate-400 mt-6">
            © {{ date('Y') }} Sistem form dan quiz untuk pendataan karyawan baru.
        </p>
    </div>
</body>
</html>