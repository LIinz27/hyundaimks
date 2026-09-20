<?php

namespace Database\Seeders;

use App\Models\Sales;
use Illuminate\Database\Seeder;

class SalesSeeder extends Seeder
{
    public function run(): void
    {
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
                'deleted_at' => null,
            ]
        );
    }
}
