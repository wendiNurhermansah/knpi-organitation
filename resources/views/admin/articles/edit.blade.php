@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl">
        <div class="mb-6">
            <a href="{{ route('admin.berita.index') }}" class="text-xs font-semibold text-royal-800 hover:underline flex items-center gap-1 mb-2">
                &larr; Kembali ke Daftar Berita
            </a>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Edit Berita</h1>
            <p class="text-xs text-slate-500 mt-0.5">Perbarui rincian berita, isi narasi, atau status publikasi.</p>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-2xs">
            <form method="POST" action="{{ route('admin.berita.update', $article->id) }}" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Judul Berita</label>
                    <input type="text" name="title" value="{{ old('title', $article->title) }}" required class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800 font-semibold">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Kategori Berita</label>
                        <select name="category_id" required class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $article->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Status Publikasi</label>
                        <select name="status" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">
                            <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Published (Terbit)</option>
                            <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Draft (Konsep)</option>
                            <option value="archived" {{ old('status', $article->status) == 'archived' ? 'selected' : '' }}>Archived (Arsip)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Ringkasan Berita</label>
                    <textarea name="summary" rows="2" required class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800">{{ old('summary', $article->summary) }}</textarea>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Isi Berita Lengkap</label>
                    <textarea name="content" rows="8" required class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800 leading-relaxed font-sans">{{ old('content', $article->content) }}</textarea>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Ganti Foto Sampul (Opsional)</label>
                    <input type="file" name="thumbnail" accept="image/*" class="w-full text-xs">
                    @if($article->thumbnail)
                        <div class="mt-2 text-[11px] text-slate-500">
                            Foto saat ini: <a href="{{ asset('storage/' . $article->thumbnail) }}" target="_blank" class="text-royal-800 underline">Lihat file</a>
                        </div>
                    @endif
                </div>

                <div class="pt-4 flex justify-end gap-2 border-t border-slate-100">
                    <a href="{{ route('admin.berita.index') }}" class="px-4 py-2.5 rounded-lg font-semibold text-slate-600 hover:bg-slate-100">Batal</a>
                    <button type="submit" class="px-5 py-2.5 rounded-lg font-bold text-white bg-royal-800 hover:bg-royal-900 shadow-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
