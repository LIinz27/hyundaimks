<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class HomeController
{
    /**
     * TTL cache galeri beranda (detik). Galeri jarang berubah; cache
     * dibersihkan lebih awal via model event Galeri/Sales bila ada perubahan.
     */
    public const GALLERY_CACHE_TTL = 3600;

    public static function galleryCacheKey(int $salesId): string
    {
        return "home:galeri:sales:{$salesId}";
    }

    public function index()
    {
        $sales = app('active.sales'); // dari middleware G0

        // Galeri kini milik tiap sales: yang dirender hanya galeri milik sales
        // yang sedang dilihat (?s=slug), bukan lagi galeri bersama dealer.
        // Tetap hanya yang aktif dan diurutkan sort_order.
        // Hasil query di-cache per sales_id; dibersihkan via model event.
        $galeris = $sales
            ? Cache::remember(
                self::galleryCacheKey($sales->id),
                self::GALLERY_CACHE_TTL,
                fn () => $sales->galeris()->where('is_active', true)->orderBy('id')->get()
            )
            : collect();

        return view('homepage/home', compact('sales', 'galeris'));
    }
}
