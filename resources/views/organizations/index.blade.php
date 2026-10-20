@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between pb-8 border-b border-slate-200 gap-4">
        <div>
            <span class="text-xs font-bold uppercase tracking-wider text-royal-800">{{ __('messages.okp.tag') }}</span>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight mt-1">{{ __('messages.okp.title') }}</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">{{ __('messages.okp.sub') }}</p>
        </div>

        <!-- Search input -->
        <form method="GET" action="{{ route('okp.index') }}" class="flex items-center gap-2 w-full md:w-80">
            <div class="relative w-full">
                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                <input type="text" name="q" value="{{ $search }}" placeholder="Cari nama OKP / SK..." class="w-full text-xs pl-9 pr-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800 focus:ring-1 focus:ring-royal-800 bg-white">
            </div>
            <button type="submit" class="px-4 py-2.5 rounded-lg text-xs font-bold text-white bg-royal-800 hover:bg-royal-900 transition">
                Cari
            </button>
        </form>
    </div>

    <!-- Status Filter Buttons -->
    <div class="flex items-center gap-2 py-6">
        <a href="{{ route('okp.index', ['status' => 'verified', 'q' => $search]) }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold transition {{ $status === 'verified' ? 'bg-royal-800 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
            {{ __('messages.okp.verified') }} ({{ $stats['total_verified'] }})
        </a>
        <a href="{{ route('okp.index', ['status' => 'pending', 'q' => $search]) }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold transition {{ $status === 'pending' ? 'bg-royal-800 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
            {{ __('messages.okp.pending') }} ({{ $stats['total_pending'] }})
        </a>
        <a href="{{ route('okp.index', ['status' => 'all', 'q' => $search]) }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold transition {{ $status === 'all' ? 'bg-royal-800 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
            {{ __('messages.okp.see_all') }}
        </a>
    </div>

    <!-- OKP Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($organizations as $org)
            <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-xs hover:border-royal-800 hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center font-black text-royal-800 text-base shrink-0">
                            {{ strtoupper(substr($org->name, 0, 2)) }}
                        </div>
                        
                        @if($org->status === 'verified')
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shrink-0">
                                <i data-lucide="check" class="w-3 h-3"></i> Terverifikasi
                            </span>
                        @elseif($org->status === 'pending')
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-200 shrink-0">
                                <i data-lucide="clock" class="w-3 h-3"></i> Menunggu
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-red-50 text-red-700 border border-red-200 shrink-0">
                                Kedaluwarsa
                            </span>
                        @endif
                    </div>

                    <h3 class="text-base font-bold text-slate-900 leading-snug mb-3" title="{{ $org->name }}">
                        {{ $org->name }}
                    </h3>

                    <div class="space-y-2 text-xs text-slate-600 pt-2 border-t border-slate-100">
                        <div class="flex items-center gap-2">
                            <i data-lucide="user" class="w-3.5 h-3.5 text-slate-400 shrink-0"></i>
                            <span class="truncate">Ketua Umum: <strong class="text-slate-800">{{ $org->leader_name }}</strong></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="file-badge" class="w-3.5 h-3.5 text-slate-400 shrink-0"></i>
                            <span class="truncate font-mono text-[11px] text-slate-600">{{ $org->sk_number }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="mail" class="w-3.5 h-3.5 text-slate-400 shrink-0"></i>
                            <span class="truncate text-slate-600">{{ $org->email }}</span>
                        </div>
                    </div>
                </div>

                @if($org->sk_file)
                    <div class="mt-4 pt-3 border-t border-slate-100 flex justify-end">
                        <a href="{{ asset('storage/' . $org->sk_file) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-semibold text-royal-800 hover:underline">
                            <i data-lucide="file-text" class="w-3.5 h-3.5"></i>
                            Unduh Dokumen SK
                        </a>
                    </div>
                @endif
            </div>
        @empty
            <div class="col-span-3 text-center py-16 bg-white rounded-xl border border-slate-200">
                <i data-lucide="building-2" class="w-10 h-10 text-slate-300 mx-auto mb-2"></i>
                <p class="text-sm font-semibold text-slate-700">Tidak ada OKP yang cocok</p>
                <p class="text-xs text-slate-400 mt-1">Gunakan kata kunci lain untuk mencari nama organisasi atau nomor SK.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $organizations->links() }}
    </div>
</div>
@endsection
