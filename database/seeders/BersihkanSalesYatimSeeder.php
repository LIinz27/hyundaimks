<?php

namespace Database\Seeders;

use App\Models\Sales;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Bersihkan record Sales yang menunjuk user tidak ada (yatim).
 *
 * Ini sisa user factory yang pernah dihapus — record sales-nya tertinggal
 * dengan user_id menunjuk id yang sudah tidak eksis, sehingga tidak bisa
 * dipakai login dan mengotori panel /sales.
 *
 * Idempoten: aman dijalankan berulang. Sales yang punya galeri TIDAK
 * dihapus (dilaporkan saja) supaya tidak ada foto yang hilang.
 */
class BersihkanSalesYatimSeeder extends Seeder
{
    public function run(): void
    {
        $yatim = Sales::withTrashed()
            ->whereNotNull('user_id')
            ->whereNotIn('user_id', User::query()->select('id'))
            ->get();

        if ($yatim->isEmpty()) {
            $this->command?->info('Tidak ada sales yatim.');

            return;
        }

        $dihapus = 0;
        $dilewati = [];

        foreach ($yatim as $sales) {
            $jumlahGaleri = $sales->galeris()->count();

            if ($jumlahGaleri > 0) {
                // Jangan hapus: ada foto milik record ini. Cukup laporkan
                // supaya diputuskan manusia, bukan dihapus otomatis.
                $dilewati[] = "{$sales->slug} (id {$sales->id}, {$jumlahGaleri} galeri)";

                continue;
            }

            $sales->forceDelete();
            $dihapus++;
            $this->command?->info("Sales yatim dihapus: {$sales->slug} (id {$sales->id})");
        }

        if ($dilewati !== []) {
            $this->command?->warn('Dilewati (punya galeri, tidak dihapus): '.implode(', ', $dilewati));
        }

        $this->command?->info("Selesai. {$dihapus} sales yatim dihapus.");
    }
}
