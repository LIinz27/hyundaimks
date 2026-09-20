# SPEC F1 — Model & Migrasi Data Sales

**Fase:** F1
**Prasyarat:** F0 selesai (panel Filament hidup di `/admin`).

Referensi lengkap: `docs/prd.md §6`, `docs/arsitektur.md §4`.

## Tujuan

Membuat struktur data untuk sales dan dokumentasi, plus memindahkan data sales yang saat ini hardcoded (Rukman Fadli) ke database.

## 1. Migrasi

### 1a. `add_role_to_users_table`
- Tambah kolom `role` (string, default `'sales'`), index.
- Posisi: setelah `password` (bila memungkinkan).

### 1b. `create_sales_table`
```
id                    bigint PK
user_id               foreignId → users.id, nullable, unique, nullOnDelete
slug                  string, unique
name                  string
title                 string, nullable      -- jabatan
bio                   text, nullable
photo_path            string, nullable
whatsapp              string, nullable
phone                 string, nullable
email                 string, nullable
is_active             boolean, default true
sort_order            integer, default 0
timestamps
softDeletes
index (is_active, sort_order)
```

### 1c. `create_sales_documents_table`
```
id         bigint PK
sales_id   foreignId → sales.id, cascadeOnDelete
file_path  string
caption    string, nullable
sort_order integer, default 0
timestamps
index (sales_id, sort_order)
```

## 2. Model

### `app/Models/Sales.php`
- `$fillable`: slug, name, title, bio, photo_path, whatsapp, phone, email, is_active, sort_order, user_id
- `$casts`: `is_active => bool`, `sort_order => int`
- Relasi: `user(): BelongsTo`, `documents(): HasMany(SalesDocument::class)->orderBy('sort_order')`
- Scope: `scopeActive($q)` → `where('is_active', true)`
- Scope: `scopeOrdered($q)` → `orderBy('sort_order')->orderBy('name')`
- Accessor bantu: `whatsappLink()` (normalisasi ke `628xx`) dan `phoneLink()` → mengembalikan URL `wa.me` / `tel:`
  - Normalisasi: buang semua karakter non-digit; bila diawali `0` → ganti jadi `62`; bila diawali `62` → biarkan; bila diawali `8` → tambah `62`.
  - Contoh: `0896-1688-0688` → `6289616880688`; `+62 896 1688 0688` → `6289616880688`.
- `getRouteKeyName()` → `slug`

### `app/Models/SalesDocument.php`
- `$fillable`: sales_id, file_path, caption, sort_order
- Relasi: `sales(): BelongsTo`

### `app/Models/User.php` (ubah)
- Tambah `role` ke `$fillable`.
- Relasi: `sales(): HasOne(Sales::class)`
- Helper: `isAdmin(): bool` → `$this->role === 'admin'`

## 3. Seeder

### `database/seeders/SalesSeeder.php`
Data lama ada di `resources/views/homepage/home.blade.php`. Baca file itu untuk mengambil data akurat:
- Nama sales (Rukman Fadli)
- Deskripsi/poin layanan yang disebutkan
- Nomor WhatsApp: `0896-1688-0688`
- Jabatan bila disebutkan

Aturan seeder:
- `slug` = `rukman-fadli`
- `is_active` = true, `sort_order` = 0
- `whatsapp` = `0896-1688-0688` (format asli; normalisasi dilakukan oleh accessor)
- Jalankan dengan `firstOrCreate` berdasarkan slug agar idempoten (aman dijalankan ulang).
- Daftarkan di `DatabaseSeeder` (`$this->call(SalesSeeder::class)`).
- JANGAN mengarang nomor/email/jabatan yang tidak ada di sumber. Bila tidak ada, `null`.

## 4. Larangan

- JANGAN mengubah `routes/web.php`.
- JANGAN menyentuh blade apa pun (itu F4).
- JANGAN membuat Filament Resource (itu F2).
- JANGAN menambah dependency.
- JANGAN menghapus/mengubah data pada tabel lain.

## 5. Kriteria Selesai (jalankan dan laporkan hasilnya)

```bash
php artisan migrate                                        # sukses, tanpa error
php artisan db:seed --class=SalesSeeder                    # sukses
php artisan tinker --execute="echo \App\Models\Sales::first()->toJson();"
php artisan tinker --execute="echo \App\Models\Sales::first()->whatsappLink();"   # harus 6289616880688
php artisan view:cache                                     # tanpa error
```

Opsional: `php artisan test` (bila ada test).

## 6. Laporan yang diminta

1. Daftar file dibuat/diubah.
2. Keluaran perintah verifikasi.
3. Isi record Sales pertama (JSON).
4. Konfirmasi bahwa data yang di-seed berasal dari sumber nyata (bukan karangan).
