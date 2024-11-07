<!-- hyundai-kona.blade.php -->
@section('title', 'HYUNDAI KONA ELECTRIC - Dealer Hyundai Makassar')
@include('header')

<!-- Carousel Section -->
<div class="position-relative" style="background-image: url('{{ asset('images/bg-colors-desktop.jpeg') }}'); background-size: cover; background-position: center; height: 550px;">
    <div id="konaCarousel" class="carousel slide" data-bs-ride="carousel">
        
        <!-- Carousel Images -->
        <div class="carousel-inner">
            @for ($i = 1; $i <= 5; $i++)
                <div class="carousel-item {{ $i == 1 ? 'active' : '' }}">
                    <img src="{{ asset('images/hyundai-kona/' . $i . '.png') }}" class="d-block mx-auto" alt="Hyundai Kona Slide {{ $i }}" style="object-fit: contain; height: 500px;">
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
        height: 200px !important; /* Sesuaikan tinggi background di mobile */
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative; /* Pastikan elemen ini teratur dengan benar */
    }

    .carousel-item {
        text-align: center; /* Tempatkan gambar di tengah secara horizontal */
    }

    #konaCarousel .carousel-item img {
        max-width: 80%;
        height: auto; /* Sesuaikan tinggi otomatis */
        object-fit: contain;
    }

    /* Menambahkan z-index yang lebih tinggi pada hamburger menu */
    .navbar-toggler {
        z-index: 9999; /* Memastikan hamburger menu berada di atas carousel control */
    }

    /* Mengatur posisi tombol kontrol carousel agar tidak menutupi tombol hamburger */
    .carousel-control-prev,
    .carousel-control-next {
        z-index: 1; /* Menurunkan z-index pada tombol kontrol carousel */
    }
}

/* Responsif untuk tampilan tablet */
@media (min-width: 768px) and (max-width: 1024px) {
    .position-relative {
        height: 300px !important; /* Tinggi background lebih pendek di tablet */
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative; /* Pastikan elemen ini teratur dengan benar */
    }

    .carousel-item {
        text-align: center;
    }

    #konaCarousel .carousel-item img {
        max-width: 70%; /* Sedikit lebih kecil di tablet */
        height: auto;
        object-fit: contain;
    }

    /* Menambahkan z-index yang lebih tinggi pada hamburger menu */
    .navbar-toggler {
        z-index: 9999; /* Memastikan hamburger menu berada di atas carousel control */
    }

    /* Mengatur posisi tombol kontrol carousel agar tidak menutupi tombol hamburger */
    .carousel-control-prev,
    .carousel-control-next {
        z-index: 1; /* Menurunkan z-index pada tombol kontrol carousel */
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
                <i class="bi bi-download"></i> Unduh E-Brosur HYUNDAI KONA ELECTRIC
            </a>
        </div>
    </div>
</div>

    </div>
</div>

<style>

    @media (max-width: 768px) {
        .container .row {
            flex-wrap: wrap; /* Izinkan kolom untuk membungkus jika terlalu panjang */
            gap: 1rem; /* Berikan jarak antar elemen */
        }

        .container .col-md-5 {
            flex: 1 1 100%; /* Lebar kolom menyesuaikan penuh pada mobile */
            max-width: 100%;
            margin: 0; /* Hapus margin horizontal */
        }

        .container .p-4 {
            padding: 1rem; /* Kurangi padding untuk layar kecil */
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
            display: flex; /* Gunakan flexbox untuk memusatkan konten */
            align-items: center; /* Pusatkan teks secara vertikal */
            justify-content: center; /* Pusatkan teks secara horizontal */
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

        /* Pengaturan tombol agar teks di tengah */
        .container .d-flex.gap-3 {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        .container .btn {
            width: 100%;
            display: flex; /* Gunakan Flexbox untuk tombol */
            align-items: center; /* Pusatkan teks secara vertikal */
            justify-content: center; /* Pusatkan teks secara horizontal */
            text-align: center; /* Pusatkan teks */
        }

        .container .btn i {
            margin-right: 6px; /* Jarak ikon dari teks */
        }

        /* Promo Khusus Section */
        .promo-khusus .p-4 {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        /* Tombol di bawah teks pada Promo Khusus */
        .promo-khusus .d-flex.flex-column {
            margin-top: 1rem; /* Tambahkan jarak di bawah judul */
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
            <h3 class="benefit-heading">Keuntungan membeli HYUNDAI KONA ELECTRIC di Hyundai Makassar</h3>
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

<!-- Hyundai KONA Electric Performance Table -->
<div class="container mt-5" style="background-color: #F1F1F1; padding: 20px; border-radius: 10px; width: 80%;">
    <h3 class="mb-4">Performa</h3>
    <table class="table table-bordered" style="width: 100%;">
        <tbody>
            <tr>
                <th scope="row" style="width: 50%;">Jenis Bahan Bakar</th>
                <td style="width: 50%;">Electric</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Tenaga</th>
                <td style="width: 50%;">134 hp</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">RPM At Max Power</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Kapasitas Mesin</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Torsi</th>
                <td style="width: 50%;">395 Nm</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">RPM At Max Torque</th>
                <td style="width: 50%;"></td>
            </tr>
        </tbody>
    </table>
    <h3 class="mb-4">Kapasitas</h3>
    <table class="table table-bordered" style="width: 100%;">
        <tbody>
            <tr>
                <th scope="row" style="width: 50%;">Kapasitas Bagasi</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Ruang Kepala Depan</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Ruang Kepala Belakang</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Middle Row Legroom</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Berat Bersih</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Panjang</th>
                <td style="width: 50%;">4205 mm</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Tinggi</th>
                <td style="width: 50%;">1570 mm</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Jumlah Pintu</th>
                <td style="width: 50%;">5</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Kapasitas Tangki Bahan Bakar</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Berat Kotor</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Lebar</th>
                <td style="width: 50%;">1800 mm</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Jarak Sumbu Roda</th>
                <td style="width: 50%;">2600 mm</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Kapasitas Tempat duduk</th>
                <td style="width: 50%;">5 Kursi</td>
            </tr>
        </tbody>
    </table>
    <h3 class="mb-4">Transmisi</h3>
    <table class="table table-bordered" style="width: 100%;">
        <tbody>
            <tr>
                <th scope="row" style="width: 50%;">Jenis Transmisi</th>
                <td style="width: 50%;">Otomatis</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Jenis Penggerak</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Girboks</th>
                <td style="width: 50%;">Single Speed</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Steering Wheel Gearshift Paddle</th>
                <td style="width: 50%;"></td>
            </tr>
        </tbody>
    </table>

    <h3 class="mb-4">Suspensi & Rem</h3>
    <table class="table table-bordered" style="width: 100%;">
        <tbody>
            <tr>
                <th scope="row" style="width: 50%;">Jenis Rem Depan</th>
                <td style="width: 50%;">Ventilated Discs</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Suspensi Depan</th>
                <td style="width: 50%;">MacPherson Strut</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Jenis Rem Belakang</th>
                <td style="width: 50%;">Discs</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Suspensi Belakang</th>
                <td style="width: 50%;">Multi-Link</td>
            </tr>
        </tbody>
    </table>

    <h3 class="mb-4">Detil Mesin</h3>
    <table class="table table-bordered" style="width: 100%;">
        <tbody>
            <tr>
                <th scope="row" style="width: 50%;">Mesin</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Sistem Suplai Bahan Bakar</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Jumlah Silinder</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Katup per Silinder</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Tipe Baterai</th>
                <td style="width: 50%;">Lithium-ion</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Regenerative Braking</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Tipe Penggerak Listrik</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Kapasitas Baterai</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">AC charging (0-100%)</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Emission</th>
                <td style="width: 50%;">0 g/km</td>
            </tr>
        </tbody>
    </table>

    <h3 class="mb-4">Velg & Ban</h3>
    <table class="table table-bordered" style="width: 100%;">
        <tbody>
            <tr>
                <th scope="row" style="width: 50%;">Velg alloy</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Ukuran Velg Alloy</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Jenis Ban</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Cover Velg</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Ukuran Ban</th>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Ukuran Velg</th>
                <td style="width: 50%;"></td>
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
                <td style="width: 50%;">Ya</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Kolom Kemudi</th>
                <td style="width: 50%;">Adjustable</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Jenis Kemudi</th>
                <td style="width: 50%;">Power</td>
            </tr>
            <tr>
                <th scope="row" style="width: 50%;">Steering Gear Type</th>
                <td style="width: 50%;">Rack & Pinion</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="text-center full-bg" style="margin-top: 50px; background-image: url('{{ asset('images/white-background-with-triangle-patterns_1017-18410.jpg') }}'); background-size: cover; background-position: center;">
    <h2 class="heading-title" style="font-size: 26px; color:#1c4682; font-weight: bolder; margin-bottom: 50px; margin-top: 30px">Video HYUNDAI KONA ELECTRIC</h2>
    <iframe width="1280" height="720" src="https://www.youtube.com/embed/6jp_2C6OIGY" title="The all-new KONA | Product Review" frameborder="1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen style="border-radius: 15px;"></iframe>
</div>

<style>

    @media (max-width: 768px) {
        .text-center.full-bg {
            padding: 15px 10px; /* Memberikan padding lebih kecil di mobile */
        }

        .heading-title {
            font-size: 20px; /* Ukuran font lebih kecil */
            margin-bottom: 30px;
            margin-top: 20px; /* Mengurangi margin atas */
        }

        iframe {
            width: 100%; /* Membuat lebar iframe 100% dari layar */
            height: auto; /* Tinggi menyesuaikan dengan lebar */
            max-width: 100%; /* Menyesuaikan iframe agar tidak lebih lebar dari layar */
        }
    }

    @media (min-width: 768px) and (max-width: 1024px) {
        .text-center.full-bg {
            padding: 20px 15px; /* Padding sedikit lebih besar daripada mobile */
        }

        .heading-title {
            font-size: 24px; /* Ukuran font sedikit lebih besar untuk tablet */
            margin-bottom: 40px;
            margin-top: 25px; /* Margin atas sedikit lebih besar daripada mobile */
        }

        iframe {
            width: 100%; /* Membuat lebar iframe 100% dari layar tablet */
            height: 600px; /* Menambah tinggi iframe untuk memastikan tampilan lebih panjang */
            max-width: 100%; /* Menyesuaikan iframe agar tidak lebih lebar dari layar */
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