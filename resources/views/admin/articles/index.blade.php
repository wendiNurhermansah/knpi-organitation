@extends('layouts.admin')

@section('content')
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Manajemen Berita & Publikasi</h1>
            <p class="text-xs text-slate-500 mt-0.5">Tulis, tinjau, dan terbitkan rilis pers kepemudaan serta liputan program KNPI.</p>
        </div>
        <a href="{{ route('admin.berita.create') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-xs font-bold text-white bg-royal-800 hover:bg-royal-900 transition shadow-xs">
            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
            Tulis Berita Baru
        </a>
    </div>

    <!-- Articles Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-3">Judul Berita</th>
                        <th class="px-6 py-3">Kategori</th>
                        <th class="px-6 py-3">Penulis</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Tanggal Terbit</th>
                        <th class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($articles as $art)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="px-6 py-3.5 max-w-sm">
                                <a href="{{ route('berita.show', $art->slug) }}" target="_blank" class="font-bold text-slate-900 hover:text-royal-800 line-clamp-1">
                                    {{ $art->title }}
                                </a>
                                <span class="text-[10px] text-slate-400">{{ number_format($art->views_count) }} tayangan</span>
                            </td>
                            <td class="px-6 py-3.5">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-royal-800">
                                    {{ $art->category->name ?? 'Umum' }}
                                </span>
                            </td>
                            <td class="px-6 py-3.5 font-medium text-slate-700">
                                {{ $art->author->name ?? 'Humas' }}
                            </td>
                            <td class="px-6 py-3.5">
                                @if($art->status === 'published')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Terbit
                                    </span>
                                @elseif($art->status === 'draft')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700">
                                        Draft
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700">
                                        Arsip
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-3.5 text-slate-500">
                                {{ $art->published_at ? $art->published_at->format('d/m/Y H:i') : '-' }}
                            </td>
                            <td class="px-6 py-3.5 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.berita.edit', $art->id) }}" class="p-1.5 rounded text-slate-500 hover:text-royal-800 hover:bg-slate-100" title="Edit">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.berita.destroy', $art->id) }}" onsubmit="return confirm('Hapus artikel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded text-slate-400 hover:text-red-600 hover:bg-red-50" title="Hapus">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-400">Belum ada berita terbit.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $articles->links() }}
        </div>
    </div>
@endsection
