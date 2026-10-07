<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PendaftaranResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'status_label' => ucfirst(str_replace('_', ' ', $this->status)),
            'warga' => $this->whenLoaded('warga', fn () => [
                'id' => $this->warga->id,
                'nik' => $this->warga->nik,
                'nama' => $this->warga->nama,
                'kategori' => $this->warga->kategori,
            ]),
            'dikonfirmasi_at' => $this->dikonfirmasi_at?->toIso8601String(),
            'didaftarkan_pada' => $this->created_at?->toIso8601String(),
        ];
    }
}