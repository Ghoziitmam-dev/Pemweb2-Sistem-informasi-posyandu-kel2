<?php

use App\Http\Controllers\PemeriksaanController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin,kader'])->group(function () {
    Route::resource('pemeriksaan', PemeriksaanController::class);
});