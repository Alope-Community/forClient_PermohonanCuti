<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailBalasanController;
use App\Http\Controllers\JatahCutiController;
use App\Http\Controllers\PenerbitanController;
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

    Route::prefix('pengguna')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('pengguna.index');
        Route::get('create', [UserController::class, 'create'])->name('pengguna.create');
        Route::post('store', [UserController::class, 'store'])->name('pengguna.store');
        Route::delete('{id}/destroy', [UserController::class, 'destroy'])->name('pengguna.delete');
    });

    Route::prefix('jatah-cuti')->group(function () {
        Route::get('', [JatahCutiController::class, 'index'])->name('jatah-cuti');
        Route::post('', [JatahCutiController::class, 'store'])->name('jatah-cuti.store');
        Route::get('{jatahCuti}/edit', [JatahCutiController::class, 'edit'])->name('jatah-cuti.edit');
        Route::put('{jatahCuti}/update', [JatahCutiController::class, 'update'])->name('jatah-cuti.upadte');
        Route::delete('{jatahCuti}/delete', [JatahCutiController::class, 'destroy'])->name('jatah-cuti.destroy');
    });

    Route::prefix('pengajuan')->group(function () {
        Route::get('/', [PengajuanCutiController::class, 'index'])->name('pengajuan.cuti');
        Route::post('/store', [PengajuanCutiController::class, 'store'])->name('pengajuan.store');
        Route::get('/riwayat', [RiwayatCutiController::class, 'index'])->name('pengajuan.riwayat');
         Route::get('{cuti}/surat-balasan', [DetailBalasanController::class, 'index'])->name('pengajuan.balasan');
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('user.profile');
        Route::put('{user}/update', [ProfileController::class, 'update'])->name('user.profile.update');
        Route::put('{user}change-password', [ProfileController::class, 'changePassword'])->name('user.profile.changerPassword');
    });

    Route::get('/penerbitan', [PenerbitanController::class, 'index'])->name('penerbitan.index');

    Route::get('/verifikasi-cuti', [PengajuanCutiController::class, 'index'])->name('cuti.verifikasi');
    Route::get('/verifikasi-cuti/edit/{id}', [PengajuanCutiController::class, 'formEdit'])->name('cuti.verifikasi.edit');
    Route::put('/verifikasi-cuti/update/{id}', [PengajuanCutiController::class, 'update'])->name('cuti.verifikasi.update');

    Route::get('/surat-cuti', function () {
        return view('section.surat.index');
    })->name('cuti.surat');
});
