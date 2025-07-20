@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="w-full min-h-screen relative overflow-hidden flex items-center justify-center">
    {{-- Elemen dekoratif latar belakang --}}
    <div class="absolute w-56 h-56 bg-blue-600/25 rounded-full blur-[114px]" style="left: 331px; top: 366px;"></div>
    <div class="absolute w-56 h-56 bg-blue-600/25 rounded-full blur-[114px]" style="left: 881px; top: 627px;"></div>
    <div class="absolute w-[532px] h-[532px] rounded-full border border-gray-800" style="left: -273px; top: -272px;"></div>
    <div class="absolute w-[532px] h-[532px] rounded-full border border-gray-800" style="right: -273px; bottom: -272px;"></div>

    {{-- Container Form --}}
    <div class="w-[550px] h-auto bg-white/5 rounded-2xl border border-white/20 shadow-2xl backdrop-blur-xl p-10 relative">

        {{-- Logo --}}
        <div class="absolute left-1/2 -top-7 -translate-x-1/2">
            <div class="w-14 h-14 bg-gradient-to-l from-gray-300 to-stone-500 rounded-full flex items-center justify-center">
                <i class="fas fa-at text-black text-2xl"></i>
            </div>
        </div>

        <div class="flex flex-col items-center pt-10">
            <h1 class="text-white text-3xl font-semibold mb-12">WELCOME BACK</h1>

            {{-- Ganti dengan form yang menunjuk ke route login Anda --}}
            <form method="POST" action="{{ route('login') }}" class="w-full flex flex-col items-center">
                @csrf {{-- Token keamanan Laravel --}}

                {{-- Input Email --}}
                <div class="relative w-96 mb-6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <i class="fas fa-envelope text-zinc-500"></i>
                    </div>
                    <input id="email" name="email" type="email" placeholder="Email Address" class="w-full h-12 bg-white/5 rounded-lg border border-white/10 pl-12 pr-4 text-zinc-300 placeholder-zinc-500 font-light focus:outline-none focus:ring-1 focus:ring-blue-500" value="{{ old('email') }}" required autocomplete="email" autofocus>
                </div>

                {{-- Input Password --}}
                <div class="relative w-96 mb-6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <i class="fas fa-lock text-zinc-500"></i>
                    </div>
                    <input id="password" name="password" type="password" placeholder="Password" class="w-full h-12 bg-white/5 rounded-lg border border-white/10 pl-12 pr-4 text-zinc-300 placeholder-zinc-500 font-light focus:outline-none focus:ring-1 focus:ring-blue-500" required autocomplete="current-password">
                </div>

                {{-- Tombol Login --}}
                <button type="submit" class="w-96 h-12 bg-gradient-to-r from-stone-500 to-gray-300 rounded-lg text-white font-normal text-base mb-6 hover:opacity-90 transition-opacity">
                    Login
                </button>

                {{-- Remember Me & Forgot Password --}}
                <div class="w-96 flex justify-between items-center mb-12">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox" class="w-5 h-5 bg-transparent rounded border border-stone-500 text-stone-500 focus:ring-stone-500 cursor-pointer">
                        <label for="remember-me" class="ml-2 text-zinc-400 text-base font-light cursor-pointer">Remember me</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-white text-base font-medium hover:underline">Forgot password</a>
                    @endif
                </div>
            </form>

            {{-- Link Sign Up --}}
            <p class="text-base font-light">
                <span class="text-zinc-500">Don't have an account yet? </span>
                <a href="{{ route('register') }}" class="text-white font-semibold hover:underline">Sign Up</a>
            </p>
        </div>
    </div>
</div>
@endsection
