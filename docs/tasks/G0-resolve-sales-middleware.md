# SPEC G0 — Middleware Resolusi Sales + Helper + 404 Kustom

**Fase:** G0 (fondasi arah baru)
**Prasyarat:** model `Sales` ada (F1 selesai). Halaman `/sales/{slug}` BELUM dibongkar (itu G3).
**Referensi wajib:** `docs/spec-beranda-personal-final.md` §1.4, §1.5, §2.1, §2.2, §2.3.

## Tujuan

Menyediakan mekanisme "sales mana yang aktif" untuk seluruh halaman publik, plus
helper supaya parameter `?s=` tidak hilang saat pengunjung berpindah halaman.

**Fase ini TIDAK mengubah tampilan beranda** (itu G1) dan **belum menghapus**
`/sales/{slug}` (itu G3). Fokus: mekanismenya benar dan teruji.

## 1. Middleware `ResolveActiveSales`

Buat `app/Http/Middleware/ResolveActiveSales.php`.

Logika `handle()`:

```
1. Kalau user login dan punya relasi Sales  → pakai Sales miliknya
   (parameter ?s= DIABAIKAN walaupun ada)
2. Kalau tidak, dan ada ?s=<slug>            → cari Sales aktif dengan slug itu
3. Kalau tidak ada keduanya                  → abort(404)
4. Kalau slug tidak ditemukan / sales nonaktif → abort(404)

Setelah resolusi berhasil:
   app()->instance('active.sales', $sales);
   View::share('activeSales', $sales);
   juga bagikan $salesSource ('account' | 'query') agar helper tahu perlu ?s= atau tidak
```

Pencarian sales WAJIB memakai `Sales::active()` (scope `is_active = true`), sehingga
sales nonaktif tidak pernah bisa diakses.

## 2. Registrasi middleware

Daftarkan di `bootstrap/app.php` (Laravel 13 memakai `->withMiddleware()`), sebagai
alias `sales.context`, lalu pasang pada grup rute **publik**.

PENTING:
- **JANGAN** pasang pada `/admin` atau rute Filament — kalau dipasang, admin terkunci
  dari panelnya sendiri.
- **JANGAN** pasang pada aset statis (`/build/*`, `/storage/*`, `/images/*`).
- Simpan rute yang ada agar bisa dibedakan. Cara paling aman: bungkus semua rute
  publik dalam satu grup `Route::middleware('sales.context')->group(...)`.

## 3. Helper `sales_route()`

Buat helper global. Lokasi yang disarankan: `app/Support/helpers.php`, didaftarkan
via `composer.json` (`files` autoload) ATAU lewat `AppServiceProvider::boot()`.
Pilih satu dan jelaskan pilihanmu.

```php
sales_route(string $name, array $params = []): string
```

Perilaku:
- Kalau konteks berasal dari **query** (`$salesSource === 'query'`) → tambahkan
  `?s=<slug>` ke URL.
- Kalau konteks berasal dari **akun login** (`$salesSource === 'account'`) → jangan
  tambahkan `?s=` (konteks implisit dari login).
- Harus tetap menghormati parameter yang sudah ada (jangan menimpa `?s=` yang sengaja
  diberikan).
- Harus aman dipanggil saat tidak ada konteks (mis. di panel admin) → kembalikan
  `route($name, $params)` biasa, JANGAN error.

Juga tambahkan helper `active_sales(): ?Sales`.

## 4. Halaman 404 kustom

Buat `resources/views/errors/404.blade.php`:
- Extend layout yang ada (`layouts.app`) — **hati-hati**: layout itu memuat header/footer
  yang mungkin mengharapkan `activeSales`. Pastikan halaman 404 **TIDAK** error ketika
  `activeSales` bernilai null.
- Pesan: "Akses hanya lewat link dari sales"
- **TANPA nomor kontak** (keputusan pemilik di spec §1.5)
- Kasih panduan singkat: "Minta link beranda kepada sales Hyundai Anda."
- Styling rapi memakai token `--brand`, tanpa inline style.

## 5. Test (WAJIB)

Buat `tests/Feature/ActiveSalesResolutionTest.php`:

1. `homepage_without_context_returns_404` — `GET /` → 404
2. `homepage_with_valid_slug_returns_200` — `GET /?s=<slug>` → 200
3. `invalid_slug_returns_404` — `GET /?s=tidak-ada` → 404
4. `inactive_sales_slug_returns_404` — sales `is_active=false` → 404
5. `logged_in_sales_sees_own_context` — login, `GET /?s=<sales-lain>` → konteks tetap miliknya
6. `helper_adds_query_when_source_is_query` — `sales_route('pricelist')` mengandung `?s=`
7. `helper_omits_query_when_source_is_account` — login → tanpa `?s=`
8. `helper_safe_without_context` — tanpa konteks → tidak error, kembalikan rute biasa

Test boleh memakai `RefreshDatabase` (sudah dikonfigurasi in-memory).

## 6. Larangan

- JANGAN mengubah tampilan beranda / view apa pun selain `errors/404.blade.php`.
- JANGAN menghapus `/sales/{slug}` (itu G3).
- JANGAN menambah dependency.
- JANGAN mengubah `config/cars.php`.
- JANGAN memasang middleware pada panel admin.

## 7. Kriteria Selesai (jalankan, laporkan SEMUA keluaran)

```bash
php artisan route:list | grep -cE "GET"                 # jumlah rute
php artisan test --filter=ActiveSalesResolutionTest     # harus hijau
php artisan test                                        # seluruh suite tetap hijau
curl -s -o /dev/null -w "root no param : %{http_code}\n" "http://127.0.0.1:8000/"
curl -s -o /dev/null -w "with ?s=      : %{http_code}\n" "http://127.0.0.1:8000/?s=rukman-fadli"
curl -s -o /dev/null -w "bad slug      : %{http_code}\n" "http://127.0.0.1:8000/?s=tidak-ada"
curl -s -o /dev/null -w "pricelist ?s= : %{http_code}\n" "http://127.0.0.1:8000/pricelist?s=rukman-fadli"
curl -s -o /dev/null -w "admin         : %{http_code}\n" "http://127.0.0.1:8000/admin"
php artisan view:cache
```

Catatan: pada fase ini beranda `/?s=` masih menampilkan beranda lama (belum personal) —
itu **normal**, G1 yang mengubah isinya. Yang penting status code sudah benar.

## 8. Laporan yang diminta

1. Daftar file dibuat/diubah.
2. Keluaran semua perintah verifikasi di atas.
3. Pilihan lokasi helper + alasan.
4. Cara middleware dipasang (tunjukkan potongan `bootstrap/app.php` + `routes/web.php`).
5. Konfirmasi `/admin` TIDAK terkena middleware (buktikan dengan status code 302).
6. Kendala apa pun.
