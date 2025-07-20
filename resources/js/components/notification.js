// Variabel untuk menyimpan elemen-elemen notifikasi
let notification, notificationTitle, notificationMessage, notificationIconContainer, notificationContent, notificationCloseBtn;

// Fungsi untuk menampilkan notifikasi
export function showNotification(title, message, isSuccess = true) {
    // Inisialisasi elemen jika belum ada
    if (!notification) {
        notification = document.getElementById("notification");
        notificationTitle = document.getElementById("notification-title");
        notificationMessage = document.getElementById("notification-message");
        notificationIconContainer = document.getElementById("notification-icon-container");
        notificationContent = document.getElementById("notification-content");
        notificationCloseBtn = document.getElementById("notification-close-btn");

        // Tambahkan event listener ke tombol close
        notificationCloseBtn?.addEventListener('click', hideNotification);
    }

    // Pastikan semua elemen ada sebelum melanjutkan
    if (!notification || !notificationTitle || !notificationMessage || !notificationIconContainer || !notificationContent) {
        console.error("Elemen notifikasi tidak ditemukan di DOM!");
        // Fallback ke alert biasa jika notifikasi kustom tidak ada
        alert(`${title}: ${message}`);
        return;
    }

    notificationTitle.textContent = title;
    notificationMessage.textContent = message;

    // Reset ikon dan warna
    notificationIconContainer.innerHTML = '';
    notificationIconContainer.classList.remove('bg-green-100', 'bg-red-100');

    if (isSuccess) {
        notificationIconContainer.classList.add('bg-green-100');
        notificationIconContainer.innerHTML = `
            <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
            </svg>`;
    } else {
        notificationIconContainer.classList.add('bg-red-100');
        notificationIconContainer.innerHTML = `
            <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>`;
    }

    // Tampilkan notifikasi
    notification.classList.remove("hidden");
    void notification.offsetWidth;

    // Animasi muncul
    notification.classList.add('-translate-x-1/2', '-translate-y-1/2');
    notificationContent.classList.remove("opacity-0", "scale-95");
    notificationContent.classList.add("opacity-100", "scale-100");

    // Sembunyikan otomatis setelah 3 detik
    setTimeout(hideNotification, 3000);
}

// Fungsi untuk menyembunyikan notifikasi
function hideNotification() {
    if (!notification || !notificationContent) return;

    notificationContent.classList.remove("opacity-100", "scale-100");
    notificationContent.classList.add("opacity-0", "scale-95");

    setTimeout(() => {
        notification.classList.add("hidden");
        notification.classList.remove('-translate-x-1/2', '-translate-y-1/2');
    }, 300);
}
