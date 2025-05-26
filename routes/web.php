<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailBalasanController;
use App\Http\Controllers\JatahCutiController;
use App\Http\Controllers\PengajuanCutiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatCutiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'dashboard');

Route::middleware('guest')->prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('auth/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('role:super_admin')->prefix('pengguna')->group(function(){
        Route::get('', [UserController::class, 'index'])->name('pengguna.index');
        Route::get('create', [UserController::class, 'create'])->name('pengguna.create');
        Route::post('store', [UserController::class, 'store'])->name('pengguna.store');
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('pengguna.edit');
        Route::put('{id}/update', [UserController::class, 'update'])->name('pengguna.update');
        Route::delete('{id}/destroy', [UserController::class, 'destroy'])->name('pengguna.delete');
    });

    Route::prefix('jatah-cuti')->group(function(){
          Route::get('', [JatahCutiController::class, 'index'])->name('jatah-cuti');
          Route::post('', [JatahCutiController::class, 'store'])->name('jatah-cuti.store');
    });

    Route::prefix('pengajuan')->group(function(){
        Route::get('/', [PengajuanCutiController::class, 'index'])->name('pengajuan.cuti');
        Route::post('/store', [PengajuanCutiController::class, 'store'])->name('pengajuan.store');
        Route::get('/riwayat', [RiwayatCutiController::class, 'index'])->name('pengajuan.riwayat');
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('user.profile');
        Route::get('/surat-balasan', [DetailBalasanController::class, 'index'])->name('user.surat');
    });
    Route::get('/verifikasi-cuti', [PengajuanCutiController::class, 'verifikasi'])->name('cuti.verifikasi');
});
Route::get('/surat-cuti', function () {
    return view('section.surat.index');
})->name('cuti.surat');
