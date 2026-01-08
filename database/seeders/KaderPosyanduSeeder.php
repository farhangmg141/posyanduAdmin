<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KaderPosyanduSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua ID dari tabel warga & posyandu
        $wargaIds = DB::table('warga')->pluck('id')->toArray();
        $posyanduIds = DB::table('posyandu')->pluck('id')->toArray();

        // Jika kosong, hentikan
        if (empty($wargaIds) || empty($posyanduIds)) {
            echo "Seeder gagal: Pastikan tabel warga dan posyandu sudah terisi.\n";
            return;
        }

        for ($i = 1; $i <= 20; $i++) {
            DB::table('kader_posyandu')->insert([
                'posyandu_id' => $faker->randomElement($posyanduIds),
                'warga_id'    => $faker->randomElement($wargaIds),
                'peran'       => $faker->randomElement(['Ketua', 'Sekretaris', 'Bendahara', 'Kader']),
                'mulai_tugas' => $faker->date('Y-m-d', '-3 years'),
                'akhir_tugas' => $faker->date('Y-m-d', '+2 years'),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }


    }
}