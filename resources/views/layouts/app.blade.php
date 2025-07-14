<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'EDULIVE')</title>

    {{-- HANYA GUNAKAN INI: Memuat semua CSS & JS melalui Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Link Font & Ikon bisa tetap ada --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
        }

        @keyframes fade-in-down {
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
            animation: fade-in-down 0.5s ease-out both;
        }
    </style>

    @stack('styles')
</head>

<body class="antialiased">

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    <footer class="mt-20 py-8 border-t border-white/10 text-center text-sm text-gray-400">
        &copy; {{ date('Y') }} EDULIVE. All rights reserved.
    </footer>
</body>

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

</html>
