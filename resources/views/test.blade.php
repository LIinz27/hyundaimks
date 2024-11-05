{{-- <!-- Bubble Head HTML -->
<div class="bubble-head" onclick="toggleDropup()">
    <i class="bi bi-chat-dots"></i> Hubungi Kami
</div>

<div class="dropup-content" id="dropup">
    <a href="https://wa.me/1234567890" target="_blank"><i class="bi bi-whatsapp"></i> WhatsApp</a>
    <a href="mailto:contact@example.com"><i class="bi bi-envelope"></i> Email</a>
    <a href="tel:+1234567890"><i class="bi bi-telephone"></i> Telepon</a>
</div>

<style>
    .bubble-head {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #1C4682;
        color: white;
        padding: 12px 20px;
        border-radius: 30px;
        font-size: 16px;
        font-weight: bold;
        display: flex;
        align-items: center;
        cursor: pointer;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
    }

    .bubble-head i {
        margin-right: 8px;
        font-size: 20px;
    }

    .dropup-content {
        display: none;
        position: fixed;
        bottom: 70px;
        right: 20px;
        background-color: #ffffff;
        color: #1C4682;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        padding: 10px 0;
        text-align: center;
    }

    .dropup-content a {
        color: #1C4682;
        padding: 10px 20px;
        text-decoration: none;
        display: block;
        font-weight: bold;
    }

    .dropup-content a:hover {
        background-color: #f1f1f1;
    }

    .dropup-content a i {
        margin-right: 5px;
    }
</style>

<script>
    function toggleDropup() {
        var dropup = document.getElementById("dropup");
        dropup.style.display = (dropup.style.display === "block") ? "none" : "block";
    }

    window.onclick = function(event) {
        var dropup = document.getElementById("dropup");
        var bubbleHead = document.querySelector(".bubble-head");
        if (event.target !== bubbleHead && !bubbleHead.contains(event.target)) {
            dropup.style.display = "none";
        }
    };
</script> --}}
@include('header')
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
                image: "/images/car/Hyundai-Stargazer.png",
                categories: ["mpv"]
            },
            {
                name: "HYUNDAI CRETA",
                price: "Rp297.000.000",
                image: "/images/car/Hyundai-Creta.png",
                categories: ["suv"]
            },
            {
                name: "HYUNDAI STARGAZER X",
                price: "Rp335.800.000",
                image: "/images/car/Stargazer-X.png",
                categories: ["mpv"]
            },
            {
                name: "HYUNDAI KONA ELECTRIC",
                price: "Rp297.000.000",
                image: "/images/car/Hyundai-kona.png",
                categories: ["eco"]
            },
            {
                name: "HYUNDAI SANTA FE",
                price: "Rp625.000.000",
                image: "/images/car/Hyundai-SANTA-Fe.png",
                categories: ["suv"]
            },
            {
                name: "HYUNDAI IONIQ 5",
                price: "Rp399.000.000",
                image: "/images/car/Hyundai-ioniq-5.png",
                categories: ["eco"]
            },
            {
                name: "ALL NEW SANTA FE",
                price: "Rp869.600.000",
                image: "/images/car/ALL-NEW-SANTA.png",
                categories: ["suv"]
            },
            {
                name: "HYUNDAI PALISADE",
                price: "Rp910.000.000",
                image: "/images/car/Hyundai-Palisade.png",
                categories: ["suv"]
            },
            {
                name: "HYUNDAI STARIA",
                price: "Rp924.000.000",
                image: "/images/car/Hyundai-Staria.png",
                categories: ["mpv"]
            },
            {
                name: "HYUNDAI IONIQ 6",
                price: "Rp1.220.000.000",
                image: "/images/car/Hyundai-IONIQ-6.png",
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
 @include('footer')