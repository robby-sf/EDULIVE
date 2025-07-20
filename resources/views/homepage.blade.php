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

    {{-- SECTION 3 - FEATURES --}}
    <section id="features-section" class="w-full bg-white px-4 py-16 mt-8">
        <div class="container mx-auto">
            {{-- Judul Section --}}
            <h2 id="features-title"
                class="text-4xl md:text-5xl font-normal text-black uppercase tracking-widest mb-16">
            </h2>

            {{-- Kontainer untuk Kartu Fitur --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">

                {{-- Card 1: AI DETECTION --}}
                <div class="feature-card relative w-full h-96 shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)]">
                    {{-- Background --}}
                    <div class="absolute inset-0 bg-zinc-300"></div>

                    {{-- Content Wrapper --}}
                    <div class="relative h-full p-6 flex flex-col justify-between">
                        {{-- Top Part: "AI" and "DETECTION" --}}
                        <div>
                            {{-- "AI" text. Using text with extreme font size and leading to mimic vector stretching --}}
                            <div class="text-left text-black font-semibold" style="">
                                <span style="font-size: 140px; line-height: 0.8;">A</span><span
                                    style="font-size: 140px; line-height: 0.8; margin-left: 0.01em;">I</span>
                            </div>
                            {{-- "DETECTION" text --}}
                            <p class="text-left text-black text-4xl font-normal leading-9 mt-2">DETECTION</p>
                        </div>

                        {{-- Bottom Part: Description --}}
                        <div class="w-full">
                            <p class="text-black text-base font-light tracking-wide text-left">
                                With the integration of Computer Vision and Machine Learning technology,
                                EDULIVE automatically detects the user's body posture while studying.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Card 2: SMART TIMER --}}
                <div class="feature-card relative w-full h-96 shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)]">
                    <div class="absolute inset-0 bg-zinc-300"></div>
                    <div class="relative h-full p-8 flex flex-col justify-between">
                        {{-- Top Part: Description --}}
                        <div class="w-full">
                            <p class="text-black text-base font-light tracking-wide text-center">
                                EDULIVE implements an automatic system that activates a timer based on the detection of your activity focus.
                            </p>
                        </div>

                        {{-- Bottom Part: "SMART" and "TIMER" --}}
                        <div class="w-full">
                            <div class="text-center text-black font-semibold"
                                style=" font-size: 100px; line-height: 1;">
                                <span style="margin-left: 0.01em;">S</span><span style="margin-left: 0.01em;">M</span><span
                                    style="margin-left: 0.01em;">A</span><span style="margin-left: 0.01em;">R</span><span
                                    style="margin-left: 0.01em;">T</span>
                            </div>
                            <p class="text-center text-black text-4xl font-normal leading-9 mt-2">TIMER</p>
                        </div>
                    </div>
                </div>

                {{-- Card 3: PROGRESS TRACKER --}}
                <div class="feature-card relative w-full h-96 shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)]">
                    <div class="absolute inset-0 bg-zinc-300"></div>
                    <div class="relative h-full p-6 flex flex-col justify-between">
                        {{-- Top Part: "PROGRESS" and "TRACKER" --}}
                        <div>
                            <div class="text-left text-black font-semibold"
                                style=" font-size: 90px; line-height: 1; letter-spacing: -0.05em;">
                                PROGRESS
                            </div>
                            <p class="text-right text-black text-4xl font-normal leading-9 mt-2">TRACKER</p>
                        </div>

                        {{-- Bottom Part: Description --}}
                        <div class="w-full">
                            {{-- Menggunakan deskripsi yang lebih relevan --}}
                            <p class="text-black text-base font-light tracking-wide text-left">
                                Monitor your statistics and learning history
                                to visualize your progress and understand your learning patterns in depth.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- SECTION 4 - TEAM MEMBER --}}
    <section id="team-section" class="px-4 py-16 mt-15">
        <div class="container mx-auto ">
            {{-- Header Section --}}
            <header class="text-center mb-28">
                <h2 class="team-card text-outline font-black" style="font-size: 130px; line-height: 1;">
                    OUR
                </h2>
                <div class="team-card inline-block bg-black text-white px-8 py-2 -mt-2">
                    <h3 class="text-7xl font-bold tracking-widest">TEAM MEMBER</h3>
                </div>
            </header>

            {{-- Grid untuk Anggota Tim --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-12">

                {{-- Anggota 1: Ravelin --}}
                <div class="team-card flex flex-col items-center">
                    <div
                        class="relative w-[240px] h-[260px] group cursor-pointer transform transition-transform duration-300 hover:-translate-y-[30px]">
                        <div
                            class="bg-[#000000] rounded-3xl shadow-lg w-full h-full transition-all duration-300 group-hover:shadow-2xl">
                        </div>

                        <img src="{{ asset('asset/ravelluth.png') }}" alt="Team Member"
                            class="absolute left-1/2 bottom-0 w-auto h-[320px] object-cover rounded-3xl drop-shadow-lg transform -translate-x-1/2" />

                    </div>

                    <div class="mt-6 max-w-[240px] text-center sm:text-left">
                        <div class="flex items-center justify-center sm:justify-center mb-2">
                            <span class="text-[30px] font-medium text-black text">UI/UX Designer</span>
                        </div>
                        <p class="text-[#5E5E5E] leading-relaxed mb-4 text-center text-[20px]">
                            Designing intuitive user experiences and attractive interfaces for the platform
                        </p>
                        <a href="{{ route('team.member1') }}" class="text-blue-600 font-bold hover:underline text-sm">
                            Find out more &rarr;
                        </a>
                    </div>
                </div>

                {{-- Anggota 2: Robby --}}
                <div class="team-card flex flex-col items-center">
                    <div
                        class="relative w-[240px] h-[260px] group cursor-pointer transform transition-transform duration-300 hover:-translate-y-[30px]">
                        <div
                            class="bg-[#000000] rounded-3xl shadow-lg w-full h-full transition-all duration-300 group-hover:shadow-2xl">
                        </div>

                        <img src="{{ asset('asset/robysep.png') }}" alt="Team Member"
                            class="absolute left-[55%] bottom-0 w-auto h-[320px] object-cover rounded-3xl drop-shadow-lg transform -translate-x-1/2" />
                    </div>

                    <div class="mt-6 max-w-[240px] text-center sm:text-left">
                        <div class="flex items-center justify-center sm:justify-center mb-2">
                            <span class="text-[30px] font-medium text-black">CTO</span>
                        </div>
                        <p class="text-[#5E5E5E] leading-relaxed mb-4 text-center text-[20px]">
                            Overseeing core technology development and project technical strategy
                        </p>
                        <a href="{{ route('team.member2') }}" class="text-blue-600 font-bold hover:underline text-sm">
                            Find out more &rarr;
                        </a>
                    </div>
                </div>

                {{-- Anggota 3: Rifqi --}}
                <div class="team-card flex flex-col items-center">
                    <div
                        class="relative w-[240px] h-[260px] group cursor-pointer transform transition-transform duration-300 hover:-translate-y-[30px]">
                        <div
                            class="bg-[#000000] rounded-3xl shadow-lg w-full h-full transition-all duration-300 group-hover:shadow-2xl">
                        </div>

                        <img src="{{ asset('asset/rifqima.png') }}" alt="Team Member"
                            class="absolute left-1/2 bottom-0 w-auto h-[350px] object-cover rounded-3xl drop-shadow-lg transform -translate-x-1/2" />
                    </div>

                    <div class="mt-6 max-w-[240px] text-center sm:text-left">
                        <div class="flex items-center justify-center text-center sm:justify-center mb-2">
                            <span class="text-[30px] font-medium text-black">Backend Developer</span>
                        </div>
                        <p class="text-[#5E5E5E] leading-relaxed mb-4 text-center text-[20px]">
                            Responsible for architecting and implementing server-side systems
                        </p>
                        <a href="{{ route('team.member3') }}" class="text-blue-600 font-bold hover:underline text-sm">
                            Find out more &rarr;
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- SECTION 5 - GET READY --}}
    <section id="get-ready-section" class="px-4 py-16 relative w-full min-h-screen">
        <div class="absolute top-0 left-0 w-full h-full z-0">
            {{-- Jangan tambahkan class pada spline-viewer, cukup biarkan ia mengisi wrapper div --}}
            <spline-viewer url="https://prod.spline.design/ik78JS8lLV3pxy7D/scene.splinecode"></spline-viewer>
            <div class="absolute bottom-4 right-4 w-40 h-10 bg-white z-10"></div>
        </div>

        <div class="relative z-10 min-h-screen flex flex-col items-center justify-center text-center">

            <div class="text-black font-light" style="">
                <h2 class="get-ready text-[100px] leading-tight">LETS</h2>
                <h2 class="get-ready text-[100px] leading-tight">GET</h2>
                <h2 class="get-ready text-[100px] leading-tight">STARTED</h2>
            </div>

            <a href="#"
                class="get-ready mt-8 px-8 py-3 bg-black text-white text-sm font-light tracking-widest rounded-full hover:bg-gray-800 transition-colors duration-300">
                START
            </a>
        </div>
    </section>
@endsection
