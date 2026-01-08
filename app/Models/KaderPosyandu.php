<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaderPosyandu extends Model
{
    use HasFactory;

    protected $table = 'kader_posyandu';
    protected $primaryKey = 'kader_id';
    public $timestamps = false;

    protected $fillable = [
        'posyandu_id',
        'warga_id',
        'peran',
        'mulai_tugas',
        'akhir_tugas'
    ];

    // 🔥 FIX WARGA (SUDAH BENAR)
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'id');
    }

    // 🔥 FIX POSYANDU (INI YANG KURANG)
    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'posyandu_id', 'id');
    }
}
