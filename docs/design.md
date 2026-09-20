# Design Brief — UI/UX

**Produk:** Hyundai Dealer Makassar — Platform Multi-Sales
**Tanggal:** 2026-09-16
**Design system yang ada:** Bootstrap 5 (CDN) + CSS custom (`resources/css/app.css`, token `--brand`)

---

## 1. Prinsip Desain

1. **Kejelasan di atas dekorasi.** Pengunjung datang untuk menemukan sales dan menghubunginya. Nama, nomor, dan tombol hubungi harus tidak ambigu.
2. **Satu aksi utama per layar.** Halaman sales: aksi utama = WhatsApp. Halaman produk: aksi utama = minta penawaran.
3. **Mobile-first nyata.** Mayoritas trafik dealer datang dari ponsel. Rancang pada 360px dulu.
4. **Konsisten dengan brand yang sudah ada.** Jangan perkenalkan bahasa visual baru; perluas yang sudah ada (biru Hyundai, Manrope, radius 2, shadow lembut).
5. **Percaya pada data, bukan asumsi.** Foto/nomor yang kosong harus tampil rapi (fallback), bukan rusak.
6. **Panel admin efisien.** Admin mengelola puluhan record: cari, filter, dan aksi massal di atas form cantik.

---

## 2. Design Tokens

Diwarisi dari `resources/css/app.css`. **Wajib** dipakai, dilarang hardcode hex berulang.

| Token | Nilai | Pemakaian |
|---|---|---|
| `--brand` | `#1c4682` | Aksi utama, tautan, header aksen |
| `--brand-dark` | `#163b5a` | Hover/pressed |
| `--brand-light` | `#3069c4` | Aksen sekunder, ikon aktif |
| `--brand-rgb` | `28, 70, 130` | `rgba()` untuk overlay/shadow |
| `--body-font` | `'Manrope', system-ui, …` | Seluruh teks |
| `--header-height` | `84px` | Offset konten tetap |
| Sukses (WA) | `#25D366` | Tombol WhatsApp |
| Netral teks | `#333` | Body |
| Muted | `#6b7280` | Subjudul, caption |
| Surface | `#ffffff` | Kartu |
| Surface-alt | `#f7f8fa` | Latar seksi bergantian |
| Border | `#e5e7eb` | Garis kartu/divider |
| Radius | `12px` (kartu), `8px` (kontrol), `999px` (pill) | |
| Shadow | `0 2px 8px rgba(var(--brand-rgb), .08)` | Kartu |
| Shadow-hover | `0 8px 24px rgba(var(--brand-rgb), .16)` | Kartu hover |

### Skala tipografi

| Level | Ukuran (mobile → desktop) | Berat |
|---|---|---|
| Display (nama sales hero) | 28 → 40px | 800 |
| H1 (judul halaman) | 24 → 34px | 700 |
| H2 (seksi) | 20 → 28px | 700 |
| H3 (kartu) | 17 → 19px | 600 |
| Body | 15 → 16px | 400 |
| Caption/meta | 13 → 14px | 500 |
| Line-height body | 1.6 | |

### Spasi (skala 4px)
`4, 8, 12, 16, 24, 32, 48, 64, 96`. Seksi vertikal: 48px mobile, 80px desktop.

---

## 3. Inventaris Komponen

### 3.1 Sudah ada (perluas, jangan bongkar)
- Navbar (logo + collapse) — `header.blade.php`
- Footer (4 kolom + peta) — `footer.blade.php`
- Kartu mobil — `homepage/card.blade.php`
- Seksi benefit — `homepage/benefit.blade.php`
- Hero halaman statis — `.page-hero-title`
- Swiper: promo, galeri, partner finance
- Tombol: `.btn-brand`, `.wa-button`, `.contact-button`

### 3.2 Baru (dibuat untuk fitur ini)

| Komponen | Deskripsi | Varian/State |
|---|---|---|
| **Sales Card** | Kartu sales di homepage | grid 2/3/4 kolom; state: dengan foto, tanpa foto |
| **Sales Hero** | Blok utama halaman `/sales/{slug}` | mobile (foto di atas, teks bawah), desktop (2 kolom) |
| **Contact Action Bar** | WA + Telp | mobile: sticky bawah; desktop: inline. State: WA saja, telp saja, keduanya |
| **Documentation Grid** | Galeri dokumentasi | masonry/kolom seragam 2/3/4; state: kosong, loading, lightbox |
| **Lightbox** | Pratinjau foto dokumentasi | keyboard (Esc, ←/→), swipe mobile |
| **Avatar Fallback** | Inisial pada lingkaran brand | 1–2 huruf dari nama |
| **Empty State** | Tidak ada dokumentasi/sales | ikon + judul + satu kalimat arahan |
| **Admin: Sales Form** | Filament | seksi: Identitas, Kontak, Media, Publikasi |
| **Admin: Documentation Repeater** | Filament | drag-urut, hapus, caption inline |
| **Admin: My Profile (sales)** | Filament | subset field, tanpa slug/status |

### 3.3 Aturan state (wajib di semua komponen interaktif)
Hover, focus-visible, active, disabled, loading, empty, error. Fokus keyboard harus **terlihat** (outline `2px var(--brand-light)`, offset 2px).

---

## 4. Arsitektur Informasi

### 4.1 Peta situs
```
/                        Homepage  →  hero, promo, kartu mobil, seksi sales, benefit, finance, kontak
/sales/{slug}            Profil sales  →  hero sales, dokumentasi, CTA, katalog ringkas
/pricelist               Pricelist
/proses-kredit           Syarat kredit
/simulasi-kredit         Simulasi
/tes-drive               Booking tes drive
/portofolio              Portofolio
/kontak                  Kontak
/product/{10 slug}       Detail mobil
/admin                   Panel Filament
   ├─ Sales (CRUD)                     [admin]
   ├─ My Profile                       [sales]
   ├─ My Documents                     [sales]
   └─ Users                            [admin]
```

### 4.2 Hierarki homepage setelah perubahan
1. Hero (sampul) — tidak berubah
2. Promo (Swiper) — tidak berubah
3. **Seksi "Sales Kami"** — kartu sales dari DB *(pengganti blok Rukman Fadli yang hardcoded)*
4. Kartu mobil + tab kategori — tidak berubah
5. Galeri dealer — tidak berubah
6. Benefit — tidak berubah
7. Partner finance — tidak berubah
8. Kontak dealer (default) — dari `config/site.php`, fallback

---

## 5. Desain Layar

### 5.1 `/sales/{slug}` — Halaman sales (halaman terpenting)

**Tujuan:** pengunjung langsung tahu ini sales siapa dan bisa menghubungi dalam 1 ketuk.

**Mobile (360–767px), urutan atas→bawah:**
1. Breadcrumb kecil: `Beranda / Sales / {Nama}`
2. Foto profil — rasio 1:1, maks 220px, terpusat, radius 16px, ring brand tipis
3. Nama — Display, 800
4. Jabatan — 16px, muted, mis. "Profesional Sales Consultant"
5. Badge kecil: "Sales Resmi Hyundai Makassar" (pill, latar `--brand-light` 10%)
6. Dua tombol full-width: **WhatsApp** (latar `#25D366`, putih) dan **Telepon** (outline brand). Tinggi 48px minimum (target sentuh).
7. Bio — maks 3 baris, "Selengkapnya" bila lebih
8. Poin layanan (bullet, dari data lama: tukar tambah, chat 24 jam, konsultasi dealer, survey s.d. approval) — ikon centang brand
9. **Dokumentasi** — judul + grid foto; caption pada hover/di bawah; klik → lightbox
10. **Pricelist ringkas** — CTA ke `/pricelist`
11. Footer

**Sticky action bar (mobile):** muncul setelah hero lewat scroll; dua tombol WA/Telp; `position: fixed; bottom: 0`; tinggi 64px; aman untuk safe-area iPhone (`env(safe-area-inset-bottom)`). **Jangan** tumpuk di atas footer.

**Desktop (≥992px):**
- Dua kolom: kiri (42%) foto + badge + kontak; kanan (58%) nama, jabatan, bio, poin layanan, CTA inline.
- Dokumentasi full-width di bawah, grid 3–4 kolom.
- Sticky action bar **tidak** dipakai; CTA inline di kolom kanan.

**Empty state:**
- Tanpa foto → Avatar Fallback (inisial di lingkaran brand), nama tetap Display.
- Tanpa dokumentasi → Empty State: ikon gambar, "Belum ada dokumentasi", satu kalimat.
- Tanpa WA & telp → sembunyikan baris tombol, tampilkan "Hubungi melalui dealer" + tautan `/kontak`.

### 5.2 Seksi "Sales Kami" di homepage

- Judul: "Tim Sales Kami" + subjudul satu baris.
- Grid: 2 kolom (≥576px), 3 (≥768px), 4 (≥1200px). Gap 16–24px.
- **Sales Card** isi: foto (1:1, cover), nama (H3), jabatan (caption), tombol kecil "Hubungi" + "Lihat Profil" (seluruh kartu dapat diklik, tombol sebagai affordance).
- Hover: naik 2px + `shadow-hover`; fokus keyboard setara.
- Bila 1 sales: tampil sebagai kartu hero lebar (gaya blok lama, tetap rapi).
- Bila 0 sales: seksi tidak dirender (atau fallback kontak dealer) — **tanpa** judul menggantung.

### 5.3 Panel admin (Filament)

- Panel di `/admin`, dibranding: logo Hyundai, warna primer `--brand`.
- **Sales resource (admin):** tabel dengan kolom Foto (thumbnail), Nama, Slug, Kontak, Status (badge hijau/abu), Urutan. Filter: aktif/nonaktif. Pencarian: nama/slug. Aksi baris: Edit, Aktifkan/Nonaktifkan, Hapus. Aksi massal: aktifkan, nonaktifkan, hapus.
- **Form sales:** grup — `Identitas` (nama, jabatan, slug, bio, foto), `Kontak` (WA, telp, email), `Publikasi` (aktif, urutan), `Akun` (tautan user).
- **Dokumentasi:** repeater/file upload dengan drag urut, caption inline, pratinjau.
- **Panel sales:** hanya "Profil Saya" (tanpa slug/status/akun) + "Dokumentasi Saya".
- Densitas tabel: nyaman, bukan padat; baris 56px.

---

## 6. Aturan Responsif

| Breakpoint | Lebar | Perubahan kunci |
|---|---|---|
| xs | <576 | 1 kolom; sticky action bar; nav collapse |
| sm | ≥576 | Sales card 2 kolom; form 1 kolom |
| md | ≥768 | Sales card 3 kolom; dokumentasi 3 kolom |
| lg | ≥992 | Halaman sales 2 kolom; CTA inline; dokumentasi 4 kolom |
| xl | ≥1200 | Sales card 4 kolom; maks konten 1140px |

**Wajib:** `overflow-x: hidden` pada body sudah ada; pastikan tidak ada elemen `position: fixed` yang melebihi viewport. Uji pada 360px tanpa scroll horizontal.

---

## 7. Aksesibilitas

- Kontras minimum 4.5:1 untuk teks normal. `--brand` di atas putih = 8.6:1 (aman). Teks putih di atas `#25D366` = 2.1:1 → **gunakan teks putih tebal + ikon**, atau gelapkan latar WA ke `#1da851` (4.5:1) untuk teks kecil.
- Semua foto memiliki `alt` bermakna ("Foto Rukman Fadli, Sales Consultant Hyundai Makassar").
- Tombol ikon saja wajib `aria-label`.
- Lightbox: `role="dialog"`, `aria-modal`, fokus terperangkap, Esc menutup.
- Target sentuh minimum 44×44px.
- Jangan sampaikan status hanya lewat warna (badge aktif: warna + teks).
- Hormati `prefers-reduced-motion` untuk animasi hover/scroll.

---

## 8. Mikro-interaksi & Motion

| Interaksi | Durasi | Easing |
|---|---|---|
| Hover kartu (naik + shadow) | 180ms | ease-out |
| Fokus outline | instan | — |
| Lightbox buka | 200ms fade+scale(0.98→1) | ease-out |
| Sticky bar muncul | 200ms slide-up | ease-out |
| Transisi slide Swiper | default Swiper | — |

Jangan menganimasikan lebih dari satu properti berat sekaligus. Hormati `prefers-reduced-motion`.

---

## 9. Deliverable Desain

1. Token terdefinisi di `app.css` (bukan file baru) — nama variabel stabil.
2. Komponen baru sebagai kelas CSS semantik di `app.css` (bukan inline style).
3. Blade tanpa `style="..."` inline; variasi lewat modifier class.
4. Swiper/lightbox: JS kecil, tanpa dependency baru bila memungkinkan; Bootstrap sudah menyediakan modal untuk lightbox.
5. Semua gambar pengguna lewat storage disk `public` (`Storage::url()`), dengan fallback jelas.
6. Placeholder untuk semua state kosong.

---

## 10. Kriteria Penerimaan Desain

1. Halaman `/sales/{slug}` dapat dipakai satu tangan di 360px; tombol WA tercapai ≤1 scroll.
2. Tidak ada layout bergeser (CLS) saat foto lambat dimuat → tetapkan `width`/`height` atau rasio aspek.
3. Semua state kosong punya desain (foto, dokumentasi, kontak, daftar sales).
4. Tidak ada elemen yang menutupi konten saat sticky bar aktif.
5. Konsisten: tidak ada warna/radius/font baru di luar token.
6. Panel admin dapat menangani 100 baris tanpa tampak sesak.
7. Semua teks bahasa Indonesia, nada profesional dan ramah.
