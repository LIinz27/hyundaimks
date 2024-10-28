<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dealer Hyundai Makassar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <li class="nav-item">
                        <a class="nav-link me-4" href="{{ url('/models') }}">Tipe Mobil</a>
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
