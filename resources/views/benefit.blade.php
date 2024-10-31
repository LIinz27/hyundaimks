<!-- benefit -->
<div class="benefit-section">
    <div class="benefit-container">
        <ul class="benefit-list">
            <h3 class="benefit-heading">Keuntungan membeli di Hyundai Makassar</h3>
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

<!-- Benefit CSS -->
<style>
    .benefit-section {
        padding: 40px 0;
        background-color: #1C4682;
        width: 100vw;
        margin-top: -2%;
        margin-left: calc(50% - 50vw); 
    }

    .benefit-heading, .bonus-heading, .after-sales-heading {
        color: #ffffff;
        margin-bottom: 35px;
        font-size: 25px;
        font-weight: bold; 
        font-family: 'Manrope';
        text-align: left; 
    }

    .benefit-container {
        display: flex;
        justify-content: center; 
        gap: 20px;
        margin: 0 auto;
        width: 90%;
    }

    .benefit-list, .bonus-list, .after-sales-list {
        width: 30%;
        list-style-type: disc;
        background-color: transparent;
        font-size: 15px;
        line-height: 1.6;
        color: #ffffff;
        font-family: 'Manrope', sans-serif;
        text-align: left; 
    }

    .benefit-list li, .bonus-list li, .after-sales-list li {
        margin-bottom: 10px;
        text-align: left; 
        
    }
</style>

<!-- Reason -->
<div class="reason-section">
    <div class="reason-heading text-center">
        <h2>ALASAN MENGAPA KAMI MERUPAKAN DEALER YANG TEPAT UNTUK ANDA</h2>
        <p>Segera konsultasikan harga mobil impian anda sekarang juga <strong>gratis</strong>.</p>
    </div>
    
    <div class="reason-container d-flex justify-content-center gap-4">
        <div class="reason-item text-center">
            <i class="bi bi-check-circle promo-icon" style="font-size: 3rem; color: #1C4682;"></i>
            <h3>Proses Mudah & Cepat</h3>
            <p>Proses Kredit Mudah & Cepat menjadi hal terbaik yang kami persembahkan untuk anda.</p>
        </div>
        <div class="reason-item text-center">
            <i class="bi bi-people promo-icon" style="font-size: 3rem; color: #1C4682;"></i>
            <h3>Sales Berpengalaman</h3>
            <p>Pengalaman menjadi modal utama kami untuk terus memberikan pelayanan terbaik kepada konsumen.</p>
        </div>
        <div class="reason-item text-center">
            <i class="bi bi-wallet2 promo-icon" style="font-size: 3rem; color: #1C4682;"></i>
            <h3>Harga Fleksibel</h3>
            <p>Kami menawarkan harga yang cocok sesuai anggaran belanja Anda untuk mendapatkan mobil impian Anda.</p>
        </div>
    </div>
</div>
<!-- Reason CSS -->
<style>
    .reason-section {
        padding: 40px 0;
        }

    .reason-heading h2 {
            font-size: 28px;
            font-weight: bold;
            color: #000;
        }

    .reason-heading p {
            font-size: 16px;
            color: #333;
            margin-top: 2%;
            margin-bottom: 5%;
        }

    .reason-container .reason-item h3 {
        font-size: 20px;
        margin: 5%; 
        font-weight: bold;
        color: #333;
    }

    .reason-container .reason-item p {
        font-size: 15px;
        color: #666;
        margin-top: 0; 
        margin-bottom: 10%;     }
</style>

<!-- PROMO KREDIT -->
<div class="promo-section">
    <div class="promo-heading text-center">
        <h2 style="font-weight: bolder;">PROMO KREDIT UNIT HYUNDAI</h2>
        <p>Segera konsultasikan harga mobil impian anda sekarang juga <strong>gratis</strong>.</p>
    </div>
    
    <div class="promo-container d-flex justify-content-center gap-4">
        <div class="promo-item text-center">
            <i class="bi bi-list-task promo-icon"></i>
            <h3>Pricelist Terbaru</h3>
            <button class="promo-button">Selengkapnya &rarr;</button>
        </div>
        <div class="promo-item text-center">
            <i class="bi bi-credit-card promo-icon"></i>
            <h3>Proses Kredit</h3>
            <button class="promo-button">Selengkapnya &rarr;</button>
        </div>
        <div class="promo-item text-center">
            <i class="bi bi-pencil-square promo-icon"></i>
            <h3>Simulasi Kredit</h3>
            <button class="promo-button">Selengkapnya &rarr;</button>
        </div>
    </div>
</div>
<!-- Promo CSS -->
<style>
    .promo-section {
        position: relative; 
        padding: 40px 0;
        overflow: hidden;
        width: 100vw;
        margin-left: calc(50% - 50vw);
        background-image: url('/images/photo_2023-06-06_20-05-30.jpg');
        background-size: cover;
        background-position: center;
        z-index: 0;
    }

    .promo-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(28, 70, 130, 0.9);
        z-index: 1;
    }

    .promo-heading h2, .promo-heading p {
        position: relative;
        z-index: 2;
        color: #ffffff;
        margin: 2%;
    }

    .promo-container .promo-item {
        border: 2px solid #ffffff;
        background-color: #ffffff;
        border-radius: 10px;
        padding: 10px 90px;
        transition: transform 0.3s;
        position: relative;
        z-index: 2;
        margin: 10px;
    }

    .promo-item h3 {
        margin-top: 10%;
        margin-bottom: 35%;
        font-weight: 900;
    }

    .promo-button {
        background-color: #1C4682;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .promo-button:hover {
        background-color: #163b5a;
    }

    /* Icon hover effect */
    .promo-icon {
        font-size: 3rem;
        color: #163b5a;
        transition: transform 0.3s, color 0.3s;
    }

    .promo-icon:hover {
        transform: scale(1.1);
        color: #1C4682;
    }
</style>

<!-- Test Drive -->
<div class="text-center mb-3 full-bg d-flex align-items-center justify-content-center" style="background-image: url('{{ asset('images/white-background-with-triangle-patterns_1017-18410.jpg') }}'); background-size: cover; background-position: center;">
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

<!-- Test Drive CSS -->
<style>
    .full-bg {
        padding: 40px 0;
    }

    .content-container {
        max-width: 1200px;
        display: flex;
        gap: 20px;
    }

    .image-container {
        flex: 1;
        text-align: left;
        margin: 3%;
    }

    .text-container {
        flex: 1;
        text-align: left;
        color: #333;
    }

    .text-container h3 {
        font-size: 28px;
        font-weight: 700;
        color: #163b5a;
        margin-bottom: 5%;
    }

    .text-container p {
        font-size: 18px;
    }

    .testdrive-button {
        display: inline-flex;
        align-items: center;
        background-color: #1C4682;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        padding: 10px 60px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 5%;
    }

    .testdrive-button i {
        font-size: 1.2rem;
        margin-right: 8px;
    }

    .testdrive-button:hover {
        background-color: #163b5a;
    }
</style>

<!-- Pricelist -->
<div class="pricelist-section">
    <div class="pricelist-heading">
        <h2>Segera konsultasikan harga mobil impian anda sekarang juga</h2>
        <div class="btn-container">
            <button class="btn btn-download">
                Unduh Pricelist <i class="bi bi-file-earmark-arrow-down"></i>
            </button>
        </div>
    </div>
</div>

<style>
    .pricelist-section {
        position: relative; 
        padding: 60px 0;
        overflow: hidden;
        width: 100vw;
        margin-left: calc(50% - 50vw);
        background-image: url('images/photo_2023-06-06_20-02-43.jpg');
        background-size: cover;
        background-position: center;
        z-index: 0;
    }

    .pricelist-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(28, 70, 130, 0.9);
        z-index: 1;
    }

    .pricelist-heading h2 {
        position: relative;
        z-index: 2;
        color: #ffffff;
        font-size: 250%;
        text-align: left;
        padding: 0% 20% 1%;
        margin-bottom: 20px;
    }

    .btn-container {
        position: relative;
        text-align: left;
        padding-left: 20%;
        z-index: 2;
    }

    .btn-download {
        color: #ffffff;
        background-color: #163b5a;
        border: none;
        padding: 12px 24px;
        font-size: 1rem;
        font-weight: bold;
        border-radius: 5px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background-color 0.3s ease;
    }

    .btn-download:hover {
        background-color: #000;
        color: #ffffff
    }

    .btn-download i {
        font-size: 1.2rem;
        order: 1;
    }
</style>