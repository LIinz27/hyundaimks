<?php

namespace Tests\Feature;

use App\Models\Sales;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActiveSalesResolutionTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_without_context_returns_404(): void
    {
        $this->get('/')->assertNotFound();
    }

    public function test_homepage_with_valid_slug_returns_200(): void
    {
        $sales = Sales::factory()->create(['is_active' => true]);

        $this->get('/?s='.$sales->slug)->assertOk();
    }

    public function test_invalid_slug_returns_404(): void
    {
        $this->get('/?s=tidak-ada')->assertNotFound();
    }

    public function test_inactive_sales_slug_returns_404(): void
    {
        $sales = Sales::factory()->create(['is_active' => false]);

        $this->get('/?s='.$sales->slug)->assertNotFound();
    }

    public function test_logged_in_sales_sees_own_context(): void
    {
        $own = Sales::factory()->create(['is_active' => true]);
        $other = Sales::factory()->create(['is_active' => true]);
        $user = User::factory()->create();
        $own->update(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/?s='.$other->slug);

        $response->assertOk();
        $this->assertTrue(active_sales()->is($own));
        $this->assertSame('account', app('active.sales.source'));
    }

    public function test_helper_adds_query_when_source_is_query(): void
    {
        $sales = Sales::factory()->create(['is_active' => true]);

        $this->get('/?s='.$sales->slug);

        $this->assertStringContainsString('s='.$sales->slug, sales_route('pricelist'));
    }

    public function test_helper_omits_query_when_source_is_account(): void
    {
        $own = Sales::factory()->create(['is_active' => true]);
        $user = User::factory()->create();
        $own->update(['user_id' => $user->id]);

        $this->actingAs($user)->get('/');

        $this->assertStringNotContainsString('s=', sales_route('pricelist'));
    }

    public function test_helper_safe_without_context(): void
    {
        $url = sales_route('pricelist');

        $this->assertSame(route('pricelist'), $url);
    }
}
