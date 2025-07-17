import "./bootstrap";

const menuToggle = document.getElementById("menu-toggle");
const menu = document.getElementById("menu");
const menuOverlay = document.getElementById("menu-overlay");

if (menuToggle && menu && menuOverlay) {
    menuToggle.addEventListener("click", () => {
        menu.classList.toggle("hidden");
        menuOverlay.classList.toggle("hidden");
    });

    // Close the menu when clicking outside of it
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

// Profile Dropdown
document.addEventListener('DOMContentLoaded', function () {
    const profileButton = document.getElementById('profile-menu-button');
    const profileDropdown = document.getElementById('profile-menu-dropdown');


    if (profileButton && profileDropdown) {

        profileButton.addEventListener('click', function (event) {
            event.stopPropagation();
            profileDropdown.classList.toggle('hidden');
            if (!profileDropdown.classList.contains('hidden')) {
                setTimeout(() => {
                    profileDropdown.classList.add('opacity-100', 'scale-100');
                    profileDropdown.classList.remove('opacity-0', 'scale-95');
                }, 10);
            } else {
                profileDropdown.classList.remove('opacity-100', 'scale-100');
                profileDropdown.classList.add('opacity-0', 'scale-95');
            }
        });

        window.addEventListener('click', function (event) {
            if (!profileDropdown.contains(event.target) && !profileButton.contains(event.target)) {
                if (!profileDropdown.classList.contains('hidden')) {
                     profileDropdown.classList.remove('opacity-100', 'scale-100');
                     profileDropdown.classList.add('opacity-0', 'scale-95');

                     setTimeout(() => {
                        profileDropdown.classList.add('hidden');
                     }, 300);
                }
            }
        });
    }
});

// EventListener Section 1 HOMEPAGE
document.addEventListener('DOMContentLoaded', function() {
    const titleText = "EDULIVE";
    const taglineText = "Elevate Your Learning Experience With AI";
    const titleContainer = document.getElementById('animated-title');
    const taglineContainer = document.getElementById('animated-tagline');

    if (titleContainer && taglineContainer) {
        titleText.split('').forEach((char, index) => {
            const span = document.createElement('span');
            span.innerHTML = char === ' ' ? '&nbsp;' : char;
            span.style.transitionDelay = `${index * 0.05}s`;
            titleContainer.appendChild(span);
        });

        const words = taglineText.split(' ');
        words.forEach((word, index) => {
            const span = document.createElement('span');
            span.textContent = word;
            span.style.transitionDelay = `${(titleText.length * 0.05) + (index * 0.1)}s`;
            taglineContainer.appendChild(span);

            if (index < words.length - 1) {
                const space = document.createElement('span');
                space.innerHTML = '&nbsp;';
                space.style.transitionDelay = `${(titleText.length * 0.05) + (index * 0.1)}s`;
                taglineContainer.appendChild(space);
            }
        });
        setTimeout(() => {
            titleContainer.classList.add('visible');
            taglineContainer.classList.add('visible');
        }, 100);
    }
});

//spline load section 1 HOMEPAGE (Not Affected For Spline Now)
document.addEventListener('DOMContentLoaded', function() {
    const splineModel = document.getElementById('spline-model');

    if (splineModel) {
        splineModel.addEventListener('load', () => {
            splineModel.classList.add('spline-visible');
        });
    }
});

// EventListener Section 2 HOMEPAGE
document.addEventListener('DOMContentLoaded', () => {
    // 1. Ambil elemen section pembungkus dan semua elemen teks
    const parallaxSection = document.getElementById('parallax-section');
    const revealTexts = document.querySelectorAll('.reveal-text');

    // Pastikan elemennya ada sebelum melanjutkan
    if (!parallaxSection || revealTexts.length === 0) return;

    // 2. Loop setiap elemen teks untuk menambahkan event 'mouseenter'
    revealTexts.forEach(textElement => {
        textElement.addEventListener('mouseenter', () => {
            // Saat mouse masuk, tambahkan kelas 'visible' untuk memunculkannya
            textElement.classList.add('visible');
        });
        // Tidak ada 'mouseleave' di sini agar teks tetap terlihat
    });

    // 3. Tambahkan satu event 'mouseleave' pada section pembungkus
    parallaxSection.addEventListener('mouseleave', () => {
        // Saat mouse keluar dari seluruh section, reset semua teks
        revealTexts.forEach(el => {
            el.classList.remove('visible');
        });
    });
});

// EventListener Section 4 HOMEPAGE
document.addEventListener('DOMContentLoaded', () => {
    const teamSection = document.querySelector('#team-section');
    const teamCards = document.querySelectorAll('.team-card');

    if (!teamSection || teamCards.length === 0) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                teamCards.forEach((card, index) => {
                    // Delay dibuat berbeda untuk setiap kartu agar muncul satu per satu
                    setTimeout(() => {
                        card.classList.add('is-visible');
                    }, index * 200); // Jeda 200ms
                });
                // Hentikan observasi setelah animasi berjalan agar tidak berulang
                observer.unobserve(teamSection);
            }
        });
    }, {
        threshold: 0.2 // Animasi akan berjalan saat 20% dari section terlihat
    });

    observer.observe(teamSection);
});

// EventListener Section 5 HOMEPAGE
document.addEventListener('DOMContentLoaded', () => {
    const section = document.querySelector('#get-ready-section');
    const words = document.querySelectorAll('.get-ready');

    if (!section || words.length === 0) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                words.forEach((word, index) => {
                    setTimeout(() => {
                        word.classList.add('visible');
                    }, index * 400); // Delay 400ms antar kata
                });
                observer.unobserve(section); // Hentikan observasi setelah animasi berjalan
            }
        });
    }, {
        threshold: 0.5 // Animasi berjalan saat 50% section terlihat
    });

    observer.observe(section);
});



document.addEventListener('DOMContentLoaded', function() {
        console.log('Profile page loaded. Ready for pop-up logic.');

        // Contoh: Event listener untuk tombol "Change Profile"
        const editBiodataBtn = document.getElementById('edit-biodata-btn');
        if (editBiodataBtn) {
            editBiodataBtn.addEventListener('click', function() {
                // Tampilkan modal/pop-up untuk edit biodata
                alert('Logic to open Edit Biodata pop-up goes here!');
            });
        }
    });
