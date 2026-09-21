<?php

namespace Database\Seeders;

use App\Models\Sales;
use App\Models\User;
use Illuminate\Database\Seeder;

class SalesSeeder extends Seeder
{
    public function run(): void
    {
        // Akun sales harus punya record Sales yang tertaut lewat user_id,
        // kalau tidak panel /sales tidak tahu data milik siapa dan hanya
        // bisa menampilkan pesan "belum tertaut".
        $user = User::where('username', 'rukman.fadli')->first();

        if (! $user) {
            $this->command?->warn('User rukman.fadli tidak ditemukan; sales dibuat tanpa tautan akun.');
        }

        // withTrashed(): a soft-deleted sales record must be restored, not re-created,
        // otherwise the unique slug constraint fails.
        Sales::withTrashed()->updateOrCreate(
            ['slug' => 'rukman-fadli'],
            [
                'name' => 'Rukman Fadli',
                'title' => 'Profesional Sales Consultant',
                'bio' => "Melayani tukar tambah mobil lama dengan harga tinggi.\nLayanan Chat 24 Jam Fast Respon.\nBisa konsultasi langsung ke dealer kami dengan finance langsung.\nSurvey dibantu sampai approval.",
                'whatsapp' => '0896-1688-0688',
                'phone' => '0896-1688-0688',
                'email' => null,
                'is_active' => true,
                'sort_order' => 0,
                'user_id' => $user?->id,
                'deleted_at' => null,
            ]
        );
    }
}
