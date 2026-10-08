<?php

use App\Models\{Jadwal, Kegiatan, Warga};
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $jadwals = Jadwal::with('kegiatan')
        ->where('status', 'akan_datang')
        ->whereDate('tanggal', '>=', today())
        ->orderBy('tanggal')
        ->orderBy('jam_mulai')
        ->take(3)
        ->get();

    $stat = [
        'warga' => Warga::count(),
        'kegiatan' => Kegiatan::where('status', 'aktif')->count(),
        'jadwal' => Jadwal::where('status', 'akan_datang')
            ->whereDate('tanggal', '>=', today())
            ->count(),
    ];

    return view('welcome', compact('jadwals', 'stat'));
})->name('home');

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
})->middleware('auth')->name('logout');

Route::redirect('/dashboard', '/jadwal')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});
Route::middleware('auth:sanctum')
    ->withoutMiddleware(ValidateCsrfToken::class) // aman: autentikasinya bearer token, bukan cookie
    ->group(function () {
        Route::post('/session-sync', function (Request $request) {
            Auth::guard('web')->login($request->user());
            $request->session()->regenerate();

            return response()->noContent();
        });

        Route::delete('/session-sync', function (Request $request) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->noContent();
        });
    });

require __DIR__.'/web/warga.php';
require __DIR__.'/web/kegiatan.php';
require __DIR__.'/web/jadwal.php';
require __DIR__.'/web/pemeriksaan.php';