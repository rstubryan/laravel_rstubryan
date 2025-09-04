<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RumahSakitController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('login.post');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('pasien')->group(function () {
        Route::get('/', [PasienController::class, 'index'])->name('pasien.index');
        Route::post('/', [PasienController::class, 'store'])->name('pasien.store');
        Route::get('/{id}', [PasienController::class, 'show'])->name('pasien.show');
        Route::put('/{id}', [PasienController::class, 'update'])->name('pasien.update');
        Route::get('/{id}/edit', [PasienController::class, 'edit'])->name('pasien.edit');
        Route::delete('/{id}', [PasienController::class, 'destroy'])->name('pasien.destroy');
    });
    Route::prefix('rumah-sakit')->group(function () {
        Route::get('/', [RumahSakitController::class, 'index'])->name('rumah-sakit.index');
        Route::post('/', [RumahSakitController::class, 'store'])->name('rumah-sakit.store');
        Route::get('/{id}', [RumahSakitController::class, 'show'])->name('rumah-sakit.show');
        Route::put('/{id}', [RumahSakitController::class, 'update'])->name('rumah-sakit.update');
        Route::get('/{id}/edit', [RumahSakitController::class, 'edit'])->name('rumah-sakit.edit');
        Route::delete('/{id}', [RumahSakitController::class, 'destroy'])->name('rumah-sakit.destroy');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
});
