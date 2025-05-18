<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function(){
    Route::redirect('/', 'auth/login');
    Route::get('auth/login',[AuthController::class, 'loginPage'])->name('auth.login');
    Route::post('auth/login',[AuthController::class, 'login'])->name('auth.login.post');

});
