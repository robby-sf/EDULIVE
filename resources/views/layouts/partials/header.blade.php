<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EDULIVE HEADER</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap">

</head>

<body class="bg-white font-poppins">
    <header class=bg-white shadow-sm>
        <nav class=container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <a href="/" class="flex items-center gap-2">
                    <svg width="23" height="13" viewBox="0 0 23 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M22.7627 10.5748L0 0.354065C3.08067 3.99195 8.84445 8.24955 14.2053 10.5748C17.9706 12.2079 20.3471 12.348 22.7627 13V10.5748Z"
                            fill="#616161" />
                    </svg>
                    <span class="text-[#000000] text-3xl font-semibold tracking-wider">EDULIVE</span>
                </a>
            </div>

            <div class="hidden md:flex item-center space-x-8">
                <a href="#"
                    class="text-[#000000] font-light tracking-wide items-center hover:text-gray-600 transition-colors duration-300">HOME</a>
                <a href="#"
                    class="text-[#000000] font-light tracking-wide items-center hover:text-gray-600 transition-colors duration-300">LEARNING</a>
                <div class="relative group">
                    <button
                        class="text-[#000000] font-light tracking-wide items-center hover:text-gray-600 transition-colors duration-300 focus:outline-none">
                        DASHBOARD
                        <svg class="w-4 h-4 ml-1 transform group-hover:rotate-180 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                </div>
                <a href="#"
                    class="text-[#000000] font-light tracking-wide items-center hover:text-gray-600 transition-colors duration-300">CHATBOT</a>
                <a href="#"
                    class="text-[#000000] font-light tracking-wide items-center hover:text-gray-600 transition-colors duration-300">ABOUT
                    US</a>
                <a href="#" class=""></a>
            </div>

            <div class="hidden md:flex items-center space-x-4">
                <a href="#"
                    class="text-[#000000] font-light tracking-wide hove:text-gray-600 transition-colors duration-300">SIGN
                    IN</a>
                <a href="#"
                    class="w-28 h-10 px-7 py-2.5 bg-black rounded-[30px] inline-flex justify-center items-center gap-2.5 hover:bg-gray-800 transition-colors duration-300">
                    SIGN UP
                </a>
                <div
                    class="w-28 h-10 px-7 py-2.5 bg-black rounded-[30px] inline-flex justify-center items-center gap-2.5">
                    <div class="justify-start text-white text-base font-light font-['Poppins'] tracking-wide">SIGN UP
                    </div>
                </div>
            </div>

        </nav>
    </header>
</body>
</html>
