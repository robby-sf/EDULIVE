<div id="education-modal"
    class="modal-overlay hidden fixed inset-0 z-50 flex justify-center items-center p-4 bg-black bg-opacity-50 transition-opacity duration-300 opacity-0">

    {{-- KONTEN MODAL --}}
    <div id="education-modal-content"
        class="bg-white rounded-2xl w-full max-w-2xl h-auto max-h-[90vh] overflow-y-auto p-8 transform transition-all duration-300 scale-95 opacity-0">

        {{-- FORM --}}
        <form id="education-form" method="POST" action="">
            @csrf
            {{-- Method spoofing untuk 'EDIT' --}}
            <input type="hidden" name="_method" id="education-method-field">

            {{-- HEADER --}}
            <div class="flex justify-between items-center mb-8">
                <h2 id="education-modal-title" class="text-black text-3xl font-bold tracking-wide">
                    Add Education History
                </h2>
                <button type="button" class="close-education-modal text-gray-400 hover:text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- KONTEN FORM --}}
            <div class="space-y-5">
                {{-- Education Level --}}
                <div>
                    <label for="degree" class="block text-sm font-medium text-gray-800 mb-1">Education Level</label>
                    <select id="degree" name="degree"
                        class="w-full h-12 px-4 bg-gray-50 border border-gray-300 rounded-lg text-base text-gray-900 focus:ring-2 focus:ring-black focus:outline-none">
                        <option value="" disabled selected>Select Education Level</option>
                        <option value="SMA/SMK">SMA/SMK</option>
                        <option value="D3 (Associate's Degree)">D3 (Associate's Degree)</option>
                        <option value="S1 (Bachelor's Degree)">S1 (Bachelor's Degree)</option>
                        <option value="S2 (Master's Degree)">S2 (Master's Degree)</option>
                        <option value="S3 (Doctoral Degree)">S3 (Doctoral Degree)</option>
                    </select>
                </div>

                {{-- Institution Name --}}
                <div>
                    <label for="institution_name" class="block text-sm font-medium text-gray-800 mb-1">Institution Name</label>
                    <input type="text" id="institution_name" name="institution_name"
                        class="w-full h-12 px-4 bg-gray-50 border border-gray-300 rounded-lg text-base text-gray-900 focus:ring-2 focus:ring-black focus:outline-none"
                        placeholder="e.g., University Sebelas Maret">
                </div>

                {{-- Major --}}
                <div>
                    <label for="field_of_study" class="block text-sm font-medium text-gray-800 mb-1">Major</label>
                    <input type="text" id="field_of_study" name="field_of_study"
                        class="w-full h-12 px-4 bg-gray-50 border border-gray-300 rounded-lg text-base text-gray-900 focus:ring-2 focus:ring-black focus:outline-none"
                        placeholder="e.g., Teknik Informatika">
                </div>

                {{-- Year Enrolled & Year Graduated --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="start_year" class="block text-sm font-medium text-gray-800 mb-1">Year Enrolled</label>
                        <input type="number" id="start_year" name="start_year"
                            class="w-full h-12 px-4 bg-gray-50 border border-gray-300 rounded-lg text-base text-gray-900 focus:ring-2 focus:ring-black focus:outline-none"
                            placeholder="e.g., 2023" min="1900" max="{{ date('Y') }}">
                    </div>
                    <div>
                        <label for="end_year" class="block text-sm font-medium text-gray-800 mb-1">Year Graduated</label>
                        <input type="number" id="end_year" name="end_year"
                            class="w-full h-12 px-4 bg-gray-50 border border-gray-300 rounded-lg text-base text-gray-900 focus:ring-2 focus:ring-black focus:outline-none"
                            placeholder="e.g., 2026" min="1900" max="{{ date('Y') + 7 }}">
                    </div>
                </div>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="flex items-center gap-4 mt-8">
                <button type="submit" id="education-submit-button"
                    class="px-8 py-3 bg-black rounded-lg text-white text-base font-medium hover:bg-gray-800 transition">
                    Save
                </button>
                <button type="button" class="cancel-education-modal text-black text-base font-medium hover:underline">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
