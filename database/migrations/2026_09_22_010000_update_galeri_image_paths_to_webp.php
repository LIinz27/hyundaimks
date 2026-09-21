<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Galeri PNG sudah dikompres ke WebP (lebar maks 1080px, q82).
        // Idempoten: hanya menyentuh baris yang masih .png.
        DB::table('galeri')
            ->where('image_path', 'like', 'galeri/%.png')
            ->update(['image_path' => DB::raw("replace(image_path, '.png', '.webp')")]);
    }

    public function down(): void
    {
        DB::table('galeri')
            ->where('image_path', 'like', 'galeri/%.webp')
            ->update(['image_path' => DB::raw("replace(image_path, '.webp', '.png')")]);
    }
};
