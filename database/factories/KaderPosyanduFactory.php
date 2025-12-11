<?php

namespace Database\Factories;

use App\Models\Posyandu;
use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;

class KaderPosyanduFactory extends Factory
{
    public function definition(): array
    {
        return [
            'posyandu_id' => Posyandu::inRandomOrder()->value('id'),
            'warga_id' => Warga::inRandomOrder()->value('id'),
            'peran' => $this->faker->randomElement(['Kader', 'Ketua', 'Bendahara', 'Sekretaris']),
            'mulai_tugas' => $this->faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'akhir_tugas' => null,
        ];
    }
}
