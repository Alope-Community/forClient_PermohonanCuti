<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanCutiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::redirect('/', 'auth/login');
    Route::get('auth/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('auth/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('user')->group(function(){
        Route::get('/', [ProfileController::class, 'index'])->name('user.profile');
        Route::get('/pengajuan', [PengajuanCutiController::class, 'index'])->name('user.pengajuan');
    });

});
