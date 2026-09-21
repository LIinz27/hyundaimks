<?php

namespace Tests\Feature;

use App\Http\Controllers\HomeController;
use App\Models\Galeri;
use App\Models\Sales;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

/**
 * Query galeri beranda di-cache per sales_id (TTL 1 jam) dan cache
 * dibersihkan otomatis via model event saat galeri atau sales berubah.
 */
class GalleryCacheTest extends TestCase
{
    use RefreshDatabase;

    private function makeSalesWithGallery(): array
    {
        $sales = Sales::factory()->create(['is_active' => true]);
        $galeri = Galeri::create([
            'sales_id' => $sales->id,
            'image_path' => 'galeri/foto-awal.png',
            'caption' => 'Awal',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        return [$sales, $galeri];
    }

    public function test_gallery_query_result_is_cached_per_sales(): void
    {
        [$sales] = $this->makeSalesWithGallery();
        $key = HomeController::galleryCacheKey($sales->id);

        $this->assertFalse(Cache::has($key));

        $this->get('/?s='.$sales->slug)->assertOk();

        $this->assertTrue(Cache::has($key));
        $this->assertCount(1, Cache::get($key));

        // Sales lain punya key cache sendiri.
        $salesB = Sales::factory()->create(['is_active' => true]);
        $this->get('/?s='.$salesB->slug)->assertOk();
        $this->assertTrue(Cache::has(HomeController::galleryCacheKey($salesB->id)));
        $this->assertCount(0, Cache::get(HomeController::galleryCacheKey($salesB->id)));
    }

    public function test_cache_is_cleared_when_galeri_changes(): void
    {
        [$sales, $galeri] = $this->makeSalesWithGallery();
        $key = HomeController::galleryCacheKey($sales->id);

        $this->get('/?s='.$sales->slug)->assertOk();
        $this->assertTrue(Cache::has($key));

        // Simpan perubahan galeri → cache terbuang.
        $galeri->update(['caption' => 'Diubah']);
        $this->assertFalse(Cache::has($key));

        // Homepage mengambil data baru dan mengisi cache lagi.
        $this->get('/?s='.$sales->slug)
            ->assertOk()
            ->assertSee('Diubah');

        // Hapus galeri → cache terbuang lagi.
        $galeri->delete();
        $this->assertFalse(Cache::has($key));
    }

    public function test_cache_is_cleared_when_sales_changes(): void
    {
        [$sales] = $this->makeSalesWithGallery();
        $key = HomeController::galleryCacheKey($sales->id);

        $this->get('/?s='.$sales->slug)->assertOk();
        $this->assertTrue(Cache::has($key));

        $sales->update(['name' => 'Nama Baru']);
        $this->assertFalse(Cache::has($key));

        // Homepage tetap benar setelah invalidasi.
        $this->get('/?s='.$sales->slug)
            ->assertOk()
            ->assertSee('foto-awal.png');
    }

    public function test_stale_cache_never_served_after_galeri_toggle(): void
    {
        [$sales, $galeri] = $this->makeSalesWithGallery();

        $this->get('/?s='.$sales->slug)->assertOk()->assertSee('foto-awal.png');

        // Nonaktifkan galeri: homepage berikutnya TIDAK boleh menampilkannya.
        $galeri->update(['is_active' => false]);
        $this->get('/?s='.$sales->slug)
            ->assertOk()
            ->assertDontSee('foto-awal.png');
    }
}
