# SPEC F5 — Dokumentasi & Storage

**Fase:** F5
**Prasyarat:** F4 selesai.

Referensi: `docs/prd.md FR-3/FR-6`, `docs/arsitektur.md §7`.

## Tujuan

Sales & admin dapat mengunggah dokumentasi (foto kegiatan, penyerahan unit, dsb). File tersimpan benar di disk `public`, tampil di halaman publik, dan terhapus bersih saat record dihapus.

## 1. Storage

```bash
php artisan storage:link
```

- Pastikan `.env` punya `FILESYSTEM_DISK=public` (tambahkan bila belum ada; jangan ganti nilai lain yang sudah benar).
- Struktur: `storage/app/public/sales/photos/…` (foto profil) dan `storage/app/public/sales/documents/…`.

## 2. Validasi Upload

Di form (Filament): `image()`, `maxSize(4096)`, `acceptedFileTypes(['image/jpeg','image/png','image/webp'])`.

Bila ada upload dari sisi non-Filament, validasi di server setara.

## 3. Pembersihan File (penting)

File harus dihapus saat record dihapus — bukan hanya barisnya.

- Pada `SalesDocument`: hapus file `file_path` saat model `deleted`/`forceDeleted`.
- Pada `Sales` (soft delete): **jangan** hapus file saat soft delete (agar bisa dipulihkan). Hapus hanya pada `forceDeleted`.
- Pada penggantian foto profil: hapus file lama setelah berhasil simpan yang baru.
- Implementasi: model event (`static::deleting`) atau Observer. Hindari logika di controller.

Tambahkan test/verifikasi bahwa file benar-benar hilang dari disk.

## 4. Tampilan Publik

- Grid dokumentasi di `/sales/{slug}` sudah dibuat di F4 — pastikan kini menampilkan file dari storage (bukan placeholder).
- Lightbox (modal Bootstrap) untuk pratinjau.
- Caption tampil.
- Empty state tetap ada bila tidak ada dokumentasi.

## 5. Panel

- Admin: kelola dokumentasi semua sales.
- Sales: hanya dokumentasi sendiri (sudah dibatasi di F3 — verifikasi masih berlaku setelah perubahan ini).
- Dukung upload beberapa file sekaligus bila memungkinkan (atau jelaskan bila tidak).

## 6. Larangan

- JANGAN mengubah `routes/web.php`.
- JANGAN menyimpan URL absolut di DB — hanya path relatif.
- JANGAN menambah dependency baru (tanpa persetujuan).
- JANGAN mengubah halaman produk / `config/cars.php`.

## 7. Kriteria Selesai (jalankan, laporkan hasil)

```bash
php artisan storage:link                                  # symlink ada
ls -la public/storage                                     # menunjuk ke storage/app/public
php artisan test                                          # semua hijau (termasuk dari F3)
php artisan view:cache
npm run build
```

Verifikasi fungsional (laporkan hasilnya):
```bash
# Buat dokumentasi via tinker, pastikan file path tersimpan & bisa diakses
php artisan tinker --execute="\$s=\App\Models\Sales::first(); echo \$s->documents()->count();"
ls -R storage/app/public/sales 2>/dev/null | head -20
```

## 8. Laporan yang diminta

1. Daftar file dibuat/diubah.
2. Keluaran verifikasi.
3. Konfirmasi file terhapus dari disk saat dokumentasi dihapus (buktikan dengan perintah).
4. Kendala apa pun.
