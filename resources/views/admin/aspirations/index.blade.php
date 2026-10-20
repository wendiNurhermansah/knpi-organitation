@extends('layouts.admin')

@section('content')
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Pengelolaan e-Aspirasi Pemuda</h1>
            <p class="text-xs text-slate-500 mt-0.5">Kelola tiket aspirasi, tindak lanjut disposisi, dan publikasikan jawaban resmi DPP KNPI.</p>
        </div>
    </div>

    <!-- Stats & Filters -->
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs">
            <span class="text-[11px] text-slate-400 font-bold uppercase">Semua Tiket</span>
            <div class="text-2xl font-black text-slate-900">{{ $stats['total'] }}</div>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs">
            <span class="text-[11px] text-amber-600 font-bold uppercase">Menunggu Disposisi</span>
            <div class="text-2xl font-black text-amber-600">{{ $stats['submitted'] }}</div>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs">
            <span class="text-[11px] text-blue-600 font-bold uppercase">Sedang Diproses</span>
            <div class="text-2xl font-black text-blue-600">{{ $stats['in_review'] }}</div>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs">
            <span class="text-[11px] text-emerald-600 font-bold uppercase">Selesai Tuntas</span>
            <div class="text-2xl font-black text-emerald-600">{{ $stats['resolved'] }}</div>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-2xs flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto">
            <a href="{{ route('admin.aspirasi.index', ['q' => $search]) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ empty($currentStatus) ? 'bg-royal-800 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Semua Status
            </a>
            <a href="{{ route('admin.aspirasi.index', ['status' => 'submitted', 'q' => $search]) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ $currentStatus === 'submitted' ? 'bg-amber-600 text-white' : 'bg-amber-50 text-amber-700 hover:bg-amber-100' }}">
                Terkirim
            </a>
            <a href="{{ route('admin.aspirasi.index', ['status' => 'in_review', 'q' => $search]) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ $currentStatus === 'in_review' ? 'bg-blue-600 text-white' : 'bg-blue-50 text-blue-700 hover:bg-blue-100' }}">
                Diproses
            </a>
            <a href="{{ route('admin.aspirasi.index', ['status' => 'resolved', 'q' => $search]) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ $currentStatus === 'resolved' ? 'bg-emerald-600 text-white' : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }}">
                Selesai
            </a>
        </div>

        <form method="GET" action="{{ route('admin.aspirasi.index') }}" class="flex items-center gap-2 w-full md:w-80">
            @if($currentStatus)
                <input type="hidden" name="status" value="{{ $currentStatus }}">
            @endif
            <input type="text" name="q" value="{{ $search }}" placeholder="Cari tiket / nama pengirim..." class="w-full text-xs px-3 py-1.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">
            <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-bold text-white bg-slate-800 hover:bg-slate-900 shrink-0">
                Cari
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-3">Kode Tiket</th>
                        <th class="px-6 py-3">Pengirim</th>
                        <th class="px-6 py-3">Kategori & Isu</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Respon Admin</th>
                        <th class="px-6 py-3 text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($aspirations as $aspiration)
                        <tr class="hover:bg-slate-50/80 transition" x-data="{ modalOpen: false }">
                            <td class="px-6 py-3.5 font-mono font-bold text-royal-800">
                                {{ $aspiration->ticket_code }}
                                <span class="block text-[10px] text-slate-400 font-sans font-normal">{{ $aspiration->created_at->format('d/m/Y H:i') }}</span>
                            </td>
                            <td class="px-6 py-3.5">
                                <div class="font-bold text-slate-900">{{ $aspiration->sender_name }}</div>
                                <div class="text-[11px] text-slate-400">{{ $aspiration->sender_email }}</div>
                            </td>
                            <td class="px-6 py-3.5 max-w-xs">
                                <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-slate-100 text-slate-700 mr-1">
                                    {{ $aspiration->category }}
                                </span>
                                <span class="font-medium text-slate-800">{{ $aspiration->subject }}</span>
                            </td>
                            <td class="px-6 py-3.5">
                                @if($aspiration->status === 'submitted')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        Terkirim
                                    </span>
                                @elseif($aspiration->status === 'in_review')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                        Diproses
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Selesai
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-3.5 max-w-xs">
                                @if(!empty($aspiration->admin_notes))
                                    <p class="text-[11px] text-slate-600 line-clamp-1 italic">"{{ $aspiration->admin_notes }}"</p>
                                    @if($aspiration->handler)
                                        <span class="text-[10px] text-slate-400">Oleh: {{ $aspiration->handler->name }}</span>
                                    @endif
                                @else
                                    <span class="text-[11px] text-slate-400 italic">Belum ada respon</span>
                                @endif
                            </td>
                            <td class="px-6 py-3.5 text-right">
                                <button @click="modalOpen = true" class="px-2.5 py-1 rounded text-xs font-bold text-royal-800 bg-blue-50 hover:bg-royal-800 hover:text-white transition">
                                    Kelola Tiket
                                </button>

                                <!-- Modal Kelola Tiket -->
                                <div x-show="modalOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto text-left" aria-modal="true">
                                    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 sm:p-0">
                                        <div @click="modalOpen = false" class="fixed inset-0 bg-slate-900/50 backdrop-blur-2xs"></div>
                                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                                        <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200">
                                            <div class="p-5 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                                                <div>
                                                    <span class="font-mono font-bold text-royal-800 text-xs">Tiket [{{ $aspiration->ticket_code }}]</span>
                                                    <h3 class="font-bold text-sm text-slate-900">{{ $aspiration->subject }}</h3>
                                                </div>
                                                <button @click="modalOpen = false" class="text-slate-400 hover:text-slate-600">
                                                    <i data-lucide="x" class="w-4 h-4"></i>
                                                </button>
                                            </div>

                                            <div class="p-5 space-y-3 text-xs bg-slate-50/50 border-b border-slate-100">
                                                <div>
                                                    <span class="text-slate-400">Pengirim:</span>
                                                    <strong class="text-slate-800">{{ $aspiration->sender_name }}</strong> ({{ $aspiration->sender_email }})
                                                </div>
                                                <div>
                                                    <span class="text-slate-400">Kategori:</span>
                                                    <strong class="text-slate-800">{{ $aspiration->category }}</strong>
                                                </div>
                                                <div>
                                                    <span class="text-slate-400">Pesan Lengkap:</span>
                                                    <p class="text-slate-700 mt-1 p-3 rounded-lg bg-white border border-slate-200 whitespace-pre-line">{{ $aspiration->message }}</p>
                                                </div>
                                                @if($aspiration->attachment)
                                                    <div>
                                                        <a href="{{ asset('storage/' . $aspiration->attachment) }}" target="_blank" class="inline-flex items-center gap-1.5 text-royal-800 font-semibold hover:underline">
                                                            <i data-lucide="paperclip" class="w-3.5 h-3.5"></i>
                                                            Lihat Berkas Lampiran Pengirim
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>

                                            <form method="POST" action="{{ route('admin.aspirasi.update', $aspiration->id) }}" class="p-5 space-y-4 text-xs">
                                                @csrf
                                                @method('PATCH')

                                                <div>
                                                    <label class="block font-bold text-slate-700 mb-1">Status Tiket</label>
                                                    <select name="status" class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg">
                                                        <option value="submitted" {{ $aspiration->status === 'submitted' ? 'selected' : '' }}>Terkirim (Menunggu Verifikasi Tim)</option>
                                                        <option value="in_review" {{ $aspiration->status === 'in_review' ? 'selected' : '' }}>Sedang Diproses (In Review - Disposisi ke Bidang)</option>
                                                        <option value="resolved" {{ $aspiration->status === 'resolved' ? 'selected' : '' }}>Selesai Ditindaklanjuti (Resolved)</option>
                                                    </select>
                                                </div>

                                                <div>
                                                    <label class="block font-bold text-slate-700 mb-1">Catatan Resmi Admin / Jawaban DPP KNPI</label>
                                                    <textarea name="admin_notes" rows="4" class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg" placeholder="Tuliskan keterangan tindak lanjut resmi yang akan ditampilkan ke pengirim saat melacak tiket...">{{ $aspiration->admin_notes }}</textarea>
                                                </div>

                                                <div class="pt-2 flex justify-end gap-2">
                                                    <button @click="modalOpen = false" type="button" class="px-4 py-2 rounded-lg font-semibold text-slate-600 hover:bg-slate-100">Tutup</button>
                                                    <button type="submit" class="px-4 py-2 rounded-lg font-bold text-white bg-royal-800 hover:bg-royal-900">Simpan Status & Respon</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-400">Tidak ada data tiket aspirasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $aspirations->links() }}
        </div>
    </div>
@endsection
