<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\DashboardController;

// Route::get('/', function () {
//     return view('homepage');
// })->name('homepage');

Route::get('/header', function () {
    return view('header');
});

Route::view('/team/ravelin-lutfhan','team.member1')->name('team.member1');
Route::view('/team/robby-septian','team.member2')->name('team.member2');
Route::view('/team/rifqi-makarim','team.member3')->name('team.member3');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/dashboard/statistic', [DashboardController::class, 'statistic'])->name('dashboard.statistic');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/p/{user:name}', [PublicProfileController::class, 'show'])->name('profile.public');

Route::middleware(['auth'])->group(function () {
    Route::get('/homepage', function () {
        return view('homepage');
    })->name('homepage');

     Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::post('/biodata', [ProfileController::class, 'updateBiodata'])->name('update.biodata');
        Route::post('/summary', [ProfileController::class, 'updateSummary'])->name('update.summary');
        Route::post('/picture', [ProfileController::class, 'updatePicture'])->name('update.picture');

        // Education Routes
        Route::prefix('education')->name('education.')->group(function () {
            Route::post('/', [ProfileController::class, 'storeEducation'])->name('store');
            Route::put('/{education}', [ProfileController::class, 'updateEducation'])->name('update');
            Route::delete('/{education}', [ProfileController::class, 'deleteEducation   '])->name('delete');
        });
    });

    Route::get('/dashboard/statistic', [DashboardController::class, 'statistic'])->name('dashboard.statistic');
});

Route::get('/belajar', function () {
    return view('Testing');
});


Route::post('/chat', [ChatController::class, 'chat']);

Route::post('/study-session', [StudyController::class, 'store']);