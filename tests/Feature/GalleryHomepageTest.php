<?php

namespace Tests\Feature;

use App\Models\Galeri;
use App\Models\Sales;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GalleryHomepageTest extends TestCase
{
    use RefreshDatabase;

    private function homeUrl(): string
    {
        $sales = Sales::factory()->create(['is_active' => true]);

        return '/?s='.$sales->slug;
    }

    public function test_active_gallery_is_rendered_on_homepage(): void
    {
        Galeri::create([
            'image_path' => 'galeri/foto-aktif.png',
            'caption' => 'Foto Aktif',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $this->get($this->homeUrl())
            ->assertOk()
            ->assertSee('foto-aktif.png')
            ->assertSee('Foto Aktif');
    }

    public function test_inactive_gallery_is_not_rendered_on_homepage(): void
    {
        Galeri::create([
            'image_path' => 'galeri/foto-nonaktif.png',
            'caption' => 'Foto Nonaktif',
            'sort_order' => 1,
            'is_active' => false,
        ]);

        $response = $this->get($this->homeUrl())->assertOk();

        $response->assertDontSee('foto-nonaktif.png');
        $response->assertDontSee('Foto Nonaktif');
    }

    public function test_empty_gallery_shows_placeholder_frame(): void
    {
        $this->get($this->homeUrl())
            ->assertOk()
            ->assertSee('Upload foto galeri Anda');
    }

    public function test_gallery_is_ordered_by_sort_order(): void
    {
        Galeri::create([
            'image_path' => 'galeri/urutan-kedua.png',
            'caption' => 'Kedua',
            'sort_order' => 2,
            'is_active' => true,
        ]);
        Galeri::create([
            'image_path' => 'galeri/urutan-pertama.png',
            'caption' => 'Pertama',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $response = $this->get($this->homeUrl())->assertOk();

        $response->assertSeeInOrder(
            ['urutan-pertama.png', 'urutan-kedua.png'],
            false
        );
    }
}
