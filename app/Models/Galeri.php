<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $fillable = ['filename', 'judul', 'urutan'];

    protected static function booted(): void
    {
        static::creating(function (Galeri $galeri) {
            if (! $galeri->urutan) {
                $galeri->urutan = (static::max('urutan') ?? 0) + 1;
            }
        });
    }
}
