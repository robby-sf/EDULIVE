{{-- MODAL UNTUK ADD/EDIT EDUCATION --}}
<div id="education-modal"
    class="modal-overlay hidden fixed inset-0 z-50 flex justify-center items-center p-4 transition-opacity duration-300 opacity-0">

    {{-- KONTEN MODAL (MODIFIED: Disesuaikan dengan biodata-form) --}}
    <div id="education-modal-content"
        class="bg-[#eeeeee] rounded-[40px] w-full max-w-6xl h-auto max-h-[90vh] overflow-y-auto p-8 md:p-12 transform transition-all duration-300 scale-95 opacity-0">

        {{-- FORM --}}
        <form id="education-form" method="POST" action="">
            @csrf
            <input type="hidden" name="_method" id="education-method-field">

            <div class="flex justify-between items-center mb-10">
                <h2 id="education-modal-title" class="text-black text-2xl md:text-4xl font-medium tracking-[2px]">
                    {_MODAL_TITLE_}
                </h2>
                <button type="button" class="close-education-modal text-gray-500 hover:text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                {{-- Education Level --}}
                <div class="md:col-span-2">
                    <label for="degree"
                        class="block text-black text-lg md:text-xl font-medium tracking-[1px] mb-2">Education
                        Level</label>
                    <select id="degree" name="degree"
                        class="w-full h-[60px] md:h-[69px] px-4 bg-white border border-black rounded-[10px] text-lg md:text-xl text-[#5e5e5e] focus:ring-2 focus:ring-black focus:outline-none">
                        <option value="" disabled selected>Select Education Level</option>
                        <option value="SMA/SMK">SMA/SMK</option>
                        <option value="D3 (Associate's Degree)">D3 (Associate's Degree)</option>
                        <option value="S1 (Bachelor's Degree)">S1 (Bachelor's Degree)</option>
                        <option value="S2 (Master's Degree)">S2 (Master's Degree)</option>
                        <option value="S3 (Doctoral Degree)">S3 (Doctoral Degree)</option>
                    </select>
                </div>

                {{-- Institution Name --}}
                <div class="md:col-span-2">
                    <label for="institution_name"
                        class="block text-black text-lg md:text-xl font-medium tracking-[1px] mb-2">Institution
                        Name</label>
                    <input type="text" id="institution_name" name="institution_name"
                        class="w-full h-[60px] md:h-[69px] px-5 bg-white border border-black rounded-[10px] text-lg md:text-xl text-[#5e5e5e] focus:ring-2 focus:ring-black focus:outline-none"
                        placeholder="e.g., University Sebelas Maret">
                </div>

                {{-- Major --}}
                <div class="md:col-span-2">
                    <label for="field_of_study"
                        class="block text-black text-lg md:text-xl font-medium tracking-[1px] mb-2">Major</label>
                    <input type="text" id="field_of_study" name="field_of_study"
                        class="w-full h-[60px] md:h-[69px] px-5 bg-white border border-black rounded-[10px] text-lg md:text-xl text-[#5e5e5e] focus:ring-2 focus:ring-black focus:outline-none"
                        placeholder="e.g., Teknik Informatika">
                </div>

                {{-- Year Enrolled & Year Graduated --}}
                <div>
                    <label for="start_year"
                        class="block text-black text-lg md:text-xl font-medium tracking-[1px] mb-2">Year
                        Enrolled</label>
                    <input type="number" id="start_year" name="start_year"
                        class="w-full h-[60px] md:h-[69px] px-5 bg-white border border-black rounded-[10px] text-lg md:text-xl text-[#5e5e5e] focus:ring-2 focus:ring-black focus:outline-none"
                        placeholder="e.g., 2023" min="1900" max="{{ date('Y') }}">
                </div>
                <div>
                    <label for="end_year"
                        class="block text-black text-lg md:text-xl font-medium tracking-[1px] mb-2">Year
                        Graduated</label>
                    <input type="number" id="end_year" name="end_year"
                        class="w-full h-[60px] md:h-[69px] px-5 bg-white border border-black rounded-[10px] text-lg md:text-xl text-[#5e5e5e] focus:ring-2 focus:ring-black focus:outline-none"
                        placeholder="e.g., 2026" min="1900" max="{{ date('Y') + 7 }}">
                </div>
            </div>

            <div class="flex items-center gap-6 mt-12">
                <button type="submit" id="education-submit-button"
                    class="px-8 py-3 bg-black rounded-[10px] text-white text-xl hover:bg-gray-800 transition">
                    Save
                </button>
                <button type="button" class="cancel-education-modal text-black text-xl hover:underline">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
