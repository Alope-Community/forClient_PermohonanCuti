<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailBalasanController;
use App\Http\Controllers\PengajuanCutiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatCutiController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'dashboard');

Route::middleware('guest')->prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('auth/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('user')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('user.profile');
        Route::get('/pengajuan', [PengajuanCutiController::class, 'index'])->name('user.pengajuan');
        Route::get('/riwayat', [RiwayatCutiController::class, 'index'])->name('user.riwayat');
        Route::get('/surat-balasan', [DetailBalasanController::class, 'index'])->name('user.surat');
    });
});
route::get('/verifikasi-cuti', function () {
    return view('section.verification.index');
})->name('cuti.verifikasi');
