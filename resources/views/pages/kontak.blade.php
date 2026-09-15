@extends('layouts.app')

@section('title', 'Kontak - Dealer Hyundai Makassar')

@section('content')
    <div class="page-hero">
        <img src="{{ asset('images/photo_2023-06-06_20-05-30.jpg') }}" alt="Kontak" class="page-hero-image">
        <div class="page-hero-overlay"></div>
        <h1 class="page-hero-title">Kontak</h1>
    </div>

    <div class="container mt-5">
        <h2 class="fw-bold mb-4 text-center">Kirim Pesan</h2>
        <p class="mb-5 text-center">Isi formulir dibawah ini untuk mengirim pesan</p>

        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <form class="p-3 p-md-4 p-lg-5">
                    <div class="mb-4">
                        <label for="fullName" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control form-control-lg" id="fullName" placeholder="Masukkan nama lengkap Anda">
                    </div>

                    <div class="mb-4">
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" class="form-control form-control-lg" id="Email" placeholder="Email">
                    </div>

                    <div class="mb-4">
                        <label for="contactNumber" class="form-label">No. HP/WhatsApp</label>
                        <input type="text" class="form-control form-control-lg" id="contactNumber" placeholder="Masukkan nomor HP atau WhatsApp Anda">
                    </div>

                    <div class="mb-4">
                        <label for="message" class="form-label">Tulis Pesan</label>
                        <textarea class="form-control form-control-lg" id="message" rows="5" placeholder="Tulis pesan Anda di sini"></textarea>
                    </div>

                    <button type="submit" class="btn btn-brand w-100 py-3 mb-5">
                        <i class="bi bi-envelope-fill m-3"></i>Kirim Formulir
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
