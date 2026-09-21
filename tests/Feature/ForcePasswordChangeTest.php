<?php

namespace Tests\Feature;

use App\Filament\Pages\ChangePassword;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Fitur wajib ganti password: user yang password_changed_at-nya NULL
 * (masih memakai password default seeder) dipaksa ke halaman ganti
 * password. Setelah berhasil ganti, kolom itu diisi dan akses dibuka.
 */
class ForcePasswordChangeTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_dengan_password_changed_at_null_diarahkan_ke_halaman_ganti_password(): void
    {
        $user = User::factory()->needsPasswordChange()->create(['role' => 'admin']);

        $this->actingAs($user)
            ->get('/admin')
            ->assertRedirect(route('filament.admin.pages.change-password'));
    }

    public function test_halaman_ganti_password_bisa_diakses_tanpa_redirect_loop(): void
    {
        $user = User::factory()->needsPasswordChange()->create(['role' => 'admin']);

        $this->actingAs($user)
            ->get(route('filament.admin.pages.change-password'))
            ->assertOk();
    }

    public function test_logout_tetap_bisa_saat_wajib_ganti_password(): void
    {
        $user = User::factory()->needsPasswordChange()->create(['role' => 'admin']);

        // Yang penting logout diproses (bukan di-redirect balik ke halaman
        // ganti password) dan user benar-benar keluar.
        $response = $this->actingAs($user)
            ->post(route('filament.admin.auth.logout'));

        $this->assertStringNotContainsString(
            route('filament.admin.pages.change-password'),
            $response->headers->get('Location', ''),
        );
        $this->assertGuest();
    }

    public function test_user_dengan_password_changed_at_terisi_boleh_lewat(): void
    {
        $user = User::factory()->create(['role' => 'admin']);

        $this->actingAs($user)->get('/admin')->assertOk();
    }

    public function test_ganti_password_berhasil_mengisi_password_changed_at(): void
    {
        $user = User::factory()->needsPasswordChange()->create(['role' => 'admin']);

        Livewire::actingAs($user)
            ->test(ChangePassword::class)
            ->set('data.password', 'password-baru-aman')
            ->set('data.password_confirmation', 'password-baru-aman')
            ->call('save')
            ->assertHasNoFormErrors();

        $user->refresh();
        $this->assertNotNull($user->password_changed_at);
        $this->assertTrue(Hash::check('password-baru-aman', $user->password));
    }

    public function test_password_pendek_ditolak(): void
    {
        $user = User::factory()->needsPasswordChange()->create(['role' => 'admin']);

        Livewire::actingAs($user)
            ->test(ChangePassword::class)
            ->set('data.password', 'pendek1')
            ->set('data.password_confirmation', 'pendek1')
            ->call('save')
            ->assertHasFormErrors(['password']);

        $this->assertNull($user->refresh()->password_changed_at);
    }

    public function test_password_default_ditolak(): void
    {
        $user = User::factory()->needsPasswordChange()->create(['role' => 'admin']);

        Livewire::actingAs($user)
            ->test(ChangePassword::class)
            ->set('data.password', 'password')
            ->set('data.password_confirmation', 'password')
            ->call('save')
            ->assertHasFormErrors(['password']);

        $this->assertNull($user->refresh()->password_changed_at);
    }
}
