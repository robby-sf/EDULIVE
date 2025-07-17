<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::get('/header', function () {
    return view('header');
});

Route::view('/team/ravelin-lutfhan','team.ceo')->name('team.ceo');
Route::view('/team/rizky-amalia','team.cto')->name('team.cto');
Route::view('/team/rafi-amirudin','team.hrmanager')->name('team.hrmanager');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('homepage');
    })->name('homepage');
});
