<?php
use App\Http\Controllers\Api\JadwalController;
use Illuminate\Support\Facades\Route;

Route::view('/jadwal', 'jadwal.index')->name('jadwal.index');