{{-- MODAL UNTUK ADD/EDIT PERSONAL SUMMARY --}}
<div id="summary-modal"
    class="modal-overlay hidden fixed inset-0 z-50 flex justify-center items-center p-4 transition-opacity duration-300 opacity-0">

    {{-- KONTEN MODAL --}}
    <div id="summary-modal-content"
        class="bg-[#eeeeee] rounded-[40px] w-full max-w-6xl h-auto max-h-[90vh] overflow-y-auto p-8 md:p-12 transform transition-all duration-300 scale-95 opacity-0">

        <form id="summary-form" method="POST" action="{{ route('profile.update.summary') }}">
            @csrf

            {{-- HEADER --}}
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-black text-2xl md:text-4xl font-medium tracking-[2px]">
                    Personal Summary
                </h2>
                <button type="button" id="close-summary-modal-btn" class="text-gray-500 hover:text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- KONTEN FORM --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <div class="md:col-span-2">
                    <label for="personal_summary"
                        class="block text-black text-lg md:text-xl font-medium tracking-[1px] mb-2">
                        Summary
                    </label>
                    <p class="text-[#5e5e5e] text-base md:text-lg font-normal tracking-[1px] font-['Poppins',_sans-serif] mb-4">
                        Highlight your unique experiences, ambitions, and strengths.
                    </p>
                    {{-- MODIFIED: Increased height for better visual balance --}}
                    <textarea id="personal_summary" name="personal_summary" rows="8"
                        class="w-full h-[340px] md:h-[357px] px-5 py-4 bg-white border border-black rounded-[10px] text-lg md:text-xl text-[#5e5e5e] focus:ring-2 focus:ring-black focus:outline-none resize-none font-['Poppins',_sans-serif]"
                        placeholder="Tell us about yourself...">{{ $user->profile?->personal_summary ?? '' }}</textarea>
                </div>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="flex items-center gap-6 mt-12">
                <button type="submit"
                    class="px-8 py-3 bg-black rounded-[10px] text-white text-xl font-normal tracking-[1px] hover:bg-gray-800 transition">
                    Save
                </button>
                <button type="button" id="cancel-summary-modal-btn"
                    class="text-black text-xl font-normal tracking-[1px] hover:underline">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
