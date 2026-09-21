<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            // Login memakai username (lihat AuthenticatesWithUsername), jadi
            // factory wajib mengisinya — tanpa ini user hasil factory tidak
            // bisa dipakai menguji login sama sekali.
            'username' => fake()->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            // User hasil factory dianggap sudah punya password sendiri
            // (bukan password default seeder), sehingga tidak dipaksa
            // ganti password. Gunakan state ->needsPasswordChange()
            // untuk mensimulasikan user seeder.
            'password_changed_at' => now(),
            // Kolom role dipakai canAccessPanel(); default ke hak paling
            // kecil supaya test tidak diam-diam memberi akses admin.
            'role' => 'sales',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * User dengan hak admin.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
        ]);
    }

    /**
     * Simulasi user dari seeder default: belum pernah ganti password,
     * wajib ganti saat login berikutnya.
     */
    public function needsPasswordChange(): static
    {
        return $this->state(fn (array $attributes) => [
            'password_changed_at' => null,
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
