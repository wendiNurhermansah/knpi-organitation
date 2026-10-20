@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl">
        <div class="mb-6">
            <a href="{{ route('admin.berita.index') }}" class="text-xs font-semibold text-royal-800 hover:underline flex items-center gap-1 mb-2">
                &larr; Kembali ke Daftar Berita
            </a>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Tulis Berita Baru</h1>
            <p class="text-xs text-slate-500 mt-0.5">Publikasikan informasi, siaran pers, dan dokumentasi kegiatan kepemudaan.</p>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-2xs">
            <form method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Judul Berita</label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Sinergi Pemuda, Membangun Bangsa Menuju Indonesia Emas" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800 font-semibold">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Kategori Berita</label>
                        <select name="category_id" required class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">
                            <option value="">Pilih Kategori...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Status Publikasi</label>
                        <select name="status" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Terbit Langsung)</option>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Konsep)</option>
                            <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived (Arsip)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Ringkasan Berita (Summary / Lead Paragraph)</label>
                    <textarea name="summary" rows="2" required placeholder="Tuliskan 1-2 kalimat ringkasan yang menarik untuk ditampilkan pada kartu berita..." class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">{{ old('summary') }}</textarea>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Isi Berita Lengkap (Format HTML/Teks)</label>
                    <textarea name="content" rows="8" required placeholder="Tuliskan berita lengkap di sini..." class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800 leading-relaxed font-sans">{{ old('content') }}</textarea>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Foto Sampul (Thumbnail, Maksimal 4MB)</label>
                    <input type="file" name="thumbnail" accept="image/*" class="w-full text-xs">
                </div>

                <div class="pt-4 flex justify-end gap-2 border-t border-slate-100">
                    <a href="{{ route('admin.berita.index') }}" class="px-4 py-2.5 rounded-lg font-semibold text-slate-600 hover:bg-slate-100">Batal</a>
                    <button type="submit" class="px-5 py-2.5 rounded-lg font-bold text-white bg-royal-800 hover:bg-royal-900 shadow-sm">
                        Simpan & Terbitkan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
