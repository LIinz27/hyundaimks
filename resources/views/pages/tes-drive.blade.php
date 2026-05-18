@section('title', 'Tes Drive - Dealer Hyundai Makassar')
@include('header')

<div class="position-relative">
    <img src="{{ asset('images/photo_2023-06-06_20-02-43.jpg') }}" alt="Syarat Kredit" class="img-fluid w-100" style="height: 230px; object-fit: cover;">
    
    <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(28, 70, 130, 0.8);"></div>
    
    <h1 class="position-absolute top-50 text-white fw-bold" style="left: 10%; transform: translateY(-50%);">Booking Tes Drive</h1>
</div>

<div class="container mt-5">
    <h2 class="fw-bold mb-4 text-center">Formulir Test Drive Hyundai</h2>
    <p class="mb-5 text-center">Isi formulir dibawah ini untuk Booking Test Drive unit mobil Hyundai</p>
    
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <form class="p-3 p-md-4 p-lg-5" method="POST" action="{{ route('tesdrive.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control form-control-lg @error('nama') is-invalid @enderror"
                           id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap Anda">
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
       
                <div class="mb-4">
                    <label for="telepon" class="form-label">No. HP/WhatsApp</label>
                    <input type="text" class="form-control form-control-lg @error('telepon') is-invalid @enderror"
                           id="telepon" name="telepon" value="{{ old('telepon') }}" placeholder="Masukkan nomor HP atau WhatsApp Anda">
                    @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label for="tanggal" class="form-label">Tanggal Tes Drive</label>
                    <input type="date" class="form-control form-control-lg @error('tanggal') is-invalid @enderror"
                           id="tanggal" name="tanggal" value="{{ old('tanggal') }}" onclick="this.showPicker()">
                    @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="mb-4">
                    <label for="tipe_mobil" class="form-label">Tipe Mobil</label>
                    <select class="form-select form-control-lg @error('tipe_mobil') is-invalid @enderror"
                            id="tipe_mobil" name="tipe_mobil">
                        <option value="" disabled {{ old('tipe_mobil') ? '' : 'selected' }}>Pilih tipe mobil</option>
                        <option value="Hyundai STARGAZER" {{ old('tipe_mobil') == 'Hyundai STARGAZER' ? 'selected' : '' }}>Hyundai STARGAZER</option>
                        <option value="Hyundai STARGAZER X" {{ old('tipe_mobil') == 'Hyundai STARGAZER X' ? 'selected' : '' }}>Hyundai STARGAZER X</option>
                        <option value="Hyundai CRETA" {{ old('tipe_mobil') == 'Hyundai CRETA' ? 'selected' : '' }}>Hyundai CRETA</option>
                        <option value="Hyundai KONA" {{ old('tipe_mobil') == 'Hyundai KONA' ? 'selected' : '' }}>Hyundai KONA</option>
                        <option value="Hyundai SANTA FE" {{ old('tipe_mobil') == 'Hyundai SANTA FE' ? 'selected' : '' }}>Hyundai SANTA FE</option>
                        <option value="Hyundai All New SANTA FE" {{ old('tipe_mobil') == 'Hyundai All New SANTA FE' ? 'selected' : '' }}>Hyundai All New SANTA FE</option>
                        <option value="Hyundai STARIA" {{ old('tipe_mobil') == 'Hyundai STARIA' ? 'selected' : '' }}>Hyundai STARIA</option>
                        <option value="Hyundai IONIQ 5" {{ old('tipe_mobil') == 'Hyundai IONIQ 5' ? 'selected' : '' }}>Hyundai IONIQ 5</option>
                        <option value="Hyundai IONIQ 6" {{ old('tipe_mobil') == 'Hyundai IONIQ 6' ? 'selected' : '' }}>Hyundai IONIQ 6</option>
                        <option value="Hyundai PALISADE" {{ old('tipe_mobil') == 'Hyundai PALISADE' ? 'selected' : '' }}>Hyundai PALISADE</option>
                    </select>
                    @error('tipe_mobil')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100 py-3 mb-5" style="background-color: #1c4682; border: none;"><i class="bi bi-car-front-fill m-3"></i>Tes Drive Sekarang</button>
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
