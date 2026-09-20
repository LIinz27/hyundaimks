# TODO — Platform Multi-Sales

**Diperbarui:** 2026-09-16
**Legenda:** `[ ]` belum · `[~]` sedang dikerjakan · `[x]` selesai · `[!]` blocked

Referensi: [`prd.md`](prd.md) · [`design.md`](design.md) · [`arsitektur.md`](arsitektur.md) · [`workflow.md`](workflow.md)

---

## F0 — Fondasi (PANEL FILAMENT HIDUP)

- [ ] `php artisan filament:install --panels` → buat `app/Providers/Filament/AdminPanelProvider.php`
- [ ] Verifikasi `/admin` dapat diakses (halaman login muncul)
- [ ] Buat user admin pertama (`php artisan make:filament-user`)
- [ ] Branding panel: logo Hyundai, warna primer `--brand`
- [ ] `php artisan vendor:publish` (bila perlu) + `npm run build` sukses
- [ ] Commit: `feat: install Filament 5 + panel admin`

**Definisi selesai F0:** `/admin` terbuka, bisa login, tanpa error 500.

---

## F1 — Data & Model

- [ ] Migrasi: tambah `role` ke `users` (default `sales`, index)
- [ ] Migrasi: `create_sales_table` (user_id, slug, name, title, bio, photo_path, whatsapp, phone, email, is_active, sort_order, softDeletes)
- [ ] Migrasi: `create_sales_documents_table` (sales_id, file_path, caption, sort_order)
- [ ] Model `Sales` — fillable, casts, relasi `user()`, `documents()`, scope `active()`, `ordered()`
- [ ] Model `SalesDocument` — fillable, relasi `sales()`
- [ ] Model `User` — tambah `role` fillable/cast + relasi `sales()`
- [ ] Seeder `SalesSeeder` — migrasi data Rukman Fadli (nama, jabatan, WA `0896-1688-0688`, foto bila ada)
- [ ] `php artisan migrate` + `php artisan db:seed`
- [ ] Konfirmasi data seed benar (`php artisan tinker`: `Sales::first()`)
- [ ] Commit: `feat: models & migrations for multi-sales`

**Definisi selesai F1:** tabel ada, data Rukman Fadli tersimpan di DB, relasi dapat diakses.

---

## F2 — Panel Admin: CRUD Sales

- [ ] `SalesResource` (admin): tabel (foto, nama, slug, kontak, status, urutan)
- [ ] Filter status aktif/nonaktif; pencarian nama & slug
- [ ] Aksi massal: aktifkan, nonaktifkan, hapus
- [ ] Form: grup Identitas / Kontak / Publikasi / Akun
- [ ] Upload foto profil (validasi mime + ukuran; hapus file lama saat ganti)
- [ ] Slug auto-generate dari nama; validasi unik + regex
- [ ] Aksi baris: Edit, Toggle Aktif, Hapus
- [ ] Commit: `feat: sales admin resource`

**Definisi selesai F2:** admin bisa membuat sales baru dari UI; data tampil di tabel.

---

## F3 — Role & Otorisasi (KRITIS — KEAMANAN)

- [ ] `SalesPolicy`: viewAny/view/create/update/delete/restore — sesuai matriks di `arsitektur.md §5`
- [ ] Registrasi policy
- [ ] Scoped query di panel sales (`user_id = auth()->id()`)
- [ ] Halaman "Profil Saya" (sales): subset field (nama, jabatan, bio, foto, WA, telp, email) — **tanpa** slug/status/akun
- [ ] Halaman "Dokumentasi Saya" (sales): hanya dokumentasi sendiri
- [ ] Sembunyikan resource admin dari role sales
- [ ] **Test akses silang**: sales A mencoba `/admin/sales/{id-B}` → 403 (wajib ada test otomatis)
- [ ] Commit: `feat: role-based authorization + sales scoping`

**Definisi selesai F3:** sales tidak dapat melihat/mengubah data sales lain, dibuktikan dengan test.

---

## F4 — Halaman Publik Sales + Homepage

- [ ] `SalesPageController@show` — `Sales::active()->where('slug')->with('documents')->firstOrFail()`
- [ ] Route `GET /sales/{slug}` (nama route: `sales.show`)
- [ ] View `sales/show.blade.php`: hero (foto/fallback avatar), nama, jabatan, badge, bio, poin layanan
- [ ] Helper normalisasi nomor: `08xx`/`+62 8xx`/`628xx` → `628xx`
- [ ] Tombol WA (`wa.me`) + Telp (`tel:`); state: keduanya / salah satu / tidak ada
- [ ] Sticky action bar mobile (aman safe-area)
- [ ] Grid dokumentasi + lightbox (modal Bootstrap) + state kosong
- [ ] SEO: title, meta description, `og:*`
- [ ] SEO: `og:image` dari foto profil
- [ ] Homepage: ganti blok hardcoded Rukman Fadli → seksi "Tim Sales Kami" (loop `Sales::active()->ordered()`)
- [ ] Sales Card component + state: 1 sales / banyak / kosong
- [ ] Hapus semua data sales hardcoded dari blade
- [ ] Verifikasi: `grep -rn "Rukman\|0896-1688" resources/views/` → kosong
- [ ] Verifikasi 16 rute lama tetap 200
- [ ] Commit: `feat: public sales pages + homepage integration`

**Definisi selesai F4:** `/sales/rukman-fadli` tampil benar; homepage menampilkan sales dari DB.

---

## F5 — Dokumentasi & Storage

- [ ] `php artisan storage:link`
- [ ] Konfigurasi disk `public` (`FILESYSTEM_DISK=public`)
- [ ] Upload banyak dokumentasi dari panel (+ caption, drag urut)
- [ ] Validasi: image, mime jpg/png/webp, maks 4 MB
- [ ] Nama file ULID (anti tabrakan/path traversal)
- [ ] Hapus dokumentasi → file ikut terhapus dari storage
- [ ] Hook hapus sales (soft delete) → file diarsipkan/ditandai
- [ ] Test upload (file muncul di `storage/app/public/sales/{id}/`)
- [ ] Commit: `feat: document uploads & storage`

**Definisi selesai F5:** sales upload dokumentasi; tampil di halaman publik; hapus bersih.

---

## F6 — Kualitas & Hardening

- [ ] Audit N+1 pada tabel admin & homepage (`DB::listen`)
- [ ] Uji responsif: 360px, 768px, 1280px (tanpa overflow horizontal)
- [ ] Uji aksesibilitas: kontras WA, `aria-label`, fokus keyboard, lightbox Esc
- [ ] Uji `prefers-reduced-motion`
- [ ] Rate limit pada form publik (bila ada) / hardening upload
- [ ] Test: 404 untuk slug tidak ada & sales nonaktif
- [ ] Test: fallback avatar tanpa foto
- [ ] Test: homepage tidak error saat tabel kosong
- [ ] `php artisan view:cache` & `npm run build` bersih
- [ ] Perbarui note Obsidian + commit akhir
- [ ] Commit: `chore: hardening, tests, docs`

---

## Backlog (setelah F6)

- [ ] Halaman indeks `/sales` (daftar semua sales + pencarian)
- [ ] Sitemap XML + `robots.txt` untuk halaman sales
- [ ] Schema.org `Person`/`LocalBusiness` markup
- [ ] Thumbnail + konversi WebP otomatis (queue)
- [ ] Pergantian tema aksen per sales (bila diminta)
- [ ] Analitik klik WA (tracking lead sederhana)
- [ ] Notifikasi email/WA saat ada lead dari halaman sales
- [ ] Arsip slug lama (redirect 301) bila admin ganti slug

---

## Non-Blocker (sengaja ditunda, sesuai arahan)

- [ ] Isi nomor WA/telp/email dealer pusat di `config/site.php` / `.env`
- [ ] Perbaiki bug finance `public/js/scripts.js` (guard `DOMContentLoaded`)
- [ ] Pertimbangkan migrasi SQLite → MySQL/Postgres untuk produksi
- [ ] Tinjau 49 security advisory pada dependency lama (sebagian sudah hilang setelah upgrade)
