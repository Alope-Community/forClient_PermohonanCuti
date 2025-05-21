<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::redirect('/', 'auth/login');
    Route::get('auth/login', [AuthController::class, 'loginPage'])->name('auth.login');
    Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login.post');
});

// Route::middleware('auth')->group(function () {
//     Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });
Route::get('/dashboard', function () {
    return view('section.dashboard.index');
});
Route::get('/user', function () {
    return view('section.user.index');
});
