<?php

use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('tasks', TaskController::class);
    Route::post('tasks/{task}/assign', [TaskController::class, 'assign']);
});
