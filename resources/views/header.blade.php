<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/hyundai-logo.png') }}">
    <title>@yield('title', 'Dealer Hyundai Makassar')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

    <header class="navbar navbar-expand-lg navbar-light py-3">
        <div class="container d-flex justify-space-between">
            <a href="{{ url('/') }}"><img src="{{ asset('images\LOGO-HYUNDAI.png') }}" alt="Gambar logo" class="img-fluid" style="max-height: 30px; object-fit: cover;" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link me-3" href="{{ url('/') }}">Beranda</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle me-3" href="#" id="tipeMobilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tipe Mobil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="tipeMobilDropdown">
                            <li><a class="dropdown-item" href="{{ url('/product/stargazer') }}">Hyundai STARGAZER</a></li>
                            <li><a class="dropdown-item" href="{{ url('/product/creta') }}">Hyundai CRETA</a></li>
                            <li><a class="dropdown-item" href="{{ url('/product/stargazer-x') }}">Hyundai STARGAZER X</a></li>
                            <li><a class="dropdown-item" href="{{ url('/product/hyundai-kona') }}">Hyundai KONA ELECTRIC</a></li>
                            <li><a class="dropdown-item" href="{{ url('/product/santa-fe') }}">Hyundai SANTA FE</a></li>
                            <li><a class="dropdown-item" href="{{ url('/product/staria') }}">Hyundai STARIA</a></li>
                            <li><a class="dropdown-item" href="{{ url('/product/ioniq-5') }}">Hyundai IONIQ 5</a></li>
                            <li><a class="dropdown-item" href="{{ url('/product/palisade') }}">Hyundai PALISADE</a></li>
                            <li><a class="dropdown-item" href="{{ url('/product/ioniq-6') }}">Hyundai IONIQ 6</a></li>
                            <li><a class="dropdown-item" href="{{ url('/product/all-new-santa-fe') }}">Hyundai ALL NEW SANTA FE</a></li>
                        </ul>
                    </li>                                        
                    <li class="nav-item"><a class="nav-link me-3" href="{{ url('/pricelist') }}">Pricelist</a></li>
                    <li class="nav-item"><a class="nav-link me-3" href="{{ url('/proses-kredit') }}">Proses Kredit</a></li>
                    <li class="nav-item"><a class="nav-link me-3" href="{{ url('/simulasi-kredit') }}">Simulasi Kredit</a></li>
                    <li class="nav-item"><a class="nav-link me-3" href="{{ url('/tes-drive') }}">Tes Drive</a></li>
                    <li class="nav-item"><a class="nav-link me-3" href="{{ url('/portofolio') }}">Portofolio</a></li>
                    <li class="nav-item"><a class="nav-link me-3" href="{{ url('/kontak') }}">Kontak</a></li>
                </ul>

                <button class="btn btn-outline-secondary ms-3" type="button" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <i class="bi bi-search"></i>
                </button>

                <a href="{{ url('/pricelist-download') }}" class="btn btn-unduh ms-3">Unduh Pricelist</a>
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
          
