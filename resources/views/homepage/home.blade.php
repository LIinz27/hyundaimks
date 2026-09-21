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
                @if($galeris->isEmpty())
                    <div class="gallery-empty-frame">
                        Upload foto galeri Anda
                    </div>
                @else
                <div class="swiper-wrapper">
                    @foreach($galeris as $g)
                        <div class="swiper-slide">
                            {{-- Slide pertama dimuat langsung (terlihat tanpa
                                 digeser); sisanya lazy supaya gambar 7 foto
                                 tidak diminta sekaligus di awal. --}}
                            <img src="{{ Storage::disk('public')->url($g->image_path) }}"
                                 alt="{{ $g->caption }}"
                                 class="img-fluid"
                                 width="1080" height="1920"
                                 @if($loop->first) fetchpriority="high" @else loading="lazy" @endif
                                 decoding="async">
                        </div>
                    @endforeach
                </div>
                @endif
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

        <!-- Profil Sales Aktif — layout & CSS original (foto kiri, teks kanan) -->
        @php
            $waLink = $sales->whatsappLink();
            $phoneLink = $sales->phoneLink();
            // Label diambil dari kolomnya masing-masing: whatsapp dan phone bisa
            // berbeda, dan keduanya dapat diubah dari panel.
            $waLabel = $sales->whatsapp ?: '0896-1688-0688';
            $phoneLabel = $sales->phone ?: '0896-1688-0688';
        @endphp
        <div class="text-center mb-3 contact-bg d-flex align-items-center justify-content-center">
            <div class="contact-container d-flex align-items-center justify-content-center">
                <div class="contact-image">
                    @if ($sales->photo_path)
                        <img style="border-radius: 2%" src="{{ Storage::disk('public')->url($sales->photo_path) }}"
                             alt="Foto {{ $sales->name }}" class="img-fluid">
                    @else
                        <div class="contact-image-empty">Upload foto Anda</div>
                    @endif
                </div>
                <div class="contact-text">
                    <h3>{{ $sales->name }}</h3>
                    <p>{{ $sales->title ?: 'Profesional Sales Consultant' }}</p>
                    <ul class="contact-details">
                        <li>Melayani tukar tambah mobil lama dengan harga tinggi.</li>
                        <li>Layanan Chat 24 Jam Fast Respon.</li>
                        <li>Bisa konsultasi langsung ke dealer kami dengan finance langsung.</li>
                        <li>Survey dibantu sampai approval.</li>
                    </ul>
                    <div class="button-group">
                        @if ($waLink)
                            <a class="wa-button text-decoration-none" href="{{ $waLink }}"
                               target="_blank" rel="noopener"
                               aria-label="Hubungi {{ $sales->name }} via WhatsApp"
                               style="text-decoration: none;">
                                <i class="bi bi-whatsapp" aria-hidden="true"></i>&nbsp;<strong>{{ $waLabel }}</strong>
                            </a>
                        @endif
                        @if ($phoneLink)
                            <a class="contact-button text-decoration-none" href="{{ $phoneLink }}"
                               aria-label="Telepon {{ $sales->name }}"
                               style="text-decoration: none;">
                                <i class="bi bi-telephone-fill" aria-hidden="true"></i>&nbsp;<strong>{{ $phoneLabel }}</strong>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
