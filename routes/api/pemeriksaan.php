<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PemeriksaanController;

Route::middleware('role:admin,kader')->group(function () {
    Route::apiResource(
        'pemeriksaan',
        PemeriksaanController::class
    );
});