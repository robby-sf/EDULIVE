<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    public function show(User $user)
    {
        $user->load(['profile', 'educations']);

        return view('profile.public', compact('user'));
    }
}
