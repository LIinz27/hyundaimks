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

        <!-- Contact -->
        <div class="text-center mb-3 contact-bg d-flex align-items-center justify-content-center">
            <div class="contact-container d-flex align-items-center justify-content-center">
                <div class="contact-image">
                    <img class="rounded-2 img-fluid" src="{{ asset('images/Fadli-Kuntuls.jpg') }}" alt="Hyundai Creta Feature">
                </div>
                <div class="contact-text">
                    <h3>Rukman Fadli</h3>
                    <p>Profesional Sales Consultant</p>
                    <ul class="contact-details">
                        <li>Melayani tukar tambah mobil lama dengan harga tinggi.</li>
                        <li>Layanan Chat 24 Jam Fast Respon.</li>
                        <li>Bisa konsultasi langsung ke dealer kami dengan finance langsung.</li>
                        <li>Survey dibantu sampai approval.</li>
                    </ul>
                    <div class="button-group">
                        <button class="wa-button">
                            <i class="bi bi-whatsapp"></i> <strong>0896-1688-0688</strong>
                        </button>
                        <button class="contact-button">
                            <i class="bi bi-telephone-fill"></i> <strong>0896-1688-0688</strong>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
