@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-12rem)] flex items-center justify-center py-10 px-4 sm:px-6 lg:px-8 relative overflow-hidden bg-gradient-to-b from-slate-100 via-paper to-blue-50/40">
    
    <!-- Background Ambient Atmospheric Accents -->
    <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-royal-800/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 rounded-full bg-gold-500/15 blur-3xl pointer-events-none"></div>

    <!-- Main Dual-Column Authentication Container -->
    <div 
        x-data="{
            showPassword: false,
            captchaQuestion: '{{ $captchaQuestion }}',
            refreshingCaptcha: false,
            emailInput: '{{ old('email', 'admin@knpi.or.id') }}',
            passwordInput: 'password123',
            fillCredentials(email, roleName) {
                this.emailInput = email;
                this.passwordInput = 'password123';
            },
            async refreshCaptcha() {
                this.refreshingCaptcha = true;
                try {
                    const res = await fetch('{{ route('captcha.refresh') }}');
                    const data = await res.json();
                    if (data.question) {
                        this.captchaQuestion = data.question;
                    }
                } catch (e) {
                    console.error('Failed to refresh captcha', e);
                } finally {
                    setTimeout(() => { this.refreshingCaptcha = false; }, 350);
                }
            }
        }"
        class="max-w-4xl w-full bg-white rounded-3xl border border-slate-200/90 shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-12 relative z-10"
    >
        
        <!-- 1. LEFT BRANDING & SECURITY SHOWCASE (5 COLS) -->
        <div class="lg:col-span-5 bg-gradient-to-br from-royal-900 via-royal-800 to-royal-950 p-8 sm:p-10 text-white flex flex-col justify-between relative overflow-hidden">
            <!-- Decorative Background Pattern -->
            <div class="absolute inset-0 hero-pattern opacity-20 pointer-events-none"></div>
            <div class="absolute -right-16 -top-16 w-56 h-56 rounded-full bg-gold-500/20 blur-2xl pointer-events-none"></div>
            <div class="absolute -left-16 -bottom-16 w-56 h-56 rounded-full bg-blue-400/20 blur-2xl pointer-events-none"></div>

            <div class="relative z-10 space-y-6">
                <!-- KNPI Logo Badge -->
                <div class="flex items-center space-x-3.5">
                    <div class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-md p-2 border border-white/20 shadow-md flex items-center justify-center">
                        <img src="{{ asset('images/knpi-logo.png') }}" alt="Logo Resmi KNPI" class="w-full h-full object-contain drop-shadow-md">
                    </div>
                    <div>
                        <div class="font-black text-xl text-white tracking-tight leading-none flex items-center">
                            KNPI <span class="text-gold-400 text-xs uppercase px-1.5 py-0.5 bg-gold-500/20 rounded border border-gold-400/30 ml-2 font-bold tracking-normal">Admin</span>
                        </div>
                        <p class="text-[11px] text-blue-200/80 font-medium mt-1">
                            Paper Minimalist Portal
                        </p>
                    </div>
                </div>

                <div class="pt-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-gold-500/20 text-gold-300 border border-gold-400/30">
                        <span class="w-1.5 h-1.5 rounded-full bg-gold-400 animate-pulse"></span>
                        Sistem Autentikasi Pengurus
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mt-3 leading-tight">
                        Pusat Kendali Ekosistem Pemuda
                    </h2>
                    <p class="text-xs text-blue-100/85 mt-2 leading-relaxed">
                        Gerbang operasional terintegrasi DPP KNPI untuk kurasi SK legalitas OKP, publikasi warta pemuda, dan tata kelola e-Aspirasi nasional.
                    </p>
                </div>

                <!-- Feature Highlights -->
                <div class="space-y-3 pt-2">
                    <div class="flex items-start gap-3 text-xs text-blue-100">
                        <div class="w-6 h-6 rounded-lg bg-white/10 border border-white/15 flex items-center justify-center text-gold-400 shrink-0 mt-0.5">
                            <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                        </div>
                        <div>
                            <strong class="text-white block font-semibold">Verifikasi SK Legalitas</strong>
                            <span class="text-[11px] text-blue-200/70">Validasi SK Kemenkumham & DPD terstandar.</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 text-xs text-blue-100">
                        <div class="w-6 h-6 rounded-lg bg-white/10 border border-white/15 flex items-center justify-center text-gold-400 shrink-0 mt-0.5">
                            <i data-lucide="ticket" class="w-3.5 h-3.5"></i>
                        </div>
                        <div>
                            <strong class="text-white block font-semibold">e-Aspirasi & Disposisi</strong>
                            <span class="text-[11px] text-blue-200/70">Tindak lanjut tiket pemuda real-time.</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 text-xs text-blue-100">
                        <div class="w-6 h-6 rounded-lg bg-white/10 border border-white/15 flex items-center justify-center text-gold-400 shrink-0 mt-0.5">
                            <i data-lucide="bot" class="w-3.5 h-3.5"></i>
                        </div>
                        <div>
                            <strong class="text-white block font-semibold">Proteksi Anti-Bot Captcha</strong>
                            <span class="text-[11px] text-blue-200/70">Enkripsi sesi & perlindungan brute-force.</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Badge -->
            <div class="pt-8 border-t border-white/10 text-[11px] text-blue-200/70 flex items-center justify-between relative z-10">
                <span class="flex items-center gap-1.5">
                    <i data-lucide="lock" class="w-3.5 h-3.5 text-gold-400"></i>
                    SSL 256-Bit Encrypted
                </span>
                <span>DPP KNPI © 2026</span>
            </div>
        </div>

        <!-- 2. RIGHT AUTHENTICATION FORM (7 COLS) -->
        <div class="lg:col-span-7 p-8 sm:p-10 flex flex-col justify-between bg-white">
            <div>
                <!-- Form Header -->
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-1">
                        <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                            Masuk ke Dashboard
                        </h3>
                        <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-royal-50 text-royal-800 border border-royal-200">
                            v2.0 Protected
                        </span>
                    </div>
                    <p class="text-xs text-slate-500">
                        Silakan lengkapi kredensial pengurus dan verifikasi keamanan Captcha.
                    </p>
                </div>

                <!-- Interactive Demo Account Quick-Fill Chips -->
                <div class="mb-6 p-3.5 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[11px] font-bold text-slate-700 uppercase tracking-wider flex items-center gap-1.5">
                            <i data-lucide="zap" class="w-3.5 h-3.5 text-gold-500"></i>
                            Pilih Akun Demo (Klik untuk Isi Otomatis):
                        </span>
                    </div>
                    <div class="grid grid-cols-3 gap-2">
                        <button 
                            type="button" 
                            @click="fillCredentials('admin@knpi.or.id', 'Super Admin')"
                            class="px-2.5 py-1.5 rounded-lg text-left border border-slate-200 hover:border-royal-800 hover:bg-blue-50/60 transition group cursor-pointer"
                        >
                            <span class="block text-[11px] font-bold text-slate-800 group-hover:text-royal-800 truncate">Super Admin</span>
                            <span class="block text-[10px] text-slate-400 truncate">admin@knpi.or.id</span>
                        </button>
                        <button 
                            type="button" 
                            @click="fillCredentials('humas@knpi.or.id', 'Admin Humas')"
                            class="px-2.5 py-1.5 rounded-lg text-left border border-slate-200 hover:border-royal-800 hover:bg-blue-50/60 transition group cursor-pointer"
                        >
                            <span class="block text-[11px] font-bold text-slate-800 group-hover:text-royal-800 truncate">Admin Humas</span>
                            <span class="block text-[10px] text-slate-400 truncate">humas@knpi.or.id</span>
                        </button>
                        <button 
                            type="button" 
                            @click="fillCredentials('okp@knpi.or.id', 'Admin OKP')"
                            class="px-2.5 py-1.5 rounded-lg text-left border border-slate-200 hover:border-royal-800 hover:bg-blue-50/60 transition group cursor-pointer"
                        >
                            <span class="block text-[11px] font-bold text-slate-800 group-hover:text-royal-800 truncate">Admin OKP</span>
                            <span class="block text-[10px] text-slate-400 truncate">okp@knpi.or.id</span>
                        </button>
                    </div>
                </div>

                <!-- Form Login -->
                <form method="POST" action="{{ route('login.attempt') }}" class="space-y-4">
                    @csrf

                    <!-- Email Input -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Alamat Email Pengurus
                        </label>
                        <div class="relative">
                            <i data-lucide="mail" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                            <input 
                                type="email" 
                                name="email" 
                                x-model="emailInput"
                                required 
                                autofocus 
                                placeholder="nama@knpi.or.id" 
                                class="w-full text-xs pl-10 pr-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-royal-800 focus:ring-2 focus:ring-royal-800/10 transition bg-white"
                            >
                        </div>
                    </div>

                    <!-- Password Input with Show/Hide Toggle -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Kata Sandi
                        </label>
                        <div class="relative">
                            <i data-lucide="lock" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                            <input 
                                :type="showPassword ? 'text' : 'password'" 
                                name="password" 
                                x-model="passwordInput"
                                required 
                                placeholder="••••••••" 
                                class="w-full text-xs pl-10 pr-10 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-royal-800 focus:ring-2 focus:ring-royal-800/10 transition bg-white"
                            >
                            <button 
                                type="button" 
                                @click="showPassword = !showPassword" 
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none"
                                title="Tampilkan sandi"
                            >
                                <i x-show="!showPassword" data-lucide="eye" class="w-4 h-4"></i>
                                <i x-show="showPassword" x-cloak data-lucide="eye-off" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>

                    <!-- CAPTCHA Security Verification Component -->
                    <div class="p-4 rounded-xl bg-slate-50/90 border border-slate-200 space-y-2.5">
                        <div class="flex items-center justify-between">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center gap-1.5">
                                <i data-lucide="shield" class="w-3.5 h-3.5 text-royal-800"></i>
                                Verifikasi Keamanan (Anti-Bot)
                            </label>
                            <button 
                                type="button" 
                                @click="refreshCaptcha()" 
                                class="text-[11px] font-semibold text-royal-800 hover:text-royal-900 flex items-center gap-1 transition"
                                title="Buat soal matematika baru"
                            >
                                <i data-lucide="rotate-cw" class="w-3.5 h-3.5" :class="refreshingCaptcha ? 'animate-spin' : ''"></i>
                                Ganti Soal
                            </button>
                        </div>

                        <div class="flex items-center gap-3">
                            <!-- Captcha Question Badge with security styling -->
                            <div class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-royal-800 to-royal-900 text-white font-mono font-extrabold text-sm tracking-widest shadow-xs select-none border border-royal-700 flex items-center gap-2">
                                <span x-text="captchaQuestion + ' = ?'"></span>
                            </div>

                            <!-- Captcha Input Field -->
                            <div class="flex-1 relative">
                                <input 
                                    type="number" 
                                    name="captcha" 
                                    required 
                                    autocomplete="off"
                                    placeholder="Hasil hitung..." 
                                    class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-royal-800 focus:ring-2 focus:ring-royal-800/10 font-bold text-slate-800 bg-white"
                                >
                            </div>
                        </div>
                        <p class="text-[10px] text-slate-500 italic">
                            Hitung penjumlahan di atas untuk memvalidasi bahwa Anda bukan robot.
                        </p>
                    </div>

                    <!-- Remember & Help -->
                    <div class="flex items-center justify-between text-xs pt-1">
                        <label class="flex items-center text-slate-600 cursor-pointer select-none">
                            <input type="checkbox" name="remember" class="rounded border-slate-300 text-royal-800 focus:ring-royal-800 mr-2">
                            Ingat Sesi Saya
                        </label>
                        <a href="{{ route('home') }}#aspirasi" class="text-royal-800 font-semibold hover:underline">
                            Butuh Bantuan Akun?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider text-white bg-royal-800 hover:bg-royal-900 active:scale-98 transition-all shadow-md shadow-royal-800/20 flex items-center justify-center gap-2 mt-2"
                    >
                        <i data-lucide="log-in" class="w-4 h-4"></i>
                        Autentikasi & Masuk ke Dashboard
                    </button>
                </form>
            </div>

            <!-- Back to Home Link -->
            <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 font-semibold text-slate-600 hover:text-royal-800 transition">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                    Kembali ke Beranda KNPI
                </a>
                <span class="text-[11px] text-slate-400 font-mono">KNPI-AUTH-SECURE</span>
            </div>
        </div>

    </div>

</div>
@endsection
