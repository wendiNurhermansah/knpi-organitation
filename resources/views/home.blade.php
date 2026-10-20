@extends('layouts.app')

@section('content')
    <!-- 1. HERO SECTION -->
    <section class="relative bg-royal-800 text-white overflow-hidden">
        <!-- Background Decorative Elements -->
        <div class="absolute inset-0 hero-pattern opacity-30"></div>
        
        <!-- Gold Angular Accent Slice (Matches UI Mockup) -->
        <div class="absolute right-0 top-0 bottom-0 w-1/3 lg:w-5/12 bg-gradient-to-l from-gold-500/30 to-transparent pointer-events-none hidden md:block"></div>
        <div class="absolute -right-20 -bottom-20 w-96 h-96 rounded-full bg-gold-500/20 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left Hero Content (7 Cols) -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-royal-700/80 border border-blue-400/30 text-blue-200 text-xs font-semibold tracking-wide shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-gold-400 animate-pulse"></span>
                        Digital Ekosistem Pemuda Otentik
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                        Sinergi Pemuda, <br>
                        Membangun Bangsa <br>
                        <span class="text-gold-400">Menuju Indonesia Emas</span>
                    </h1>

                    <p class="text-base sm:text-lg text-blue-100/90 leading-relaxed max-w-2xl font-normal">
                        Platform resmi integrasi data Organisasi Kemasyarakatan Pemuda (OKP) seluruh Indonesia, verifikasi SK legalitas digital, publikasi warta gerakan, serta kanal e-Aspirasi pemuda berintegritas.
                    </p>

                    <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                        <a href="#aspirasi" class="inline-flex justify-center items-center gap-2.5 px-6 py-3.5 rounded-xl font-bold text-sm text-slate-900 bg-gold-500 hover:bg-gold-400 active:scale-95 transition-all shadow-lg shadow-gold-500/25">
                            <i data-lucide="send" class="w-4 h-4"></i>
                            Kirim Aspirasi Sekarang
                        </a>
                        <a href="{{ route('okp.index') }}" class="inline-flex justify-center items-center gap-2.5 px-6 py-3.5 rounded-xl font-semibold text-sm text-white bg-royal-700/70 hover:bg-royal-700 border border-blue-300/30 backdrop-blur-xs transition">
                            <i data-lucide="building-2" class="w-4 h-4 text-gold-400"></i>
                            Jelajahi Direktori OKP
                        </a>
                    </div>

                    <!-- Quick Trust Pill -->
                    <div class="pt-4 flex items-center gap-6 text-xs text-blue-200/80 border-t border-blue-500/20">
                        <div class="flex items-center gap-2">
                            <i data-lucide="shield-check" class="w-4 h-4 text-gold-400"></i>
                            Terverifikasi Kemenkumham & DPD
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="lock" class="w-4 h-4 text-gold-400"></i>
                            Enkripsi Tiket Aman
                        </div>
                    </div>
                </div>

                <!-- Right Hero Banner Showcase (5 Cols) -->
                <div class="lg:col-span-5 relative">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        <!-- Card Frame -->
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl border-2 border-blue-400/20 bg-gradient-to-tr from-royal-900 via-royal-800 to-royal-700 p-3">
                            <div class="rounded-xl overflow-hidden bg-slate-800 aspect-4/3 relative flex items-center justify-center">
                                <!-- Realistic Simulated Hero Graphic -->
                                <div class="absolute inset-0 bg-gradient-to-t from-royal-950 via-royal-900/60 to-transparent z-10"></div>
                                
                                <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=800&q=80" alt="Pemuda Indonesia Bersatu" class="w-full h-full object-cover">

                                <!-- Floating Badge on Hero Image -->
                                <div class="absolute bottom-4 left-4 right-4 z-20 bg-slate-900/80 backdrop-blur-md rounded-xl p-3 border border-white/10 flex items-center justify-between">
                                    <div>
                                        <div class="text-[11px] text-gold-400 font-bold uppercase tracking-wider">KNPI Satu Hati</div>
                                        <div class="text-xs font-semibold text-white">Kongres Pemuda Nasional 2026</div>
                                    </div>
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                        Aktif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Stat Accent Chip -->
                        <div class="absolute -bottom-6 -left-6 bg-white text-slate-800 p-4 rounded-xl shadow-xl border border-slate-200 hidden sm:flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-royal-50 flex items-center justify-center text-royal-800">
                                <i data-lucide="award" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <div class="text-lg font-black text-slate-900 leading-none">100%</div>
                                <div class="text-[11px] font-medium text-slate-500">Transparansi Publik</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 2. 4-COLUMN QUICK METRIC STRIP -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            
            <!-- Metric 1: Quick Stats OKP -->
            <div class="bg-white rounded-xl p-5 border border-slate-200/90 shadow-sm hover:shadow-md transition group">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Quick Stats</span>
                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-royal-800 flex items-center justify-center group-hover:bg-royal-800 group-hover:text-white transition">
                        <i data-lucide="users" class="w-4 h-4"></i>
                    </div>
                </div>
                <div class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ number_format($metrics['okp_count']) }}
                </div>
                <p class="text-xs text-slate-500 mt-1 font-medium">OKP & Pemuda Terdaftar</p>
            </div>

            <!-- Metric 2: Youth News -->
            <div class="bg-white rounded-xl p-5 border border-slate-200/90 shadow-sm hover:shadow-md transition group">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Youth News</span>
                    <div class="w-8 h-8 rounded-lg bg-amber-50 text-gold-600 flex items-center justify-center group-hover:bg-gold-500 group-hover:text-white transition">
                        <i data-lucide="newspaper" class="w-4 h-4"></i>
                    </div>
                </div>
                <div class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ number_format($metrics['news_count']) }}
                </div>
                <p class="text-xs text-slate-500 mt-1 font-medium">Warta & Siaran Pers</p>
            </div>

            <!-- Metric 3: Events Agenda -->
            <div class="bg-white rounded-xl p-5 border border-slate-200/90 shadow-sm hover:shadow-md transition group">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Youth Agenda</span>
                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-royal-800 flex items-center justify-center group-hover:bg-royal-800 group-hover:text-white transition">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                    </div>
                </div>
                <div class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ number_format($metrics['events_count']) }}
                </div>
                <p class="text-xs text-slate-500 mt-1 font-medium">Agenda & Program Kerja</p>
            </div>

            <!-- Metric 4: Verifications & Aspirations -->
            <div class="bg-white rounded-xl p-5 border border-slate-200/90 shadow-sm hover:shadow-md transition group">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Verifications</span>
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition">
                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                    </div>
                </div>
                <div class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ number_format($metrics['aspirations_count']) }}
                </div>
                <p class="text-xs text-slate-500 mt-1 font-medium">Aspirasi Terakomodasi</p>
            </div>

        </div>
    </section>

    <!-- 3. FEATURED YOUTH NEWS (3 CARDS) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-12">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-royal-800">Warta Kepemudaan</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mt-1">
                    Featured Youth News
                </h2>
            </div>
            <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-royal-800 hover:text-royal-900 hover:gap-2 transition-all">
                Lihat Semua Berita <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($featuredArticles as $article)
                <article class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-md transition flex flex-col group">
                    <!-- Thumbnail -->
                    <div class="aspect-16/9 bg-slate-100 overflow-hidden relative">
                        @if($article->thumbnail)
                            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <img src="https://images.unsplash.com/photo-1544531585-9847b68c8c86?auto=format&fit=crop&w=700&q=80" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @endif
                        <span class="absolute top-3 left-3 px-2.5 py-1 rounded-md text-[11px] font-bold bg-royal-800/90 text-white backdrop-blur-xs">
                            {{ $article->category->name ?? 'Kepemudaan' }}
                        </span>
                    </div>

                    <!-- Content -->
                    <div class="p-5 flex flex-col flex-1">
                        <div class="flex items-center gap-3 text-xs text-slate-400 mb-2">
                            <span><i data-lucide="calendar" class="w-3.5 h-3.5 inline mr-1"></i>{{ $article->published_at ? $article->published_at->translatedFormat('d M Y') : $article->created_at->translatedFormat('d M Y') }}</span>
                            <span>•</span>
                            <span><i data-lucide="eye" class="w-3.5 h-3.5 inline mr-1"></i>{{ number_format($article->views_count) }} dibaca</span>
                        </div>

                        <h3 class="text-base font-bold text-slate-900 group-hover:text-royal-800 transition line-clamp-2 leading-snug mb-2">
                            <a href="{{ route('berita.show', $article->slug) }}">
                                {{ $article->title }}
                            </a>
                        </h3>

                        <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed mb-4 flex-1">
                            {{ $article->summary }}
                        </p>

                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-royal-800">
                            <span>Baca Selengkapnya</span>
                            <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-3 text-center py-12 bg-white rounded-xl border border-slate-200">
                    <p class="text-sm text-slate-500">Belum ada artikel berita yang dipublikasikan.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- 4. REGISTERED OKP DIRECTORY SHOWCASE GRID -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-royal-800">Verifikasi Resmi</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mt-1">
                    Registered OKP Directory
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Organisasi Kemasyarakatan Pemuda yang terdaftar dan memiliki legalitas SK sah di KNPI
                </p>
            </div>
            <a href="{{ route('okp.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-royal-800 hover:text-royal-900 hover:gap-2 transition-all">
                Buka Direktori Lengkap <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($showcaseOrganizations as $org)
                <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-xs hover:border-royal-800 hover:shadow-md transition">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <div class="w-11 h-11 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center font-black text-royal-800 text-sm shrink-0">
                            {{ strtoupper(substr($org->name, 0, 2)) }}
                        </div>
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shrink-0">
                            <i data-lucide="check" class="w-3 h-3"></i> Terverifikasi
                        </span>
                    </div>

                    <h3 class="text-sm font-bold text-slate-900 truncate" title="{{ $org->name }}">
                        {{ $org->name }}
                    </h3>

                    <div class="mt-3 space-y-1.5 text-xs text-slate-600">
                        <div class="flex items-center gap-2">
                            <i data-lucide="user" class="w-3.5 h-3.5 text-slate-400"></i>
                            <span class="truncate">Ketua: <span class="font-medium text-slate-800">{{ $org->leader_name }}</span></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="file-badge" class="w-3.5 h-3.5 text-slate-400"></i>
                            <span class="truncate font-mono text-[11px] text-slate-500">{{ $org->sk_number }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-8 bg-white rounded-xl border border-slate-200 text-sm text-slate-500">
                    Belum ada data OKP terverifikasi.
                </div>
            @endforelse
        </div>
    </section>

    <!-- 5. UPCOMING EVENTS & E-ASPIRASI WIDGET SECTION -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" id="aspirasi">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- LEFT COLUMN: Upcoming Events & Programs (6 Cols) -->
            <div class="lg:col-span-6 space-y-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-royal-800">Kalender Pemuda</span>
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight mt-1">
                        Upcoming Youth Events
                    </h2>
                    <p class="text-xs text-slate-500 mt-1">
                        Ikuti forum dialog, pelatihan kewirausahaan, dan musyawarah konsolidasi pemuda.
                    </p>
                </div>

                <div class="space-y-4">
                    @forelse($upcomingEvents as $event)
                        <div x-data="{ modalOpen: false }" class="bg-white rounded-xl p-5 border border-slate-200 shadow-xs hover:border-slate-300 transition flex flex-col sm:flex-row gap-4">
                            <!-- Date Box -->
                            <div class="sm:w-20 rounded-lg bg-blue-50 border border-blue-100 p-3 text-center flex flex-col justify-center items-center shrink-0">
                                <span class="text-xs font-bold uppercase text-royal-800">{{ $event->start_time->translatedFormat('M') }}</span>
                                <span class="text-2xl font-black text-royal-900 leading-none">{{ $event->start_time->format('d') }}</span>
                                <span class="text-[10px] text-slate-500 mt-1">{{ $event->start_time->format('H:i') }} WIB</span>
                            </div>

                            <!-- Details -->
                            <div class="flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-sm font-bold text-slate-900 hover:text-royal-800 transition line-clamp-1">
                                        {{ $event->title }}
                                    </h3>
                                    <p class="text-xs text-slate-600 line-clamp-2 mt-1">
                                        {{ $event->description }}
                                    </p>
                                    <div class="flex items-center gap-2 mt-2 text-xs text-slate-500">
                                        <i data-lucide="map-pin" class="w-3.5 h-3.5 text-gold-500"></i>
                                        <span class="truncate">{{ $event->location }}</span>
                                    </div>
                                </div>

                                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                                    <span class="text-xs text-slate-500">
                                        Sisa Kuota: <strong class="text-royal-800">{{ $event->remaining_quota }}</strong> / {{ $event->quota }}
                                    </span>

                                    @if($event->is_open_registration && $event->remaining_quota > 0)
                                        <button @click="modalOpen = true" class="px-3 py-1.5 rounded-lg text-xs font-bold text-royal-800 bg-blue-50 hover:bg-royal-800 hover:text-white transition">
                                            Daftar Ikut
                                        </button>
                                    @else
                                        <span class="text-xs font-semibold text-slate-400">Pendaftaran Ditutup</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Modal Pendaftaran Event -->
                            <div x-show="modalOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                    <div @click="modalOpen = false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity"></div>
                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                                    <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200">
                                        <div class="bg-royal-800 px-6 py-4 text-white flex justify-between items-center">
                                            <div>
                                                <h4 class="font-bold text-sm">Pendaftaran Peserta</h4>
                                                <p class="text-xs text-blue-200 truncate max-w-sm">{{ $event->title }}</p>
                                            </div>
                                            <button @click="modalOpen = false" class="text-white/80 hover:text-white">
                                                <i data-lucide="x" class="w-5 h-5"></i>
                                            </button>
                                        </div>

                                        <form method="POST" action="{{ route('agenda.register', $event->id) }}" class="p-6 space-y-4">
                                            @csrf
                                            <div>
                                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nama Lengkap</label>
                                                <input type="text" name="name" required class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg focus:ring-1 focus:ring-royal-800 focus:outline-none" placeholder="Masukkan nama sesuai KTP">
                                            </div>

                                            <div class="grid grid-cols-2 gap-3">
                                                <div>
                                                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">NIK (16 Digit)</label>
                                                    <input type="text" name="nik" maxlength="16" required class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg focus:ring-1 focus:ring-royal-800 focus:outline-none" placeholder="3201xxxxxxxxxxxx">
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nomor WhatsApp</label>
                                                    <input type="text" name="phone" required class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg focus:ring-1 focus:ring-royal-800 focus:outline-none" placeholder="08xxxxxxxxxx">
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Alamat Email</label>
                                                <input type="email" name="email" required class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg focus:ring-1 focus:ring-royal-800 focus:outline-none" placeholder="alamat@email.com">
                                            </div>

                                            <div>
                                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Asal OKP / Umum</label>
                                                <input type="text" name="okp_origin" required class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg focus:ring-1 focus:ring-royal-800 focus:outline-none" placeholder="Contoh: Pemuda Pancasila / Umum">
                                            </div>

                                            <div class="pt-2 flex justify-end gap-2">
                                                <button @click="modalOpen = false" type="button" class="px-4 py-2 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100">
                                                    Batal
                                                </button>
                                                <button type="submit" class="px-5 py-2 rounded-lg text-xs font-bold bg-gold-500 hover:bg-gold-600 text-slate-900 shadow-sm">
                                                    Konfirmasi Pendaftaran
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 bg-white rounded-xl border border-slate-200 text-xs text-slate-500">
                            Belum ada agenda kegiatan mendatang.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- RIGHT COLUMN: e-Aspirasi Widget Box (6 Cols) -->
            <div class="lg:col-span-6">
                <!-- Royal Blue Widget Box (Matches UI Mockup) -->
                <div class="bg-royal-800 text-white rounded-2xl p-6 sm:p-8 shadow-xl border border-royal-700 relative overflow-hidden">
                    <div class="absolute -right-16 -top-16 w-60 h-60 rounded-full bg-blue-500/10 pointer-events-none"></div>

                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-gold-500 text-slate-950">
                                    Layanan Resmi
                                </span>
                                <h3 class="text-xl font-extrabold text-white mt-1">e-Aspirasi Pemuda</h3>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-royal-700/80 flex items-center justify-center text-gold-400">
                                <i data-lucide="message-square-plus" class="w-5 h-5"></i>
                            </div>
                        </div>

                        <p class="text-xs text-blue-100/90 leading-relaxed mb-6">
                            Sampaikan gagasan, kritik konstruktif, atau aspirasi kepemudaan secara langsung kepada DPP KNPI. Setiap aspirasi akan diberikan kode tiket resmi untuk pelacakan progres.
                        </p>

                        <!-- Form Submission -->
                        <form method="POST" action="{{ route('aspirasi.store') }}" enctype="multipart/form-data" class="space-y-4">
                            @csrf

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-blue-200 mb-1">Nama Lengkap</label>
                                    <input type="text" name="sender_name" value="{{ old('sender_name') }}" required placeholder="Nama Anda" class="w-full text-xs px-3.5 py-2.5 rounded-lg bg-royal-900/60 border border-blue-400/30 text-white placeholder-blue-300/40 focus:outline-none focus:border-gold-400 focus:ring-1 focus:ring-gold-400 transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-blue-200 mb-1">Alamat Email</label>
                                    <input type="email" name="sender_email" value="{{ old('sender_email') }}" required placeholder="email@anda.com" class="w-full text-xs px-3.5 py-2.5 rounded-lg bg-royal-900/60 border border-blue-400/30 text-white placeholder-blue-300/40 focus:outline-none focus:border-gold-400 focus:ring-1 focus:ring-gold-400 transition">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-blue-200 mb-1">Kategori Isu</label>
                                    <select name="category" required class="w-full text-xs px-3.5 py-2.5 rounded-lg bg-royal-900/60 border border-blue-400/30 text-white focus:outline-none focus:border-gold-400 focus:ring-1 focus:ring-gold-400 transition">
                                        <option value="" class="text-slate-800">Pilih Kategori...</option>
                                        <option value="Ketenagakerjaan" {{ old('category') == 'Ketenagakerjaan' ? 'selected' : '' }} class="text-slate-800">Ketenagakerjaan & Vokasi</option>
                                        <option value="Kepemudaan" {{ old('category') == 'Kepemudaan' ? 'selected' : '' }} class="text-slate-800">Kepemudaan & Keorganisasian</option>
                                        <option value="Sosial Budaya" {{ old('category') == 'Sosial Budaya' ? 'selected' : '' }} class="text-slate-800">Sosial & Budaya</option>
                                        <option value="Wirausaha" {{ old('category') == 'Wirausaha' ? 'selected' : '' }} class="text-slate-800">Wirausaha Muda & UMKM</option>
                                        <option value="Hukum/Umum" {{ old('category') == 'Hukum/Umum' ? 'selected' : '' }} class="text-slate-800">Hukum & Kebijakan Publik</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-blue-200 mb-1">Perihal / Subjek</label>
                                    <input type="text" name="subject" value="{{ old('subject') }}" required placeholder="Contoh: Advokasi Sertifikasi Pemuda" class="w-full text-xs px-3.5 py-2.5 rounded-lg bg-royal-900/60 border border-blue-400/30 text-white placeholder-blue-300/40 focus:outline-none focus:border-gold-400 focus:ring-1 focus:ring-gold-400 transition">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-blue-200 mb-1">Pesan Aspirasi</label>
                                <textarea name="message" rows="3" required placeholder="Tuliskan gagasan, fakta, dan aspirasi Anda secara lengkap..." class="w-full text-xs px-3.5 py-2.5 rounded-lg bg-royal-900/60 border border-blue-400/30 text-white placeholder-blue-300/40 focus:outline-none focus:border-gold-400 focus:ring-1 focus:ring-gold-400 transition">{{ old('message') }}</textarea>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-blue-200 mb-1">Lampiran Dokumen (Opsional, PDF/Foto maks 5MB)</label>
                                <input type="file" name="attachment" accept=".pdf,.jpg,.jpeg,.png" class="w-full text-xs text-blue-200 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-bold file:bg-blue-700 file:text-white hover:file:bg-blue-600 cursor-pointer">
                            </div>

                            <button type="submit" class="w-full py-3 rounded-xl font-bold text-xs uppercase tracking-wider text-slate-950 bg-gold-500 hover:bg-gold-400 active:scale-98 transition shadow-md shadow-gold-500/20">
                                Kirim Aspirasi Pemuda
                            </button>
                        </form>

                        <!-- Dynamic Ticket Tracking Box (Matches UI Mockup bottom input) -->
                        <div class="mt-6 pt-5 border-t border-blue-400/20">
                            <label class="block text-xs font-bold text-gold-400 uppercase tracking-wide mb-2">
                                <i data-lucide="search" class="w-3.5 h-3.5 inline mr-1"></i>
                                Sudah Punya Kode Tiket? Lacak Progres Disini:
                            </label>
                            <form method="GET" action="{{ route('aspirasi.track') }}" class="flex gap-2">
                                <input type="text" name="ticket_code" placeholder="Contoh: KNPI-202610-XXXX" required class="flex-1 text-xs px-3.5 py-2.5 rounded-lg bg-royal-900/80 border border-blue-400/40 text-white placeholder-blue-300/40 focus:outline-none focus:border-gold-400 focus:ring-1 focus:ring-gold-400 uppercase font-mono">
                                <button type="submit" class="px-5 py-2.5 rounded-lg text-xs font-bold text-royal-900 bg-white hover:bg-blue-50 transition shrink-0">
                                    Lacak
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
