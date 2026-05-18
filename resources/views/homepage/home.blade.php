@include('header')

<div class="container-fluid mt-4">
    <div class="text-center mb-4">
        @php $bannerSrc = $banner ? asset($banner->filename) : asset('images/SAMPUL-WEB-1.png'); @endphp
        <img src="{{ $bannerSrc }}" alt="Gambar Sampul" class="img-fluid rounded w-100" style="max-height: 600px; object-fit: cover; margin-top: 5%;" />
    </div>

    <div class="container mt-4">
        <h2 class="text-center mb-5">{{ $siteSettings['judul_promo'] ?? 'Promo Terbaru 2024' }}</h2>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper"></div>
            <div class="swiper-pagination"></div>              
        </div>
        <div class="text-center mt-4">
            <a href="https://wa.me/{{ preg_replace('/\D/', '', $siteSettings['whatsapp'] ?? '6281242906882') }}?text=Halo%2C%20saya%20tertarik%20dengan%20promo%20Hyundai%20Makassar" target="_blank" class="btn btn-primary" style="background-color: #1C4682; border: none; padding: 15px 40px; font-size: 16px;">Klik di sini</a>
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
@if ($salesProfile)
<div class="text-center mb-3 contact-bg d-flex align-items-center justify-content-center">
    <div class="contact-container d-flex align-items-center justify-content-center">
        <div class="contact-image">
            <img style="border-radius: 2%" src="{{ asset('images/' . $salesProfile->foto) }}" alt="{{ $salesProfile->nama }}" class="img-fluid">
        </div>
        <div class="contact-text">
            <h3>{{ $salesProfile->nama }}</h3>
            <p>{{ $salesProfile->jabatan }}</p>
            <ul class="contact-details">
                @foreach ($salesProfile->keunggulan ?? [] as $poin)
                    <li>{{ $poin }}</li>
                @endforeach
            </ul>
            <div class="button-group">
                <button class="wa-button" onclick="window.open('https://wa.me/62{{ ltrim($salesProfile->whatsapp, '0') }}','_blank')">
                    <i class="bi bi-whatsapp"></i> <strong>{{ $salesProfile->whatsapp }}</strong>
                </button>
                <button class="contact-button" onclick="window.location.href='tel:{{ $salesProfile->telepon }}'">
                    <i class="bi bi-telephone-fill"></i> <strong>{{ $salesProfile->telepon }}</strong>
                </button>
            </div>
        </div>
    </div>
</div>
@endif

<script>
window._galleryImages  = {!! json_encode($galeriImages) !!};
window._cars           = {!! json_encode($cars) !!};
window._promoImages    = {!! json_encode($promoImages) !!};
window._partnerImages  = {!! json_encode($partnerImages) !!};
</script>

@include('footer')
