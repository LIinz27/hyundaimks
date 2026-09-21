<?php

namespace Tests\Feature;

use App\Filament\Pages\Auth\AdminLogin;
use App\Filament\Pages\Auth\SalesLogin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Alur login benar-benar bekerja lewat halaman Filament.
 *
 * Halaman login Filament memakai Livewire — form dikirim lewat komponen,
 * bukan POST HTML biasa (POST langsung ke /login/admin menjawab 405).
 * Karena itu pengujian sah-nya lewat Livewire::test(), bukan $this->post().
 *
 * Yang dijaga di sini adalah gejala yang pernah terjadi: hash password cocok
 * di database tapi browser tetap "minta refresh mulu" karena sesi tidak
 * terbentuk. Jadi yang diuji: sesi terbentuk, dan halaman panel benar-benar
 * bisa dibuka setelah login.
 */
class LoginHttpTest extends TestCase
{
    use RefreshDatabase;

    private function buatUser(string $username, string $password, string $role = 'sales'): User
    {
        $factory = $role === 'admin' ? User::factory()->admin() : User::factory();

        return $factory->create([
            'username' => $username,
            'email' => $username.'@hyundaimakassar.test',
            'password' => Hash::make($password),
            'password_changed_at' => now(),
            'role' => $role,
        ]);
    }

    public function test_halaman_login_admin_tampil_dengan_field_username(): void
    {
        // Sejak halaman login gabungan /login (bertab Admin/Sales) dibuat,
        // /login/admin tidak lagi menampilkan form — ia mengalihkan ke
        // /login dengan tab admin aktif.
        $this->get('/login/admin')
            ->assertRedirect('/login?tab=admin');

        $this->get('/login?tab=admin')
            ->assertOk()
            ->assertSee('Username');
    }

    public function test_halaman_login_sales_tampil_dengan_field_username(): void
    {
        $this->get('/login/sales')
            ->assertRedirect('/login?tab=sales');

        $this->get('/login?tab=sales')
            ->assertOk()
            ->assertSee('Username');
    }

    public function test_admin_bisa_login_lewat_halaman_login(): void
    {
        $user = $this->buatUser('admin', 'admin123', 'admin');

        Livewire::test(AdminLogin::class)
            ->fillForm([
                'username' => 'admin',
                'password' => 'admin123',
            ])
            ->call('authenticate')
            ->assertHasNoFormErrors();

        $this->assertAuthenticatedAs($user);
    }

    public function test_sesi_bertahan_setelah_login_dan_panel_bisa_dibuka(): void
    {
        $user = $this->buatUser('admin', 'admin123', 'admin');

        Livewire::test(AdminLogin::class)
            ->fillForm([
                'username' => 'admin',
                'password' => 'admin123',
            ])
            ->call('authenticate')
            ->assertHasNoFormErrors();

        // Inilah gejala "minta refresh mulu": sesi tidak terbentuk sehingga
        // halaman panel memantul kembali ke login. Setelah login, panel
        // harus 200 dan tetap 200 pada permintaan berikutnya.
        $this->get('/admin')->assertOk();
        $this->get('/admin')->assertOk();
        $this->assertAuthenticatedAs($user);
    }

    public function test_password_salah_tidak_membentuk_sesi(): void
    {
        $this->buatUser('admin', 'admin123', 'admin');

        Livewire::test(AdminLogin::class)
            ->fillForm([
                'username' => 'admin',
                'password' => 'salah',
            ])
            ->call('authenticate')
            ->assertHasFormErrors();

        $this->assertGuest();
    }

    public function test_sales_bisa_login_lewat_halaman_login_sales(): void
    {
        $user = $this->buatUser('rukman.fadli', 'rukman123', 'sales');

        Livewire::test(SalesLogin::class)
            ->fillForm([
                'username' => 'rukman.fadli',
                'password' => 'rukman123',
            ])
            ->call('authenticate')
            ->assertHasNoFormErrors();

        $this->assertAuthenticatedAs($user);
    }

    public function test_email_tidak_dipakai_untuk_login(): void
    {
        $this->buatUser('admin', 'admin123', 'admin');

        // Mengisi field username dengan ALAMAT EMAIL harus gagal — membuktikan
        // yang dicocokkan adalah kolom username, bukan email.
        Livewire::test(AdminLogin::class)
            ->fillForm([
                'username' => 'admin@hyundaimakassar.test',
                'password' => 'admin123',
            ])
            ->call('authenticate')
            ->assertHasFormErrors();

        $this->assertGuest();
    }
}
