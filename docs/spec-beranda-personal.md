# SPEC BARU — Beranda Personal per Sales (Revisi Arah)

**Status:** MENUNGGU TINJAUAN — belum ada kode yang ditulis.
**Tanggal:** 2026-09-20
**Menggantikan:** arah "platform multi-sales dengan halaman `/sales/{slug}`" (F0–F6)

---

## 0. Latar: apa yang salah dari arah sebelumnya

Arah lama membangun **halaman terpisah per sales** (`/sales/rukman-fadli`) dan menambahkan
seksi "Tim Sales Kami" di beranda. Yang sebenarnya diinginkan: **beranda itu sendiri yang
berubah** tergantung sales. Tidak ada halaman baru.

Konsekuensi: arah lama membuang perhatian ke halaman yang tidak diperlukan, sementara
inti (beranda personal) tidak tersentuh.

---

## 1. Perilaku yang diinginkan (hasil konfirmasi)

### 1.1 Inti
Beranda tampil sebagai milik satu sales. Siapa sales itu ditentukan oleh **parameter URL
`?s=<slug>`**. Semua halaman publik lain (`pricelist`, `product/*`, `kontak`, dll.)
juga menampilkan konteks sales yang sama.

### 1.2 Yang berubah per sales
| Bagian | Berubah? |
|---|---|
| Profil sales (nama, foto, jabatan, bio) | ✅ |
| Nomor WhatsApp / telepon / email | ✅ — semua tombol kontak menuju sales itu |
| Galeri dealer (dokumentasi milik sales) | ✅ |
| Katalog mobil (spesifikasi, harga, gambar) | ❌ tetap sama |
| Pricelist | ❌ tetap sama |

### 1.3 Cara akses
| Siapa | Cara |
|---|---|
| Pengunjung publik | `https://domain.com/?s=rukman-fadli` — link dibagikan sales |
| Pengunjung pindah halaman | parameter ikut: `/pricelist?s=rukman-fadli` |
| Sales yang login | **otomatis** versinya sendiri, tanpa parameter |
| Admin | `/admin` dikecualikan — login seperti biasa |

### 1.4 Aturan akses menyeluruh
- **SEMUA halaman publik** wajib ada konteks sales. Tanpa konteks → **404**.
- Termasuk beranda `/` tanpa parameter → 404.
- Pengunjung **tidak bisa** ganti-ganti sales sendiri; terikat ke link yang dibuka.
- Sales yang login: konteks diambil dari akunnya, parameter diabaikan/di-override.
- Panel admin `/admin` dan halaman login Filament **dikecualikan**.

### 1.5 Tampilan 404
404 ber-styling cantik ("Akses hanya lewat link dari sales"), **tanpa** nomor kontak.

---

## 2. Arsitektur teknis yang diusulkan

### 2.1 Middleware resolusi sales
`app/Http/Middleware/ResolveActiveSales.php`

```
1. Kalau user login DAN punya record Sales  → pakai Sales miliknya   (prioritas tertinggi)
2. Kalau ada ?s=<slug>                      → cari Sales aktif dgn slug itu
3. Kalau tidak ada keduanya                 → abort(404)
4. Simpan ke container/singleton agar bisa diakses view & controller
```

Didaftarkan pada grup rute publik saja (bukan `/admin`, bukan aset).

Kenapa middleware: resolusi terjadi **sekali**, dipakai di semua halaman — tidak
menduplikasi logika `?s=` di 17 controller.

### 2.2 Penyaluran konteks ke view
- `View::share('activeSales', $sales)` atau view composer di layout.
- Kesediaan `activeSales` = null di panel admin → view harus tahan null.

### 2.3 Parameter menempel di link (`?s=` tidak boleh hilang)
Ini bagian paling mudah rusak. Solusi: **helper** `sales_route('pricelist')` yang
otomatis menyisipkan `?s=` dari konteks aktif. Semua `<a href>` diubah memakainya.

Contoh: `{{ sales_route('pricelist') }}` → `/pricelist?s=rukman-fadli`

Kalau sales yang login (tanpa parameter), helper menghasilkan link tanpa `?s=`
karena konteksnya sudah dari akun.

### 2.4 Controller beranda
`Route::view('/', 'homepage/home')` **tidak bisa** menerima data → ubah jadi
`HomeController@index` yang mengirim `$sales` + `$documents`.

Berkas yang perlu diperiksa: 7 view yang memuat nomor kontak
(`footer`, `homepage/benefit`, `product/show`, `pages/kredit`, dll.) — semua
harus membaca dari `activeSales`, bukan `config('site.*')`.

**Pengecualian:** halaman yang memang menampilkan kontak dealer pusat (kalau ada)
tetap dari `config/site.php`. Perlu dipastikan mana yang termasuk — lihat §5.

---

## 3. Yang dibongkar

| Berkas | Aksi |
|---|---|
| `routes/web.php` — rute `sales/{slug}` | hapus |
| `app/Http/Controllers/SalesPageController.php` | hapus |
| `resources/views/sales/show.blade.php` | hapus |
| `resources/views/homepage/sales-card.blade.php` | hapus (tidak ada lagi "tim sales") |
| `tests/Feature/PublicSalesPageTest.php` | hapus / ganti ke test beranda personal |
| Seksi "Tim Sales Kami" di `home.blade.php` | ganti dengan galeri + profil sales aktif |
| `View::composer` di `AppServiceProvider` utk `salesList` | ganti jadi `activeSales` |

## 4. Yang dipertahankan (dari F0–F6)

- Model `Sales` + `SalesDocument`, migrasi, seeder
- Panel admin `/admin` (SalesResource, SalesDocumentResource)
- `SalesPolicy` + scoping query (isolasi antar-sales)
- Halaman "Profil Saya" untuk sales
- Upload + pembersihan file otomatis
- Normalisasi nomor (`0896…` → `62896…`)
- Test otorisasi & storage cleanup

---

## 5. Pertanyaan terbuka (perlu keputusan Anda sebelum eksekusi)

1. **Galeri dealer di beranda** — dokumentasi yang diupload sales (§2.2 `SalesDocument`).
   Berapa banyak yang tampil? Semua, atau dibatasi (mis. 6 terbaru)?
   = ya dibatasi max sesuaikan dengan jumlah foto yang ada sekarang
2. **Tombol WA di beranda** — langsung ke WA sales (= link beranda sekaligus kontaknya).
   Benar?
   = benar
3. **Footer** — sebaiknya menampilkan kontak sales aktif, atau tetap kontak dealer pusat?
   =Kontak dealer pusat
4. **Sales tanpa dokumentasi** — galeri disembunyikan, atau tampil placeholder?
   =placeholder seperti apa?
5. **Kalau pengunjung buka `/?s=slug-salah`** — 404 (§1.4), atau tampilkan pesan
   "link tidak valid"?
   =404
6. **Sales yang login lalu akses `/`** — langsung versinya. Kalau dia akses
   `/?s=sales-lain`? (saya usul: diabaikan, tetap versinya sendiri)
   =tetap versinya sendiri

---

## 6. Rencana eksekusi (setelah spec disetujui)

| Langkah | Isi | Verifikasi |
|---|---|---|
| G0 | Middleware + helper + 404 kustom | test resolusi: ada/tidak ada/slug salah/login |
| G1 | Beranda personal: profil + galeri + WA | `/?s=rukman-fadli` 200, `/` 404 |
| G2 | Sebar parameter ke semua link + kontak | tiap halaman tetap punya `?s=`, tombol WA = sales |
| G3 | Bongkar `/sales/{slug}` + bersihkan sisa | rute hilang, tidak ada referensi mati |
| G4 | Panel: kelola galeri & profil | sales lihat galeri sendiri |
| G5 | Verifikasi menyeluruh | regresi semua halaman + isolasi sales |

Setiap langkah: spec → eksekusi OpenCode → verifikasi mandiri → commit.

---

## 7. Risiko yang saya catat sekarang

1. **`?s=` bisa hilang** di link yang ditulis manual (form action, redirect, sitemap).
   Mitigasi: helper wajib + grep pemeriksa di akhir.
2. **Subdomain nanti** — kalau nanti pakai `rukman.domain.com`, logika resolusi
   tinggal menambah sumber kedua (host). Tidak membongkar apa pun. Karena itu
   resolusi dipusatkan di middleware, bukan disebar.
3. **Tanpa konteks = 404 menyeluruh** berarti situs **tidak punya** halaman publik yang
   bisa diakses langsung. Ini disengaja, tapi berarti:
   - Tidak bisa dibuka dari mesin pencari tanpa link sales
   - Butuh link sales untuk setiap kunjungan
   - Kalau sales dihapus/nonaktif, link-nya mati
   = sangat benar

sedikit info
admin punya panel sendiri untuk atur sales dan fitur penting lainnya
sales punya panel sendiri juga untuk atur/upload update diri mereka sendiri jadi tidak perlu admin