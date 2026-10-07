<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KegiatanController;

Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
Route::get('kegiatan/{kegiatan}', [KegiatanController::class, 'show'])->name('kegiatan.show');

Route::middleware('role:admin,kader')->group(function () {
    Route::post('kegiatan', [KegiatanController::class, 'store'])->name('kegiatan.store');
    Route::put('kegiatan/{kegiatan}', [KegiatanController::class, 'update'])->name('kegiatan.update');
    Route::delete('kegiatan/{kegiatan}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');
});