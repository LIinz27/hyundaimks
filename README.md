# Hyundai Dealer Makassar

Website resmi dealer Hyundai Makassar. Dibangun dengan Laravel 11, Bootstrap 5.3, dan Swiper.js. Bahasa antarmuka: **Bahasa Indonesia**.

---

## Fitur Utama

- **Homepage dinamis** — banner, slider promo, kartu mobil dengan filter kategori (MPV / SUV / Eco), galeri dealer, mitra leasing, dan kontak sales
- **Halaman produk** — 10 model Hyundai dengan carousel gambar, spesifikasi, daftar harga, dan formulir CTA
- **Pricelist** — unduh pricelist terbaru yang dikelola melalui admin panel
- **Proses Kredit** — informasi syarat dan tahapan pengajuan kredit
- **Simulasi Kredit** — formulir kalkulasi cicilan yang tersimpan ke database
- **Tes Drive** — formulir booking test drive yang tersimpan ke database
- **Portofolio** — galeri foto dealer
- **Kontak** — formulir pesan langsung
- **Admin Panel** — manajemen konten lengkap (banner, promo, pricelist, galeri, mobil, partner, profil sales, pengaturan situs, data masuk simulasi/test-drive/kontak)

---

## Teknologi

| Layer      | Stack                                                          |
| ---------- | -------------------------------------------------------------- |
| Backend    | Laravel 11 (PHP 8.2+)                                          |
| Frontend   | Bootstrap 5.3 (CDN), Swiper.js 11 (CDN), Bootstrap Icons (CDN) |
| Font       | Manrope (Google Fonts CDN)                                     |
| Build tool | Vite (bundling `app.css` & `app.js`)                           |
| Database   | MySQL / MariaDB                                                |

---

## Instalasi

```bash
# 1. Clone
git clone https://github.com/LIinz27/hyundaimks
cd hyundaimks

# 2. Dependensi
composer install
npm install

# 3. Environment
cp .env.example .env
php artisan key:generate
# Edit .env — sesuaikan DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 4. Database
php artisan migrate
php artisan db:seed   # opsional: data awal (admin, mobil, banner, dsb.)

# 5. Storage symlink (untuk upload file admin)
php artisan storage:link
```

## Menjalankan Server

```bash
# Semua sekaligus (PHP + queue + log + Vite HMR)
composer run dev

# Atau terpisah
php artisan serve
npm run dev
```

---

## Struktur Proyek

```
app/
  Http/Controllers/
    Controller.php        # Semua route halaman publik & produk
    AdminController.php   # Semua route admin panel
  Models/                 # Eloquent models (Mobil, Promo, Banner, dll.)
  Providers/
    AppServiceProvider.php  # View composer: siteSettings ke semua view

resources/views/
  header.blade.php        # Navbar global (di-include di setiap view)
  footer.blade.php        # Footer global + bubble chat
  homepage/
    home.blade.php        # Halaman beranda
    card.blade.php        # Kartu mobil + filter kategori
    benefit.blade.php     # Benefit, promo kredit, test drive, pricelist CTA
  pages/                  # pricelist, kredit, simulasi, tes-drive, portofolio, kontak
  product/                # 10 halaman produk Hyundai
  admin/                  # Admin panel (layout + semua sub-halaman)

public/
  css/styles.css          # Style kustom global
  js/scripts.js           # Script global (scroll header, swiper, cars display)
  images/
    car/                  # Gambar produk mobil
    Galeri/               # Foto galeri dealer
    Promo/                # Gambar promo
    finance/              # Logo partner leasing
    banners/              # File banner homepage
    pricelist/            # File pricelist (PDF/JPG)

routes/web.php            # Semua definisi route
database/
  migrations/             # Skema database
  seeders/                # Data awal (admin, mobil, banner, sales, partner)
```

---

## Menambah Konten via Admin Panel

Akses `/admin/login` dengan kredensial default (setelah seeding):

- Email: `admin@hyundaimks.com`
- Password: `admin123`

Fitur yang tersedia di admin:

- **Banner** — upload & aktifkan banner homepage
- **Promo** — kelola gambar slider promo
- **Pricelist** — upload file pricelist terbaru
- **Galeri** — kelola foto galeri & urutan tampil
- **Mobil** — tambah/edit/hapus data & harga mobil
- **Partner** — kelola logo mitra leasing & urutan tampil
- **Sales** — edit profil dan kontak sales consultant
- **Pengaturan** — ubah nomor WA, telepon, email, alamat, judul promo
- **Test Drive / Simulasi / Kontak** — lihat & hapus data masuk

---

## Konvensi Kode

- **Warna brand**: `#1C4682` (Hyundai dark blue)
- Tidak ada sistem `@extends/@yield` di halaman publik — setiap view menggunakan `@include('header')` dan `@include('footer')`
- Admin panel menggunakan `@extends('admin.layout')`
- Gambar direferensikan dengan `{{ asset('images/...') }}`
- `siteSettings` tersedia secara global di semua view via View composer

---

## Kontribusi

Buat pull request dengan deskripsi perubahan yang jelas. Ikuti konvensi yang sudah ada dan pastikan tidak ada error sebelum submit.
