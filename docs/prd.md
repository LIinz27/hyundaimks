# PRD — Hyundai Dealer Makassar: Platform Multi-Sales

**Versi:** 2.0
**Tanggal:** 2026-09-16
**Status:** Draft untuk implementasi
**Pemilik produk:** Pemilik dealer / admin
**Basis kode:** Laravel 13.32 + Filament 5.8 + PHP 8.5

---

## 1. Ringkasan

Website dealer Hyundai Makassar saat ini adalah **satu situs statis untuk satu sales** (Rukman Fadli, hardcoded di `homepage/home.blade.php`). Nomor WA/telp, foto, dan blok profil tertanam langsung di blade.

Produk ini mengubahnya menjadi **platform multi-sales**: setiap sales punya halaman publik sendiri dengan identitas berbeda, dapat login dan mengelola halamannya sendiri melalui panel admin.

**Masalah yang diselesaikan:**
- Menambah sales baru saat ini butuh edit kode + deploy.
- Satu domain hanya bisa menampilkan satu sales; sales lain tidak punya kanal.
- Sales tidak bisa update foto, nomor, atau dokumentasi sendiri.
- Tidak ada kontrol admin atas siapa yang boleh tampil.

**Hasil yang diharapkan:**
- Admin bisa menambah/menonaktifkan sales dari panel, tanpa sentuh kode.
- Setiap sales punya URL unik yang bisa dibagikan.
- Sales login sendiri, edit profil + upload dokumentasi sendiri.
- Halaman sales lain tidak bisa diubah oleh sales yang bukan pemiliknya.

---

## 2. Pengguna & Peran

| Peran | Deskripsi | Kebutuhan utama |
|---|---|---|
| **Pengunjung** | Calon pembeli | Lihat profil sales, nomor WA/telp, dokumentasi, pricelist, katalog mobil, form tes drive/simulasi |
| **Sales** | Tenaga penjual | Punya halaman publik; login untuk edit profil + upload dokumentasi sendiri |
| **Admin** | Pemilik dealer / manajer | Kelola semua sales (buat, aktif/nonaktif, reset akses, isi kontak default); lihat semua data |

**Skala:** "banyak sales" — arsitektur harus nyaman untuk puluhan hingga ratusan record. Tidak boleh ada N+1 query, tidak boleh baca file config per-request untuk data yang berubah.

---

## 3. Ruang Lingkup

### 3.1 Termasuk (In scope) — Fase 1

**A. Panel admin (Filament)**
1. Inisialisasi panel Filament di `/admin`.
2. Autentikasi: login admin & sales pada panel yang sama, dibedakan role.
3. Manajemen sales (admin): CRUD lengkap.
4. Manajemen dokumentasi sales: upload banyak file, caption, hapus, urutkan.
5. Admin bisa menautkan sales ke akun login (`users.id`).
6. Aksi admin: aktif/nonaktif sales, reset password sales.

**B. Halaman publik per sales**
7. Route `/sales/{slug}` → halaman profil sales.
8. Konten: nama, jabatan, foto profil, bio, tombol WA + telp (klik-untuk-hubungi), galeri dokumentasi.
9. Nomor WA/telp diformat untuk `wa.me` (628xx) dan `tel:`.
10. Sales nonaktif → halaman publik 404 / pesan "tidak tersedia".

**C. Self-service sales**
11. Sales login → hanya bisa melihat & mengedit data miliknya sendiri.
12. Sales dapat mengubah: nama tampilan, jabatan, bio, foto profil, WA, telp, email.
13. Sales dapat upload/hapus dokumentasi miliknya.
14. Sales **tidak bisa**: mengubah slug, mengubah status aktif, melihat sales lain, mengubah data mobil/harga.

**D. Integrasi frontend**
15. Blok sales hardcoded di homepage → diganti data dari DB.
16. Halaman detail produk: CTA WA/telp pakai kontak sales aktif (kontekstual, fase lanjut boleh pakai kontak default).
17. `config/site.php` tetap sebagai kontak default/dealer (fallback), bukan sumber utama kontak sales.

**E. Storage**
18. `storage:link` + disk `public` untuk foto profil & dokumentasi.
19. Validasi tipe file (jpg/png/webp), ukuran maksimum (mis. 4 MB), jumlah maksimum dokumentasi per sales.

### 3.2 Tidak termasuk (Fase ini)

- Multi-tenant penuh (isolasi domain/subdomain per sales) — cukup path-based.
- Subdomain per sales (`slug.domain.com`).
- Billing / paket berbayar.
- CRM, tracking lead, atau integrasi WhatsApp API resmi.
- Ubah harga/katalog mobil per sales (katalog tetap global dari `config/cars.php`).
- Mode gelap, multi-bahasa, PWA.
- REST API publik.

### 3.3 Non-blocker yang diketahui (tidak dikerjakan, sesuai arahan)

- Nomor kontak dealer pusat masih placeholder (`config/site.php` kosong).
- Bug pre-existing: blok finance di `public/js/scripts.js` jalan tanpa guard `DOMContentLoaded`, memicu TypeError di halaman non-homepage.
- Belum ada commit untuk upgrade Laravel 13 + Filament.

---

## 4. Kebutuhan Fungsional

### FR-1 Autentikasi & Otorisasi
- FR-1.1 Panel Filament di `/admin`, login via email + password.
- FR-1.2 Setiap user punya `role` ∈ {`admin`, `sales`}.
- FR-1.3 Admin bisa akses semua resource; sales hanya record miliknya.
- FR-1.4 Sales tanpa record `sales` tertaut → tampil pesan "profil belum dibuat".
- FR-1.5 Otorisasi ditegakkan di level query (scope) **dan** policy — bukan hanya sembunyikan tombol.

### FR-2 Manajemen Sales (admin)
- FR-2.1 CRUD sales: nama, jabatan, slug, bio, foto, WA, telp, email, aktif, `user_id`.
- FR-2.2 Slug unik, auto-generate dari nama, dapat diedit admin, immutable bagi sales.
- FR-2.3 Aktif/nonaktif sales memengaruhi: muncul di daftar sales, akses halaman publik.
- FR-2.4 Hapus sales → soft delete agar URL lama tidak langsung mati / dapat dipulihkan.
- FR-2.5 Admin dapat mencari & memfilter berdasarkan status aktif.

### FR-3 Dokumentasi
- FR-3.1 Satu sales punya banyak dokumentasi (foto kegiatan, penyerahan unit, dsb).
- FR-3.2 Upload multiple sekaligus; caption opsional; urutan dapat diatur.
- FR-3.3 Hapus dokumentasi menghapus file dari storage (bukan hanya row).
- FR-3.4 Sales hanya melihat/mengelola dokumentasinya sendiri.

### FR-4 Halaman Publik Sales
- FR-4.1 `/sales/{slug}` menampilkan profil + galeri dokumentasi.
- FR-4.2 Tombol WA menggunakan format `https://wa.me/62xxxx`. Nomor dinormalisasi (buang `0`, `+62`, spasi, tanda hubung).
- FR-4.3 Tombol telp menggunakan `tel:`.
- FR-4.4 Slug tidak ditemukan / sales nonaktif → 404.
- FR-4.5 Halaman responsif (mobile-first) dan konsisten dengan design system yang sudah ada (`--brand #1C4682`).
- FR-4.6 SEO dasar: `<title>`, meta description, `og:*` dari data sales.

### FR-5 Integrasi Homepage
- FR-5.1 Homepage menampilkan sales aktif (kartu profil) dari DB.
- FR-5.2 Bila ada banyak sales → grid/list ringkas dengan tautan ke tiap `/sales/{slug}`.
- FR-5.3 Bila tidak ada sales aktif → tampil fallback (kontak default), tanpa error.
- FR-5.4 Kontak default dealer tetap tersedia via `config/site.php`.

### FR-6 Storage & Media
- FR-6.1 Foto profil: 1 file per sales, disimpan di `storage/app/public/sales/{id}/`.
- FR-6.2 Dokumentasi: `storage/app/public/sales/{id}/documents/`.
- FR-6.3 Validasi: mime image (jpg/png/webp), maks 4 MB, dimensi wajar.
- FR-6.4 Hapus sales → file ikut dibersihkan (atau diarsipkan).

---

## 5. Kebutuhan Non-Fungsional

| ID | Kebutuhan | Target |
|---|---|---|
| NFR-1 | Performa | Halaman publik & daftar admin < 500 ms (sqlite, data < 1000 sales). Hindari N+1 (`with()`, eager load). |
| NFR-2 | Keamanan | Password di-hash (bcrypt); otorisasi di server; validasi upload mime + ukuran; cegah path traversal; `slug` di-validasi regex `[a-z0-9-]`. |
| NFR-3 | Keamanan data | Sales tidak dapat mengakses record sales lain lewat manipulasi URL/ID (policy + scope wajib). |
| NFR-4 | Kompatibilitas | PHP 8.5, Laravel 13, Filament 5. Tanpa dependency baru di luar ekosistem Laravel/Filament tanpa persetujuan. |
| NFR-5 | Aksesibilitas | Kontras memadai (brand `#1C4682` di atas putih), `aria-label` pada tombol ikon, navigasi keyboard di panel. |
| NFR-6 | Maintainability | Data sales satu sumber (DB). `config/cars.php` tetap sumber katalog mobil. Tidak ada data sales hardcoded di blade. |
| NFR-7 | Responsif | Mobile-first; diuji pada 360px, 768px, 1280px. Tidak ada overflow horizontal. |
| NFR-8 | Observability | Error upload & 404 tercatat (log Laravel standar). |

---

## 6. Model Data

### `users` (sudah ada, +`role`)
| Kolom | Tipe | Catatan |
|---|---|---|
| id | bigint PK | |
| name | string | |
| email | string unique | |
| password | string | hashed |
| role | string default `sales` | `admin` \| `sales` |
| email_verified_at, remember_token, timestamps | | |

### `sales` (baru)
| Kolom | Tipe | Catatan |
|---|---|---|
| id | bigint PK | |
| user_id | FK → users, nullable, unique | null = sales tanpa akun login |
| slug | string unique | `[a-z0-9-]`, sumber URL |
| name | string | nama tampilan |
| title | string nullable | jabatan, mis. "Profesional Sales Consultant" |
| bio | text nullable | deskripsi singkat |
| photo_path | string nullable | foto profil |
| whatsapp | string nullable | dinormalisasi ke 62xx saat render |
| phone | string nullable | |
| email | string nullable | |
| is_active | boolean default true | |
| sort_order | integer default 0 | urutan tampil di homepage |
| timestamps, deleted_at | | soft delete |

### `sales_documents` (baru)
| Kolom | Tipe | Catatan |
|---|---|---|
| id | bigint PK | |
| sales_id | FK → sales, cascade delete | |
| file_path | string | |
| caption | string nullable | |
| sort_order | integer default 0 | |
| timestamps | | |

**Relasi:** `User hasOne Sales`; `Sales belongsTo User`; `Sales hasMany SalesDocument`.

---

## 7. Rute

| Metode | URI | Handler | Akses |
|---|---|---|---|
| GET | `/admin` | Filament panel | login (admin/sales) |
| GET | `/sales/{slug}` | `SalesPageController@show` | publik |
| GET | `/` | homepage (existing) | publik, kini menampilkan sales aktif |
| (existing) | `/pricelist`, `/proses-kredit`, `/simulasi-kredit`, `/tes-drive`, `/portofolio`, `/kontak`, `/product/*` | tidak berubah | publik |

**Prinsip:** rute existing tidak diubah. Hanya ada penambahan.

---

## 8. Kriteria Penerimaan

1. Admin dapat membuat sales baru dari `/admin` tanpa edit kode; halaman `/sales/{slug}` langsung dapat diakses.
2. Sales login di `/admin`, hanya melihat & mengedit datanya sendiri; mencoba mengakses `/admin/sales/{id-lain}` → 403.
3. `wa.me` dan `tel:` ter-render benar untuk nomor format `08xx`, `+62 8xx`, `628xx-xxxx`.
4. Sales nonaktif → `/sales/{slug}` mengembalikan 404.
5. Sales baru tanpa foto → tampil avatar fallback rapi, tanpa broken image.
6. Semua rute lama tetap 200 (regresi nol).
7. `php artisan view:cache` & `npm run build` tanpa error.
8. Upload dokumentasi: file muncul di storage, terhapus saat record dihapus.
9. Homepage tidak error saat tabel `sales` kosong.
10. Tidak ada kebocoran N+1 pada halaman daftar admin (diperiksa dengan query log).

---

## 9. Risiko & Mitigasi

| Risiko | Dampak | Mitigasi |
|---|---|---|
| Kebocoran data antar-sales | Tinggi (reputasi) | Policy + global scope wajib; test otomatis untuk akses silang |
| Sales mengubah slug/status | Sedang | Field immutable di form sales; hanya admin dapat mengubah |
| Disk penuh (upload banyak) | Sedang | Batas ukuran + jumlah; pembersihan file yatim |
| Regresi halaman publik | Sedang | Test 16 rute setelah tiap fase |
| N+1 saat sales banyak | Sedang | Eager load + review `DB::listen` |
| Upgrade Laravel 13 belum diuji penuh | Sedang | Test regresi sebelum fitur baru |

---

## 10. Fase Rilis

| Fase | Isi | Prasyarat |
|---|---|---|
| **F0** | Init panel Filament + user admin + halaman `/admin` hidup | — |
| **F1** | Migrasi + model + seeder sales (data Rukman Fadli) | F0 |
| **F2** | Filament resource sales (admin CRUD) | F1 |
| **F3** | Role + policy + scope (isolasi data sales) | F2 |
| **F4** | Halaman publik `/sales/{slug}` + integrasi homepage | F3 |
| **F5** | Dokumentasi + upload + `storage:link` | F4 |
| **F6** | SEO, aksesibilitas, audit performa, hardening | F5 |

---

## 11. Pertanyaan Terbuka

1. Berapa perkiraan jumlah sales dalam 12 bulan pertama? (memengaruhi pilihan paginasi/pencarian)
2. Apakah sales boleh menghapus dokumentasi sendiri, atau hanya admin?
3. Perlu moderasi admin sebelum dokumentasi sales tampil publik?
4. Nomor kontak dealer pusat (placeholder saat ini) — kapan diisi?
5. Perlukah halaman indeks `/sales` (daftar semua sales) atau cukup kartu di homepage?
6. Apakah setiap sales butuh URL kustom (bukan `slug` dari nama)?
