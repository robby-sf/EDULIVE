<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Education;
class ProfileController extends Controller
{
    public function index() {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->load(['profile', 'educations']);
        return view('profile.index', compact('user'));
    }

    public function updateBiodata(Request $request) {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'address_location' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
        ]);

        $user->name = $validated['first_name'] . ' ' . $validated['last_name'];
        $user->save();

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'address_location' => $validated['address_location'],
                'phone_number' => $validated['phone_number'],
            ]
        );

        return response()->json(['message' => 'Biodata successfully updated!']);
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

        return response()->json(['message' => 'Summary successfully saved!']);
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
            'message' => 'Education history added!',
            'education' => $education // Mengirim kembali data yang baru dibuat
        ]);
    }

    public function updateEducation(Request $request, Education $education) {
        // Pastikan pengguna hanya bisa mengedit data miliknya sendiri
        if ($education->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
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
            'message' => 'Education history updated!',
            'education' => $education
        ]);
    }

    public function deleteEducation(Education $education) {
        if ($education->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $education->delete();

        return response()->json(['message' => 'Education history removed!']);
    }
}
