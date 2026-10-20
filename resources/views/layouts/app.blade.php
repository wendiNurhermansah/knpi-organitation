<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'KNPI Digital Ecosystem - Sinergi Pemuda, Membangun Bangsa Menuju Indonesia Emas' }}</title>
    
    <!-- Meta & SEO -->
    <meta name="description" content="Portal resmi Komite Nasional Pemuda Indonesia (KNPI). Ekosistem digital integrasi Organisasi Kemasyarakatan Pemuda (OKP), verifikasi legalitas, layanan e-Aspirasi, dan agenda kepemudaan nasional.">
    <meta name="keywords" content="KNPI, Pemuda Indonesia, OKP, e-Aspirasi, Kepemudaan, Dewan Pengurus Pusat, Karang Taruna, Indonesia Emas 2045">
    <meta name="author" content="DPP KNPI">
    <link rel="icon" type="image/png" href="{{ asset('images/knpi-logo.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN with custom config matching Design Specs -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        royal: {
                            50: '#EEF4FF',
                            100: '#E0EBFF',
                            500: '#1E60BE',
                            700: '#0F4C81',
                            800: '#0B3B82',
                            900: '#072658',
                        },
                        gold: {
                            50: '#FFFBEB',
                            100: '#FEF3C7',
                            400: '#FBBF24',
                            500: '#F59E0B',
                            600: '#D97706',
                            700: '#B45309',
                        },
                        paper: '#F8FAFC',
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                        display: ['Plus Jakarta Sans', 'sans-serif'],
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
        .hero-pattern {
            background-color: #0B3B82;
            background-image: radial-gradient(rgba(245, 158, 11, 0.12) 1px, transparent 0);
            background-size: 28px 28px;
        }
    </style>
</head>
<body class="bg-paper text-slate-800 antialiased font-sans selection:bg-gold-500 selection:text-white flex flex-col min-h-screen">

    <!-- 1. Topbar Civic Header -->
    <header class="bg-slate-900 text-slate-300 text-xs border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center space-x-3">
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold bg-royal-800 text-blue-200 border border-royal-700">
                    PORTAL RESMI
                </span>
                <span class="hidden md:inline text-slate-400">
                    Dewan Pengurus Pusat Komite Nasional Pemuda Indonesia (DPP KNPI)
                </span>
            </div>
            <div class="flex items-center space-x-5 text-slate-400">
                <span class="flex items-center gap-1.5">
                    <i data-lucide="map-pin" class="w-3.5 h-3.5 text-gold-500"></i>
                    Graha Pemuda DPP KNPI, Jakarta
                </span>
                <span class="hidden sm:flex items-center gap-1.5">
                    <i data-lucide="mail" class="w-3.5 h-3.5 text-gold-500"></i>
                    sekretariat@knpi.or.id
                </span>
                <a href="{{ route('aspirasi.track') }}" class="text-gold-400 hover:text-gold-300 font-medium transition flex items-center gap-1">
                    <i data-lucide="search" class="w-3.5 h-3.5"></i>
                    Lacak Tiket
                </a>
            </div>
        </div>
    </header>

    <!-- 2. Modern Civic Navbar -->
    <nav x-data="{ mobileMenuOpen: false }" class="bg-white/95 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <img src="{{ asset('images/knpi-logo.png') }}" alt="Logo Resmi KNPI" class="w-12 h-12 object-contain group-hover:scale-105 transition-transform drop-shadow-sm">
                    <div>
                        <div class="font-extrabold text-xl text-royal-800 tracking-tight leading-none group-hover:text-royal-900 transition flex items-center">
                            KNPI <span class="text-gold-600 text-xs uppercase px-1.5 py-0.5 bg-gold-50 rounded border border-gold-200 ml-1.5 font-bold tracking-normal">Digital</span>
                        </div>
                        <p class="text-[11px] text-slate-500 font-medium leading-tight mt-0.5">
                            Komite Nasional Pemuda Indonesia
                        </p>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="px-3.5 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('home') ? 'text-royal-800 bg-blue-50' : 'text-slate-700 hover:text-royal-800 hover:bg-slate-50' }}">
                        Home
                    </a>
                    <a href="{{ route('berita.index') }}" class="px-3.5 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('berita.*') ? 'text-royal-800 bg-blue-50' : 'text-slate-700 hover:text-royal-800 hover:bg-slate-50' }}">
                        Berita Pemuda
                    </a>
                    <a href="{{ route('okp.index') }}" class="px-3.5 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('okp.*') ? 'text-royal-800 bg-blue-50' : 'text-slate-700 hover:text-royal-800 hover:bg-slate-50' }}">
                        Direktori OKP
                    </a>
                    <a href="{{ route('agenda.index') }}" class="px-3.5 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('agenda.*') ? 'text-royal-800 bg-blue-50' : 'text-slate-700 hover:text-royal-800 hover:bg-slate-50' }}">
                        Agenda & Kegiatan
                    </a>
                    <a href="{{ route('home') }}#aspirasi" class="px-3.5 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-royal-800 hover:bg-slate-50 transition">
                        e-Aspirasi
                    </a>
                    <a href="{{ route('aspirasi.track') }}" class="px-3.5 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-royal-800 hover:bg-slate-50 transition">
                        Lacak Tiket
                    </a>
                </div>

                <!-- Right Action Buttons -->
                <div class="hidden md:flex items-center space-x-3">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold text-royal-800 bg-blue-50 hover:bg-blue-100 border border-blue-200 transition shadow-xs">
                            <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                            Dashboard Admin
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="p-2.5 rounded-lg text-slate-500 hover:text-red-600 hover:bg-red-50 transition" title="Keluar">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2.5 rounded-lg text-sm font-semibold text-slate-700 hover:text-royal-800 hover:bg-slate-100 transition">
                            Log In
                        </a>
                        <a href="{{ route('home') }}#aspirasi" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-bold text-white bg-gold-500 hover:bg-gold-600 active:scale-95 transition shadow-sm shadow-gold-500/25">
                            <i data-lucide="send" class="w-4 h-4"></i>
                            Kirim Aspirasi
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="p-2 rounded-lg text-slate-600 hover:text-royal-800 hover:bg-slate-100 focus:outline-none">
                        <i x-show="!mobileMenuOpen" data-lucide="menu" class="w-6 h-6"></i>
                        <i x-show="mobileMenuOpen" x-cloak data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenuOpen" x-cloak class="lg:hidden bg-white border-b border-slate-200 px-4 pt-2 pb-6 space-y-1 shadow-lg">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-royal-800">
                Home
            </a>
            <a href="{{ route('berita.index') }}" class="block px-3 py-2 rounded-md text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-royal-800">
                Berita Pemuda
            </a>
            <a href="{{ route('okp.index') }}" class="block px-3 py-2 rounded-md text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-royal-800">
                Direktori OKP
            </a>
            <a href="{{ route('agenda.index') }}" class="block px-3 py-2 rounded-md text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-royal-800">
                Agenda & Kegiatan
            </a>
            <a href="{{ route('home') }}#aspirasi" class="block px-3 py-2 rounded-md text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-royal-800">
                e-Aspirasi
            </a>
            <a href="{{ route('aspirasi.track') }}" class="block px-3 py-2 rounded-md text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-royal-800">
                Lacak Tiket Aspirasi
            </a>
            <div class="pt-4 border-t border-slate-100 flex flex-col gap-2">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="text-center px-4 py-2.5 rounded-lg text-sm font-semibold bg-royal-800 text-white">
                        Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-center px-4 py-2.5 rounded-lg text-sm font-semibold border border-slate-300 text-slate-700">
                        Log In
                    </a>
                    <a href="{{ route('home') }}#aspirasi" class="text-center px-4 py-2.5 rounded-lg text-sm font-bold bg-gold-500 text-white">
                        Kirim Aspirasi Sekarang
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Global Alert Notifications -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full mt-4">
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" class="mb-4 flex items-center justify-between p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-800 shadow-xs">
                <div class="flex items-center gap-3">
                    <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 shrink-0"></i>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
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
                    <p class="text-sm font-medium">{{ session('error') }}</p>
                </div>
                <button @click="show = false" class="text-red-500 hover:text-red-700">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif

        @if($errors->any())
            <div x-data="{ show: true }" x-show="show" class="mb-4 p-4 bg-amber-50 border border-amber-200 rounded-xl text-amber-900 shadow-xs">
                <div class="flex items-center gap-2 mb-1">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-amber-600"></i>
                    <h4 class="font-bold text-sm">Harap periksa kembali isian formulir:</h4>
                </div>
                <ul class="list-disc list-inside text-xs space-y-1 ml-5">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Main Content Dynamic Slot -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- 3. Footer Matching Civic Aesthetic -->
    <footer class="bg-slate-900 text-slate-300 pt-16 pb-12 border-t border-slate-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-800">
                <!-- Col 1: About KNPI -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('images/knpi-logo.png') }}" alt="Logo Resmi KNPI" class="w-11 h-11 object-contain drop-shadow-md">
                        <span class="font-extrabold text-xl text-white tracking-tight">KNPI Digital Ecosystem</span>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed pr-6">
                        Wadah berhimpun resmi Organisasi Kemasyarakatan Pemuda (OKP) seluruh Indonesia. Menjadi episentrum konsolidasi gerakan pemuda, perumusan gagasan strategis kebangsaan, dan saluran aspirasi pemuda terintegrasi.
                    </p>
                    <div class="flex items-center space-x-3 text-slate-400">
                        <a href="#" class="w-9 h-9 rounded-lg bg-slate-800 hover:bg-royal-800 hover:text-white flex items-center justify-center transition">
                            <i data-lucide="facebook" class="w-4 h-4"></i>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-lg bg-slate-800 hover:bg-royal-800 hover:text-white flex items-center justify-center transition">
                            <i data-lucide="instagram" class="w-4 h-4"></i>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-lg bg-slate-800 hover:bg-royal-800 hover:text-white flex items-center justify-center transition">
                            <i data-lucide="twitter" class="w-4 h-4"></i>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-lg bg-slate-800 hover:bg-royal-800 hover:text-white flex items-center justify-center transition">
                            <i data-lucide="youtube" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Navigasi Cepat -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-l-2 border-gold-500 pl-2">
                        Navigasi
                    </h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-gold-400 transition">Beranda Utama</a></li>
                        <li><a href="{{ route('berita.index') }}" class="hover:text-gold-400 transition">Warta Pemuda</a></li>
                        <li><a href="{{ route('okp.index') }}" class="hover:text-gold-400 transition">Direktori OKP</a></li>
                        <li><a href="{{ route('agenda.index') }}" class="hover:text-gold-400 transition">Kalender Agenda</a></li>
                        <li><a href="{{ route('home') }}#aspirasi" class="hover:text-gold-400 transition">Kanal e-Aspirasi</a></li>
                    </ul>
                </div>

                <!-- Col 3: Layanan Pemuda -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-l-2 border-gold-500 pl-2">
                        Layanan Publik
                    </h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('aspirasi.track') }}" class="hover:text-gold-400 transition">Lacak Status Tiket</a></li>
                        <li><a href="{{ route('okp.index') }}" class="hover:text-gold-400 transition">Verifikasi SK Legalitas</a></li>
                        <li><a href="{{ route('agenda.index') }}" class="hover:text-gold-400 transition">Pendaftaran Program</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-gold-400 transition">Portal Masuk Pengurus</a></li>
                    </ul>
                </div>

                <!-- Col 4: Sekretariat -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-l-2 border-gold-500 pl-2">
                        Sekretariat DPP
                    </h3>
                    <p class="text-sm text-slate-400 leading-relaxed mb-3">
                        Gedung Graha Pemuda DPP KNPI<br>
                        Jl. HR Rasuna Said Kav. C-22, Kuningan, Karet Kuningan, Setiabudi, Jakarta Selatan 12920.
                    </p>
                    <p class="text-sm text-slate-400">
                        <span class="text-white font-medium">Telepon:</span> (021) 525-4911<br>
                        <span class="text-white font-medium">Email:</span> dpp@knpi.or.id
                    </p>
                </div>
            </div>

            <!-- Bottom Copyright & Disclaimer -->
            <div class="pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-slate-500 gap-4">
                <p>© 2026 DPP Komite Nasional Pemuda Indonesia (KNPI). Hak Cipta Dilindungi Undang-Undang.</p>
                <div class="flex items-center space-x-6">
                    <a href="#" class="hover:text-slate-400 transition">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-slate-400 transition">Syarat & Ketentuan</a>
                    <a href="{{ route('login') }}" class="hover:text-gold-400 transition">Admin Portal</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Init Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
