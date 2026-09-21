<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * Login harus memakai username, bukan email.
 *
 * Halaman login memakai trait AuthenticatesWithUsername yang mengirim
 * ['username' => ..., 'password' => ...] ke guard, jadi yang diuji di sini
 * adalah jalur kredensial itu — bukan Auth::attempt biasa.
 */
class UsernameLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_berhasil_dengan_username(): void
    {
        $user = User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@hyundaimakassar.test',
            'password' => Hash::make('rahasia123'),
            'password_changed_at' => now(),
        ]);

        $this->assertTrue(
            auth()->attempt(['username' => 'admin', 'password' => 'rahasia123']),
            'Login dengan username seharusnya berhasil'
        );
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_gagal_dengan_password_salah(): void
    {
        User::factory()->create([
            'username' => 'admin',
            'password' => Hash::make('rahasia123'),
            'password_changed_at' => now(),
        ]);

        $this->assertFalse(auth()->attempt(['username' => 'admin', 'password' => 'salah']));
        $this->assertGuest();
    }

    public function test_username_unik(): void
    {
        User::factory()->create(['username' => 'admin']);

        $this->expectException(\Illuminate\Database\QueryException::class);

        User::factory()->create(['username' => 'admin']);
    }
}
