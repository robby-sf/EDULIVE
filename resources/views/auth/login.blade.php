<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    {{-- Menggunakan CDN untuk Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Aset CSS jika ada (opsional) --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    {{-- Font Awesome untuk Ikon --}}
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
    <div class="w-full min-h-screen relative overflow-hidden flex items-center justify-center">
        <div class="absolute w-56 h-56 bg-blue-600/25 rounded-full blur-[114px]" style="left: 331px; top: 366px;"></div>
        <div class="absolute w-56 h-56 bg-blue-600/25 rounded-full blur-[114px]" style="left: 881px; top: 627px;"></div>
        <div class="absolute w-[532px] h-[532px] rounded-full border border-gray-800"
            style="left: -273px; top: -272px;"></div>
        <div class="absolute w-[532px] h-[532px] rounded-full border border-gray-800"
            style="right: -273px; bottom: -272px;"></div>

        <div
            class="w-[550px] h-auto bg-white/5 rounded-2xl border border-white/20 shadow-2xl backdrop-blur-xl p-10 relative fade-in-down">

            <div class="absolute left-1/2 -top-7 -translate-x-1/2">
                <div
                    class="w-14 h-14 bg-gradient-to-l from-gray-300 to-stone-500 rounded-full flex items-center justify-center">
                    <svg width="46" height="39" viewBox="0 0 46 39" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M22.7627 36.2894L0 26.0686C3.08067 29.7065 8.84445 33.9641 14.2053 36.2894C17.9706 37.9225 20.3471 38.0626 22.7627 38.7146V36.2894Z"
                            fill="#616161" />
                        <path
                            d="M22.5327 36.2894L45.5254 26.0686C42.4136 29.7065 36.5916 33.9641 31.1766 36.2894C27.3733 37.9225 24.9728 38.0626 22.5327 38.7146V36.2894Z"
                            fill="#616161" />
                        <rect x="6.93701" y="0.285381" width="30.7839" height="20.3781" rx="10.189" fill="black" />
                        <rect x="10.3467" y="2.88684" width="24.3722" height="15.1344" rx="7.56718" fill="white" />
                        <rect x="11.9189" y="4.45925" width="21.2274" height="11.9896" rx="5.99478" fill="black" />
                        <rect x="14.8325" y="9.49279" width="5.39358" height="2.69679"
                            transform="rotate(-45 14.8325 9.49279)" fill="white" />
                        <rect width="5.39358" height="2.69679"
                            transform="matrix(-0.707107 -0.707107 -0.707107 0.707107 29.9922 9.49279)" fill="white" />
                    </svg>

                </div>
            </div>

            <div class="flex flex-col items-center pt-10">
                <h1 class="text-white text-3xl font-semibold mb-12">WELCOME BACK</h1>

                <form method="POST" action="{{ route('login') }}" class="w-full flex flex-col items-center">
                    @csrf
                    <div class="relative w-96 mb-6 transition-all duration-300">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="fas fa-envelope text-zinc-500"></i>
                        </div>
                        <input name="email" type="email" placeholder="Email Address" value="{{ old('email') }}"
                            required autocomplete="email" autofocus
                            class="w-full h-12 bg-white/5 rounded-lg border border-white/10 pl-12 pr-4 text-zinc-300 placeholder-zinc-500 font-light focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all duration-300">
                             @error('email')
                            <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative w-96 mb-6 transition-all duration-300">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="fas fa-lock text-zinc-500"></i>
                        </div>
                        <input id="password" name="password" type="password" placeholder="Password" required
                            autocomplete="current-password"
                            class="w-full h-12 bg-white/5 rounded-lg border border-white/10 pl-12 pr-12 text-zinc-300 placeholder-zinc-500 font-light focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all duration-300">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 cursor-pointer"
                            onclick="togglePassword()">
                            <i id="eyeIcon" class="fas fa-eye text-zinc-500 hover:text-white transition"></i>
                        </div>
                        @error('password')
                            <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-96 h-12 bg-gradient-to-r from-stone-500 to-gray-300 rounded-lg text-white font-normal text-base mb-6 hover:opacity-90 transition-opacity duration-200">
                        Login
                    </button>

                    <div class="w-96 flex justify-between items-center mb-12">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember" type="checkbox"
                                class="w-5 h-5 bg-transparent rounded border border-stone-500 text-stone-500 focus:ring-stone-500 cursor-pointer">
                            <label for="remember-me"
                                class="ml-2 text-zinc-400 text-base font-light cursor-pointer">Remember
                                me</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-white text-base font-medium hover:underline">Forgot password</a>
                        @endif
                    </div>
                </form>

                <p class="text-base font-light">
                    <span class="text-zinc-500">Don't have an account yet? </span>
                    <a href="{{ route('register') }}" class="text-white font-semibold hover:underline">Sign Up</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>
