@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between pb-8 border-b border-slate-200 gap-4">
        <div>
            <span class="text-xs font-bold uppercase tracking-wider text-royal-800">{{ __('messages.news.tag') }}</span>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight mt-1">{{ __('messages.news.title') }}</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">{{ app()->getLocale() === 'en' ? 'Periodic publications on youth dynamics, advocacy, and strategic KNPI programs.' : 'Publikasi berkala seputar dinamika kepemudaan, advokasi, dan program strategis KNPI.' }}</p>
        </div>

        <!-- Search input -->
        <form method="GET" action="{{ route('berita.index') }}" class="flex items-center gap-2 w-full md:w-80">
            @if($categorySlug)
                <input type="hidden" name="kategori" value="{{ $categorySlug }}">
            @endif
            <div class="relative w-full">
                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                <input type="text" name="q" value="{{ $search }}" placeholder="{{ app()->getLocale() === 'en' ? 'Search news...' : 'Cari berita...' }}" class="w-full text-xs pl-9 pr-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800 focus:ring-1 focus:ring-royal-800 bg-white">
            </div>
            <button type="submit" class="px-4 py-2.5 rounded-lg text-xs font-bold text-white bg-royal-800 hover:bg-royal-900 transition">
                {{ app()->getLocale() === 'en' ? 'Search' : 'Cari' }}
            </button>
        </form>
    </div>

    <!-- Category Filter Tabs -->
    <div class="flex items-center gap-2 overflow-x-auto py-6">
        <a href="{{ route('berita.index', ['q' => $search]) }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold transition whitespace-nowrap {{ empty($categorySlug) ? 'bg-royal-800 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
            {{ app()->getLocale() === 'en' ? 'All Categories' : 'Semua Kategori' }}
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('berita.index', ['kategori' => $cat->slug, 'q' => $search]) }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold transition whitespace-nowrap {{ $categorySlug === $cat->slug ? 'bg-royal-800 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                {{ $cat->name }} ({{ $cat->articles_count }})
            </a>
        @endforeach
    </div>

    <!-- Articles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($articles as $article)
            <article class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-md transition flex flex-col group">
                <div class="aspect-16/9 bg-slate-100 overflow-hidden relative">
                    @if($article->thumbnail)
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    @else
                        <img src="https://images.unsplash.com/photo-1544531585-9847b68c8c86?auto=format&fit=crop&w=700&q=80" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    @endif
                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-md text-[11px] font-bold bg-royal-800/90 text-white backdrop-blur-xs">
                        {{ $article->category->name ?? 'Kepemudaan' }}
                    </span>
                </div>

                <div class="p-5 flex flex-col flex-1">
                    <div class="flex items-center gap-3 text-xs text-slate-400 mb-2">
                        <span><i data-lucide="calendar" class="w-3.5 h-3.5 inline mr-1"></i>{{ $article->published_at ? $article->published_at->translatedFormat('d M Y') : $article->created_at->translatedFormat('d M Y') }}</span>
                        <span>•</span>
                        <span><i data-lucide="eye" class="w-3.5 h-3.5 inline mr-1"></i>{{ number_format($article->views_count) }}</span>
                    </div>

                    <h3 class="text-base font-bold text-slate-900 group-hover:text-royal-800 transition line-clamp-2 leading-snug mb-2">
                        <a href="{{ route('berita.show', $article->slug) }}">
                            {{ $article->title }}
                        </a>
                    </h3>

                    <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed mb-4 flex-1">
                        {{ $article->summary }}
                    </p>

                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-royal-800">
                        <span>Baca Selengkapnya</span>
                        <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-3 text-center py-16 bg-white rounded-xl border border-slate-200">
                <i data-lucide="newspaper" class="w-10 h-10 text-slate-300 mx-auto mb-2"></i>
                <p class="text-sm font-semibold text-slate-700">Tidak ada artikel ditemukan</p>
                <p class="text-xs text-slate-400 mt-1">Coba gunakan kata kunci pencarian lain atau pilih kategori berbeda.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $articles->links() }}
    </div>
</div>
@endsection
