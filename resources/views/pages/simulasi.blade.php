@section('title', 'Simulasi Kredit - Dealer Hyundai Makassar')
@include('header')

<div class="position-relative">
    <img src="{{ asset('images/photo_2023-06-06_20-05-30.jpg') }}" alt="Syarat Kredit" class="img-fluid w-100" style="height: 230px; object-fit: cover;">
    
    <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(28, 70, 130, 0.6);"></div>
    
    <h1 class="position-absolute top-50 text-white fw-bold" style="left: 10%; transform: translateY(-50%);">Simulasi Kredit</h1>
</div>

<div class="container mt-5">
    <h2 class="fw-bold mb-4 ml-3">Simulasi Kredit Mobil Hyundai</h2>
    <p class="mb-5">Isi formulir dibawah ini untuk mendapatkan info simulasi kredit unit mobil Hyundai</p>
    
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-11">
            <form>
                <!-- Form Group for Tipe Mobil -->
                <div class="mb-4">
                    <label for="carType" class="form-label">Tipe Mobil</label>
                    <select class="form-select form-control-lg" id="carType">
                        <option selected disabled>Pilih tipe mobil</option>
                    </select>
                </div>


                <!-- Form Group for Tenor -->
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

                <!-- Form Group for Uang Muka -->
                <div class="mb-4">
                    <label for="downPayment" class="form-label">Uang Muka (Rp)</label>
                    <input type="number" class="form-control" id="downPayment" placeholder="Masukkan jumlah uang muka">
                </div>

                <!-- Form Group for Nama Lengkap -->
                <div class="mb-4">
                    <label for="fullName" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="fullName" placeholder="Masukkan nama lengkap Anda">
                </div>

                <!-- Form Group for Asal Kota/Daerah -->
                <div class="mb-4">
                    <label for="region" class="form-label">Asal Kota/Daerah</label>
                    <input type="text" class="form-control" id="region" placeholder="Masukkan asal kota atau daerah Anda">
                </div>

                <!-- Form Group for No. HP/WhatsApp -->
                <div class="mb-4">
                    <label for="contactNumber" class="form-label">No. HP/WhatsApp</label>
                    <input type="text" class="form-control" id="contactNumber" placeholder="Masukkan nomor HP atau WhatsApp Anda">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100 py-3 mb-5" style="background-color: #1c4682; border: none;"><i class="bi bi-credit-card m-3"></i>Hitung Harga Credit</button>
            </form>
        </div>
    </div>
</div>

@include('footer')
