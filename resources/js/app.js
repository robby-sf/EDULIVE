import "./bootstrap";
import { parsePhoneNumberFromString, AsYouType } from 'libphonenumber-js';

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
document.addEventListener("DOMContentLoaded", function () {
    const profileButton = document.getElementById("profile-menu-button");
    const profileDropdown = document.getElementById("profile-menu-dropdown");

    if (profileButton && profileDropdown) {
        profileButton.addEventListener("click", function (event) {
            event.stopPropagation();
            profileDropdown.classList.toggle("hidden");
            if (!profileDropdown.classList.contains("hidden")) {
                setTimeout(() => {
                    profileDropdown.classList.add("opacity-100", "scale-100");
                    profileDropdown.classList.remove("opacity-0", "scale-95");
                }, 10);
            } else {
                profileDropdown.classList.remove("opacity-100", "scale-100");
                profileDropdown.classList.add("opacity-0", "scale-95");
            }
        });

        window.addEventListener("click", function (event) {
            if (
                !profileDropdown.contains(event.target) &&
                !profileButton.contains(event.target)
            ) {
                if (!profileDropdown.classList.contains("hidden")) {
                    profileDropdown.classList.remove(
                        "opacity-100",
                        "scale-100"
                    );
                    profileDropdown.classList.add("opacity-0", "scale-95");

                    setTimeout(() => {
                        profileDropdown.classList.add("hidden");
                    }, 300);
                }
            }
        });
    }
});

// EventListener Section 1 HOMEPAGE
document.addEventListener("DOMContentLoaded", function () {
    const titleText = "EDULIVE";
    const taglineText = "Elevate Your Learning Experience With AI";
    const titleContainer = document.getElementById("animated-title");
    const taglineContainer = document.getElementById("animated-tagline");

    if (titleContainer && taglineContainer) {
        titleText.split("").forEach((char, index) => {
            const span = document.createElement("span");
            span.innerHTML = char === " " ? "&nbsp;" : char;
            span.style.transitionDelay = `${index * 0.05}s`;
            titleContainer.appendChild(span);
        });

        const words = taglineText.split(" ");
        words.forEach((word, index) => {
            const span = document.createElement("span");
            span.textContent = word;
            span.style.transitionDelay = `${
                titleText.length * 0.05 + index * 0.1
            }s`;
            taglineContainer.appendChild(span);

            if (index < words.length - 1) {
                const space = document.createElement("span");
                space.innerHTML = "&nbsp;";
                space.style.transitionDelay = `${
                    titleText.length * 0.05 + index * 0.1
                }s`;
                taglineContainer.appendChild(space);
            }
        });
        setTimeout(() => {
            titleContainer.classList.add("visible");
            taglineContainer.classList.add("visible");
        }, 100);
    }
});

//spline load section 1 HOMEPAGE (Not Affected For Spline Now)
document.addEventListener("DOMContentLoaded", function () {
    const splineModel = document.getElementById("spline-model");

    if (splineModel) {
        splineModel.addEventListener("load", () => {
            splineModel.classList.add("spline-visible");
        });
    }
});

// EventListener Section 2 HOMEPAGE
document.addEventListener("DOMContentLoaded", () => {
    // 1. Ambil elemen section pembungkus dan semua elemen teks
    const parallaxSection = document.getElementById("parallax-section");
    const revealTexts = document.querySelectorAll(".reveal-text");

    // Pastikan elemennya ada sebelum melanjutkan
    if (!parallaxSection || revealTexts.length === 0) return;

    // 2. Loop setiap elemen teks untuk menambahkan event 'mouseenter'
    revealTexts.forEach((textElement) => {
        textElement.addEventListener("mouseenter", () => {
            // Saat mouse masuk, tambahkan kelas 'visible' untuk memunculkannya
            textElement.classList.add("visible");
        });
        // Tidak ada 'mouseleave' di sini agar teks tetap terlihat
    });

    // 3. Tambahkan satu event 'mouseleave' pada section pembungkus
    parallaxSection.addEventListener("mouseleave", () => {
        // Saat mouse keluar dari seluruh section, reset semua teks
        revealTexts.forEach((el) => {
            el.classList.remove("visible");
        });
    });
});

// EventListener Section 4 HOMEPAGE
document.addEventListener("DOMContentLoaded", () => {
    const teamSection = document.querySelector("#team-section");
    const teamCards = document.querySelectorAll(".team-card");

    if (!teamSection || teamCards.length === 0) return;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    teamCards.forEach((card, index) => {
                        // Delay dibuat berbeda untuk setiap kartu agar muncul satu per satu
                        setTimeout(() => {
                            card.classList.add("is-visible");
                        }, index * 200); // Jeda 200ms
                    });
                    // Hentikan observasi setelah animasi berjalan agar tidak berulang
                    observer.unobserve(teamSection);
                }
            });
        },
        {
            threshold: 0.2, // Animasi akan berjalan saat 20% dari section terlihat
        }
    );

    observer.observe(teamSection);
});

// EventListener Section 5 HOMEPAGE
document.addEventListener("DOMContentLoaded", () => {
    const section = document.querySelector("#get-ready-section");
    const words = document.querySelectorAll(".get-ready");

    if (!section || words.length === 0) return;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    words.forEach((word, index) => {
                        setTimeout(() => {
                            word.classList.add("visible");
                        }, index * 400); // Delay 400ms antar kata
                    });
                    observer.unobserve(section); // Hentikan observasi setelah animasi berjalan
                }
            });
        },
        {
            threshold: 0.5, // Animasi berjalan saat 50% section terlihat
        }
    );

    observer.observe(section);
});

document.addEventListener("DOMContentLoaded", () => {
    // --- ELEMENTS ---
    const editBiodataBtn = document.getElementById("edit-biodata-btn");
    const biodataModal = document.getElementById("biodata-modal");
    const biodataModalContent = document.getElementById("biodata-modal-content");
    const closeBiodataModalBtn = document.getElementById("close-biodata-modal");
    const cancelBiodataModalBtn = document.getElementById("cancel-biodata-modal");
    const biodataForm = document.getElementById("biodata-form");
    const notification = document.getElementById("notification");
    const notificationMessage = document.getElementById("notification-message");

    const countrySelect = document.getElementById('country');
    const stateSelect = document.getElementById('state');
    const citySelect = document.getElementById('city');
    const phoneCodeSelect = document.getElementById('phone_code');
    const phoneNumberInput = document.getElementById('phone_number_input');
    const hiddenAddressLocation = document.getElementById('address_location');
    const hiddenPhoneNumber = document.getElementById('phone_number');

    const API_KEY = 'RmxzNnpCNlBiTUVzYWJFWlFmdm5tUFRlOEZBU0xxQ0hQQVIzaFFDRw=='; // <<< GANTI API KEY ANDA

    // --- MODAL CONTROL ---
    const openModal = () => {
        if (!biodataModal || !biodataModalContent) return;

        biodataModal.classList.remove("hidden");
        void biodataModal.offsetWidth; // trigger reflow
        biodataModal.classList.add("opacity-100");
        biodataModalContent.classList.remove("scale-95", "opacity-0");
        biodataModalContent.classList.add("scale-100", "opacity-100");

        if (countrySelect && countrySelect.options.length <= 1) populateCountries();
    };

    const closeModal = () => {
        biodataModal.classList.remove("opacity-100");
        biodataModalContent.classList.remove("scale-100", "opacity-100");
        biodataModalContent.classList.add("scale-95", "opacity-0");
        setTimeout(() => biodataModal.classList.add("hidden"), 300);
    };

    // --- NOTIFICATION ---
    const showNotification = (message, isSuccess = true) => {
        if (!notification || !notificationMessage) return;
        notificationMessage.textContent = message;
        notification.className = `fixed top-5 right-5 px-6 py-3 rounded-lg shadow-lg text-white transition-all duration-300 transform ${
            isSuccess ? 'bg-green-500' : 'bg-red-500'
        }`;

        notification.classList.remove("hidden", "translate-x-full");
        notification.classList.add("translate-x-0");

        setTimeout(() => {
            notification.classList.remove("translate-x-0");
            notification.classList.add("translate-x-full");
            setTimeout(() => notification.classList.add("hidden"), 300);
        }, 3000);
    };

    // --- API DATA ---
    const fetchWithKey = async (url) => {
        const response = await fetch(url, {
            headers: { 'X-CSCAPI-KEY': API_KEY }
        });
        if (!response.ok) throw new Error('API request failed');
        return response.json();
    };

    const populateCountries = async () => {
    try {
        const response = await fetch('https://api.countrystatecity.in/v1/countries', {
            headers: { 'X-CSCAPI-KEY': API_KEY }
        });
        if (!response.ok) throw new Error('Failed to fetch countries');

        const countries = await response.json();

        countrySelect.innerHTML = '<option value="">Select Country</option>';
        phoneCodeSelect.innerHTML = '<option value="">Code</option>';

        countries.forEach(country => {
            countrySelect.appendChild(new Option(country.name, country.iso2));

            // Tambahkan validasi phone_code
            if (country.phone_code && !phoneCodeSelect.querySelector(`option[value="+${country.phone_code}"]`)) {
                const phoneLabel = `${country.iso2} (+${country.phone_code})`;
                const phoneOption = new Option(phoneLabel, `+${country.phone_code}`);
                phoneCodeSelect.appendChild(phoneOption);
            }
        });
        console.log("Country & phone codes populated.");
    } catch (error) {
        console.error("Error populating countries:", error);
        showNotification("Failed to load country & phone code.", false);
    }
};

    const populateStates = async (countryId) => {
        if (!countryId) return;

        stateSelect.disabled = true;
        citySelect.disabled = true;
        stateSelect.innerHTML = '<option>Loading States...</option>';
        citySelect.innerHTML = '<option>Select City</option>';

        try {
            const states = await fetchWithKey(`https://api.countrystatecity.in/v1/countries/${countryId}/states`);
            stateSelect.innerHTML = '<option value="">Select State</option>';
            states.forEach(s => stateSelect.add(new Option(s.name, s.iso2)));
            stateSelect.disabled = false;
        } catch (e) {
            console.error(e);
            stateSelect.innerHTML = '<option value="">Failed to load</option>';
        }
    };

    const populateCities = async (countryId, stateId) => {
        if (!countryId || !stateId) return;

        citySelect.disabled = true;
        citySelect.innerHTML = '<option>Loading Cities...</option>';

        try {
            const cities = await fetchWithKey(`https://api.countrystatecity.in/v1/countries/${countryId}/states/${stateId}/cities`);
            citySelect.innerHTML = '<option value="">Select City</option>';
            cities.forEach(c => citySelect.add(new Option(c.name, c.name)));
            citySelect.disabled = false;
        } catch (e) {
            console.error(e);
            citySelect.innerHTML = '<option value="">Failed to load</option>';
        }
    };

    // --- EVENTS ---
    editBiodataBtn?.addEventListener("click", openModal);
    closeBiodataModalBtn?.addEventListener("click", closeModal);
    cancelBiodataModalBtn?.addEventListener("click", closeModal);
    biodataModal?.addEventListener("click", (e) => {
        if (e.target === biodataModal) closeModal();
    });

    countrySelect?.addEventListener("change", (e) => populateStates(e.target.value));
    stateSelect?.addEventListener("change", (e) => populateCities(countrySelect.value, e.target.value));

    // --- FORM SUBMISSION ---
    biodataForm?.addEventListener("submit", async function (event) {
        event.preventDefault();

        const countryText = countrySelect?.options[countrySelect.selectedIndex]?.text;
        const stateText = stateSelect?.options[stateSelect.selectedIndex]?.text;
        const cityText = citySelect?.options[citySelect.selectedIndex]?.text;

        if (hiddenAddressLocation && cityText && stateText && countryText &&
            cityText !== "Select City" && stateText !== "Select State" && countryText !== "Select Country") {
            hiddenAddressLocation.value = `${cityText}, ${stateText}, ${countryText}`;
        }

        if (phoneCodeSelect.value && phoneNumberInput.value) {
            hiddenPhoneNumber.value = `${phoneCodeSelect.value}${phoneNumberInput.value}`;
        }

        const formData = new FormData(this);
        const saveBtn = this.querySelector('button[type="submit"]');
        saveBtn.disabled = true;
        saveBtn.textContent = "Saving...";

        try {
            const response = await axios.post(this.action, formData);
            closeModal();
            showNotification(response.data.message, true);
            setTimeout(() => window.location.reload(), 1500);
        } catch (error) {
            const errorMessage = error.response?.data?.message || "An error occurred. Please try again.";
            showNotification(errorMessage, false);
        } finally {
            saveBtn.disabled = false;
            saveBtn.textContent = "Save";
        }
    });
});
