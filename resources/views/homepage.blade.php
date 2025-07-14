@extends('layouts.app')

@section('title', 'Homepage - EDULIVE')

@section('content')
    {{-- SECTION 1 - HERO SECTION --}}
    <section class="w-full bg-[#ffffff] px-4 py-14 md:py-16 flex justify-center">
        <div class="container mx-auto">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-8 justify-between px-24">
                <div class="text-center lg:text-left max-w-2xl">
                    <h1 id="animated-title"
                        class="text-[#000000] text-6xl sm:text-7xl md:text-8xl lg:text-[120px] font-semibold uppercase tracking-[10px] leading-tight">
                        {{-- Dibiarkan kosong, akan diisi oleh JS --}}
                    </h1>
                    <p id="animated-tagline" class="text-[#5E5E5E] text-lg md:text-xl mt-4 tracking-[2px] uppercase">
                        {{-- Dibiarkan kosong, akan diisi oleh JS --}}
                    </p>
                </div>
                <div class="relative hidden lg:flex items-center justify-center lg:w-1/2 h-[568px]">
                    <spline-viewer url="https://prod.spline.design/uVNsVwMkUOp-DedR/scene.splinecode"></spline-viewer>
                    <div class="absolute bottom-4 right-4 w-40 h-10 bg-white z-10"></div>

                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 2 - PARALLAX --}}
    <section>
        <div id="parallax-section" class="relative overflow-hidden h-auto py-16">
            {{-- Ubah 'gap-2' menjadi 'gap-4' atau lebih besar untuk menambah jarak --}}
            <div class="flex flex-col gap-6 text-center">
                <h1 {{-- Perbesar nilai font, contoh: dari 80px menjadi 100px --}}
                    class="reveal-text text-black font-extrabold text-5xl md:text-7xl lg:text-[100px] uppercase tracking-wide opacity-0 translate-y-6 transition-all duration-700">
                    YOUR BEST ASSISTENT
                </h1>
                <h1
                    class="reveal-text text-neutral-400 font-extrabold text-5xl md:text-7xl lg:text-[100px] uppercase tracking-wide opacity-0 translate-y-6 transition-all duration-700 delay-100">
                    YOUR BEST ASSISTENT
                </h1>
                <h1
                    class="reveal-text text-neutral-400 font-extrabold text-5xl md:text-7xl lg:text-[100px] uppercase tracking-wide opacity-0 translate-y-6 transition-all duration-700 delay-200">
                    YOUR BEST ASSISTENT
                </h1>
                <h1
                    class="reveal-text text-neutral-400 font-extrabold text-5xl md:text-7xl lg:text-[100px] uppercase tracking-wide opacity-0 translate-y-6 transition-all duration-700 delay-300">
                    YOUR BEST ASSISTENT
                </h1>
                <h1
                    class="reveal-text text-neutral-400 font-extrabold text-5xl md:text-7xl lg:text-[100px] uppercase tracking-wide opacity-0 translate-y-6 transition-all duration-700 delay-300">
                    YOUR BEST ASSISTENT
                </h1>
                <h1
                    class="reveal-text text-neutral-400 font-extrabold text-5xl md:text-7xl lg:text-[100px] uppercase tracking-wide opacity-0 translate-y-6 transition-all duration-700 delay-300">
                    YOUR BEST ASSISTENT
                </h1>
                <h1
                    class="reveal-text text-neutral-400 font-extrabold text-5xl md:text-7xl lg:text-[100px] uppercase tracking-wide opacity-0 translate-y-6 transition-all duration-700 delay-300">
                    YOUR BEST ASSISTENT
                </h1>
                <h1
                    class="reveal-text text-neutral-400 font-extrabold text-5xl md:text-7xl lg:text-[100px] uppercase tracking-wide opacity-0 translate-y-6 transition-all duration-700 delay-300">
                    YOUR BEST ASSISTENT
                </h1>
            </div>
        </div>
    </section>
@endsection
