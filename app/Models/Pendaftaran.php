<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendaftaran extends Model
{
    protected $fillable = ['warga_id', 'jadwal_id', 'status', 'dikonfirmasi_at'];

    protected $casts = ['dikonfirmasi_at' => 'datetime'];

    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class)->withTrashed();
    }

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class);
    }
}