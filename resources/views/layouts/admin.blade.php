<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? __('messages.admin.dashboard') }} | {{ __('messages.admin.admin_portal') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/knpi-logo.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        royal: {
                            50: '#EEF4FF',
                            100: '#E0EBFF',
                            700: '#0F4C81',
                            800: '#0B3B82',
                            900: '#072658',
                        },
                        gold: {
                            500: '#F59E0B',
                            600: '#D97706',
                        },
                        paper: {
                            DEFAULT: '#FFFFFF',
                            canvas: '#F8FAFC',
                            subtle: '#F1F5F9',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-paper-canvas text-slate-800 antialiased font-sans min-h-screen flex" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-xs lg:hidden transition-opacity"></div>

    <!-- 1. Fixed Minimalist Paper Responsive Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'" class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200 transition-transform duration-200 ease-in-out flex flex-col justify-between shadow-xs">
        
        <!-- Top Section: Brand & Navigation -->
        <div>
            <!-- Sidebar Header -->
            <div class="h-20 px-6 flex items-center justify-between border-b border-slate-100">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('images/knpi-logo.png') }}" alt="Logo Resmi KNPI" class="w-10 h-10 object-contain drop-shadow-xs">
                    <div>
                        <div class="font-bold text-base text-slate-900 tracking-tight leading-none">KNPI Admin</div>
                        <span class="text-[10px] uppercase font-semibold text-slate-400 tracking-wider">Paper Minimalist</span>
                    </div>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden p-1.5 rounded-md text-slate-400 hover:text-slate-600 hover:bg-slate-100">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <div class="px-4 py-5 space-y-1">
                <div class="px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                    {{ __('messages.admin.main_menu') }}
                </div>

                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-royal-50 text-royal-800' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                    <i data-lucide="layout-grid" class="w-4 h-4 {{ request()->routeIs('admin.dashboard') ? 'text-royal-800' : 'text-slate-400' }}"></i>
                    {{ __('messages.admin.dashboard') }}
                </a>

                <a href="{{ route('admin.okp.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.okp.*') ? 'bg-royal-50 text-royal-800' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="building-2" class="w-4 h-4 {{ request()->routeIs('admin.okp.*') ? 'text-royal-800' : 'text-slate-400' }}"></i>
                        {{ __('messages.admin.okp_dir') }}
                    </div>
                    @php
                        $pendingOkpCount = \App\Models\Organization::where('status', 'pending')->count();
                    @endphp
                    @if($pendingOkpCount > 0)
                        <span class="px-2 py-0.5 text-[11px] font-bold rounded-full bg-amber-100 text-amber-800">
                            {{ $pendingOkpCount }}
                        </span>
                    @endif
                </a>

                <a href="{{ route('admin.aspirasi.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.aspirasi.*') ? 'bg-royal-50 text-royal-800' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="ticket" class="w-4 h-4 {{ request()->routeIs('admin.aspirasi.*') ? 'text-royal-800' : 'text-slate-400' }}"></i>
                        {{ __('messages.admin.tickets') }}
                    </div>
                    @php
                        $pendingTicketCount = \App\Models\Aspiration::where('status', 'submitted')->count();
                    @endphp
                    @if($pendingTicketCount > 0)
                        <span class="px-2 py-0.5 text-[11px] font-bold rounded-full bg-blue-100 text-royal-800">
                            {{ $pendingTicketCount }}
                        </span>
                    @endif
                </a>

                <div class="pt-4 px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                    {{ __('messages.admin.publication_agenda') }}
                </div>

                <a href="{{ route('admin.berita.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.berita.*') ? 'bg-royal-50 text-royal-800' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                    <i data-lucide="newspaper" class="w-4 h-4 {{ request()->routeIs('admin.berita.*') ? 'text-royal-800' : 'text-slate-400' }}"></i>
                    {{ __('messages.admin.news') }}
                </a>

                <a href="{{ route('admin.agenda.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.agenda.*') ? 'bg-royal-50 text-royal-800' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                    <i data-lucide="calendar" class="w-4 h-4 {{ request()->routeIs('admin.agenda.*') ? 'text-royal-800' : 'text-slate-400' }}"></i>
                    {{ __('messages.admin.events') }}
                </a>

                <div class="pt-4 px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                    {{ __('messages.admin.system_links') }}
                </div>

                <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-semibold text-slate-500 hover:text-royal-800 hover:bg-slate-50 transition">
                    <span class="flex items-center gap-2">
                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                        {{ __('messages.admin.visit_portal') }}
                    </span>
                    <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
        </div>

        <!-- Bottom User Profile Pill -->
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 overflow-hidden">
                    <div class="w-9 h-9 rounded-full bg-royal-800 text-white flex items-center justify-center font-bold text-sm shrink-0">
                        {{ strtoupper(substr(auth()->user()->name ?? 'AD', 0, 2)) }}
                    </div>
                    <div class="truncate">
                        <div class="font-bold text-xs text-slate-800 truncate">{{ auth()->user()->name ?? 'Administrator' }}</div>
                        <span class="inline-block px-1.5 py-0.2 bg-blue-100 text-royal-800 rounded text-[10px] font-semibold uppercase">
                            {{ auth()->user()->role ?? 'super_admin' }}
                        </span>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-white rounded-lg transition" title="{{ __('messages.admin.logout') }}">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- 2. Main Content Wrapper -->
    <div class="lg:pl-64 flex flex-col flex-1 min-w-0">
        
        <!-- Topbar Minimal Paper -->
        <header class="h-20 bg-white border-b border-slate-200 px-6 flex items-center justify-between sticky top-0 z-30 shadow-2xs">
            <div class="flex items-center space-x-4">
                <!-- Mobile trigger -->
                <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 focus:outline-none">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>

                <!-- Search Input Bar -->
                <div class="relative w-64 md:w-80">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                    <input type="text" placeholder="{{ __('messages.admin.search_placeholder') }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg pl-9 pr-4 py-2 text-xs text-slate-700 placeholder-slate-400 focus:outline-none focus:bg-white focus:border-royal-800 focus:ring-1 focus:ring-royal-800 transition">
                </div>
            </div>

            <!-- Topbar Right Actions -->
            <div class="flex items-center space-x-3 sm:space-x-4">
                <!-- Language Switcher Pill (Admin) -->
                <div class="inline-flex items-center rounded-lg bg-slate-100 p-0.5 border border-slate-200 text-xs">
                    <a href="{{ route('locale.switch', 'id') }}" class="px-2 py-1 rounded text-xs font-bold transition flex items-center gap-1 {{ app()->getLocale() === 'id' ? 'bg-white text-royal-800 shadow-xs border border-slate-200/60' : 'text-slate-500 hover:text-slate-900' }}" title="Bahasa Indonesia">
                        <span>🇮🇩</span> <span class="hidden sm:inline font-mono">ID</span>
                    </a>
                    <a href="{{ route('locale.switch', 'en') }}" class="px-2 py-1 rounded text-xs font-bold transition flex items-center gap-1 {{ app()->getLocale() === 'en' ? 'bg-white text-royal-800 shadow-xs border border-slate-200/60' : 'text-slate-500 hover:text-slate-900' }}" title="English">
                        <span>🇬🇧</span> <span class="hidden sm:inline font-mono">EN</span>
                    </a>
                </div>

                <!-- Notifications Bell -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="relative p-2 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-amber-500 rounded-full"></span>
                    </button>
                </div>

                <div class="h-6 w-px bg-slate-200"></div>

                <!-- User Dropdown -->
                <div class="flex items-center space-x-3">
                    <div class="text-right hidden sm:block">
                        <div class="text-xs font-bold text-slate-800">{{ auth()->user()->name ?? 'Super Admin' }}</div>
                        <div class="text-[11px] text-slate-400">{{ auth()->user()->email ?? 'admin@knpi.or.id' }}</div>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-royal-800 text-white flex items-center justify-center font-bold text-xs ring-2 ring-slate-100">
                        {{ strtoupper(substr(auth()->user()->name ?? 'AD', 0, 2)) }}
                    </div>
                </div>
            </div>
        </header>

        <!-- Flash Messages for Admin -->
        <div class="px-6 pt-6">
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" class="mb-4 flex items-center justify-between p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-800 shadow-xs">
                    <div class="flex items-center gap-3">
                        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 shrink-0"></i>
                        <p class="text-xs font-semibold">{{ session('success') }}</p>
                    </div>
                    <button @click="show = false" class="text-emerald-500 hover:text-emerald-700">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div x-data="{ show: true }" x-show="show" class="mb-4 flex items-center justify-between p-4 bg-red-50 border border-red-200 rounded-xl text-red-800 shadow-xs">
                    <div class="flex items-center gap-3">
                        <i data-lucide="alert-triangle" class="w-5 h-5 text-red-600 shrink-0"></i>
                        <p class="text-xs font-semibold">{{ session('error') }}</p>
                    </div>
                    <button @click="show = false" class="text-red-500 hover:text-red-700">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            @endif
        </div>

        <!-- Dynamic Main Card Canvas -->
        <main class="p-6 space-y-6 flex-1">
            @yield('content')
        </main>

        <!-- Minimal Paper Footer -->
        <footer class="px-6 py-4 border-t border-slate-200 text-slate-400 text-xs flex flex-col sm:flex-row justify-between items-center gap-2">
            <span>KNPI Digital Ecosystem • {{ __('messages.admin.admin_portal') }}</span>
            <span>Laravel 11.x • MySQL 8.0 • Tailwind CSS</span>
        </footer>
    </div>

    <!-- Init Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
