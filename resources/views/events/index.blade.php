@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="pb-8 border-b border-slate-200">
        <span class="text-xs font-bold uppercase tracking-wider text-royal-800">{{ __('messages.events.tag') }}</span>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight mt-1">{{ __('messages.events.title') }}</h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">{{ __('messages.events.sub') }}</p>
    </div>

    <!-- Events Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pt-8">
        @forelse($events as $event)
            <div x-data="{ modalOpen: false }" class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <!-- Date Pill & Location -->
                    <div class="p-5 pb-0">
                        <div class="flex items-center justify-between mb-3">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-xs font-bold bg-blue-50 text-royal-800 border border-blue-200">
                                <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                {{ $event->start_time->translatedFormat('d M Y') }}
                            </span>
                            <span class="text-xs font-semibold text-slate-500">
                                {{ __('messages.events.quota_left') }}: <strong class="text-royal-800">{{ $event->remaining_quota }}</strong> / {{ $event->quota }}
                            </span>
                        </div>

                        <h3 class="text-base font-bold text-slate-900 leading-snug mb-2">
                            {{ $event->title }}
                        </h3>

                        <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed mb-4">
                            {{ $event->description }}
                        </p>
                    </div>
                </div>

                <div class="p-5 pt-3 border-t border-slate-100 flex flex-col gap-3">
                    <div class="flex items-center gap-2 text-xs text-slate-500">
                        <i data-lucide="map-pin" class="w-3.5 h-3.5 text-gold-500 shrink-0"></i>
                        <span class="truncate">{{ $event->location }}</span>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <span class="text-[11px] text-slate-400">
                            {{ $event->start_time->format('H:i') }} - {{ $event->end_time->format('H:i') }} WIB
                        </span>

                        @if($event->is_open_registration && $event->remaining_quota > 0)
                            <button @click="modalOpen = true" class="px-4 py-2 rounded-lg text-xs font-bold text-slate-900 bg-gold-500 hover:bg-gold-400 active:scale-95 transition shadow-xs">
                                {{ __('messages.events.register') }}
                            </button>
                        @else
                            <span class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-400 bg-slate-100">
                                {{ __('messages.events.closed') }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Registration Modal -->
                <div x-show="modalOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-modal="true">
                    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                        <div @click="modalOpen = false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200">
                            <div class="bg-royal-800 px-6 py-4 text-white flex justify-between items-center">
                                <div>
                                    <h4 class="font-bold text-sm">Formulir Pendaftaran Peserta</h4>
                                    <p class="text-xs text-blue-200 truncate max-w-sm">{{ $event->title }}</p>
                                </div>
                                <button @click="modalOpen = false" class="text-white/80 hover:text-white">
                                    <i data-lucide="x" class="w-5 h-5"></i>
                                </button>
                            </div>

                            <form method="POST" action="{{ route('agenda.register', $event->id) }}" class="p-6 space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nama Lengkap</label>
                                    <input type="text" name="name" required class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg focus:ring-1 focus:ring-royal-800 focus:outline-none" placeholder="Masukkan nama sesuai KTP">
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">NIK (16 Digit)</label>
                                        <input type="text" name="nik" maxlength="16" required class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg focus:ring-1 focus:ring-royal-800 focus:outline-none" placeholder="3201xxxxxxxxxxxx">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nomor WhatsApp</label>
                                        <input type="text" name="phone" required class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg focus:ring-1 focus:ring-royal-800 focus:outline-none" placeholder="08xxxxxxxxxx">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Alamat Email</label>
                                    <input type="email" name="email" required class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg focus:ring-1 focus:ring-royal-800 focus:outline-none" placeholder="alamat@email.com">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Asal OKP / Institusi</label>
                                    <input type="text" name="okp_origin" required class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg focus:ring-1 focus:ring-royal-800 focus:outline-none" placeholder="Contoh: GP Ansor / Mahasiswa">
                                </div>

                                <div class="pt-2 flex justify-end gap-2">
                                    <button @click="modalOpen = false" type="button" class="px-4 py-2 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100">
                                        Batal
                                    </button>
                                    <button type="submit" class="px-5 py-2 rounded-lg text-xs font-bold bg-gold-500 hover:bg-gold-600 text-slate-900 shadow-sm">
                                        Kirim Pendaftaran
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-16 bg-white rounded-xl border border-slate-200">
                <i data-lucide="calendar" class="w-10 h-10 text-slate-300 mx-auto mb-2"></i>
                <p class="text-sm font-semibold text-slate-700">Belum ada agenda kepemudaan</p>
                <p class="text-xs text-slate-400 mt-1">Nantikan informasi jadwal musyawarah dan pelatihan berikutnya.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $events->links() }}
    </div>
</div>
@endsection
