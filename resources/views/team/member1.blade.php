@extends('layouts.app')


@section('title', 'Profil - Ravelin Lutfhan')


@section('content')
    <div class="w-full bg-gradient-to-br from-slate-50 to-gray-200 px-4 py-16 sm:py-40">

        <div id="profile-card"
            class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl p-8 lg:p-10 mx-auto relative overflow-hidden flex flex-col lg:flex-row items-center gap-10 transition-transform duration-300 ease-out hover:scale-105">

            <a href="{{ url()->previous() }}"
                class="absolute top-5 left-5 h-10 w-10 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-100 hover:text-black transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>

            <div class="relative w-full max-w-xs lg:w-2/5 flex-shrink-0">
                <div class="bg-gradient-to-t from-blue-600 to-blue-400 h-96 w-full rounded-2xl shadow-lg"></div>
                <img src="{{ asset('asset/ravelluth.png') }}" alt="Foto Ravelin Lutfhan"
                    class="absolute bottom-[-43px] left-1/2 -translate-x-1/2 h-[26rem] w-auto object-contain">
            </div>

            <div class="w-full lg:w-3/5 flex flex-col justify-between self-stretch">

                <div>
                    <div class="w-16 h-1 bg-blue-500 mb-4 rounded"></div>
                    <h1 class="text-4xl lg:text-5xl font-extrabold text-black tracking-tight">Ravelin Lutfhan</h1>
                    <p class="text-lg font-medium text-gray-500 mt-1">UI/UX Designer</p>
                </div>

                <div class="relative mt-6 overflow-hidden h-64">

                    <div id="desc-panel-1" class="absolute top-0 left-0 w-full transition-transform duration-500 ease-in-out">
                        <p class="text-gray-600 leading-relaxed text-justify">
                            Ravel is the UI/UX Designer responsible for creating an intuitive and engaging user experience on the EDULIVE platform.
                            He translates user needs and business goals into visually appealing and easy-to-navigate interfaces, ensuring the platform is both functional and enjoyable.
                        </p>
                    </div>

                    <div id="desc-panel-2" class="absolute top-0 left-0 w-full transition-transform duration-500 ease-in-out translate-x-full">
                        <div class="space-y-4">
                            <div class="flex items-start gap-4">
                                <span class="flex-shrink-0 flex items-center justify-center h-8 w-8 rounded-full border-2 border-gray-400 text-gray-500 font-bold text-sm mt-1">01</span>
                                <p class="text-gray-600 leading-relaxed text-justify">
                                    Conducts user research to understand their needs and behaviors.
                                </p>
                            </div>
                            <div class="flex items-start gap-4">
                                <span class="flex-shrink-0 flex items-center justify-center h-8 w-8 rounded-full border-2 border-gray-400 text-gray-500 font-bold text-sm mt-1">02</span>
                                <p class="text-gray-600 leading-relaxed text-justify">
                                    Leads the design process from ideation to implementation, ensuring a cohesive and user-centered approach.
                                </p>
                            </div>
                            <div class="flex items-start gap-4">
                                <span class="flex-shrink-0 flex items-center justify-center h-8 w-8 rounded-full border-2 border-gray-400 text-gray-500 font-bold text-sm mt-1">03</span>
                                <p class="text-gray-600 leading-relaxed text-justify">
                                    Collaborates with developers to ensure the design is implemented accurately and meets user expectations.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-200">
                    <div class="flex space-x-5">
                         <a href="mailto:ravelinlutfhanrlsp@gmail.com" class="relative group h-7 w-7">
                            <img src="{{ asset('asset/Gmailgray.png') }}" alt="Email" class="absolute inset-0 w-full h-full object-contain opacity-100 group-hover:opacity-0 transition-opacity duration-300">
                            <img src="{{ asset('asset/Gmailblue.png') }}" alt="Email Hover" class="absolute inset-0 w-full h-full object-contain opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </a>

                        <a href="https://www.instagram.com/ravelinluth/" class="relative group h-7 w-7">
                            <img src="{{ asset('asset/Instagramgray.png') }}" alt="Instagram" class="absolute inset-0 w-full h-full object-contain opacity-100 group-hover:opacity-0 transition-opacity duration-300">
                            <img src="{{ asset('asset/Instagramblue.png') }}" alt="Instagram Hover" class="absolute inset-0 w-full h-full object-contain opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </a>
                        <a href="https://www.linkedin.com/in/ravelin-syach-97460028a/" class="relative group h-7 w-7">
                            <img src="{{ asset('asset/LinkedIngray.png') }}" alt="LinkedIn" class="absolute inset-0 w-full h-full object-contain opacity-100 group-hover:opacity-0 transition-opacity duration-300">
                            <img src="{{ asset('asset/LinkedInblue.png') }}" alt="LinkedIn Hover" class="absolute inset-0 w-full h-full object-contain opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </a>
                    </div>

                    <a href="#" id="toggle-description-btn"
                        class="h-12 w-12 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-100 hover:text-black transition-all duration-300">
                        <svg id="toggle-arrow-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-7 h-7 transition-transform duration-500 ease-in-out">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection

{{-- Mendorong script khusus halaman ini ke dalam stack 'scripts' di layout utama --}}
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggle-description-btn');
            const descPanel1 = document.getElementById('desc-panel-1');
            const descPanel2 = document.getElementById('desc-panel-2');
            const arrowIcon = document.getElementById('toggle-arrow-icon');

            let isFirstPanelVisible = true;

            if(toggleBtn) { // Pastikan tombol ada sebelum menambahkan event listener
                toggleBtn.addEventListener('click', function(event) {
                    event.preventDefault();

                    if (isFirstPanelVisible) {
                        descPanel1.classList.add('-translate-x-full');
                        descPanel2.classList.remove('translate-x-full');
                        descPanel2.classList.add('translate-x-0');
                        arrowIcon.classList.add('rotate-180');
                    } else {
                        descPanel1.classList.remove('-translate-x-full');
                        descPanel2.classList.remove('translate-x-0');
                        descPanel2.classList.add('translate-x-full');
                        arrowIcon.classList.remove('rotate-180');
                    }

                    isFirstPanelVisible = !isFirstPanelVisible;
                });
            }
        });
    </script>
@endpush
