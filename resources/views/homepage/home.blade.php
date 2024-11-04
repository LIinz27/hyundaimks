@include('header')

<div class="container-fluid mt-4">
    <div class="text-center mb-4">
        <img src="{{ asset('images/SAMPUL-WEB-1.png') }}" alt="Gambar Sampul" class="img-fluid rounded w-100" style="max-height: 600px; object-fit: cover;" />
    </div>

    <div class="container mt-4">
        <h2 class="text-center mb-5">Promo Terbaru 2024</h2>
<!-- Buat perulangan -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('images/IMG-20240911-WA0001.jpg') }}" alt="Slide Image" class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/IMG-20240911-WA0002.jpg') }}" alt="Slide Image" class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/IMG-20240911-WA0004.jpg') }}" alt="Slide Image" class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/IMG-20240911-WA0005.jpg') }}" alt="Slide Image" class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/IMG-20240911-WA0006.jpg') }}" alt="Slide Image" class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/IMG-20240911-WA0008.jpg') }}" alt="Slide Image" class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/IMG-20240911-WA0009.jpg') }}" alt="Slide Image" class="img-fluid">
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="text-center mt-4">
            <button class="btn btn-primary" style="background-color: #1C4682; border: none; padding: 15px 40px; font-size: 16px;">Klik di sini</button>
        </div>

        

<style>
    .swiper {
        width: 90%;
        height: 90%;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .swiper-pagination {
        bottom: 10px;
    }

    .swiper-pagination-bullet {
        background: #8f8e8e;
    }

    .swiper-pagination-bullet-active {
        background: #000000;
    }

    .btn-group .btn.active {
        background-color: #1C4682;
        color: white;
    }

</style>

@include('homepage/card')

<div class="text-center mb-3 full-bg" style="margin-top: 100px; background-image: url('{{ asset('images/white-background-with-triangle-patterns_1017-18410.jpg') }}'); background-size: cover; background-position: center;">
    <h2 class="heading-title" style="font-size: 35px; font-weight: bolder; margin-bottom: 50px; margin-top: 30px">GALERI DEALER HYUNDAI MAKASSAR</h2>
    <p class="heading-subtitle" style="margin-bottom: 60px;">Segera konsultasikan harga mobil impian anda sekarang juga <strong>gratis</strong>.</p> 

    <div class="swiper newSwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="{{ asset('images/Galeri-Hyundai-1.png') }}" alt="Slide 1" class="img-fluid">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/Galeri-Hyundai-2.png') }}" alt="Slide 2" class="img-fluid">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/Galeri-Hyundai-3.png') }}" alt="Slide 3" class="img-fluid">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/Galeri-Hyundai-4.png') }}" alt="Slide 4" class="img-fluid">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/Galeri-Hyundai-5.png') }}" alt="Slide 5" class="img-fluid">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/Galeri-Hyundai-6.png') }}" alt="Slide 6" class="img-fluid">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/Galeri-Hyundai-7.png') }}" alt="Slide 7" class="img-fluid">
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>

<style>
    .full-bg {
        width: 100vw;
        margin-left: calc(50% - 50vw); 
        padding: 20px 0;
    }

    .newSwiper {
        width: 75%;
        height: 80%;
        background-color: #ffffff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .newSwiper .swiper-slide {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 20px;
    }

    .newSwiper .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 15px; 
    }
        body {
        overflow-x: hidden;
    }
</style>

@include('homepage/benefit')

<div class="container mt-4 ">
    <h2 class="text-center mb-5">OUR PARTNER FINANCE & LEASING</h2>
    <p class="text-center">Segera konsultasikan harga mobil impian anda sekarang juga <strong>gratis</strong>.</p>
    
    <div class="swiper PartnerSwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="{{ asset('images/LOGO-BAF.jpg') }}" alt="Slide 1" class="img-fluid finance-logo">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/LOGO-BCA-FINANCE-1.jpg') }}" alt="Slide 2" class="img-fluid finance-logo">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/LOGO-BRI-FINANCE.jpg') }}" alt="Slide 3" class="img-fluid finance-logo">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/LOGO-CIMB-FINANCE.jpg') }}" alt="Slide 4" class="img-fluid finance-logo">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/LOGO-CLIPAN-FINANCE.jpg') }}" alt="Slide 5" class="img-fluid finance-logo">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/LOGO-IMFI.jpg') }}" alt="Slide 6" class="img-fluid finance-logo">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/LOGO-INDOMOBIL-FINANCE.jpg') }}" alt="Slide 7" class="img-fluid finance-logo">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/LOGO-MAF-1.jpg') }}" alt="Slide 8" class="img-fluid finance-logo">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/LOGO-MANDIRI-TUNAS-FINANCE.jpg') }}" alt="Slide 9" class="img-fluid finance-logo">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/LOGO-MAYBANK-1.jpg') }}" alt="Slide 10" class="img-fluid finance-logo">
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>

<style>
    .PartnerSwiper {
        width: 100%;
        height: 80%;
        margin-top: 5%
    }

    .PartnerSwiper .swiper-slide {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .PartnerSwiper .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .finance-logo {
        border: 2px solid #000;
        width: 100%;
        height: 100%;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .swiper-pagination {
        bottom: 10px;
    }

    .swiper-pagination-bullet {
        background: #8f8e8e;
    }

    .swiper-pagination-bullet-active {
        background: #000000;
    }
</style>

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

<!-- Contact CSS -->
<style>
    .contact-bg {
        padding: 40px 0;
    }

    .contact-container {
        max-width: 1200px;
        display: flex;
        gap: 20px;
    }

    .contact-image {
        flex: 1;
        text-align: left;
        margin: 3%;
        border: 3px #163b5a solid;
        border-radius: 2%;
    }

    .contact-text {
        flex: 1;
        text-align: left;
        color: #333;
    }

    .contact-text h3 {
        font-size: 42px;
        font-weight: bolder;
        color: #163b5a;
        margin-bottom: 5%;
    }

    .contact-text p {
        font-size: 28px;
        font-weight: 700;
        color: #163b5a;
        margin-bottom: 10%;
    }

    .contact-details {
        list-style-type: disc;
        padding-left: 20px;
        margin-bottom: 10%;
        font-weight: 700;
    }

    .button-group {
        display: flex;
        gap: 10px; 
    }

    .wa-button {
        display: inline-flex;
        align-items: center;
        background-color: #1C4682;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        padding: 10px 60px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 5%;
    }

    .wa-button i {
        font-size: 1.2rem;
        margin-right: 8px;
    }

    .wa-button:hover {
        background-color: #163b5a;
    }

    .contact-button {
        display: inline-flex;
        align-items: center;
        background-color: #fff;
        color: #163b5a;
        border: 2px solid #163b5a;
        border-radius: 5px;
        padding: 10px 60px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 5%;
    }

    .contact-button i {
        font-size: 1.2rem;
        margin-right: 8px;
    }

    .contact-button:hover {
        background-color: #000;
        color: #fff;
    }
</style>



@include('footer')
