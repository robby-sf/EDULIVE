export function initProfile() {
    document.addEventListener("DOMContentLoaded", () => {
        // --- ELEMENTS ---
        const editBiodataBtn = document.getElementById("edit-biodata-btn");
        const biodataModal = document.getElementById("biodata-modal");
        const biodataModalContent = document.getElementById(
            "biodata-modal-content"
        );
        const closeBiodataModalBtn = document.getElementById(
            "close-biodata-modal"
        );
        const cancelBiodataModalBtn = document.getElementById(
            "cancel-biodata-modal"
        );
        const biodataForm = document.getElementById("biodata-form");

        // Elemen-elemen untuk notifikasi baru yang lebih detail
        const notification = document.getElementById("notification");
        const notificationTitle = document.getElementById("notification-title");
        const notificationMessage = document.getElementById(
            "notification-message"
        );
        const notificationIconContainer = document.getElementById(
            "notification-icon-container"
        );
        const notificationCloseBtn = document.getElementById(
            "notification-close-btn"
        );

        // --- FOTO PROFIL ---
        const editPictureBtn = document.getElementById("edit-picture-btn");
        const pictureUploadModal = document.getElementById(
            "picture-upload-modal"
        );
        const cancelUploadBtn = document.getElementById("cancel-upload-btn");
        const pictureUploadForm = document.getElementById(
            "picture-upload-form"
        );
        const profilePictureDisplay = document.getElementById(
            "profile-picture-display"
        );
        const openPictureModal = () =>
            pictureUploadModal?.classList.remove("hidden");
        const closePictureModal = () =>
            pictureUploadModal?.classList.add("hidden");

        // Elemen-elemen form lainnya
        const countrySelect = document.getElementById("country");
        const stateSelect = document.getElementById("state");
        const citySelect = document.getElementById("city");
        const phoneNumberInput = document.getElementById("phone_number_input");
        const hiddenAddressLocation =
            document.getElementById("address_location");
        const hiddenPhoneNumber = document.getElementById("phone_number");
        let countriesData = [];

        // Sebaiknya simpan API Key di file .env untuk keamanan
        const API_KEY =
            "RmxzNnpCNlBiTUVzYWJFWlFmdm5tUFRlOEZBU0xxQ0hQQVIzaFFDRw==";

        // --- Elemen BARU untuk Modal Share Profile ---
        const shareProfileBtn = document.getElementById("share-profile-btn");
        const shareModal = document.getElementById("share-modal");
        const shareModalContent = document.getElementById(
            "share-modal-content"
        );
        const closeShareModalBtn = document.getElementById(
            "close-share-modal-btn"
        );
        const profileLinkDisplay = document.getElementById(
            "profile-link-display"
        );
        const copyProfileLinkBtn = document.getElementById(
            "copy-profile-link-btn"
        );
        const previewProfileLinkBtn = document.getElementById(
            "preview-profile-link-btn"
        );

        const addSummaryBtn = document.getElementById('add-summary-btn');
const editSummaryBtn = document.getElementById('edit-summary-btn');
const summaryModal = document.getElementById('summary-modal');
const summaryModalContent = document.getElementById('summary-modal-content'); // Ambil elemen konten
const closeSummaryModalBtn = document.getElementById('close-summary-modal-btn');
const cancelSummaryModalBtn = document.getElementById('cancel-summary-modal-btn');
const summaryForm = document.getElementById('summary-form');

const openSummaryModal = () => {
    if (summaryModal && summaryModalContent) {
        summaryModal.classList.remove('hidden');
        void summaryModal.offsetWidth; // Memicu reflow browser
        summaryModal.classList.remove('opacity-0');
        summaryModalContent.classList.remove('opacity-0', 'scale-95');
        summaryModalContent.classList.add('opacity-100', 'scale-100');
    }
};

const closeSummaryModal = () => {
    if (summaryModal && summaryModalContent) {
        summaryModalContent.classList.remove('opacity-100', 'scale-100');
        summaryModalContent.classList.add('opacity-0', 'scale-95');
        summaryModal.classList.add('opacity-0');
        setTimeout(() => summaryModal.classList.add('hidden'), 300); // Sesuaikan durasi dengan transisi
    }
};

        // --- Fungsi BARU untuk Modal Share Profile ---
        const openShareModal = () => {
            if (!shareModal || !shareProfileBtn) return;
            const profileUrl = shareProfileBtn.dataset.shareUrl;
            profileLinkDisplay.value = profileUrl;
            previewProfileLinkBtn.href = profileUrl;
            shareModal.classList.remove("hidden");
            void shareModal.offsetWidth;
            shareModal.classList.remove("opacity-0");
            shareModalContent.classList.remove("opacity-0", "scale-95");
            shareModalContent.classList.add("opacity-100", "scale-100");
        };

        const closeShareModal = () => {
            if (!shareModal) return;
            shareModalContent.classList.remove("opacity-100", "scale-100");
            shareModalContent.classList.add("opacity-0", "scale-95");
            shareModal.classList.add("opacity-0");
            setTimeout(() => shareModal.classList.add("hidden"), 300);
        };

        const copyProfileLink = () => {
            if (!profileLinkDisplay) return;
            navigator.clipboard
                .writeText(profileLinkDisplay.value)
                .then(() => {
                    showNotification(
                        "Copied!",
                        "Profile link copied to clipboard.",
                        true
                    );
                    closeShareModal();
                })
                .catch((err) => {
                    showNotification("Woopsie!", "Failed to copy link.", false);
                });
        };

        // --- FUNGSI NOTIFIKASI BARU (MODIFIKASI TOTAL) ---
        /**
         * Menampilkan notifikasi universal.
         * @param {string} title - Judul notifikasi (cth: "Successful!" atau "Woopsie!").
         * @param {string} message - Pesan detail notifikasi.
         * @param {boolean} isSuccess - Menentukan apakah ini notifikasi sukses (true) atau gagal (false).
         */

        const notificationContent = document.getElementById(
            "notification-content"
        );

        const showNotification = (title, message, isSuccess = true) => {
            if (
                !notification ||
                !notificationTitle ||
                !notificationMessage ||
                !notificationIconContainer ||
                !notificationContent
            ) {
                console.error("Elemen notifikasi tidak ditemukan!");
                return;
            }

            // Set judul dan pesan
            notificationTitle.textContent = title;
            notificationMessage.textContent = message;

            // Reset ikon dan warna
            notificationIconContainer.innerHTML = "";
            notificationIconContainer.classList.remove(
                "bg-green-100",
                "bg-red-100"
            );

            if (isSuccess) {
                // --- Style untuk notifikasi SUKSES ---
                notificationIconContainer.classList.add("bg-green-100");
                notificationIconContainer.innerHTML = `
            <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
            </svg>`;
            } else {
                // --- Style untuk notifikasi GAGAL ---
                notificationIconContainer.classList.add("bg-red-100");
                notificationIconContainer.innerHTML = `
            <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>`;
            }

            notification.classList.remove("hidden");

            void notification.offsetWidth;

            notification.classList.add("-translate-x-1/2", "-translate-y-1/2");
            notificationContent.classList.remove("opacity-0", "scale-95");
            notificationContent.classList.add("opacity-100", "scale-100");

            setTimeout(() => {
                hideNotification();
            }, 3000);
        };

        const hideNotification = () => {
            if (!notification || !notificationContent) return;

            notificationContent.classList.remove("opacity-100", "scale-100");
            notificationContent.classList.add("opacity-0", "scale-95");

            setTimeout(() => {
                notification.classList.add("hidden");
                notification.classList.remove(
                    "-translate-x-1/2",
                    "-translate-y-1/2"
                );
            }, 300);
        };

        notificationCloseBtn?.addEventListener("click", hideNotification);

        // --- MODAL CONTROL ---
        const openModal = () => {
            if (!biodataModal || !biodataModalContent) return;
            biodataModal.classList.remove("hidden");
            void biodataModal.offsetWidth;
            biodataModal.classList.add("opacity-100");
            biodataModalContent.classList.remove("scale-95", "opacity-0");
            biodataModalContent.classList.add("scale-100", "opacity-100");
            const savedAddress = editBiodataBtn.dataset.address;
            setInitialLocation(savedAddress);
        };

        const closeModal = () => {
            biodataModal.classList.remove("opacity-100");
            biodataModalContent.classList.remove("scale-100", "opacity-100");
            biodataModalContent.classList.add("scale-95", "opacity-0");
            setTimeout(() => biodataModal.classList.add("hidden"), 300);
        };

        const setInitialLocation = async (addressString) => {
            if (!addressString) {
                await populateCountries();
                return;
            }
            const parts = addressString.split(",").map((part) => part.trim());
            if (parts.length < 3) {
                await populateCountries();
                return;
            }
            const [cityName, stateName, countryName] = parts;
            try {
                await populateCountries();
                const countryOption = Array.from(countrySelect.options).find(
                    (opt) => opt.text === countryName
                );
                if (countryOption) {
                    countrySelect.value = countryOption.value;
                    countrySelect.dispatchEvent(new Event("change"));
                    await populateStates(countryOption.value);
                    const stateOption = Array.from(stateSelect.options).find(
                        (opt) => opt.text === stateName
                    );
                    if (stateOption) {
                        stateSelect.value = stateOption.value;
                        stateSelect.dispatchEvent(new Event("change"));
                        await populateCities(
                            countrySelect.value,
                            stateOption.value
                        );
                        const cityOption = Array.from(citySelect.options).find(
                            (opt) => opt.text === cityName
                        );
                        if (cityOption) {
                            citySelect.value = cityOption.value;
                        }
                    }
                }
            } catch (error) {
                console.error("Failed to set initial location:", error);
                showNotification(
                    "Woopsie!",
                    "Could not pre-fill location data.",
                    false
                );
            }
        };

        const fetchWithKey = async (url) => {
            const response = await fetch(url, {
                headers: { "X-CSCAPI-KEY": API_KEY },
            });
            if (!response.ok) throw new Error("API request failed");
            return response.json();
        };

        const populateCountries = async () => {
            try {
                const countries = await fetchWithKey(
                    "https://api.countrystatecity.in/v1/countries"
                );
                countriesData = countries;
                countrySelect.innerHTML =
                    '<option value="">Select Country</option>';
                countries.forEach((country) =>
                    countrySelect.appendChild(
                        new Option(country.name, country.iso2)
                    )
                );
            } catch (error) {
                console.error("Error populating countries:", error);
                showNotification(
                    "Woopsie!",
                    "Failed to load country data.",
                    false
                );
            }
        };

        const populateStates = async (countryId) => {
            if (!countryId) return;
            stateSelect.disabled = true;
            citySelect.disabled = true;
            stateSelect.innerHTML = "<option>Loading States...</option>";
            citySelect.innerHTML = "<option>Select City</option>";
            try {
                const states = await fetchWithKey(
                    `https://api.countrystatecity.in/v1/countries/${countryId}/states`
                );
                stateSelect.innerHTML =
                    '<option value="">Select State</option>';
                states.forEach((s) =>
                    stateSelect.add(new Option(s.name, s.iso2))
                );
                stateSelect.disabled = false;
            } catch (e) {
                stateSelect.innerHTML =
                    '<option value="">Failed to load</option>';
            }
        };

        const populateCities = async (countryId, stateId) => {
            if (!countryId || !stateId) return;
            citySelect.disabled = true;
            citySelect.innerHTML = "<option>Loading Cities...</option>";
            try {
                const cities = await fetchWithKey(
                    `https://api.countrystatecity.in/v1/countries/${countryId}/states/${stateId}/cities`
                );
                citySelect.innerHTML = '<option value="">Select City</option>';
                cities.forEach((c) =>
                    citySelect.add(new Option(c.name, c.name))
                );
                citySelect.disabled = false;
            } catch (e) {
                citySelect.innerHTML =
                    '<option value="">Failed to load</option>';
            }
        };

        // --- EVENTS ---

        // --- FOTO PROFIL ---
        editPictureBtn?.addEventListener("click", openPictureModal);
        cancelUploadBtn?.addEventListener("click", closePictureModal);

        pictureUploadForm?.addEventListener("submit", async function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.textContent = "Uploading...";

            try {
                const response = await axios.post(this.action, formData, {
                    headers: { "Content-Type": "multipart/form-data" },
                });

                if (response.data.success) {
                    // Update gambar di halaman tanpa reload
                    const newImagePath = `/storage/${
                        response.data.path
                    }?t=${new Date().getTime()}`;
                    profilePictureDisplay.src = newImagePath;

                    showNotification("Success!", response.data.message, true);
                    closePictureModal();
                }
            } catch (error) {
                const errorMessage =
                    error.response?.data?.message ||
                    "Upload failed. Please try again.";
                showNotification("Woopsie!", errorMessage, false);
            } finally {
                submitButton.disabled = false;
                submitButton.textContent = "Upload";
            }
        });

        // --- SUMMARY ---
        addSummaryBtn?.addEventListener('click', openSummaryModal);
editSummaryBtn?.addEventListener('click', openSummaryModal);
closeSummaryModalBtn?.addEventListener('click', closeSummaryModal);
cancelSummaryModalBtn?.addEventListener('click', closeSummaryModal);
summaryModal?.addEventListener('click', (e) => {
    if (e.target === summaryModal) {
        closeSummaryModal();
    }
});

    summaryForm?.addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const saveBtn = this.querySelector('button[type="submit"]');
        saveBtn.disabled = true;
        saveBtn.textContent = "Saving...";

        try {
            const response = await axios.post(this.action, formData);
            if (response.data.success) {
                showNotification('Success!', response.data.message, true);
                // Refresh halaman untuk melihat perubahan
                setTimeout(() => window.location.reload(), 1500);
            }
        } catch (error) {
            const errorMessage = error.response?.data?.message || 'Save failed. Please try again.';
            showNotification('Woopsie!', errorMessage, false);
        } finally {
            saveBtn.disabled = false;
            saveBtn.textContent = "Save";
            closeSummaryModal();
        }
    });

        // --- Event Listeners BARU untuk Modal Share Profile ---
        shareProfileBtn?.addEventListener("click", openShareModal);
        closeShareModalBtn?.addEventListener("click", closeShareModal);
        copyProfileLinkBtn?.addEventListener("click", copyProfileLink);
        shareModal?.addEventListener("click", (e) => {
            if (e.target === shareModal) closeShareModal();
        });

        editBiodataBtn?.addEventListener("click", openModal);
        closeBiodataModalBtn?.addEventListener("click", closeModal);
        cancelBiodataModalBtn?.addEventListener("click", closeModal);
        biodataModal?.addEventListener("click", (e) => {
            if (e.target === biodataModal) closeModal();
        });
        countrySelect?.addEventListener("change", (e) =>
            populateStates(e.target.value)
        );
        stateSelect?.addEventListener("change", (e) =>
            populateCities(countrySelect.value, e.target.value)
        );

        biodataForm?.addEventListener("submit", async function (event) {
            event.preventDefault();

            const countryText =
                countrySelect?.options[countrySelect.selectedIndex]?.text;
            const stateText =
                stateSelect?.options[stateSelect.selectedIndex]?.text;
            const cityText =
                citySelect?.options[citySelect.selectedIndex]?.text;

            if (
                hiddenAddressLocation &&
                cityText &&
                stateText &&
                countryText &&
                cityText !== "Select City" &&
                stateText !== "Select State" &&
                countryText !== "Select Country"
            ) {
                hiddenAddressLocation.value = `${cityText}, ${stateText}, ${countryText}`;
            }

            if (hiddenPhoneNumber && phoneNumberInput.value) {
                hiddenPhoneNumber.value = phoneNumberInput.value;
            }

            const formData = new FormData(this);
            const saveBtn = this.querySelector('button[type="submit"]');
            saveBtn.disabled = true;
            saveBtn.textContent = "Saving...";

            try {
                const response = await axios.post(this.action, formData);
                closeModal();
                showNotification("Successful!", response.data.message, true);
                setTimeout(() => window.location.reload(), 1500);
            } catch (error) {
                const errorMessage =
                    error.response?.data?.message ||
                    "An error occurred. Please try again.";
                showNotification("Woopsie!", errorMessage, false);
            } finally {
                saveBtn.disabled = false;
                saveBtn.textContent = "Save";
            }
        });
    });
}
