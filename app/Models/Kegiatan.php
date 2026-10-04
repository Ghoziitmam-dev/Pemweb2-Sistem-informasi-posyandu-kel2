<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kegiatan extends Model
{
    protected $fillable = ['judul', 'jenis', 'deskripsi', 'target_peserta', 'foto', 'status'];

    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}