# KOREKSI PENTING — baca sebelum menyentuh data `sales`

Ditemukan saat memeriksa database asli sebelum pemisahan panel admin/sales.

## Data `sales` tidak konsisten

```
sales #4  slug rukman-fadli            user_id=26  -> user 26 ADA (rukman.fadli) ✓
sales #10 slug gregory-oreilly-25156   user_id=11  -> user 11 TIDAK ADA ✗
sales #11 slug rod-larson-8978         user_id=12  -> user 12 TIDAK ADA ✗
sales #26 slug whitney-rutherford-...  user_id=27  -> user 27 TIDAK ADA ✗
```

Total user hanya 2: `id=2 admin` (role admin), `id=26 rukman.fadli` (role sales).

Tiga dari empat record sales menunjuk user yang sudah tidak ada — sisa user factory
yang pernah dihapus (termasuk `wdickens@example.net` yang dibersihkan).

## Yang harus dilakukan

1. **Tangani data yatim ini secara eksplisit.** Pilih satu dan laporkan alasannya:
   - Hapus 3 sales yatim lewat **seeder idempoten atau migrasi data** — JANGAN lewat
     tinker pada database asli.
   - Atau set `user_id = NULL` untuk mereka.

   Hasil akhir: `/sales` hanya berisi sales yang benar-benar punya akun login.

2. **`rukman-fadli` (sales #4) harus tetap UTUH** — itu sales sungguhan dengan
   7 foto galeri. **JANGAN sampai fotonya terhapus.** Insiden serupa pernah terjadi
   dan sudah dipulihkan; jangan ulangi.

3. **Cek jumlah galeri per sales SEBELUM menghapus apa pun** dan laporkan angkanya.
   Jangan menghapus sales yang punya galeri.

4. Kalau user sales login tapi belum tertaut ke record sales → tampilkan pesan
   **jelas**, jangan crash. Tulis test untuk kasus ini.

## Aturan proyek yang tidak boleh dilanggar

- **JANGAN `php artisan config:cache`** (atau `optimize`) — membekukan path DB
  sehingga test menulis ke database asli.
- Semua test wajib `RefreshDatabase` / DB terpisah.
- Halaman login memakai Livewire — test pakai `Livewire::test()`, bukan `$this->post()`
  (menghasilkan 405).
- Jangan ubah `APP_ENV=local`, `APP_DEBUG=false`, `SESSION_SECURE_COOKIE=false`.
