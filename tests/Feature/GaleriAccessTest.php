<?php

namespace Tests\Feature;

use App\Filament\Resources\Galeris\GaleriResource;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GaleriAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_sales_boleh_mengakses_galeri(): void
    {
        $user = User::factory()->create(['role' => 'sales']);
        Sales::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $this->assertTrue(GaleriResource::canViewAny());
    }

    public function test_admin_tetap_boleh_mengakses_galeri(): void
    {
        $user = User::factory()->create(['role' => 'admin']);

        $this->actingAs($user);

        $this->assertTrue(GaleriResource::canViewAny());
    }

    public function test_tamu_tidak_boleh_mengakses_galeri(): void
    {
        $this->assertFalse(GaleriResource::canViewAny());
    }

    public function test_file_statis_lama_tidak_direferensikan_lagi(): void
    {
        $paths = [
            app_path(),
            resource_path(),
            config_path(),
            database_path(),
            base_path('routes'),
            base_path('tests'),
            public_path('js'),
        ];

        foreach ($paths as $path) {
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS)
            );

            foreach ($iterator as $file) {
                if (! $file->isFile() || $file->getRealPath() === __FILE__) {
                    continue;
                }

                $contents = file_get_contents($file->getPathname());

                $this->assertStringNotContainsString(
                    'images/Galeri',
                    $contents,
                    "Referensi lama ditemukan di {$file->getPathname()}"
                );
            }
        }
    }
}
