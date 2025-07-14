import './bootstrap';

// header
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

