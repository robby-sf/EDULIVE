<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    /**
     * Menampilkan halaman profil publik seorang user.
     */
    public function show(User $user)
    {
        // Load relasi yang diperlukan agar tidak terjadi N+1 query
        $user->load(['profile', 'educations']);

        // Kirim data user ke view public.blade.php
        return view('profile.public', compact('user'));
    }
}
