<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Jadwal extends Model
{
    protected $fillable = [
        'kegiatan_id', 'tanggal', 'jam_mulai', 'jam_selesai',
        'lokasi', 'petugas', 'status', 'kuota',
    ];

    protected $casts = ['tanggal' => 'date'];

    public const STATUS = [
        'akan_datang' => 'Akan Datang',
        'berlangsung' => 'Berlangsung',
        'selesai' => 'Selesai',
        'batal' => 'Batal',
    ];

    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function pemeriksaans(): HasMany
    {
        return $this->hasMany(Pemeriksaan::class);
    }
    public function pendaftarans(): HasMany
    {
        return $this->hasMany(Pendaftaran::class);
    }

    public function wargas(): BelongsToMany
    {
        return $this->belongsToMany(Warga::class, 'pendaftarans')
            ->withPivot('status')->withTimestamps();
    }
}