# SPEC F4 — Halaman Publik Sales + Integrasi Homepage

**Fase:** F4
**Prasyarat:** F3 selesai.

Referensi: `docs/design.md §5.1` (desain layar), `docs/design.md §5.2` (sales card), `docs/prd.md FR-4/FR-5`, `docs/arsitektur.md §6.1`.

## Tujuan

1. `/sales/{slug}` menampilkan profil sales dari DB.
2. Homepage tidak lagi memuat data sales hardcoded — diganti seksi yang membaca DB.

## 1. Rute (SATU-SATUNYA penambahan di `routes/web.php`)

```php
Route::get('/sales/{slug}', [SalesPageController::class, 'show'])->name('sales.show');
```

Rute lain **tidak boleh diubah**.

## 2. Controller

`app/Http/Controllers/SalesPageController.php`:

```php
public function show(string $slug)
{
    $sales = Sales::active()
        ->where('slug', $slug)
        ->with(['documents' => fn ($q) => $q->orderBy('sort_order')])
        ->firstOrFail();          // → 404 bila tidak ada / nonaktif

    return view('sales.show', compact('sales'));
}
```

Ikuti gaya controller existing di `app/Http/Controllers/Controller.php` (baca dulu).

## 3. View `resources/views/sales/show.blade.php`

- `@extends('layouts.app')` — ikuti pola view existing.
- `@section('title', ...)` — `"{Nama} - Sales Hyundai Makassar"`.
- SEO: `@push`/`@section` untuk meta description + `og:title`, `og:description`, `og:image` (foto sales bila ada), `og:type=profile`.

Struktur (lihat `docs/design.md §5.1`):
1. Breadcrumb: Beranda / Sales / {Nama}
2. Foto profil — rasio 1:1, maks 220px; **fallback avatar inisial** bila `photo_path` null
3. Nama (Display), Jabatan (muted), badge "Sales Resmi Hyundai Makassar"
4. Tombol **WhatsApp** (`wa.me/{nomor}`) + **Telepon** (`tel:`) — tampil hanya bila nomornya ada
5. Bio
6. Poin layanan (ambil dari konten lama bila ada di `home.blade.php`)
7. Dokumentasi — grid + lightbox (modal Bootstrap) + empty state
8. CTA pricelist
9. Sticky action bar (mobile) — aman `env(safe-area-inset-bottom)`

Aturan:
- **Tidak ada inline `style="..."`** — semua class di `app.css`.
- Semua gambar via `Storage::disk('public')->url($path)`.
- Foto wajib punya `alt` bermakna.
- Tombol ikon wajib `aria-label`.
- Rasio aspek ditetapkan agar tidak ada CLS.

## 4. Homepage

- Ganti blok profil sales hardcoded di `resources/views/homepage/home.blade.php` dengan seksi "Tim Sales Kami".
- Data: `Sales::active()->ordered()->get()` — **jangan** di controller baru; gunakan `Route::view` existing? Bila `Route::view('/', 'homepage/home')` tidak bisa menerima data, ubah menjadi controller atau gunakan `View::share`. **Pilih yang paling kecil perubahannya** dan jelaskan pilihanmu.
- Kartu sales (component atau partial `homepage/sales-card.blade.php`):
  - foto 1:1 (fallback avatar), nama, jabatan, tombol "Hubungi" (WA) + seluruh kartu menuju `/sales/{slug}`
  - hover: naik + shadow (via CSS)
- State: 1 sales → kartu lebar; 0 sales → seksi tidak dirender (tanpa judul menggantung).

## 5. Helper Normalisasi Nomor

Bila belum ada di model `Sales` (F1 seharusnya sudah membuat `whatsappLink()`/`phoneLink()`), gunakan itu. **Jangan** duplikasi logika di blade.

Test cepat: `0896-1688-0688`, `+62 896 1688 0688`, `62896-1688-0688` → semuanya `6289616880688`.

## 6. CSS

Tambah ke `resources/css/app.css` (pakai token `--brand`, jangan hardcode hex berulang):
- `.sales-card`, `.sales-hero`, `.sales-actions`, `.sales-docs-grid`, `.avatar-fallback`, `.sticky-contact-bar`, `.empty-state`

Hormati `prefers-reduced-motion`.

## 7. Larangan

- JANGAN mengubah rute publik lain.
- JANGAN mengubah `config/cars.php` atau halaman produk.
- JANGAN menambah dependency JS baru (gunakan modal Bootstrap untuk lightbox).
- JANGAN menyisakan data sales hardcoded.

## 8. Kriteria Selesai (WAJIB dijalankan, laporkan SEMUA keluaran)

```bash
# Fitur baru
curl -s -o /dev/null -w "sales_show=%{http_code}\n" http://127.0.0.1:8000/sales/rukman-fadli     # 200
curl -s -o /dev/null -w "sales_404=%{http_code}\n"  http://127.0.0.1:8000/sales/tidak-ada       # 404

# Regresi — semua harus 200
for r in / /pricelist /proses-kredit /simulasi-kredit /tes-drive /portofolio /kontak \
         /product/stargazer /product/creta /product/stargazer-x /product/hyundai-kona \
         /product/santa-fe /product/staria /product/ioniq-5 /product/palisade \
         /product/ioniq-6 /product/all-new-santa-fe; do
  printf "%-28s %s\n" "$r" "$(curl -s -o /dev/null -w '%{http_code}' http://127.0.0.1:8000$r)"
done

# Kebersihan
grep -rn "Rukman\|0896-1688" resources/views/ || echo "BERSIH: tidak ada data hardcoded"
grep -rn 'style="' resources/views/sales/ resources/views/homepage/ || echo "BERSIH: tanpa inline style"

php artisan view:cache
npm run build
```

**Tambahan wajib:** konfirmasi nomor WA ter-render sebagai `wa.me/6289616880688` di HTML:
```bash
curl -s http://127.0.0.1:8000/sales/rukman-fadli | grep -o 'wa.me/[0-9]*' | head -3
```

## 9. Laporan yang diminta

1. Daftar file dibuat/diubah.
2. Semua keluaran verifikasi (termasuk cek regresi).
3. Keputusan yang diambil untuk data homepage (controller vs View::share) + alasan.
4. Kendala apa pun.
