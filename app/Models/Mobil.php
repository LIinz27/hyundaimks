<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $fillable = ['nama', 'harga', 'gambar', 'kategori', 'url', 'urutan', 'aktif'];
    protected $casts    = ['aktif' => 'boolean'];

    public function getImageUrlAttribute(): string
    {
        return asset('images/car/' . $this->gambar);
    }
}
