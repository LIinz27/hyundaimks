<!-- hyundai-all-new-santa-fe.blade.php -->
@section('title', 'HYUNDAI ALL NEW SANTA FE - Dealer Hyundai Makassar')
@include('header')

<!-- Carousel Section -->
<div class="position-relative" style="background-image: url('{{ asset('images/bg-colors-desktop.jpeg') }}'); background-size: cover; background-position: center; height: 550px; margin-top:5%;">
    <div id="konaCarousel" class="carousel slide" data-bs-ride="carousel">
        
        <!-- Carousel Images -->
        <div class="carousel-inner">
            @for ($i = 1; $i <= 5; $i++)
                <div class="carousel-item {{ $i == 1 ? 'active' : '' }}">
                    <img src="{{ asset('images/car/all-new-santa-fe/' . $i . '.png') }}" class="d-block mx-auto" alt="Hyundai Kona Slide {{ $i }}" style="object-fit: contain; height: 500px;">
                </div>
            @endfor
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#konaCarousel" data-bs-slide="prev" style="transform: translateX(50%);">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(100%);"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#konaCarousel" data-bs-slide="next" style="transform: translateX(-50%);">
            <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(100%);"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<style>
   @media (max-width: 768px) {
    .position-relative {
        height: 300px !important; 
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative; 
    }

    .carousel-item {
        text-align: center; 
    }

    #konaCarousel .carousel-item img {
        max-width: 80%;
        height: auto; 
        object-fit: contain;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .position-relative {
        height: 350px !important; 
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .carousel-item {
        text-align: center;
    }

    #konaCarousel .carousel-item img {
        max-width: 70%; 
        height: auto;
        object-fit: contain;
    }
}

</style>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center d-flex align-items-stretch gy-4">
        
        <!-- Daftar Harga Section -->
        <div class="col-md-5 d-flex mx-3">
            <div class="p-4 rounded shadow-sm h-100 w-100" style="background-color: #F1F1F1; border: 1px solid #ddd;">
                <h4 class="fw-bold text-start mb-5" style="font-size: 1.25rem; color:#1c4682;">
                    Daftar Harga Terupdate {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
                </h4>
                <p class="mb-5">*Harga tertera dapat berubah sewaktu-waktu. Klik Unduh Pricelist untuk melihat pricelist terbaru.</p>
                
                <!-- Buttons in a row with larger size -->
                <div class="d-flex gap-3">
                    <a href="#" class="btn btn-primary d-flex align-items-center" style="background-color: #1c4682; border: none;">
                        <i class="bi bi-whatsapp me-2"></i> Info Promo
                    </a>
                    <a href="#" class="btn btn-secondary d-flex align-items-center" style="background-color: #3069C4; border: none;">
                        <i class="bi bi-file-earmark-arrow-down-fill me-2"></i> Unduh Pricelist
                    </a>
                    <a href="#" class="btn btn-secondary d-flex align-items-center" style="background-color: #000000; border: none;">
                        <i class="bi bi-credit-card me-2"></i> Simulasi Kredit
                    </a>
                </div>
            </div>
        </div>

        <!-- Promo Khusus Section -->
        <div class="col-md-5 d-flex mx-3 promo-khusus">
            <div class="p-4 rounded shadow-sm h-100 w-100" style="background-color: #F1F1F1; border: 1px solid #ddd;">
                <h4 class="fw-bold text-start mb-3" style="font-size: 1.25rem; color: #1c4682;">
                    Promo Khusus {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
                </h4>            
                <div class="d-flex flex-column gap-4 mt-3">
                    <a href="#" class="btn btn-success fw-bold px-4 py-3" style="background-color: #1c4682; border: none;">
                        <i class="bi bi-whatsapp"></i> Dapatkan Promonya! Klik disini.
                    </a>
                    <a href="#" class="btn btn-success fw-bold px-4 py-3" style="background-color: #000000; border: none;">
                        <i class="bi bi-download"></i> Unduh E-Brosur ALL NEW SANTA FE
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    
    @media (max-width: 768px) {
        .container .row {
            flex-wrap: wrap;
            gap: 1rem;
        }

        .container .col-md-5 {
            flex: 1 1 100%;
            max-width: 100%;
            margin: 0;
        }

        .container .p-4 {
            padding: 1rem;
        }

        .container h4 {
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .container .btn {
            font-size: 0.9rem;
            padding: 0.6rem 1rem;
            flex: 1 1 auto;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container .btn i {
            margin-right: 5px;
        }

        .container .d-flex.gap-3 {
            gap: 0.5rem;
            flex-wrap: wrap;
        }
    }

    @media (min-width: 768px) and (max-width: 1024px) {
        .container .row {
            display: flex;
            flex-wrap: nowrap;
            justify-content: space-between;
            gap: 1rem;
        }

        .container .col-md-5 {
            flex: 1;
            max-width: 48%;
        }

        .container .p-4 {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .container .d-flex.gap-3 {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        .container .btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .container .btn i {
            margin-right: 6px;
        }

        .promo-khusus .p-4 {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .promo-khusus .d-flex.flex-column {
            margin-top: 1rem;
            align-items: stretch;
        }

        .promo-khusus .btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .promo-khusus .btn i {
            margin-right: 6px;
        }
    }
</style>


<div class="benefit-section mt-5">
    <div class="benefit-container">
        <ul class="benefit-list">
            <h3 class="benefit-heading">Keuntungan membeli HYUNDAI ALL NEW SANTA FE di Hyundai Makassar</h3>
            <li>Transaksi online aman 100%</li>
            <li>Melayani cash, kredit, tukar tambah atau COP kantor</li>
            <li>Data & BI CHECKING dibantu sampai approve</li>
            <li>Unit Ready Stok</li>
            <li>Free home test drive & fast respond 24 jam</li>
            <li>Jika ditolak leasing uang kembali 100%</li>
        </ul>

        <ul class="bonus-list">
            <h3 class="bonus-heading">Free Bonus Aksesoris</h3>
            <li>Kaca Film Smith</li>
            <li>Karpet Original Bludru</li>
            <li>Mini Alat Pemadam</li>
            <li>Segitiga Pengaman</li>
            <li>Kotak P3K</li>
            <li>Lisensi Plat</li>
            <li>Merchandise Hyundai</li>
        </ul>

        <ul class="after-sales-list">
            <h3 class="after-sales-heading">Program After Sales Terbaik</h3>
            <li>Waranty 3 Tahun /100.000KM</li>
            <li>Free Jasa Service 5 Tahun /75.000KM</li>
            <li>Trade In All Merk</li>
            <li>Best Service</li>
        </ul>
    </div>
</div>

<!-- Hyundai CRETA Performance Table -->
<div class="container mt-5" style="background-color: #F1F1F1; padding: 20px; border-radius: 10px; width: 80%;">
    <h3 class="mb-4">Performa</h3>
    <table class="table table-bordered" style="width: 100%;">
        <tbody>
            <tr>
                <th scope="row" style="width: 50%;">Jenis Bahan Bakar</th>
                <td style="width: 50%;">Bensin dan listrik (untuk varian Plug-in Hybrid / PHEV)</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Tenaga</th>
                <td style="width: 50%;">261 hp (untuk mesin bensin dan motor listrik pada varian PHEV)</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">RPM At Max Power</th>
                <td style="width: 50%;">5.500 RPM (untuk mesin bensin)</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Kapasitas Mesin</th>
                <td style="width: 50%;">1.6 liter (1.598 cc) Turbocharged, 4-silinder</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Torsi</th>
                <td style="width: 50%;">350 Nm</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">RPM At Max Torque</th>
                <td style="width: 50%;">1.500-4.500 RPM (untuk mesin bensin)</td>
            </tr>
        </tbody>
    </table>
    <h3 class="mb-4">Kapasitas</h3>
    <table class="table table-bordered" style="width: 100%;">
        <tbody>
            <tr>
                <th scope="row" style="width: 50%;">Kapasitas Bagasi</th>
                <td style="width: 50%;">Sekitar 1.030 liter (dengan baris ketiga dilipat)</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Ruang Kepala Depan</th>
                <td style="width: 50%;">1.025 mm</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Ruang Kepala Belakang</th>
                <td style="width: 50%;">1.001 mm</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Middle Row Legroom</th>
                <td style="width: 50%;">1.045 mm</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Berat Bersih</th>
                <td style="width: 50%;">1.900-2.050 kg (tergantung varian)</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Panjang</th>
                <td style="width: 50%;">4.785 mm</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Tinggi</th>
                <td style="width: 50%;">1.710 mm</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Jumlah Pintu</th>
                <td style="width: 50%;">5 pintu</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Kapasitas Tangki Bahan Bakar</th>
                <td style="width: 50%;">67 liter</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Berat Kotor</th>
                <td style="width: 50%;">2.550-2.650 kg (tergantung varian)<td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Lebar</th>
                <td style="width: 50%;">1.900 mm</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Jarak Sumbu Roda</th>
                <td style="width: 50%;">2.765 mm</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Kapasitas Tempat duduk</th>
                <td style="width: 50%;">7 penumpang</td>
            </tr>
        </tbody>
    </table>
    <h3 class="mb-4">Transmisi</h3>
    <table class="table table-bordered" style="width: 100%;">
        <tbody>
            <tr>
                <th scope="row" style="width: 50%;">Jenis Transmisi</th>
                <td style="width: 50%;">6-speed Automatic Transmission (untuk varian Plug-in Hybrid / PHEV)</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Jenis Penggerak</th>
                <td style="width: 50%;">All-Wheel Drive (AWD), dengan opsi Front-Wheel Drive (FWD) pada beberapa varian</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Girboks</th>
                <td style="width: 50%;">6-percepatan otomatis</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Steering Wheel Gearshift Paddle</th>
                <td style="width: 50%;">Ya</td>
            </tr>
        </tbody>
    </table>

    <h3 class="mb-4">Suspensi & Rem</h3>
    <table class="table table-bordered" style="width: 100%;">
        <tbody>
            <tr>
                <th scope="row" style="width: 50%;">Jenis Rem Depan</th>
                <td style="width: 50%;">Ventilated Disc Brakes</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Suspensi Depan</th>
                <td style="width: 50%;">MacPherson Strut dengan coil spring dan stabilizer</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Jenis Rem Belakang</th>
                <td style="width: 50%;">Solid Disc Brakes</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Suspensi Belakang</th>
                <td style="width: 50%;">Multi-link dengan coil spring</td>
            </tr>
        </tbody>
    </table>

    <h3 class="mb-4">Detil Mesin</h3>
    <table class="table table-bordered" style="width: 100%;">
        <tbody>
            <tr>
                <th scope="row" style="width: 50%;">Mesin</th>
                <td style="width: 50%;">1.6L Turbocharged Plug-in Hybrid (PHEV)</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Sistem Suplai Bahan Bakar</th>
                <td style="width: 50%;">Direct Injection (Injeksi Langsung)</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Jumlah Silinder</th>
                <td style="width: 50%;">4 silinder segaris</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Katup per Silinder</th>
                <td style="width: 50%;">4 katup per silinder (Total 16 katup dengan teknologi DOHC)</td>
            <tr>
                <th scope="row" style="width: 50%;">Tipe Baterai</th>
                <td style="width: 50%;">Lithium-ion Polymer Battery</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Regenerative Braking</th>
                <td style="width: 50%;">Yes</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Tipe Penggerak Listrik</th>
                <td style="width: 50%;">Permanent Magnet Synchronous Motor (PMSM)</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Kapasitas Baterai</th>
                <td style="width: 50%;">13.8 kWh</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">AC charging (0-100%)</th>
                <td style="width: 50%;">3.5 jam menggunakan Level 2 charger (240V)</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Emission</th>
                <td style="width: 50%;">30-50 g/km PHEV</td>
            </tr>
        </tbody>
    </table>

    <h3 class="mb-4">Velg & Ban</h3>
    <table class="table table-bordered" style="width: 100%;">
        <tbody>
            <tr>
                <th scope="row" style="width: 50%;">Velg alloy</th>
                <td style="width: 50%;">Ya</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Ukuran Velg Alloy</th>
                <td style="width: 50%;">19 Inch</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Jenis Ban</th>
                <td style="width: 50%;">All-season tires</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Cover Velg</th>
                <td style="width: 50%;">Tidak</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Ukuran Ban</th>
                <td style="width: 50%;">235/55 R19 dan 245/45 R20 (tergantung varian)</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Ukuran Velg</th>
                <td style="width: 50%;">Tersedia dalam dua pilihan, 19 inci dan 20 inci</td>
            </tr>
        </tbody>
    </table>

    <h3 class="mb-4">Kemudi</h3>
    <table class="table table-bordered" style="width: 100%;">
        <tbody>
            <tr>
                <th scope="row" style="width: 50%;">Power Steering</th>
                <td style="width: 50%;">Ya</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Pengaturan Posisi Stir</th>
                <td style="width: 50%;">Tilt dan Telescopic Adjustment</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Kolom Kemudi</th>
                <td style="width: 50%;">Tilt dan Telescopic</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Jenis Kemudi</th>
                <td style="width: 50%;">Rack and Pinion</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Steering Gear Type</th>
                <td style="width: 50%;">Rack-and-Pinion dengan sistem Electric Power Assisted Steering (EPAS).</td>
            </tr>
        </tbody>
    </table>
</div>

<style>
    
    @media (max-width: 768px) {
        .container h3 {
            font-size: 18px;
        }

        .table th, .table td {
            font-size: 14px;
            padding: 8px;
        }
    }

</style>

<div class="text-center full-bg" style="margin-top: 50px; background-image: url('{{ asset('images/white-background-with-triangle-patterns_1017-18410.jpg') }}'); background-size: cover; background-position: center;">
    <h2 class="heading-title" style="font-size: 26px; color:#1c4682; font-weight: bolder; margin-bottom: 50px; margin-top: 30px">Video HYUNDAI ALL NEW SANTA FE</h2>
    <iframe class="yt" width="1280" height="720" src="https://www.youtube.com/embed/2oAmBSceuqg" title="Hyundai Santa Fe 2024 | First Drive | Otodriver" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen style = "border-radius: 15;"></iframe>
</div>

<style>

    @media (max-width: 768px) {
        .text-center {
            padding: 15px 10px;
        }

        .heading-title {
            font-size: 20px; 
            margin-bottom: 30px;
            margin-top: 20px; 
        }

        iframe.yt {
            width: 100%; 
            height: auto; 
            max-width: 100%; 
        }
    }

    @media (min-width: 768px) and (max-width: 1024px) {
        .text-center {
            padding: 20px 15px; 
        }

        .heading-title {
            font-size: 24px;
            margin-bottom: 40px;
            margin-top: 25px; 
        }

        iframe.yt {
            width: 100%; 
            height: 600px; 
            max-width: 100%; 
        }
    }

</style>

<div class="text-center mb-3 full-bg d-flex align-items-center justify-content-center">
    <div class="content-container d-flex align-items-center justify-content-center">
        <div class="image-container">
            <img style="border-radius: 2%" src="{{ asset('images/hyundai-creta-fitur-5.webp') }}" alt="Hyundai Creta Feature" class="img-fluid">
        </div>
        <div class="text-container">
            <h3>Test Drive Hyundai</h3>
            <p>Yuk Test Drive Sebelum Membeli, Rasakan Pengalaman Mengendarai <strong>Mobil Hyundai</strong>, Ajak Serta Keluarga Anda.</p>
            <button class="testdrive-button">
                <i class="bi bi-whatsapp"></i> Daftar Test Drive
            </button>
        </div>
    </div>
</div>

@include('footer')