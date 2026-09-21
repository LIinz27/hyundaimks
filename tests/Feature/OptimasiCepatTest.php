<?php

namespace Tests\Feature;

use App\Models\Galeri;
use App\Models\Sales;
use App\Support\ImageCompressor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Optimasi kecepatan: kompresi otomatis foto galeri saat upload, dan cache
 * query beranda yang tetap benar setelah galeri diubah.
 *
 * Galeri di sini dibaca dari sisi model/kompresor — bukan lewat upload HTTP —
 * supaya test tidak bergantung pada penyimpanan file uji.
 */
class OptimasiCepatTest extends TestCase
{
    use RefreshDatabase;

    public function test_kompresor_mengecilkan_png_besar_dan_pindah_ke_webp(): void
    {
        Storage::fake('public');

        $img = imagecreatetruecolor(1600, 2000);
        for ($x = 0; $x < 1600; $x += 2) {
            for ($y = 0; $y < 2000; $y += 2) {
                imagesetpixel($img, $x, $y, imagecolorallocate($img, ($x * 7) % 256, ($y * 13) % 256, ($x + $y) % 256));
            }
        }
        $png = 'galeri/besar.png';
        Storage::disk('public')->makeDirectory('galeri');
        imagepng($img, Storage::disk('public')->path($png), 0);
        imagedestroy($img);

        $ukuranAsli = Storage::disk('public')->size($png);
        $this->assertGreaterThan(200_000, $ukuranAsli, 'fixture PNG harus berukuran besar');

        $hasil = ImageCompressor::compressPublicPath($png);

        $this->assertStringEndsWith('.webp', $hasil, 'hasil dikonversi ke WebP');
        $this->assertNotSame($png, $hasil, 'path berubah karena ekstensi berubah');
        $this->assertFalse(Storage::disk('public')->exists($png), 'file PNG lama dihapus');

        $ukuranBaru = Storage::disk('public')->size($hasil);
        $this->assertLessThan($ukuranAsli, $ukuranBaru, 'hasil kompresi harus lebih kecil');

        $dimensi = getimagesize(Storage::disk('public')->path($hasil));
        $this->assertSame(ImageCompressor::MAX_WIDTH, $dimensi[0], 'lebar dibatasi 1080');
        // Tinggi mengikuti rasio asli 1600x2000 → 1080x1350 (tidak dipotong).
        $this->assertSame(1350, $dimensi[1], 'tinggi proporsional (tidak dipotong)');
    }

    public function test_kompresor_membiarkan_webp_yang_sudah_kecil(): void
    {
        Storage::fake('public');

        $img = imagecreatetruecolor(800, 1000);
        imagefill($img, 0, 0, imagecolorallocate($img, 10, 20, 30));
        Storage::disk('public')->makeDirectory('galeri');
        $webp = 'galeri/sudah.webp';
        ob_start();
        imagewebp($img, null, 82);
        Storage::disk('public')->put($webp, ob_get_clean());
        imagedestroy($img);

        $ukuran = Storage::disk('public')->size($webp);
        $hasil = ImageCompressor::compressPublicPath($webp);

        // Sudah WebP dan tidak perlu diperkecil → tidak disentuh.
        $this->assertSame($webp, $hasil);
        $this->assertSame($ukuran, Storage::disk('public')->size($webp));
    }

    public function test_beranda_mengembalikan_galeri_sesuai_sales(): void
    {
        $sales = Sales::factory()->create(['is_active' => true, 'slug' => 'uji-cache']);
        Galeri::create([
            'sales_id' => $sales->id,
            'image_path' => 'galeri/sales/cache-1.webp',
            'caption' => 'Cache Satu',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $this->get('/?s=uji-cache')->assertOk()->assertSee('cache-1.webp');
    }

    public function test_galeri_baru_langsung_tampil_walau_cache_hangat(): void
    {
        $sales = Sales::factory()->create(['is_active' => true, 'slug' => 'uji-cache2']);
        Galeri::create([
            'sales_id' => $sales->id,
            'image_path' => 'galeri/sales/awal.webp',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        // Panaskan cache.
        $this->get('/?s=uji-cache2')->assertOk()->assertSee('awal.webp');

        // Tambah foto baru; cache harus dibersihkan oleh model event.
        Galeri::create([
            'sales_id' => $sales->id,
            'image_path' => 'galeri/sales/baru.webp',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        $this->get('/?s=uji-cache2')->assertOk()->assertSee('baru.webp');
    }

    public function test_cache_dibersihkan_saat_galeri_dinonaktifkan(): void
    {
        $sales = Sales::factory()->create(['is_active' => true, 'slug' => 'uji-cache3']);
        $foto = Galeri::create([
            'sales_id' => $sales->id,
            'image_path' => 'galeri/sales/nonaktif.webp',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $this->get('/?s=uji-cache3')->assertOk()->assertSee('nonaktif.webp');

        $foto->update(['is_active' => false]);

        $this->get('/?s=uji-cache3')->assertOk()->assertDontSee('nonaktif.webp');
    }
}
