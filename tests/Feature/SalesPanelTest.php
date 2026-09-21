<?php

namespace Tests\Feature;

use App\Filament\Pages\MyProfile;
use App\Filament\Resources\Sales\SalesResource;
use App\Models\Galeri;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SalesPanelTest extends TestCase
{
    use RefreshDatabase;

    private function makeSalesUser(): array
    {
        $user = User::factory()->create(['role' => 'sales']);
        $sales = Sales::factory()->create(['user_id' => $user->id]);

        return [$user, $sales];
    }

    public function test_sales_sees_own_profile_page(): void
    {
        [$user, $sales] = $this->makeSalesUser();

        // Halaman Profil Saya milik sales sekarang hidup di panel sales.
        $this->actingAs($user)
            ->get(MyProfile::getUrl(panel: 'sales'))
            ->assertOk();

        // Di panel admin sales ditolak dan dialihkan ke panel sales (bukan 403 mentah).
        $response = $this->actingAs($user)->get('/admin/my-profile');
        $this->assertSame(302, $response->getStatusCode());
        $this->assertStringContainsString('/sales', $response->headers->get('Location', ''));
    }

    public function test_sales_cannot_see_sales_resource(): void
    {
        [$user] = $this->makeSalesUser();

        $this->assertFalse(SalesResource::canViewAny());

        $response = $this->actingAs($user)
            ->get(SalesResource::getUrl('index'));

        $this->assertNotSame(200, $response->getStatusCode());
        $this->assertNotSame(500, $response->getStatusCode());
    }

    public function test_sales_sees_only_own_gallery(): void
    {
        [$userA, $salesA] = $this->makeSalesUser();
        [, $salesB] = $this->makeSalesUser();

        $fotoA = Galeri::create(['sales_id' => $salesA->id, 'image_path' => 'galeri/a.jpg', 'caption' => 'Milik A', 'sort_order' => 1, 'is_active' => true]);
        $fotoB = Galeri::create(['sales_id' => $salesB->id, 'image_path' => 'galeri/b.jpg', 'caption' => 'Milik B', 'sort_order' => 1, 'is_active' => true]);

        // Relasi galeris() hanya mengembalikan milik sales itu.
        $ids = $salesA->galeris()->pluck('id');

        $this->assertTrue($ids->contains($fotoA->id));
        $this->assertFalse($ids->contains($fotoB->id));
    }

    public function test_homepage_only_shows_active_gallery_of_viewed_sales(): void
    {
        [$userA, $salesA] = $this->makeSalesUser();
        [, $salesB] = $this->makeSalesUser();

        Galeri::create(['sales_id' => $salesA->id, 'image_path' => 'galeri/tampil.jpg', 'caption' => 'Tampil', 'sort_order' => 1, 'is_active' => true]);
        Galeri::create(['sales_id' => $salesA->id, 'image_path' => 'galeri/sembunyi.jpg', 'caption' => 'Disembunyikan', 'sort_order' => 2, 'is_active' => false]);
        Galeri::create(['sales_id' => $salesB->id, 'image_path' => 'galeri/punya-b.jpg', 'caption' => 'Punya B', 'sort_order' => 1, 'is_active' => true]);

        $html = $this->get('/?s='.$salesA->slug)->assertOk()->getContent();

        $this->assertStringContainsString('galeri/tampil.jpg', $html);
        $this->assertStringNotContainsString('galeri/sembunyi.jpg', $html);
        $this->assertStringNotContainsString('galeri/punya-b.jpg', $html);
    }

    public function test_sales_cannot_change_slug(): void
    {
        [$user, $sales] = $this->makeSalesUser();
        $originalSlug = $sales->slug;

        \Livewire\Livewire::actingAs($user)
            ->test(MyProfile::class)
            ->set('data.slug', 'slug-bajakan')
            ->set('data.is_active', false)
            ->set('data.sort_order', 999)
            ->call('save');

        $sales->refresh();

        $this->assertSame($originalSlug, $sales->slug);
        $this->assertTrue((bool) $sales->is_active);
        $this->assertNotSame(999, $sales->sort_order);
    }
}
