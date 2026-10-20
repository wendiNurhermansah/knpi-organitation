@extends('layouts.admin')

@section('content')
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Manajemen Agenda & Kegiatan</h1>
            <p class="text-xs text-slate-500 mt-0.5">Jadwalkan forum pemuda, musyawarah OKP, dan kelola daftar peserta terdaftar.</p>
        </div>
        <a href="{{ route('admin.agenda.create') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-xs font-bold text-white bg-royal-800 hover:bg-royal-900 transition shadow-xs">
            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
            Tambah Agenda Baru
        </a>
    </div>

    <!-- Events Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-3">Nama Agenda</th>
                        <th class="px-6 py-3">Waktu Pelaksanaan</th>
                        <th class="px-6 py-3">Lokasi</th>
                        <th class="px-6 py-3">Kuota Peserta</th>
                        <th class="px-6 py-3">Status Pendaftaran</th>
                        <th class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($events as $event)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="px-6 py-3.5 max-w-xs">
                                <a href="{{ route('admin.agenda.show', $event->id) }}" class="font-bold text-slate-900 hover:text-royal-800 line-clamp-1">
                                    {{ $event->title }}
                                </a>
                                <span class="text-[11px] text-slate-400 line-clamp-1">{{ $event->description }}</span>
                            </td>
                            <td class="px-6 py-3.5 text-slate-700 font-medium">
                                {{ $event->start_time->format('d/m/Y H:i') }}
                                <span class="block text-[10px] text-slate-400">s/d {{ $event->end_time->format('d/m/Y H:i') }}</span>
                            </td>
                            <td class="px-6 py-3.5 max-w-xs truncate text-slate-600">
                                {{ $event->location }}
                            </td>
                            <td class="px-6 py-3.5">
                                <span class="font-bold text-royal-800">{{ $event->registrations_count }}</span> / {{ $event->quota }}
                                <span class="block text-[10px] text-slate-400">terdaftar</span>
                            </td>
                            <td class="px-6 py-3.5">
                                @if($event->is_open_registration && $event->remaining_quota > 0)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Dibuka
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">
                                        Ditutup
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-3.5 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.agenda.show', $event->id) }}" class="px-2.5 py-1 rounded text-xs font-semibold text-royal-800 bg-blue-50 hover:bg-royal-800 hover:text-white transition">
                                        Peserta ({{ $event->registrations_count }})
                                    </a>
                                    <form method="POST" action="{{ route('admin.agenda.destroy', $event->id) }}" onsubmit="return confirm('Hapus agenda ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded text-slate-400 hover:text-red-600 hover:bg-red-50" title="Hapus">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-400">Belum ada agenda terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $events->links() }}
        </div>
    </div>
@endsection
