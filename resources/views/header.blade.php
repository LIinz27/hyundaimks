<header class="navbar navbar-expand-lg navbar-light py-3" id="header">
    <div class="container">
        <a href="{{ sales_url('/') }}" class="navbar-brand">
            <img src="{{ asset('images/LOGO-HYUNDAI.png') }}" alt="Hyundai Makassar" class="site-logo img-fluid">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="{{ sales_url('/') }}">Beranda</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="tipeMobilDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Tipe Mobil
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="tipeMobilDropdown">
                        @foreach (config('cars.cars') as $car)
                            <li><a class="dropdown-item" href="{{ sales_url('/product/' . $car['slug']) }}">{{ $car['name'] }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ sales_route('pricelist') }}">Pricelist</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ sales_route('proses-kredit') }}">Proses Kredit</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ sales_route('simulasi-kredit') }}">Simulasi Kredit</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ sales_route('tes-drive') }}">Tes Drive</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ sales_route('portofolio') }}">Portofolio</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ sales_route('kontak') }}">Kontak</a></li>
            </ul>

            <button class="btn btn-outline-secondary ms-lg-3" type="button" data-bs-toggle="modal" data-bs-target="#searchModal" aria-label="Cari">
                <i class="bi bi-search"></i>
            </button>

            <a href="{{ sales_route('pricelist') }}" class="btn btn-unduh ms-lg-3">Unduh Pricelist</a>
        </div>
    </div>
</header>

<div class="modal fade search-modal" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">Pencarian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Cari" aria-label="Search">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </form>
            </div>
        </div>
    </div>
</div>
