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
                    <li><i class="bi bi-arrow-right"></i> <a href="/beranda">Beranda</a></li>
                    <li><i class="bi bi-arrow-right"></i> <a href="/pricelist">Pricelist Terbaru</a></li>
                    <li><i class="bi bi-arrow-right"></i> <a href="/proses-kredit">Proses Kredit</a></li>
                    <li><i class="bi bi-arrow-right"></i> <a href="/simulasi-kredit">Simulasi Kredit</a></li>
                    <li><i class="bi bi-arrow-right"></i> <a href="/test-drive">Test Drive</a></li>
                    <li><i class="bi bi-arrow-right"></i> <a href="/galeri">Galeri</a></li>
                    <li><i class="bi bi-arrow-right"></i> <a href="/kontak">Kontak</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5>Tipe Mobil</h5>
                <ul class="list-unstyled">
                    <li><i class="bi bi-chevron-right"></i> <a href="/hyundai-stargazer">Hyundai Stargazer</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="/hyundai-creta">Hyundai Creta</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="/hyundai-santa-fe">Hyundai Santa FE</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="/hyundai-palisade">Hyundai Palisade</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="/hyundai-staria">Hyundai Staria</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="/hyundai-ioniq5">Hyundai Ioniq 5</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="/hyundai-kona-electric">Hyundai Kona Electric</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="/all-new-santa-fe">All New Santa Fe</a></li>
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
</footer>

<!-- Footer CSS -->
<style>
    .footer {
        background-color: #1C4682;
        color: white;
        padding: 40px 0;
        width: 100vw;
        margin-left: calc(50% - 50vw);
        margin-right: calc(50% - 50vw);
    }

    .footer h5 {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: left;
    }

    .footer p, .footer ul li {
        font-size: 14px;
        line-height: 1.6;
        text-align: left;
    }

    .footer ul {
        list-style-type: none;
        padding: 0;
        text-align: left;
    }

    .footer ul li {
        margin-bottom: 10px;
    }

    .footer ul li i {
        margin-right: 5px;
    }

    .footer .visitor-counter {
        font-size: 24px;
        font-weight: bold;
        background: black;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        margin-bottom: 15px;
        display: inline-block;
    }

    .footer a {
        color: #fff;
        text-decoration: none;
    }

    .footer a:hover {
        text-decoration: underline;
    }

    /* Media Query untuk tampilan mobile */
    @media (max-width: 768px) {
        .footer .container {
            text-align: left;
        }

        .footer .row {
            text-align: left;
        }

        .footer .row > div {
            text-align: left;
            margin-bottom: 20px;
        }

        .footer ul {
            padding-left: 20px; /* Menambahkan indentasi agar bullet point terlihat */
        }
    }
</style>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
    
    <script>
        var swiper = new Swiper(".mySwiper", {
        autoplay: {
            delay: 3000, 
            disableOnInteraction: false,
        },
        loop: true, 
        slidesPerView: 3,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            // when window width is >= 320px
            320: {
            slidesPerView: 1,
            spaceBetween: 20
            },
            // when window width is >= 480px
            480: {
            slidesPerView: 2,
            spaceBetween: 30
            },
            // when window width is >= 640px
            640: {
            slidesPerView: 3  ,
            spaceBetween: 40
            }

        }});

        var newSwiper = new Swiper(".newSwiper", {
        autoplay: {
            delay: 3000, 
            disableOnInteraction: false,
        },
        loop: true,
        slidesPerView: 3,
        spaceBetween: 40, 
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            // when window width is >= 320px
            320: {
            slidesPerView: 1,
            spaceBetween: 20
            },
            // when window width is >= 480px
            480: {
            slidesPerView: 2,
            spaceBetween: 30
            },
            // when window width is >= 640px
            640: {
            slidesPerView: 3,
            spaceBetween: 40
            }

        }});

        var PartnerSwiper = new Swiper(".PartnerSwiper", {
        autoplay: {
            delay: 1000, 
            disableOnInteraction: false,
        },
        loop: true,
        slidesPerView: 5,
        spaceBetween: 10, 
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            // when window width is >= 320px
            320: {
            slidesPerView: 1,
            spaceBetween: 10
            },
            // when window width is >= 480px
            480: {
            slidesPerView: 2,
            spaceBetween: 10
            },
            // when window width is >= 640px
            640: {
            slidesPerView: 5,
            spaceBetween: 10
            }

        }});
    </script>

</footer>
</body>
</html>

