@extends('layouts.app')

@section('title', 'Pricelist - Dealer Hyundai Makassar')

@section('content')
    <div class="container mt-5">
        <div class="pricelist-page text-center">
            <h2 class="pricelist-page-title">
                Pricelist Update {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, j F, Y') }}
            </h2>
            <div class="mt-4">
                <img src="{{ asset('images/01.-PRICELIST-19.06.2024.jpg') }}" alt="Pricelist" class="img-fluid">
            </div>
        </div>
    </div>
@endsection
