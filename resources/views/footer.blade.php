@php
    $wa = config('site.contact_whatsapp');
    $phone = config('site.contact_phone');
    $email = config('site.contact_email');
@endphp
<footer class="footer">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h5>Hyundai Mobil Pettarani</h5>
                <p>
                    Jl. A. P. Pettarani No.55, Bua Kana, Kec. Rappocini, Kota Makassar, Sulawesi Selatan 90231, Indonesia
                </p>
                <iframe class="footer-map"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.6741777767293!2d119.43534717425133!3d-5.15602616659745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee3785c0d47d7%3A0x5c6e300074880996!2sHyundai%20Pettarani%20Official!5e0!3m2!1sid!2ssg!4v1730361990363!5m2!1sid!2ssg"
                        width="100%" height="200" allowfullscreen="" loading="lazy"
                        title="Lokasi Hyundai Pettarani Makassar"></iframe>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h5>Tautan Cepat</h5>
                <ul class="list-unstyled">
                    <li><i class="bi bi-arrow-right-circle-fill"></i> <a href="{{ sales_url('/') }}">Beranda</a></li>
                    <li><i class="bi bi-arrow-right-circle-fill"></i> <a href="{{ sales_route('pricelist') }}">Pricelist Terbaru</a></li>
                    <li><i class="bi bi-arrow-right-circle-fill"></i> <a href="{{ sales_route('proses-kredit') }}">Proses Kredit</a></li>
                    <li><i class="bi bi-arrow-right-circle-fill"></i> <a href="{{ sales_route('simulasi-kredit') }}">Simulasi Kredit</a></li>
                    <li><i class="bi bi-arrow-right-circle-fill"></i> <a href="{{ sales_route('tes-drive') }}">Tes Drive</a></li>
                    <li><i class="bi bi-arrow-right-circle-fill"></i> <a href="{{ sales_route('portofolio') }}">Galeri</a></li>
                    <li><i class="bi bi-arrow-right-circle-fill"></i> <a href="{{ sales_route('kontak') }}">Kontak</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h5>Tipe Mobil</h5>
                <ul class="list-unstyled">
                    <li><i class="bi bi-chevron-double-right"></i> <a href="{{ sales_url('/product/stargazer') }}">Hyundai Stargazer</a></li>
                    <li><i class="bi bi-chevron-double-right"></i> <a href="{{ sales_url('/product/creta') }}">Hyundai Creta</a></li>
                    <li><i class="bi bi-chevron-double-right"></i> <a href="{{ sales_url('/product/santa-fe') }}">Hyundai Santa Fe</a></li>
                    <li><i class="bi bi-chevron-double-right"></i> <a href="{{ sales_url('/product/palisade') }}">Hyundai Palisade</a></li>
                    <li><i class="bi bi-chevron-double-right"></i> <a href="{{ sales_url('/product/staria') }}">Hyundai Staria</a></li>
                    <li><i class="bi bi-chevron-double-right"></i> <a href="{{ sales_url('/product/ioniq-5') }}">Hyundai Ioniq 5</a></li>
                    <li><i class="bi bi-chevron-double-right"></i> <a href="{{ sales_url('/product/hyundai-kona') }}">Hyundai Kona Electric</a></li>
                    <li><i class="bi bi-chevron-double-right"></i> <a href="{{ sales_url('/product/all-new-santa-fe') }}">All New Santa Fe</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h5>Total Pengunjung</h5>
                <p class="visitor-counter">006383</p>
                <ul class="list-unstyled">
                    <li>Users Today: 12</li>
                    <li>Users Yesterday: 15</li>
                    <li>Users Last 7 days: 1014</li>
                    <li>Total Users: 6383</li>
                    <li>Views Today: 22</li>
                    <li>Views Last 7 days: 2134</li>
                    <li>Total views: 12518</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bubble-head" onclick="toggleDropup()">
        <i class="bi bi-chat-dots"></i> Hubungi Kami
    </div>

    <div class="dropup-content" id="dropup">
        @if ($wa)
            <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener"><i class="bi bi-whatsapp"></i> WhatsApp</a>
        @else
            <span class="dropup-disabled"><i class="bi bi-whatsapp"></i> WhatsApp belum tersedia</span>
        @endif

        @if ($email)
            <a href="mailto:{{ $email }}"><i class="bi bi-envelope"></i> Email</a>
        @else
            <span class="dropup-disabled"><i class="bi bi-envelope"></i> Email belum tersedia</span>
        @endif

        @if ($phone)
            <a href="tel:{{ $phone }}"><i class="bi bi-telephone"></i> Telepon</a>
        @else
            <span class="dropup-disabled"><i class="bi bi-telephone"></i> Telepon belum tersedia</span>
        @endif
    </div>
</footer>
