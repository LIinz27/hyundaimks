<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Catatan penting: JANGAN memanggil User::factory() di sini. Factory
     * membuat user acak (username acak + password 'password') yang ikut
     * masuk ke database ASLI setiap kali `db:seed` dijalankan, sehingga
     * menumpuk akun sampah yang bisa dipakai login. Akun admin & sales
     * asli dibuat lewat seeder masing-masing di bawah.
     */
    public function run(): void
    {
        $this->call(SalesSeeder::class);
        $this->call(GaleriSeeder::class);
    }
}
