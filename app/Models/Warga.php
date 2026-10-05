<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warga extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nik', 'nama', 'tanggal_lahir', 'jenis_kelamin', 'alamat',
        'rt_rw', 'kategori', 'nama_wali', 'no_hp',
    ];

    protected $casts = ['tanggal_lahir' => 'date'];

    public function pemeriksaans(): HasMany
    {
        return $this->hasMany(Pemeriksaan::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function jadwals(): BelongsToMany
    {
        return $this->belongsToMany(Jadwal::class, 'pendaftarans')
            ->withPivot('status')->withTimestamps();
    }

    public function getUmurAttribute(): int
    {
        return $this->tanggal_lahir->age;
    }

    public function scopeSearch($query, ?string $keyword)
    {
        return $query->when($keyword, function ($q) use ($keyword) {
            // Escape wildcard LIKE agar "%" dan "_" dicari sebagai teks biasa
            $like = '%'.str_replace(['!', '%', '_'], ['!!', '!%', '!_'], $keyword).'%';

            $q->where(fn ($q) => $q
                ->whereRaw("nama LIKE ? ESCAPE '!'", [$like])
                ->orWhereRaw("nik LIKE ? ESCAPE '!'", [$like]));
        });
    }

    // Kategori otomatis dari tanggal lahir (ibu_hamil dipilih manual)
    public static function hitungKategori(string $tanggalLahir): string
    {
        $umur = Carbon::parse($tanggalLahir)->age;

        return match (true) {
            $umur < 5  => 'balita',
            $umur < 18 => 'remaja',
            $umur < 60 => 'dewasa',
            default    => 'lansia',
        };
    }
}