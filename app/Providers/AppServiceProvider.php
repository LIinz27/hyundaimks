<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once app_path('Support/helpers.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Beranda kini dilayani HomeController dan menampilkan satu sales aktif
        // (lihat docs/spec-beranda-personal-final.md). View composer lama yang
        // memuat daftar semua sales sudah tidak dipakai dan telah dihapus agar
        // tidak menjalankan query sia-sia di setiap kunjungan beranda.
    }
}
