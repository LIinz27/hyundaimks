@section('title', 'Portofolio - Dealer Hyundai Makassar')
@include('header')

<div class="position-relative">
    <img src="{{ asset('images/photo_2023-06-06_20-05-30.jpg') }}" alt="Syarat Kredit" class="img-fluid w-100" style="height: 230px; object-fit: cover;">
    
    <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(28, 70, 130, 0.8);"></div>
    
    <h1 class="position-absolute top-50 text-white fw-bold" style="left: 10%; transform: translateY(-50%);">Portofolio</h1>
</div>

<div class="text-center full-bg mt-0" style="margin-top: 100px; background-image: url('{{ asset('images/white-background-with-triangle-patterns_1017-18410.jpg') }}'); background-size: cover; background-position: center;">
    <h2 class="heading-title" style="font-size: 35px; font-weight: bolder; margin-bottom: 50px; margin-top: 30px">GALERI DEALER HYUNDAI MAKASSAR</h2>
    <p class="heading-subtitle" style="margin-bottom: 60px;">Segera konsultasikan harga mobil impian anda sekarang juga <strong>gratis</strong>.</p> 
    <div class="swiper newSwiper">
        <div class="swiper-wrapper"></div>
        <div class="swiper-pagination"></div>
    </div>    
</div>

<script>
const galleryImages = [];
        const galleryImageCount = 7;

        for (let i = 1; i <= galleryImageCount; i++) {
            galleryImages.push(`/images/Galeri/Galeri-Hyundai-${i}.png`);
        }

        function displayGalleryImages() {
            const gallerySwiperWrapper = document.querySelector('.newSwiper .swiper-wrapper');
            if (!gallerySwiperWrapper) return; 
            gallerySwiperWrapper.innerHTML = '';

            galleryImages.forEach((image, index) => {
                const slide = document.createElement('div');
                slide.classList.add('swiper-slide');
                slide.innerHTML = `<img src="${image}" alt="Slide ${index + 1}" class="img-fluid">`;
                gallerySwiperWrapper.appendChild(slide);
            });

            new Swiper(".newSwiper", {
                autoplay: {
                    delay: 3000, 
                    disableOnInteraction: false,
                },
                loop: true,
                slidesPerView: 3,
                spaceBetween: 40, 
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    },
                    480: {
                        slidesPerView: 2,
                        spaceBetween: 30
                    },
                    640: {
                        slidesPerView: 3,
                        spaceBetween: 40
                    }
                }
            });
        }
        document.addEventListener('DOMContentLoaded', displayGalleryImages);
</script>

@include('footer')