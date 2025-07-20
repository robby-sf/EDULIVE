{{-- Modal untuk Share Profile --}}
<div id="share-modal"
    class="modal-overlay hidden fixed inset-0 z-50 flex justify-center items-center p-4 transition-opacity duration-300 opacity-0">
    <div id="share-modal-content"
        class="bg-[#eeeeee] rounded-[40px] w-full max-w-sm px-6 py-8 transform transition-all duration-300 scale-95 opacity-0 text-center relative">

        {{-- Tombol Close --}}
        <button id="close-share-modal-btn" class="absolute top-5 right-5 text-gray-500 hover:text-black">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        {{-- Judul --}}
        <h2 class="text-black text-[25px] font-medium text-left leading-tight mb-10">
            Your profile link is<br>ready
        </h2>

        {{-- Ilustrasi SVG --}}
        <div class="flex justify-center items-center mb-10">
            <svg width="128" height="108" viewBox="0 0 177 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M88.5001 140.097L0.243164 100.469C12.1877 114.574 34.5354 131.081 55.3208 140.097C69.9197 146.429 79.1339 146.972 88.5001 149.5V140.097Z"
                    fill="#616161" />
                <path
                    d="M87.6084 140.097L176.757 100.469C164.692 114.574 142.118 131.081 121.123 140.097C106.376 146.429 97.0692 146.972 87.6084 149.5V140.097Z"
                    fill="#616161" />
                <rect x="27.1406" y="0.5" width="119.357" height="79.011" rx="19" fill="black" />
                <rect x="40.3599" y="10.5864" width="94.4974" height="58.6798" rx="15" fill="white" />
                <rect x="46.4565" y="16.6829" width="82.3042" height="46.4866" rx="12" fill="black" />
                <rect x="57.7515" y="36.1995" width="20.9123" height="10.4561" transform="rotate(-45 57.7515 36.1995)"
                    fill="white" />
                <rect width="20.9123" height="10.4561"
                    transform="matrix(-0.707107 -0.707107 -0.707107 0.707107 116.529 36.1995)" fill="white" />
            </svg>
        </div>

        {{-- Input Link --}}
        <input type="text" id="profile-link-display" readonly
            class="w-full bg-white border border-gray-300 rounded-xl p-3 text-center text-gray-600 mb-6 select-all shadow-sm">

        {{-- Tombol --}}
        <div class="flex flex-col gap-3">
            <button id="copy-profile-link-btn"
                class="w-full bg-black text-white text-base font-medium py-3 rounded-xl hover:bg-gray-800 transition">
                Copy Link
            </button>
            <a href="#" id="preview-profile-link-btn" target="_blank"
                class="w-full text-black text-base font-medium py-3 rounded-xl hover:bg-gray-200 transition">
                Preview
            </a>
        </div>
    </div>
</div>
