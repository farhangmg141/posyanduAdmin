<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class WargaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 30; $i++) {
            DB::table('warga')->insert([
                'nama'          => $faker->name(),
                'nik'           => $faker->nik(),
                'no_hp'         => $faker->phoneNumber(),
                'alamat'        => $faker->address(),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'tanggal_lahir' => $faker->date('Y-m-d', '2015-01-01'),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }

    }
}