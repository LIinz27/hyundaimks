# SPEC FINAL — Beranda Personal per Sales

**Status:** ✅ DISETUJUI & DIKUNCI — eksekusi G0–G5 dijalankan.
**Tanggal:** 2026-09-20
**Menggantikan:** arah "halaman `/sales/{slug}`" (F0–F6) — lihat `spec-beranda-personal.md` untuk latar.

---

## 1. Perilaku yang diinginkan

### 1.1 Inti
**Beranda itu sendiri** menampilkan identitas satu sales. Tidak ada halaman baru.
Sales aktif ditentukan oleh parameter URL `?s=<slug>`. Semua halaman publik lain
(`pricelist`, `product/*`, `kontak`, `proses-kredit`, dll.) menampilkan konteks sales
yang sama.

### 1.2 Yang berubah per sales

| Bagian | Berubah? |
|---|---|
| Profil (nama, jabatan, bio, foto) | ✅ |
| Nomor WhatsApp / telepon / email + semua tombol kontak | ✅ |
| Galeri dealer (dokumentasi milik sales) | ✅ |
| Katalog mobil (spesifikasi, harga, gambar) | ❌ tetap |
| Pricelist | ❌ tetap |
| **Footer** | ❌ **tetap kontak dealer pusat** |

### 1.3 Cara akses

| Siapa | Cara |
|---|---|
| Pengunjung publik | `https://domain.com/?s=rukman-fadli` |
| Pengunjung pindah halaman | parameter ikut: `/pricelist?s=rukman-fadli` |
| Sales yang login | **otomatis** versinya sendiri, tanpa parameter |
| Admin | `/admin` dikecualikan — login biasa |

### 1.4 Aturan akses

- **SEMUA halaman publik** wajib ada konteks sales aktif. Tanpa konteks → **404**.
- Beranda `/` tanpa parameter → **404**.
- `?s=slug-salah` → **404**.
- Pengunjung tidak bisa ganti sales sendiri; terikat link yang dibuka.
- Sales login + `?s=sales-lain` → **tetap versinya sendiri** (parameter diabaikan).

### 1.5 Halaman 404
Ber-styling cantik, pesan "Akses hanya lewat link dari sales", **tanpa** nomor kontak.

### 1.6 Galeri kosong
Seksi **"Galeri Dealer"** tetap dirender dengan judul. Isinya kotak abu-abu berikon
gambar + teks **"Dokumentasi belum tersedia"**. Tidak disembunyikan.

### 1.7 Batas jumlah galeri di beranda
Dibatasi maksimum, **sesuai jumlah foto yang ada sekarang**. Untuk saat ini:
tampilkan **maksimum 6 item** (3 baris × 2 kolom di desktop), urut `sort_order`
lalu terbaru. Sisanya tidak ditampilkan di beranda.

> Catatan: kalau nanti dokumentasi bertambah, angka 6 ini tempatnya di satu konstanta
> agar mudah diubah, bukan angka tersebar di view.

### 1.8 Panel (tidak ada perubahan izin)

| Siapa | Boleh |
|---|---|
| Admin | kelola semua sales + dokumentasi semua sales |
| Sales | "Profil Saya" (edit identitas & kontak) + galeri dokumentasi sendiri |

Sales **tidak perlu admin** untuk mengurus profil dan galerinya sendiri.

---

## 2. Arsitektur

### 2.1 Middleware `ResolveActiveSales`

`app/Http/Middleware/ResolveActiveSales.php`

```
1. user login & punya Sales  → pakai Sales miliknya        (prioritas tertinggi)
2. ada ?s=<slug>             → cari Sales aktif dgn slug itu
3. tidak ada keduanya        → abort(404)
4. Sales nonaktif (is_active=false) tidak pernah match     → abort(404)
5. simpan ke container singleton 'active.sales'
```

Didaftarkan pada **grup rute publik saja** — bukan `/admin`, bukan aset statis.

Alasan middleware: resolusi terjadi sekali, dipakai semua halaman; tidak menyalin
logika `?s=` ke 17 controller.

### 2.2 Penyaluran ke view
- View composer / `View::share('activeSales', $sales)` pada layout publik.
- Layout admin tidak mendapat variabel ini — view publik harus tahan `null` bila
  suatu saat dirender di konteks lain.
- Helper `active_sales()` untuk akses dari controller & view.

### 2.3 Parameter menempel di link — BAGIAN PALING MUDAH RUSAK

Helper baru:

```php
sales_route('pricelist')   // → /pricelist?s=rukman-fadli
```

- Menyisipkan `?s=` otomatis bila konteks berasal dari parameter.
- Bila konteks dari **akun login**, menghasilkan link **tanpa** `?s=`
  (konteks sudah implisit).
- **Semua** `<a href>`, `<form action>`, dan redirect yang menuju rute publik
  wajib memakai helper ini.

Berkas yang sudah teridentifikasi memuat link/kontak:

| Berkas | Perlu diubah |
|---|---|
| `resources/views/header.blade.php` | navigasi → `sales_route()` |
| `resources/views/footer.blade.php` | navigasi → `sales_route()`; **kontak tetap dealer pusat** |
| `resources/views/homepage/*.blade.php` | tombol, link |
| `resources/views/product/show.blade.php` | tombol WA → sales, link → `sales_route()` |
| `resources/views/pages/kredit.blade.php` | tombol WA → sales |
| `resources/views/homepage/benefit.blade.php` | kontak |

### 2.4 Controller beranda
`Route::view('/', 'homepage/home')` tidak bisa menerima data → ganti jadi
`HomeController@index` yang mengirim sales aktif + dokumentasi (maks 6).

---

## 3. Yang dibongkar

| Berkas | Aksi |
|---|---|
| rute `sales/{slug}` di `routes/web.php` | hapus |
| `app/Http/Controllers/SalesPageController.php` | hapus |
| `resources/views/sales/show.blade.php` | hapus |
| `resources/views/homepage/sales-card.blade.php` | hapus |
| `tests/Feature/PublicSalesPageTest.php` | ganti jadi test beranda personal |
| seksi "Tim Sales Kami" di `home.blade.php` | ganti: profil sales aktif + galeri |
| `View::composer(...)` untuk `salesList` di `AppServiceProvider` | ganti `activeSales` |
| `resources/views/sales/` (folder) | hapus bila kosong |

## 4. Yang dipertahankan

Model `Sales` + `SalesDocument` · migrasi · seeder · panel admin · `SalesPolicy` +
scoping · halaman "Profil Saya" · upload & pembersihan file · normalisasi nomor ·
test otorisasi & storage.

---

## 5. Rencana eksekusi

| Langkah | Isi | Verifikasi |
|---|---|---|
| **G0** | Middleware + helper `sales_route` + 404 kustom | `/?s=rukman-fadli` 200 · `/` 404 · `?s=salah` 404 · sales login lihat versinya |
| **G1** | Beranda personal: profil + galeri (maks 6, placeholder kosong) + tombol WA sales | isi beranda = sales benar; galeri kosong → placeholder |
| **G2** | Sebar parameter ke semua link + semua tombol kontak | grep: tidak ada `<a href="/…">` yang lolos helper; tombol WA = sales |
| **G3** | Bongkar `/sales/{slug}` + bersihkan referensi mati | rute hilang; tidak ada referensi ke kelas/view yang dihapus |
| **G4** | Pastikan panel sales: profil + galeri sendiri | sales hanya lihat miliknya; upload jalan |
| **G5** | Verifikasi menyeluruh | regresi semua halaman publik + isolasi antar-sales + test hijau |

Tiap langkah: eksekusi OpenCode → **verifikasi mandiri** → commit.

---

## 6. Risiko yang diketahui

1. **`?s=` hilang di satu link** → pengunjung kena 404. Mitigasi: helper wajib +
   pemeriksaan grep otomatis di akhir yang mendaftar setiap `href` yang tidak
   memakai helper.
2. **Subdomain nanti** (`rukman.domain.com`) — logika resolusi terpusat di middleware,
   jadi penambahan sumber (host) tidak membongkar apa pun.
3. **Link mati bila sales dinonaktifkan** — **Anda sudah menyatakan ini benar**
   (disengaja). Konsekuensi yang tetap berlaku:
   - Tanpa parameter, situs tidak bisa dibuka siapa pun
   - Mesin pencari tidak mengindeks (tidak ada URL publik tetap)
   - Sales resign → semua link yang tersebar mati
4. **Panel admin dikecualikan** dari aturan 404 — kalau tidak, admin terkunci dari
   panelnya sendiri (lingkaran mati: butuh panel untuk buat sales, butuh sales untuk
   buka panel).

---

## 7. Pertanyaan tersisa (hanya 1 — sisanya sudah dijawab)

**Maksimum galeri di beranda = 6.** Setuju, atau angka lain?
