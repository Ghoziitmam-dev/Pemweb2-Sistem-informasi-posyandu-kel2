<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PendaftaranResource;
use App\Models\Jadwal;
use App\Models\Pendaftaran;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PendaftaranController extends Controller
{
    // GET /api/jadwal/{jadwal}/pendaftaran (admin, kader)
    public function index(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'status' => ['nullable', Rule::in(['terdaftar', 'hadir', 'tidak_hadir', 'batal'])],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $data = $jadwal->pendaftarans()
            ->with('warga:id,nik,nama,kategori')
            ->when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->latest()
            ->paginate($request->integer('per_page', 20));

        return PendaftaranResource::collection($data)->additional(['success' => true]);
    }

    // POST /api/jadwal/{jadwal}/pendaftaran (warga)
    public function store(Request $request, Jadwal $jadwal): JsonResponse
    {
        $wargaId = $request->user()->warga_id;

        if (! $wargaId) {
            return $this->gagal('Akun Anda belum terhubung dengan data warga.', 403);
        }

        return DB::transaction(function () use ($jadwal, $wargaId) {
            $jadwal = Jadwal::whereKey($jadwal->id)->lockForUpdate()->first();

            if ($jadwal->status !== 'akan_datang') {
                return $this->gagal('Pendaftaran sudah ditutup untuk jadwal ini.');
            }

            if ($jadwal->kuota !== null) {
                $terisi = $jadwal->pendaftarans()->whereIn('status', Pendaftaran::AKTIF)->count();

                if ($terisi >= $jadwal->kuota) {
                    return $this->gagal('Kuota untuk jadwal ini sudah penuh.');
                }
            }

            $pendaftaran = Pendaftaran::firstOrNew(['warga_id' => $wargaId, 'jadwal_id' => $jadwal->id]);

            if ($pendaftaran->exists && in_array($pendaftaran->status, Pendaftaran::AKTIF, true)) {
                return $this->gagal('Anda sudah terdaftar pada jadwal ini.');
            }

            $pendaftaran->status = 'terdaftar'; // daftar ulang setelah batal diperbolehkan
            $pendaftaran->save();

            return $this->sukses('Pendaftaran berhasil.', new PendaftaranResource($pendaftaran->load('warga')), 201);
        });
    }

    // DELETE /api/jadwal/{jadwal}/pendaftaran (warga membatalkan miliknya sendiri)
    public function destroy(Request $request, Jadwal $jadwal): JsonResponse
    {
        if ($jadwal->status !== 'akan_datang') {
            return $this->gagal('Pendaftaran tidak bisa dibatalkan karena kegiatan sudah dimulai atau ditutup.');
        }

        $pendaftaran = Pendaftaran::where('jadwal_id', $jadwal->id)
            ->where('warga_id', $request->user()->warga_id)
            ->where('status', 'terdaftar')
            ->first();

        if (! $pendaftaran) {
            return $this->gagal('Anda tidak memiliki pendaftaran aktif pada jadwal ini.', 404);
        }

        $pendaftaran->update(['status' => 'batal']);

        return $this->sukses('Pendaftaran dibatalkan.');
    }
}