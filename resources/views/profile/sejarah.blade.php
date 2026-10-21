@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-royal-800">{{ __('messages.nav.home') }}</a>
        <span>/</span>
        <span class="text-slate-500">{{ __('messages.nav.profile') }}</span>
        <span>/</span>
        <span class="text-royal-800 font-semibold">{{ __('messages.nav.history') }}</span>
    </nav>

    <!-- Hero Header -->
    <div class="bg-gradient-to-r from-royal-900 via-royal-800 to-royal-700 rounded-3xl p-8 sm:p-12 text-white relative overflow-hidden shadow-xl mb-12">
        <div class="absolute inset-0 hero-pattern opacity-20 pointer-events-none"></div>
        <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-gold-500/20 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 max-w-3xl space-y-4">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-gold-500 text-slate-950">
                <i data-lucide="landmark" class="w-3.5 h-3.5"></i>
                Sejarah Kepemudaan Nasional
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight">
                Kilas Balik Sejarah <br>
                <span class="text-gold-400">Komite Nasional Pemuda Indonesia</span>
            </h1>
            <p class="text-sm sm:text-base text-blue-100/90 leading-relaxed">
                Lahir dari tekad luhur Deklarasi Pemuda 23 Juli 1973, KNPI hadir sebagai wadah berhimpun seluruh Organisasi Kemasyarakatan Pemuda (OKP) demi persatuan kebangsaan dan kedaulatan Ibu Pertiwi.
            </p>
        </div>
    </div>

    <!-- Main Historical Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Left: Timeline Narrative (8 cols) -->
        <div class="lg:col-span-8 space-y-8">
            <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/90 shadow-xs space-y-6">
                <h2 class="text-xl sm:text-2xl font-bold text-slate-900 flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-lg bg-royal-50 text-royal-800 flex items-center justify-center font-bold text-sm">1</span>
                    Latar Belakang Kelahiran KNPI (1973)
                </h2>
                <div class="prose prose-slate text-sm text-slate-700 leading-relaxed space-y-4">
                    <p>
                        Komite Nasional Pemuda Indonesia (KNPI) didirikan pada tanggal <strong>23 Juli 1973</strong> melalui deklarasi bersama para eksponen pemuda, mahasiswa, dan pimpinan Organisasi Kemasyarakatan Pemuda (OKP) dari berbagai latar belakang ideologi, agama, kesukuan, dan profesi.
                    </p>
                    <p>
                        Deklarasi Pemuda 1973 diprakarsai oleh tokoh-tokoh pemuda nasional terkemuka seperti David Napitupulu, Akbar Tandjung, Abdul Gafur, serta perwakilan ormas pemuda legendaris (HMI, PMII, GMNI, GMKI, PMKRI, Pemuda Muhammadiyah, GP Ansor, AMPI, Pemuda Pancasila, dan elemen lainnya). Mereka bersepakat meleburkan sekat-sekat primordial demi membangun satu wadah komunikasi dan konsolidasi pemuda berskala nasional.
                    </p>
                </div>

                <div class="p-4 rounded-xl bg-slate-50 border-l-4 border-gold-500 text-xs italic text-slate-700">
                    "Kami Pemuda Indonesia, sadar akan panggilan sejarah dan tanggung jawab kami terhadap masa depan bangsa dan negara, dengan ini berikrar menghimpun diri dalam Komite Nasional Pemuda Indonesia..."
                    <div class="font-bold not-italic text-slate-900 mt-2">— Cuplikan Piagam Deklarasi Pemuda, 23 Juli 1973</div>
                </div>
            </div>

            <!-- Milestone Timeline Strip -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/90 shadow-xs">
                <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2.5">
                    <i data-lucide="clock" class="w-5 h-5 text-gold-500"></i>
                    Tonggak Perjalanan Gerakan Pemuda
                </h2>

                <div class="relative border-l-2 border-royal-200 ml-4 space-y-8 pl-6">
                    <!-- Milestone 1 -->
                    <div class="relative group">
                        <span class="absolute -left-[33px] top-1 w-4 h-4 rounded-full bg-royal-800 ring-4 ring-blue-100 group-hover:scale-125 transition-transform"></span>
                        <div class="text-xs font-bold text-royal-800 uppercase tracking-wider">28 Oktober 1928</div>
                        <h3 class="text-base font-bold text-slate-900 mt-0.5">Sumpah Pemuda: Fondasi Persatuan</h3>
                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                            Momen kebangkitan jati diri pemuda nusantara yang mengikrarkan satu tanah air, satu bangsa, dan satu bahasa persatuan: Indonesia.
                        </p>
                    </div>

                    <!-- Milestone 2 -->
                    <div class="relative group">
                        <span class="absolute -left-[33px] top-1 w-4 h-4 rounded-full bg-gold-500 ring-4 ring-amber-100 group-hover:scale-125 transition-transform"></span>
                        <div class="text-xs font-bold text-gold-600 uppercase tracking-wider">23 Juli 1973</div>
                        <h3 class="text-base font-bold text-slate-900 mt-0.5">Deklarasi Pemuda: Kelahiran KNPI</h3>
                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                            Penyatuan seluruh federasi dan organisasi pemuda dalam wadah berhimpun resmi KNPI, melahirkan kepemimpinan pemuda yang terorganisir di tingkat nasional.
                        </p>
                    </div>

                    <!-- Milestone 3 -->
                    <div class="relative group">
                        <span class="absolute -left-[33px] top-1 w-4 h-4 rounded-full bg-royal-800 ring-4 ring-blue-100 group-hover:scale-125 transition-transform"></span>
                        <div class="text-xs font-bold text-royal-800 uppercase tracking-wider">1998 - 2000</div>
                        <h3 class="text-base font-bold text-slate-900 mt-0.5">Pelopor Gerakan Reformasi Demokratis</h3>
                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                            Generasi muda dan aktivis KNPI berada di garis depan mendorong transisi demokrasi, kebebasan berserikat, dan penguatan transparansi pemerintahan sipil.
                        </p>
                    </div>

                    <!-- Milestone 4 -->
                    <div class="relative group">
                        <span class="absolute -left-[33px] top-1 w-4 h-4 rounded-full bg-emerald-500 ring-4 ring-emerald-100 group-hover:scale-125 transition-transform"></span>
                        <div class="text-xs font-bold text-emerald-600 uppercase tracking-wider">2026 - 2045</div>
                        <h3 class="text-base font-bold text-slate-900 mt-0.5">Ekosistem Digital Menuju Indonesia Emas</h3>
                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                            Transformasi KNPI Digital Ecosystem sebagai platform satu pintu verifikasi OKP, e-Aspirasi, inkubasi wirausaha teknologi, dan kaderisasi kepemimpinan global.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Meaning of Logo & Quick Links (4 cols) -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Logo Philosophy Card -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-xs text-center">
                <img src="{{ asset('images/knpi-logo.png') }}" alt="Logo Resmi KNPI" class="w-24 h-24 object-contain mx-auto mb-4 drop-shadow-md">
                <h3 class="font-bold text-base text-slate-900">Makna Lambang KNPI</h3>
                <p class="text-xs text-slate-500 mt-1">Simbol keteguhan tekad pemuda Indonesia</p>

                <div class="mt-5 space-y-3 text-left text-xs text-slate-600">
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 flex items-start gap-2.5">
                        <i data-lucide="flame" class="w-4 h-4 text-gold-500 shrink-0 mt-0.5"></i>
                        <div>
                            <strong class="text-slate-900">Obor Bernyala:</strong>
                            <p class="text-[11px] text-slate-500 mt-0.5">Semangat perjuangan pemuda yang tak kunjung padam menerangi peradaban bangsa.</p>
                        </div>
                    </div>

                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 flex items-start gap-2.5">
                        <i data-lucide="shield" class="w-4 h-4 text-royal-800 shrink-0 mt-0.5"></i>
                        <div>
                            <strong class="text-slate-900">Perisai Segi Lima:</strong>
                            <p class="text-[11px] text-slate-500 mt-0.5">Kesetiaan mutlak terhadap Pancasila sebagai ideologi dan falsafah hidup berbangsa.</p>
                        </div>
                    </div>

                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 flex items-start gap-2.5">
                        <i data-lucide="flag" class="w-4 h-4 text-red-500 shrink-0 mt-0.5"></i>
                        <div>
                            <strong class="text-slate-900">Pita Merah Putih:</strong>
                            <p class="text-[11px] text-slate-500 mt-0.5">Kedaulatan dan kecintaan tak terpisahkan terhadap Negara Kesatuan Republik Indonesia.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Nav Widget -->
            <div class="bg-royal-900 text-white rounded-2xl p-6 shadow-md relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-40 h-40 rounded-full bg-gold-500/15 pointer-events-none"></div>
                <h4 class="font-bold text-sm text-gold-400 uppercase tracking-wider mb-3">Jelajahi Profil Lainnya</h4>
                <ul class="space-y-2 text-xs">
                    <li>
                        <a href="{{ route('profil.visi-misi') }}" class="flex items-center justify-between p-2.5 rounded-lg bg-royal-800/80 hover:bg-royal-700 transition">
                            <span>Visi & Misi Strategis</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profil.ad-art') }}" class="flex items-center justify-between p-2.5 rounded-lg bg-royal-800/80 hover:bg-royal-700 transition">
                            <span>AD / ART & Konstitusi</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profil.pengurus') }}" class="flex items-center justify-between p-2.5 rounded-lg bg-royal-800/80 hover:bg-royal-700 transition">
                            <span>Dewan Pengurus Pusat</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
