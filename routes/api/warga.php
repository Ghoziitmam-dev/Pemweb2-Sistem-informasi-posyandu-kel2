<?php

use App\Http\Controllers\Api\WargaController;
use Illuminate\Support\Facades\Route;

Route::middleware('role:admin,kader')->group(function () {
    Route::apiResource('warga', WargaController::class);
});