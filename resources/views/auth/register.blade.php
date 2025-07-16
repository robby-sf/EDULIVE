<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .fade-in-down {
            animation: fadeInDown 1s ease-out forwards;
        }

        @keyframes fadeInDown {
            0% {
                opacity: 0;
                transform: translateY(-30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-neutral-950 font-poppins">
    <div class="w-full min-h-screen relative overflow-hidden flex items-center justify-center p-4">
        {{-- Background Elements --}}
        <div class="absolute w-56 h-56 bg-blue-600/25 rounded-full blur-[114px]" style="left: 331px; top: 366px;"></div>
        <div class="absolute w-56 h-56 bg-blue-600/25 rounded-full blur-[114px]" style="left: 881px; top: 627px;"></div>
        <div class="absolute w-[532px] h-[532px] rounded-full border border-gray-800" style="left: -273px; top: -272px;"></div>
        <div class="absolute w-[532px] h-[532px] rounded-full border border-gray-800" style="right: -273px; bottom: -272px;"></div>

        <div class="w-[550px] bg-white/5 rounded-2xl border border-white/20 shadow-2xl backdrop-blur-xl p-10 relative fade-in-down">
            {{-- Logo --}}
            <div class="absolute left-1/2 -top-7 -translate-x-1/2">
                <div class="w-14 h-14 bg-gradient-to-l from-gray-300 to-stone-500 rounded-full flex items-center justify-center">
                    <svg width="46" height="39" viewBox="0 0 46 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.7627 36.2894L0 26.0686C3.08067 29.7065 8.84445 33.9641 14.2053 36.2894C17.9706 37.9225 20.3471 38.0626 22.7627 38.7146V36.2894Z" fill="#616161" />
                        <path d="M22.5327 36.2894L45.5254 26.0686C42.4136 29.7065 36.5916 33.9641 31.1766 36.2894C27.3733 37.9225 24.9728 38.0626 22.5327 38.7146V36.2894Z" fill="#616161" />
                        <rect x="6.93701" y="0.285381" width="30.7839" height="20.3781" rx="10.189" fill="black" />
                        <rect x="10.3467" y="2.88684" width="24.3722" height="15.1344" rx="7.56718" fill="white" />
                        <rect x="11.9189" y="4.45925" width="21.2274" height="11.9896" rx="5.99478" fill="black" />
                        <rect x="14.8325" y="9.49279" width="5.39358" height="2.69679" transform="rotate(-45 14.8325 9.49279)" fill="white" />
                        <rect width="5.39358" height="2.69679" transform="matrix(-0.707107 -0.707107 -0.707107 0.707107 29.9922 9.49279)" fill="white" />
                    </svg>
                </div>
            </div>

            <div class="flex flex-col items-center pt-10">
                <h1 class="text-white text-3xl font-semibold mb-12">CREATE ACCOUNT</h1>

                <form method="POST" action="{{ route('register') }}" class="w-full flex flex-col items-center">
                    @csrf
                    {{-- Full Name --}}
                    <div class="relative w-96 mb-6">
                        <input name="name" type="text" placeholder="Enter your fullname" value="{{ old('name') }}" required class="w-full h-12 bg-white/5 rounded-lg border border-white/10 pl-4 pr-4 text-zinc-300 placeholder-zinc-500 font-light focus:outline-none focus:ring-1 focus:ring-blue-500">
                        @error('name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="relative w-96 mb-6">
                        <input name="email" type="email" placeholder="Enter your email" value="{{ old('email') }}" required class="w-full h-12 bg-white/5 rounded-lg border border-white/10 pl-4 pr-4 text-zinc-300 placeholder-zinc-500 font-light focus:outline-none focus:ring-1 focus:ring-blue-500">
                        @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="relative w-96 mb-6">
                        <input id="password" name="password" type="password" placeholder="Enter your password" required class="w-full h-12 bg-white/5 rounded-lg border border-white/10 pl-4 pr-4 text-zinc-300 placeholder-zinc-500 font-light focus:outline-none focus:ring-1 focus:ring-blue-500">
                        @error('password')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="relative w-96 mb-6">
                        <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Re enter password" required class="w-full h-12 bg-white/5 rounded-lg border border-white/10 pl-4 pr-4 text-zinc-300 placeholder-zinc-500 font-light focus:outline-none focus:ring-1 focus:ring-blue-500">
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="w-96 h-12 bg-gradient-to-r from-stone-500 to-gray-300 rounded-lg text-white font-normal text-base mb-6 hover:opacity-90 transition-opacity duration-200">
                        Create Account
                    </button>
                </form>

                <p class="text-base font-light">
                    <span class="text-zinc-500">Already have an account? </span>
                    <a href="{{ route('login') }}" class="text-white font-semibold hover:underline">Sign In</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>