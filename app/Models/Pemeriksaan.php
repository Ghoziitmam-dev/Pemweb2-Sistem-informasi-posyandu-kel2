<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pemeriksaan extends Model
{
    protected $fillable = [
        'warga_id', 'jadwal_id', 'pemeriksa_id', 'tanggal',
        'berat_badan', 'tinggi_badan', 'lingkar_kepala', 'lingkar_lengan',
        'tekanan_darah', 'gula_darah', 'keluhan', 'catatan', 'status_gizi',
    ];

    protected $casts = ['tanggal' => 'date'];

    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class)->withTrashed();
    }

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function pemeriksa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pemeriksa_id');
    }
}