<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

/**
 * Kompresi gambar otomatis: kecilkan ke lebar maks 1080px dan simpan
 * sebagai WebP kualitas 82. Dipakai oleh model Galeri saat image_path
 * berubah (upload baru dari panel Filament).
 */
class ImageCompressor
{
    public const MAX_WIDTH = 1080;

    public const WEBP_QUALITY = 82;

    /**
     * Kompres file di disk 'public'. Mengembalikan path baru (bisa sama
     * bila sudah WebP dan cukup kecil, atau path .webp baru). File lama
     * non-WebP dihapus setelah konversi berhasil.
     */
    public static function compressPublicPath(string $path): string
    {
        $disk = Storage::disk('public');

        if (! $disk->exists($path)) {
            return $path;
        }

        $binary = $disk->get($path);
        $img = @imagecreatefromstring($binary);

        if (! $img) {
            // Bukan gambar yang dikenali GD — biarkan apa adanya.
            return $path;
        }

        $width = imagesx($img);
        $height = imagesy($img);

        $needsResize = $width > self::MAX_WIDTH;
        $isWebp = str_ends_with(strtolower($path), '.webp');

        if (! $needsResize && $isWebp) {
            imagedestroy($img);

            return $path;
        }

        if ($needsResize) {
            $newHeight = (int) round($height * self::MAX_WIDTH / $width);
            $resized = imagecreatetruecolor(self::MAX_WIDTH, $newHeight);
            imagecopyresampled($resized, $img, 0, 0, 0, 0, self::MAX_WIDTH, $newHeight, $width, $height);
            imagedestroy($img);
            $img = $resized;
        }

        $newPath = $isWebp ? $path : preg_replace('/\.(jpe?g|png|gif|bmp)$/i', '.webp', $path);

        if (! $isWebp && $newPath === $path) {
            // Ekstensi tak dikenal: paksa tambahkan .webp
            $newPath = $path.'.webp';
        }

        ob_start();
        imagewebp($img, null, self::WEBP_QUALITY);
        $webpBinary = ob_get_clean();
        imagedestroy($img);

        if ($webpBinary === false || $webpBinary === '') {
            return $path;
        }

        $disk->put($newPath, $webpBinary);

        if ($newPath !== $path) {
            $disk->delete($path);
        }

        return $newPath;
    }
}
