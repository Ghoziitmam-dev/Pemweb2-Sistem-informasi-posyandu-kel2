<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RiwayatPemeriksaanController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        
        // Ensure only 'warga' role has a meaning here, or if admin tests it, they see their own (which might be empty).
        // But strictly, this is for warga.
        if (! $user->warga_id) {
            $pemeriksaans = collect();
        } else {
            $pemeriksaans = Pemeriksaan::with(['jadwal.kegiatan', 'pemeriksa'])
                ->where('warga_id', $user->warga_id)
                ->orderByDesc('tanggal')
                ->paginate(10);
        }

        return view('warga.riwayat', compact('pemeriksaans'));
    }
}
