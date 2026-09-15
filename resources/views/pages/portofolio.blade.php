@extends('layouts.app')

@section('title', 'Portofolio - Dealer Hyundai Makassar')

@section('content')
    <div class="page-hero">
        <img src="{{ asset('images/photo_2023-06-06_20-05-30.jpg') }}" alt="Portofolio" class="page-hero-image">
        <div class="page-hero-overlay"></div>
        <h1 class="page-hero-title">Portofolio</h1>
    </div>

    <div class="text-center full-bg pattern-bg gallery-section">
        <h2 class="heading-title gallery-heading">GALERI DEALER HYUNDAI MAKASSAR</h2>
        <p class="heading-subtitle gallery-subtitle">Segera konsultasikan harga mobil impian anda sekarang juga <strong>gratis</strong>.</p>
        <div class="swiper newSwiper">
            <div class="swiper-wrapper"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
@endsection
