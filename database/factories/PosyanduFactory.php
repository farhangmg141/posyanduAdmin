<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PosyanduFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => 'Posyandu ' . $this->faker->unique()->streetName(),
            'alamat' => $this->faker->streetAddress(),
            'rt' => $this->faker->numberBetween(1, 10),
            'rw' => $this->faker->numberBetween(1, 10),
            'kontak' => '08' . $this->faker->numerify('##########'),
            'media' => null, // bisa diset saat upload, seed kosong dulu
        ];
    }
}
