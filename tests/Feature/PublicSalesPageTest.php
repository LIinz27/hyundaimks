<?php

namespace Tests\Feature;

use App\Models\Sales;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicSalesPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_sales_page_returns_404_for_unknown_slug(): void
    {
        $this->get('/sales/tidak-ada')->assertNotFound();
    }

    public function test_public_sales_page_returns_404_for_inactive_sales(): void
    {
        $sales = Sales::factory()->create(['is_active' => false]);

        $this->get('/sales/'.$sales->slug)->assertNotFound();
    }

    public function test_public_sales_page_loads_for_active_sales(): void
    {
        $sales = Sales::factory()->create(['is_active' => true, 'name' => 'Budi Santoso']);

        $this->get('/sales/'.$sales->slug)
            ->assertOk()
            ->assertSee('Budi Santoso');
    }

    public function test_sales_without_photo_renders_fallback_avatar(): void
    {
        $sales = Sales::factory()->create(['photo_path' => null, 'name' => 'Rukman Fadli']);

        $this->get('/sales/'.$sales->slug)
            ->assertOk()
            ->assertSee('avatar-fallback', false)
            ->assertSee('>R<', false);
    }

    public function test_homepage_returns_404_without_sales_context(): void
    {
        $this->assertDatabaseCount('sales', 0);

        // Spec G0: public pages require a sales context (?s= or logged-in sales).
        $this->get('/')->assertNotFound();
    }
}
