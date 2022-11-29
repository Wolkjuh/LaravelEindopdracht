<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable =
    [
        'title',
        'image',
    ];
    use HasFactory;

    public function fotoalbum()
    {
        return $this->belongsTo(Fotoalbum::class);
    }
}
