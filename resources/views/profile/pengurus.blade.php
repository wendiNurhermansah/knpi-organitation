@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-royal-800">{{ __('messages.nav.home') }}</a>
        <span>/</span>
        <span class="text-slate-500">{{ __('messages.nav.profile') }}</span>
        <span>/</span>
        <span class="text-royal-800 font-semibold">{{ __('messages.nav.management') }}</span>
    </nav>

    <!-- Hero Header -->
    <div class="bg-gradient-to-r from-royal-900 via-royal-800 to-royal-700 rounded-3xl p-8 sm:p-12 text-white relative overflow-hidden shadow-xl mb-12">
        <div class="absolute inset-0 hero-pattern opacity-20 pointer-events-none"></div>
        <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-gold-500/20 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 max-w-3xl space-y-4">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-gold-500 text-slate-950">
                <i data-lucide="users" class="w-3.5 h-3.5"></i>
                Struktur Kelembagaan
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight">
                Dewan Pengurus Pusat <br>
                <span class="text-gold-400">Komite Nasional Pemuda Indonesia</span>
            </h1>
            <p class="text-sm sm:text-base text-blue-100/90 leading-relaxed">
                Jajaran pimpinan nasional yang mengemban amanah Kongres Pemuda Indonesia dalam mengonsolidasikan seluruh kekuatan pemuda lintas OKP untuk kemajuan bangsa.
            </p>
        </div>
    </div>

    <!-- Section 1: Pimpinan Inti (Presidium / Trias Pengurus) -->
    <div class="mb-14">
        <div class="text-center max-w-2xl mx-auto mb-8">
            <span class="text-xs font-bold uppercase tracking-wider text-royal-800">Pimpinan Harian Inti</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mt-1">
                Pimpinan Dewan Pengurus Pusat
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Mandataris Kongres Pemuda Indonesia Periode Kepengurusan Aktif
            </p>
        </div>

        @php
            $topOfficials = $officials->whereIn('sort_order', [1, 2, 3]);
            $fieldOfficials = $officials->where('sort_order', '>', 3);
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            @foreach($topOfficials as $top)
                <div class="bg-white rounded-2xl p-6 border {{ $top->sort_order === 1 ? 'border-royal-800 shadow-lg ring-2 ring-blue-100' : 'border-slate-200 shadow-xs' }} hover:shadow-md transition text-center relative overflow-hidden flex flex-col justify-between">
                    @if($top->sort_order === 1)
                        <div class="absolute top-0 right-0 left-0 h-1.5 bg-gradient-to-r from-gold-500 via-royal-700 to-gold-500"></div>
                        <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-gold-100 text-gold-800 border border-gold-200 mx-auto mb-3">
                            Ketua Umum
                        </span>
                    @endif

                    <div>
                        <!-- Avatar / Portrait Badge -->
                        <div class="w-24 h-24 rounded-full bg-gradient-to-tr {{ $top->sort_order === 1 ? 'from-royal-900 to-royal-700' : 'from-slate-800 to-slate-700' }} text-white flex items-center justify-center font-black text-2xl mx-auto mb-4 shadow-md ring-4 ring-slate-100">
                            {{ strtoupper(substr($top->name, 0, 2)) }}
                        </div>

                        <h3 class="text-lg font-extrabold text-slate-900 leading-snug">
                            {{ $top->name }}
                        </h3>
                        <p class="text-xs font-bold text-royal-800 mt-1">
                            {{ $top->position }}
                        </p>
                    </div>

                    <div class="mt-4 pt-3 border-t border-slate-100 text-[11px] text-slate-500">
                        {{ $top->department }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Section 2: Ketua-Ketua Bidang & Departemen -->
    <div class="mb-14">
        <div class="flex items-center justify-between pb-4 border-b border-slate-200 mb-6">
            <div>
                <h3 class="text-xl font-extrabold text-slate-900">Ketua Bidang & Kompartemen</h3>
                <p class="text-xs text-slate-500">Pengemban program kerja strategis kepemudaan nasional</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-royal-800">
                {{ $fieldOfficials->count() }} Bidang Strategis
            </span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($fieldOfficials as $field)
                <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-2xs hover:border-royal-800 hover:shadow-sm transition flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 border border-blue-100 text-royal-800 flex items-center justify-center font-bold text-sm shrink-0">
                        {{ strtoupper(substr($field->name, 0, 2)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-700 mb-1">
                            Bidang Ke-{{ $field->sort_order - 3 }}
                        </span>
                        <h4 class="text-sm font-bold text-slate-900 leading-snug truncate" title="{{ $field->name }}">
                            {{ $field->name }}
                        </h4>
                        <p class="text-xs font-semibold text-royal-800 mt-0.5">
                            {{ $field->position }}
                        </p>
                        <p class="text-[11px] text-slate-400 mt-1 truncate">
                            {{ $field->department }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Section 3: Sekretariat DPP Contact Card -->
    <div class="bg-slate-900 text-white rounded-3xl p-8 sm:p-10 shadow-xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="space-y-2 max-w-xl">
            <span class="text-xs font-bold uppercase tracking-wider text-gold-400">Sekretariat Jenderal</span>
            <h3 class="text-xl sm:text-2xl font-extrabold text-white">Gedung Graha Pemuda DPP KNPI</h3>
            <p class="text-xs text-slate-400 leading-relaxed">
                Pusat administrasi, koordinasi OKP nasional, dan pelayanan e-Aspirasi pemuda berkedudukan di Jl. HR Rasuna Said Kav. C-22, Kuningan, Karet Kuningan, Setiabudi, Jakarta Selatan 12920.
            </p>
        </div>

        <div class="flex items-center gap-3 shrink-0">
            <a href="mailto:sekretariat@knpi.or.id" class="px-5 py-3 rounded-xl text-xs font-bold text-slate-950 bg-gold-500 hover:bg-gold-400 transition flex items-center gap-2">
                <i data-lucide="mail" class="w-4 h-4"></i>
                Hubungi Sekretariat
            </a>
            <a href="{{ route('home') }}#aspirasi" class="px-5 py-3 rounded-xl text-xs font-semibold text-white bg-royal-800 hover:bg-royal-700 border border-blue-400/30 transition">
                Kirim Aspirasi
            </a>
        </div>
    </div>
</div>
@endsection
