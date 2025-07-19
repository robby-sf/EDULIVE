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
                {{-- Modified: Warna, tinggi, dan shadow disesuaikan --}}
                <div class="w-full bg-gray-200 rounded-full h-[16px] shadow-[0px_4px_16.5px_0px_rgba(0,0,0,0.25)]">
                    <div class="bg-gray-400 h-[16px] rounded-full" style="width: {{ $user->profile_completeness }}%;"></div>
                </div>
            </div>
        </div>

        {{-- CARD BANNER UNTUK PROFIL USER --}}
        <div class="bg-white rounded-2xl shadow-md p-6 md:p-8">
            <div class="flex flex-col md:flex-row items-center md:items-start text-center md:text-left gap-6">

                <div class="relative flex-shrink-0">
                    <div class="w-40 h-40 md:w-48 md:h-48 rounded-full shadow-lg">
                        {{-- Cek jika user punya foto profil, jika tidak, tampilkan inisial --}}
                        @if ($user->profile && $user->profile->profile_image)
                            <img src="{{ asset('storage/' . $user->profile->profile_image) }}" alt="Profile Picture"
                                class="w-full h-full rounded-full object-cover">
                        @else
                            <div
                                class="w-full h-full bg-gray-200 rounded-full flex items-center justify-center overflow-hidden">
                                <span
                                    class="text-7xl font-bold text-gray-500">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            </div>
                        @endif
                    </div>

                    <button
                        class="absolute bottom-2 right-2 w-10 h-10 bg-white rounded-full flex items-center justify-center text[#] hover:bg-gray-100 transition shadow-md border border-gray-200">
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

        {{-- PERSONAL SUMMARY --}}
        <div class="mt-10 pt-6 border-t border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Personal Summary</h2>
            @if ($user->profile && $user->profile->personal_summary)
                <p class="text-[#5E5E5E] mt-2 text-justify">{{ $user->profile->personal_summary }}</p>
                <button id="edit-summary-btn" class="mt-3 text-sm font-semibold text-blue-600 hover:underline">Edit
                    Summary</button>
            @else
                <p class="text-gray-500 mt-2">Add a personal summary to your profile as a way to introduce who you
                    are.
                </p>
                <button id="add-summary-btn"
                    class="mt-3 px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg font-semibold text-sm text-gray-700 hover:bg-gray-200 transition">Add
                    Summary</button>
            @endif
        </div>

        <div class="mt-10 pt-6 border-t border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-900">Education History</h2>
                <button id="add-education-btn"
                    class="px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-sm text-gray-700 hover:bg-gray-100 transition">+
                    Add Education</button>
            </div>
            <div id="education-list" class="mt-4 space-y-4">
                @forelse ($user->educations as $education)
                    <div class="flex items-start gap-4 p-4 border rounded-lg">
                        <div class="flex-shrink-0 w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text[#]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div class="flex-grow">
                            <p class="font-bold text-gray-800">{{ $education->institution_name }}</p>
                            <p class="text-sm text[#]">{{ $education->degree }} -
                                {{ $education->field_of_study }}
                            </p>
                            <p class="text-sm text-gray-500">{{ $education->start_year }} -
                                {{ $education->end_year }}
                            </p>
                        </div>
                        <div class="flex gap-2">
                            <button class="edit-education-btn text-gray-500 hover:text-blue-600"
                                data-id="{{ $education->id }}" data-institution="{{ $education->institution_name }}"
                                data-degree="{{ $education->degree }}" data-field="{{ $education->field_of_study }}"
                                data-start="{{ $education->start_year }}" data-end="{{ $education->end_year }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-1.172 1.172-2.828-2.828L13.586 3.586zM12 5l-8 8V17h4l8-8-4-4z" />
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
                    <div class="text-center py-8 border-2 border-dashed rounded-lg">
                        <p class="text-gray-500">No education history has been added.</p>
                    </div>
                @endforelse
            </div>
        </div>

        @include('profile.biodata-form')
        @include('partials.share-modal')
    </div>
    </div>
@endsection
