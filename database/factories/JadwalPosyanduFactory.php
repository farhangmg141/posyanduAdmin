<?php

namespace Database\Factories;

use App\Models\Posyandu;
use Illuminate\Database\Eloquent\Factories\Factory;

class JadwalPosyanduFactory extends Factory
{
    public function definition(): array
    {
        return [
            'posyandu_id' => Posyandu::inRandomOrder()->value('id'),
            'tanggal' => $this->faker->dateTimeBetween('-1 months', '+6 months')->format('Y-m-d'),
            'tema' => $this->faker->randomElement(['Penimbangan Balita', 'Penyuluhan Gizi', 'Imunisasi Massal', 'Cek Kesehatan']),
            'keterangan' => $this->faker->sentence(),
            'poster' => null,
        ];
    }
}
