<!-- pricelist.blade.php -->
@section('title', 'Pricelist - Dealer Hyundai Makassar')
@include('header')

<div class="container mt-5">
    <div class="p-4 text-center" style="background-color: rgb(237, 237, 237); ">
        <h2 class="fw-bold" style="color: #1c4682;margin-top: 5%;">
            Pricelist Update {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, j F, Y') }}
        </h2>
        <div class="mt-4">
            <img src="{{ asset('images/01.-PRICELIST-19.06.2024.jpg') }}" alt="Pricelist" class="img-fluid">
        </div>
    </div>
</div>

@include('footer')
