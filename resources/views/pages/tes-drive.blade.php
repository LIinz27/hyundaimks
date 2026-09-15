@extends('layouts.app')

@section('title', 'Tes Drive - Dealer Hyundai Makassar')

@section('content')
    <div class="page-hero">
        <img src="{{ asset('images/photo_2023-06-06_20-02-43.jpg') }}" alt="Booking Tes Drive" class="page-hero-image">
        <div class="page-hero-overlay"></div>
        <h1 class="page-hero-title">Booking Tes Drive</h1>
    </div>

    <div class="container mt-5">
        <h2 class="fw-bold mb-4 text-center">Formulir Test Drive Hyundai</h2>
        <p class="mb-5 text-center">Isi formulir dibawah ini untuk Booking Test Drive unit mobil Hyundai</p>

        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <form class="p-3 p-md-4 p-lg-5">
                    <div class="mb-4">
                        <label for="fullName" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control form-control-lg" id="fullName" placeholder="Masukkan nama lengkap Anda">
                    </div>

                    <div class="mb-4">
                        <label for="contactNumber" class="form-label">No. HP/WhatsApp</label>
                        <input type="text" class="form-control form-control-lg" id="contactNumber" placeholder="Masukkan nomor HP atau WhatsApp Anda">
                    </div>

                    <div class="mb-4">
                        <label for="testDriveDate" class="form-label">Tanggal Tes Drive</label>
                        <input type="date" class="form-control form-control-lg" id="testDriveDate" onclick="this.showPicker()" placeholder="Pilih tanggal tes drive Anda">
                    </div>

                    <div class="mb-4">
                        <label for="carType" class="form-label">Tipe Mobil</label>
                        <select class="form-select form-control-lg" id="carType">
                            <option selected disabled>Pilih tipe mobil</option>
                            @foreach (config('cars.cars') as $car)
                                <option value="{{ $car['name'] }}">{{ $car['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-brand w-100 py-3 mb-5">
                        <i class="bi bi-car-front-fill m-3"></i>Tes Drive Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
