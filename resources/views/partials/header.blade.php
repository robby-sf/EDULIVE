 <svg class="absolute hidden">
     <defs>
         <filter id="molten">
             <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
             <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 30 -10"
                 result="molten" />
         </filter>
     </defs>
 </svg>

 <header class="bg-white shadow-sm border-b border-gray-200">
     {{-- logo  --}}
     <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
         <div class="flex items-center">
             <a href="/" class="flex items-center gap-2">
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
                 <span class="text-[#000000] text-3xl font-semibold tracking-wider">EDULIVE</span>
             </a>
         </div>
         {{-- mobile view --}}
         <div class="md:hidden flex items-center">
             <button id="menu-toggle" class="text-[#000000] focus:outline-none">
                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                     </path>
                 </svg>
             </button>
         </div>

         {{-- Navigation Menu --}}
         <div id="menu"
             class="hidden md:flex md:items-center md:space-x-8 absolute md:relative top-16 left-0 md:top-0 w-full md:w-auto bg-white shadow-md md:shadow-none py-4 md:py-0 z-50">
             <div class="flex flex-col md:flex-row md:items-center space-y-4 md:space-y-0 md:space-x-8 px-4 md:px-0">
                 <a href="{{ route('homepage') }}"
                     class="text-[#000000] font-extralight tracking-wide hover:text-gray-600 transition-colors duration-300">HOME</a>
                 <a href="#"
                     class="text-[#000000] font-extralight tracking-wide hover:text-gray-600 transition-colors duration-300">LEARNING</a>

                 <div class="relative">
                     <button id="dashboard-toggle"
                         class="cursor-pointer text-black font-extralight tracking-wide w-full flex items-center focus:outline-none">
                         DASHBOARD
                         <svg id="dashboard-chevron" class="w-4 h-4 ml-1 transition-transform duration-300"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                         </svg>
                     </button>

                     <div id="mobile-dashboard-menu" class="hidden md:hidden pt-2 pl-4 border-b border-gray-200">
                         <a href="#"
                             class="block py-2 px-2 text-gray-700 tracking-wide font-extralight hover:bg-gray-100 rounded">LEARNING
                             STATISTIC</a>
                         <a href="#"
                             class="block py-2 px-2 text-gray-700 tracking-wide font-extralight hover:bg-gray-100 rounded">LEARNING
                             HISTORY</a>
                         <a href="{{ route('profile.index') }}"
                             class="block py-2 px-2 text-gray-700 tracking-wide font-extralight hover:bg-gray-100 rounded">MY
                             PROFILE</a>
                     </div>

                     <div id="desktop-dashboard-menu"
                         class="hidden absolute left-1/2 -translate-x-1/2 top-full mt-4 w-56 transition-all duration-300 z-50">

                         <div class="absolute inset-0 rounded-2xl" style="filter: url(#molten);">
                             <div class="w-full h-full bg-black rounded-2xl"></div>
                         </div>

                         <div class="relative z-10 flex flex-col items-center divide-y divide-white/10">
                             <a href="#"
                                 class="w-full h-12 flex items-center justify-center text-white text-sm font-medium tracking-wide transition-all duration-300 ease-in-out delay-100 hover:bg-white/10 rounded-t-2xl">
                                 LEARNING STATISTIC
                             </a>
                             <a href="#"
                                 class="w-full h-12 flex items-center justify-center text-white text-sm font-medium tracking-wide transition-all duration-300 ease-in-out delay-200 hover:bg-white/10">
                                 LEARNING HISTORY
                             </a>
                             <a href="{{ route('profile.index') }}"
                                 class="w-full h-12 flex items-center justify-center text-white text-sm font-medium tracking-wide transition-all duration-300 ease-in-out delay-300 hover:bg-white/10 rounded-b-2xl">
                                 MY PROFILE
                             </a>
                         </div>
                     </div>
                 </div>

                 <a href="#"
                     class="text-[#000000] font-extralight tracking-wide hover:text-gray-600 transition-colors duration-300">CHATBOT</a>
                 <a href="#"
                     class="text-[#000000] font-extralight tracking-wide hover:text-gray-600 transition-colors duration-300">ABOUT
                     US</a>
             </div>

             {{-- Mobile Button SignIn/SignUp --}}
             <div class="md:hidden flex flex-col space-y-4 px-4 mt-4">
                 @guest
                     <a href="{{ route('login') }}"
                         class="text-[#000000] font-extralight tracking-wide hover:text-gray-600 transition-colors duration-300 text-center">SIGN
                         IN</a>
                     <a href="{{ route('register') }}"
                         class="px-7 py-2.5 bg-black rounded-[30px] inline-flex justify-center items-center gap-2.5 text-white hover:bg-gray-800 transition-colors duration-300 font-extralight tracking-wide">SIGN
                         UP</a>
                 @else
                     <span class="text-center font-semibold">{{ Auth::user()->name }}</span>
                     <form method="POST" action="{{ route('logout') }}" class="text-center">
                         @csrf
                         <button type="submit"
                             class="w-full px-7 py-2.5 bg-red-500 rounded-[30px] text-white hover:bg-red-600 transition-colors duration-300 font-extralight tracking-wide">
                             LOGOUT
                         </button>
                     </form>
                 @endguest
             </div>
         </div>

            {{-- Desktop Button SignIn/SignUp --}}
         <div class="hidden md:flex items-center">
            @guest
                {{-- TAMPILKAN INI JIKA PENGGUNA ADALAH TAMU (BELUM LOGIN) --}}
                <div class="relative group items-center rounded-full bg-white p-1.5 flex">
                    <a href="{{ route('login') }}" class="peer/signin relative z-10 py-2.5 px-7 font-extralight tracking-wide text-black transition-colors duration-300 group-hover:text-black hover:text-white">
                        SIGN IN
                    </a>
                    <a href="{{ route('register') }}" class="peer/signup relative z-10 py-2.5 px-7 font-extralight tracking-wide text-white transition-colors duration-300 group-hover:text-black hover:text-white">
                        SIGN UP
                    </a>
                    <span class="absolute z-0 top-1.5 bottom-1.5 w-[110px] rounded-full bg-black transition-transform duration-300 ease-in-out translate-x-[115px] peer-hover/signin:translate-x-0 peer-hover/signup:translate-x-[115px]"></span>
                </div>
            @else
                {{-- Tampilan Profil Setelah Login --}}
                <div class="flex items-center space-x-4">
                    <span class="text-black font-medium">{{ Auth::user()->name }}</span>
                    {{-- Tombol untuk membuka dropdown --}}
                    <div class="relative">
                        <button id="profile-menu-button" class="w-10 h-10 bg-black rounded-full flex items-center justify-center text-white font-bold cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </button>

                        {{-- Dropdown Menu --}}
                        <div id="profile-menu-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden transition-all duration-300 ease-in-out transform opacity-0 scale-95">
                            <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </nav>
</header>
