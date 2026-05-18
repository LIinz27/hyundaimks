<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/hyundai-logo.png') }}">
    <title>@yield('title', 'Admin Panel') — Hyundai Makassar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --brand: #1C4682; --brand-dark: #153561; --sidebar-width: 250px; }
        body { font-family: 'Manrope', sans-serif; background: #f4f6fb; }

        /* ── Sidebar ── */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--brand);
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: transform .3s;
            overflow: hidden;
        }
        #sidebar-nav {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
        }
        #sidebar-nav::-webkit-scrollbar { width: 4px; }
        #sidebar-nav::-webkit-scrollbar-track { background: transparent; }
        #sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,.25); border-radius: 2px; }
        #sidebar .brand {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255,255,255,.15);
            flex-shrink: 0;
        }
        #sidebar .brand img { max-height: 30px; filter: brightness(0) invert(1); }
        #sidebar .brand small { display: block; color: rgba(255,255,255,.6); font-size: .7rem; margin-top: 4px; }
        #sidebar .nav-link {
            color: rgba(255,255,255,.8);
            padding: 10px 24px;
            border-radius: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: .88rem;
            transition: background .2s, color .2s;
        }
        #sidebar .nav-link:hover,
        #sidebar .nav-link.active {
            background: rgba(255,255,255,.15);
            color: #fff;
        }
        #sidebar .nav-link i { font-size: 1.1rem; width: 20px; text-align: center; }
        #sidebar .nav-section {
            padding: 16px 24px 6px;
            font-size: .7rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: rgba(255,255,255,.4);
        }
        #sidebar .sidebar-footer {
            flex-shrink: 0;
            padding: 16px 24px;
            border-top: 1px solid rgba(255,255,255,.15);
        }

        /* ── Main ── */
        #main { margin-left: var(--sidebar-width); min-height: 100vh; }
        #topbar {
            background: #fff;
            border-bottom: 1px solid #e3e8f0;
            padding: 12px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 900;
        }
        #topbar .page-title { font-weight: 700; color: var(--brand); font-size: 1.1rem; margin: 0; }
        .content-area { padding: 28px; }

        /* ── Cards ── */
        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 1px 4px rgba(0,0,0,.06);
        }
        .stat-card .icon {
            width: 52px; height: 52px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
        }
        .stat-card .number { font-size: 1.8rem; font-weight: 700; color: #1a1a2e; line-height: 1; }
        .stat-card .label  { font-size: .8rem; color: #6c757d; margin-top: 2px; }

        /* ── Table ── */
        .admin-table { background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,.06); }
        .admin-table thead th { background: var(--brand); color: #fff; font-weight: 600; font-size: .82rem; border: none; padding: 12px 16px; }
        .admin-table tbody td { padding: 12px 16px; vertical-align: middle; font-size: .85rem; border-color: #f0f3f9; }
        .admin-table tbody tr:hover { background: #f8faff; }

        /* ── Sidebar toggle (mobile) ── */
        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.open { transform: translateX(0); }
            #main { margin-left: 0; }
            .content-area { padding: 16px; }
            #topbar { padding: 10px 16px; }
            #topbar .page-title { font-size: .95rem; }
        }
    </style>
</head>
<body>

{{-- ── SIDEBAR ── --}}
<nav id="sidebar">
    <div class="brand">
        <img src="{{ asset('images/LOGO-HYUNDAI.png') }}" alt="Hyundai">
        <small>Admin Panel</small>
    </div>

    <div id="sidebar-nav">
    <div class="mt-2">
        <div class="nav-section">Menu Utama</div>
        <a href="{{ route('admin.dashboard') }}"
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="nav-section">Formulir Masuk</div>
        <a href="{{ route('admin.test-drives.index') }}"
           class="nav-link {{ request()->routeIs('admin.test-drives.*') ? 'active' : '' }}">
            <i class="bi bi-car-front-fill"></i> Test Drive
        </a>
        <a href="{{ route('admin.simulasi.index') }}"
           class="nav-link {{ request()->routeIs('admin.simulasi.*') ? 'active' : '' }}">
            <i class="bi bi-calculator"></i> Simulasi Kredit
        </a>
        <a href="{{ route('admin.kontak.index') }}"
           class="nav-link {{ request()->routeIs('admin.kontak.*') ? 'active' : '' }}">
            <i class="bi bi-envelope-fill"></i> Pesan Kontak
        </a>

        <div class="nav-section">Konten</div>
        <a href="{{ route('admin.promo.index') }}"
           class="nav-link {{ request()->routeIs('admin.promo.*') ? 'active' : '' }}">
            <i class="bi bi-megaphone-fill"></i> Promo
        </a>
        <a href="{{ route('admin.pricelist.index') }}"
           class="nav-link {{ request()->routeIs('admin.pricelist.*') ? 'active' : '' }}">
            <i class="bi bi-tags-fill"></i> Pricelist
        </a>
        <a href="{{ route('admin.galeri.index') }}"
           class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
            <i class="bi bi-images"></i> Galeri / Portofolio
        </a>

        <div class="nav-section">Homepage</div>
        <a href="{{ route('admin.mobil.index') }}"
           class="nav-link {{ request()->routeIs('admin.mobil.*') ? 'active' : '' }}">
            <i class="bi bi-car-front"></i> Daftar Mobil & Harga
        </a>
        <a href="{{ route('admin.banner.index') }}"
           class="nav-link {{ request()->routeIs('admin.banner.*') ? 'active' : '' }}">
            <i class="bi bi-image"></i> Banner / Sampul
        </a>
        <a href="{{ route('admin.sales.index') }}"
           class="nav-link {{ request()->routeIs('admin.sales.*') ? 'active' : '' }}">
            <i class="bi bi-person-badge"></i> Profil Sales
        </a>
        <a href="{{ route('admin.partner.index') }}"
           class="nav-link {{ request()->routeIs('admin.partner.*') ? 'active' : '' }}">
            <i class="bi bi-building"></i> Partner Finance
        </a>

        <div class="nav-section">Pengaturan</div>
        <a href="{{ route('admin.pengaturan.index') }}"
           class="nav-link {{ request()->routeIs('admin.pengaturan.*') ? 'active' : '' }}">
            <i class="bi bi-gear-fill"></i> Kontak & Alamat
        </a>
    </div>
    </div>{{-- /#sidebar-nav --}}

    <div class="sidebar-footer">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm w-100 text-white" style="background:rgba(255,255,255,.15);">
                <i class="bi bi-box-arrow-left me-1"></i> Keluar
            </button>
        </form>
    </div>
</nav>

{{-- ── MAIN ── --}}
<div id="main">
    <div id="topbar">
        <h1 class="page-title">@yield('page-title', 'Admin')</h1>
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-sm btn-outline-secondary d-md-none" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <span class="text-muted small">{{ Auth::user()->name }}</span>
        </div>
    </div>

    <div class="content-area">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('sidebarToggle')?.addEventListener('click', () => {
        document.getElementById('sidebar').classList.toggle('open');
    });
</script>
@yield('scripts')
</body>
</html>
