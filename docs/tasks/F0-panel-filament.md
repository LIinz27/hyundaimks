# SPEC F0 — Inisialisasi Panel Filament

**Fase:** F0 (fondasi)
**Prasyarat:** Filament 5.8.2 sudah terpasang di `vendor/filament/`, PHP 8.5 + ext-intl aktif.

## Tujuan

Membuat panel admin Filament hidup di `/admin` sehingga admin dapat login dan F1 (model data) dapat dikerjakan di atasnya.

## Perintah yang harus dijalankan

1. `php artisan filament:install --panels`
   - Ini membuat `app/Providers/Filament/AdminPanelProvider.php` dan mendaftarkannya.
   - Path panel: `/admin` (default).
2. `php artisan filament:assets` (bila diperlukan agar aset panel tersedia).
3. Buat satu user admin:
   - `php artisan make:filament-user --name=Admin --email=admin@hyundaimakassar.test --password=password`
   - Bila perintah interaktif menggantung, gunakan Tinker sebagai gantinya:
     ```php
     \App\Models\User::create([
       'name' => 'Admin',
       'email' => 'admin@hyundaimakassar.test',
       'password' => bcrypt('password'),
       'role' => 'admin',
     ]);
     ```
     (Catatan: kolom `role` baru ada di F1. Untuk F0, cukup buat user tanpa `role` bila kolom belum ada; jangan tambah migrasi di fase ini.)

## Branding panel (ringan saja di fase ini)

Di `AdminPanelProvider`, atur:
- `->brandName('Hyundai Makassar')`
- `->colors(['primary' => Color::hex('#1c4682')])`
- `->favicon(asset('images/hyundai-logo.png'))` bila memungkinkan

JANGAN membuat resource apa pun di fase ini (itu F2/F3).

## Larangan

- JANGAN mengubah `routes/web.php` (rute publik existing).
- JANGAN menambah dependency baru.
- JANGAN membuat migrasi/model baru di fase ini.
- JANGAN menyentuh `resources/views/**` (panel memakai view Filament sendiri).
- JANGAN menganalisis atau merapikan kode lain di luar cakupan.

## Kriteria Selesai (wajib dijalankan dan hasilnya dilaporkan)

```bash
php artisan route:list | grep -i admin          # harus ada rute /admin
curl -s -o /dev/null -w "%{http_code}\n" http://127.0.0.1:8000/admin   # 302 (redirect ke login) — bukan 500
php artisan view:cache                          # tanpa error
```

## Laporan yang diminta dari agen

1. File yang dibuat/diubah (daftar path).
2. Keluaran ketiga perintah verifikasi di atas.
3. Apakah user admin berhasil dibuat (dan dengan email apa).
4. Kendala apa pun yang dihadapi.
