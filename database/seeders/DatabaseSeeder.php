<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Galeri;
use App\Models\Mobil;
use App\Models\Partner;
use App\Models\SalesProfile;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin user ──────────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'admin@hyundaimks.com'],
            [
                'name'     => 'Admin Hyundai Makassar',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            ]
        );

        // ── Galeri existing ─────────────────────────────────────
        if (Galeri::count() === 0) {
            for ($i = 1; $i <= 7; $i++) {
                Galeri::create([
                    'filename' => "Galeri-Hyundai-{$i}.png",
                    'judul'    => "Galeri Hyundai Makassar {$i}",
                    'urutan'   => $i,
                ]);
            }
        }

        // ── Daftar Mobil ─────────────────────────────────────────
        if (Mobil::count() === 0) {
            $mobils = [
                ['nama' => 'HYUNDAI STARGAZER',    'harga' => 'Rp249.600.000',   'gambar' => 'Hyundai-Stargazer.png',  'kategori' => 'mpv', 'url' => '/product/stargazer',        'urutan' => 1],
                ['nama' => 'HYUNDAI CRETA',         'harga' => 'Rp297.000.000',   'gambar' => 'Hyundai-Creta.png',     'kategori' => 'suv', 'url' => '/product/creta',             'urutan' => 2],
                ['nama' => 'HYUNDAI STARGAZER X',   'harga' => 'Rp335.800.000',   'gambar' => 'Stargazer-X.png',       'kategori' => 'mpv', 'url' => '/product/stargazer-x',       'urutan' => 3],
                ['nama' => 'HYUNDAI KONA ELECTRIC', 'harga' => 'Rp297.000.000',   'gambar' => 'Hyundai-Kona.png',      'kategori' => 'eco', 'url' => '/product/hyundai-kona',      'urutan' => 4],
                ['nama' => 'HYUNDAI SANTA FE',      'harga' => 'Rp625.000.000',   'gambar' => 'Hyundai-Santa-Fe.png',  'kategori' => 'suv', 'url' => '/product/santa-fe',          'urutan' => 5],
                ['nama' => 'HYUNDAI IONIQ 5',       'harga' => 'Rp399.000.000',   'gambar' => 'Hyundai-Ioniq-5.png',   'kategori' => 'eco', 'url' => '/product/ioniq-5',           'urutan' => 6],
                ['nama' => 'ALL NEW SANTA FE',      'harga' => 'Rp869.600.000',   'gambar' => 'ALL-NEW-SANTA.png',     'kategori' => 'suv', 'url' => '/product/all-new-santa-fe',  'urutan' => 7],
                ['nama' => 'HYUNDAI PALISADE',      'harga' => 'Rp910.000.000',   'gambar' => 'Hyundai-Palisade.png',  'kategori' => 'suv', 'url' => '/product/palisade',          'urutan' => 8],
                ['nama' => 'HYUNDAI STARIA',        'harga' => 'Rp924.000.000',   'gambar' => 'Hyundai-Staria.png',    'kategori' => 'mpv', 'url' => '/product/staria',            'urutan' => 9],
                ['nama' => 'HYUNDAI IONIQ 6',       'harga' => 'Rp1.220.000.000', 'gambar' => 'Hyundai-IONIQ-6.png',   'kategori' => 'eco', 'url' => '/product/ioniq-6',           'urutan' => 10],
            ];
            foreach ($mobils as $m) {
                Mobil::create(array_merge($m, ['aktif' => true]));
            }
        }

        // ── Banner homepage ──────────────────────────────────────
        if (Banner::count() === 0) {
            Banner::create([
                'filename' => 'images/SAMPUL-WEB-1.png',
                'judul'    => 'Banner Utama',
                'aktif'    => true,
            ]);
        }

        // ── Profil Sales ────────────────────────────────────────
        if (SalesProfile::count() === 0) {
            SalesProfile::create([
                'nama'      => 'Rukman Fadli',
                'jabatan'   => 'Profesional Sales Consultant',
                'foto'      => 'Fadli-Kuntuls.jpg',
                'telepon'   => '0896-1688-0688',
                'whatsapp'  => '0896-1688-0688',
                'keunggulan' => [
                    'Melayani tukar tambah mobil lama dengan harga tinggi.',
                    'Layanan Chat 24 Jam Fast Respon.',
                    'Bisa konsultasi langsung ke dealer kami dengan finance langsung.',
                    'Survey dibantu sampai approval.',
                ],
            ]);
        }

        // ── Site Settings ────────────────────────────────────────
        $defaults = [
            'whatsapp' => '0896-1688-0688',
            'telepon'  => '0896-1688-0688',
            'email'    => 'hyundaimks@gmail.com',
            'alamat'   => 'Jl. A. P. Pettarani No.55, Bua Kana, Kec. Rappocini, Kota Makassar, Sulawesi Selatan 90231',
        ];
        foreach ($defaults as $key => $value) {
            SiteSetting::firstOrCreate(['key' => $key], ['value' => $value]);
        }

        // ── Partner Finance ──────────────────────────────────────
        if (Partner::count() === 0) {
            $partners = [
                ['nama' => 'BAF',               'filename' => 'LOGO-BAF.jpg',                  'urutan' => 1],
                ['nama' => 'BCA Finance',        'filename' => 'LOGO-BCA-FINANCE-1.jpg',        'urutan' => 2],
                ['nama' => 'BRI Finance',        'filename' => 'LOGO-BRI-FINANCE.jpg',          'urutan' => 3],
                ['nama' => 'CIMB Finance',       'filename' => 'LOGO-CIMB-FINANCE.jpg',         'urutan' => 4],
                ['nama' => 'Clipan Finance',     'filename' => 'LOGO-CLIPAN-FINANCE.jpg',       'urutan' => 5],
                ['nama' => 'IMFI',               'filename' => 'LOGO-IMFI.jpg',                 'urutan' => 6],
                ['nama' => 'Indomobil Finance',  'filename' => 'LOGO-INDOMOBIL-FINANCE.jpg',    'urutan' => 7],
                ['nama' => 'MAF',                'filename' => 'LOGO-MAF-1.jpg',                'urutan' => 8],
                ['nama' => 'Mandiri Tunas',      'filename' => 'LOGO-MANDIRI-TUNAS-FINANCE.jpg','urutan' => 9],
                ['nama' => 'Maybank',            'filename' => 'LOGO-MAYBANK-1.jpg',            'urutan' => 10],
            ];
            foreach ($partners as $p) {
                Partner::create($p);
            }
        }
    }
}
