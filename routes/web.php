<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/belajar', function () {
    return view('Testing');
});


Route::post('/chat', [ChatController::class, 'chat']);