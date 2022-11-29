<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fotoalbum extends Model
{
    protected $fillable =
    [
      'categorie',
      'image',
    ];

    public function fotos()
    {
        return $this->belongsToMany(Foto::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
