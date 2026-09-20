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

    /**
     * Klaim keamanan inti: sales yang login TIDAK boleh bisa mengintip beranda
     * sales lain hanya dengan mengubah parameter ?s= di URL.
     */
    public function test_logged_in_sales_cannot_peek_at_another_sales_via_query(): void
    {
        $userA = User::factory()->create(['role' => 'sales']);
        $userB = User::factory()->create(['role' => 'sales']);

        // Nama sengaja tidak memakai kata "Sales" polos: view memuat teks
        // statis "Sales Berpengalaman" yang akan membuat pencocokan palsu.
        $salesA = Sales::factory()->create([
            'user_id' => $userA->id,
            'name' => 'Ahmad Dari Sales A',
            'slug' => 'sales-a',
            'is_active' => true,
        ]);
        $salesB = Sales::factory()->create([
            'user_id' => $userB->id,
            'name' => 'Budi Dari Sales B',
            'slug' => 'sales-b',
            'is_active' => true,
        ]);

        // Login sebagai A, tapi minta beranda B lewat parameter.
        $html = $this->actingAs($userA)->get('/?s=sales-b')->assertOk()->getContent();

        // Konteks tetap milik akun yang login, bukan parameter URL.
        $this->assertStringContainsString('Ahmad Dari Sales A', $html);
        $this->assertStringNotContainsString('Budi Dari Sales B', $html);

        // Nomor kontak sales B juga tidak boleh bocor.
        $this->assertStringNotContainsString((string) $salesB->whatsappLink(), $html);

        $this->assertSame($salesA->id, active_sales()->id);
        $this->assertNotSame($salesB->id, active_sales()->id);
    }

    /**
     * User login yang belum punya data sales tidak diberi konteks apa pun —
     * beranda 404, bukan menampilkan sales sembarangan.
     */
    public function test_logged_in_user_without_sales_record_gets_404(): void
    {
        $user = User::factory()->create(['role' => 'sales']);

        $this->actingAs($user)->get('/')->assertNotFound();
    }

    /**
     * Akun non-aktif tidak memberi konteks: sales yang dinonaktifkan tidak boleh
     * tetap tampil hanya karena dia login.
     */
    public function test_logged_in_sales_that_is_inactive_gets_404(): void
    {
        $user = User::factory()->create(['role' => 'sales']);
        Sales::factory()->create([
            'user_id' => $user->id,
            'is_active' => false,
        ]);

        $this->actingAs($user)->get('/')->assertNotFound();
    }
}
