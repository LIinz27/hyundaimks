@php
    use Illuminate\Support\Facades\Storage;
@endphp

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
                <a href="{{ sales_route('pricelist') }}" class="btn btn-brand btn-lg px-5">Klik di sini</a>
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

        <!-- Profil Sales Aktif -->
        @php
            $photoUrl = $sales->photo_path ? Storage::disk('public')->url($sales->photo_path) : null;
            $initials = strtoupper(mb_substr($sales->name, 0, 1));
            $waLink = $sales->whatsappLink();
            $phoneLink = $sales->phoneLink();
        @endphp
        <div class="container mt-5 mb-4">
            <div class="home-profile text-center">
                @if ($photoUrl)
                    <img src="{{ $photoUrl }}" alt="Foto profil {{ $sales->name }}" class="home-profile-photo">
                @else
                    <div class="avatar-fallback home-profile-photo" aria-hidden="true">{{ $initials }}</div>
                @endif
                <span class="sales-badge">Sales Resmi Hyundai Makassar</span>
                <h2 class="home-profile-name">{{ $sales->name }}</h2>
                @if ($sales->title)
                    <p class="home-profile-title">{{ $sales->title }}</p>
                @endif
                @if ($sales->bio)
                    <p class="home-profile-bio">{{ $sales->bio }}</p>
                @endif
                @if ($waLink || $phoneLink)
                    <div class="home-profile-contact">
                        @if ($waLink)
                            <a href="{{ $waLink }}" target="_blank" rel="noopener" class="btn btn-success btn-whatsapp"
                               aria-label="Hubungi {{ $sales->name }} via WhatsApp">
                                <i class="bi bi-whatsapp" aria-hidden="true"></i> WhatsApp
                            </a>
                        @endif
                        @if ($phoneLink)
                            <a href="{{ $phoneLink }}" class="btn btn-outline-primary"
                               aria-label="Telepon {{ $sales->name }}">
                                <i class="bi bi-telephone-fill" aria-hidden="true"></i> Telepon
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection
