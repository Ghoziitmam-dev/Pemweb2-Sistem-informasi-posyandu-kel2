<?php

namespace App\Http\Resources;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JadwalResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $terisi = (int) ($this->terdaftar_count ?? 0);

        return [
            'id' => $this->id,
            'kegiatan' => $this->whenLoaded('kegiatan', fn () => [
                'id' => $this->kegiatan->id,
                'judul' => $this->kegiatan->judul,
                'jenis' => $this->kegiatan->jenis,
            ]),
            'tanggal' => $this->tanggal->format('Y-m-d'),
            'tanggal_label' => $this->tanggal->translatedFormat('l, d F Y'),
            'jam_mulai' => substr($this->jam_mulai, 0, 5),
            'jam_selesai' => substr($this->jam_selesai, 0, 5),
            'lokasi' => $this->lokasi,
            'petugas' => $this->petugas,
            'status' => $this->status,
            'status_label' => Jadwal::STATUS[$this->status] ?? $this->status,
            'kuota' => $this->kuota,
            'terisi' => $terisi,
            'sisa_kuota' => $this->kuota === null ? null : max(0, $this->kuota - $terisi),
            'sudah_daftar' => (bool) ($this->sudah_daftar ?? false),
        ];
    }
}