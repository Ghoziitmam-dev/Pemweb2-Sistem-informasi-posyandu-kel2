<?php

namespace Database\Factories;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Warga> */
class WargaFactory extends Factory
{
    public function definition(): array
    {
        $lahir = $this->faker->dateTimeBetween('-80 years', '-1 month')->format('Y-m-d');

        return [
            'nik'           => $this->faker->unique()->numerify('3301############'),
            'nama'          => $this->faker->name(),
            'tanggal_lahir' => $lahir,
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'alamat'        => $this->faker->streetAddress(),
            'rt_rw'         => sprintf('%02d/%02d', $this->faker->numberBetween(1, 9), $this->faker->numberBetween(1, 9)),
            'kategori'      => Warga::hitungKategori($lahir),
            'nama_wali'     => $this->faker->optional(0.5)->name(),
            'no_hp'         => $this->faker->numerify('08##########'),
        ];
    }
}