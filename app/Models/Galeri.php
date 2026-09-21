<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Galeri extends Model
{
    protected $table = 'galeri';

    protected $fillable = [
        'sales_id',
        'image_path',
        'caption',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function sales(): BelongsTo
    {
        return $this->belongsTo(Sales::class);
    }

    protected static function booted(): void
    {
        static::deleting(function (Galeri $galeri) {
            if ($galeri->image_path && Storage::disk('public')->exists($galeri->image_path)) {
                Storage::disk('public')->delete($galeri->image_path);
            }
        });
    }
}
