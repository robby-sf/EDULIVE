
let notification, notificationTitle, notificationMessage, notificationIconContainer, notificationContent, notificationCloseBtn;

export function showNotification(title, message, isSuccess = true) {
    if (!notification) {
        notification = document.getElementById("notification");
        notificationTitle = document.getElementById("notification-title");
        notificationMessage = document.getElementById("notification-message");
        notificationIconContainer = document.getElementById("notification-icon-container");
        notificationContent = document.getElementById("notification-content");
        notificationCloseBtn = document.getElementById("notification-close-btn");

        notificationCloseBtn?.addEventListener('click', hideNotification);
    }

    if (!notification || !notificationTitle || !notificationMessage || !notificationIconContainer || !notificationContent) {
        console.error("Elemen notifikasi tidak ditemukan di DOM!");
        alert(`${title}: ${message}`);
        return;
    }

    notificationTitle.textContent = title;
    notificationMessage.textContent = message;

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

    notification.classList.remove("hidden");
    void notification.offsetWidth;

    notification.classList.add('-translate-x-1/2', '-translate-y-1/2');
    notificationContent.classList.remove("opacity-0", "scale-95");
    notificationContent.classList.add("opacity-100", "scale-100");

    setTimeout(hideNotification, 3000);
}

function hideNotification() {
    if (!notification || !notificationContent) return;

    notificationContent.classList.remove("opacity-100", "scale-100");
    notificationContent.classList.add("opacity-0", "scale-95");

    setTimeout(() => {
        notification.classList.add("hidden");
        notification.classList.remove('-translate-x-1/2', '-translate-y-1/2');
    }, 300);
}
