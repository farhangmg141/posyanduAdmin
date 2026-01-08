<?php

namespace Database\Factories;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;

class CatatanImunisasiFactory extends Factory
{
    public function definition(): array
    {
        return [
            'warga_id' => Warga::inRandomOrder()->value('id'),
            'jenis_vaksin' => $this->faker->randomElement(['BCG', 'Polio', 'DPT', 'Hepatitis B', 'Campak']),
            'tanggal' => $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'lokasi' => $this->faker->city(),
            'nakes' => $this->faker->name(),
            'media' => null,
        ];
    }
}
