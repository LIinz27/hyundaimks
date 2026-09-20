# SPEC G1 — Beranda Personal: Profil + Galeri + Kontak Sales

**Fase:** G1
**Prasyarat:** G0 selesai (middleware + `sales_route()` + 404 kustom teruji).
**Referensi wajib:** `docs/spec-beranda-personal-final.md` §1.2, §1.6, §1.7, §2.4.

## Tujuan

Mengubah beranda agar menampilkan identitas **sales yang sedang aktif**: profil,
galeri dealer, dan tombol kontak menuju sales itu. Katalog mobil & pricelist tetap.

**Fase ini TIDAK menyentuh** halaman lain (pricelist, product, kontak) — itu G2.
**Belum** menghapus `/sales/{slug}` — itu G3.

## 1. Controller beranda

`Route::view('/', 'homepage/home')` tidak bisa menerima data. Ubah menjadi:

- Buat `app/Http/Controllers/HomeController.php`
- Method `index()`:
  ```php
  $sales = app('active.sales');           // dari middleware G0
  $documents = $sales->documents()        // relasi dari F1
      ->orderBy('sort_order')
      ->latest()
      ->limit(config('site.homepage_gallery_limit', 6))
      ->get();
  return view('homepage/home', compact('sales', 'documents'));
  ```
- Ubah rute `/` di `routes/web.php` untuk memakai controller ini.
  **Rute lain jangan diubah.**

Angka 6 WAJIB diambil dari konfigurasi (tambahkan `homepage_gallery_limit` ke
`config/site.php`), bukan angka tersebar di view — sesuai spec §1.7.

## 2. Blok profil sales di beranda

Ganti blok profil lama (yang sebelumnya hardcoded, lalu diganti "Tim Sales Kami" di F4).
Sekarang: **profil sales aktif**.

Isi:
- **Foto profil** — rasio 1:1, maks ~220px. Bila `photo_path` null → **avatar fallback
  inisial nama** (pakai komponen/gaya `.avatar-fallback` yang sudah ada dari F4).
  Jangan tampilkan gambar rusak.
- **Nama** sales
- **Jabatan** (`title`) — tampil bila ada
- **Bio** — tampil bila ada
- **Badge** kecil, mis. "Sales Resmi Hyundai Makassar"

Semua field opsional harus ditangani: kalau `title` atau `bio` kosong, jangan
tinggalkan ruang kosong menganga (jangan render elemen kosong).

## 3. Tombol kontak

- **WhatsApp** → `$sales->whatsappLink()` (helper dari F1, sudah normalisasi
  `0896…` → `62896…`). **Ini link kontak utama beranda.**
- **Telepon** → `$sales->phoneLink()`
- Tampilkan tombol hanya bila nomornya ada. Kalau tidak ada, jangan render tombol kosong.
- Ikon dekoratif `aria-hidden="true"`; tombol ikon wajib `aria-label`.
- Kontras tombol WhatsApp harus memadai (lihat `docs/design.md §7`).

## 4. Galeri Dealer

Seksi baru berjudul **"Galeri Dealer"**.

- Menampilkan dokumentasi milik sales aktif (`$documents`, maks 6 dari §1).
- Grid: 2 kolom di mobile, 3 kolom di desktop (atau sesuai desain).
- Tiap item: thumbnail rasio tetap (hindari CLS), caption bila ada.
- Klik → lightbox modal Bootstrap (pola yang sudah dipakai di `sales/show.blade.php`
  sebelum dihapus di G3 — **lihat file itu sebagai referensi sebelum G3 menghapusnya**,
  atau gunakan pola modal Bootstrap yang sama).
- **State kosong (WAJIB, spec §1.6):** seksi tetap dirender dengan judul "Galeri Dealer",
  isinya kotak abu-abu berikon gambar + teks **"Dokumentasi belum tersedia"**.
  JANGAN sembunyikan seksinya.
- Semua `<img>` wajib punya `alt` bermakna.
- Gambar via `Storage::disk('public')->url($path)`.

## 5. Data diri di header/footer

**JANGAN diubah di fase ini** kecuali tombol kontak yang memang bagian beranda.
Header/footer diserahkan ke G2.

## 6. CSS

Tambah ke `resources/css/app.css` (pakai token `--brand`, jangan hardcode hex berulang):
- `.home-profile` (blok profil sales di beranda)
- `.home-gallery`, `.home-gallery-item`
- `.gallery-empty` (placeholder kotak abu)
Hormati `prefers-reduced-motion`. Tanpa inline `style="..."`.

## 7. Larangan

- JANGAN mengubah halaman pricelist / product / kontak / proses-kredit (itu G2).
- JANGAN menghapus `/sales/{slug}` (itu G3).
- JANGAN menghapus `resources/views/sales/show.blade.php` (biar G3 yang bersih-bersih).
- JANGAN menambah dependency.
- JANGAN mengubah `config/cars.php`.

## 8. Kriteria Selesai (jalankan, laporkan SEMUA keluaran)

```bash
# Beranda personal
curl -s "http://127.0.0.1:8000/?s=rukman-fadli" | grep -o "Rukman Fadli" | head -1   # nama muncul
curl -s "http://127.0.0.1:8000/?s=rukman-fadli" | grep -oE 'wa.me/[0-9]+' | head -2  # WA sales
curl -s "http://127.0.0.1:8000/?s=rukman-fadli" | grep -o "Galeri Dealer" | head -1  # judul galeri

# Tanpa konteks tetap 404 (regresi G0)
curl -s -o /dev/null -w "no param: %{http_code}\n" "http://127.0.0.1:8000/"

# Kebersihan
grep -rn 'style="' resources/views/homepage/ && echo "ADA INLINE STYLE" || echo "BERSIH inline style"

php artisan test
php artisan view:cache
npm run build
```

Tambahan wajib:
- Tunjukkan HTML yang membuktikan blok profil memuat nama sales aktif (bukan hardcoded).
- Tunjukkan bahwa galeri kosong menampilkan placeholder "Dokumentasi belum tersedia".

## 9. Laporan yang diminta

1. Daftar file dibuat/diubah.
2. Keluaran semua verifikasi.
3. Bukti nama & WA sales ter-render dari DB (mis. ubah nama di DB → tampilan berubah).
4. Bukti galeri kosong → placeholder tampil.
5. Kendala apa pun.
