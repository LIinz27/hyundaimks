<?php

namespace Tests\Feature;

use App\Models\Sales;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * G2 — konteks sales harus menempel di SEMUA halaman publik dan SEMUA link
 * internal. Satu link yang lolos = pengunjung kena 404.
 */
class SalesContextPropagationTest extends TestCase
{
    use RefreshDatabase;

    /** Semua rute publik yang butuh konteks sales. */
    private const PUBLIC_PATHS = [
        '/',
        '/pricelist',
        '/proses-kredit',
        '/simulasi-kredit',
        '/tes-drive',
        '/portofolio',
        '/kontak',
        '/product/stargazer',
        '/product/creta',
        '/product/stargazer-x',
        '/product/hyundai-kona',
        '/product/santa-fe',
        '/product/staria',
        '/product/ioniq-5',
        '/product/palisade',
        '/product/ioniq-6',
        '/product/all-new-santa-fe',
    ];

    private function makeSales(array $attrs = []): Sales
    {
        return Sales::factory()->create(array_merge([
            'name' => 'Budi Sales',
            'slug' => 'budi-sales',
            'is_active' => true,
        ], $attrs));
    }

    public function test_every_public_page_returns_404_without_context(): void
    {
        $this->makeSales();

        foreach (self::PUBLIC_PATHS as $path) {
            $this->get($path)->assertNotFound();
        }
    }

    public function test_every_public_page_returns_200_with_context(): void
    {
        $sales = $this->makeSales();

        foreach (self::PUBLIC_PATHS as $path) {
            $this->get($path.'?s='.$sales->slug)->assertOk();
        }
    }

    public function test_internal_links_keep_the_sales_parameter(): void
    {
        $sales = $this->makeSales();

        $html = $this->get('/?s='.$sales->slug)->assertOk()->getContent();

        // Ambil link internal (bukan aset/eksternal), lalu pastikan semuanya
        // membawa ?s= — kalau tidak, klik berikutnya akan 404.
        $appHost = parse_url(config('app.url'), PHP_URL_HOST) ?: 'localhost';

        preg_match_all('/href="([^"]+)"/', $html, $m);
        $internal = array_values(array_unique(array_filter($m[1], function ($href) use ($appHost) {
            $host = parse_url($href, PHP_URL_HOST);
            $path = parse_url($href, PHP_URL_PATH) ?? '';

            // Hanya link yang benar-benar milik aplikasi ini: host sama, atau
            // path relatif tanpa host. Link CDN/fonts eksternal dikecualikan.
            if ($host !== null && $host !== $appHost) {
                return false;
            }

            return str_starts_with($path, '/')
                && ! str_starts_with($path, '/admin')
                && ! str_starts_with($path, '/storage')
                && ! str_starts_with($path, '/build')
                && ! str_starts_with($path, '/images')
                && ! preg_match('/\.(css|js|png|jpe?g|webp|svg|ico|woff2?)$/i', $path);
        })));

        $this->assertNotEmpty($internal, 'Tidak ada link internal yang ditemukan untuk diperiksa.');

        foreach ($internal as $href) {
            parse_str((string) parse_url($href, PHP_URL_QUERY), $q);
            $this->assertSame(
                $sales->slug,
                $q['s'] ?? null,
                "Link internal kehilangan konteks sales: {$href}"
            );
        }
    }

    public function test_contact_buttons_point_to_the_active_sales(): void
    {
        $sales = $this->makeSales(['whatsapp' => '0896-1688-0688']);

        foreach (['/', '/product/stargazer', '/kontak'] as $path) {
            $html = $this->get($path.'?s='.$sales->slug)->assertOk()->getContent();
            $link = $sales->fresh()->whatsappLink();
            $this->assertNotNull($link, 'Sales harus punya link WhatsApp untuk uji ini.');
            $this->assertStringContainsString(
                $link,
                $html,
                "Tombol WA di {$path} tidak menunjuk ke sales aktif."
            );
        }
    }

    public function test_footer_keeps_the_central_dealer_contact(): void
    {
        $sales = $this->makeSales(['whatsapp' => '0896-1688-0688']);

        $html = $this->get('/?s='.$sales->slug)->assertOk()->getContent();

        $footer = substr($html, (int) strpos($html, '<footer'));

        // Footer tidak boleh memakai nomor sales (keputusan spec §1.2).
        $this->assertStringNotContainsString((string) $sales->whatsappLink(), $footer);
    }

    public function test_logged_in_sales_gets_links_without_parameter(): void
    {
        $user = User::factory()->create(['role' => 'sales']);
        $sales = Sales::factory()->create([
            'user_id' => $user->id,
            'slug' => 'punya-sendiri',
            'name' => 'Punya Sendiri',
            'is_active' => true,
        ]);

        $html = $this->actingAs($user)->get('/')->assertOk()->getContent();

        // Konteks datang dari akun, jadi tidak perlu ?s= di setiap link.
        $this->assertStringNotContainsString('?s=', $html);
        $this->assertStringContainsString($sales->name, $html);
    }

    public function test_sales_without_photo_falls_back_to_default_dealer_photo(): void
    {
        // Layout original memakai satu foto default, bukan avatar inisial.
        $sales = $this->makeSales([
            'name' => 'Rukman Fadli',
            'photo_path' => null,
        ]);

        $html = $this->get('/?s='.$sales->slug)->assertOk()->getContent();

        $this->assertStringContainsString('Fadli-Kuntuls.jpg', $html);
        $this->assertStringNotContainsString('storage/sales/photos', $html);
    }

    /**
     * Foto dan nomor WA harus dapat diubah dari panel: perubahan di DB wajib
     * langsung tercermin di beranda, tanpa menyentuh kode.
     */
    public function test_sales_photo_and_whatsapp_are_driven_by_database(): void
    {
        $sales = $this->makeSales([
            'name' => 'Rukman Fadli',
            'photo_path' => 'sales/photos/rukman.jpg',
            'whatsapp' => '0812-3456-7890',
            'phone' => '0811-2222-3333',
        ]);

        $html = $this->get('/?s='.$sales->slug)->assertOk()->getContent();

        // Foto dari DB, bukan foto default.
        $this->assertStringContainsString('sales/photos/rukman.jpg', $html);
        $this->assertStringNotContainsString('Fadli-Kuntuls.jpg', $html);

        // Tautan WA & telepon mengikuti kolomnya masing-masing.
        $this->assertStringContainsString('wa.me/6281234567890', $html);
        $this->assertStringContainsString('tel:6281122223333', $html);

        // Label tombol menampilkan nomor yang tampil apa adanya.
        $this->assertStringContainsString('0812-3456-7890', $html);
        $this->assertStringContainsString('0811-2222-3333', $html);
    }

    /**
     * Kolom whatsapp dan phone terpisah: label tombol WA tidak boleh memakai
     * nomor telepon, dan sebaliknya.
     */
    public function test_whatsapp_and_phone_labels_are_not_swapped(): void
    {
        $sales = $this->makeSales([
            'whatsapp' => '0812-0000-1111',
            'phone' => '0813-9999-8888',
        ]);

        $html = $this->get('/?s='.$sales->slug)->assertOk()->getContent();

        // Tautan WA juga muncul di tombol seksi Promo, jadi cari tautan yang
        // berada di dalam blok tombol sales, bukan kemunculan pertama.
        $this->assertMatchesRegularExpression(
            '/class="wa-button[^"]*"[^>]*href="https:\/\/wa\.me\/6281200001111".*?0812-0000-1111/s',
            $html
        );
        $this->assertMatchesRegularExpression(
            '/class="contact-button[^"]*"[^>]*href="tel:6281399998888".*?0813-9999-8888/s',
            $html
        );
    }
}
