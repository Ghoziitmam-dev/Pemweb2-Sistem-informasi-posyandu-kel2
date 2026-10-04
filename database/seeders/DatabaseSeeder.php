<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use App\Models\Kegiatan;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Posyandu',
            'email' => 'admin@posyandu.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Kader Posyandu',
            'email' => 'kader@posyandu.test',
            'password' => Hash::make('password'),
            'role' => 'kader',
        ]);

        $warga = [
            ['3301010101230001', 'Budi Santoso', '2023-03-12', 'L', 'Siti Aminah'],
            ['3301010101230002', 'Aisyah Putri', '2022-08-05', 'P', 'Ratna Dewi'],
            ['3301010101950003', 'Rina Marlina', '1995-06-20', 'P', null],
            ['3301010101600004', 'Sutrisno', '1960-01-15', 'L', null],
            ['3301010101080005', 'Dimas Pratama', '2008-11-02', 'L', 'Hartono'],
        ];

        foreach ($warga as [$nik, $nama, $lahir, $jk, $wali]) {
            Warga::create([
                'nik' => $nik,
                'nama' => $nama,
                'tanggal_lahir' => $lahir,
                'jenis_kelamin' => $jk,
                'alamat' => 'Jl. Melati No. 10',
                'rt_rw' => '02/05',
                'kategori' => Warga::hitungKategori($lahir),
                'nama_wali' => $wali,
                'no_hp' => '081234567890',
            ]);
        }

        $penimbangan = Kegiatan::create([
            'judul' => 'Penimbangan Balita',
            'jenis' => 'penimbangan',
            'deskripsi' => 'Penimbangan berat dan tinggi badan balita setiap bulan.',
            'target_peserta' => 'balita',
        ]);

        $senam = Kegiatan::create([
            'judul' => 'Senam Lansia',
            'jenis' => 'senam',
            'deskripsi' => 'Senam sehat bersama dan cek tekanan darah.',
            'target_peserta' => 'lansia',
        ]);

        Jadwal::create([
            'kegiatan_id' => $penimbangan->id,
            'tanggal' => now()->addDays(3)->toDateString(),
            'jam_mulai' => '08:00',
            'jam_selesai' => '11:00',
            'lokasi' => 'Balai Desa',
            'petugas' => 'Kader Posyandu',
        ]);

        Jadwal::create([
            'kegiatan_id' => $senam->id,
            'tanggal' => now()->addDays(10)->toDateString(),
            'jam_mulai' => '06:30',
            'jam_selesai' => '08:00',
            'lokasi' => 'Lapangan RW 05',
            'petugas' => 'Kader Posyandu',
        ]);
    }
}