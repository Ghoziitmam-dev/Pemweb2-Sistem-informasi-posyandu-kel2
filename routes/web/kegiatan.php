<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KegiatanController;


// halaman create harus muncul sebelum parameter
Route::get('kegiatan/create', [KegiatanController::class, 'create'])
    ->name('kegiatan.create');


Route::resource('kegiatan', KegiatanController::class);