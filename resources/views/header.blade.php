<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dealer Hyundai Makassar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS untuk menampilkan dropdown pada hover */
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }
    </style>
</head>
<body>

    <header class="navbar navbar-expand-lg navbar-light bg-light py-3">
        <div class="container d-flex justify-content-center">
            <a class="navbar-brand me-auto" href="{{ url('/') }}">Dealer Hyundai Makassar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link me-4" href="{{ url('/') }}">Beranda</a>
                    </li>

                    <!-- Dropdown Tipe Mobil dengan Hover -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle me-4" href="#" id="tipeMobilDropdown" role="button" aria-expanded="false">
                            Tipe Mobil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="tipeMobilDropdown">
                            <li><a class="dropdown-item" href="{{ url('/product/stargazer') }}">Hyundai STARGAZER</a></li>
                            <li><a class="dropdown-item" href="{{ url('/product/creta') }}">Hyundai CRETA</a></li>
                            <li><a class="dropdown-item" href="{{ url('/product/stargazer-x') }}">Hyundai STARGAZER X</a></li>
                            <li><a class="dropdown-item" href="{{ url('/product/kona-electric') }}">Hyundai KONA ELECTRIC</a></li>
                            <li><a class="dropdown-item" href="{{ url('/product/santa-fe') }}">Hyundai SANTA FE</a></li>
                            <li><a class="dropdown-item" href="{{ url('/product/ioniq-5') }}">Hyundai IONIQ 5</a></li>
                            <li><a class="dropdown-item" href="{{ url('/product/palisade') }}">Hyundai PALISADE</a></li>
                            <li><a class="dropdown-item" href="{{ url('/product/ioniq-6') }}">Hyundai IONIQ 6</a></li>
                            <li><a class="dropdown-item" href="{{ url('/product/all-new-santa-fe') }}">Hyundai ALL NEW SANTA FE</a></li>
                        </ul>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link me-4" href="{{ url('/pricelist') }}">Pricelist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-4" href="{{ url('/proses-kredit') }}">Proses Kredit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-4" href="{{ url('/simulasi-kredit') }}">Simulasi Kredit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-4" href="{{ url('/tes-drive') }}">Tes Drive</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-4" href="{{ url('/portofolio') }}">Portofolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-4" href="{{ url('/kontak') }}">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
