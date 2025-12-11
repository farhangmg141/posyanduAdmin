<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WargaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'nik' => $this->faker->numerify('################'),
            'no_hp' => '08' . $this->faker->numerify('##########'),
            'alamat' => $this->faker->address(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'tanggal_lahir' => $this->faker->dateTimeBetween('-60 years', '-1 years')->format('Y-m-d'),
        ];
    }
}
