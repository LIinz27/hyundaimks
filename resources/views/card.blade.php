<!-- Navigation buttons for categories -->
<div class="text-center mt-4">
    <div class="btn-group" role="group" aria-label="Category Navigation">
        <button type="button" class="btn btn-outline-primary active">All</button>
        <button type="button" class="btn btn-outline-primary">Eco</button>
        <button type="button" class="btn btn-outline-primary">SUV</button>
        <button type="button" class="btn btn-outline-primary">MPV</button>
    </div>
</div>

<!-- Grid of Car Cards for 'All' Category -->
<div id="all-cars" class="row justify-content-center mt-4">
    <div class="col-md-4 col-lg-4 mb-4 d-flex align-items-stretch">
        <div class="card text-center">
            <img src="{{ asset('images/Hyundai-Stargazer.png') }}" class="card-img-top" alt="Hyundai Stargazer">
            <div class="card-body">
                <h5 class="card-title font-weight-semibold">Hyundai Stargazer</h5>
                <p class="card-text">Rp249.600.000</p>
            </div>
            <a href="#" class="btn btn-primary btn-full">Selengkapnya</a>
        </div>
    </div>
    <div class="col-md-4 col-lg-4 mb-4 d-flex align-items-stretch">
        <div class="card text-center">
            <img src="{{ asset('images/Hyundai-Creta.png') }}" class="card-img-top" alt="Hyundai Creta">
            <div class="card-body">
                <h5 class="card-title font-weight-semibold">Hyundai Creta</h5>
                <p class="card-text">Rp297.000.000</p>
            </div>
            <a href="#" class="btn btn-primary btn-full">Selengkapnya</a>
        </div>
    </div>
    <div class="col-md-4 col-lg-4 mb-4 d-flex align-items-stretch">
        <div class="card text-center">
            <img src="{{ asset('images/Stargazer-X.png') }}" class="card-img-top" alt="Hyundai Stargazer X">
            <div class="card-body">
                <h5 class="card-title font-weight-semibold">Hyundai Stargazer X</h5>
                <p class="card-text">SUV keluarga dengan ruang luas dan teknologi terkini.</p>
            </div>
            <a href="#" class="btn btn-primary btn-full">Selengkapnya</a>
        </div>
    </div>
    <!-- Tambahkan kartu mobil lainnya dalam format yang sama -->
</div>
</div>
</div>

<style>
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
        font-size: 14px;
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
</style>