{{-- Notification Component --}}
<div id="notification"
    class="hidden fixed top-8 right-8 z-[100] transform transition-all duration-300 translate-x-full">
    {{-- Container Notifikasi --}}
    <div
        class="flex items-center gap-4 w-full max-w-sm p-4 text-gray-900 bg-[#EEEEEE] rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.12)]">
        {{-- Ikon Notifikasi (akan diubah oleh JS) --}}
        <div id="notification-icon-container"
            class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 rounded-full">
            {{-- Placeholder untuk ikon success atau error --}}
        </div>

        {{-- Pesan Notifikasi --}}
        <div class="ms-3 text-sm font-normal">
            <span id="notification-title" class="mb-1 text-lg font-semibold"></span>
            <p id="notification-message" class="text-md font-normal"></p>
        </div>

        {{-- Tombol Tutup --}}
        <button type="button" id="notification-close-btn"
            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
</div>
