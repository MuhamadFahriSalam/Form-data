<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 flex items-center justify-center">

<div class="w-full max-w-md">

    <!-- Card -->
    <div class="bg-white shadow-xl rounded-2xl border border-slate-200 overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-blue-600 px-6 py-5 text-white">
            <h1 class="text-xl font-semibold">Login Admin</h1>
            <p class="text-sm opacity-90">Masuk sebagai administrator</p>
        </div>

        <!-- Form -->
        <div class="p-6 space-y-5">

            @if ($errors->any())
                <div class="rounded-lg bg-red-50 border border-red-200 text-red-600 px-4 py-3 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
                @csrf

                <!-- NPK -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        NPK
                    </label>

                    <input
                        type="text"
                        name="npk"
                        value="{{ old('npk') }}"
                        maxlength="6"
                        inputmode="numeric"
                        pattern="[0-9]{1,6}"
                        oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0,6)"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Masukkan NPK"
                    >
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Masukkan password"
                    >
                </div>

                <!-- Remember -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-slate-600">
                        <input
                            type="checkbox"
                            name="remember"
                            class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                        >
                        Remember me
                    </label>
                </div>

                <!-- Button -->
                <button
                    type="submit"
                    class="w-full rounded-xl bg-indigo-600 text-white py-2.5 font-semibold hover:bg-indigo-700 transition shadow-md"
                >
                    Login Admin
                </button>

            </form>
        </div>
    </div>

    <!-- Footer -->
    <p class="text-center text-xs text-slate-400 mt-6">
        © {{ date('Y') }} Sistem Form
    </p>

</div>

</body>
</html>