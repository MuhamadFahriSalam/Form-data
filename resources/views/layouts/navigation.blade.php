<nav x-data="{ open: false }" class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/80 backdrop-blur-md shadow-sm">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            
            <!-- Left Section -->
            <div class="flex items-center gap-8">

                <!-- 🔥 Logo / Brand -->
                <div class="flex items-center gap-2">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-bold shadow">
                        FQ
                    </div>

                    <div class="leading-tight">
                        <h1 class="text-sm font-bold text-slate-900">
                            FoQuz
                        </h1>
                        
                        {{-- <p class="text-[10px] text-slate-500">
                            Form + Quiz
                        </p> --}}
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden items-center gap-2 sm:flex">

                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                        class="rounded-lg px-4 py-2 text-sm font-medium transition duration-200
                        {{ request()->routeIs('admin.dashboard') 
                                ? 'bg-indigo-50 text-indigo-600 shadow-sm' 
                                : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            Dashboard
                        </a>

                        <a href="{{ route('user.dashboard') }}"
                        class="rounded-lg px-4 py-2 text-sm font-medium transition duration-200
                        {{ request()->routeIs('user.dashboard') 
                                ? 'bg-indigo-50 text-indigo-600 shadow-sm' 
                                : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            User Page
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right Section -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-3 py-2 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 focus:outline-none">
                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-blue-500 text-sm font-semibold text-white">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <div class="text-left">
                                <div class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-slate-500">{{ Auth::user()->role }}</div>
                            </div>

                            <svg class="h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-slate-100">
                            <p class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-500">{{ Auth::user()->email }}</p>
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-rose-600 hover:!bg-rose-50 hover:!text-rose-700">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white p-2 text-slate-500 shadow-sm transition hover:bg-slate-50 hover:text-slate-700 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div x-show="open" x-transition class="border-t border-slate-200 bg-white/95 backdrop-blur sm:hidden">
        <div class="space-y-2 px-4 py-4">
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}"
                   class="block rounded-xl px-4 py-3 text-sm font-medium transition
                   {{ request()->routeIs('admin.dashboard') 
                        ? 'bg-indigo-50 text-indigo-600' 
                        : 'text-slate-700 hover:bg-slate-100' }}">
                    Dashboard
                </a>

                <a href="{{ route('user.dashboard') }}"
                   class="block rounded-xl px-4 py-3 text-sm font-medium transition
                   {{ request()->routeIs('user.dashboard') 
                        ? 'bg-indigo-50 text-indigo-600' 
                        : 'text-slate-700 hover:bg-slate-100' }}">
                    User Page
                </a>
            @else
                <a href="{{ route('user.dashboard') }}"
                   class="block rounded-xl px-4 py-3 text-sm font-medium transition
                   {{ request()->routeIs('user.dashboard') 
                        ? 'bg-indigo-50 text-indigo-600' 
                        : 'text-slate-700 hover:bg-slate-100' }}">
                    Dashboard
                </a>
            @endif
        </div>

        <!-- Mobile User Info -->
        <div class="border-t border-slate-200 px-4 py-4">
            <div class="mb-3 flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-blue-500 text-sm font-semibold text-white">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-slate-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); this.closest('form').submit();"
                   class="block rounded-xl px-4 py-3 text-sm font-medium text-rose-600 transition hover:bg-rose-50">
                    Log Out
                </a>
            </form>
        </div>
    </div>
</nav>