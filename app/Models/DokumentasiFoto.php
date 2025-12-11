<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumentasiFoto extends Model
{
    use HasFactory;

    protected $table = 'dokumentasi_fotos';

    protected $fillable = [
        'dokumentasi_id',
        'file_name',
        'mime_type'
    ];

    public function dokumentasi()
    {
        return $this->belongsTo(Dokumentasi::class, 'dokumentasi_id');
    }
}
