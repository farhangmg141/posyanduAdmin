<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    protected $table = 'dokumentasi'; // <- TAMBAHKAN INI

    protected $fillable = ['judul', 'deskripsi'];

    public function fotos()
    {
        return $this->hasMany(DokumentasiFoto::class);
    }
}

