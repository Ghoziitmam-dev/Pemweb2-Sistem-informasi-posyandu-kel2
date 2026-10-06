<?php

use App\Http\Controllers\Api\JadwalController;
use App\Http\Controllers\Api\PendaftaranController;
use Illuminate\Support\Facades\Route;

Route::get('jadwal/opsi', [JadwalController::class, 'opsi'])
    ->middleware('role:admin,kader')->name('jadwal.opsi');

// Semua user login boleh melihat
Route::apiResource('jadwal', JadwalController::class)->only(['index', 'show']);

// Kelola jadwal: admin & kader
Route::middleware('role:admin,kader')->group(function () {
    Route::apiResource('jadwal', JadwalController::class)->only(['store', 'update', 'destroy']);

    Route::post('jadwal/{jadwal}/mulai', [JadwalController::class, 'mulai'])->name('jadwal.mulai');
    Route::post('jadwal/{jadwal}/selesai', [JadwalController::class, 'selesai'])->name('jadwal.selesai');
    Route::post('jadwal/{jadwal}/batal', [JadwalController::class, 'batal'])->name('jadwal.batal');

    Route::get('jadwal/{jadwal}/pendaftaran', [PendaftaranController::class, 'index'])->name('jadwal.pendaftaran.index');
});

// Daftar & batal daftar: warga
Route::middleware('role:warga')->group(function () {
    Route::post('jadwal/{jadwal}/pendaftaran', [PendaftaranController::class, 'store'])->name('jadwal.pendaftaran.store');
    Route::delete('jadwal/{jadwal}/pendaftaran', [PendaftaranController::class, 'destroy'])->name('jadwal.pendaftaran.destroy');
});