<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WargaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'nik'           => $this->nik,
            'nama'          => $this->nama,
            'tanggal_lahir' => $this->tanggal_lahir?->toDateString(),
            'umur'          => $this->umur,
            'jenis_kelamin' => $this->jenis_kelamin,
            'alamat'        => $this->alamat,
            'rt_rw'         => $this->rt_rw,
            'kategori'      => $this->kategori,
            'nama_wali'     => $this->nama_wali,
            'no_hp'         => $this->no_hp,
            'created_at'    => $this->created_at?->toDateTimeString(),
            'updated_at'    => $this->updated_at?->toDateTimeString(),
        ];
    }
}