@extends('layouts.app')

@section('title', $car['title'])

@section('content')
    <!-- Carousel -->
    <section class="product-hero">
        <div id="carCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @for ($i = 1; $i <= $car['slides']; $i++)
                    <div class="carousel-item {{ $i === 1 ? 'active' : '' }}">
                        <img src="{{ asset('images/car/' . $car['folder'] . '/' . $i . '.png') }}"
                             class="d-block mx-auto car-slide-img" alt="{{ $car['name'] }} - gambar {{ $i }}">
                    </div>
                @endfor
            </div>

            @if ($car['slides'] > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#carCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @endif
        </div>
    </section>

    <!-- Harga & Promo -->
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center g-4">
            <div class="col-lg-5 col-md-6">
                <div class="product-info-card">
                    <h4 class="product-info-title">
                        Daftar Harga Terupdate {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
                    </h4>
                    <p class="mb-4">*Harga tertera dapat berubah sewaktu-waktu. Klik Unduh Pricelist untuk melihat pricelist terbaru.</p>

                    <div class="d-flex flex-wrap gap-3">
                        @if (active_sales()?->whatsappLink())
                            <a href="{{ active_sales()->whatsappLink() }}" target="_blank" rel="noopener"
                               class="btn btn-brand d-inline-flex align-items-center">
                                <i class="bi bi-whatsapp me-2"></i> Info Promo
                            </a>
                        @endif
                        <a href="{{ sales_route('pricelist') }}" class="btn btn-brand-light d-inline-flex align-items-center">
                            <i class="bi bi-file-earmark-arrow-down-fill me-2"></i> Unduh Pricelist
                        </a>
                        <a href="{{ sales_route('simulasi-kredit') }}" class="btn btn-dark d-inline-flex align-items-center">
                            <i class="bi bi-credit-card me-2"></i> Simulasi Kredit
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-6">
                <div class="product-info-card">
                    <h4 class="product-info-title">
                        Promo Khusus {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
                    </h4>
                    <div class="d-flex flex-column gap-4 mt-3">
                        @if (active_sales()?->whatsappLink())
                            <a href="{{ active_sales()->whatsappLink() }}" target="_blank" rel="noopener"
                               class="btn btn-brand fw-bold px-4 py-3">
                                <i class="bi bi-whatsapp"></i> Dapatkan Promonya! Klik disini.
                            </a>
                        @endif
                        <a href="#" class="btn btn-dark fw-bold px-4 py-3">
                            <i class="bi bi-download"></i> Unduh E-Brosur {{ $car['brochure'] }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Benefit -->
    <div class="benefit-section">
        <div class="benefit-container">
            <ul class="benefit-list">
                <h3 class="benefit-heading">{{ $car['benefit'] }}</h3>
                <li>Transaksi online aman 100%</li>
                <li>Melayani cash, kredit, tukar tambah atau COP kantor</li>
                <li>Data & BI CHECKING dibantu sampai approve</li>
                <li>Unit Ready Stok</li>
                <li>Free home test drive & fast respond 24 jam</li>
                <li>Jika ditolak leasing uang kembali 100%</li>
            </ul>

            <ul class="bonus-list">
                <h3 class="bonus-heading">Free Bonus Aksesoris</h3>
                <li>Kaca Film Smith</li>
                <li>Karpet Original Bludru</li>
                <li>Mini Alat Pemadam</li>
                <li>Segitiga Pengaman</li>
                <li>Kotak P3K</li>
                <li>Lisensi Plat</li>
                <li>Merchandise Hyundai</li>
            </ul>

            <ul class="after-sales-list">
                <h3 class="after-sales-heading">Program After Sales Terbaik</h3>
                <li>Waranty 3 Tahun /100.000KM</li>
                <li>Free Jasa Service 5 Tahun /75.000KM</li>
                <li>Trade In All Merk</li>
                <li>Best Service</li>
            </ul>
        </div>
    </div>

    <!-- Spesifikasi -->
    <div class="container mt-5">
        <div class="spec-section">
            @php $offset = 0; @endphp
            @foreach (config('cars.spec_groups') as $group => $labels)
                <h3 class="spec-heading">{{ $group }}</h3>
                <table class="table table-bordered spec-table">
                    <tbody>
                        @foreach ($labels as $label)
                            <tr>
                                <th scope="row">{{ $label }}</th>
                                <td>{{ $car['specs'][$offset] ?? '' }}</td>
                            </tr>
                            @php $offset++; @endphp
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>
    </div>

    <!-- Video -->
    <div class="text-center full-bg video-section">
        <h2 class="heading-title video-heading">{{ $car['video']['heading'] }}</h2>
        <div class="video-frame">
            <iframe src="{{ $car['video']['url'] }}" title="{{ $car['video']['caption'] }}"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    </div>

    <!-- Test Drive -->
    <div class="text-center mb-3 full-bg d-flex align-items-center justify-content-center">
        <div class="content-container d-flex align-items-center justify-content-center">
            <div class="image-container">
                <img class="rounded-2 img-fluid" src="{{ asset('images/hyundai-creta-fitur-5.webp') }}" alt="Hyundai Creta Feature">
            </div>
            <div class="text-container">
                <h3>Test Drive Hyundai</h3>
                <p>Yuk Test Drive Sebelum Membeli, Rasakan Pengalaman Mengendarai <strong>Mobil Hyundai</strong>, Ajak Serta Keluarga Anda.</p>
                @if (active_sales()?->whatsappLink())
                    <a href="{{ active_sales()->whatsappLink() }}" target="_blank" rel="noopener"
                       class="testdrive-button text-decoration-none d-inline-block">
                        <i class="bi bi-whatsapp"></i> Daftar Test Drive
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
