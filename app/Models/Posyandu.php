<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    use HasFactory;

    protected $table = 'posyandu';
    protected $primaryKey = 'id'; // ubah ke 'id'
   
    protected $fillable = [
        'nama',
        'alamat',
        'rt',
        'rw',
        'kontak',
        'media',
    ];

   
}
