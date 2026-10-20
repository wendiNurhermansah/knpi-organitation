@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.agenda.index') }}" class="text-xs font-semibold text-royal-800 hover:underline flex items-center gap-1 mb-2">
            &larr; Kembali ke Kalender Agenda
        </a>
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-royal-800">Daftar Hadir & Registrasi</span>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ $event->title }}</h1>
                <p class="text-xs text-slate-500 mt-0.5">
                    <i data-lucide="map-pin" class="w-3.5 h-3.5 inline text-gold-500 mr-1"></i>{{ $event->location }} • 
                    <i data-lucide="calendar" class="w-3.5 h-3.5 inline text-royal-800 mr-1"></i>{{ $event->start_time->translatedFormat('d F Y, H:i') }} WIB
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="px-3 py-1.5 rounded-lg text-xs font-bold bg-blue-50 text-royal-800 border border-blue-200">
                    Total: {{ $registrations->total() }} Peserta / Kuota {{ $event->quota }}
                </span>
            </div>
        </div>
    </div>

    <!-- Registrations Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-3">Nama Lengkap</th>
                        <th class="px-6 py-3">NIK</th>
                        <th class="px-6 py-3">Kontak (Email / WA)</th>
                        <th class="px-6 py-3">Asal OKP / Institusi</th>
                        <th class="px-6 py-3">Waktu Daftar</th>
                        <th class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($registrations as $reg)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="px-6 py-3.5 font-bold text-slate-900">
                                {{ $reg->name }}
                            </td>
                            <td class="px-6 py-3.5 font-mono text-[11px] text-slate-600">
                                {{ $reg->nik }}
                            </td>
                            <td class="px-6 py-3.5">
                                <div>{{ $reg->email }}</div>
                                <span class="text-[11px] text-slate-400">{{ $reg->phone }}</span>
                            </td>
                            <td class="px-6 py-3.5 font-medium text-slate-800">
                                {{ $reg->okp_origin }}
                            </td>
                            <td class="px-6 py-3.5 text-slate-400 text-[11px]">
                                {{ $reg->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-3.5">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    Terdaftar
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-400">Belum ada peserta yang mendaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $registrations->links() }}
        </div>
    </div>
@endsection
