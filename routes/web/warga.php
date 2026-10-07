<?php

use App\Http\Controllers\RiwayatPemeriksaanController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/riwayat-pemeriksaan', [RiwayatPemeriksaanController::class, 'index'])
        ->name('riwayat.pemeriksaan');

    Route::middleware('role:admin,kader')->group(function () {
        Route::resource('warga', WargaController::class)
            ->only(['index', 'show']);
    });

    Route::middleware('role:admin')->group(function () {
        Route::resource('warga', WargaController::class)
            ->only([
                'create',
                'store',
                'edit',
                'update',
                'destroy',
            ]);
    });
});