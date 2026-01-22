<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\ResponseController;

Route::get('auth/register', [AuthController::class,
        'showRegisterForm'])->name('register');
        
Route::post('auth/postRegister', [AuthController::class,
    'register'])->name('postRegister');

Route::get('auth/login', [AuthController::class,
    'showLoginForm'])->name('login');

Route::post('auth/postLogin', [AuthController::class,
    'login'])->name('postLogin');

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('aspirasi', AspirasiController::class);

    Route::post('aspirasi/{aspirasi}/responses',
[ResponseController::class, 'store'])->name('responses.store');

    Route::middleware(['CekRole:admin'])->group(function () {
        Route::post('aspirasi/{aspirasi}/update-status',
        [AspirasiController::class, 'updateStatus'])->name('aspirasi.updateStatus');
    });
});
