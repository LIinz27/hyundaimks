<!-- pricelist.blade.php -->
@section('title', 'Pricelist - Dealer Hyundai Makassar')
@include('header')

<div class="container mt-5">
    <div class="p-4 text-center" style="background-color: rgb(237, 237, 237); ">
        <h2 class="fw-bold" style="color: #1c4682;margin-top: 5%;">
            Pricelist Update {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, j F, Y') }}
        </h2>
        <div class="mt-4">
            @if ($pricelist)
                <img src="{{ asset('images/pricelist/' . $pricelist->filename) }}" alt="Pricelist" class="img-fluid">
            @else
                <img src="{{ asset('images/01.-PRICELIST-19.06.2024.jpg') }}" alt="Pricelist" class="img-fluid">
            @endif
        </div>
        <div class="mt-4 mb-3">
            <a href="{{ route('pricelist.download') }}" class="btn btn-primary" style="background-color:#1C4682; border:none; padding:12px 35px; font-size:15px;">
                <i class="bi bi-file-earmark-arrow-down-fill me-2"></i>Unduh Pricelist
            </a>
        </div>
    </div>
</div>

@include('footer')
