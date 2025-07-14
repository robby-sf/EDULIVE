@extends('layouts.app')

@section('title', 'Homepage - EDULIVE')

@section('content')
    {{-- SECTION 1 - HERO SECTION --}}
    <section class="w-full bg-[#ffffff] px-4 py-14 md:py-16 flex justify-center">
        <div class="container mx-auto">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-8 justify-between px-24">
                <div class="text-center lg:text-left max-w-2xl">
                    <h1 id="animated-title" class="text-[#000000] text-6xl sm:text-7xl md:text-8xl lg:text-[120px] font-semibold uppercase tracking-[10px] leading-tight">
                        {{-- Dibiarkan kosong, akan diisi oleh JS --}}
                    </h1>
                    <p id="animated-tagline" class="text-[#5E5E5E] text-lg md:text-xl mt-4 tracking-[2px] uppercase">
                        {{-- Dibiarkan kosong, akan diisi oleh JS --}}
                    </p>
                </div>
                <div class="relative hidden lg:flex items-center justify-center lg:w-1/2 h-[568px]">
                    {{-- PERUBAHAN DI SINI: Hapus inline style dan tambahkan ID --}}
                    <spline-viewer url="https://prod.spline.design/uVNsVwMkUOp-DedR/scene.splinecode"></spline-viewer>
                    <div class="absolute bottom-4 right-4 w-40 h-10 bg-white z-10"></div>

                </div>
            </div>
        </div>
    </section>
@endsection
