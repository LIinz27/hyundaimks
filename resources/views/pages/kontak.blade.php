@section('title', 'Kontak - Dealer Hyundai Makassar')
@include('header')

<div class="position-relative">
    <img src="{{ asset('images/photo_2023-06-06_20-05-30.jpg') }}" alt="Syarat Kredit" class="img-fluid w-100" style="height: 230px; object-fit: cover;">
    
    <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(28, 70, 130, 0.8);"></div>
    
    <h1 class="position-absolute top-50 text-white fw-bold" style="left: 10%; transform: translateY(-50%);">Kontak</h1>
</div>

<div class="container mt-5">
    <h2 class="fw-bold mb-4 ml-3">Kirim Pesan</h2>
    <p class="mb-5">Isi formulir dibawah ini untuk mengirim pesan</p>
    
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-11">
            <form>
                <div class="mb-4">
                    <label for="fullName" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="fullName" placeholder="Masukkan nama lengkap Anda">
                </div>

                <div class="mb-4">
                    <label for="fullName" class="form-label">Email</label>
                    <input type="text" class="form-control" id="Email" placeholder="Email">
                </div>
       
                <div class="mb-4">
                    <label for="contactNumber" class="form-label">No. HP/WhatsApp</label>
                    <input type="text" class="form-control" id="contactNumber" placeholder="Masukkan nomor HP atau WhatsApp Anda">
                </div>

                <div class="mb-4">
                    <label for="message" class="form-label">Tulis Pesan</label>
                    <textarea class="form-control" id="message" rows="5" placeholder="Tulis pesan Anda di sini"></textarea>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100 py-3 mb-5" style="background-color: #1c4682; border: none;">
                    <i class="bi bi-envelope-fill m-3"></i>Kirim Formulir</button>
            </form>
        </div>
    </div>
</div>

@include('footer')
