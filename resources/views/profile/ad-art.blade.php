@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-royal-800">{{ __('messages.nav.home') }}</a>
        <span>/</span>
        <span class="text-slate-500">{{ __('messages.nav.profile') }}</span>
        <span>/</span>
        <span class="text-royal-800 font-semibold">{{ __('messages.nav.constitution') }}</span>
    </nav>

    <!-- Hero Header -->
    <div class="bg-gradient-to-r from-royal-900 via-royal-800 to-royal-700 rounded-3xl p-8 sm:p-12 text-white relative overflow-hidden shadow-xl mb-12">
        <div class="absolute inset-0 hero-pattern opacity-20 pointer-events-none"></div>
        <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-gold-500/20 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 max-w-3xl space-y-4">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-gold-500 text-slate-950">
                <i data-lucide="book-marked" class="w-3.5 h-3.5"></i>
                Konstitusi Organisasi
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight">
                Anggaran Dasar & <br>
                <span class="text-gold-400">Anggaran Rumah Tangga (AD/ART)</span>
            </h1>
            <p class="text-sm sm:text-base text-blue-100/90 leading-relaxed">
                Pedoman tertinggi tata kelola kelembagaan, mekanisme permusyawaratan, hak & kewajiban OKP berhimpun, serta legalitas hukum DPP KNPI yang disahkan melalui Kongres Pemuda Nasional.
            </p>
        </div>
    </div>

    <!-- Legal Decree Banner Strip -->
    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs mb-10 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <i data-lucide="shield-check" class="w-6 h-6"></i>
            </div>
            <div>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">SK Pengesahan Kemenkumham RI</div>
                <div class="text-base font-extrabold text-slate-900 font-mono">AHU-0000192.AH.01.08.TAHUN 2022</div>
                <p class="text-xs text-slate-500">Legalitas sah perkumpulan berbadan hukum Dewan Pengurus Pusat KNPI</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <span class="px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                Status: Sah & Berlaku
            </span>
        </div>
    </div>

    <!-- Main Constitution Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Left: Chapter Breakdowns (8 cols) -->
        <div class="lg:col-span-8 space-y-6">
            <!-- Bab 1 -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-xs">
                <div class="flex items-center gap-2.5 text-royal-800 font-bold text-xs uppercase tracking-wider mb-2">
                    <i data-lucide="bookmark" class="w-4 h-4 text-gold-500"></i>
                    Bab I — Nama, Status, Waktu & Kedudukan
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2">Kedudukan DPP KNPI</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Organisasi ini bernama <strong>Komite Nasional Pemuda Indonesia</strong> (disingkat KNPI). Didirikan pada tanggal 23 Juli 1973 di Jakarta untuk jangka waktu yang tidak ditentukan. Dewan Pengurus Pusat (DPP) berkedudukan di Ibukota Negara Republik Indonesia di Gedung Graha Pemuda DPP KNPI, Jl. HR Rasuna Said, Jakarta Selatan.
                </p>
            </div>

            <!-- Bab 2 -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-xs">
                <div class="flex items-center gap-2.5 text-royal-800 font-bold text-xs uppercase tracking-wider mb-2">
                    <i data-lucide="bookmark" class="w-4 h-4 text-gold-500"></i>
                    Bab II — Asas, Sifat & Fungsi
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2">Asas Pancasila & Wadah Berhimpun</h3>
                <p class="text-xs text-slate-600 leading-relaxed mb-3">
                    KNPI berasaskan <strong>Pancasila</strong> dan Undang-Undang Dasar Negara Republik Indonesia 1945. Bersifat terbuka, independen, mandiri, dan tidak berafiliasi secara struktural kepada kekuatan partai politik manapun.
                </p>
                <div class="p-3.5 bg-blue-50/60 rounded-xl text-xs text-royal-900 space-y-1">
                    <strong>Fungsi Pokok:</strong>
                    <ul class="list-disc list-inside text-slate-700 space-y-0.5 ml-1">
                        <li>Wadah perekat persatuan dan wadah berhimpun seluruh OKP tingkat nasional dan daerah.</li>
                        <li>Wahana kaderisasi kepemimpinan pemuda dalam kehidupan bermasyarakat, berbangsa, dan bernegara.</li>
                        <li>Saluran penyerap, perumus, dan penyalur aspirasi pemuda dalam penetapan kebijakan pembangunan.</li>
                    </ul>
                </div>
            </div>

            <!-- Bab 3 -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-xs">
                <div class="flex items-center gap-2.5 text-royal-800 font-bold text-xs uppercase tracking-wider mb-2">
                    <i data-lucide="bookmark" class="w-4 h-4 text-gold-500"></i>
                    Bab III — Keanggotaan & Kedaulatan OKP
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2">Klasifikasi Keanggotaan</h3>
                <p class="text-xs text-slate-600 leading-relaxed mb-3">
                    Anggota KNPI terdiri dari Organisasi Kemasyarakatan Pemuda (OKP) yang berhimpun dan memenuhi kriteria legalitas yang ditetapkan dalam Anggaran Rumah Tangga.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                    <div class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                        <strong class="text-slate-900 block mb-1">Anggota Penuh:</strong>
                        <span class="text-slate-600">OKP yang memiliki SK Kemenkumham, kepengurusan di minimal 50% provinsi, dan terverifikasi di portal KNPI.</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                        <strong class="text-slate-900 block mb-1">Anggota Peninjau:</strong>
                        <span class="text-slate-600">Organisasi kepemudaan rintisan atau komunitas profesi yang sedang dalam proses verifikasi administratif.</span>
                    </div>
                </div>
            </div>

            <!-- Bab 4 -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-xs">
                <div class="flex items-center gap-2.5 text-royal-800 font-bold text-xs uppercase tracking-wider mb-2">
                    <i data-lucide="bookmark" class="w-4 h-4 text-gold-500"></i>
                    Bab IV — Permusyawaratan & Kedaulatan
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2">Tingkatan Musyawarah</h3>
                <div class="space-y-2 text-xs text-slate-600">
                    <p><strong>1. Kongres Nasional Pemuda:</strong> Pemegang kedaulatan tertinggi organisasi yang diadakan 3 (tiga) tahun sekali untuk memilih Ketua Umum dan menetapkan AD/ART.</p>
                    <p><strong>2. Rapat Pimpinan Nasional (RAPIMNAS):</strong> Forum pengambilan keputusan strategis antar-Kongres yang dihadiri pimpinan OKP dan DPD I.</p>
                    <p><strong>3. Musyawarah Daerah (MUSDA):</strong> Permusyawaratan tingkat Provinsi (DPD I) dan Kabupaten/Kota (DPD II).</p>
                </div>
            </div>
        </div>

        <!-- Right: Official Documents Card & OKP Verification CTA (4 cols) -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Download Document Card -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-royal-800 flex items-center justify-center mb-4">
                    <i data-lucide="file-text" class="w-6 h-6"></i>
                </div>
                <h3 class="font-bold text-sm text-slate-900">Salinan Dokumen Konstitusi</h3>
                <p class="text-xs text-slate-500 mt-1 mb-4 leading-relaxed">
                    Unduh salinan resmi AD/ART hasil Kongres KNPI terbaru dalam format PDF legal untuk pedoman kepengurusan.
                </p>

                <div class="space-y-2 text-xs">
                    <a href="#" class="flex items-center justify-between p-3 rounded-xl bg-slate-50 hover:bg-blue-50 transition border border-slate-200 text-slate-700 hover:text-royal-800 font-semibold">
                        <span class="flex items-center gap-2">
                            <i data-lucide="download" class="w-4 h-4 text-royal-800"></i>
                            Buku Saku AD/ART KNPI (PDF)
                        </span>
                        <span class="text-[10px] text-slate-400 font-mono">2.4 MB</span>
                    </a>

                    <a href="#" class="flex items-center justify-between p-3 rounded-xl bg-slate-50 hover:bg-blue-50 transition border border-slate-200 text-slate-700 hover:text-royal-800 font-semibold">
                        <span class="flex items-center gap-2">
                            <i data-lucide="file-check" class="w-4 h-4 text-emerald-600"></i>
                            Salinan SK Kemenkumham 2022
                        </span>
                        <span class="text-[10px] text-slate-400 font-mono">1.1 MB</span>
                    </a>
                </div>
            </div>

            <!-- Verification OKP Box -->
            <div class="bg-royal-800 text-white rounded-2xl p-6 shadow-md relative overflow-hidden">
                <div class="absolute -right-12 -bottom-12 w-44 h-44 rounded-full bg-gold-500/15 pointer-events-none"></div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-gold-400">Direktori Resmi</span>
                <h4 class="font-bold text-base text-white mt-1 mb-2">Ingin Mendaftarkan OKP?</h4>
                <p class="text-xs text-blue-200 leading-relaxed mb-4">
                    Pastikan organisasi Anda terdaftar dan memiliki SK legalitas aktif yang terverifikasi di ekosistem digital KNPI.
                </p>
                <a href="{{ route('okp.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-xs font-bold text-slate-900 bg-gold-500 hover:bg-gold-400 transition">
                    Lihat Direktori OKP <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
