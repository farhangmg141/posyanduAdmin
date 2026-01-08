<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warga;
use App\Models\Posyandu;
use App\Models\KaderPosyandu;
use App\Models\CatatanImunisasi;
use App\Models\JadwalPosyandu;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Generate Warga
        Warga::factory()->count(50)->create();

        // 2. Generate Posyandu
        Posyandu::factory()->count(10)->create();

        // 3. Generate Kader untuk setiap posyandu
        KaderPosyandu::factory()->count(20)->create();

        // 4. Generate Catatan Imunisasi
        CatatanImunisasi::factory()->count(50)->create();

        // 5. Generate Jadwal Posyandu
        JadwalPosyandu::factory()->count(20)->create();
    }
}
