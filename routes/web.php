<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

Route::get('/register', function () {
    return view('register');
});

Route::post('/api/register', [RegisterController::class, 'register'])->name('api.register');
Route::get('/verify/{token}', [RegisterController::class, 'verify'])->name('api.verify');

Route::post('/resend', [RegisterController::class, 'resendVerification']);
