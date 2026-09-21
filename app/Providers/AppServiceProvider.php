<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
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

        // Paksa HTTPS hanya bila permintaan memang sudah lewat HTTPS, atau saat
        // deploy di balik proxy/TLS. Jangan dipaksa dari APP_ENV saja: server dev
        // ini melayani HTTP biasa (dan diakses lewat Tailscale), sehingga
        // forceScheme('https') membuat redirect login mengarah ke skema yang
        // tidak dilayani ("https://127.0.0.1:8000" gagal dibuka).
        if ($this->app->environment('production') && $this->permintaanSudahHttps()) {
            URL::forceScheme('https');
        }
    }

    /**
     * Permintaan datang lewat HTTPS? Diteruskan proxy TLS terdeteksi dari
     * X-Forwarded-Proto. Di CLI (mis. artisan) dianggap bukan HTTPS.
     */
    private function permintaanSudahHttps(): bool
    {
        if ($this->app->runningInConsole()) {
            return false;
        }

        return $this->app->request->isSecure()
            || $this->app->request->header('X-Forwarded-Proto') === 'https';
    }
}
