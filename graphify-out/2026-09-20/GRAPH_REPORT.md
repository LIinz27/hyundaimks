# Graph Report - hyundaimks  (2026-09-20)

## Corpus Check
- 115 files · ~608,982 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 782 nodes · 995 edges · 85 communities (48 shown, 11 thin omitted)
- Extraction: 95% EXTRACTED · 5% INFERRED · 0% AMBIGUOUS · INFERRED: 48 edges (avg confidence: 0.85)
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `648904a5`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- composer.json
- package.json
- Controller
- Scope (urut prioritas)
- Illuminate\Database\Migrations\Migration
- Illuminate\Support\Str
- scripts.js
- Project Name: **Hyundai Dealer Makassar**
- App\Filament\Resources\Sales\Pages\EditSales
- PRD — Hyundai Dealer Makassar: Platform Multi-Sales
- App\Filament\Resources\Sales\Tables\SalesTable
- App\Http\Controllers\SalesPageController
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
- Sales
- SPEC F6 — Kualitas, Hardening & Verifikasi Akhir
- SPEC F2 — Filament Resource: CRUD Sales (Admin)
- SPEC F3 — Role & Otorisasi (KRITIS)
- SPEC F4 — Halaman Publik Sales + Integrasi Homepage
- SPEC F5 — Dokumentasi & Storage
- Sales
- UserResource.php
- SalesPanelTest.php
- App\Models\User
- App\Filament\Pages\MyProfile
- Illuminate\Database\Seeder
- PHPUnit\Framework\TestCase
- 1. Perilaku yang diinginkan
- SPEC BARU — Beranda Personal per Sales (Revisi Arah)
- SPEC G5 — Verifikasi Menyeluruh & Penutupan
- ActiveSalesResolutionTest
- SPEC G1 — Beranda Personal: Profil + Galeri + Kontak Sales
- SPEC G2 — Sebar Konteks Sales ke Semua Halaman
- SPEC G0 — Middleware Resolusi Sales + Helper + 404 Kustom
- SPEC G3 — Bongkar `/sales/{slug}` & Bersihkan Sisa
- AppServiceProvider
- SalesResource
- Filament\Resources\Pages\ListRecords
- SalesPanelTest
- User
- SalesContextPropagationTest
- Filament\Resources\Pages\CreateRecord
- UserResource
- verify-context.sh
- check-sales-links.sh
- verify-final.sh

## God Nodes (most connected - your core abstractions)
1. `Sales` - 47 edges
2. `User` - 25 edges
3. `Controller` - 18 edges
4. `SalesResource` - 18 edges
5. `ActiveSalesResolutionTest` - 14 edges
6. `SalesDocumentResource` - 13 edges
7. `Arsitektur — Hyundai Dealer Makassar (Multi-Sales)` - 13 edges
8. `MyProfile` - 12 edges
9. `UserResource` - 12 edges
10. `PRD — Hyundai Dealer Makassar: Platform Multi-Sales` - 12 edges

## Surprising Connections (you probably didn't know these)
- `SalesContextPropagationTest` --mixes_in--> `Illuminate\Foundation\Testing\RefreshDatabase`  [EXTRACTED]
  tests/Feature/SalesContextPropagationTest.php →   _Bridges community 81 → community 61_
- `active_sales()` --references--> `App\Models\Sales`  [EXTRACTED]
  app/Support/helpers.php →   _Bridges community 52 → community 69_
- `ActiveSalesResolutionTest` --mixes_in--> `Illuminate\Foundation\Testing\RefreshDatabase`  [EXTRACTED]
  tests/Feature/ActiveSalesResolutionTest.php →   _Bridges community 61 → community 69_
- `SalesAuthorizationTest` --mixes_in--> `Illuminate\Foundation\Testing\RefreshDatabase`  [EXTRACTED]
  tests/Feature/SalesAuthorizationTest.php →   _Bridges community 61 → community 80_
- `SalesPanelTest` --mixes_in--> `Illuminate\Foundation\Testing\RefreshDatabase`  [EXTRACTED]
  tests/Feature/SalesPanelTest.php →   _Bridges community 61 → community 77_

## Import Cycles
- None detected.

## Communities (85 total, 11 thin omitted)

### Community 0 - "composer.json"
Cohesion: 0.04
Nodes (44): pestphp/pest-plugin, php-http/discovery, autoload, autoload-dev, psr-4, psr-4, config, allow-plugins (+36 more)

### Community 1 - "package.json"
Cohesion: 0.06
Nodes (29): dependencies, bootstrap, jquery, swiper, devDependencies, autoprefixer, axios, concurrently (+21 more)

### Community 2 - "Controller"
Cohesion: 0.12
Nodes (4): App\Http\Controllers\Controller, Controller, HomeController, Illuminate\Support\Facades\Route

### Community 3 - "Scope (urut prioritas)"
Cohesion: 0.15
Nodes (12): 1. Bug fix (wajib, blocking), 2. Layout base (single source of truth), 3. Konsolidasi CSS, 4. Responsif konsisten, 5. De-duplikasi halaman produk (PENTING), 6. Data mobil di homepage, Cara verifikasi (agent wajib jalankan), Constraints (+4 more)

### Community 4 - "Illuminate\Database\Migrations\Migration"
Cohesion: 0.14
Nodes (3): Illuminate\Database\Migrations\Migration, Illuminate\Database\Schema\Blueprint, Illuminate\Support\Facades\Schema

### Community 5 - "Illuminate\Support\Str"
Cohesion: 0.19
Nodes (6): SalesFactory, UserFactory, Illuminate\Database\Eloquent\Factories\Factory, Illuminate\Support\Facades\Hash, Illuminate\Support\Str, static

### Community 8 - "scripts.js"
Cohesion: 0.22
Nodes (5): galleryImages, header, imageContainer, imageData, promoImages

### Community 9 - "Project Name: **Hyundai Dealer Makassar**"
Cohesion: 0.22
Nodes (8): Additional UI Settings, Contribution, Description, Installation and Setup, Key Features, Project Name: **Hyundai Dealer Makassar**, Project Structure, Technologies Used

### Community 10 - "App\Filament\Resources\Sales\Pages\EditSales"
Cohesion: 0.18
Nodes (8): App\Filament\Resources\Sales\Pages\EditSales, EditSales, EditSalesDocument, EditUser, Filament\Actions\DeleteAction, Filament\Actions\ForceDeleteAction, Filament\Actions\RestoreAction, Filament\Resources\Pages\EditRecord

### Community 11 - "PRD — Hyundai Dealer Makassar: Platform Multi-Sales"
Cohesion: 0.08
Nodes (24): 10. Fase Rilis, 11. Pertanyaan Terbuka, 1. Ringkasan, 2. Pengguna & Peran, 3.1 Termasuk (In scope) — Fase 1, 3.2 Tidak termasuk (Fase ini), 3.3 Non-blocker yang diketahui (tidak dikerjakan, sesuai arahan), 3. Ruang Lingkup (+16 more)

### Community 12 - "App\Filament\Resources\Sales\Tables\SalesTable"
Cohesion: 0.13
Nodes (18): App\Filament\Resources\Sales\Tables\SalesTable, SalesTable, App\Filament\Resources\SalesDocuments\Tables\SalesDocumentsTable, SalesDocumentsTable, Filament\Actions\Action, Filament\Actions\BulkAction, Filament\Actions\BulkActionGroup, Filament\Actions\DeleteBulkAction (+10 more)

### Community 14 - "logging.php"
Cohesion: 0.40
Nodes (4): Monolog\Handler\NullHandler, Monolog\Handler\StreamHandler, Monolog\Handler\SyslogUdpHandler, Monolog\Processor\PsrLogMessageProcessor

### Community 15 - "bootstrap/app.php"
Cohesion: 0.50
Nodes (3): Illuminate\Foundation\Application, Illuminate\Foundation\Configuration\Exceptions, Illuminate\Foundation\Configuration\Middleware

### Community 16 - "ResolveActiveSales.php"
Cohesion: 0.36
Nodes (5): ResolveActiveSales, Closure, Illuminate\Http\Request, Illuminate\Support\Facades\View, Symfony\Component\HttpFoundation\Response

### Community 17 - "hyundaimks"
Cohesion: 0.50
Nodes (3): ATURAN WAJIB: Obsidian selalu diperbarui, graphify, hyundaimks

### Community 22 - "SPEC G4 — Panel Sales: Kelola Profil & Galeri Sendiri"
Cohesion: 0.15
Nodes (12): 1. Yang sudah ada (verifikasi, jangan bongkar), 2.1 Sales hanya melihat dokumentasi miliknya, 2.2 Sales tidak bisa mengaitkan dokumen ke sales lain, 2.3 Sales tidak bisa mengubah field terlarang, 2.4 Navigasi panel sesuai peran, 2. Yang perlu dipastikan bekerja, 3. Test (WAJIB), 4. Larangan (+4 more)

### Community 46 - "Design Brief — UI/UX"
Cohesion: 0.10
Nodes (21): 10. Kriteria Penerimaan Desain, 1. Prinsip Desain, 2. Design Tokens, 3.1 Sudah ada (perluas, jangan bongkar), 3.2 Baru (dibuat untuk fitur ini), 3.3 Aturan state (wajib di semua komponen interaktif), 3. Inventaris Komponen, 4.1 Peta situs (+13 more)

### Community 47 - "AdminPanelProvider.php"
Cohesion: 0.11
Nodes (17): AdminPanelProvider, Filament\Http\Middleware\Authenticate, Filament\Http\Middleware\AuthenticateSession, Filament\Http\Middleware\DisableBladeIconComponents, Filament\Http\Middleware\DispatchServingFilamentEvent, Filament\Pages\Dashboard, Filament\Panel, Filament\PanelProvider (+9 more)

### Community 48 - "Arsitektur — Hyundai Dealer Makassar (Multi-Sales)"
Cohesion: 0.04
Nodes (41): 10. Risiko Arsitektur & Mitigasi, 11. Jalan Keluar Skala (fase lanjut, bukan sekarang), 12. Keputusan Arsitektur (ADR ringkas), 1. Gambaran Sistem, 2. Lapisan & Tanggung Jawab, 3. Struktur Direktori (target), 4. Model Data & Relasi, 5. Otorisasi (dua lapis) (+33 more)

### Community 49 - "SPEC F1 — Model & Migrasi Data Sales"
Cohesion: 0.12
Nodes (15): 1. Migrasi, 1a. `add_role_to_users_table`, 1b. `create_sales_table`, 1c. `create_sales_documents_table`, 2. Model, 3. Seeder, 4. Larangan, 5. Kriteria Selesai (jalankan dan laporkan hasilnya) (+7 more)

### Community 50 - "SPEC F0 — Inisialisasi Panel Filament"
Cohesion: 0.25
Nodes (7): Branding panel (ringan saja di fase ini), Kriteria Selesai (wajib dijalankan dan hasilnya dilaporkan), Laporan yang diminta dari agen, Larangan, Perintah yang harus dijalankan, SPEC F0 — Inisialisasi Panel Filament, Tujuan

### Community 52 - "Sales"
Cohesion: 0.16
Nodes (6): App\Models\Sales, Sales, Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Database\Eloquent\Relations\BelongsTo, Illuminate\Database\Eloquent\Relations\HasMany, Illuminate\Database\Eloquent\SoftDeletes

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

### Community 59 - "UserResource.php"
Cohesion: 0.16
Nodes (13): App\Filament\Resources\Sales\Schemas\SalesForm, SalesForm, SalesDocumentForm, Filament\Forms\Components\FileUpload, Filament\Forms\Components\Hidden, Filament\Forms\Components\Select, Filament\Forms\Components\Textarea, Filament\Forms\Components\TextInput (+5 more)

### Community 61 - "SalesPanelTest.php"
Cohesion: 0.19
Nodes (11): App\Models\SalesDocument, Illuminate\Foundation\Testing\RefreshDatabase, Illuminate\Foundation\Testing\TestCase, Illuminate\Http\UploadedFile, Illuminate\Support\Facades\Gate, Illuminate\Support\Facades\Storage, Livewire\Livewire, ExampleTest (+3 more)

### Community 62 - "App\Models\User"
Cohesion: 0.22
Nodes (5): App\Models\User, SalesPolicy, Filament\Models\Contracts\FilamentUser, Illuminate\Database\Eloquent\Relations\HasOne, Illuminate\Notifications\Notifiable

### Community 63 - "App\Filament\Pages\MyProfile"
Cohesion: 0.29
Nodes (6): App\Filament\Pages\MyProfile, MyProfile, Filament\Forms\Concerns\InteractsWithForms, Filament\Forms\Contracts\HasForms, Filament\Notifications\Notification, Filament\Pages\Page

### Community 64 - "Illuminate\Database\Seeder"
Cohesion: 0.38
Nodes (3): DatabaseSeeder, SalesSeeder, Illuminate\Database\Seeder

### Community 65 - "PHPUnit\Framework\TestCase"
Cohesion: 0.32
Nodes (3): PHPUnit\Framework\TestCase, ExampleTest, WhatsappNormalizationTest

### Community 66 - "1. Perilaku yang diinginkan"
Cohesion: 0.10
Nodes (20): 1.1 Inti, 1.2 Yang berubah per sales, 1.3 Cara akses, 1.4 Aturan akses, 1.5 Halaman 404, 1.6 Galeri kosong, 1.7 Batas jumlah galeri di beranda, 1.8 Panel (tidak ada perubahan izin) (+12 more)

### Community 67 - "SPEC BARU — Beranda Personal per Sales (Revisi Arah)"
Cohesion: 0.11
Nodes (18): 0. Latar: apa yang salah dari arah sebelumnya, 1.1 Inti, 1.2 Yang berubah per sales, 1.3 Cara akses, 1.4 Aturan akses menyeluruh, 1.5 Tampilan 404, 1. Perilaku yang diinginkan (hasil konfirmasi), 2.1 Middleware resolusi sales (+10 more)

### Community 68 - "SPEC G5 — Verifikasi Menyeluruh & Penutupan"
Cohesion: 0.15
Nodes (12): 10. Laporan yang diminta, 1. Pemeriksaan tautan mati (paling penting), 2. Sweep link mati secara nyata (bukan hanya grep), 3. Matriks akses lengkap, 4. Isolasi antar-sales (keamanan), 5. Audit performa, 6. Kebersihan, 7. Aksesibilitas (pemeriksaan, bukan perbaikan besar) (+4 more)

### Community 69 - "ActiveSalesResolutionTest"
Cohesion: 0.17
Nodes (4): active_sales(), sales_route(), sales_url(), ActiveSalesResolutionTest

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

### Community 75 - "SalesResource"
Cohesion: 0.16
Nodes (12): App\Filament\Resources\Sales\SalesResource, UnitEnum, SalesResource, App\Filament\Resources\SalesDocuments\Pages\ListSalesDocuments, App\Filament\Resources\SalesDocuments\SalesDocumentResource, UnitEnum, SalesDocumentResource, BackedEnum (+4 more)

### Community 76 - "Filament\Resources\Pages\ListRecords"
Cohesion: 0.31
Nodes (5): App\Filament\Resources\Sales\Pages\ListSales, ListSales, ListUsers, Filament\Actions\CreateAction, Filament\Resources\Pages\ListRecords

### Community 77 - "SalesPanelTest"
Cohesion: 0.26
Nodes (3): SalesDocument, Illuminate\Database\Eloquent\Model, SalesPanelTest

### Community 80 - "User"
Cohesion: 0.24
Nodes (3): User, Illuminate\Foundation\Auth\User, SalesAuthorizationTest

### Community 82 - "Filament\Resources\Pages\CreateRecord"
Cohesion: 0.24
Nodes (6): App\Filament\Resources\Sales\Pages\CreateSales, CreateSales, CreateSalesDocument, ListSalesDocuments, CreateUser, Filament\Resources\Pages\CreateRecord

### Community 84 - "verify-context.sh"
Cohesion: 0.83
Nodes (3): code(), normalize(), verify-context.sh script

### Community 91 - "verify-final.sh"
Cohesion: 0.83
Nodes (3): code(), normalize(), verify-final.sh script

## Knowledge Gaps
- **312 isolated node(s):** `homepage/card`, `homepage/benefit`, `pestphp/pest-plugin`, `php-http/discovery`, `optimize-autoloader` (+307 more)
  These have ≤1 connection - possible missing edges or undocumented components. (Counts symbols only; 464 node(s) total have ≤1 connection when file, concept and rationale nodes are included.)
- **11 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `Sales` connect `Sales` to `Illuminate\Database\Seeder`, `PHPUnit\Framework\TestCase`, `ActiveSalesResolutionTest`, `SalesResource`, `SalesPanelTest`, `ResolveActiveSales.php`, `User`, `SalesPanelTest.php`, `App\Models\User`, `App\Filament\Pages\MyProfile`?**
  _High betweenness centrality (0.054) - this node is a cross-community bridge._
- **Are the 11 inferred relationships involving `Sales` (e.g. with `.handle()` and `.run()`) actually correct?**
  _`Sales` has 11 INFERRED edges - model-reasoned connections that need verification._
- **Are the 12 inferred relationships involving `User` (e.g. with `.test_helper_omits_query_when_source_is_account()` and `.test_logged_in_sales_cannot_peek_at_another_sales_via_query()`) actually correct?**
  _`User` has 12 INFERRED edges - model-reasoned connections that need verification._
- **What connects `homepage/card`, `homepage/benefit`, `pestphp/pest-plugin` to the rest of the system?**
  _312 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.044444444444444446 - nodes in this community are weakly interconnected._
- **Should `package.json` be split into smaller, more focused modules?**
  _Cohesion score 0.06439393939393939 - nodes in this community are weakly interconnected._
- **Should `Controller` be split into smaller, more focused modules?**
  _Cohesion score 0.11956521739130435 - nodes in this community are weakly interconnected._