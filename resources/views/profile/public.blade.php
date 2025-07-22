@extends('layouts.app')

@section('title', $user->name . "'s Profile")

@section('content')
    <div class="bg-white min-h-screen py-12 px-4 sm:px-8 lg:px-24">
        <div class="container mx-auto">
            {{-- CARD BANNER PROFIL PUBLIK --}}
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 max-w-4xl mx-auto">
                <div class="flex flex-col md:flex-row items-center md:items-start text-center md:text-left gap-6">

                    {{-- FOTO PROFIL --}}
                    <div class="relative flex-shrink-0">
                        <div class="w-40 h-40 md:w-48 md:h-48 rounded-full shadow-md">
                            {{-- Menampilkan gambar dari storage atau fallback dari UI Avatars --}}
                            <img src="{{ $user->profile?->profile_image ? asset('storage/' . $user->profile->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=EBF4FF&color=7F9CF5&size=192' }}"
                                alt="Profile picture of {{ $user->name }}" class="w-full h-full rounded-full object-cover">
                        </div>
                    </div>

                    {{-- NAMA DAN INFO DASAR --}}
                    <div class="flex-grow w-full">
                        <h1 class="text-black text-3xl md:text-4xl font-bold tracking-wide">{{ $user->name }}</h1>
                        <div class="mt-4 space-y-2">
                            @if ($user->profile?->address_location)
                                <p
                                    class="text-[#5E5E5E] text-sm flex items-center justify-center md:justify-start gap-2 font-light">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
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
                    </div>
                </div>
            </div>

            {{-- PERSONAL SUMMARY --}}
            @if ($user->profile?->personal_summary)
                <div class="mt-10 pt-6 border-t border-gray-200 max-w-4xl mx-auto">
                    <h2 class="text-xl font-semibold text-gray-900">Personal Summary</h2>
                    <div
                        class="flex items-center justify-between w-full px-6 py-4 border border-gray-300 rounded-lg bg-white">
                        <p class="text-[#5E5E5E] mt-2 text-justify">{{ $user->profile->personal_summary }}</p>
                    </div>
                </div>
            @endif

            {{-- EDUCATION HISTORY --}}
            <div class="mt-10 pt-6 border-t border-gray-200 max-w-4xl mx-auto">
                <h2 class="text-xl font-semibold text-gray-900">Education History</h2>
                <div class="mt-4 space-y-4">
                    @forelse ($user->educations as $education)
                        <div class="flex items-start gap-4 p-4 border rounded-lg">
                            <div class="flex-shrink-0 w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                {{-- Ikon Edukasi --}}
                            </div>
                            <div class="flex-grow">
                                <p class="font-bold text-gray-800">{{ $education->institution_name }}</p>
                                <p class="text-sm text-gray-600">{{ $education->degree }} - {{ $education->field_of_study }}
                                </p>
                                <p class="text-sm text-gray-500">{{ $education->start_year }} - {{ $education->end_year }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 border-2 border-dashed rounded-lg">
                            <p class="text-gray-500">No education history available.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
