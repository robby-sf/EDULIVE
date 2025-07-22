
import "./bootstrap";
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { initNavigation } from './components/navigation.js';
import { initHomepage } from './components/homepage.js';
import { initProfile } from './components/profile.js';
import { initEducationModal } from './components/education.js';

// Initialize components
initNavigation();
initHomepage();
initProfile();
initEducationModal();

// // menu toggle dll
// const menuToggle = document.getElementById("menu-toggle");
// const menu = document.getElementById("menu");
// const menuOverlay = document.getElementById("menu-overlay");

// if (menuToggle && menu && menuOverlay) {
//     menuToggle.addEventListener("click", () => {
//         menu.classList.toggle("hidden");
//         menuOverlay.classList.toggle("hidden");
//     });

//     // Close the menu when clicking outside of it
//     menuOverlay.addEventListener("click", () => {
//         menu.classList.add("hidden");
//         menuOverlay.classList.add("hidden");
//     });
// }
// const dashboardToggle = document.getElementById("dashboard-toggle");
// const mobileDashboardMenu = document.getElementById("mobile-dashboard-menu");
// const desktopDashboardMenu = document.getElementById("desktop-dashboard-menu");
// const dashboardChevron = document.getElementById("dashboard-chevron");

// dashboardToggle.addEventListener("click", (event) => {
//     event.stopPropagation();

//     if (window.matchMedia("(min-width: 768px)").matches) {
//         // Desktop view
//         desktopDashboardMenu.classList.toggle("hidden");
//     } else {
//         // Mobile view
//         mobileDashboardMenu.classList.toggle("hidden");
//     }

//     dashboardChevron.classList.toggle("rotate-180");
// });

// window.addEventListener("click", (event) => {
//     if (!dashboardToggle.contains(event.target)) {
//         mobileDashboardMenu.classList.add("hidden");
//         desktopDashboardMenu.classList.add("hidden");
//         dashboardChevron.classList.remove("rotate-180");
//     }
// });




// // Profile Dropdown
// document.addEventListener("DOMContentLoaded", function () {
//     const profileButton = document.getElementById("profile-menu-button");
//     const profileDropdown = document.getElementById("profile-menu-dropdown");

//     if (profileButton && profileDropdown) {
//         profileButton.addEventListener("click", function (event) {
//             event.stopPropagation();
//             profileDropdown.classList.toggle("hidden");
//             if (!profileDropdown.classList.contains("hidden")) {
//                 setTimeout(() => {
//                     profileDropdown.classList.add("opacity-100", "scale-100");
//                     profileDropdown.classList.remove("opacity-0", "scale-95");
//                 }, 10);
//             } else {
//                 profileDropdown.classList.remove("opacity-100", "scale-100");
//                 profileDropdown.classList.add("opacity-0", "scale-95");
//             }
//         });

//         window.addEventListener("click", function (event) {
//             if (
//                 !profileDropdown.contains(event.target) &&
//                 !profileButton.contains(event.target)
//             ) {
//                 if (!profileDropdown.classList.contains("hidden")) {
//                     profileDropdown.classList.remove(
//                         "opacity-100",
//                         "scale-100"
//                     );
//                     profileDropdown.classList.add("opacity-0", "scale-95");

//                     setTimeout(() => {
//                         profileDropdown.classList.add("hidden");
//                     }, 300);
//                 }
//             }
//         });
//     }
// });




// // EventListener Section 1 HOMEPAGE
// document.addEventListener("DOMContentLoaded", function () {
//     const titleText = "EDULIVE";
//     const taglineText = "Elevate Your Learning Experience With AI";
//     const titleContainer = document.getElementById("animated-title");
//     const taglineContainer = document.getElementById("animated-tagline");

//     if (titleContainer && taglineContainer) {
//         titleText.split("").forEach((char, index) => {
//             const span = document.createElement("span");
//             span.innerHTML = char === " " ? "&nbsp;" : char;
//             span.style.transitionDelay = `${index * 0.05}s`;
//             titleContainer.appendChild(span);
//         });

//         const words = taglineText.split(" ");
//         words.forEach((word, index) => {
//             const span = document.createElement("span");
//             span.textContent = word;
//             span.style.transitionDelay = `${
//                 titleText.length * 0.05 + index * 0.1
//             }s`;
//             taglineContainer.appendChild(span);

//             if (index < words.length - 1) {
//                 const space = document.createElement("span");
//                 space.innerHTML = "&nbsp;";
//                 space.style.transitionDelay = `${
//                     titleText.length * 0.05 + index * 0.1
//                 }s`;
//                 taglineContainer.appendChild(space);
//             }
//         });
//         setTimeout(() => {
//             titleContainer.classList.add("visible");
//             taglineContainer.classList.add("visible");
//         }, 100);
//     }
// });




// //spline load section 1 HOMEPAGE (Not Affected For Spline Now)
// document.addEventListener("DOMContentLoaded", function () {
//     const splineModel = document.getElementById("spline-model");

//     if (splineModel) {
//         splineModel.addEventListener("load", () => {
//             splineModel.classList.add("spline-visible");
//         });
//     }
// });





// // EventListener Section 2 HOMEPAGE
// document.addEventListener("DOMContentLoaded", () => {
//     // 1. Ambil elemen section pembungkus dan semua elemen teks
//     const parallaxSection = document.getElementById("parallax-section");
//     const revealTexts = document.querySelectorAll(".reveal-text");

//     // Pastikan elemennya ada sebelum melanjutkan
//     if (!parallaxSection || revealTexts.length === 0) return;

//     // 2. Loop setiap elemen teks untuk menambahkan event 'mouseenter'
//     revealTexts.forEach((textElement) => {
//         textElement.addEventListener("mouseenter", () => {
//             // Saat mouse masuk, tambahkan kelas 'visible' untuk memunculkannya
//             textElement.classList.add("visible");
//         });
//         // Tidak ada 'mouseleave' di sini agar teks tetap terlihat
//     });

//     // 3. Tambahkan satu event 'mouseleave' pada section pembungkus
//     parallaxSection.addEventListener("mouseleave", () => {
//         // Saat mouse keluar dari seluruh section, reset semua teks
//         revealTexts.forEach((el) => {
//             el.classList.remove("visible");
//         });
//     });
// });




// // EventListener Section 4 HOMEPAGE
// document.addEventListener("DOMContentLoaded", () => {
//     const teamSection = document.querySelector("#team-section");
//     const teamCards = document.querySelectorAll(".team-card");

//     if (!teamSection || teamCards.length === 0) return;

//     const observer = new IntersectionObserver(
//         (entries) => {
//             entries.forEach((entry) => {
//                 if (entry.isIntersecting) {
//                     teamCards.forEach((card, index) => {
//                         // Delay dibuat berbeda untuk setiap kartu agar muncul satu per satu
//                         setTimeout(() => {
//                             card.classList.add("is-visible");
//                         }, index * 200); // Jeda 200ms
//                     });
//                     // Hentikan observasi setelah animasi berjalan agar tidak berulang
//                     observer.unobserve(teamSection);
//                 }
//             });
//         },
//         {
//             threshold: 0.2, // Animasi akan berjalan saat 20% dari section terlihat
//         }
//     );

//     observer.observe(teamSection);
// });




// // EventListener Section 5 HOMEPAGE
// document.addEventListener("DOMContentLoaded", () => {
//     const section = document.querySelector("#get-ready-section");
//     const words = document.querySelectorAll(".get-ready");

//     if (!section || words.length === 0) return;

//     const observer = new IntersectionObserver(
//         (entries) => {
//             entries.forEach((entry) => {
//                 if (entry.isIntersecting) {
//                     words.forEach((word, index) => {
//                         setTimeout(() => {
//                             word.classList.add("visible");
//                         }, index * 400); // Delay 400ms antar kata
//                     });
//                     observer.unobserve(section); // Hentikan observasi setelah animasi berjalan
//                 }
//             });
//         },
//         {
//             threshold: 0.5, // Animasi berjalan saat 50% section terlihat
//         }
//     );

//     observer.observe(section);
// });



// EventListener profile biodata , education, dll
// document.addEventListener("DOMContentLoaded", () => {
//     // --- ELEMENTS ---
//     const editBiodataBtn = document.getElementById("edit-biodata-btn");
//     const biodataModal = document.getElementById("biodata-modal");
//     const biodataModalContent = document.getElementById("biodata-modal-content");
//     const closeBiodataModalBtn = document.getElementById("close-biodata-modal");
//     const cancelBiodataModalBtn = document.getElementById("cancel-biodata-modal");
//     const biodataForm = document.getElementById("biodata-form");

//     // Elemen-elemen untuk notifikasi baru yang lebih detail
//     const notification = document.getElementById("notification");
//     const notificationTitle = document.getElementById("notification-title");
//     const notificationMessage = document.getElementById("notification-message");
//     const notificationIconContainer = document.getElementById("notification-icon-container");
//     const notificationCloseBtn = document.getElementById("notification-close-btn");

//     // Elemen-elemen form lainnya
//     const countrySelect = document.getElementById("country");
//     const stateSelect = document.getElementById("state");
//     const citySelect = document.getElementById("city");
//     const phoneNumberInput = document.getElementById("phone_number_input");
//     const hiddenAddressLocation = document.getElementById("address_location");
//     const hiddenPhoneNumber = document.getElementById("phone_number");
//     let countriesData = [];

//     // Sebaiknya simpan API Key di file .env untuk keamanan
//     const API_KEY = "RmxzNnpCNlBiTUVzYWJFWlFmdm5tUFRlOEZBU0xxQ0hQQVIzaFFDRw==";

//      // --- Elemen BARU untuk Modal Share Profile ---
//     const shareProfileBtn = document.getElementById("share-profile-btn");
//     const shareModal = document.getElementById("share-modal");
//     const shareModalContent = document.getElementById("share-modal-content");
//     const closeShareModalBtn = document.getElementById("close-share-modal-btn");
//     const profileLinkDisplay = document.getElementById("profile-link-display");
//     const copyProfileLinkBtn = document.getElementById("copy-profile-link-btn");
//     const previewProfileLinkBtn = document.getElementById("preview-profile-link-btn");

//     // --- Fungsi BARU untuk Modal Share Profile ---
//     const openShareModal = () => {
//         if (!shareModal || !shareProfileBtn) return;
//         const profileUrl = shareProfileBtn.dataset.shareUrl;
//         profileLinkDisplay.value = profileUrl;
//         previewProfileLinkBtn.href = profileUrl;
//         shareModal.classList.remove("hidden");
//         void shareModal.offsetWidth;
//         shareModal.classList.remove("opacity-0");
//         shareModalContent.classList.remove("opacity-0", "scale-95");
//         shareModalContent.classList.add("opacity-100", "scale-100");
//     };

//     const closeShareModal = () => {
//         if (!shareModal) return;
//         shareModalContent.classList.remove("opacity-100", "scale-100");
//         shareModalContent.classList.add("opacity-0", "scale-95");
//         shareModal.classList.add("opacity-0");
//         setTimeout(() => shareModal.classList.add("hidden"), 300);
//     };

//     const copyProfileLink = () => {
//         if (!profileLinkDisplay) return;
//         navigator.clipboard.writeText(profileLinkDisplay.value).then(() => {
//             showNotification('Copied!', 'Profile link copied to clipboard.', true);
//             closeShareModal();
//         }).catch(err => {
//             showNotification('Woopsie!', 'Failed to copy link.', false);
//         });
//     };

//     // --- FUNGSI NOTIFIKASI BARU (MODIFIKASI TOTAL) ---
//     /**
//      * Menampilkan notifikasi universal.
//      * @param {string} title - Judul notifikasi (cth: "Successful!" atau "Woopsie!").
//      * @param {string} message - Pesan detail notifikasi.
//      * @param {boolean} isSuccess - Menentukan apakah ini notifikasi sukses (true) atau gagal (false).
//      */

//     const notificationContent = document.getElementById("notification-content");

//     const showNotification = (title, message, isSuccess = true) => {
//     if (!notification || !notificationTitle || !notificationMessage || !notificationIconContainer || !notificationContent) {
//         console.error("Elemen notifikasi tidak ditemukan!");
//         return;
//     }

//     // Set judul dan pesan
//     notificationTitle.textContent = title;
//     notificationMessage.textContent = message;

//     // Reset ikon dan warna
//     notificationIconContainer.innerHTML = '';
//     notificationIconContainer.classList.remove('bg-green-100', 'bg-red-100');

//     if (isSuccess) {
//         // --- Style untuk notifikasi SUKSES ---
//         notificationIconContainer.classList.add('bg-green-100');
//         notificationIconContainer.innerHTML = `
//             <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
//                 <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
//             </svg>`;
//     } else {
//         // --- Style untuk notifikasi GAGAL ---
//         notificationIconContainer.classList.add('bg-red-100');
//         notificationIconContainer.innerHTML = `
//             <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
//                 <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
//             </svg>`;
//     }

//     // Tampilkan notifikasi
//     notification.classList.remove("hidden");
//     // Paksa browser untuk me-render elemen sebelum memulai transisi
//     void notification.offsetWidth;

//     // Animasi muncul: scale up dan fade in
//     notification.classList.add('-translate-x-1/2', '-translate-y-1/2');
//     notificationContent.classList.remove("opacity-0", "scale-95");
//     notificationContent.classList.add("opacity-100", "scale-100");


//     // Sembunyikan otomatis setelah 3 detik
//     setTimeout(() => {
//         hideNotification();
//     }, 3000);
// };

// const hideNotification = () => {
//     if (!notification || !notificationContent) return;

//     // Animasi hilang: scale down dan fade out
//     notificationContent.classList.remove("opacity-100", "scale-100");
//     notificationContent.classList.add("opacity-0", "scale-95");

//     // Sembunyikan elemen setelah animasi selesai
//     setTimeout(() => {
//         notification.classList.add("hidden");
//         // Hapus kelas transform agar posisi reset untuk pemanggilan berikutnya
//         notification.classList.remove('-translate-x-1/2', '-translate-y-1/2');
//     }, 300); // 300ms sesuai durasi transisi
// };


//     // Tambahkan event listener untuk tombol close pada notifikasi
//     notificationCloseBtn?.addEventListener('click', hideNotification);


//     // --- MODAL CONTROL ---
//     const openModal = () => {
//         if (!biodataModal || !biodataModalContent) return;
//         biodataModal.classList.remove("hidden");
//         void biodataModal.offsetWidth;
//         biodataModal.classList.add("opacity-100");
//         biodataModalContent.classList.remove("scale-95", "opacity-0");
//         biodataModalContent.classList.add("scale-100", "opacity-100");
//         const savedAddress = editBiodataBtn.dataset.address;
//         setInitialLocation(savedAddress);
//     };

//     const closeModal = () => {
//         biodataModal.classList.remove("opacity-100");
//         biodataModalContent.classList.remove("scale-100", "opacity-100");
//         biodataModalContent.classList.add("scale-95", "opacity-0");
//         setTimeout(() => biodataModal.classList.add("hidden"), 300);
//     };


//     // --- FUNGSI LOKASI & API (Tidak ada perubahan, tapi panggilannya diupdate) ---
//     const setInitialLocation = async (addressString) => {
//         if (!addressString) {
//             await populateCountries();
//             return;
//         }
//         const parts = addressString.split(",").map((part) => part.trim());
//         if (parts.length < 3) {
//             await populateCountries();
//             return;
//         }
//         const [cityName, stateName, countryName] = parts;
//         try {
//             await populateCountries();
//             const countryOption = Array.from(countrySelect.options).find(opt => opt.text === countryName);
//             if (countryOption) {
//                 countrySelect.value = countryOption.value;
//                 countrySelect.dispatchEvent(new Event('change'));
//                 await populateStates(countryOption.value);
//                 const stateOption = Array.from(stateSelect.options).find(opt => opt.text === stateName);
//                 if (stateOption) {
//                     stateSelect.value = stateOption.value;
//                     stateSelect.dispatchEvent(new Event('change'));
//                     await populateCities(countrySelect.value, stateOption.value);
//                     const cityOption = Array.from(citySelect.options).find(opt => opt.text === cityName);
//                     if (cityOption) {
//                         citySelect.value = cityOption.value;
//                     }
//                 }
//             }
//         } catch (error) {
//             console.error("Failed to set initial location:", error);
//             // Panggilan notifikasi diupdate
//             showNotification("Woopsie!", "Could not pre-fill location data.", false);
//         }
//     };

//     const fetchWithKey = async (url) => {
//         const response = await fetch(url, { headers: { "X-CSCAPI-KEY": API_KEY } });
//         if (!response.ok) throw new Error("API request failed");
//         return response.json();
//     };

//     const populateCountries = async () => {
//         try {
//             const countries = await fetchWithKey("https://api.countrystatecity.in/v1/countries");
//             countriesData = countries;
//             countrySelect.innerHTML = '<option value="">Select Country</option>';
//             countries.forEach((country) => countrySelect.appendChild(new Option(country.name, country.iso2)));
//         } catch (error) {
//             console.error("Error populating countries:", error);
//             // Panggilan notifikasi diupdate
//             showNotification("Woopsie!", "Failed to load country data.", false);
//         }
//     };

//     const populateStates = async (countryId) => {
//         if (!countryId) return;
//         stateSelect.disabled = true;
//         citySelect.disabled = true;
//         stateSelect.innerHTML = "<option>Loading States...</option>";
//         citySelect.innerHTML = "<option>Select City</option>";
//         try {
//             const states = await fetchWithKey(`https://api.countrystatecity.in/v1/countries/${countryId}/states`);
//             stateSelect.innerHTML = '<option value="">Select State</option>';
//             states.forEach((s) => stateSelect.add(new Option(s.name, s.iso2)));
//             stateSelect.disabled = false;
//         } catch (e) {
//             stateSelect.innerHTML = '<option value="">Failed to load</option>';
//         }
//     };

//     const populateCities = async (countryId, stateId) => {
//         if (!countryId || !stateId) return;
//         citySelect.disabled = true;
//         citySelect.innerHTML = "<option>Loading Cities...</option>";
//         try {
//             const cities = await fetchWithKey(`https://api.countrystatecity.in/v1/countries/${countryId}/states/${stateId}/cities`);
//             citySelect.innerHTML = '<option value="">Select City</option>';
//             cities.forEach((c) => citySelect.add(new Option(c.name, c.name)));
//             citySelect.disabled = false;
//         } catch (e) {
//             citySelect.innerHTML = '<option value="">Failed to load</option>';
//         }
//     };


//     // --- EVENTS ---

//     // --- Event Listeners BARU untuk Modal Share Profile ---
//     shareProfileBtn?.addEventListener("click", openShareModal);
//     closeShareModalBtn?.addEventListener("click", closeShareModal);
//     copyProfileLinkBtn?.addEventListener("click", copyProfileLink);
//     shareModal?.addEventListener("click", (e) => {
//         // Menutup modal jika klik di area luar konten (backdrop)
//         if (e.target === shareModal) closeShareModal();
//     });

//     editBiodataBtn?.addEventListener("click", openModal);
//     closeBiodataModalBtn?.addEventListener("click", closeModal);
//     cancelBiodataModalBtn?.addEventListener("click", closeModal);
//     biodataModal?.addEventListener("click", (e) => {
//         if (e.target === biodataModal) closeModal();
//     });
//     countrySelect?.addEventListener("change", (e) => populateStates(e.target.value));
//     stateSelect?.addEventListener("change", (e) => populateCities(countrySelect.value, e.target.value));


//     // --- FORM SUBMISSION (PANGGILAN NOTIFIKASI DIUPDATE) ---
//     biodataForm?.addEventListener("submit", async function (event) {
//         event.preventDefault();

//         const countryText = countrySelect?.options[countrySelect.selectedIndex]?.text;
//         const stateText = stateSelect?.options[stateSelect.selectedIndex]?.text;
//         const cityText = citySelect?.options[citySelect.selectedIndex]?.text;

//         if (hiddenAddressLocation && cityText && stateText && countryText && cityText !== "Select City" && stateText !== "Select State" && countryText !== "Select Country") {
//             hiddenAddressLocation.value = `${cityText}, ${stateText}, ${countryText}`;
//         }

//         if (hiddenPhoneNumber && phoneNumberInput.value) {
//             hiddenPhoneNumber.value = phoneNumberInput.value;
//         }

//         const formData = new FormData(this);
//         const saveBtn = this.querySelector('button[type="submit"]');
//         saveBtn.disabled = true;
//         saveBtn.textContent = "Saving...";

//         try {
//             const response = await axios.post(this.action, formData);
//             closeModal();
//             // Panggil notifikasi baru dengan JUDUL dan PESAN
//             showNotification('Successful!', response.data.message, true);
//             setTimeout(() => window.location.reload(), 1500);
//         } catch (error) {
//             const errorMessage = error.response?.data?.message || "An error occurred. Please try again.";
//             // Panggil notifikasi baru dengan JUDUL dan PESAN
//             showNotification('Woopsie!', errorMessage, false);
//         } finally {
//             saveBtn.disabled = false;
//             saveBtn.textContent = "Save";
//         }
//     });
// });