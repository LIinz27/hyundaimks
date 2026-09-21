<?php

namespace Tests\Feature;

use App\Filament\Pages\MyProfile;
use App\Filament\Resources\Sales\SalesResource;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Panel /sales: panel kedua yang terpisah dari panel admin.
 * Provider-nya pernah kosong (file 0 byte) sehingga seluruh panel 404.
 */
class SalesPanelAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_sales_panel_redirect_ke_login_saat_belum_login(): void
    {
        $response = $this->get('/sales');

        $this->assertSame(302, $response->getStatusCode());
        $this->assertStringContainsString('/sales/login', $response->headers->get('Location', ''));
    }

    public function test_sales_login_bisa_dibuka(): void
    {
        $this->get('/sales/login')->assertOk();
    }

    public function test_admin_tidak_bisa_akses_panel_sales(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/sales');

        // Filament mengarahkan user tertolak ke panel default (/admin).
        // Yang penting: BUKAN 200 (panel sales tidak terbuka) dan bukan crash.
        $this->assertNotSame(200, $response->getStatusCode());
        $this->assertNotSame(500, $response->getStatusCode());
        $this->assertStringContainsString('/admin', $response->headers->get('Location', ''));
    }

    public function test_sales_tidak_bisa_akses_panel_admin(): void
    {
        $sales = User::factory()->create(['role' => 'sales']);

        $response = $this->actingAs($sales)->get('/admin');

        $this->assertNotSame(200, $response->getStatusCode());
        $this->assertNotSame(500, $response->getStatusCode());
    }

    public function test_sales_bisa_membuka_profil_saya_di_panel_sales(): void
    {
        $user = User::factory()->create(['role' => 'sales']);
        Sales::factory()->create(['user_id' => $user->id]);

        $url = MyProfile::getUrl(panel: 'sales');

        $this->assertStringContainsString('/sales/', $url);

        $this->actingAs($user)->get($url)->assertOk();

        Livewire::actingAs($user)
            ->test(MyProfile::class, ['panel' => 'sales'])
            ->assertOk();
    }

    public function test_sales_tidak_bisa_membuka_resource_admin(): void
    {
        $user = User::factory()->create(['role' => 'sales']);
        Sales::factory()->create(['user_id' => $user->id]);

        foreach (['/admin/sales', '/admin/users', '/admin/galeris'] as $url) {
            $response = $this->actingAs($user)->get($url);

            $this->assertNotSame(200, $response->getStatusCode(), "$url terbuka untuk sales");
            $this->assertNotSame(500, $response->getStatusCode(), "$url error 500 untuk sales");
        }
    }

    public function test_user_tanpa_role_dikenal_ditolak_dari_semua_panel(): void
    {
        $aneh = User::factory()->create(['role' => 'tamu']);
        $adminUser = User::factory()->create(['role' => 'admin']);

        $admin = \Filament\Facades\Filament::getPanel('admin');
        $salesPanel = \Filament\Facades\Filament::getPanel('sales');

        \Filament\Facades\Filament::setCurrentPanel($admin);
        $this->assertFalse($aneh->canAccessPanel($admin));
        $this->assertTrue($adminUser->canAccessPanel($admin));

        \Filament\Facades\Filament::setCurrentPanel($salesPanel);
        $this->assertFalse($aneh->canAccessPanel($salesPanel));
    }
}
