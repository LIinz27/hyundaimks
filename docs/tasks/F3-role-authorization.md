# SPEC F3 — Role & Otorisasi (KRITIS)

**Fase:** F3
**Prasyarat:** F2 selesai (SalesResource + SalesDocumentResource ada).

Referensi: `docs/arsitektur.md §5` (matriks otorisasi), `docs/prd.md FR-1`, `docs/design.md §5.3`.

**Fase ini adalah fase keamanan.** Kebocoran data antar-sales tidak dapat diterima. Otorisasi harus ditegakkan di server (policy + scope), bukan sekadar menyembunyikan tombol.

## Tujuan

1. Admin dapat mengelola semua sales.
2. Sales hanya dapat melihat & mengedit datanya sendiri.
3. Sales tidak dapat mengakses data sales lain meski menebak URL.

## 1. Policy

Buat `app/Policies/SalesPolicy.php` dengan dukungan Filament 5:

- `viewAny(User $user): bool` → `$user->isAdmin()`
- `view(User $user, Sales $sales): bool` → `$user->isAdmin() || $sales->user_id === $user->id`
- `create(User $user): bool` → `$user->isAdmin()`
- `update(User $user, Sales $sales): bool` → `$user->isAdmin() || $sales->user_id === $user->id`
- `delete(User $user, Sales $sales): bool` → `$user->isAdmin()`
- `restore` / `forceDelete` → `$user->isAdmin()`

Daftarkan policy (Laravel 13 auto-discovery `App\Models\Sales` → `App\Policies\SalesPolicy` biasanya sudah otomatis; verifikasi dengan `Gate::getPolicyFor(Sales::class)`).

## 2. Pembatasan Query Panel (scope)

SalesResource harus menyaring data untuk non-admin. Di `SalesResource::getEloquentQuery()`:

```php
$query = parent::getEloquentQuery();

if (! auth()->user()?->isAdmin()) {
    $query->where('user_id', auth()->id());
}

return $query;
```

Aturan: jangan mengandalkan policy saja. **Query harus sudah tersaring**, sehingga record sales lain tidak pernah dimuat.

## 3. Panel Sales: "Profil Saya"

Buat Filament Page `app/Filament/Pages/MyProfile.php`:

- Form field: `name`, `title`, `bio`, `photo_path` (FileUpload), `whatsapp`, `phone`, `email`.
- **DILARANG ADA** di form: `slug`, `is_active`, `sort_order`, `user_id`.
- Simpan ke `Sales` milik `auth()->user()`.
- Bila user belum punya record Sales → tampilkan notifikasi/empty state, jangan error.
- Bila user adalah admin → tetap boleh (tapi admin punya SalesResource penuh).

Tambahkan juga Page "Dokumentasi Saya" (atau buat resource kedua yang dibatasi ke sales sendiri):
- Menampilkan `SalesDocument` milik sales sendiri (via `sales_id` miliknya).
- Dapat menambah/menghapus dokumentasi sendiri.
- Tidak dapat melihat dokumentasi sales lain.

## 4. Navigasi Role

- Admin melihat: Dashboard, Sales, Dokumentasi, Users (bila ada).
- Sales melihat: Profil Saya, Dokumentasi Saya. **Tidak** melihat: Sales (daftar semua), Users.
- Gunakan `->visible(fn () => auth()->user()?->isAdmin())` pada item navigasi / resource `shouldRegisterNavigation()`.

## 5. Resource Users (admin)

Bila belum ada, buat `UserResource` sederhana (admin saja) agar admin dapat membuat akun login untuk sales baru dan mengatur `role`. Resource ini harus `canAccess` hanya untuk admin.

## 6. Test Otomatis (WAJIB)

Buat `tests/Feature/SalesAuthorizationTest.php`:

1. `admin_can_view_any_sales` — admin `SalesResource::canViewAny()` true.
2. `sales_cannot_view_sales_list` — sales false.
3. `sales_can_view_own_record` — policy `view` true untuk record sendiri.
4. `sales_cannot_view_other_record` — policy `view` false untuk record sales lain.
5. `sales_cannot_delete_record` — policy `delete` false untuk dirinya sendiri.
6. `sales_cannot_update_slug_via_my_profile` — verifikasi slug tidak berubah setelah update lewat form Profil Saya.
7. `inactive_sales_not_listed_publicly` — (mungkin bagian F4, tapi boleh dimulai di sini)

Test harus menggunakan factory/model langsung (bukan HTTP-nya Filament bila rumit), tetapi untuk item 3–5 gunakan policy secara langsung.

Bila ada `SalesFactory` belum ada, buat: `php artisan make:factory SalesFactory`.

## 7. Larangan

- JANGAN mengubah `routes/web.php`.
- JANGAN menyentuh blade publik (`resources/views/**`) — kecuali benar-benar perlu (jangan di fase ini).
- JANGAN mengubah `config/cars.php`.
- JANGAN menambah dependency (gunakan Filament + Laravel bawaan).

## 8. Kriteria Selesai (jalankan, laporkan hasil)

```bash
php artisan test --filter=SalesAuthorizationTest   # semua hijau
php artisan view:cache                             # tanpa error
php artisan route:list | grep -i "admin" | head
```

Verifikasi tambahan (laporkan output):
```bash
php artisan tinker --execute="echo \Gate::getPolicyFor(\App\Models\Sales::class) ? 'POLICY_OK' : 'NO_POLICY';"
```

## 9. Laporan yang diminta

1. Daftar file dibuat/diubah.
2. Keluaran `php artisan test`.
3. Isi ringkas policy (daftar method + aturan).
4. Konfirmasi field terlarang (slug/is_active) TIDAK ada di form Profil Saya.
5. Kendala apa pun.
