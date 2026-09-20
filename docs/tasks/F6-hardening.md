# SPEC F6 — Kualitas, Hardening & Verifikasi Akhir

**Fase:** F6 (penutup)
**Prasyarat:** F5 selesai.

Referensi: `docs/prd.md §5` (NFR), `docs/design.md §7/§10`, `docs/todo.md F6`.

## Tujuan

Memastikan fitur stabil, aman, responsif, dan terdokumentasi. Tidak ada fitur baru di fase ini kecuali perbaikan yang dibutuhkan untuk memenuhi NFR.

## 1. Performa (NFR-1)

- Periksa N+1 pada: tabel admin sales, tabel dokumentasi, homepage, halaman `/sales/{slug}`.
- Aktifkan query log sementara dan laporkan jumlah query untuk tiap halaman.
- Perbaiki dengan eager loading (`with()`, `withCount()`) bila ditemukan.

## 2. Keamanan (NFR-2, NFR-3)

- Pastikan validasi input lengkap: `slug` regex, email format, panjang maksimum.
- Pastikan otorisasi ditegakkan di server (policy + scope) — verifikasi ulang setelah perubahan F5.
- Cek: sales A tidak dapat mengakses `/admin/sales/{id B}` → 403.
- Cek: tidak ada path traversal pada `file_path` yang dapat dimanipulasi pengguna.
- Cek: unggahan hanya menerima gambar (uji dengan file non-gambar bila memungkinkan).

## 3. Aksesibilitas (NFR-5)

- Semua `<img>` punya `alt`.
- Semua tombol ikon punya `aria-label`.
- Kontras teks tombol WhatsApp memadai (lihat catatan `docs/design.md §7`).
- Lightbox: `role="dialog"`, `aria-modal`, dapat ditutup dengan Esc.
- Fokus terlihat pada semua elemen interaktif.

## 4. Responsif (NFR-7)

- Uji `/sales/{slug}` pada 360px, 768px, 1280px.
- Pastikan tidak ada overflow horizontal.
- Pastikan sticky action bar tidak menutupi konten/footer.

## 5. Test Tambahan (WAJIB)

Tambahkan test yang belum ada:

1. `test_public_sales_page_returns_404_for_unknown_slug`
2. `test_public_sales_page_returns_404_for_inactive_sales`
3. `test_public_sales_page_loads_for_active_sales`
4. `test_sales_without_photo_renders_fallback_avatar`
5. `test_homepage_does_not_error_with_empty_sales_table`
6. `test_whatsapp_link_normalizes_various_formats` (unit test normalisasi)

Semua test harus hijau.

## 6. Pembersihan

- Hapus sisa data uji yang tidak perlu (record sales/dokumentasi dummy dari pengujian manual).
- Pastikan **data Rukman Fadli tetap ada** (jangan terhapus).
- Pastikan tidak ada file debug/temporary tertinggal di repo (`git status` bersih dari sampah).
- Pastikan `.hermes-redesign-task.md` dan berkas kerja orkestrator **tidak** ikut ter-commit.

## 7. Dokumentasi

- Perbarui `docs/todo.md`: tandai F0–F6 selesai.
- Perbarui note Obsidian `Hermes/Projects/hyundaimks.md`: bagian TODO + Log (tanggal, apa yang berubah, hasil verifikasi, sisa masalah).
- Salin ulang dokumen ke `Hermes/Projects/hyundaimks-docs/` bila berubah.
- Perbarui `docs/prd.md §11` bila ada pertanyaan terbuka yang sudah terjawab.

## 8. Larangan

- JANGAN menambah fitur baru di luar perbaikan NFR.
- JANGAN mengubah `config/cars.php` / halaman produk.
- JANGAN menambah dependency.

## 9. Kriteria Selesai (jalankan SEMUA, laporkan keluaran)

```bash
php artisan test                                   # semua hijau
php artisan view:cache
npm run build

# Regresi penuh
for r in / /pricelist /proses-kredit /simulasi-kredit /tes-drive /portofolio /kontak \
         /product/stargazer /product/creta /product/stargazer-x /product/hyundai-kona \
         /product/santa-fe /product/staria /product/ioniq-5 /product/palisade \
         /product/ioniq-6 /product/all-new-santa-fe /sales/rukman-fadli; do
  printf "%-28s %s\n" "$r" "$(curl -s -o /dev/null -w '%{http_code}' http://127.0.0.1:8000$r)"
done

printf "%-28s %s\n" "/admin" "$(curl -s -o /dev/null -w '%{http_code}' http://127.0.0.1:8000/admin)"
printf "%-28s %s\n" "/sales/tidak-ada" "$(curl -s -o /dev/null -w '%{http_code}' http://127.0.0.1:8000/sales/tidak-ada)"
```

## 10. Laporan yang diminta

1. Hasil semua test.
2. Hasil regresi rute.
3. Jumlah query per halaman utama (bukti audit N+1).
4. Daftar perbaikan yang dilakukan.
5. Sisa masalah/limitasi yang diketahui.
