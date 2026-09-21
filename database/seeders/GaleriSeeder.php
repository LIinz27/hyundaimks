<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class GaleriSeeder extends Seeder
{
    /**
     * Isi data awal galeri (7 slide) pada disk public.
     * File PNG warisan di folder public sudah dihapus;
     * seeder ini hanya memastikan baris DB ada dan file sudah ada di storage.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 7; $i++) {
            $target = "galeri/Galeri-Hyundai-{$i}.png";

            if (! Storage::disk('public')->exists($target)) {
                $this->command?->warn("File {$target} tidak ditemukan di disk public; baris DB tetap dibuat.");
            }

            Galeri::firstOrCreate(
                ['image_path' => $target],
                [
                    'caption' => "Galeri Hyundai {$i}",
                    'sort_order' => $i,
                    'is_active' => true,
                ]
            );
        }
    }
}
