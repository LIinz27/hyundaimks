<?php

namespace Database\Seeders;

use App\Models\Galeri;
use App\Models\Sales;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class GaleriSeeder extends Seeder
{
    /**
     * Isi data awal galeri (7 slide) pada disk public.
     *
     * File PNG warisan sudah dikompresi menjadi WebP (lihat ImageCompressor),
     * jadi seeder ini memakai ekstensi .webp. Memakai .png di sini akan
     * membuat 7 baris galeri duplikat yang menunjuk file tidak ada.
     */
    public function run(): void
    {
        $sales = Sales::withTrashed()->where('slug', 'rukman-fadli')->first();

        if (! $sales) {
            $this->command?->warn('Sales rukman-fadli tidak ditemukan; galeri tidak di-seed.');

            return;
        }

        for ($i = 1; $i <= 7; $i++) {
            $target = "galeri/Galeri-Hyundai-{$i}.webp";

            if (! Storage::disk('public')->exists($target)) {
                $this->command?->warn("File {$target} tidak ditemukan di disk public; baris DB tetap dibuat.");
            }

            Galeri::firstOrCreate(
                ['image_path' => $target],
                [
                    'sales_id' => $sales->id,
                    'caption' => "Galeri Hyundai {$i}",
                    'sort_order' => $i,
                    'is_active' => true,
                ]
            );
        }
    }
}
