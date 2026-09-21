<!-- benefit -->
<div class="benefit-section benefit-section-home">
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

<!-- Reason -->
<div class="reason-section">
    <div class="reason-heading text-center">
        <h2>ALASAN MENGAPA KAMI MERUPAKAN DEALER YANG TEPAT UNTUK ANDA</h2>
        <p>Segera konsultasikan harga mobil impian anda sekarang juga <strong>gratis</strong>.</p>
    </div>

    <div class="reason-container d-flex justify-content-center gap-4">
        <div class="reason-item text-center col-sm-4 col-12">
            <i class="bi bi-check-circle promo-icon reason-icon"></i>
            <h3>Proses Mudah & Cepat</h3>
            <p>Proses Kredit Mudah & Cepat menjadi hal terbaik yang kami persembahkan untuk anda.</p>
        </div>
        <div class="reason-item text-center col-sm-4 col-12">
            <i class="bi bi-people promo-icon reason-icon"></i>
            <h3>Sales Berpengalaman</h3>
            <p>Pengalaman menjadi modal utama kami untuk terus memberikan pelayanan terbaik kepada konsumen.</p>
        </div>
        <div class="reason-item text-center col-sm-4 col-12">
            <i class="bi bi-wallet2 promo-icon reason-icon"></i>
            <h3>Harga Fleksibel</h3>
            <p>Kami menawarkan harga yang cocok sesuai anggaran belanja Anda untuk mendapatkan mobil impian Anda.</p>
        </div>
    </div>
</div>

<!-- PROMO KREDIT -->
<div class="promo-section">
    <div class="promo-heading text-center">
        <h2 class="fw-bolder">PROMO KREDIT UNIT HYUNDAI</h2>
        <p>Segera konsultasikan harga mobil impian anda sekarang juga <strong>gratis</strong>.</p>
    </div>

    <div class="promo-container d-flex justify-content-center gap-4">
        <div class="promo-item text-center col">
            <i class="bi bi-list-task promo-icon"></i>
            <h3>Pricelist Terbaru</h3>
            <a href="{{ sales_route('pricelist') }}" class="promo-button">Selengkapnya &rarr;</a>
        </div>
        <div class="promo-item text-center col">
            <i class="bi bi-credit-card promo-icon"></i>
            <h3>Proses Kredit</h3>
            <a href="{{ sales_route('proses-kredit') }}" class="promo-button">Selengkapnya &rarr;</a>
        </div>
        <div class="promo-item text-center col">
            <i class="bi bi-pencil-square promo-icon"></i>
            <h3>Simulasi Kredit</h3>
            <a href="{{ sales_route('simulasi-kredit') }}" class="promo-button">Selengkapnya &rarr;</a>
        </div>
    </div>
</div>

<!-- Test Drive -->
<div class="text-center mb-3 full-bg pattern-bg d-flex align-items-center justify-content-center">
    <div class="content-container d-flex align-items-center justify-content-center">
        <div class="image-container">
            <img class="rounded-2 img-fluid" src="{{ asset('images/hyundai-creta-fitur-5.webp') }}" alt="Hyundai Creta Feature">
        </div>
        <div class="text-container">
            <h3>Test Drive Hyundai</h3>
            <p>Yuk Test Drive Sebelum Membeli, Rasakan Pengalaman Mengendarai <strong>Mobil Hyundai</strong>, Ajak Serta Keluarga Anda.</p>
            <a href="{{ sales_route('tes-drive') }}" class="testdrive-button text-decoration-none">
                <i class="bi bi-whatsapp"></i> Daftar Test Drive
            </a>
        </div>
    </div>
</div>

<!-- Pricelist -->
<div class="pricelist-section">
    <div class="pricelist-heading">
        <h2>Segera konsultasikan harga mobil impian anda sekarang juga</h2>
        @if (active_sales()?->whatsappLink())
            <a href="{{ active_sales()->whatsappLink() }}" target="_blank" rel="noopener"
               class="btn btn-success btn-lg mt-3">
                <i class="bi bi-whatsapp me-2" aria-hidden="true"></i> Hubungi {{ active_sales()->name }}
            </a>
        @endif
        <div class="btn-container">
            <a href="{{ sales_route('pricelist') }}" class="btn btn-download">
                Unduh Pricelist <i class="bi bi-file-earmark-arrow-down"></i>
            </a>
        </div>
    </div>
</div>
