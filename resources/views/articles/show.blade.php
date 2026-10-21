@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-royal-800">{{ __('messages.nav.home') }}</a>
        <span>/</span>
        <a href="{{ route('berita.index') }}" class="hover:text-royal-800">{{ __('messages.nav.news') }}</a>
        <span>/</span>
        <span class="text-slate-600 truncate max-w-xs">{{ $article->title }}</span>
    </nav>

    <!-- Header -->
    <header class="space-y-4 mb-8">
        <div class="flex items-center gap-2">
            <span class="px-2.5 py-1 rounded text-xs font-bold uppercase tracking-wider bg-royal-800 text-white">
                {{ $article->category->name ?? 'KNPI' }}
            </span>
            <span class="text-xs text-slate-400">
                <i data-lucide="eye" class="w-3.5 h-3.5 inline mr-1"></i>{{ number_format($article->views_count) }} {{ __('messages.news.views') }}
            </span>
        </div>

        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight">
            {{ $article->title }}
        </h1>

        <div class="flex items-center justify-between py-3 border-y border-slate-200 text-xs text-slate-500">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-royal-800 text-white flex items-center justify-center font-bold text-xs">
                    {{ strtoupper(substr($article->author->name ?? 'KN', 0, 2)) }}
                </div>
                <div>
                    <div class="font-bold text-slate-800">{{ $article->author->name ?? 'Humas DPP KNPI' }}</div>
                    <div class="text-[11px] text-slate-400">{{ $article->published_at ? $article->published_at->translatedFormat('l, d F Y - H:i') : $article->created_at->translatedFormat('l, d F Y') }} WIB</div>
                </div>
            </div>

            <!-- Share Buttons -->
            <div class="flex items-center gap-2">
                <span class="text-[11px] font-semibold text-slate-400 hidden sm:inline">{{ app()->getLocale() === 'en' ? 'Share:' : 'Bagikan:' }}</span>
                <a href="#" class="p-1.5 rounded-md hover:bg-slate-100 text-slate-500 hover:text-royal-800"><i data-lucide="share-2" class="w-4 h-4"></i></a>
            </div>
        </div>
    </header>

    <!-- Article Featured Image -->
    <div class="rounded-2xl overflow-hidden mb-8 border border-slate-200 shadow-sm aspect-16/9 bg-slate-100">
        @if($article->thumbnail)
            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
        @else
            <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=1200&q=80" alt="{{ $article->title }}" class="w-full h-full object-cover">
        @endif
    </div>

    <!-- Article Body -->
    <div class="prose prose-slate max-w-none text-slate-800 text-sm leading-relaxed mb-12">
        <p class="text-base font-semibold text-slate-700 leading-relaxed italic border-l-4 border-gold-500 pl-4 py-1 mb-6 bg-slate-50 rounded-r-lg">
            {{ $article->summary }}
        </p>

        {!! $article->content !!}
    </div>

    <!-- Related Articles -->
    @if($relatedArticles->count() > 0)
        <div class="pt-10 border-t border-slate-200">
            <h3 class="text-lg font-bold text-slate-900 mb-6">Warta Terkait</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                @foreach($relatedArticles as $rel)
                    <a href="{{ route('berita.show', $rel->slug) }}" class="group block p-4 rounded-xl border border-slate-200 hover:border-royal-800 hover:shadow-xs transition bg-white">
                        <span class="text-[10px] font-bold text-royal-800 uppercase block mb-1">{{ $rel->category->name }}</span>
                        <h4 class="text-xs font-bold text-slate-900 group-hover:text-royal-800 transition line-clamp-2 leading-snug">
                            {{ $rel->title }}
                        </h4>
                        <span class="text-[10px] text-slate-400 mt-2 block">{{ $rel->published_at ? $rel->published_at->format('d M Y') : '' }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
