<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }

        [x-cloak] { display: none !important; }

        /* Shake animation */
        @keyframes shake {
            0%,100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        .shake { animation: shake 0.3s; }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-blue-100 flex items-center justify-center px-4">

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 bg-white/75 backdrop-blur-xl border-b border-gray-100 shadow-sm">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <!-- Navbar Content -->
            <div class="flex items-center justify-between h-20">

                <!-- Clickable Branding -->
                <a href="{{ route('landing') }}"
                class="flex items-center gap-4 group">

                    <!-- Company Logo -->
                    <div class="bg-white border border-slate-200 rounded-xl px-3 py-2 shadow-sm group-hover:shadow-md transition duration-300">

                        <img
                            src="{{ asset('images/LOGO AIIA 2.png') }}"
                            alt="AIIA Logo"
                            class="h-6 w-auto object-contain"
                        >
                    </div>

                    <!-- Divider -->
                    <div class="hidden md:block w-px h-8 bg-slate-200"></div>

                    <!-- FoQuz Branding -->
                    <div class="flex items-center gap-3">

                        <!-- Icon -->
                        <div class="relative flex items-center justify-center w-11 h-11 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-400 shadow-lg overflow-hidden group-hover:scale-105 transition duration-300">

                            <!-- Inner Effect -->
                            <div class="absolute inset-[2px] rounded-[14px] bg-white/10 border border-white/20 backdrop-blur-md"></div>

                            <!-- Text -->
                            <span class="relative text-white font-bold text-sm tracking-wide">
                                FQ
                            </span>
                        </div>

                        <!-- Text -->
                        <div>

                            <h1 class="text-xl font-bold tracking-tight text-slate-800 leading-none group-hover:text-blue-600 transition duration-300">
                                FoQuz
                            </h1>

                            <p class="text-xs text-slate-500 mt-1">
                                Smart Form & Quiz Platform
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </nav>

    <!-- Login Card -->
    <div class="w-full max-w-md sm:max-w-lg lg:max-w-md" x-data="{ show: false, loading: false }">

        <!-- Card -->
        <div class="backdrop-blur-xl bg-white/90 shadow-xl sm:shadow-2xl rounded-2xl sm:rounded-3xl border border-white/40 overflow-hidden transition-all duration-300">

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 px-5 py-6 sm:px-6 sm:py-7 text-white text-center relative">
                <div class="absolute inset-0 bg-white/10 backdrop-blur-sm"></div>

                <div class="relative flex flex-col items-center gap-3">

                    <!-- 🔥 LOGO -->
                    {{-- <div class="flex items-center gap-2">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl 
                            bg-white/20 backdrop-blur-md border border-white/30 
                            text-white font-bold shadow-md">
                            FQ
                        </div>

                        <div class="leading-tight text-left">
                            <h1 class="text-base sm:text-lg font-bold text-white">
                                FoQuz
                            </h1>
                        </div>
                    </div> --}}

                    <!-- TEXT -->
                    <div class="text-center">
                        <h2 class="text-lg sm:text-2xl font-semibold tracking-wide">
                            Welcome Back 👋
                        </h2>
                        <p class="text-xs sm:text-sm opacity-90 mt-1">
                            Silakan login ke akun Anda
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="p-5 sm:p-7 space-y-5 sm:space-y-6">

                @if ($errors->any())
                    <div class="rounded-xl bg-red-50 border border-red-200 text-red-600 px-4 py-3 text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST"
                    action="{{ route('website.login') }}"
                    class="space-y-5 sm:space-y-6"
                    @submit.prevent="loading = true; $el.submit()">
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
                            class="peer w-full rounded-xl border border-slate-200 px-4 pt-5 pb-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        >
                        <label class="absolute left-4 top-2 text-xs text-slate-500 
                                    peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm 
                                    peer-focus:top-2 peer-focus:text-xs peer-focus:text-blue-500">
                            NPK
                        </label>
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <input
                            type="password"
                            :type="show ? 'text' : 'password'"
                            name="password"
                            placeholder=" "
                            class="peer w-full rounded-xl border border-slate-200 px-4 pt-5 pb-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        >

                        <label class="absolute left-4 top-2 text-xs text-slate-500 
                                    peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm 
                                    peer-focus:top-2 peer-focus:text-xs peer-focus:text-blue-500">
                            Password
                        </label>

                        <button type="button"
                                @click="show = !show"
                                class="absolute right-3 top-3 text-slate-400 hover:text-blue-500">
                            👁
                        </button>
                    </div>
                    <!-- Remember -->
                    <div class="flex items-center justify-between text-xs sm:text-sm">
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
                        :disabled="loading"
                        class="w-full rounded-xl bg-gradient-to-r from-blue-600 to-blue-500 text-white py-3 font-semibold flex items-center justify-center gap-2"
                    >
                        <!-- TEXT -->
                        <span x-show="!loading" x-cloak>Login</span>

                        <!-- SPINNER -->
                        <span x-show="loading" x-cloak class="flex items-center justify-center">
                            <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke="white" stroke-width="4" fill="none"></circle>
                                <path fill="white" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                        </span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center text-xs text-slate-400 mt-5">
            © 2026 Developed by FIREFOX ITD AIIA.
        </p>
    </div>
</body>
</html>