@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="text-center max-w-2xl mx-auto mb-10">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-royal-50 text-royal-800 border border-royal-200">
            <i data-lucide="ticket" class="w-3.5 h-3.5"></i>
            Pelacakan Tiket Transparan
        </span>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight mt-3">
            Lacak Status Aspirasi Pemuda
        </h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-2">
            Masukkan kode tiket aspirasi resmi (contoh: <strong class="font-mono text-royal-800">KNPI-202610-XXXX</strong>) untuk memantau disposisi dan tindak lanjut pengurus.
        </p>

        <!-- Search Box -->
        <form method="GET" action="{{ route('aspirasi.track') }}" class="mt-6 flex flex-col sm:flex-row gap-2 max-w-lg mx-auto">
            <input type="text" name="ticket_code" value="{{ $ticketCode }}" placeholder="Masukkan Kode Tiket..." required class="flex-1 text-sm px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:border-royal-800 focus:ring-1 focus:ring-royal-800 font-mono uppercase shadow-xs">
            <button type="submit" class="px-6 py-3 rounded-xl font-bold text-xs uppercase tracking-wider text-slate-950 bg-gold-500 hover:bg-gold-400 active:scale-95 transition shadow-sm">
                Lacak Status
            </button>
        </form>
    </div>

    <!-- Result Box -->
    @if($searched)
        @if($aspiration)
            <div class="bg-white rounded-2xl border border-slate-200 shadow-md overflow-hidden">
                <!-- Status Header Banner -->
                <div class="p-6 sm:p-8 bg-slate-900 text-white flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <span class="text-xs uppercase font-bold text-gold-400 tracking-wider">Nomor Tiket Terdaftar</span>
                        <div class="text-2xl font-black font-mono tracking-tight mt-0.5">{{ $aspiration->ticket_code }}</div>
                    </div>

                    <div>
                        @if($aspiration->status === 'submitted')
                            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-amber-500/20 text-amber-300 border border-amber-400/30">
                                <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                                Status: Terkirim (Menunggu Disposisi)
                            </span>
                        @elseif($aspiration->status === 'in_review')
                            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-blue-500/20 text-blue-300 border border-blue-400/30">
                                <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                                Status: Sedang Diproses (In Review)
                            </span>
                        @else
                            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-400/30">
                                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400"></i>
                                Status: Selesai Ditindaklanjuti
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Progress Steps -->
                <div class="p-6 sm:p-8 border-b border-slate-100 bg-slate-50/50">
                    <div class="grid grid-cols-3 gap-2 text-center text-xs">
                        <!-- Step 1 -->
                        <div class="space-y-1">
                            <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center font-bold text-xs bg-royal-800 text-white">
                                1
                            </div>
                            <div class="font-bold text-slate-800">Terkirim</div>
                            <div class="text-[10px] text-slate-400">{{ $aspiration->created_at->format('d/m/Y H:i') }}</div>
                        </div>

                        <!-- Step 2 -->
                        <div class="space-y-1">
                            <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center font-bold text-xs {{ in_array($aspiration->status, ['in_review', 'resolved']) ? 'bg-royal-800 text-white' : 'bg-slate-200 text-slate-500' }}">
                                2
                            </div>
                            <div class="font-bold {{ in_array($aspiration->status, ['in_review', 'resolved']) ? 'text-slate-800' : 'text-slate-400' }}">Disposisi & Telaah</div>
                            <div class="text-[10px] text-slate-400">{{ $aspiration->status !== 'submitted' ? 'Dalam Proses' : 'Antrean' }}</div>
                        </div>

                        <!-- Step 3 -->
                        <div class="space-y-1">
                            <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center font-bold text-xs {{ $aspiration->status === 'resolved' ? 'bg-emerald-600 text-white' : 'bg-slate-200 text-slate-500' }}">
                                3
                            </div>
                            <div class="font-bold {{ $aspiration->status === 'resolved' ? 'text-emerald-700' : 'text-slate-400' }}">Selesai</div>
                            <div class="text-[10px] text-slate-400">{{ $aspiration->status === 'resolved' ? 'Tuntas' : '-' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Detail Body -->
                <div class="p-6 sm:p-8 space-y-6">
                    <!-- Official Admin Response Box -->
                    @if(!empty($aspiration->admin_notes))
                        <div class="p-5 rounded-xl bg-blue-50/70 border border-blue-200 space-y-2">
                            <div class="flex items-center gap-2 text-royal-800 font-bold text-xs uppercase tracking-wide">
                                <i data-lucide="shield" class="w-4 h-4"></i>
                                Tanggapan Resmi DPP KNPI:
                            </div>
                            <p class="text-xs text-slate-700 leading-relaxed whitespace-pre-line font-medium">
                                {{ $aspiration->admin_notes }}
                            </p>
                            @if($aspiration->handler)
                                <div class="text-[10px] text-slate-500 pt-1">
                                    Ditangani oleh: <strong>{{ $aspiration->handler->name }}</strong>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-500 italic">
                            Aspirasi Anda sedang dalam antrean verifikasi dan telaah tim terkait DPP KNPI. Jawaban resmi akan tampil di sini setelah ditindaklanjuti.
                        </div>
                    @endif

                    <!-- Submitted Data -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs pt-2">
                        <div>
                            <span class="text-slate-400 block mb-0.5">Pengirim:</span>
                            <span class="font-semibold text-slate-800">{{ $aspiration->sender_name }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block mb-0.5">Email Pengirim:</span>
                            <span class="font-semibold text-slate-800">{{ $aspiration->sender_email }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block mb-0.5">Kategori:</span>
                            <span class="inline-block px-2 py-0.5 rounded text-[11px] font-bold bg-slate-100 text-slate-700">{{ $aspiration->category }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block mb-0.5">Waktu Pengiriman:</span>
                            <span class="font-semibold text-slate-800">{{ $aspiration->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100">
                        <span class="text-xs text-slate-400 block mb-1">Perihal / Subjek:</span>
                        <h3 class="font-bold text-sm text-slate-900">{{ $aspiration->subject }}</h3>
                        <p class="text-xs text-slate-700 leading-relaxed whitespace-pre-line mt-2 p-4 bg-slate-50 rounded-xl border border-slate-100">
                            {{ $aspiration->message }}
                        </p>
                    </div>

                    @if($aspiration->attachment)
                        <div class="pt-2">
                            <span class="text-xs text-slate-400 block mb-1">Lampiran Berkas:</span>
                            <a href="{{ asset('storage/' . $aspiration->attachment) }}" target="_blank" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-semibold text-royal-800 hover:bg-slate-50 transition">
                                <i data-lucide="paperclip" class="w-3.5 h-3.5"></i>
                                Buka Dokumen Lampiran
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="bg-white rounded-2xl border border-red-200 p-8 text-center shadow-xs">
                <div class="w-12 h-12 mx-auto rounded-full bg-red-50 text-red-600 flex items-center justify-center mb-3">
                    <i data-lucide="alert-circle" class="w-6 h-6"></i>
                </div>
                <h3 class="font-bold text-base text-slate-900">Kode Tiket Tidak Ditemukan</h3>
                <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">
                    Kode tiket "<strong class="font-mono text-slate-800">{{ $ticketCode }}</strong>" tidak cocok dengan data apapun di sistem. Harap periksa kembali format kode tiket Anda.
                </p>
            </div>
        @endif
    @endif
</div>
@endsection
