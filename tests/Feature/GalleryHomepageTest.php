<?php

namespace Tests\Feature;

use App\Models\Galeri;
use App\Models\Sales;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GalleryHomepageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Galeri kini milik tiap sales, jadi tiap test membuat sales-nya sendiri
     * dan galeri diikat ke sales itu.
     */
    private function makeSales(): Sales
    {
        return Sales::factory()->create(['is_active' => true]);
    }

    public function test_active_gallery_is_rendered_on_homepage(): void
    {
        $sales = $this->makeSales();

        Galeri::create([
            'sales_id' => $sales->id,
            'image_path' => 'galeri/foto-aktif.png',
            'caption' => 'Foto Aktif',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $this->get('/?s='.$sales->slug)
            ->assertOk()
            ->assertSee('foto-aktif.png')
            ->assertSee('Foto Aktif');
    }

    public function test_inactive_gallery_is_not_rendered_on_homepage(): void
    {
        $sales = $this->makeSales();

        Galeri::create([
            'sales_id' => $sales->id,
            'image_path' => 'galeri/foto-nonaktif.png',
            'caption' => 'Foto Nonaktif',
            'sort_order' => 1,
            'is_active' => false,
        ]);

        $response = $this->get('/?s='.$sales->slug)->assertOk();

        $response->assertDontSee('foto-nonaktif.png');
        $response->assertDontSee('Foto Nonaktif');
    }

    public function test_gallery_of_other_sales_is_not_rendered(): void
    {
        $salesA = $this->makeSales();
        $salesB = $this->makeSales();

        Galeri::create([
            'sales_id' => $salesB->id,
            'image_path' => 'galeri/punya-sales-b.png',
            'caption' => 'Punya B',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $this->get('/?s='.$salesA->slug)
            ->assertOk()
            ->assertDontSee('punya-sales-b.png');
    }

    public function test_empty_gallery_shows_placeholder_frame(): void
    {
        $sales = $this->makeSales();

        $this->get('/?s='.$sales->slug)
            ->assertOk()
            ->assertSee('Upload foto galeri Anda');
    }

    public function test_gallery_is_ordered_by_sort_order(): void
    {
        $sales = $this->makeSales();

        Galeri::create([
            'sales_id' => $sales->id,
            'image_path' => 'galeri/urutan-kedua.png',
            'caption' => 'Kedua',
            'sort_order' => 2,
            'is_active' => true,
        ]);
        Galeri::create([
            'sales_id' => $sales->id,
            'image_path' => 'galeri/urutan-pertama.png',
            'caption' => 'Pertama',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $response = $this->get('/?s='.$sales->slug)->assertOk();

        $response->assertSeeInOrder(
            ['urutan-pertama.png', 'urutan-kedua.png'],
            false
        );
    }
}
