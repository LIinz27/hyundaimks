@include('header')

<div class="container-fluid mt-4">
    <div class="text-center mb-4">
        <img src="{{ asset('images/SAMPUL-WEB-1.png') }}" alt="Gambar Sampul" class="img-fluid rounded w-100" style="max-height: 600px; object-fit: cover;" />
    </div>

    <div class="container mt-4">
        <h2 class="text-center mb-5">Promo Terbaru 2024</h2>

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

@include('card')

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
        margin: 0 auto;
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
</style>


@include('footer')
