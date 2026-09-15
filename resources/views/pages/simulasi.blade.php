@extends('layouts.app')

@section('title', 'Simulasi Kredit - Dealer Hyundai Makassar')

@section('content')
    <div class="page-hero">
        <img src="{{ asset('images/photo_2023-06-06_20-05-30.jpg') }}" alt="Simulasi Kredit" class="page-hero-image">
        <div class="page-hero-overlay"></div>
        <h1 class="page-hero-title">Simulasi Kredit</h1>
    </div>

    <div class="container-fluid mt-5 px-0">
        <h2 class="fw-bold mb-4 text-center">Simulasi Kredit Mobil Hyundai</h2>
        <p class="mb-5 text-center">Isi formulir dibawah ini untuk mendapatkan info simulasi kredit unit mobil Hyundai</p>

        <div class="row mx-0 justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <form class="p-3 p-md-4 p-lg-5">
                    <div class="mb-4">
                        <label for="carType" class="form-label">Tipe Mobil</label>
                        <select class="form-select form-control-lg" id="carType">
                            <option selected disabled>Pilih tipe mobil</option>
                            @foreach (config('cars.cars') as $car)
                                <option value="{{ $car['name'] }}">{{ $car['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="tenor" class="form-label">Pilih Tenor</label>
                        <select class="form-select form-control-lg" id="tenor">
                            <option selected disabled>Pilih tenor</option>
                            <option value="1">1 Tahun</option>
                            <option value="2">2 Tahun</option>
                            <option value="3">3 Tahun</option>
                            <option value="4">4 Tahun</option>
                            <option value="5">5 Tahun</option>
                            <option value="6">6 Tahun</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="downPayment" class="form-label">Uang Muka (Rp)</label>
                        <input type="number" class="form-control" id="downPayment" placeholder="Masukkan jumlah uang muka">
                    </div>

                    <div class="mb-4">
                        <label for="fullName" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="fullName" placeholder="Masukkan nama lengkap Anda">
                    </div>

                    <div class="mb-4">
                        <label for="region" class="form-label">Asal Kota/Daerah</label>
                        <input type="text" class="form-control" id="region" placeholder="Masukkan asal kota atau daerah Anda">
                    </div>

                    <div class="mb-4">
                        <label for="contactNumber" class="form-label">No. HP/WhatsApp</label>
                        <input type="text" class="form-control" id="contactNumber" placeholder="Masukkan nomor HP atau WhatsApp Anda">
                    </div>

                    <button type="submit" class="btn btn-brand w-100 py-3 mb-5">
                        <i class="bi bi-credit-card m-3"></i>Hitung Harga Credit
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
