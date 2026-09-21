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

        // Bersihkan cache galeri beranda setiap ada perubahan baris galeri.
        static::saved(fn (Galeri $galeri) => static::forgetHomeCache($galeri->sales_id));
        static::deleted(fn (Galeri $galeri) => static::forgetHomeCache($galeri->sales_id));
    }

    public static function forgetHomeCache(?int $salesId): void
    {
        if ($salesId) {
            \Illuminate\Support\Facades\Cache::forget(
                \App\Http\Controllers\HomeController::galleryCacheKey($salesId)
            );
        }
    }
}
