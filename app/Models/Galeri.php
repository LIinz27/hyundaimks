<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Galeri extends Model
{
    protected $table = 'galeri';

    protected $fillable = [
        'image_path',
        'caption',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::deleting(function (Galeri $galeri) {
            if ($galeri->image_path && Storage::disk('public')->exists($galeri->image_path)) {
                Storage::disk('public')->delete($galeri->image_path);
            }
        });
    }
}
