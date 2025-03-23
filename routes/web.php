<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

Route::post('/api/register', [RegisterController::class, 'register'])->name('api.register');
Route::get('/verify/{token}', [RegisterController::class, 'verify'])->name('api.verify');
Route::post('/resend', [RegisterController::class, 'resendVerification']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');



Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});

