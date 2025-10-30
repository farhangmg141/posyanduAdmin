<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga';
    protected $fillable = [
        'nama',
        'nik',
        'no_hp',
        'alamat',
        'jenis_kelamin',
        'tanggal_lahir',
    ];

    // public function kader()
    // {
    //     return $this->hasMany(KaderPosyandu::class, 'warga_id');
    // }

    // public function layanan()
    // {
    //     return $this->hasMany(LayananPosyandu::class, 'warga_id');
    // }
}
