<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'EDULIVE')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body(
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
        )
        @keyframes fade-in-down {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down {
            animation: fade-in-down 0.5s ease-out both;
        }
    </style>

    @stack('styles')
</head>
<body class="antialiased font-['Poppins']">

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    <footer class="mt-20 py-8 border-t border-white/10 text-center text-sm text-gray-400">
        &copy; {{ date('Y') }} EDULIVE. All rights reserved.
    </footer>
</body>
</html>
