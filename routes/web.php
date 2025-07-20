<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\StudyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/belajar', function () {
    return view('Testing');
});


Route::post('/chat', [ChatController::class, 'chat']);

Route::post('/study-sessrion', [StudyController::class, 'store']);