<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Panel admin: setiap halaman harus dapat dibuka admin.
 *
 * SalesTable pernah memakai defaultSort(['sort_order' => 'asc']) — Filament 4
 * hanya menerima string, sehingga /admin/sales error 500 dan admin tidak bisa
 * mengelola sales sama sekali. Tidak ada test yang menangkapnya.
 */
class AdminPanelSmokeTest extends TestCase
{
    use RefreshDatabase;

    public static function halamanAdmin(): array
    {
        return [
            'dashboard' => ['/admin'],
            'sales' => ['/admin/sales'],
            'galeri' => ['/admin/galeris'],
            'users' => ['/admin/users'],
        ];
    }

    /**
     */
    #[DataProvider('halamanAdmin')]
    public function test_admin_dapat_membuka_setiap_halaman_panel(string $url): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->get($url)->assertOk();
    }

    /**
     */
    #[DataProvider('halamanAdmin')]
    public function test_halaman_panel_tidak_error_untuk_sales(string $url): void
    {
        $sales = User::factory()->create(['role' => 'sales']);

        $response = $this->actingAs($sales)->get($url);

        // Sales boleh masuk dashboard, galeri, dokumentasi, sales (barisnya
        // sendiri); Users hanya untuk admin. Yang penting bukan 500.
        $this->assertNotSame(500, $response->getStatusCode(), "$url error 500 untuk sales");
    }
}
