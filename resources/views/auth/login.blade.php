@extends('layouts.app')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-2xl border border-slate-200 p-8 shadow-md">
        <!-- Logo & Header -->
        <div class="text-center mb-8">
            <div class="w-12 h-12 rounded-xl bg-royal-800 text-white font-black text-xl flex items-center justify-center mx-auto shadow-md">
                <span class="text-gold-400">KN</span>PI
            </div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight mt-4">
                Paper Admin Portal
            </h2>
            <p class="text-xs text-slate-500 mt-1">
                Masuk ke panel tata kelola ekosistem digital DPP KNPI
            </p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login.attempt') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Alamat Email</label>
                <div class="relative">
                    <i data-lucide="mail" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                    <input type="email" name="email" value="{{ old('email', 'admin@knpi.or.id') }}" required autofocus class="w-full text-xs pl-9 pr-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800 focus:ring-1 focus:ring-royal-800" placeholder="admin@knpi.or.id">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Kata Sandi</label>
                <div class="relative">
                    <i data-lucide="lock" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                    <input type="password" name="password" value="password123" required class="w-full text-xs pl-9 pr-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-royal-800 focus:ring-1 focus:ring-royal-800" placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center text-slate-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-royal-800 focus:ring-royal-800 mr-2">
                    Ingat Sesi Saya
                </label>
                <a href="#" class="text-royal-800 hover:underline">Lupa Sandi?</a>
            </div>

            <button type="submit" class="w-full py-3 rounded-xl font-bold text-xs uppercase tracking-wider text-white bg-royal-800 hover:bg-royal-900 active:scale-98 transition shadow-sm mt-2">
                Masuk ke Dashboard
            </button>
        </form>

        <!-- Quick Demo Credentials Box -->
        <div class="mt-6 pt-5 border-t border-slate-100 text-[11px] text-slate-500 bg-slate-50 p-3.5 rounded-xl border border-slate-200">
            <span class="font-bold text-slate-700 block mb-1">Kredensial Default Seed:</span>
            <div class="space-y-0.5 font-mono">
                <div>Super Admin: <strong class="text-slate-900">admin@knpi.or.id</strong> / password123</div>
                <div>Admin Humas: <strong class="text-slate-900">humas@knpi.or.id</strong> / password123</div>
                <div>Admin OKP: <strong class="text-slate-900">okp@knpi.or.id</strong> / password123</div>
            </div>
        </div>
    </div>
</div>
@endsection
