<div class="text-center mb-3" style="margin-top: 100px;">
    <h2 class="heading-title">Dealer Resmi Hyundai Mobil Indonesia</h2>
    <p class="heading-subtitle">Segera konsultasikan harga mobil impian anda sekarang juga <strong>gratis</strong>.</p>
</div>

    <ul class="nav nav-tabs justify-content-center mt-4" id="categoryTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="eco-tab" data-bs-toggle="tab" data-bs-target="#eco" type="button" role="tab" aria-controls="eco" aria-selected="false">Eco</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="suv-tab" data-bs-toggle="tab" data-bs-target="#suv" type="button" role="tab" aria-controls="suv" aria-selected="false">SUV</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="mpv-tab" data-bs-toggle="tab" data-bs-target="#mpv" type="button" role="tab" aria-controls="mpv" aria-selected="false">MPV</button>
        </li>
    </ul>

<!-- Tab content for Car Categories -->
    <div class="tab-content mt-4" id="categoryTabContent">
        <!-- All Category -->
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
            <div class="row justify-content-center" id="allCars"></div>
        </div>

        <!-- Eco Category -->
        <div class="tab-pane fade" id="eco" role="tabpanel" aria-labelledby="eco-tab">
            <div class="row justify-content-center" id="ecoCars"></div>
        </div>

        <!-- SUV Category -->
        <div class="tab-pane fade" id="suv" role="tabpanel" aria-labelledby="suv-tab">
            <div class="row justify-content-center" id="suvCars"></div>
        </div>

        <!-- MPV Category -->
        <div class="tab-pane fade" id="mpv" role="tabpanel" aria-labelledby="mpv-tab">
            <div class="row justify-content-center" id="mpvCars"></div>
        </div>
    </div>

<script>
    const cars = [
        {
            name: "HYUNDAI STARGAZER",
            price: "Rp249.600.000",
            image: "{{ asset('images/Hyundai-Stargazer.png') }}",
            categories: ["mpv"]
        },
        {
            name: "HYUNDAI CRETA",
            price: "Rp297.000.000",
            image: "{{ asset('images/Hyundai-Creta.png') }}",
            categories: ["suv"]
        },
        {
            name: "HYUNDAI STARGAZER X",
            price: "Rp335.800.000",
            image: "{{ asset('images/Stargazer-X.png') }}",
            categories: ["mpv"]
        },
        {
            name: "HYUNDAI KONA ELECTRIC",
            price: "Rp297.000.000",
            image: "{{ asset('images/Hyundai-kona.png') }}",
            categories: ["eco"]
        },
        {
            name: "HYUNDAI SANTA FE",
            price: "Rp625.000.000",
            image: "{{ asset('images/Hyundai-SANTA-Fe.png') }}",
            categories: ["suv"]
        },
        {
            name: "HYUNDAI IONIQ 5",
            price: "Rp399.000.000",
            image: "{{ asset('images/Hyundai-ioniq-5.png') }}",
            categories: ["eco"]
        },
        {
            name: "ALL NEW SANTA FE",
            price: "Rp869.600.000",
            image: "{{ asset('images/ALL-NEW-SANTA.png') }}",
            categories: ["suv"]
        },
        {
            name: "HYUNDAI PALISADE",
            price: "Rp910.000.000",
            image: "{{ asset('images/Hyundai-Palisade.png') }}",
            categories: ["suv"]
        },
        {
            name: "HYUNDAI STARIA",
            price: "Rp924.000.000",
            image: "{{ asset('images/Hyundai-Staria.png') }}",
            categories: ["mpv"]
        },
        {
            name: "HYUNDAI IONIQ 6",
            price: "Rp1.220.000.000",
            image: "{{ asset('images/Hyundai-IONIQ-6.png') }}",
            categories: ["eco"]
        }
    ];

    function displayCars() {
        document.getElementById('allCars').innerHTML = '';
        document.getElementById('ecoCars').innerHTML = '';
        document.getElementById('suvCars').innerHTML = '';
        document.getElementById('mpvCars').innerHTML = '';

        cars.forEach(car => {
            const carCard = `
                <div class="col-md-4 col-lg-4 mb-4 d-flex align-items-stretch">
                    <div class="card text-center">
                        <img src="${car.image}" class="card-img-top car-image" alt="${car.name}">
                        <div class="card-body">
                            <h5 class="card-title font-weight-semibold">${car.name}</h5>
                            <p class="card-text">${car.price}</p>
                        </div>
                        <a href="#" class="btn btn-primary btn-full">Selengkapnya</a>
                    </div>
                </div>
            `;

            document.getElementById('allCars').innerHTML += carCard;
            car.categories.forEach(category => {
                document.getElementById(category + 'Cars').innerHTML += carCard;
            });
        });
    }

    document.addEventListener('DOMContentLoaded', displayCars);
</script>

<style>


    .heading-title {
        font-family: 'Manrope';
        font-size: 30px;
        font-weight: 600;
    }

    .heading-subtitle {
        font-family: 'Manrope';
        font-size: 15px;
    }

    .nav-tabs .nav-item .nav-link {
        background-color: #ffffff;
        border: 1px solid #ddd;
        color: #1C4682;
        padding: 10px 20px;
        margin: 0 5px;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

    .nav-tabs .nav-item .nav-link.active {
        background-color: #1C4682;
        color: #ffffff;
        border-color: #1C4682;
    }

    .nav-tabs .nav-item .nav-link:hover {
        background-color: #0056b3;
        color: black;
    }

    .tab-content {
        margin-top: 20px;
    }

    .card {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-title {
        font-weight: 600;
    }

    .card-text {
        font-size: 18px;
        font-weight: bold;
    }

    .card .btn-full {
        width: 80%;
        background-color: #1C4682;
        border: none;
        border-top: 1px solid #eee;
        font-size: 16px;
        display: flex;
        justify-content: center;
        margin: 0 auto 5%;
    }

    .car-image {
        transition: transform 0.3s ease;
    }

    .car-image:hover {
        transform: scale(1.2);
    }
</style>
