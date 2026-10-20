@extends('layouts.admin')

@section('content')
    <!-- Dashboard Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ __('messages.admin.dashboard') }}</h1>
            <p class="text-xs text-slate-500 mt-0.5">{{ __('messages.admin.desc') }}</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                {{ __('messages.admin.system_online') }}
            </span>
            <a href="{{ route('admin.okp.create') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-xs font-bold text-white bg-royal-800 hover:bg-royal-900 transition shadow-xs">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                {{ __('messages.admin.add_okp') }}
            </a>
        </div>
    </div>

    <!-- 1. Stat Cards Strip (Matches UI Mockup) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- Card 1: Total OKP Terverifikasi -->
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-2xs hover:border-slate-300 transition">
            <div class="flex items-center justify-between text-slate-400 mb-2">
                <span class="text-xs font-semibold text-slate-500">{{ __('messages.admin.stats.verified_okp') }}</span>
                <div class="w-7 h-7 rounded-md bg-blue-50 text-royal-800 flex items-center justify-center">
                    <i data-lucide="trending-up" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-3xl font-black text-slate-900 tracking-tight">
                {{ number_format($verifiedOkpCount) }}
            </div>
            <div class="mt-2 flex items-center text-[11px] text-emerald-600 font-medium">
                <i data-lucide="shield-check" class="w-3.5 h-3.5 mr-1"></i>
                {{ __('messages.admin.stats.verified_okp_sub') }}
            </div>
        </div>

        <!-- Card 2: OKP Menunggu Verifikasi -->
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-2xs hover:border-slate-300 transition">
            <div class="flex items-center justify-between text-slate-400 mb-2">
                <span class="text-xs font-semibold text-slate-500">{{ __('messages.admin.stats.pending_okp') }}</span>
                <div class="w-7 h-7 rounded-md bg-amber-50 text-amber-600 flex items-center justify-center">
                    <i data-lucide="clock" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-3xl font-black text-slate-900 tracking-tight text-amber-600">
                {{ number_format($pendingOkpCount) }}
            </div>
            <div class="mt-2 flex items-center text-[11px] text-slate-500 font-medium">
                <a href="{{ route('admin.okp.index', ['status' => 'pending']) }}" class="text-royal-800 hover:underline">
                    {{ __('messages.admin.stats.pending_okp_sub') }} &rarr;
                </a>
            </div>
        </div>

        <!-- Card 3: Total Aspiration -->
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-2xs hover:border-slate-300 transition">
            <div class="flex items-center justify-between text-slate-400 mb-2">
                <span class="text-xs font-semibold text-slate-500">{{ __('messages.admin.stats.total_aspirations') }}</span>
                <div class="w-7 h-7 rounded-md bg-blue-50 text-royal-800 flex items-center justify-center">
                    <i data-lucide="ticket" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-3xl font-black text-slate-900 tracking-tight">
                {{ number_format($totalAspirationCount) }}
            </div>
            <div class="mt-2 flex items-center text-[11px] text-slate-500 font-medium">
                <span class="text-amber-600 font-bold mr-1">{{ $pendingAspirationCount }}</span> {{ __('messages.admin.stats.pending_aspirations_sub') }}
            </div>
        </div>

        <!-- Card 4: Berita Publikasi -->
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-2xs hover:border-slate-300 transition">
            <div class="flex items-center justify-between text-slate-400 mb-2">
                <span class="text-xs font-semibold text-slate-500">{{ __('messages.admin.stats.total_news') }}</span>
                <div class="w-7 h-7 rounded-md bg-slate-50 text-slate-600 flex items-center justify-center">
                    <i data-lucide="newspaper" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-3xl font-black text-slate-900 tracking-tight">
                {{ number_format($totalNewsCount) }}
            </div>
            <div class="mt-2 flex items-center text-[11px] text-slate-500 font-medium">
                <span>{{ $upcomingEventsCount }} {{ __('messages.admin.stats.active_agendas_sub') }}</span>
            </div>
        </div>

    </div>

    <!-- 2. Recent OKP Verification (Table Matching UI Mockup) -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h2 class="font-bold text-sm text-slate-900">{{ __('messages.admin.recent_okp') }}</h2>
                <p class="text-[11px] text-slate-400">{{ __('messages.admin.recent_okp_sub') }}</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.okp.index') }}" class="px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition">
                    Kelola Semua OKP
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-3 w-10">
                            <input type="checkbox" class="rounded border-slate-300 text-royal-800">
                        </th>
                        <th class="px-6 py-3">Nama Organisasi (OKP)</th>
                        <th class="px-6 py-3">Ketua Umum</th>
                        <th class="px-6 py-3">Nomor SK Legalitas</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentOrganizations as $org)
                        <tr class="hover:bg-slate-50/80 transition" x-data="{ verifyModal: false }">
                            <td class="px-6 py-3.5">
                                <input type="checkbox" class="rounded border-slate-300 text-royal-800">
                            </td>
                            <td class="px-6 py-3.5">
                                <div class="font-bold text-slate-900">{{ $org->name }}</div>
                                <div class="text-[11px] text-slate-400">{{ $org->email }}</div>
                            </td>
                            <td class="px-6 py-3.5 font-medium text-slate-700">
                                {{ $org->leader_name }}
                            </td>
                            <td class="px-6 py-3.5 font-mono text-[11px] text-slate-500">
                                {{ $org->sk_number }}
                            </td>
                            <td class="px-6 py-3.5">
                                @if($org->status === 'verified')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Terverifikasi
                                    </span>
                                @elseif($org->status === 'pending')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        Menunggu
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-50 text-red-700 border border-red-200">
                                        Kedaluwarsa
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-3.5 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button @click="verifyModal = true" class="px-2.5 py-1 rounded text-xs font-bold text-royal-800 bg-blue-50 hover:bg-royal-800 hover:text-white transition">
                                        Verifikasi
                                    </button>
                                </div>

                                <!-- Modal Verifikasi OKP -->
                                <div x-show="verifyModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto text-left" aria-modal="true">
                                    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 sm:p-0">
                                        <div @click="verifyModal = false" class="fixed inset-0 bg-slate-900/50 backdrop-blur-2xs"></div>
                                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                                        <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full border border-slate-200">
                                            <div class="p-5 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                                                <div>
                                                    <h3 class="font-bold text-sm text-slate-900">Verifikasi Status OKP</h3>
                                                    <p class="text-xs text-slate-500">{{ $org->name }}</p>
                                                </div>
                                                <button @click="verifyModal = false" class="text-slate-400 hover:text-slate-600">
                                                    <i data-lucide="x" class="w-4 h-4"></i>
                                                </button>
                                            </div>

                                            <form method="POST" action="{{ route('admin.okp.verify', $org->id) }}" enctype="multipart/form-data" class="p-5 space-y-4 text-xs">
                                                @csrf
                                                @method('PATCH')

                                                <div>
                                                    <label class="block font-bold text-slate-700 mb-1">Status Verifikasi</label>
                                                    <select name="status" class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg">
                                                        <option value="verified" {{ $org->status === 'verified' ? 'selected' : '' }}>Verified (Terverifikasi Aktif)</option>
                                                        <option value="pending" {{ $org->status === 'pending' ? 'selected' : '' }}>Pending (Menunggu Kelengkapan)</option>
                                                        <option value="expired" {{ $org->status === 'expired' ? 'selected' : '' }}>Expired (Kedaluwarsa)</option>
                                                    </select>
                                                </div>

                                                <div>
                                                    <label class="block font-bold text-slate-700 mb-1">Nomor SK Legalitas</label>
                                                    <input type="text" name="sk_number" value="{{ $org->sk_number }}" class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg">
                                                </div>

                                                <div>
                                                    <label class="block font-bold text-slate-700 mb-1">Upload Berkas SK (PDF, Maks 10MB)</label>
                                                    <input type="file" name="sk_file" accept=".pdf" class="w-full text-xs">
                                                </div>

                                                <div class="pt-2 flex justify-end gap-2">
                                                    <button @click="verifyModal = false" type="button" class="px-4 py-2 rounded-lg font-semibold text-slate-600 hover:bg-slate-100">Batal</button>
                                                    <button type="submit" class="px-4 py-2 rounded-lg font-bold text-white bg-royal-800 hover:bg-royal-900">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-400">Belum ada data OKP yang terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- 3. Active Youth Aspiration Ticket (Matches UI Mockup) -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h2 class="font-bold text-sm text-slate-900">{{ __('messages.admin.active_tickets') }}</h2>
                <p class="text-[11px] text-slate-400">{{ __('messages.admin.active_tickets_sub') }}</p>
            </div>
            <a href="{{ route('admin.aspirasi.index') }}" class="px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition">
                {{ __('messages.admin.open_ticket_manager') }}
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-3 w-10">
                            <input type="checkbox" class="rounded border-slate-300 text-royal-800">
                        </th>
                        <th class="px-6 py-3">Kode Tiket</th>
                        <th class="px-6 py-3">Pengirim</th>
                        <th class="px-6 py-3">Kategori & Perihal</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-right">Tindak Lanjut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($activeAspirations as $ticket)
                        <tr class="hover:bg-slate-50/80 transition" x-data="{ ticketModal: false }">
                            <td class="px-6 py-3.5">
                                <input type="checkbox" class="rounded border-slate-300 text-royal-800">
                            </td>
                            <td class="px-6 py-3.5 font-mono font-bold text-royal-800">
                                {{ $ticket->ticket_code }}
                            </td>
                            <td class="px-6 py-3.5">
                                <div class="font-bold text-slate-900">{{ $ticket->sender_name }}</div>
                                <div class="text-[11px] text-slate-400">{{ $ticket->sender_email }}</div>
                            </td>
                            <td class="px-6 py-3.5 max-w-xs">
                                <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-slate-100 text-slate-700 mr-1">
                                    {{ $ticket->category }}
                                </span>
                                <span class="font-medium text-slate-800">{{ $ticket->subject }}</span>
                            </td>
                            <td class="px-6 py-3.5">
                                @if($ticket->status === 'submitted')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        Terkirim
                                    </span>
                                @elseif($ticket->status === 'in_review')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                        Diproses
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Selesai
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-3.5 text-right">
                                <button @click="ticketModal = true" class="px-2.5 py-1 rounded text-xs font-bold text-royal-800 bg-blue-50 hover:bg-royal-800 hover:text-white transition">
                                    Respon Tiket
                                </button>

                                <!-- Modal Respon Tiket -->
                                <div x-show="ticketModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto text-left" aria-modal="true">
                                    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 sm:p-0">
                                        <div @click="ticketModal = false" class="fixed inset-0 bg-slate-900/50 backdrop-blur-2xs"></div>
                                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                                        <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200">
                                            <div class="p-5 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                                                <div>
                                                    <span class="font-mono font-bold text-royal-800 text-xs">Tiket [{{ $ticket->ticket_code }}]</span>
                                                    <h3 class="font-bold text-sm text-slate-900">{{ $ticket->subject }}</h3>
                                                </div>
                                                <button @click="ticketModal = false" class="text-slate-400 hover:text-slate-600">
                                                    <i data-lucide="x" class="w-4 h-4"></i>
                                                </button>
                                            </div>

                                            <div class="p-5 space-y-3 text-xs bg-slate-50/50 border-b border-slate-100">
                                                <div>
                                                    <span class="text-slate-400">Pengirim:</span>
                                                    <strong class="text-slate-800">{{ $ticket->sender_name }}</strong> ({{ $ticket->sender_email }})
                                                </div>
                                                <div>
                                                    <span class="text-slate-400">Isi Pesan:</span>
                                                    <p class="text-slate-700 mt-1 p-2.5 rounded bg-white border border-slate-200 whitespace-pre-line">{{ $ticket->message }}</p>
                                                </div>
                                            </div>

                                            <form method="POST" action="{{ route('admin.aspirasi.update', $ticket->id) }}" class="p-5 space-y-4 text-xs">
                                                @csrf
                                                @method('PATCH')

                                                <div>
                                                    <label class="block font-bold text-slate-700 mb-1">Status Tindak Lanjut</label>
                                                    <select name="status" class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg">
                                                        <option value="submitted" {{ $ticket->status === 'submitted' ? 'selected' : '' }}>Terkirim (Menunggu Verifikasi Tim)</option>
                                                        <option value="in_review" {{ $ticket->status === 'in_review' ? 'selected' : '' }}>Sedang Diproses (Diteruskan ke Departemen Terkait)</option>
                                                        <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Selesai Ditindaklanjuti (Resolved)</option>
                                                    </select>
                                                </div>

                                                <div>
                                                    <label class="block font-bold text-slate-700 mb-1">Catatan Resmi Admin (Dapat dilihat oleh publik saat melacak)</label>
                                                    <textarea name="admin_notes" rows="3" class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg" placeholder="Tuliskan keterangan disposisi atau jawaban resmi...">{{ $ticket->admin_notes }}</textarea>
                                                </div>

                                                <div class="pt-2 flex justify-end gap-2">
                                                    <button @click="ticketModal = false" type="button" class="px-4 py-2 rounded-lg font-semibold text-slate-600 hover:bg-slate-100">Tutup</button>
                                                    <button type="submit" class="px-4 py-2 rounded-lg font-bold text-white bg-royal-800 hover:bg-royal-900">Simpan Tanggapan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-400">Belum ada tiket aspirasi aktif.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
