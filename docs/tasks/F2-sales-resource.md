# SPEC F2 — Filament Resource: CRUD Sales (Admin)

**Fase:** F2
**Prasyarat:** F1 selesai (tabel `sales` + `sales_documents`, model `Sales`, `SalesDocument`, `User.role` ada).

Referensi: `docs/prd.md §4 FR-2`, `docs/design.md §5.3`, `docs/arsitektur.md §5`.

## Tujuan

Admin dapat mengelola sales dari panel Filament: lihat daftar, cari, filter, buat, edit, aktif/nonaktifkan, dan hapus.

Catatan fase ini: **belum** ada pembatasan role (itu F3). Resource ini diasumsikan dipakai admin. Jangan menambahkan policy di fase ini.

## 1. Buat Resource

```bash
php artisan make:filament-resource Sales --generate
php artisan make:filament-resource SalesDocument --generate
```

Atau buat manual bila generator gagal. Yang penting strukturnya benar untuk Filament 5.

## 2. SalesResource

### Form (`SalesForm` atau `form()`)
Grup/Seksi:

**Identitas**
- `name` — TextInput, `required`, `maxLength(255)`, label "Nama Lengkap"
- `title` — TextInput, label "Jabatan", placeholder "mis. Profesional Sales Consultant"
- `slug` — TextInput, `required`, `unique(ignoreRecord: true)`, `regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/`
  - `->live(onBlur: true)` dan auto-isi dari `name` saat `create` bila slug kosong (setelah nama diisi). Gunakan `Str::slug()`.
  - Helper text: "URL halaman: /sales/{slug}"
- `bio` — Textarea, `rows(4)`, `maxLength(1000)`
- `photo_path` — FileUpload: `->image()`, `->disk('public')`, `->directory('sales/photos')`, `->imageEditor()`, `->maxSize(4096)`, `->acceptedFileTypes(['image/jpeg','image/png','image/webp'])`

**Kontak**
- `whatsapp` — TextInput, label "Nomor WhatsApp", placeholder "08xx atau 628xx", `maxLength(20)`
- `phone` — TextInput, label "Telepon"
- `email` — TextInput `->email()`

**Publikasi**
- `is_active` — Toggle, default true, label "Aktif (tampil di publik)"
- `sort_order` — TextInput `->numeric()->default(0)`, label "Urutan Tampil"

**Akun**
- `user_id` — Select, `->relationship('user','email')`, `->searchable()->preload()`, nullable, label "Akun Login"

### Tabel
Kolom:
- `photo_path` — ImageColumn, disk `public`, circular, ukuran 40
- `name` — searchable, sortable, weight bold
- `slug` — copyable, `->toggleable()`
- `whatsapp` — label "WhatsApp", searchable
- `is_active` — IconColumn boolean (hijau/abu) + `->sortable()`
- `sort_order` — sortable, `->toggleable()`

Filter:
- `is_active` — `SelectFilter` dengan opsi "Aktif"/"Nonaktif"

Aksi baris (default generator: Edit, Delete). Tambah aksi kustom:
- "Aktifkan"/"Nonaktifkan" — toggle `is_active`, dengan notifikasi sukses.

Aksi massal (BulkAction):
- "Aktifkan semua"
- "Nonaktifkan semua"
- Delete (default)

Urutan default: `sort_order` asc, lalu `name` asc.

## 3. SalesDocumentResource

- `sales_id` — Select `->relationship('sales','name')->searchable()->preload()`, `required`
- `file_path` — FileUpload: `->image()`, `->disk('public')`, `->directory('sales/documents')`, `->maxSize(4096)`, `->acceptedFileTypes([...])`, `->required()`
- `caption` — TextInput
- `sort_order` — TextInput numeric

Tabel: gambar (40px), sales.name, caption, sort_order.

## 4. Navigasi

- SalesResource: kelompok "Konten", ikon `heroicon-o-user-group`, label "Sales", singular "Sales"
- SalesDocumentResource: kelompok "Konten", ikon `heroicon-o-photo`, label "Dokumentasi"

## 5. Larangan

- JANGAN mengubah `routes/web.php`.
- JANGAN menyentuh blade publik (`resources/views/**`).
- JANGAN membuat policy / pembatasan role (itu F3).
- JANGAN menambah dependency.
- JANGAN mengubah data mobil (`config/cars.php`).

## 6. Kriteria Selesai (jalankan, laporkan hasil)

```bash
php artisan route:list | grep -i "admin/sales"      # rute resource ada
php artisan view:cache                              # tanpa error
curl -s -o /dev/null -w "%{http_code}\n" http://127.0.0.1:8000/admin/sales   # 302 (belum login) atau 200
```

Tambahan (bila bisa): verifikasi resource dapat di-resolve tanpa error:
```bash
php artisan tinker --execute="echo class_exists(\App\Filament\Resources\SalesResource::class)?'OK':'MISSING';"
```
(sesuaikan namespace dengan apa yang dihasilkan generator)

## 7. Laporan yang diminta

1. Daftar file dibuat/diubah.
2. Keluaran perintah verifikasi.
3. Nama kelas + namespace yang dihasilkan.
4. Kendala apa pun.
