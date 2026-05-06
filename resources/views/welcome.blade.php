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

        @keyframes heroMove {

            0%{
                transform: scale(1.05) translateX(0px) translateY(0px);
            }

            25%{
                transform: scale(1.1) translateX(-20px) translateY(-10px);
            }

            50%{
                transform: scale(1.12) translateX(20px) translateY(10px);
            }

            75%{
                transform: scale(1.08) translateX(-15px) translateY(5px);
            }

            100%{
                transform: scale(1.15) translateX(10px) translateY(-5px);
            }
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

        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden">

            <!-- Moving Image -->
            <img
                src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=1600"
                alt="Background"
                class="absolute inset-0 w-[110%] h-[110%] object-cover
                    animate-[heroMove_20s_ease-in-out_infinite_alternate]"
            >

            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/55"></div>

            <!-- Floating Glow -->
            <div class="absolute top-20 left-10 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-80 h-80 bg-cyan-400/20 rounded-full blur-3xl animate-pulse"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-6 text-center">

            <!-- Heading -->
            <h1 class="mt-8 text-5xl md:text-7xl font-bold leading-tight text-white">
                <span class="bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent drop-shadow-lg">
                    AISIN
                </span>
                Modern Form &
                <span class="bg-gradient-to-r from-cyan-300 to-blue-400 bg-clip-text text-transparent">
                    Quiz Management
                </span>
            </h1>

            <!-- Description -->
            <p class="mt-8 text-lg md:text-xl text-gray-200 leading-relaxed max-w-3xl mx-auto">
                Platform untuk membuat quiz, survey,
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

                <!-- Card 1 -->
                <div class="group relative overflow-hidden rounded-[2rem]
                            bg-white border border-slate-200
                            shadow-lg hover:shadow-2xl
                            transform-gpu will-change-transform
                            transition-all duration-500
                            hover:-translate-y-2 hover:translate-x-2">

                    <!-- Glow -->
                    <div class="absolute -top-10 -right-10 w-40 h-40
                                bg-blue-100 rounded-full blur-3xl
                                opacity-40 group-hover:opacity-70
                                transition duration-500">
                    </div>

                    <!-- Content -->
                    <div class="relative p-8">

                        <!-- Icon -->
                        <div class="flex items-center justify-center
                                    w-16 h-16 rounded-2xl
                                    bg-gradient-to-br from-blue-500 to-cyan-400
                                    text-white text-3xl shadow-md
                                    group-hover:scale-105 group-hover:rotate-3
                                    transition duration-500">
                            📝
                        </div>

                        <!-- Title -->
                        <h3 class="text-2xl font-bold mt-6 text-slate-800
                                group-hover:text-blue-600 transition duration-300">
                            Quiz Management
                        </h3>

                        <!-- Description -->
                        <p class="text-slate-500 mt-4 leading-relaxed">
                            Create and manage quizzes easily with a modern dashboard.
                        </p>

                        <!-- Arrow -->
                        <div class="mt-6 flex items-center gap-2
                                    text-blue-500 font-medium
                                    opacity-0 group-hover:opacity-100
                                    translate-x-[-8px] group-hover:translate-x-0
                                    transition-all duration-500">

                            Explore More →
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="group relative overflow-hidden rounded-[2rem]
                            bg-white border border-slate-200
                            shadow-lg hover:shadow-2xl
                            transform-gpu will-change-transform
                            transition-all duration-500
                            hover:-translate-y-2 hover:translate-x-2">

                    <!-- Glow -->
                    <div class="absolute -top-10 -right-10 w-40 h-40
                                bg-cyan-100 rounded-full blur-3xl
                                opacity-40 group-hover:opacity-70
                                transition duration-500">
                    </div>

                    <div class="relative p-8">

                        <!-- Icon -->
                        <div class="flex items-center justify-center
                                    w-16 h-16 rounded-2xl
                                    bg-gradient-to-br from-cyan-500 to-sky-400
                                    text-white text-3xl shadow-md
                                    group-hover:scale-105 group-hover:rotate-3
                                    transition duration-500">
                            📋
                        </div>

                        <!-- Title -->
                        <h3 class="text-2xl font-bold mt-6 text-slate-800
                            group-hover:text-cyan-600 transition duration-300">
                            Smart Forms
                        </h3>

                        <!-- Description -->
                        <p class="text-slate-500 mt-4 leading-relaxed">
                            Digital forms with automatic data collection and evaluation.
                        </p>

                        <!-- Arrow -->
                        <div class="mt-6 flex items-center gap-2
                                    text-cyan-500 font-medium
                                    opacity-0 group-hover:opacity-100
                                    translate-x-[-8px] group-hover:translate-x-0
                                    transition-all duration-500">
                            Explore More →
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="group relative overflow-hidden rounded-[2rem]
                            bg-white border border-slate-200
                            shadow-lg hover:shadow-2xl
                            transform-gpu will-change-transform
                            transition-all duration-500
                            hover:-translate-y-2 hover:translate-x-2">

                    <!-- Glow -->
                    <div class="absolute -top-10 -right-10 w-40 h-40
                                bg-indigo-100 rounded-full blur-3xl
                                opacity-40 group-hover:opacity-70
                                transition duration-500">
                    </div>

                    <div class="relative p-8">

                        <!-- Icon -->
                        <div class="flex items-center justify-center
                                    w-16 h-16 rounded-2xl
                                    bg-gradient-to-br from-indigo-500 to-violet-400
                                    text-white text-3xl shadow-md
                                    group-hover:scale-105 group-hover:rotate-3
                                    transition duration-500">
                            📈
                        </div>

                        <!-- Title -->
                        <h3 class="text-2xl font-bold mt-6 text-slate-800
                                group-hover:text-indigo-600 transition duration-300">
                            Analytics
                        </h3>

                        <!-- Description -->
                        <p class="text-slate-500 mt-4 leading-relaxed">
                            Real-time statistics and monitoring dashboard.
                        </p>

                        <!-- Arrow -->
                        <div class="mt-6 flex items-center gap-2
                                    text-indigo-500 font-medium
                                    opacity-0 group-hover:opacity-100
                                    translate-x-[-8px] group-hover:translate-x-0
                                    transition-all duration-500">

                            Explore More →
                        </div>
                    </div>
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