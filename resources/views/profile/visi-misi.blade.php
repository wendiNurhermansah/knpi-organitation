@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-royal-800">{{ __('messages.nav.home') }}</a>
        <span>/</span>
        <span class="text-slate-500">{{ __('messages.nav.profile') }}</span>
        <span>/</span>
        <span class="text-royal-800 font-semibold">{{ __('messages.nav.vision_mission') }}</span>
    </nav>

    <!-- Hero Header -->
    <div class="bg-gradient-to-r from-royal-900 via-royal-800 to-royal-700 rounded-3xl p-8 sm:p-12 text-white relative overflow-hidden shadow-xl mb-12">
        <div class="absolute inset-0 hero-pattern opacity-20 pointer-events-none"></div>
        <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-gold-500/20 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 max-w-3xl space-y-4">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-gold-500 text-slate-950">
                <i data-lucide="target" class="w-3.5 h-3.5"></i>
                Arah Gerak & Cita-Cita Organisasi
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight">
                Visi, Misi & Nilai Dasar <br>
                <span class="text-gold-400">Menyongsong Indonesia Emas 2045</span>
            </h1>
            <p class="text-sm sm:text-base text-blue-100/90 leading-relaxed">
                Pondasi strategis perjuangan DPP KNPI dalam memandu transformasi kepemimpinan generasi muda agar berdaya saing global, berintegritas tinggi, dan berakar pada nilai-nilai luhur Pancasila.
            </p>
        </div>
    </div>

    <!-- Vision Card (Centerpiece) -->
    <div class="bg-white rounded-3xl p-8 sm:p-12 border-2 border-royal-700/20 shadow-lg relative overflow-hidden mb-12">
        <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-royal-800 via-gold-500 to-royal-800"></div>
        <div class="max-w-4xl mx-auto text-center space-y-4">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-blue-50 text-royal-800 text-xs font-bold uppercase tracking-wider">
                <i data-lucide="compass" class="w-4 h-4"></i>
                Visi Utama DPP KNPI
            </div>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-snug">
                "Terwujudnya Pemuda Indonesia yang Beriman, Berkarakter, Mandiri, Berdaya Saing Global, dan Bersatu Menuju <span class="text-royal-800 underline decoration-gold-500 decoration-wavy">Indonesia Emas 2045</span>."
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 max-w-2xl mx-auto">
                Visi ini menjadi kompas seluruh program kerja, akselerasi inovasi pemuda, dan konsolidasi ratusan Organisasi Kemasyarakatan Pemuda di seluruh pelosok negeri.
            </p>
        </div>
    </div>

    <!-- 5 Strategic Missions (Panca Krida Pemuda) -->
    <div class="mb-14">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-xs font-bold uppercase tracking-wider text-royal-800">Panca Krida Pemuda</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mt-1">
                5 Misi Strategis KNPI
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Langkah konkret dan terukur untuk mengakselerasi kemajuan pemuda Indonesia
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Misi 1 -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-xs hover:border-royal-800 hover:shadow-md transition group flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-royal-800 flex items-center justify-center font-black text-lg mb-4 group-hover:bg-royal-800 group-hover:text-white transition">
                        01
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2">Konsolidasi Gerakan & Wadah OKP</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Memperkokoh persatuan Organisasi Kemasyarakatan Pemuda (OKP) dari berbagai latar belakang, meniadakan polarisasi, serta memperkuat koordinasi DPD KNPI dari tingkat provinsi hingga kecamatan.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-100 text-[11px] font-semibold text-royal-800 flex items-center gap-1">
                    <i data-lucide="check-circle" class="w-3.5 h-3.5"></i> Satu Hati Satu Pemuda
                </div>
            </div>

            <!-- Misi 2 -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-xs hover:border-royal-800 hover:shadow-md transition group flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-gold-600 flex items-center justify-center font-black text-lg mb-4 group-hover:bg-gold-500 group-hover:text-white transition">
                        02
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2">Akselerasi SDM & Teknologi Masa Depan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Mendorong peningkatan kompetensi vokasi, literasi digital, penguasaan kecerdasan buatan (AI), dan sertifikasi keahlian agar generasi muda siap memimpin di pasar tenaga kerja internasional.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-100 text-[11px] font-semibold text-gold-600 flex items-center gap-1">
                    <i data-lucide="check-circle" class="w-3.5 h-3.5"></i> Future Skills Ready
                </div>
            </div>

            <!-- Misi 3 -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-xs hover:border-royal-800 hover:shadow-md transition group flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-lg mb-4 group-hover:bg-emerald-600 group-hover:text-white transition">
                        03
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2">Kemandirian Ekonomi & Wirausaha Muda</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Membangun inkubator bisnis rintisan (startup), membuka jejaring pendanaan ventura, serta memfasilitasi sertifikasi halal dan legalitas usaha bagi pelaku UMKM muda di seluruh Indonesia.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-100 text-[11px] font-semibold text-emerald-600 flex items-center gap-1">
                    <i data-lucide="check-circle" class="w-3.5 h-3.5"></i> Kemandirian Ekonomi
                </div>
            </div>

            <!-- Misi 4 -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-xs hover:border-royal-800 hover:shadow-md transition group flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center font-black text-lg mb-4 group-hover:bg-purple-600 group-hover:text-white transition">
                        04
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2">Karakter Kebangsaan & Kerukunan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Membumikan nilai-nilai Pancasila, merawat toleransi lintas agama, mencegah paham ekstremisme, serta menumbuhkan kebanggaan atas warisan kebudayaan dan kearifan lokal nusantara.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-100 text-[11px] font-semibold text-purple-600 flex items-center gap-1">
                    <i data-lucide="check-circle" class="w-3.5 h-3.5"></i> Moderasi & Toleransi
                </div>
            </div>

            <!-- Misi 5 -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-xs hover:border-royal-800 hover:shadow-md transition group flex flex-col justify-between md:col-span-2 lg:col-span-1">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center font-black text-lg mb-4 group-hover:bg-sky-600 group-hover:text-white transition">
                        05
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2">Advokasi Aspirasi & Kebijakan Publik</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Menjadi jembatan resmi penyerap aspirasi kepemudaan melalui kanal digital e-Aspirasi berintegritas dan menyuarakan rekomendasi kebijakan strategis kepada kementerian dan lembaga negara.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-100 text-[11px] font-semibold text-sky-600 flex items-center gap-1">
                    <i data-lucide="check-circle" class="w-3.5 h-3.5"></i> Suara Pemuda Terkawal
                </div>
            </div>
        </div>
    </div>

    <!-- 4 Core Values -->
    <div class="bg-gradient-to-br from-slate-900 to-royal-950 rounded-3xl p-8 sm:p-12 text-white shadow-xl">
        <div class="max-w-3xl mb-8">
            <span class="text-xs font-bold uppercase tracking-wider text-gold-400">Kultur Organisasi</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold mt-1">4 Nilai Dasar (Core Values)</h2>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">Prinsip etika dan moral yang dijunjung tinggi oleh setiap kader KNPI</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-5 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs">
                <i data-lucide="shield-check" class="w-6 h-6 text-gold-400 mb-3"></i>
                <h4 class="font-bold text-sm text-white mb-1">Integritas</h4>
                <p class="text-xs text-slate-400">Jujur, akuntabel, dan mengutamakan kepentingan bangsa di atas kepentingan pribadi.</p>
            </div>

            <div class="p-5 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs">
                <i data-lucide="flag" class="w-6 h-6 text-gold-400 mb-3"></i>
                <h4 class="font-bold text-sm text-white mb-1">Patriotisme</h4>
                <p class="text-xs text-slate-400">Komitmen tulus membela kedaulatan negara dan persatuan kesatuan tanah air.</p>
            </div>

            <div class="p-5 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs">
                <i data-lucide="users-2" class="w-6 h-6 text-gold-400 mb-3"></i>
                <h4 class="font-bold text-sm text-white mb-1">Kolaboratif</h4>
                <p class="text-xs text-slate-400">Terbuka merangkul seluruh elemen pemuda dan bersinergi lintas sektor.</p>
            </div>

            <div class="p-5 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs">
                <i data-lucide="lightbulb" class="w-6 h-6 text-gold-400 mb-3"></i>
                <h4 class="font-bold text-sm text-white mb-1">Visioner</h4>
                <p class="text-xs text-slate-400">Adaptif terhadap disrupsi global, berani berinovasi, dan berorientasi masa depan.</p>
            </div>
        </div>
    </div>
</div>
@endsection
