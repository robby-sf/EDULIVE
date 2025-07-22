<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'EDULIVE')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>[x-cloak] { display: none !important; }</style>


    {{-- HANYA GUNAKAN INI: Memuat semua CSS & JS melalui Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Link Font & Ikon bisa tetap ada --}}
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> --}}
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.10.27/build/spline-viewer.js"></script>
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.10.32/build/spline-viewer.js"></script>

    <style>
        body {
            background-color: #ffffff;
        }

        /* @keyframes fade-in-down {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-down {
            animation: fade-in-down 1s ease-out both;
        } */
    </style>

    @stack('styles')
</head>

<body class="antialiased">

    @include('partials.header')

    <div id="menu-overlay" class="hidden fixed inset-0 bg-black/50 z-40"></div>

    <main>
        @yield('content')
    </main>

    @include('partials.notification')
    {{-- <footer class="mt-20 py-8 border-t border-white/10 text-center text-sm text-gray-400">
        &copy; {{ date('Y') }} EDULIVE. All rights reserved.
    </footer> --}}
    @stack('scripts')
</body>
@stack('scripts')
</html>