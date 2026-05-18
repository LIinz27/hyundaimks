@section('title', 'Simulasi Kredit - Dealer Hyundai Makassar')
@include('header')

<div class="position-relative">
    <img src="{{ asset('images/photo_2023-06-06_20-05-30.jpg') }}" alt="Syarat Kredit" class="img-fluid w-100" style="height: 230px; object-fit: cover;">
    
    <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(28, 70, 130, 0.6);"></div>
    
    <h1 class="position-absolute top-50 text-white fw-bold" style="left: 10%; transform: translateY(-50%);">Simulasi Kredit</h1>
</div>

<div class="container-fluid mt-5 px-0">
    <h2 class="fw-bold mb-4 ml-3 text-center">Simulasi Kredit Mobil Hyundai</h2>
    <p class="mb-5 text-center">Isi formulir dibawah ini untuk mendapatkan info simulasi kredit unit mobil Hyundai</p>
    
    <div class="row mx-0 justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <form class="p-3 p-md-4 p-lg-5" method="POST" action="{{ route('simulasi.store') }}">
                @csrf
                <!-- Form Group for Tipe Mobil -->
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

                <!-- Form Group for Tenor -->
                <div class="mb-4">
                    <label for="tenor" class="form-label">Pilih Tenor</label>
                    <select class="form-select form-control-lg @error('tenor') is-invalid @enderror"
                            id="tenor" name="tenor">
                        <option value="" disabled {{ old('tenor') ? '' : 'selected' }}>Pilih tenor</option>
                        @foreach ([1,2,3,4,5,6] as $t)
                            <option value="{{ $t }}" {{ old('tenor') == $t ? 'selected' : '' }}>{{ $t }} Tahun</option>
                        @endforeach
                    </select>
                    @error('tenor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Form Group for Uang Muka -->
                <div class="mb-4">
                    <label for="uang_muka" class="form-label">Uang Muka (Rp)</label>
                    <input type="number" class="form-control @error('uang_muka') is-invalid @enderror"
                           id="uang_muka" name="uang_muka" value="{{ old('uang_muka') }}"
                           placeholder="Masukkan jumlah uang muka" min="0">
                    @error('uang_muka')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Form Group for Nama Lengkap -->
                <div class="mb-4">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                           id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap Anda">
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Form Group for Asal Kota/Daerah -->
                <div class="mb-4">
                    <label for="kota" class="form-label">Asal Kota/Daerah</label>
                    <input type="text" class="form-control @error('kota') is-invalid @enderror"
                           id="kota" name="kota" value="{{ old('kota') }}" placeholder="Masukkan asal kota atau daerah Anda">
                    @error('kota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Form Group for No. HP/WhatsApp -->
                <div class="mb-4">
                    <label for="telepon" class="form-label">No. HP/WhatsApp</label>
                    <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                           id="telepon" name="telepon" value="{{ old('telepon') }}" placeholder="Masukkan nomor HP atau WhatsApp Anda">
                    @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100 py-3 mb-5" style="background-color: #1c4682; border: none;"><i class="bi bi-credit-card m-3"></i>Hitung Harga Credit</button>
            </form>
        </div>
    </div>
</div>

@include('footer')

<style>
    @media (min-width: 768px) and (max-width: 1024px) {
        .container-fluid {
            padding-left: 0;
            padding-right: 0;
        }

        .row.mx-0 {
            margin-left: 0;
            margin-right: 0;
        }

        .p-md-4 {
            padding: 20px;
        }
    }
</style>
