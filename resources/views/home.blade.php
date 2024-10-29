<!-- resources/views/home.blade.php -->

@include('header')


<div class="container-fluid mt-4">
    <div class="text-center mb-4">
        <img src="{{ asset('images/SAMPUL-WEB-1.png') }}" alt="Gambar Sampul" class="img-fluid rounded w-100" style="max-height: 600px; object-fit: cover;" />
    </div>

    <div class="container mt-4">
        <h2 class="text-center mb-5">Promo Terbaru 2024</h2>

        <!-- Carousel Promo Cards -->
        <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="d-flex justify-content-center">
                        <div class="card mx-3" style="width: 18rem;">
                            <img src="{{ asset('images/IMG-20240911-WA0001.jpg') }}" class="card-img-top" alt="Hyundai Palisade">
                        </div>
                        <div class="card mx-3" style="width: 18rem;">
                            <img src="{{ asset('images/IMG-20240911-WA0002.jpg') }}" class="card-img-top" alt="Hyundai Creta">
                        </div>
                        <div class="card mx-3" style="width: 18rem;">
                            <img src="{{ asset('images/IMG-20240911-WA0004.jpg') }}" class="card-img-top" alt="Hyundai Santa Fe">
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="d-flex justify-content-center">
                        <div class="card mx-3" style="width: 18rem;">
                            <img src="{{ asset('images/IMG-20240911-WA0005.jpg') }}" class="card-img-top" alt="Hyundai Santa Fe">
                        </div>
                        <div class="card mx-3" style="width: 18rem;">
                            <img src="{{ asset('images/IMG-20240911-WA0006.jpg') }}" class="card-img-top" alt="Hyundai Stargazer">
                        </div>
                        <div class="card mx-3" style="width: 18rem;">
                            <img src="{{ asset('images/IMG-20240911-WA0008.jpg') }}" class="card-img-top" alt="Hyundai Kona Electric">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    @include('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
