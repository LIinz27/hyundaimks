<!-- Footer -->
<footer class="footer">
    <div class="container p-4">
        <div class="row text-center text-md-left">
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5>Hyundai Mobil Pettarani</h5>
                <p>
                    Jl. A. P. Pettarani No.55, Bua Kana, Kec. Rappocini, Kota Makassar, Sulawesi Selatan 90231, Indonesia
                </p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.6741777767293!2d119.43534717425133!3d-5.15602616659745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee3785c0d47d7%3A0x5c6e300074880996!2sHyundai%20Pettarani%20Official!5e0!3m2!1sid!2ssg!4v1730361990363!5m2!1sid!2ssg" 
                        width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5>Tautan Cepat</h5>
                <ul class="list-unstyled">
                    <li><i class="bi bi-arrow-right-circle-fill"></i> <a href="/">Beranda</a></li>
                    <li><i class="bi bi-arrow-right-circle-fill"></i> <a href="/pricelist">Pricelist Terbaru</a></li>
                    <li><i class="bi bi-arrow-right-circle-fill"></i> <a href="/proses-kredit">Proses Kredit</a></li>
                    <li><i class="bi bi-arrow-right-circle-fill"></i> <a href="/simulasi-kredit">Simulasi Kredit</a></li>
                    <li><i class="bi bi-arrow-right-circle-fill"></i> <a href="/tes-drive">Tes Drive</a></li>
                    <li><i class="bi bi-arrow-right-circle-fill"></i> <a href="/portofolio">Galeri</a></li>
                    <li><i class="bi bi-arrow-right-circle-fill"></i> <a href="/kontak">Kontak</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5>Tipe Mobil</h5>
                <ul class="list-unstyled">
                    <li><i class="bi bi-chevron-double-right"></i> <a href="/product/stargazer">Hyundai Stargazer</a></li>
                    <li><i class="bi bi-chevron-double-right"></i> <a href="/product/creta">Hyundai Creta</a></li>
                    <li><i class="bi bi-chevron-double-right"></i> <a href="/product/santa-fe">Hyundai Santa FE</a></li>
                    <li><i class="bi bi-chevron-double-right"></i> <a href="/product/palisade">Hyundai Palisade</a></li>
                    <li><i class="bi bi-chevron-double-right"></i> <a href="/product/staria">Hyundai Staria</a></li>
                    <li><i class="bi bi-chevron-double-right"></i> <a href="/product/ioniq5">Hyundai Ioniq 5</a></li>
                    <li><i class="bi bi-chevron-double-right"></i> <a href="/product/kona-electric">Hyundai Kona Electric</a></li>
                    <li><i class="bi bi-chevron-double-right"></i> <a href="/product/all-new-santa-fe">All New Santa Fe</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5>Total Pengunjung</h5>
                <p class="visitor-counter">006383</p>
                <ul class="list-unstyled">
                    <li>👤 Users Today: 12</li>
                    <li>👥 Users Yesterday: 15</li>
                    <li>👤 Users Last 7 days: 1014</li>
                    <li>📊 Total Users: 6383</li>
                    <li>📅 Views Today: 22</li>
                    <li>📅 Views Last 7 days: 2134</li>
                    <li>📊 Total views: 12518</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bubble Head HTML -->
<div class="bubble-head" onclick="toggleDropup()">
    <i class="bi bi-chat-dots"></i> Hubungi Kami
</div>

<div class="dropup-content" id="dropup">
    <a href="https://wa.me/1234567890" target="_blank"><i class="bi bi-whatsapp"></i> WhatsApp</a>
    <a href="mailto:contact@example.com"><i class="bi bi-envelope"></i> Email</a>
    <a href="tel:+1234567890"><i class="bi bi-telephone"></i> Telepon</a>
</div>

<script>
    function toggleDropup() {
        var dropup = document.getElementById("dropup");
        dropup.style.display = (dropup.style.display === "block") ? "none" : "block";
    }

    window.onclick = function(event) {
        var dropup = document.getElementById("dropup");
        var bubbleHead = document.querySelector(".bubble-head");
        if (event.target !== bubbleHead && !bubbleHead.contains(event.target)) {
            dropup.style.display = "none";
        }
    };
</script>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>

