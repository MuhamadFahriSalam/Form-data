<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoQuz - Smart Quiz Platform</title>

    @vite('resources/css/app.css')

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-white text-gray-800 overflow-x-hidden">

    <!-- Background Decoration -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-50 -z-10"></div>
    <div class="absolute top-40 right-0 w-96 h-96 bg-cyan-100 rounded-full blur-3xl opacity-50 -z-10"></div>

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 bg-white/75 backdrop-blur-xl border-b border-gray-100 shadow-sm">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="flex items-center justify-between h-20">

                <!-- Left -->
                <div class="flex items-center gap-4">

                    <!-- Company Logo -->
                    <div class="bg-white border border-gray-100 rounded-xl px-3 py-2 shadow-sm">

                        <img
                            src="{{ asset('images/LOGO AIIA 2.png') }}"
                            alt="AIIA Logo"
                            class="h-7 w-auto object-contain"
                        >

                    </div>

                    <!-- Divider -->
                    <div class="hidden md:block w-px h-8 bg-gray-200"></div>

                    <!-- FoQuz -->
                    <div class="flex items-center gap-3">

                        <!-- Icon -->
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center shadow-md">

                            <span class="text-white font-bold text-sm">
                                FQ
                            </span>

                        </div>

                        <!-- Text -->
                        <div>

                            <h1 class="text-xl font-bold text-gray-800 leading-none">
                                FoQuz
                            </h1>
                        </div>

                    </div>

                </div>

                <!-- Right -->
                <a href="{{ route('login') }}"
                class="bg-gradient-to-r from-blue-500 to-cyan-400 hover:scale-105 duration-300 text-white px-5 py-2.5 rounded-xl shadow-md text-sm font-medium">

                    Login

                </a>

            </div>

        </div>

    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">

        <!-- Background Image -->
        <div class="absolute inset-0">

            <img
                src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=1600"
                alt="Background"
                class="w-full h-full object-cover"
            >

            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/50"></div>

        </div>

        <!-- Hero Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-6 text-center">

            <!-- Heading -->
            <h1 class="mt-8 text-5xl md:text-7xl font-bold leading-tight text-white">

                Modern Form &

                <span class="bg-gradient-to-r from-cyan-300 to-blue-400 bg-clip-text text-transparent">
                    Quiz Management
                </span>

            </h1>

            <!-- Description -->
            <p class="mt-8 text-lg md:text-xl text-gray-200 leading-relaxed max-w-3xl mx-auto">

                Platform modern untuk membuat quiz, survey,
                evaluasi, dan form management perusahaan
                secara cepat, efisien, dan professional.

            </p>

            <!-- Buttons -->
            <div class="mt-10 flex flex-wrap justify-center gap-5">

                <!-- Button Login -->
                <a href="{{ route('login') }}"
                class="bg-gradient-to-r from-blue-500 to-cyan-400 hover:scale-105 duration-300 text-white px-8 py-4 rounded-2xl shadow-2xl text-lg font-semibold">
                    Get Started
                </a>

                <!-- Button Learn -->
                <a href="#features"
                class="bg-white/10 backdrop-blur-md border border-white/20 hover:bg-white/20 duration-300 text-white px-8 py-4 rounded-2xl text-lg">
                    Learn More
                </a>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-28 bg-gray-50">

        <div class="max-w-7xl mx-auto px-6">

            <!-- Title -->
            <div class="text-center mb-20">

                <span class="text-blue-600 font-semibold">
                    Powerful Features
                </span>

                <h2 class="text-5xl font-bold mt-4 text-gray-900">
                    Everything You Need
                </h2>

                <p class="text-gray-500 mt-6 max-w-2xl mx-auto leading-relaxed">

                    Solusi lengkap untuk mengelola quiz,
                    survey, evaluasi, dan form management
                    perusahaan.
                </p>
            </div>

            <!-- Cards -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Card -->
                <div class="bg-white p-8 rounded-3xl shadow-lg hover:-translate-y-2 hover:shadow-2xl duration-300 border border-gray-100">

                    <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center text-3xl">
                        📝
                    </div>

                    <h3 class="text-2xl font-semibold mt-6 text-gray-900">
                        Quiz Management
                    </h3>

                    <p class="text-gray-500 mt-4 leading-relaxed">
                        Create and manage quizzes easily with a modern dashboard.
                    </p>
                </div>

                <!-- Card -->
                <div class="bg-white p-8 rounded-3xl shadow-lg hover:-translate-y-2 hover:shadow-2xl duration-300 border border-gray-100">

                    <div class="w-16 h-16 rounded-2xl bg-cyan-100 flex items-center justify-center text-3xl">
                        📋
                    </div>

                    <h3 class="text-2xl font-semibold mt-6 text-gray-900">
                        Smart Forms
                    </h3>

                    <p class="text-gray-500 mt-4 leading-relaxed">
                        Digital forms with automatic data collection and evaluation.
                    </p>
                </div>

                <!-- Card -->
                <div class="bg-white p-8 rounded-3xl shadow-lg hover:-translate-y-2 hover:shadow-2xl duration-300 border border-gray-100">

                    <div class="w-16 h-16 rounded-2xl bg-indigo-100 flex items-center justify-center text-3xl">
                        📈
                    </div>

                    <h3 class="text-2xl font-semibold mt-6 text-gray-900">
                        Analytics
                    </h3>

                    <p class="text-gray-500 mt-4 leading-relaxed">
                        Real-time statistics and monitoring dashboard.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 py-8">

        <div class="max-w-7xl mx-auto px-6">

            <div class="flex justify-center items-center">

                <p class="text-sm text-slate-400 tracking-wide text-center">
                    © 2026 Developed by 
                    <span class="font-semibold text-blue-500">
                        FIREFOX ITD AIIA
                    </span>.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>