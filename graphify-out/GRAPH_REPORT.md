# Graph Report - hyundaimks  (2026-09-21)

## Corpus Check
- 138 files · ~365,566 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 891 nodes · 1262 edges · 92 communities (52 shown, 11 thin omitted)
- Extraction: 97% EXTRACTED · 3% INFERRED · 0% AMBIGUOUS · INFERRED: 32 edges (avg confidence: 0.85)
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `f086443a`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- composer.json
- package.json
- Controller
- AuthenticatesWithUsername
- Illuminate\Database\Migrations\Migration
- Illuminate\Support\Str
- Filament\Schemas\Schema
- scripts.js
- Project Name: **Hyundai Dealer Makassar**
- EditSales.php
- PRD — Hyundai Dealer Makassar: Platform Multi-Sales
- SalesTable.php
- MyProfile
- logging.php
- bootstrap/app.php
- ResolveActiveSales.php
- hyundaimks
- app.blade.php
- home.blade.php
- console.php
- graphify.js
- SPEC G4 — Panel Sales: Kelola Profil & Galeri Sendiri
- Design Brief — UI/UX
- AdminPanelProvider.php
- Arsitektur — Hyundai Dealer Makassar (Multi-Sales)
- SPEC F1 — Model & Migrasi Data Sales
- SPEC F0 — Inisialisasi Panel Filament
- opencode.json
- Workflow — Cara Kerja Proyek Ini
- SPEC F6 — Kualitas, Hardening & Verifikasi Akhir
- SPEC F2 — Filament Resource: CRUD Sales (Admin)
- SPEC F3 — Role & Otorisasi (KRITIS)
- SPEC F4 — Halaman Publik Sales + Integrasi Homepage
- SPEC F5 — Dokumentasi & Storage
- PHPUnit\Framework\TestCase
- TODO — Platform Multi-Sales
- Sales
- ActiveSalesResolutionTest
- SalesOverviewWidget.php
- User
- Filament\Resources\Pages\CreateRecord
- 1. Perilaku yang diinginkan
- SPEC BARU — Beranda Personal per Sales (Revisi Arah)
- SPEC G5 — Verifikasi Menyeluruh & Penutupan
- App\Filament\Resources\Sales\SalesResource
- SPEC G1 — Beranda Personal: Profil + Galeri + Kontak Sales
- SPEC G2 — Sebar Konteks Sales ke Semua Halaman
- SPEC G0 — Middleware Resolusi Sales + Helper + 404 Kustom
- SPEC G3 — Bongkar `/sales/{slug}` & Bersihkan Sisa
- AppServiceProvider
- Filament\Resources\Pages\ListRecords
- 3. Inventaris Komponen
- GaleriResource
- MyProfileGalleryTest
- SalesStatsWidget.php
- UnitEnum
- verify-context.sh
- check-sales-links.sh
- 5. Desain Layar
- 4. Arsitektur Informasi
- Ringkasan Eksekusi (2026-09-20)
- UnitEnum
- verify-final.sh

## God Nodes (most connected - your core abstractions)
1. `Sales` - 71 edges
2. `User` - 54 edges
3. `Galeri` - 32 edges
4. `Controller` - 18 edges
5. `SalesResource` - 18 edges
6. `MyProfile` - 17 edges
7. `GaleriResource` - 16 edges
8. `ActiveSalesResolutionTest` - 14 edges
9. `SalesContextPropagationTest` - 13 edges
10. `Arsitektur — Hyundai Dealer Makassar (Multi-Sales)` - 13 edges

## Surprising Connections (you probably didn't know these)
- `active_sales()` --references--> `Sales`  [EXTRACTED]
  app/Support/helpers.php → app/Models/Sales.php
- `SalesAuthorizationTest` --inherits--> `TestCase`  [EXTRACTED]
  tests/Feature/SalesAuthorizationTest.php → tests/TestCase.php
- `GaleriAccessTest` --inherits--> `TestCase`  [EXTRACTED]
  tests/Feature/GaleriAccessTest.php → tests/TestCase.php
- `AdminLogin` --mixes_in--> `AuthenticatesWithUsername`  [EXTRACTED]
  app/Filament/Pages/Auth/AdminLogin.php → app/Filament/Pages/Auth/Concerns/AuthenticatesWithUsername.php
- `SalesLogin` --mixes_in--> `AuthenticatesWithUsername`  [EXTRACTED]
  app/Filament/Pages/Auth/SalesLogin.php → app/Filament/Pages/Auth/Concerns/AuthenticatesWithUsername.php

## Import Cycles
- None detected.

## Communities (92 total, 11 thin omitted)

### Community 0 - "composer.json"
Cohesion: 0.04
Nodes (44): pestphp/pest-plugin, php-http/discovery, autoload, autoload-dev, psr-4, psr-4, config, allow-plugins (+36 more)

### Community 1 - "package.json"
Cohesion: 0.06
Nodes (29): dependencies, bootstrap, jquery, swiper, devDependencies, autoprefixer, axios, concurrently (+21 more)

### Community 2 - "Controller"
Cohesion: 0.13
Nodes (5): App\Http\Controllers\Controller, Controller, Filament\Facades\Filament, Filament\Http\Middleware\SetUpPanel, Illuminate\Support\Facades\Route

### Community 3 - "AuthenticatesWithUsername"
Cohesion: 0.15
Nodes (8): AdminLogin, Htmlable, AuthenticatesWithUsername, Htmlable, SalesLogin, Component, Filament\Auth\Pages\Login, Illuminate\Validation\ValidationException

### Community 4 - "Illuminate\Database\Migrations\Migration"
Cohesion: 0.09
Nodes (4): Illuminate\Database\Migrations\Migration, Illuminate\Database\Schema\Blueprint, Illuminate\Support\Facades\DB, Illuminate\Support\Facades\Schema

### Community 5 - "Illuminate\Support\Str"
Cohesion: 0.17
Nodes (6): SalesFactory, UserFactory, Illuminate\Database\Eloquent\Factories\Factory, Illuminate\Support\Facades\Hash, Illuminate\Support\Str, static

### Community 7 - "Filament\Schemas\Schema"
Cohesion: 0.14
Nodes (12): App\Filament\Resources\Galeris\Schemas\GaleriForm, GaleriForm, SalesForm, Filament\Forms\Components\FileUpload, Filament\Forms\Components\Repeater, Filament\Forms\Components\Textarea, Filament\Forms\Components\Toggle, Filament\Schemas\Components\Section (+4 more)

### Community 8 - "scripts.js"
Cohesion: 0.25
Nodes (4): header, imageContainer, imageData, promoImages

### Community 9 - "Project Name: **Hyundai Dealer Makassar**"
Cohesion: 0.22
Nodes (8): Additional UI Settings, Contribution, Description, Installation and Setup, Key Features, Project Name: **Hyundai Dealer Makassar**, Project Structure, Technologies Used

### Community 10 - "EditSales.php"
Cohesion: 0.18
Nodes (9): App\Filament\Resources\Galeris\Pages\EditGaleri, EditGaleri, EditSales, App\Filament\Resources\Users\Pages\EditUser, EditUser, Filament\Actions\DeleteAction, Filament\Actions\ForceDeleteAction, Filament\Actions\RestoreAction (+1 more)

### Community 11 - "PRD — Hyundai Dealer Makassar: Platform Multi-Sales"
Cohesion: 0.08
Nodes (24): 10. Fase Rilis, 11. Pertanyaan Terbuka, 1. Ringkasan, 2. Pengguna & Peran, 3.1 Termasuk (In scope) — Fase 1, 3.2 Tidak termasuk (Fase ini), 3.3 Non-blocker yang diketahui (tidak dikerjakan, sesuai arahan), 3. Ruang Lingkup (+16 more)

### Community 12 - "SalesTable.php"
Cohesion: 0.12
Nodes (18): App\Filament\Resources\Galeris\Tables\GalerisTable, GalerisTable, SalesTable, Filament\Actions\Action, Filament\Actions\BulkAction, Filament\Actions\BulkActionGroup, Filament\Actions\DeleteBulkAction, Filament\Actions\EditAction (+10 more)

### Community 13 - "MyProfile"
Cohesion: 0.19
Nodes (8): ChangePassword, MyProfile, BackedEnum, Filament\Forms\Components\TextInput, Filament\Forms\Concerns\InteractsWithForms, Filament\Forms\Contracts\HasForms, Filament\Notifications\Notification, Filament\Pages\Page

### Community 14 - "logging.php"
Cohesion: 0.40
Nodes (4): Monolog\Handler\NullHandler, Monolog\Handler\StreamHandler, Monolog\Handler\SyslogUdpHandler, Monolog\Processor\PsrLogMessageProcessor

### Community 15 - "bootstrap/app.php"
Cohesion: 0.50
Nodes (3): Illuminate\Foundation\Application, Illuminate\Foundation\Configuration\Exceptions, Illuminate\Foundation\Configuration\Middleware

### Community 16 - "ResolveActiveSales.php"
Cohesion: 0.33
Nodes (6): EnsurePasswordChanged, ResolveActiveSales, Closure, Illuminate\Http\Request, Illuminate\Support\Facades\View, Symfony\Component\HttpFoundation\Response

### Community 17 - "hyundaimks"
Cohesion: 0.50
Nodes (3): ATURAN WAJIB: Obsidian selalu diperbarui, graphify, hyundaimks

### Community 22 - "SPEC G4 — Panel Sales: Kelola Profil & Galeri Sendiri"
Cohesion: 0.15
Nodes (12): 1. Yang sudah ada (verifikasi, jangan bongkar), 2.1 Sales hanya melihat dokumentasi miliknya, 2.2 Sales tidak bisa mengaitkan dokumen ke sales lain, 2.3 Sales tidak bisa mengubah field terlarang, 2.4 Navigasi panel sesuai peran, 2. Yang perlu dipastikan bekerja, 3. Test (WAJIB), 4. Larangan (+4 more)

### Community 46 - "Design Brief — UI/UX"
Cohesion: 0.20
Nodes (10): 10. Kriteria Penerimaan Desain, 1. Prinsip Desain, 2. Design Tokens, 6. Aturan Responsif, 7. Aksesibilitas, 8. Mikro-interaksi & Motion, 9. Deliverable Desain, Design Brief — UI/UX (+2 more)

### Community 47 - "AdminPanelProvider.php"
Cohesion: 0.11
Nodes (17): AdminPanelProvider, Filament\Http\Middleware\Authenticate, Filament\Http\Middleware\AuthenticateSession, Filament\Http\Middleware\DisableBladeIconComponents, Filament\Http\Middleware\DispatchServingFilamentEvent, Filament\Pages\Dashboard, Filament\Panel, Filament\PanelProvider (+9 more)

### Community 48 - "Arsitektur — Hyundai Dealer Makassar (Multi-Sales)"
Cohesion: 0.12
Nodes (17): 10. Risiko Arsitektur & Mitigasi, 11. Jalan Keluar Skala (fase lanjut, bukan sekarang), 12. Keputusan Arsitektur (ADR ringkas), 1. Gambaran Sistem, 2. Lapisan & Tanggung Jawab, 3. Struktur Direktori (target), 4. Model Data & Relasi, 5. Otorisasi (dua lapis) (+9 more)

### Community 49 - "SPEC F1 — Model & Migrasi Data Sales"
Cohesion: 0.12
Nodes (15): 1. Migrasi, 1a. `add_role_to_users_table`, 1b. `create_sales_table`, 1c. `create_sales_documents_table`, 2. Model, 3. Seeder, 4. Larangan, 5. Kriteria Selesai (jalankan dan laporkan hasilnya) (+7 more)

### Community 50 - "SPEC F0 — Inisialisasi Panel Filament"
Cohesion: 0.25
Nodes (7): Branding panel (ringan saja di fase ini), Kriteria Selesai (wajib dijalankan dan hasilnya dilaporkan), Laporan yang diminta dari agen, Larangan, Perintah yang harus dijalankan, SPEC F0 — Inisialisasi Panel Filament, Tujuan

### Community 52 - "Workflow — Cara Kerja Proyek Ini"
Cohesion: 0.18
Nodes (11): 10. Checklist Ringkas Sebelum Menyatakan Fase Selesai, 1. Prinsip Inti, 2. Peran, 3. Siklus Kerja per Fase, 4. Aturan Delegasi ke OpenCode, 5. Verifikasi (definisi "selesai" yang sah), 6. Manajemen Lingkungan, 7. Git (+3 more)

### Community 53 - "SPEC F6 — Kualitas, Hardening & Verifikasi Akhir"
Cohesion: 0.15
Nodes (12): 10. Laporan yang diminta, 1. Performa (NFR-1), 2. Keamanan (NFR-2, NFR-3), 3. Aksesibilitas (NFR-5), 4. Responsif (NFR-7), 5. Test Tambahan (WAJIB), 6. Pembersihan, 7. Dokumentasi (+4 more)

### Community 54 - "SPEC F2 — Filament Resource: CRUD Sales (Admin)"
Cohesion: 0.17
Nodes (11): 1. Buat Resource, 2. SalesResource, 3. SalesDocumentResource, 4. Navigasi, 5. Larangan, 6. Kriteria Selesai (jalankan, laporkan hasil), 7. Laporan yang diminta, Form (`SalesForm` atau `form()`) (+3 more)

### Community 55 - "SPEC F3 — Role & Otorisasi (KRITIS)"
Cohesion: 0.17
Nodes (11): 1. Policy, 2. Pembatasan Query Panel (scope), 3. Panel Sales: "Profil Saya", 4. Navigasi Role, 5. Resource Users (admin), 6. Test Otomatis (WAJIB), 7. Larangan, 8. Kriteria Selesai (jalankan, laporkan hasil) (+3 more)

### Community 56 - "SPEC F4 — Halaman Publik Sales + Integrasi Homepage"
Cohesion: 0.17
Nodes (11): 1. Rute (SATU-SATUNYA penambahan di `routes/web.php`), 2. Controller, 3. View `resources/views/sales/show.blade.php`, 4. Homepage, 5. Helper Normalisasi Nomor, 6. CSS, 7. Larangan, 8. Kriteria Selesai (WAJIB dijalankan, laporkan SEMUA keluaran) (+3 more)

### Community 57 - "SPEC F5 — Dokumentasi & Storage"
Cohesion: 0.18
Nodes (10): 1. Storage, 2. Validasi Upload, 3. Pembersihan File (penting), 4. Tampilan Publik, 5. Panel, 6. Larangan, 7. Kriteria Selesai (jalankan, laporkan hasil), 8. Laporan yang diminta (+2 more)

### Community 58 - "PHPUnit\Framework\TestCase"
Cohesion: 0.32
Nodes (3): PHPUnit\Framework\TestCase, ExampleTest, WhatsappNormalizationTest

### Community 59 - "TODO — Platform Multi-Sales"
Cohesion: 0.20
Nodes (10): Backlog (setelah F6), F0 — Fondasi (PANEL FILAMENT HIDUP)  ✅ SELESAI, F1 — Data & Model  ✅ SELESAI, F2 — Panel Admin: CRUD Sales  ✅ SELESAI, F3 — Role & Otorisasi (KRITIS — KEAMANAN)  ✅ SELESAI, F4 — Halaman Publik Sales + Homepage  ✅ SELESAI, F5 — Dokumentasi & Storage  ✅ SELESAI, F6 — Kualitas & Hardening  ✅ SELESAI (+2 more)

### Community 60 - "Sales"
Cohesion: 0.05
Nodes (24): HomeController, Galeri, Sales, ImageCompressor, DatabaseSeeder, GaleriSeeder, SalesSeeder, Illuminate\Database\Eloquent\Factories\HasFactory (+16 more)

### Community 61 - "ActiveSalesResolutionTest"
Cohesion: 0.09
Nodes (8): active_sales(), sales_route(), sales_url(), Illuminate\Foundation\Testing\TestCase, ActiveSalesResolutionTest, ExampleTest, SalesContextPropagationTest, TestCase

### Community 63 - "User"
Cohesion: 0.07
Nodes (14): UnitEnum, SalesResource, User, SalesPolicy, Filament\Models\Contracts\FilamentUser, Illuminate\Database\Eloquent\Builder, Illuminate\Database\Eloquent\Relations\HasOne, Illuminate\Foundation\Auth\User (+6 more)

### Community 64 - "Filament\Resources\Pages\CreateRecord"
Cohesion: 0.36
Nodes (6): App\Filament\Resources\Galeris\Pages\CreateGaleri, CreateGaleri, CreateSales, App\Filament\Resources\Users\Pages\CreateUser, CreateUser, Filament\Resources\Pages\CreateRecord

### Community 66 - "1. Perilaku yang diinginkan"
Cohesion: 0.10
Nodes (20): 1.1 Inti, 1.2 Yang berubah per sales, 1.3 Cara akses, 1.4 Aturan akses, 1.5 Halaman 404, 1.6 Galeri kosong, 1.7 Batas jumlah galeri di beranda, 1.8 Panel (tidak ada perubahan izin) (+12 more)

### Community 67 - "SPEC BARU — Beranda Personal per Sales (Revisi Arah)"
Cohesion: 0.11
Nodes (18): 0. Latar: apa yang salah dari arah sebelumnya, 1.1 Inti, 1.2 Yang berubah per sales, 1.3 Cara akses, 1.4 Aturan akses menyeluruh, 1.5 Tampilan 404, 1. Perilaku yang diinginkan (hasil konfirmasi), 2.1 Middleware resolusi sales (+10 more)

### Community 68 - "SPEC G5 — Verifikasi Menyeluruh & Penutupan"
Cohesion: 0.15
Nodes (12): 10. Laporan yang diminta, 1. Pemeriksaan tautan mati (paling penting), 2. Sweep link mati secara nyata (bukan hanya grep), 3. Matriks akses lengkap, 4. Isolasi antar-sales (keamanan), 5. Audit performa, 6. Kebersihan, 7. Aksesibilitas (pemeriksaan, bukan perbaikan besar) (+4 more)

### Community 69 - "App\Filament\Resources\Sales\SalesResource"
Cohesion: 0.21
Nodes (7): App\Filament\Resources\Sales\SalesResource, UserResource, Filament\Forms\Components\Select, Filament\Resources\Resource, Filament\Support\Icons\Heroicon, Illuminate\Database\Eloquent\SoftDeletingScope, UnitEnum

### Community 70 - "SPEC G1 — Beranda Personal: Profil + Galeri + Kontak Sales"
Cohesion: 0.17
Nodes (11): 1. Controller beranda, 2. Blok profil sales di beranda, 3. Tombol kontak, 4. Galeri Dealer, 5. Data diri di header/footer, 6. CSS, 7. Larangan, 8. Kriteria Selesai (jalankan, laporkan SEMUA keluaran) (+3 more)

### Community 71 - "SPEC G2 — Sebar Konteks Sales ke Semua Halaman"
Cohesion: 0.17
Nodes (11): 1. Semua link wajib lewat helper, 2. Tombol kontak menuju sales aktif, 3. Controller publik: kirim konteks, 4. Form & redirect, 5. Pemeriksaan otomatis (WAJIB — bagian terpenting fase ini), 6. Test (WAJIB), 7. Larangan, 8. Kriteria Selesai (jalankan, laporkan SEMUA keluaran) (+3 more)

### Community 72 - "SPEC G0 — Middleware Resolusi Sales + Helper + 404 Kustom"
Cohesion: 0.18
Nodes (10): 1. Middleware `ResolveActiveSales`, 2. Registrasi middleware, 3. Helper `sales_route()`, 4. Halaman 404 kustom, 5. Test (WAJIB), 6. Larangan, 7. Kriteria Selesai (jalankan, laporkan SEMUA keluaran), 8. Laporan yang diminta (+2 more)

### Community 73 - "SPEC G3 — Bongkar `/sales/{slug}` & Bersihkan Sisa"
Cohesion: 0.22
Nodes (8): 1. Hapus, 2. Bersihkan referensi mati, 3. Pastikan tidak ada halaman publik lain yang lolos aturan 404, 4. Larangan, 5. Kriteria Selesai (jalankan, laporkan SEMUA keluaran), 6. Laporan yang diminta, SPEC G3 — Bongkar `/sales/{slug}` & Bersihkan Sisa, Tujuan

### Community 74 - "AppServiceProvider"
Cohesion: 0.38
Nodes (3): AppServiceProvider, Illuminate\Support\Facades\URL, Illuminate\Support\ServiceProvider

### Community 76 - "Filament\Resources\Pages\ListRecords"
Cohesion: 0.27
Nodes (7): App\Filament\Resources\Galeris\Pages\ListGaleris, ListGaleris, ListSales, App\Filament\Resources\Users\Pages\ListUsers, ListUsers, Filament\Actions\CreateAction, Filament\Resources\Pages\ListRecords

### Community 77 - "3. Inventaris Komponen"
Cohesion: 0.50
Nodes (4): 3.1 Sudah ada (perluas, jangan bongkar), 3.2 Baru (dibuat untuk fitur ini), 3.3 Aturan state (wajib di semua komponen interaktif), 3. Inventaris Komponen

### Community 82 - "SalesStatsWidget.php"
Cohesion: 0.40
Nodes (3): SalesStatsWidget, Filament\Widgets\StatsOverviewWidget, Filament\Widgets\StatsOverviewWidget\Stat

### Community 84 - "verify-context.sh"
Cohesion: 0.83
Nodes (3): code(), normalize(), verify-context.sh script

### Community 86 - "5. Desain Layar"
Cohesion: 0.50
Nodes (4): 5.1 `/sales/{slug}` — Halaman sales (halaman terpenting), 5.2 Seksi "Sales Kami" di homepage, 5.3 Panel admin (Filament), 5. Desain Layar

### Community 87 - "4. Arsitektur Informasi"
Cohesion: 0.67
Nodes (3): 4.1 Peta situs, 4.2 Hierarki homepage setelah perubahan, 4. Arsitektur Informasi

### Community 88 - "Ringkasan Eksekusi (2026-09-20)"
Cohesion: 0.67
Nodes (3): Bug yang ditemukan & diperbaiki selama eksekusi, Ringkasan Eksekusi (2026-09-20), Sisa (butuh tindakan konten, bukan kode)

### Community 91 - "verify-final.sh"
Cohesion: 0.83
Nodes (3): code(), normalize(), verify-final.sh script

## Knowledge Gaps
- **301 isolated node(s):** `homepage/card`, `homepage/benefit`, `pestphp/pest-plugin`, `php-http/discovery`, `optimize-autoloader` (+296 more)
  These have ≤1 connection - possible missing edges or undocumented components. (Counts symbols only; 468 node(s) total have ≤1 connection when file, concept and rationale nodes are included.)
- **11 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `Sales` connect `Sales` to `Controller`, `App\Filament\Resources\Sales\SalesResource`, `Illuminate\Support\Str`, `MyProfile`, `ResolveActiveSales.php`, `GaleriResource`, `MyProfileGalleryTest`, `PHPUnit\Framework\TestCase`, `ActiveSalesResolutionTest`, `User`?**
  _High betweenness centrality (0.084) - this node is a cross-community bridge._
- **Why does `User` connect `User` to `Controller`, `App\Filament\Resources\Sales\SalesResource`, `AdminPanelProvider.php`, `GaleriResource`, `MyProfileGalleryTest`, `Sales`, `ActiveSalesResolutionTest`?**
  _High betweenness centrality (0.046) - this node is a cross-community bridge._
- **Why does `Galeri` connect `Sales` to `Illuminate\Support\Str`, `App\Filament\Resources\Sales\SalesResource`, `MyProfileGalleryTest`, `SalesStatsWidget.php`, `SalesOverviewWidget.php`?**
  _High betweenness centrality (0.024) - this node is a cross-community bridge._
- **Are the 4 inferred relationships involving `User` (e.g. with `.test_admin_dapat_membuka_setiap_halaman_panel()` and `.test_halaman_panel_tidak_error_untuk_sales()`) actually correct?**
  _`User` has 4 INFERRED edges - model-reasoned connections that need verification._
- **What connects `homepage/card`, `homepage/benefit`, `pestphp/pest-plugin` to the rest of the system?**
  _301 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.044444444444444446 - nodes in this community are weakly interconnected._
- **Should `package.json` be split into smaller, more focused modules?**
  _Cohesion score 0.06439393939393939 - nodes in this community are weakly interconnected._