<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EDULIVE HEADER</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
    </style>
</head>

<body class="bg-white font-poppins">

    <svg class="absolute hidden">
        <defs>
            <filter id="molten">
                <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 30 -10"
                    result="molten" />
            </filter>
        </defs>
    </svg>

    <header class="bg-white shadow-sm">
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

            <div class="md:hidden flex items-center">
                <button id="menu-toggle" class="text-[#000000] focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>

            <div id="menu"
                class="hidden md:flex md:items-center md:space-x-8 absolute md:relative top-16 left-0 md:top-0 w-full md:w-auto bg-white shadow-md md:shadow-none py-4 md:py-0">
                <div class="flex flex-col md:flex-row md:items-center space-y-4 md:space-y-0 md:space-x-8 px-4 md:px-0">
                    <a href="#"
                        class="text-[#000000] font-light tracking-wide hover:text-gray-600 transition-colors duration-300">HOME</a>
                    <a href="#"
                        class="text-[#000000] font-light tracking-wide hover:text-gray-600 transition-colors duration-300">LEARNING</a>

                    <div class="relative">
                        <button id="dashboard-toggle" class="cursor-pointer text-black font-light tracking-wide w-full flex items-center focus:outline-none">
                            DASHBOARD
                            <svg id="dashboard-chevron" class="w-4 h-4 ml-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div id="mobile-dashboard-menu" class="hidden md:hidden pt-2 pl-4 border-b border-gray-200">
                             <a href="#" class="block py-2 px-2 text-gray-700 tracking-wide font-light hover:bg-gray-100 rounded">LEARNING STATISTIC</a>
                             <a href="#" class="block py-2 px-2 text-gray-700 tracking-wide font-light hover:bg-gray-100 rounded">LEARNING HISTORY</a>
                             <a href="#" class="block py-2 px-2 text-gray-700 tracking-wide font-light hover:bg-gray-100 rounded">MY PROFILE</a>
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
                                <a href="#"
                                    class="w-full h-12 flex items-center justify-center text-white text-sm font-medium tracking-wide transition-all duration-300 ease-in-out delay-300 hover:bg-white/10 rounded-b-2xl">
                                    MY PROFILE
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="#"
                        class="text-[#000000] font-light tracking-wide hover:text-gray-600 transition-colors duration-300">CHATBOT</a>
                    <a href="#"
                        class="text-[#000000] font-light tracking-wide hover:text-gray-600 transition-colors duration-300">ABOUT
                        US</a>
                </div>
                <div class="md:hidden flex flex-col space-y-4 px-4 mt-4">
                    <a href="#"
                        class="text-[#000000] font-light tracking-wide hover:text-gray-600 transition-colors duration-300 text-center">SIGN
                        IN</a>
                    <a href="#"
                        class="px-7 py-2.5 bg-black rounded-[30px] inline-flex justify-center items-center gap-2.5 text-white hover:bg-gray-800 transition-colors duration-300 font-light tracking-wide">SIGN
                        UP</a>
                </div>
            </div>

            <div class="hidden md:flex relative group items-center rounded-full bg-white p-1.5">

                <a href="#"
                    class="
                peer/signin
                relative z-10
                py-2.5 px-7
                font-light tracking-wide
                text-black
                transition-colors duration-300
                group-hover:text-black
                hover:text-white
            ">SIGN
                    IN</a>

                <a href="#"
                    class="
                peer/signup
                relative z-10
                py-2.5 px-7
                font-light tracking-wide
                text-white
                transition-colors duration-300
                group-hover:text-black
                hover:text-white
            ">SIGN
                    UP</a>

                <span
                    class="
                absolute z-0
                top-1.5 bottom-1.5
                w-[110px]
                rounded-full
                bg-black
                transition-transform duration-300 ease-in-out
                translate-x-[115px]
                peer-hover/signin:translate-x-0
                peer-hover/signup:translate-x-[115px]
            "></span>
            </div>
        </nav>
    </header>

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('menu');

        menuToggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        const dashboardToggle = document.getElementById('dashboard-toggle');
        const mobileDashboardMenu = document.getElementById('mobile-dashboard-menu');
        const desktopDashboardMenu = document.getElementById('desktop-dashboard-menu');
        const dashboardChevron = document.getElementById('dashboard-chevron');

        dashboardToggle.addEventListener('click', (event) => {
            event.stopPropagation();

            if (window.matchMedia('(min-width: 768px)').matches) {
                // Desktop view
                desktopDashboardMenu.classList.toggle('hidden');
            } else {
                // Mobile view
                mobileDashboardMenu.classList.toggle('hidden');
            }

            dashboardChevron.classList.toggle('rotate-180');
        });

        window.addEventListener('click', (event) => {
            if (!dashboardToggle.contains(event.target)) {
                mobileDashboardMenu.classList.add('hidden');
                desktopDashboardMenu.classList.add('hidden');
                dashboardChevron.classList.remove('rotate-180');
            }
        });

    </script>

</body>

</html>
