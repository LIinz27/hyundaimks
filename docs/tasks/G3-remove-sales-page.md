# SPEC G3 — Bongkar `/sales/{slug}` & Bersihkan Sisa

**Fase:** G3
**Prasyarat:** G2 selesai (semua konteks sudah bekerja di semua halaman).

## Tujuan

Menghapus arah lama secara tuntas agar tidak ada kode mati. Setelah fase ini, satu-satunya
cara mengakses situs adalah lewat beranda personal (parameter atau akun sales).

## 1. Hapus

| Item | Aksi |
|---|---|
| Rute `Route::get('/sales/{slug}', ...)` di `routes/web.php` | hapus |
| `app/Http/Controllers/SalesPageController.php` | hapus file |
| `resources/views/sales/show.blade.php` | hapus file |
| `resources/views/sales/` (folder, bila kosong) | hapus folder |
| `resources/views/homepage/sales-card.blade.php` | hapus file |
| `tests/Feature/PublicSalesPageTest.php` | hapus (sudah digantikan test G0/G1/G2) |
| `View::composer` untuk `salesList` di `AppServiceProvider` | hapus/ganti |
| CSS khusus halaman lama (`.sales-hero`, `.sales-docs-grid` bila tak terpakai) | hapus |

**Sebelum menghapus `sales/show.blade.php`:** pastikan pola lightbox galeri sudah
dipindahkan ke beranda di G1. Kalau belum, pindahkan dulu — jangan hapus lalu kehilangan
polanya.

## 2. Bersihkan referensi mati

Cari dan hapus sisa rujukan:

```bash
grep -rn "sales.show\|SalesPageController\|sales/show\|sales-card\|salesList" \
  app/ resources/ routes/ tests/ config/ 2>/dev/null
```

Hasil harus kosong. Perbaiki setiap temuan.

Juga periksa:
- `resources/views/sales/` masih ada?
- Nama rute `sales.show` masih dirujuk di view/nav/sitemap?
- Test yang masih memanggil `/sales/...`?

## 3. Pastikan tidak ada halaman publik lain yang lolos aturan 404

Setelah `/sales/{slug}` hilang, **setiap** rute publik harus:
- 404 tanpa konteks
- 200 dengan konteks

Buktikan dengan loop.

## 4. Larangan

- JANGAN mengubah panel admin.
- JANGAN mengubah `config/cars.php`.
- JANGAN menghapus model `Sales`/`SalesDocument` atau migrasi (masih dipakai).
- JANGAN menghapus test otorisasi F3 (`SalesAuthorizationTest`) — masih berlaku.
- JANGAN menghapus test storage F5 (`StorageCleanupTest`) — masih berlaku.

## 5. Kriteria Selesai (jalankan, laporkan SEMUA keluaran)

```bash
# Rute lama hilang
php artisan route:list | grep -c "sales/{slug}"          # harus 0

# Tidak ada referensi mati
grep -rn "sales.show\|SalesPageController\|sales/show\|sales-card\|salesList" app/ resources/ routes/ tests/ config/ || echo "BERSIH"

# File benar-benar hilang
ls app/Http/Controllers/SalesPageController.php 2>&1 | head -1   # No such file
ls resources/views/sales/ 2>&1 | head -1                        # No such file

# Regresi penuh
php artisan test
php artisan view:cache
npm run build

# Setiap rute publik: 404 tanpa konteks, 200 dengan konteks
for r in / /pricelist /proses-kredit /simulasi-kredit /tes-drive /portofolio /kontak \
         /product/stargazer /product/creta /product/stargazer-x /product/hyundai-kona \
         /product/santa-fe /product/staria /product/ioniq-5 /product/palisade \
         /product/ioniq-6 /product/all-new-santa-fe; do
  a=$(curl -s -o /dev/null -w '%{http_code}' "http://127.0.0.1:8000$r?s=rukman-fadli")
  b=$(curl -s -o /dev/null -w '%{http_code}' "http://127.0.0.1:8000$r")
  printf "%-30s with=%s  without=%s\n" "$r" "$a" "$b"
done
```

## 6. Laporan yang diminta

1. Daftar file dihapus/diubah.
2. Keluaran SEMUA verifikasi.
3. Konfirmasi grep referensi mati bersih.
4. Tabel status code lengkap (semua rute publik, dengan & tanpa konteks).
5. Kendala apa pun.
