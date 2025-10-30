<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananPosyandu extends Model
{
    use HasFactory;
    protected $table = 'layanan_posyandu';
    protected $primaryKey = 'layanan_id';
    protected $fillable = ['jadwal_id', 'warga_id', 'berat', 'tinggi', 'vitamin', 'konseling'];

    public function jadwal() {
        return $this->belongsTo(JadwalPosyandu::class, 'jadwal_id');
    }

    public function warga() {
        return $this->belongsTo(Warga::class, 'warga_id');
    }
}

