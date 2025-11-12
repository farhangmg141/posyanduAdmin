<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'no_hp',
        'alamat',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Getter foto dengan default image
    public function getFotoUrlAttribute()
    {
        if ($this->foto && file_exists(public_path('uploads/profil/' . $this->foto))) {
            return asset('uploads/profil/' . $this->foto);
        }

        return asset('images/default-avatar.png');
    }
}
