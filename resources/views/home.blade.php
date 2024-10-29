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

        <!-- Navigation buttons for categories -->
        <div class="text-center mt-4">
            <div class="btn-group" role="group" aria-label="Category Navigation">
                <button type="button" class="btn btn-outline-primary">All</button>
                <button type="button" class="btn btn-outline-primary">Eco</button>
                <button type="button" class="btn btn-outline-primary">SUV</button>
                <button type="button" class="btn btn-outline-primary">MPV</button>
            </div>
        </div>
    </div>
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
</style>
@include('footer')
