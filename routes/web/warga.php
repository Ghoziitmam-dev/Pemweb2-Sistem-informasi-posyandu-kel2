<?php

use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::resource('warga', WargaController::class)
        ->only(['index', 'show']);

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