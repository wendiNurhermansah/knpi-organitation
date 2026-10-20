@extends('layouts.admin')

@section('content')
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Direktori OKP (Organisasi Kemasyarakatan Pemuda)</h1>
            <p class="text-xs text-slate-500 mt-0.5">Kelola verifikasi legalitas, nomor SK Kemenkumham/DPD, dan masa kepengurusan OKP.</p>
        </div>
        <a href="{{ route('admin.okp.create') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-xs font-bold text-white bg-royal-800 hover:bg-royal-900 transition shadow-xs">
            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
            Tambah OKP Baru
        </a>
    </div>

    <!-- Filters Strip -->
    <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-2xs flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto">
            <a href="{{ route('admin.okp.index', ['q' => $search]) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ empty($currentStatus) ? 'bg-royal-800 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Semua ({{ $counts['all'] }})
            </a>
            <a href="{{ route('admin.okp.index', ['status' => 'pending', 'q' => $search]) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ $currentStatus === 'pending' ? 'bg-amber-600 text-white' : 'bg-amber-50 text-amber-700 hover:bg-amber-100' }}">
                Menunggu ({{ $counts['pending'] }})
            </a>
            <a href="{{ route('admin.okp.index', ['status' => 'verified', 'q' => $search]) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ $currentStatus === 'verified' ? 'bg-emerald-600 text-white' : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }}">
                Terverifikasi ({{ $counts['verified'] }})
            </a>
            <a href="{{ route('admin.okp.index', ['status' => 'expired', 'q' => $search]) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ $currentStatus === 'expired' ? 'bg-red-600 text-white' : 'bg-red-50 text-red-700 hover:bg-red-100' }}">
                Kedaluwarsa ({{ $counts['expired'] }})
            </a>
        </div>

        <form method="GET" action="{{ route('admin.okp.index') }}" class="flex items-center gap-2 w-full md:w-72">
            @if($currentStatus)
                <input type="hidden" name="status" value="{{ $currentStatus }}">
            @endif
            <input type="text" name="q" value="{{ $search }}" placeholder="Cari OKP / Ketua..." class="w-full text-xs px-3 py-1.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">
            <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-bold text-white bg-slate-800 hover:bg-slate-900 shrink-0">
                Cari
            </button>
        </form>
    </div>

    <!-- OKP Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-3">Nama OKP</th>
                        <th class="px-6 py-3">Ketua Umum</th>
                        <th class="px-6 py-3">Nomor & Berkas SK</th>
                        <th class="px-6 py-3">Masa Bakti</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($organizations as $org)
                        <tr class="hover:bg-slate-50/80 transition" x-data="{ verifyModal: false }">
                            <td class="px-6 py-3.5">
                                <div class="font-bold text-slate-900">{{ $org->name }}</div>
                                <div class="text-[11px] text-slate-400">{{ $org->email }} • {{ $org->phone }}</div>
                            </td>
                            <td class="px-6 py-3.5 font-medium text-slate-700">
                                {{ $org->leader_name }}
                            </td>
                            <td class="px-6 py-3.5">
                                <span class="font-mono text-[11px] text-slate-600 block">{{ $org->sk_number }}</span>
                                @if($org->sk_file)
                                    <a href="{{ asset('storage/' . $org->sk_file) }}" target="_blank" class="inline-flex items-center gap-1 text-[11px] text-royal-800 hover:underline mt-0.5">
                                        <i data-lucide="file-text" class="w-3 h-3"></i> Buka File SK (PDF)
                                    </a>
                                @else
                                    <span class="text-[10px] text-slate-400 italic">Belum ada file SK</span>
                                @endif
                            </td>
                            <td class="px-6 py-3.5 text-slate-600 text-[11px]">
                                {{ $org->period_start ? $org->period_start->format('Y') : '-' }} s/d {{ $org->period_end ? $org->period_end->format('Y') : '-' }}
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
                                    <form method="POST" action="{{ route('admin.okp.destroy', $org->id) }}" onsubmit="return confirm('Hapus data OKP ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1 rounded text-slate-400 hover:text-red-600 hover:bg-red-50 transition" title="Hapus">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </form>
                                </div>

                                <!-- Modal Verifikasi -->
                                <div x-show="verifyModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto text-left" aria-modal="true">
                                    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 sm:p-0">
                                        <div @click="verifyModal = false" class="fixed inset-0 bg-slate-900/50 backdrop-blur-2xs"></div>
                                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                                        <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full border border-slate-200">
                                            <div class="p-5 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                                                <div>
                                                    <h3 class="font-bold text-sm text-slate-900">Perbarui Status Legalitas OKP</h3>
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
                                                        <option value="pending" {{ $org->status === 'pending' ? 'selected' : '' }}>Pending (Menunggu Kelengkapan Berkas)</option>
                                                        <option value="expired" {{ $org->status === 'expired' ? 'selected' : '' }}>Expired (Kedaluwarsa)</option>
                                                    </select>
                                                </div>

                                                <div>
                                                    <label class="block font-bold text-slate-700 mb-1">Nomor SK Legalitas</label>
                                                    <input type="text" name="sk_number" value="{{ $org->sk_number }}" class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg">
                                                </div>

                                                <div class="grid grid-cols-2 gap-2">
                                                    <div>
                                                        <label class="block font-bold text-slate-700 mb-1">Mulai Periode</label>
                                                        <input type="date" name="period_start" value="{{ $org->period_start?->format('Y-m-d') }}" class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg">
                                                    </div>
                                                    <div>
                                                        <label class="block font-bold text-slate-700 mb-1">Akhir Periode</label>
                                                        <input type="date" name="period_end" value="{{ $org->period_end?->format('Y-m-d') }}" class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg">
                                                    </div>
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
                            <td colspan="6" class="px-6 py-8 text-center text-slate-400">Tidak ada data OKP ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $organizations->links() }}
        </div>
    </div>
@endsection
