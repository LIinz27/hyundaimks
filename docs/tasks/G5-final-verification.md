# SPEC G5 — Verifikasi Menyeluruh & Penutupan

**Fase:** G5 (penutup)
**Prasyarat:** G0–G4 selesai.

## Tujuan

Membuktikan seluruh sistem berjalan sebagai satu kesatuan, menutup celah, dan
membersihkan sisa. Ini fase pemeriksaan, bukan pembangunan fitur.

## 1. Pemeriksaan tautan mati (paling penting)

Jalankan pemeriksaan link internal:

```bash
bash scripts/check-sales-links.sh
```

**Harus bersih** — tidak ada `<a href>`, `<form action>`, `route()`, `url()` yang
menunjuk rute internal tanpa `sales_route()` / `sales_redirect_route()`.

Kalau skrip itu belum dibuat (seharusnya dibuat di G2), buat sekarang dan laporkan
temuannya.

## 2. Sweep link mati secara nyata (bukan hanya grep)

Ambil beranda ber-konteks, ekstrak **setiap** `href` internal, lalu buka satu per satu:

```bash
# Ekstrak link dari beranda, kunjungi semuanya, laporkan yang bukan 200
curl -s "http://127.0.0.1:8000/?s=rukman-fadli" \
  | grep -oE 'href="[^"]+"' | sed 's/href="//;s/"$//' \
  | grep -E '^/|^http://127' | sort -u
# lalu loop dan cetak status code tiap link
```

Ulangi untuk halaman: pricelist, kontak, satu halaman produk, proses-kredit.
**Semua link internal harus 200** (kecuali yang memang eksternal).

Ini menangkap kasus yang grep tidak lihat: link yang sudah pakai helper tapi
parameternya tidak valid.

## 3. Matriks akses lengkap

Tabel ini harus dibuktikan (bukan hanya diklaim):

| Konteks | `/` | `/pricelist` | `/product/x` | `/kontak` | `/admin` |
|---|---|---|---|---|---|
| tanpa parameter | 404 | 404 | 404 | 404 | 302 |
| `?s=aktif` | 200 | 200 | 200 | 200 | 302 |
| `?s=nonaktif` | 404 | 404 | 404 | 404 | 302 |
| `?s=salah` | 404 | 404 | 404 | 404 | 302 |
| login sales | 200 | 200 | 200 | 200 | 302 |

## 4. Isolasi antar-sales (keamanan)

1. Buat 2 sales berakun (A & B), masing-masing dengan 1 dokumen.
2. Buka beranda sebagai A → hanya melihat dokumen & kontak A.
3. Sales A mencoba `?s=B` → tetap konteks A.
4. Sales A buka `/admin/sales` → 403.
5. Setelah selesai, **hapus data uji**.

## 5. Audit performa

Hitung query:
- Beranda ber-konteks → harus **kecil** (1–3 query), dokumentasi eager-loaded.
- Halaman produk ber-konteks → wajar.
- **Tidak boleh ada N+1.**

Bonus: pastikan beranda punya **tepat 1 query untuk sales + 1 untuk dokumentasi**.

## 6. Kebersihan

- `grep -rn 'style="' resources/views/` → bersih (tanpa inline style)
- Tidak ada referensi ke kode yang dihapus G3 (`sales.show`, `SalesPageController`, dll.)
- Tidak ada file sisa di `storage/app/public/sales/` dari data uji
- DB hanya berisi data sebenarnya (1 sales: rukman-fadli; 1 admin)
- `npm run build` sukses
- `php artisan view:cache` sukses

## 7. Aksesibilitas (pemeriksaan, bukan perbaikan besar)

- Semua `<img>` punya `alt`
- Tombol ikon punya `aria-label`
- Ikon dekoratif `aria-hidden="true"`
- Kontras teks wajar

Laporkan pelanggaran; perbaiki yang sederhana.

## 8. Larangan

- JANGAN menambah fitur baru.
- JANGAN mengubah `config/cars.php`.
- JANGAN menambah dependency.
- JANGAN mengubah perilaku yang sudah disetujui spec.

## 9. Kriteria Selesai (jalankan, laporkan SEMUA keluaran)

```bash
bash scripts/check-sales-links.sh
php artisan test
php artisan view:cache
npm run build
php artisan route:list | grep -c GET
```

Plus tabel matriks §3, sweep link §2, audit query §5, dan kondisi DB §6.

## 10. Laporan yang diminta

1. Keluaran semua verifikasi.
2. Tabel matriks §3 (lengkap).
3. Hasil sweep link §2 (daftar link + status).
4. Hasil audit query §5.
5. Daftar pelanggaran aksesibilitas + yang diperbaiki.
6. **Daftar sisa masalah yang BELUM terselesaikan** (jujur, jangan disembunyikan).
7. Kendala.
