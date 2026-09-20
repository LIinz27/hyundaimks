# SPEC G4 — Panel Sales: Kelola Profil & Galeri Sendiri

**Fase:** G4
**Prasyarat:** G3 selesai (halaman lama sudah dibongkar).

## Tujuan

Memastikan sales **tidak perlu admin** untuk mengurus dirinya sendiri: ganti foto profil,
ubah kontak/bio, dan kelola galeri dokumentasinya. Ini sebagian besar sudah ada sejak
F2/F3/F5 — fase ini **memverifikasi, merapikan, dan menutup celah**, bukan membangun baru.

## 1. Yang sudah ada (verifikasi, jangan bongkar)

| Fitur | Lokasi | Status |
|---|---|---|
| Halaman "Profil Saya" | `app/Filament/Pages/MyProfile.php` | ada sejak F3 |
| Whitelist field profil | `save()` → `->only([...])` | ada sejak F3 |
| Resource dokumentasi | `app/Filament/Resources/SalesDocuments/` | ada sejak F2 |
| Upload + pembersihan file | Model event F5 | ada sejak F5 |
| Scoping query | `getEloquentQuery()` F3 | ada sejak F3 |

**JANGAN menulis ulang yang sudah jalan.** Verifikasi dulu, perbaiki hanya yang bocor.

## 2. Yang perlu dipastikan bekerja

### 2.1 Sales hanya melihat dokumentasi miliknya
`SalesDocumentResource::getEloquentQuery()` harus menyaring:
```
bukan admin → whereHas('sales', fn($q) => $q->where('user_id', auth()->id()))
```
Kalau belum ada, tambahkan. Kalau ada, buktikan dengan test.

### 2.2 Sales tidak bisa mengaitkan dokumen ke sales lain
Form dokumentasi: pemilihan `sales_id` harus **hanya untuk admin**. Sales mendapat
field tersembunyi/auto-set ke sales miliknya, dan di server-side di-`only()`.

### 2.3 Sales tidak bisa mengubah field terlarang
Field yang HARUS tidak bisa diubah sales (verifikasi ulang, sudah ada test F3):
`slug`, `is_active`, `sort_order`, `user_id`.

### 2.4 Navigasi panel sesuai peran
- Sales melihat: "Profil Saya", "Dokumentasi Saya"
- Admin melihat: "Sales", "Dokumentasi", "Profil Saya" (punya admin sendiri?)
- Sales **tidak** melihat menu "Sales" (daftar sales)

## 3. Test (WAJIB)

Buat/perluas `tests/Feature/SalesPanelTest.php`:

1. `sales_sees_own_profile_page`
2. `sales_cannot_see_sales_resource` — akses `/admin/sales` → 403
3. `sales_sees_only_own_documents` — buat 2 sales, masing-masing 1 dokumen; sales A
   hanya melihat 1
4. `sales_cannot_attach_document_to_other_sales` — percobaan set `sales_id` sales lain
   → dokumen tetap miliknya / ditolak
5. `sales_cannot_change_slug`  (sudah ada di F3 — pastikan tetap hijau)
6. `sales_can_upload_own_document` — unggah file → tersimpan di disk miliknya

## 4. Larangan

- JANGAN mengubah algoritma scoping F3 yang sudah teruji.
- JANGAN memberi sales akses ke daftar sales.
- JANGAN menambah dependency.
- JANGAN mengubah halaman publik.

## 5. Kriteria Selesai (jalankan, laporkan SEMUA keluaran)

```bash
php artisan test --filter=SalesPanelTest
php artisan test
php artisan view:cache

# Bukti scoping
php artisan tinker --execute="..."   # demo: sales A hanya melihat dokumennya
```

Plus: buktikan dengan HTTP/panel bahwa sales membuka `/admin/sales` → 403.

## 6. Laporan yang diminta

1. Daftar file dibuat/diubah (kalau ada).
2. Keluaran semua verifikasi.
3. Bukti scoping dokumentasi antar-sales.
4. Konfirmasi field terlarang tetap tidak bisa diubah.
5. Kendala.
