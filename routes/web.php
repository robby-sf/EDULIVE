<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/header', function () {
    return view('header');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// indo
