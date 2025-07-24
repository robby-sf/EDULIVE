<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Education;
use Exception;

class ProfileController extends Controller
{
    public function index() {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->load(['profile', 'educations']);
        return view('profile.index', compact('user'));
    }

    public function updateBiodata(Request $request) {
        try {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'address_location' => 'required|string|max:255',
                'phone_number' => 'required|string|max:20',
            ], [
                'name.required' => 'Nama harus diisi.',
                'address_location.required' => 'Alamat harus diisi.',
                'phone_number.required' => 'Nomor telepon harus diisi.',
            ]);

            DB::transaction(function () use ($user, $validated) {
                $user->update(['name' => $validated['name']]);

                $user->profile()->updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'address_location' => $validated['address_location'],
                        'phone_number' => $validated['phone_number'],
                    ]
                );
            });

            return response()->json([
                'success' => true,
                'message' => 'Biodata successfully updated!',
            ]);

        } catch (Exception $e) {
            Log::error('Error updating biodata: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred. Please try again later.',
            ], 500);
        }
    }

    public function updatePicture(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi: harus gambar, maks 2MB
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $profile = $user->profile()->firstOrCreate(['user_id' => $user->id]);

        if ($profile->profile_image && Storage::disk('public')->exists($profile->profile_image)) {
            Storage::disk('public')->delete($profile->profile_image);
        }

        $path = $request->file('profile_image')->store('avatars', 'public');

        $profile->update(['profile_image' => $path]);

        return response()->json([
            'success' => true,
            'message' => 'Profile picture updated successfully!',
            'path' => $path
        ]);
    }

    public function updateSummary(Request $request) {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'personal_summary' => 'required|string|max:1000',
        ]);

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return response()->json([
            'success' => true,
            'message' => 'Summary successfully saved!',
        ]);
    }

    public function storeEducation(Request $request) {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'institution_name' => 'required|string|max:255',
            'degree' => 'required|string|max:100',
            'field_of_study' => 'required|string|max:150',
            'start_year' => 'required|digits:4|integer|min:1900',
            'end_year' => 'required|digits:4|integer|min:1900|gte:start_year',
        ]);

        $education = $user->educations()->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Education history added!',
            'data' => $education // Gunakan key 'data'
        ]);
    }

    public function updateEducation(Request $request, Education $education) {
        if ($education->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.',
            ], 403);
        }

        $validated = $request->validate([
            'institution_name' => 'required|string|max:255',
            'degree' => 'required|string|max:100',
            'field_of_study' => 'required|string|max:150',
            'start_year' => 'required|digits:4|integer|min:1900',
            'end_year' => 'required|digits:4|integer|min:1900|gte:start_year',
        ]);

        $education->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Education history updated!',
            'data' => $education
        ]);
    }

    public function deleteEducation(Education $education) {
        if ($education->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.',
            ], 403);
        }

        $education->delete();

        return response()->json([
            'success' => true,
            'message' => 'Education history removed!',
        ]);
    }
}
