# Arsitektur — Hyundai Dealer Makassar (Multi-Sales)

**Tanggal:** 2026-09-16
**Stack:** Laravel 13.32 · Filament 5.8 · PHP 8.5 · SQLite · Vite 5 · Bootstrap 5 (CDN)

---

## 1. Gambaran Sistem

```
┌──────────────────────────────────────────────────────────────┐
│                        Browser                               │
│   Pengunjung           Sales                Admin            │
└───────┬─────────────────┬───────────────────┬────────────────┘
        │                 │                   │
        │ HTTP            │ /admin (login)    │ /admin
        ▼                 ▼                   ▼
┌──────────────────────────────────────────────────────────────┐
│                    Laravel 13 (app)                          │
│                                                              │
│  routes/web.php ──► Controller (existing, publik)            │
│                  └► SalesPageController  /sales/{slug}       │
│                                                              │
│  Filament Panel  /admin                                      │
│    ├─ Resources: SalesResource (admin, full)                 │
│    ├─ MyProfile (sales, scoped)                              │
│    └─ Documents (sales, scoped)                              │
│                                                              │
│  Policies + Global Scopes  ◄── otorisasi berlapis            │
│  Blade views (layouts/app + header/footer)                   │
│  app.css (token --brand) ◄── Vite build                      │
└───────────┬──────────────────────────┬───────────────────────┘
            │ Eloquent                 │ Storage disk 'public'
            ▼                          ▼
     ┌─────────────┐          ┌─────────────────────────┐
     │   SQLite    │          │ storage/app/public/     │
     │ users       │          │   sales/{id}/photo.jpg  │
     │ sales       │          │   sales/{id}/documents/ │
     │ sales_docs  │          └──────────┬──────────────┘
     └─────────────┘                     │ symlink
                                    public/storage
```

---

## 2. Lapisan & Tanggung Jawab

| Lapisan | Isi | Aturan |
|---|---|---|
| **Routing** | `routes/web.php` | Rute lama **tidak diubah**; hanya penambahan `/sales/{slug}`. Rute `/admin` disediakan Filament. |
| **Controller** | `Controller.php` (publik, existing), `SalesPageController` (baru) | Controller tetap tipis: ambil data → kirim ke view. Logika bisnis di model/service. |
| **Model** | `User`, `Sales`, `SalesDocument` | Relasi eksplisit, casts, scopes (`active()`, `ordered()`). |
| **Otorisasi** | Policies + Global Scope | **Dua lapis**: scope menyaring query, policy mencegah aksi. |
| **Panel** | Filament 5 Resources/Pages | Admin: CRUD penuh. Sales: halaman "Profil Saya" + "Dokumentasi Saya". |
| **View publik** | Blade + `app.css` | Tanpa inline style; data dari DB, bukan hardcoded. |
| **Storage** | Disk `public` | Semua file pengguna; hapus file saat record dihapus. |

---

## 3. Struktur Direktori (target)

```
app/
├── Filament/
│   ├── Resources/
│   │   ├── SalesResource.php
│   │   │   └── Pages/{ListSales,CreateSales,EditSales}.php
│   │   └── SalesDocumentResource.php        (opsional, admin)
│   ├── Pages/
│   │   └── MyProfile.php                    (sales)
│   └── Widgets/                             (stats admin, opsional)
├── Http/Controllers/
│   ├── Controller.php                       (existing — jangan ubah nama method)
│   └── SalesPageController.php              (baru)
├── Models/
│   ├── User.php                             (+role, +sales())
│   ├── Sales.php                            (baru)
│   └── SalesDocument.php                    (baru)
├── Policies/
│   └── SalesPolicy.php                      (baru)
└── Providers/Filament/
    └── AdminPanelProvider.php               (dari filament:install)

database/
├── migrations/
│   ├── ..._add_role_to_users_table.php
│   ├── ..._create_sales_table.php
│   └── ..._create_sales_documents_table.php
└── seeders/
    ├── DatabaseSeeder.php
    └── SalesSeeder.php                      (data Rukman Fadli)

resources/views/
├── layouts/app.blade.php
├── header.blade.php / footer.blade.php
├── homepage/{home,card,benefit}.blade.php
├── pages/*.blade.php
├── product/show.blade.php
└── sales/show.blade.php                     (baru)

config/
├── cars.php                                 (katalog mobil — sumber tunggal)
└── site.php                                 (kontak dealer default/fallback)

docs/                                        (PRD, design, arsitektur, todo, workflow)
```

---

## 4. Model Data & Relasi

```
User 1 ──── 0..1 Sales 1 ──── * SalesDocument
 │                │
 │ role           │ slug (URL unik)
 │ admin|sales    │ is_active, sort_order, softDeletes
 │                │ photo_path, whatsapp, phone, email
```

**Aturan integritas:**
- `sales.user_id` → `users.id`, `unique`, `nullable`, `nullOnDelete` (sales tetap ada walau akun dihapus).
- `sales_documents.sales_id` → `sales.id`, `cascadeOnDelete`.
- `sales.slug` → `unique`; validasi regex `^[a-z0-9]+(?:-[a-z0-9]+)*$`.
- Soft delete pada `sales` agar URL lama dapat dipulihkan dan file tidak langsung hilang.

**Index penting:**
- `sales.slug` (unique) — lookup URL.
- `sales.is_active, sales.sort_order` — query homepage.
- `sales.user_id` (unique) — lookup profil sendiri.
- `sales_documents.sales_id, sort_order` — galeri.

---

## 5. Otorisasi (dua lapis)

**Lapis 1 — Global Scope / query scope:**
`Sales::active()` untuk halaman publik. Untuk panel sales, query dibatasi `where('user_id', auth()->id())`.

**Lapis 2 — Policy (`SalesPolicy`):**

| Aksi | Admin | Sales | Pengunjung |
|---|---|---|---|
| `viewAny` | ✅ | ❌ | ❌ |
| `view` (record apa pun) | ✅ | hanya miliknya | ❌ |
| `create` | ✅ | ❌ | ❌ |
| `update` | ✅ (semua field) | hanya miliknya (field terbatas) | ❌ |
| `delete` | ✅ | ❌ | ❌ |
| `restore`/`forceDelete` | ✅ | ❌ | ❌ |
| Halaman publik `/sales/{slug}` | publik, hanya `is_active` | — | ✅ |

**Aturan penting:** menyembunyikan tombol di UI **bukan** otorisasi. Setiap aksi Filament harus melewati policy. Ada test khusus yang mencoba akses silang antar-sales dan **harus** mengembalikan 403.

---

## 6. Alur Permintaan Utama

### 6.1 Pengunjung membuka `/sales/{slug}`
```
Route → SalesPageController@show($slug)
  → Sales::active()->where('slug',$slug)->with('documents')->firstOrFail()
  → 404 bila tidak ada / nonaktif
  → view('sales.show', ['sales' => $sales])
  → render: foto (Storage::url) / fallback avatar, WA (normalisasi 62), telp, dokumentasi grid
```

### 6.2 Sales login & edit profil
```
/auth (Filament) → cek role → panel menu "Profil Saya"
  → Filament Page dengan form
  → query selalu dibatasi user_id = auth()->id()
  → simpan: update Sales milik sendiri; slug & is_active TIDAK ada di form
  → upload foto → Storage disk public → simpan photo_path (hapus file lama)
```

### 6.3 Admin mengelola sales
```
/admin/sales → SalesResource
  → tabel: foto, nama, slug, kontak, status, urutan (+filter, search, bulk)
  → form: Identitas / Kontak / Publikasi / Akun
  → hapus dokumentasi → hapus row + Storage::delete(file)
  → nonaktifkan → is_active=false → halaman publik jadi 404
```

### 6.4 Homepage menampilkan sales
```
Route / → view homepage/home
  → Sales::active()->ordered()->get()   (eager: documents tidak perlu di sini)
  → blade: @forelse sales → sales-card component
  → @empty → seksi tidak dirender / fallback kontak dealer
```

---

## 7. Storage & Media

- Disk: `public` (`storage/app/public`), symlink `public/storage` via `php artisan storage:link`.
- Struktur: `sales/{sales_id}/photo.{ext}`, `sales/{sales_id}/documents/{ulid}.{ext}`.
- Nama file unik (ULID) → menghindari tabrakan & path traversal.
- Validasi: `image|mimes:jpg,jpeg,png,webp|max:4096` (4 MB), dimensi maksimum (mis. 4000px) untuk foto profil.
- Pembersihan: pada `deleting`/`forceDeleting` record → hapus file terkait di observer/model event.
- Penyajian: `Storage::disk('public')->url($path)`; **jangan** simpan URL absolut di DB (hanya path relatif).

---

## 8. Frontend & Build

- `@vite(['resources/css/app.css','resources/js/app.js'])` di layout.
- Bootstrap 5 + Swiper 11 + Bootstrap Icons tetap CDN (tidak dibundel).
- Semua style baru → `app.css` (token `--brand`), tanpa inline `style`.
- JS baru minimal; lightbox memakai modal Bootstrap yang sudah tersedia.
- Build: `npm run build` harus sukses (manifest dipakai di produksi).

---

## 9. Konfigurasi & Environment

| Variabel | Sumber | Catatan |
|---|---|---|
| `DB_CONNECTION` | `.env` = sqlite | Untuk produksi, pertimbangkan MySQL/Postgres (lihat §11) |
| `SITE_CONTACT_*` | `.env` | Kontak dealer default/fallback |
| `FILESYSTEM_DISK` | `.env` | `public` untuk upload |
| Katalog mobil | `config/cars.php` | **Statis** (10 mobil, spek 48 nilai) — tidak masuk DB fase ini |
| Kontak sales | tabel `sales` | Sumber utama untuk halaman sales |

**Pemisahan tegas:** katalog mobil = konfigurasi; data sales = database. Jangan campur.

---

## 10. Risiko Arsitektur & Mitigasi

| Risiko | Mitigasi |
|---|---|
| Kebocoran data antar-sales | Policy + scoped query + test akses silang (403) |
| N+1 pada tabel admin | `withCount`/eager load; review dengan `DB::listen` |
| File yatim menumpuk | Hapus file pada event model; perintah `sales:clean-orphans` (opsional) |
| Slug berubah → tautan lama mati | Slug hanya diubah admin; simpan `slug_history` bila diperlukan (fase lanjut) |
| SQLite tidak cocok untuk tulis bersamaan | Fase produksi: pindah MySQL/Postgres (perubahan `config/database.php` + migrasi ulang) |
| Data sales masih di blade setelah refactor | Checklist: `grep -rn "Rukman\|0896" resources/views/` harus kosong |

---

## 11. Jalan Keluar Skala (fase lanjut, bukan sekarang)

1. **Subdomain per sales** (`nama.domain.com`): wildcard DNS + SSL; routing berbasis host. Tidak diubah sekarang agar tetap murah.
2. **Migrasi DB** ke MySQL/Postgres saat sales > 100 atau trafik tulis naik.
3. **Cache** halaman publik (`Cache::remember` per slug, invalidasi pada save).
4. **Queue** untuk pemrosesan gambar (Thumbnail, WebP) bila upload ramai.
5. **Multi-tenant penuh** dengan isolasi basis data — hanya bila ada kebutuhan bisnis nyata.

---

## 12. Keputusan Arsitektur (ADR ringkas)

| # | Keputusan | Alasan | Konsekuensi |
|---|---|---|---|
| ADR-1 | Path-based `/sales/{slug}`, bukan subdomain | Murah, tanpa DNS/SSL tambahan, cukup untuk fase ini | URL kurang "branded" per sales |
| ADR-2 | Filament 5 sebagai panel | Auth, CRUD, upload, policy sudah jadi | Butuh `ext-intl`, menambah dependency |
| ADR-3 | Role kolom di `users`, bukan paket permission | Hanya 2 peran | Perlu paket bila peran bertambah granular |
| ADR-4 | Katalog mobil tetap di `config/cars.php` | Tidak berubah per sales; menghindari migrasi besar | Sales tidak bisa ubah harga (memang diinginkan) |
| ADR-5 | Soft delete pada `sales` | URL lama bisa dipulihkan; audit | Query publik wajib `active()` + default scope benar |
| ADR-6 | Otorisasi dua lapis (scope + policy) | Mencegah kebocoran data | Sedikit duplikasi logika, diterima demi keamanan |
| ADR-7 | Storage disk `public` + symlink | Sederhana, cukup untuk skala ini | Tidak cocok untuk multi-server tanpa S3 (fase lanjut) |
| ADR-8 | Laravel 13 (bukan 11/12) | Laravel 11 diblokir security advisory; 13 runway terpanjang; Filament 5 mendukung | Ekosistem pihak ketiga yang belum update mungkin terhambat |
