# SPEC G2 — Sebar Konteks Sales ke Semua Halaman

**Fase:** G2
**Prasyarat:** G1 selesai.
**Referensi wajib:** `docs/spec-beranda-personal-final.md` §1.2, §2.3.

**Ini fase paling rawan.** Satu link yang lolos dari helper = pengunjung klik lalu
kena 404. Kerjakan teliti, dan buktikan dengan pemeriksaan otomatis di akhir.

## Tujuan

1. Setiap halaman publik (`pricelist`, `product/*`, `kontak`, `proses-kredit`,
   `simulasi-kredit`, `tes-drive`, `portofolio`) menampilkan konteks sales aktif.
2. Setiap link antar-halaman membawa parameter `?s=`.
3. Semua tombol kontak (WA/telepon) menuju sales aktif.

## 1. Semua link wajib lewat helper

Ganti SEMUA `<a href="...">` yang menuju rute internal (bukan tautan eksternal, bukan
`#`, bukan `mailto:`) memakai `sales_route()`:

| Sebelum | Sesudah |
|---|---|
| `{{ route('pricelist') }}` | `{{ sales_route('pricelist') }}` |
| `<a href="/kontak">` | `<a href="{{ sales_route('kontak') }}">` |
| `{{ url('/product/stargazer') }}` | `{{ sales_route('product.stargazer') }}` (atau sesuai nama rute) |

Periksa berkas:
- `resources/views/header.blade.php` — navigasi utama
- `resources/views/footer.blade.php` — navigasi footer (kontak footer TETAP dealer pusat)
- `resources/views/homepage/*.blade.php`
- `resources/views/product/show.blade.php`
- `resources/views/pages/*.blade.php`

Tautan **eksternal** (sosial media, WA, telp) TIDAK diubah kecuali tombol kontak sales
(lihat §3).

## 2. Tombol kontak menuju sales aktif

Semua tombol WhatsApp/telepon di halaman publik menuju **sales aktif**, bukan nomor
dealer pusat:

| Berkas | Perubahan |
|---|---|
| `resources/views/homepage/benefit.blade.php` | WA → `active_sales()->whatsappLink()` |
| `resources/views/product/show.blade.php` | WA → sales aktif |
| `resources/views/pages/kredit.blade.php` | WA → sales aktif |
| lainnya (hasil grep `wa.me\|whatsapp`) | sama |

**PENGECUALIAN: footer.** Sesuai keputusan pemilik (spec §1.2), footer tetap memakai
kontak dealer pusat dari `config/site.php`. Jangan ubah.

Bila sales tidak punya nomor, **jangan render tombol kosong** — sembunyikan tombolnya
(dan siapkan tampilan yang tetap rapi).

## 3. Controller publik: kirim konteks

Controller publik yang me-render view (kalau ada yang perlu data sales) harus mengambil
`active_sales()`. Sebagian besar cukup dari view karena `View::share` di G0.

## 4. Form & redirect

- `<form action="...">` yang menuju rute internal → pakai `sales_route()`.
- Redirect di controller (`redirect()->route('...')`) → tambahkan parameter
  `['s' => active_sales()?->slug]` bila sumbernya query.
  Buat helper `sales_redirect_route()` bila perlu, atau jelaskan pendekatanmu.

## 5. Pemeriksaan otomatis (WAJIB — bagian terpenting fase ini)

Buat skrip `scripts/check-sales-links.sh` (atau artisan command) yang:
1. Meng-grep semua `resources/views/**/*.blade.php`
2. Mendaftar setiap `<a href=`, `<form action=`, `route(`, `url(` yang menunjuk rute internal
3. Menandai yang **TIDAK** memakai `sales_route(` / `sales_redirect_route(`

Jalankan dan laporkan hasilnya. Bila ada yang lolos, perbaiki sampai bersih.

Contoh pendekatan grep:
```bash
grep -rnE '<a[^>]+href="(/(pricelist|kontak|portofolio|produk|product|proses-kredit|simulasi-kredit|tes-drive)[^"]*|\{\{\s*route\()' resources/views/
```

## 6. Test (WAJIB)

Tambahkan ke `tests/Feature/`:

1. `test_pricelist_shows_active_sales_context` — `GET /pricelist?s=<slug>` → 200 & nama sales tampil
2. `test_all_public_pages_require_context` — setiap rute publik tanpa `?s=` → 404
3. `test_all_public_pages_work_with_context` — setiap rute publik dengan `?s=` → 200
4. `test_contact_buttons_point_to_active_sales` — WA di halaman produk = nomor sales
5. `test_footer_keeps_central_contact` — footer TIDAK memakai nomor sales

Item 2 & 3 harus mengulang **semua** rute publik (loop), bukan sampel.

## 7. Larangan

- JANGAN mengubah `config/cars.php`.
- JANGAN mengubah footer jadi kontak sales.
- JANGAN menghapus `/sales/{slug}` (itu G3).
- JANGAN menambah dependency.
- JANGAN mengubah panel admin.

## 8. Kriteria Selesai (jalankan, laporkan SEMUA keluaran)

```bash
# Setiap halaman dengan konteks = 200
for r in / /pricelist /proses-kredit /simulasi-kredit /tes-drive /portofolio /kontak \
         /product/stargazer /product/creta /product/stargazer-x /product/hyundai-kona \
         /product/santa-fe /product/staria /product/ioniq-5 /product/palisade \
         /product/ioniq-6 /product/all-new-santa-fe; do
  printf "%-28s %s\n" "$r?s=rukman-fadli" "$(curl -s -o /dev/null -w '%{http_code}' "http://127.0.0.1:8000$r?s=rukman-fadli")"
done

# Tanpa konteks = 404
for r in /pricelist /kontak /product/stargazer; do
  printf "%-28s %s\n" "$r (tanpa param)" "$(curl -s -o /dev/null -w '%{http_code}' "http://127.0.0.1:8000$r")"
done

# Link internal membawa ?s=
curl -s "http://127.0.0.1:8000/?s=rukman-fadli" | grep -oE 'href="[^"]*\?s=[^"]*"' | head -5

bash scripts/check-sales-links.sh

php artisan test
php artisan view:cache
npm run build
```

## 9. Laporan yang diminta

1. Daftar file diubah.
2. Keluaran SEMUA verifikasi (terutama tabel status code lengkap).
3. Keluaran `scripts/check-sales-links.sh` (harus bersih).
4. Bukti tombol WA di halaman produk menunjuk sales aktif, bukan dealer pusat.
5. Konfirmasi footer tetap kontak dealer pusat.
6. Kendala apa pun.
