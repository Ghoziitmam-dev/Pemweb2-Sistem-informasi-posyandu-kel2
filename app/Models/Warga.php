<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;

class Warga extends Model
{
    use SoftDeletes;

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

    public function getUmurAttribute(): int
    {
        return $this->tanggal_lahir->age;
    }

    // Kategori otomatis dari tanggal lahir (ibu_hamil dipilih manual)
    public static function hitungKategori(string $tanggalLahir): string
    {
        $umur = Carbon::parse($tanggalLahir)->age;
        return match (true) {
            $umur < 5 => 'balita',
            $umur < 18 => 'remaja',
            $umur < 60 => 'dewasa',
            default => 'lansia',
        };
    }
}