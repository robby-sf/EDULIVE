@extends('layouts.app')

@section('title', 'Homepage - EDULIVE')

@section('content')
    {{-- SECTION 1 - HERO SECTION --}}
    <section class="w-full bg-[#ffffff] px-4 py-14 md:py-20 flex justify-center">
        <div class="container mx-auto">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-8 justify-center lg:justify-between">
                <div class="text-center lg:text-left max-w-2xl">
                    <h1 class="text-[#000000] text-6xl sm:text-7xl md:text-8xl lg:text-[120px] font-semibold uppercase tracking-[10px] leading-tight animate-fade-in-down">
                        EDULIVE
                    </h1>
                    <p class="text-[#5E5E5E] text-lg md:text-xl mt-4 tracking-[2px] uppercase animate-fade-in-down">
                        Elevate Your Learning Experience With AI
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
