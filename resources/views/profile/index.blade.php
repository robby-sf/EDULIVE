@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <div class="bg-white min-h-screen py-12 px-20 sm:px-24 lg:px-36">
        <div class="container mx-auto ">
            <div class="mb-12">
                <div class="flex justify-between items-center mb-3 px-2">
                    <h3 class="text-black text-lg font-normal tracking-[1px] normal-case">COMPLETNESS OF PROFILE</h3>
                    <span class="text-black text-lg font-normal tracking-[1px]">{{ $user->profile_completeness }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-[16px] shadow-[0px_4px_16.5px_0px_rgba(0,0,0,0.25)]">
                    <div class="bg-gray-400 h-[16px] rounded-full" style="width: {{ $user->profile_completeness }}%;"></div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 md:p-8">
            <div class="flex flex-col md:flex-row items-center md:items-start text-center md:text-left gap-6">

                <div class="relative flex-shrink-0">
                    <div class="w-40 h-40 md:w-48 md:h-48 rounded-full shadow-lg">
                        <img id="profile-picture-display"
                            src="{{ $user->profile?->profile_image ? asset('storage/' . $user->profile->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=D9D9D9&color=616161&size=192' }}"
                            alt="Profile Picture" class="w-full h-full rounded-full object-cover">
                    </div>

                    <button id="edit-picture-btn"
                        class="absolute bottom-2 right-2 w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-gray-100 transition shadow-md border border-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L14.732 3.732z" />
                        </svg>
                    </button>
                </div>

                <div class="flex-grow w-full">
                    <h1 class="text-black text-3xl md:text-4xl font-bold tracking-wide">{{ $user->name }}</h1>

                    <div class="mt-4 space-y-2">
                        @if ($user->profile && $user->profile->address_location)
                            <p
                                class="text-[#5E5E5E] text-sm flex items-center justify-center md:justify-start gap-2 font-light">
                                <img src="https://img.icons8.com/ios-glyphs/30/5e5e5e/marker.png" alt="location icon"
                                    class="w-5 h-5" />
                                <span>{{ $user->profile->address_location }}</span>
                            </p>
                        @endif
                        <p
                            class="text-[#5E5E5E] text-sm flex items-center justify-center md:justify-start gap-2 font-light">
                            <img src="https://img.icons8.com/ios-glyphs/30/5e5e5e/filled-message.png" alt="email icon"
                                class="w-5 h-5" />
                            <span>{{ $user->email }}</span>
                        </p>
                    </div>

                    <div class="mt-6 flex flex-wrap gap-4 justify-center md:justify-start">
                        <button id="edit-biodata-btn" data-address="{{ $user->profile->address_location ?? '' }}"
                            class="px-5 py-2.5 bg-white text-black text-sm font-medium border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 transition">
                            Change Profile
                        </button>
                        <button id="share-profile-btn"
                            data-share-url="{{ route('profile.public', ['user' => $user->name]) }}"
                            class="px-5 py-2.5 bg-white text-black text-sm font-medium border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 transition">
                            Share
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. MODAL UNTUK UPLOAD GAMBAR --}}
        <div id="picture-upload-modal"
            class="hidden fixed inset-0 z-50 flex justify-center items-center p-4 transition-opacity duration-300">
            <div id="picture-upload-content"
                class="bg-[#EEEEEE] rounded-2xl shadow-xl w-full max-w-md p-6 transform transition-all">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-medium text-gray-800">Update Profile Picture</h2>
                    <button id="cancel-upload-btn" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                <form id="picture-upload-form" action="{{ route('profile.update.picture') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mt-4">
                        <label for="profile_image_input" class="sr-only">Choose file</label>
                        <input type="file" name="profile_image" id="profile_image_input"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-black file:text-white  hover:file:bg-[#616161] transition"
                            required>
                        <p class="text-xs text-gray-500 mt-2">PNG, JPG, GIF up to 2MB.</p>
                    </div>
                    <div class="mt-6 flex justify-end gap-4">
                        <button type="submit"
                            class="px-5 py-2 text-sm font-medium tracking-wider bg-black text-white rounded-lg hover:bg-[#616161] transition">Upload</button>
                    </div>
                </form>
            </div>
        </div>


        {{-- PERSONAL SUMMARY --}}
        <div class="mt-10 pt-6 border-t border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Personal Summary</h2>

            @if ($user->profile?->personal_summary)
                <div class="mt-2 flex items-center justify-between w-full px-6 py-4 border border-gray-300 rounded-lg bg-white">
                    {{-- Teks summary --}}
                    <p id="summary-text-display" class="text-[#5E5E5E]">{{ $user->profile->personal_summary }}</p>

                    <button id="edit-summary-btn" class="text-gray-600 hover:text-gray-500 flex-shrink-0 ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 7.125L18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </button>
                </div>
            @else
                {{-- Bagian ini tetap sama jika summary belum ada --}}
                <p class="text-gray-500 mt-2">Add a personal summary to your profile as a way to introduce who you are.</p>
                <button id="add-summary-btn"
                    class="mt-3 px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg font-semibold text-sm text-gray-700 hover:bg-gray-200 transition">
                    Add Summary
                </button>
            @endif
        </div>

        {{-- EDUCATION HISTORY --}}
        <div class="mt-10 pt-6 border-t border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-900">Education History</h2>
                <button id="add-education-btn"
                    class="px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-sm text-gray-700 hover:bg-gray-100 transition">
                    + Add Education
                </button>
            </div>

            <div id="education-list-container" data-store-url="{{ route('profile.education.store') }}"
                data-base-update-url="{{ route('profile.index') }}/education">

                <div id="education-list" class="space-y-4">
                    {{-- Loop untuk setiap item pendidikan --}}
                    @forelse ($user->educations as $education)
                        <div id="education-item-{{ $education->id }}"
                            class="flex items-center gap-4 px-8 py-4 border border-gray-300 rounded-lg bg-white">
                            {{-- Ikon Pendidikan --}}
                            <div class="flex-shrink-0 w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0l-.07.004-.018.002-.006.001l-.004.001l-.002.001l-.001.001A49.954 49.954 0 0112 15.11a49.955 49.955 0 018.232-4.965l-.001-.001l-.002-.001l-.004-.001l-.006-.001l-.018-.002l-.07-.004m-15.482 0l-2.072-1.036A49.92 49.92 0 0012 3.493a49.92 49.92 0 0010.399 5.62l-2.072 1.036m-15.482 0A50.065 50.065 0 0112 15.11a50.065 50.065 0 018.232-4.965" />
                                </svg>
                            </div>

                            {{-- Detail Pendidikan --}}
                            <div class="flex-grow">
                                <p class="font-medium text-gray-800">{{ $education->institution_name }}</p>
                                <p class="text-sm text-gray-600">{{ $education->degree }} &middot;
                                    {{ $education->field_of_study }}</p>
                                <p class="text-sm text-gray-500">{{ $education->start_year }} -
                                    {{ $education->end_year }}</p>
                            </div>

                            <div class="flex-shrink-0 flex gap-6">
                                <button class="edit-education-btn text-gray-600 hover:text-gray-500"
                                    data-id="{{ $education->id }}" data-institution="{{ $education->institution_name }}"
                                    data-degree="{{ $education->degree }}" data-field="{{ $education->field_of_study }}"
                                    data-start="{{ $education->start_year }}" data-end="{{ $education->end_year }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 7.125L18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </button>
                                <button class="delete-education-btn text-gray-500 hover:text-red-600"
                                    data-id="{{ $education->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div id="no-education-record" class="text-center py-10 border-2 border-dashed rounded-lg">
                            <p class="text-gray-500">No education history has been added yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        @include('profile.biodata-form')
        @include('partials.share-modal')
        @include('profile.summary-form')
        @include('profile.education-modal')
    </div>
    </div>
@endsection
