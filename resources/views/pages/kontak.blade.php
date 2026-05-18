@section('title', 'Kontak - Dealer Hyundai Makassar')
@include('header')

<div class="position-relative">
    <img src="{{ asset('images/photo_2023-06-06_20-05-30.jpg') }}" alt="Syarat Kredit" class="img-fluid w-100" style="height: 230px; object-fit: cover;">
    
    <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(28, 70, 130, 0.8);"></div>
    
    <h1 class="position-absolute top-50 text-white fw-bold" style="left: 10%; transform: translateY(-50%);">Kontak</h1>
</div>

<div class="container mt-5">
    <h2 class="fw-bold mb-4 text-center">Kirim Pesan</h2>
    <p class="mb-5 text-center">Isi formulir dibawah ini untuk mengirim pesan</p>
    
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <form class="p-3 p-md-4 p-lg-5" method="POST" action="{{ route('kontak.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control form-control-lg @error('nama') is-invalid @enderror"
                           id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap Anda">
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                           id="email" name="email" value="{{ old('email') }}" placeholder="Email">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
       
                <div class="mb-4">
                    <label for="telepon" class="form-label">No. HP/WhatsApp</label>
                    <input type="text" class="form-control form-control-lg @error('telepon') is-invalid @enderror"
                           id="telepon" name="telepon" value="{{ old('telepon') }}" placeholder="Masukkan nomor HP atau WhatsApp Anda">
                    @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label for="pesan" class="form-label">Tulis Pesan</label>
                    <textarea class="form-control form-control-lg @error('pesan') is-invalid @enderror"
                              id="pesan" name="pesan" rows="5" placeholder="Tulis pesan Anda di sini">{{ old('pesan') }}</textarea>
                    @error('pesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100 py-3 mb-5" style="background-color: #1c4682; border: none;"><i class="bi bi-envelope-fill m-3"></i>Kirim Formulir</button>
            </form>
        </div>
    </div>
</div>

@include('footer')

<style>
    @media (min-width: 768px) and (max-width: 1024px) {
        .container {
            padding-left: 0;
            padding-right: 0;
        }

        .row {
            margin-left: 0;
            margin-right: 0;
        }

        .form-control, .form-select, .form-label {
            font-size: 1.1rem;
            font-weight: 500;
        }

        .btn {
            font-size: 1.2rem;
            font-weight: bold;
            padding: 12px 0;
        }

        .p-md-4 {
            padding: 20px;
        }

        .text-center {
            text-align: center;
        }
    }
</style>
