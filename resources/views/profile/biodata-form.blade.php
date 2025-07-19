<div id="biodata-modal" class="modal-overlay hidden fixed inset-0 z-50 flex justify-center items-center p-4 transition-opacity duration-300">

    <div id="biodata-modal-content" class="bg-[#eeeeee] rounded-[40px] w-full max-w-6xl h-auto max-h-[90vh] overflow-y-auto p-8 md:p-12 transform transition-all duration-300 scale-95 opacity-0">

        <form id="biodata-form" method="POST" action="{{ route('profile.update.biodata') }}">
            @csrf
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-black text-2xl md:text-4xl font-medium tracking-[2px]">Edit Personal Details</h2>
                <button type="button" id="close-biodata-modal" class="text-gray-500 hover:text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                {{-- First Name --}}
                <div>
                    <label for="first_name" class="block text-black text-lg md:text-xl font-medium tracking-[1px] mb-2">First Name</label>
                    <input type="text" id="first_name" name="first_name" value="{{ $user->profile->first_name ?? '' }}"
                           class="w-full h-[60px] md:h-[69px] px-5 bg-white border border-black rounded-[10px] text-lg md:text-xl text-[#5e5e5e] focus:ring-2 focus:ring-black focus:outline-none"
                           placeholder="Your first name">
                </div>

                {{-- Last Name --}}
                <div>
                    <label for="last_name" class="block text-black text-lg md:text-xl font-medium tracking-[1px] mb-2">Last Name</label>
                    <input type="text" id="last_name" name="last_name" value="{{ $user->profile->last_name ?? '' }}"
                           class="w-full h-[60px] md:h-[69px] px-5 bg-white border border-black rounded-[10px] text-lg md:text-xl text-[#5e5e5e] focus:ring-2 focus:ring-black focus:outline-none"
                           placeholder="Your last name">
                </div>

                {{-- Home Location - Country --}}
                <div class="md:col-span-2">
                    <label for="country" class="block text-black text-lg md:text-xl font-medium tracking-[1px] mb-2">Country</label>
                    <select id="country" name="country" class="w-full h-[60px] md:h-[69px] px-4 bg-white border border-black rounded-[10px] text-lg md:text-xl text-[#5e5e5e] focus:ring-2 focus:ring-black focus:outline-none">
                        <option value="">Select Country</option>
                    </select>
                </div>

                {{-- Home Location - State/Province --}}
                <div>
                    <label for="state" class="block text-black text-lg md:text-xl font-medium tracking-[1px] mb-2">State / Province</label>
                    <select id="state" name="state" class="w-full h-[60px] md:h-[69px] px-4 bg-white border border-black rounded-[10px] text-lg md:text-xl text-[#5e5e5e] focus:ring-2 focus:ring-black focus:outline-none" disabled>
                        <option value="">Select State</option>
                    </select>
                </div>

                {{-- Home Location - City --}}
                <div>
                    <label for="city" class="block text-black text-lg md:text-xl font-medium tracking-[1px] mb-2">City</label>
                    <select id="city" name="city" class="w-full h-[60px] md:h-[69px] px-4 bg-white border border-black rounded-[10px] text-lg md:text-xl text-[#5e5e5e] focus:ring-2 focus:ring-black focus:outline-none" disabled>
                        <option value="">Select City</option>
                    </select>
                </div>
                <input type="hidden" name="address_location" id="address_location">

                {{-- Phone Number --}}
                <div class="md:col-span-2 grid grid-cols-3 gap-x-4">
                    <div class="col-span-1">
                        <label for="phone_code" class="block text-black text-lg md:text-xl font-medium tracking-[1px] mb-2">Code</label>
                        <select id="phone_code" name="phone_code" class="w-full h-[60px] md:h-[69px] px-4 bg-white border border-black rounded-[10px] text-lg md:text-xl text-[#5e5e5e] focus:ring-2 focus:ring-black focus:outline-none">
                            <option value="">Code</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="phone_number_input" class="block text-black text-lg md:text-xl font-medium tracking-[1px] mb-2">Phone Number</label>
                        <input type="tel" id="phone_number_input" name="phone_number_input" class="w-full h-[60px] md:h-[69px] px-5 bg-white border border-black rounded-[10px] text-lg md:text-xl text-[#5e5e5e] focus:ring-2 focus:ring-black focus:outline-none" placeholder="81234567890">
                        <div id="phone-validation-message" class="text-sm mt-1 h-4"></div>
                    </div>
                </div>
                <input type="hidden" name="phone_number" id="phone_number">

                {{-- Email Address (Disabled) --}}
                <div class="md:col-span-2">
                    <label class="block text-black text-lg md:text-xl font-medium tracking-[1px] mb-2">Email Address</label>
                    <div class="flex justify-between items-center w-full h-[60px] md:h-[69px] px-5 bg-gray-200 border border-gray-400 rounded-[10px]">
                        <p class="text-lg md:text-xl text-gray-500">{{ $user->email }}</p>
                        <span class="text-sm font-medium text-gray-600">Cannot be changed</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-6 mt-12">
                <button type="submit" class="px-8 py-3 bg-black rounded-[10px] text-white text-xl hover:bg-gray-800 transition">
                    Save
                </button>
                <button type="button" id="cancel-biodata-modal" class="text-black text-xl hover:underline">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Notification placeholder --}}
<div id="notification" class="hidden fixed top-5 right-5 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full">
    <p id="notification-message"></p>
</div>
