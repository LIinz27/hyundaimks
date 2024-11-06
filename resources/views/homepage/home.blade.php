@include('header')

<div class="container-fluid mt-4">
    <div class="text-center mb-4">
        <img src="{{ asset('images/SAMPUL-WEB-1.png') }}" alt="Gambar Sampul" class="img-fluid rounded w-100" style="max-height: 600px; object-fit: cover;" />
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
            <button class="btn btn-primary" style="background-color: #1C4682; border: none; padding: 15px 40px; font-size: 16px;">Klik di sini</button>
        </div>
    </div>

@include('homepage/card')

<div class="text-center mb-3 full-bg" style="margin-top: 100px; background-image: url('{{ asset('images/white-background-with-triangle-patterns_1017-18410.jpg') }}'); background-size: cover; background-position: center;">
    <h2 class="heading-title" style="font-size: 35px; font-weight: bolder; margin-bottom: 50px; margin-top: 30px">GALERI DEALER HYUNDAI MAKASSAR</h2>
    <p class="heading-subtitle" style="margin-bottom: 60px;">Segera konsultasikan harga mobil impian anda sekarang juga <strong>gratis</strong>.</p> 
    <div class="swiper newSwiper">
        <div class="swiper-wrapper"></div>
        <div class="swiper-pagination"></div>
    </div>    
</div>


@include('homepage/benefit')

<div class="container mt-4 ">
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
            <img style="border-radius: 2%" src="{{ asset('images/Fadli-Kuntuls.jpg') }}" alt="Hyundai Creta Feature" class="img-fluid">
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

@include('footer')
