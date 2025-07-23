<footer class="bg-white border-t border-gray-200 mt-auto">
    <div class="container mx-auto px-6 py-8">
        <div class="flex flex-col items-center text-center">
            {{-- Logo dan Nama Aplikasi --}}
            <a href="{{ route('homepage') }}" class="flex items-center gap-2 mb-4">
                <svg width="43" height="36" viewBox="0 0 46 39" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                     <g id="LOGO CIRCLE">
                         <g id="LOGO">
                             <path id="Vector 1"
                                 d="M22.7627 36.5748L0 26.3541C3.08067 29.9919 8.84445 34.2495 14.2053 36.5748C17.9706 38.2079 20.3471 38.348 22.7627 39V36.5748Z"
                                 fill="#616161" />
                             <path id="Vector 2"
                                 d="M22.5328 36.5748L45.5255 26.3541C42.4137 29.9919 36.5917 34.2495 31.1767 36.5748C27.3734 38.2079 24.9729 38.348 22.5328 39V36.5748Z"
                                 fill="#616161" />
                             <rect id="Rectangle 3" x="6.93721" y="0.570801" width="30.7839" height="20.3781"
                                 rx="10.189" fill="black" />
                             <g id="Group 2">
                                 <rect id="Rectangle 2" x="10.3467" y="3.17224" width="24.3722" height="15.1344"
                                     rx="7.56718" fill="white" />
                                 <rect id="Rectangle 3_2" x="11.9191" y="4.74463" width="21.2274" height="11.9896"
                                     rx="5.99478" fill="black" />
                                 <g id="Group 1">
                                     <rect id="Rectangle 4" x="14.8323" y="9.7782" width="5.39358" height="2.69679"
                                         transform="rotate(-45 14.8323 9.7782)" fill="white" />
                                     <rect id="Rectangle 5" width="5.39358" height="2.69679"
                                         transform="matrix(-0.707107 -0.707107 -0.707107 0.707107 29.9918 9.7782)"
                                         fill="white" />
                                 </g>
                             </g>
                         </g>
                     </g>
                 </svg>
                <span class="text-black text-2xl font-semibold tracking-wider">EDULIVE</span>
            </a>

            <div class="flex flex-wrap justify-center gap-x-6 gap-y-2 mb-4 text-gray-600 font-light">
                <a href="{{ route('homepage') }}" class="hover:text-black transition-colors">Home</a>
                <a href="{{ route('belajar')}}" class="hover:text-black transition-colors">Learning</a>
                <a href="{{ route('dashboard.statistic')}}" class="hover:text-black transition-colors">Statistic</a>
                <a href="{{ route('homepage') }}/#features-section" class="hover:text-black transition-colors">Features</a>
                <a href="{{ route('homepage') }}/#team-section" class="hover:text-black transition-colors">Team Member</a>
            </div>

            <p class="text-sm text-gray-500">
                &copy; {{ date('2025') }} EDULIVE. All Rights Reserved.
            </p>
        </div>
    </div>
</footer>
