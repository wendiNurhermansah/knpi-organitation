@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('admin.agenda.index') }}" class="text-xs font-semibold text-royal-800 hover:underline flex items-center gap-1 mb-2">
                &larr; Kembali ke Kalender Agenda
            </a>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Tambah Agenda Baru</h1>
            <p class="text-xs text-slate-500 mt-0.5">Jadwalkan kegiatan kepemudaan dan buka pendaftaran partisipan.</p>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-2xs">
            <form method="POST" action="{{ route('admin.agenda.store') }}" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Nama Agenda Kegiatan</label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Rapat Pimpinan Nasional (RAPIMNAS) Pemuda" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800 font-semibold">
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Lokasi Kegiatan</label>
                    <input type="text" name="location" value="{{ old('location') }}" required placeholder="Contoh: Grand Ballroom Hotel Kempinski, Jakarta" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Waktu Mulai</label>
                        <input type="datetime-local" name="start_time" value="{{ old('start_time') }}" required class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Waktu Selesai</label>
                        <input type="datetime-local" name="end_time" value="{{ old('end_time') }}" required class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Batas Kuota Peserta</label>
                        <input type="number" name="quota" value="{{ old('quota', 100) }}" required min="1" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Status Pendaftaran</label>
                        <select name="is_open_registration" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">
                            <option value="1" {{ old('is_open_registration', '1') == '1' ? 'selected' : '' }}>Dibuka untuk Publik</option>
                            <option value="0" {{ old('is_open_registration') == '0' ? 'selected' : '' }}>Ditutup Sementara</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Deskripsi Lengkap Kegiatan</label>
                    <textarea name="description" rows="4" required placeholder="Jelaskan tujuan, sasaran peserta, dan rangkaian kegiatan..." class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">{{ old('description') }}</textarea>
                </div>

                <div class="pt-4 flex justify-end gap-2 border-t border-slate-100">
                    <a href="{{ route('admin.agenda.index') }}" class="px-4 py-2.5 rounded-lg font-semibold text-slate-600 hover:bg-slate-100">Batal</a>
                    <button type="submit" class="px-5 py-2.5 rounded-lg font-bold text-white bg-royal-800 hover:bg-royal-900 shadow-sm">
                        Jadwalkan Agenda
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
