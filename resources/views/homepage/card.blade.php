@php
    $cars = config('cars.cars');
    $categories = [
        'all' => null,
        'eco' => 'eco',
        'suv' => 'suv',
        'mpv' => 'mpv',
    ];
@endphp

<div class="text-center mb-3 section-heading-spaced">
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

<div class="tab-content mt-4" id="categoryTabContent">
    @foreach ($categories as $tab => $category)
        <div class="tab-pane fade {{ $tab === 'all' ? 'show active' : '' }}" id="{{ $tab }}" role="tabpanel" aria-labelledby="{{ $tab }}-tab">
            <div class="row justify-content-center g-4">
                @foreach ($cars as $car)
                    @if (is_null($category) || in_array($category, $car['categories'], true))
                        <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
                            <div class="card text-center w-100">
                                <img src="{{ asset($car['image']) }}" class="card-img-top car-image" alt="{{ $car['name'] }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $car['name'] }}</h5>
                                    <p class="card-text">{{ $car['price'] }}</p>
                                </div>
                                <a href="{{ sales_url('/product/' . $car['slug']) }}" class="btn btn-primary btn-full">Selengkapnya</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endforeach
</div>
