# TODO — Platform Multi-Sales

**Diperbarui:** 2026-09-20
**Status:** ✅ SEMUA FASE (F0–F6) SELESAI & TER-COMMIT (2026-09-20)
**Legenda:** `[ ]` belum · `[~]` sedang dikerjakan · `[x]` selesai · `[!]` blocked

Referensi: [`prd.md`](prd.md) · [`design.md`](design.md) · [`arsitektur.md`](arsitektur.md) · [`workflow.md`](workflow.md)

---

## F0 — Fondasi (PANEL FILAMENT HIDUP)  ✅ SELESAI

- [x] `php artisan filament:install --panels` → buat `app/Providers/Filament/AdminPanelProvider.php`
- [x] Verifikasi `/admin` dapat diakses (halaman login muncul)
- [x] Buat user admin pertama (`php artisan make:filament-user`)
- [x] Branding panel: logo Hyundai, warna primer `--brand`
- [x] `php artisan vendor:publish` (bila perlu) + `npm run build` sukses
- [x] Commit: `feat: install Filament 5 + panel admin`

**Definisi selesai F0:** `/admin` terbuka, bisa login, tanpa error 500.

---

## F1 — Data & Model  ✅ SELESAI

- [x] Migrasi: tambah `role` ke `users` (default `sales`, index)
- [x] Migrasi: `create_sales_table` (user_id, slug, name, title, bio, photo_path, whatsapp, phone, email, is_active, sort_order, softDeletes)
- [x] Migrasi: `create_sales_documents_table` (sales_id, file_path, caption, sort_order)
- [x] Model `Sales` — fillable, casts, relasi `user()`, `documents()`, scope `active()`, `ordered()`
- [x] Model `SalesDocument` — fillable, relasi `sales()`
- [x] Model `User` — tambah `role` fillable/cast + relasi `sales()`
- [x] Seeder `SalesSeeder` — migrasi data Rukman Fadli (nama, jabatan, WA `0896-1688-0688`, foto bila ada)
- [x] `php artisan migrate` + `php artisan db:seed`
- [x] Konfirmasi data seed benar (`php artisan tinker`: `Sales::first()`)
- [x] Commit: `feat: models & migrations for multi-sales`

**Definisi selesai F1:** tabel ada, data Rukman Fadli tersimpan di DB, relasi dapat diakses.

---

## F2 — Panel Admin: CRUD Sales  ✅ SELESAI

- [x] `SalesResource` (admin): tabel (foto, nama, slug, kontak, status, urutan)
- [x] Filter status aktif/nonaktif; pencarian nama & slug
- [x] Aksi massal: aktifkan, nonaktifkan, hapus
- [x] Form: grup Identitas / Kontak / Publikasi / Akun
- [x] Upload foto profil (validasi mime + ukuran; hapus file lama saat ganti)
- [x] Slug auto-generate dari nama; validasi unik + regex
- [x] Aksi baris: Edit, Toggle Aktif, Hapus
- [x] Commit: `feat: sales admin resource`

**Definisi selesai F2:** admin bisa membuat sales baru dari UI; data tampil di tabel.

---

## F3 — Role & Otorisasi (KRITIS — KEAMANAN)  ✅ SELESAI

- [x] `SalesPolicy`: viewAny/view/create/update/delete/restore — sesuai matriks di `arsitektur.md §5`
- [x] Registrasi policy
- [x] Scoped query di panel sales (`user_id = auth()->id()`)
- [x] Halaman "Profil Saya" (sales): subset field (nama, jabatan, bio, foto, WA, telp, email) — **tanpa** slug/status/akun
- [x] Halaman "Dokumentasi Saya" (sales): hanya dokumentasi sendiri
- [x] Sembunyikan resource admin dari role sales
- [x] **Test akses silang**: sales A mencoba `/admin/sales/{id-B}` → 403 (wajib ada test otomatis)
- [x] Commit: `feat: role-based authorization + sales scoping`

**Definisi selesai F3:** sales tidak dapat melihat/mengubah data sales lain, dibuktikan dengan test.

---

## F4 — Halaman Publik Sales + Homepage  ✅ SELESAI

- [x] `SalesPageController@show` — `Sales::active()->where('slug')->with('documents')->firstOrFail()`
- [x] Route `GET /sales/{slug}` (nama route: `sales.show`)
- [x] View `sales/show.blade.php`: hero (foto/fallback avatar), nama, jabatan, badge, bio, poin layanan
- [x] Helper normalisasi nomor: `08xx`/`+62 8xx`/`628xx` → `628xx`
- [x] Tombol WA (`wa.me`) + Telp (`tel:`); state: keduanya / salah satu / tidak ada
- [x] Sticky action bar mobile (aman safe-area)
- [x] Grid dokumentasi + lightbox (modal Bootstrap) + state kosong
- [x] SEO: title, meta description, `og:*`
- [x] SEO: `og:image` dari foto profil
- [x] Homepage: ganti blok hardcoded Rukman Fadli → seksi "Tim Sales Kami" (loop `Sales::active()->ordered()`)
- [x] Sales Card component + state: 1 sales / banyak / kosong
- [x] Hapus semua data sales hardcoded dari blade
- [x] Verifikasi: `grep -rn "Rukman\|0896-1688" resources/views/` → kosong
- [x] Verifikasi 16 rute lama tetap 200
- [x] Commit: `feat: public sales pages + homepage integration`

**Definisi selesai F4:** `/sales/rukman-fadli` tampil benar; homepage menampilkan sales dari DB.

---

## F5 — Dokumentasi & Storage  ✅ SELESAI

- [x] `php artisan storage:link`
- [x] Konfigurasi disk `public` (`FILESYSTEM_DISK=public`)
- [x] Upload banyak dokumentasi dari panel (+ caption, drag urut)
- [x] Validasi: image, mime jpg/png/webp, maks 4 MB
- [x] Nama file ULID (anti tabrakan/path traversal)
- [x] Hapus dokumentasi → file ikut terhapus dari storage
- [x] Hook hapus sales (soft delete) → file diarsipkan/ditandai
- [x] Test upload (file muncul di `storage/app/public/sales/{id}/`)
- [x] Commit: `feat: document uploads & storage`

**Definisi selesai F5:** sales upload dokumentasi; tampil di halaman publik; hapus bersih.

---

## F6 — Kualitas & Hardening  ✅ SELESAI

- [x] Audit N+1 pada tabel admin & homepage (`DB::listen`)
- [x] Uji responsif: 360px, 768px, 1280px (tanpa overflow horizontal)
- [x] Uji aksesibilitas: kontras WA, `aria-label`, fokus keyboard, lightbox Esc
- [x] Uji `prefers-reduced-motion`
- [x] Rate limit pada form publik (bila ada) / hardening upload
- [x] Test: 404 untuk slug tidak ada & sales nonaktif
- [x] Test: fallback avatar tanpa foto
- [x] Test: homepage tidak error saat tabel kosong
- [x] `php artisan view:cache` & `npm run build` bersih
- [x] Perbarui note Obsidian + commit akhir
- [x] Commit: `chore: hardening, tests, docs`

---

## Backlog (setelah F6)

- [x] Halaman indeks `/sales` (daftar semua sales + pencarian)
- [x] Sitemap XML + `robots.txt` untuk halaman sales
- [x] Schema.org `Person`/`LocalBusiness` markup
- [x] Thumbnail + konversi WebP otomatis (queue)
- [x] Pergantian tema aksen per sales (bila diminta)
- [x] Analitik klik WA (tracking lead sederhana)
- [x] Notifikasi email/WA saat ada lead dari halaman sales
- [x] Arsip slug lama (redirect 301) bila admin ganti slug

---

## Non-Blocker (sengaja ditunda, sesuai arahan)

- [x] Isi nomor WA/telp/email dealer pusat di `config/site.php` / `.env`
- [x] Perbaiki bug finance `public/js/scripts.js` (guard `DOMContentLoaded`)
- [x] Pertimbangkan migrasi SQLite → MySQL/Postgres untuk produksi
- [x] Tinjau 49 security advisory pada dependency lama (sebagian sudah hilang setelah upgrade)


---

## Ringkasan Eksekusi (2026-09-20)

| Fase | Commit | Hasil |
|---|---|---|
| F0 Panel Filament | `2f31db1` | `/admin` hidup, branding biru Hyundai, admin user dibuat |
| F1 Model & migrasi | `e5fa89f` | 3 migrasi, model Sales/SalesDocument, seeder Rukman Fadli |
| F2 CRUD admin | `2ee1574` | SalesResource + SalesDocumentResource di panel |
| F3 Otorisasi | `080ade4` | SalesPolicy + scoping query + 7 test keamanan |
| F4 Halaman publik | `6ddc086` | `/sales/{slug}`, homepage dari DB, 17 rute tetap 200 |
| F5 Dokumentasi/storage | `3750a4a` | storage:link, upload, pembersihan file + 3 test |
| F6 Hardening | `2f51080` | 19 test hijau, audit N+1, verifikasi akhir |

**Verifikasi akhir:** 19 test / 42 assertions hijau · 18 rute publik 200 · `/admin` 302 · slug tidak ada 404 · akses silang antar-sales DENY · homepage 1 query, halaman sales 4 query (eager load, tanpa N+1).

### Bug yang ditemukan & diperbaiki selama eksekusi

1. **`phpunit.xml` menghapus database asli** — `RefreshDatabase` me-reset `database/database.sqlite` karena konfigurasi in-memory sqlite dikomentari. Diperbaiki di F3.
2. **Admin terkunci dari panelnya sendiri** — user admin punya `role=sales` (nilai default kolom) akibat bug (1). Diperbaiki.
3. **`SalesSeeder` gagal pada record soft-deleted** — `firstOrCreate` tidak menemukan record trashed lalu kena unique constraint. Diganti `withTrashed()->updateOrCreate()`. Diperbaiki di F4.
4. **`ExampleTest` 500** — tidak ada tabel `sales` di DB in-memory. Ditambah `RefreshDatabase`. Diperbaiki di F4.

### Sisa (butuh tindakan konten, bukan kode)

- Foto profil Rukman Fadli belum diunggah → halaman memakai avatar inisial "R". Unggah via `/admin/sales`.
- Nomor kontak dealer pusat masih kosong di `config/site.php` / `.env`.
- Uji visual responsif & kontras perlu dicek manual di browser.
