<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-neutral-950">

<div class="w-full min-h-screen flex items-center justify-center p-4">
    <div class="w-56 h-56 left-[331px] top-[366px] absolute bg-blue-600/25 rounded-full blur-[114.40px]"></div>
    <div class="w-56 h-56 left-[881px] top-[627px] absolute bg-blue-600/25 rounded-full blur-[114.40px]"></div>
    <div class="w-[532px] h-[532px] left-[-273px] top-[-272px] absolute rounded-full border border-gray-800"></div>
    <div class="w-[532px] h-[532px] right-[-273px] bottom-[-272px] absolute rounded-full border border-gray-800"></div>

    <div class="w-[550px] bg-neutral-600/10 rounded-2xl shadow-[0px_4px_101.6px_0px_rgba(0,0,0,0.25)] border-[3px] border-white/50 backdrop-blur-[76.45px]">
        <div class="p-12 flex flex-col items-center">

            <div class="mb-4 relative w-14 h-14 bg-gradient-to-l from-gray-300 to-stone-500 rounded-full flex items-center justify-center">
                 <div class="w-8 h-5 absolute top-[11.57px] bg-black rounded-[19px]">
                    <div class="w-6 h-3.5 absolute top-[2.57px] left-[3.37px] bg-white rounded-2xl">
                       <div class="w-5 h-3 absolute top-[1.55px] left-[1.56px] bg-black rounded-xl"></div>
                    </div>
                 </div>
            </div>
            <h1 class="text-white text-3xl font-semibold mb-8">CREATE ACCOUNT</h1>

            <form method="POST" action="{{ route('register') }}" class="w-96 space-y-6">
                @csrf

                <div>
                    <label for="name" class="text-white text-xs font-medium font-['Poppins']">Fullname</label>
                    <input id="name" name="name" type="text" placeholder="Enter your fullname" value="{{ old('name') }}" required
                           class="mt-1 w-full h-12 px-4 bg-white/5 rounded-lg border border-white/10 text-zinc-300 placeholder-zinc-600 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('name')
                        <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="text-white text-xs font-medium font-['Poppins']">Email Address</label>
                    <input id="email" name="email" type="email" placeholder="Enter your email" value="{{ old('email') }}" required
                           class="mt-1 w-full h-12 px-4 bg-white/5 rounded-lg border border-white/10 text-zinc-300 placeholder-zinc-600 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('email')
                        <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="text-white text-xs font-medium font-['Poppins']">Password</label>
                    <input id="password" name="password" type="password" placeholder="Enter your password" required autocomplete="new-password"
                           class="mt-1 w-full h-12 px-4 bg-white/5 rounded-lg border border-white/10 text-zinc-300 placeholder-zinc-600 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('password')
                        <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="text-white text-xs font-medium font-['Poppins']">Re enter password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Enter your password" required autocomplete="new-password"
                           class="mt-1 w-full h-12 px-4 bg-white/5 rounded-lg border border-white/10 text-zinc-300 placeholder-zinc-600 focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <button type="submit" class="w-full h-12 bg-gradient-to-r from-stone-500 to-gray-300 rounded-lg text-white text-base font-normal hover:opacity-90 transition-opacity">
                    Create Account
                </button>
            </form>

            <p class="mt-8">
                <span class="text-zinc-600 text-base font-light font-['Poppins']">Already have account? </span>
                <a href="{{ route('login') }}" class="text-white text-base font-semibold font-['Poppins'] hover:underline">Sign In</a>
            </p>

        </div>
    </div>
</div>

</body>
</html>
