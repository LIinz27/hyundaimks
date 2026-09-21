<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GaleriSeeder extends Seeder
{
    /**
     * Isi data awal galeri dari 7 file PNG warisan di public/images/Galeri.
     * File disalin (bukan dipindahkan) ke disk public agar file lama tetap ada.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 7; $i++) {
            $fileName = "Galeri-Hyundai-{$i}.png";
            $source = public_path("images/Galeri/{$fileName}");
            $target = "galeri/{$fileName}";

            if (File::exists($source) && ! Storage::disk('public')->exists($target)) {
                Storage::disk('public')->put($target, File::get($source));
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
