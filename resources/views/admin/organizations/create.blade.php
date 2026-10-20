@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('admin.okp.index') }}" class="text-xs font-semibold text-royal-800 hover:underline flex items-center gap-1 mb-2">
                &larr; Kembali ke Daftar OKP
            </a>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Tambah OKP Baru</h1>
            <p class="text-xs text-slate-500 mt-0.5">Daftarkan data organisasi kepemudaan dan berkas legalitas SK resmi.</p>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-2xs">
            <form method="POST" action="{{ route('admin.okp.store') }}" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Nama Organisasi Kemasyarakatan Pemuda (OKP)</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Pemuda Pancasila" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Ketua Umum</label>
                        <input type="text" name="leader_name" value="{{ old('leader_name') }}" required placeholder="Nama Ketua Umum" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Nomor Telepon / WhatsApp</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="08xxxxxxxxxx" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Alamat Email Resmi</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="sekretariat@okp.org" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Nomor SK Legalitas</label>
                    <input type="text" name="sk_number" value="{{ old('sk_number') }}" required placeholder="AHU-xxxx.AH.xx.xx atau SK-DPD-KNPI/xx" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800 font-mono">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Mulai Periode Kepengurusan</label>
                        <input type="date" name="period_start" value="{{ old('period_start') }}" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Akhir Periode Kepengurusan</label>
                        <input type="date" name="period_end" value="{{ old('period_end') }}" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Status Verifikasi Awal</label>
                    <select name="status" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending (Menunggu Verifikasi Berkas)</option>
                        <option value="verified" {{ old('status') == 'verified' ? 'selected' : '' }}>Verified (Langsung Terverifikasi Aktif)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Upload Berkas SK (PDF Maksimal 10MB)</label>
                    <input type="file" name="sk_file" accept=".pdf" class="w-full text-xs">
                </div>

                <div class="pt-4 flex justify-end gap-2 border-t border-slate-100">
                    <a href="{{ route('admin.okp.index') }}" class="px-4 py-2.5 rounded-lg font-semibold text-slate-600 hover:bg-slate-100">Batal</a>
                    <button type="submit" class="px-5 py-2.5 rounded-lg font-bold text-white bg-royal-800 hover:bg-royal-900 shadow-sm">
                        Simpan OKP
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
