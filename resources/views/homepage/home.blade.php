@extends('layouts.app')

@section('title', 'Dealer Hyundai Makassar')

@section('content')
    <div class="container-fluid mt-4">
        <div class="text-center mb-4">
            <img src="{{ asset('images/SAMPUL-WEB-1.png') }}" alt="Gambar Sampul" class="img-fluid rounded w-100 hero-cover">
        </div>

        <div class="container mt-4">
            <h2 class="text-center mb-5">Promo Terbaru 2024</h2>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <!-- Konten gambar Untuk Promo -->
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ url('/pricelist') }}" class="btn btn-brand btn-lg px-5">Klik di sini</a>
            </div>
        </div>

        @include('homepage/card')

        <div class="text-center mb-3 full-bg gallery-section">
            <h2 class="heading-title gallery-heading">GALERI DEALER HYUNDAI MAKASSAR</h2>
            <p class="heading-subtitle gallery-subtitle">Segera konsultasikan harga mobil impian anda sekarang juga <strong>gratis</strong>.</p>
            <div class="swiper newSwiper">
                <div class="swiper-wrapper"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        @include('homepage/benefit')

        <div class="container mt-4">
            <h2 class="text-center mb-5">OUR PARTNER FINANCE & LEASING</h2>
            <p class="text-center">Segera konsultasikan harga mobil impian anda sekarang juga <strong>gratis</strong>.</p>
            <div class="swiper PartnerSwiper">
                <div class="swiper-wrapper" id="imageContainer"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <!-- Tim Sales -->
        @if ($salesList->isNotEmpty())
            <div class="container mt-5 mb-4 sales-team-section">
                <h2 class="text-center mb-2">TIM SALES KAMI</h2>
                <p class="text-center text-muted mb-4">Hubungi sales resmi kami untuk konsultasi gratis.</p>
                <div class="row g-4 {{ $salesList->count() === 1 ? 'justify-content-center sales-team-single' : '' }}">
                    @foreach ($salesList as $sales)
                        @include('homepage/sales-card', ['sales' => $sales])
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
