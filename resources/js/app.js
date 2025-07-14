import "./bootstrap";

const menuToggle = document.getElementById("menu-toggle");
const menu = document.getElementById("menu");
const menuOverlay = document.getElementById("menu-overlay");

if (menuToggle && menu && menuOverlay) {
    menuToggle.addEventListener("click", () => {
        menu.classList.toggle("hidden");
        menuOverlay.classList.toggle("hidden"); // Toggle overlay juga
    });

    // (Opsional tapi direkomendasikan) Tutup menu saat overlay diklik
    menuOverlay.addEventListener("click", () => {
        menu.classList.add("hidden");
        menuOverlay.classList.add("hidden");
    });
}
const dashboardToggle = document.getElementById("dashboard-toggle");
const mobileDashboardMenu = document.getElementById("mobile-dashboard-menu");
const desktopDashboardMenu = document.getElementById("desktop-dashboard-menu");
const dashboardChevron = document.getElementById("dashboard-chevron");

dashboardToggle.addEventListener("click", (event) => {
    event.stopPropagation();

    if (window.matchMedia("(min-width: 768px)").matches) {
        // Desktop view
        desktopDashboardMenu.classList.toggle("hidden");
    } else {
        // Mobile view
        mobileDashboardMenu.classList.toggle("hidden");
    }

    dashboardChevron.classList.toggle("rotate-180");
});

window.addEventListener("click", (event) => {
    if (!dashboardToggle.contains(event.target)) {
        mobileDashboardMenu.classList.add("hidden");
        desktopDashboardMenu.classList.add("hidden");
        dashboardChevron.classList.remove("rotate-180");
    }
});

// EventListener Section 1 HOMEPAGE
document.addEventListener('DOMContentLoaded', function() {
    const titleText = "EDULIVE";
    const taglineText = "Elevate Your Learning Experience With AI";
    const titleContainer = document.getElementById('animated-title');
    const taglineContainer = document.getElementById('animated-tagline');

    if (titleContainer && taglineContainer) {
        // 1. Animasikan judul per huruf
        titleText.split('').forEach((char, index) => {
            const span = document.createElement('span');
            span.innerHTML = char === ' ' ? '&nbsp;' : char;
            span.style.transitionDelay = `${index * 0.05}s`;
            titleContainer.appendChild(span);
        });

        // 2. Animasikan tagline per kata
        const words = taglineText.split(' ');
        words.forEach((word, index) => {
            const span = document.createElement('span');
            span.textContent = word;
            span.style.transitionDelay = `${(titleText.length * 0.05) + (index * 0.1)}s`;
            taglineContainer.appendChild(span);

            // Tambahkan spasi setelah setiap kata, kecuali kata terakhir
            if (index < words.length - 1) {
                const space = document.createElement('span');
                space.innerHTML = '&nbsp;';
                // Beri jeda animasi yang sama agar spasi tidak mengganggu alur
                space.style.transitionDelay = `${(titleText.length * 0.05) + (index * 0.1)}s`;
                taglineContainer.appendChild(space);
            }
        });

        // 3. Memicu animasi
        setTimeout(() => {
            titleContainer.classList.add('visible');
            taglineContainer.classList.add('visible');
        }, 100);
    }
});

//spline load section 1 HOMEPAGE
document.addEventListener('DOMContentLoaded', function() {
    const splineModel = document.getElementById('spline-model');

    // Pastikan elemen spline ada di halaman ini
    if (splineModel) {
        // Dengarkan event 'load' dari Spline Viewer
        splineModel.addEventListener('load', () => {
            // Tambahkan kelas untuk memicu transisi fade-in
            splineModel.classList.add('spline-visible');
        });
    }
});
