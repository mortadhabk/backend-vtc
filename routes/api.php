<?php

use App\Http\Controllers\AuthController;
// use super admin controller
use App\Http\Controllers\SuperAdminController;

//auth 
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password',[AuthController::class, 'forgotPassword'])->middleware('guest')->name('password.email');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->middleware('guest')->name('password.update');

Route::middleware(['auth:sanctum', 'role:Super Admin'])->group(function () {
    Route::get('/super-admin-dashboard', [SuperAdminController::class, 'index']);
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    // Only accessible by Admin
    Route::get('/admin-dashboard', [AdminController::class, 'index']);
});

Route::middleware(['auth', 'role:User'])->group(function () {
    // Only accessible by regular User
    Route::get('/user-dashboard', [UserController::class, 'index']);
});





Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



