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


        // Display cars
        const cars = [
            {
                name: "HYUNDAI STARGAZER",
                price: "Rp249.600.000",
                image: "/images/Hyundai-Stargazer.png",
                categories: ["mpv"]
            },
            {
                name: "HYUNDAI CRETA",
                price: "Rp297.000.000",
                image: "/images/Hyundai-Creta.png",
                categories: ["suv"]
            },
            {
                name: "HYUNDAI STARGAZER X",
                price: "Rp335.800.000",
                image: "/images/Stargazer-X.png",
                categories: ["mpv"]
            },
            {
                name: "HYUNDAI KONA ELECTRIC",
                price: "Rp297.000.000",
                image: "/images/Hyundai-kona.png",
                categories: ["eco"]
            },
            {
                name: "HYUNDAI SANTA FE",
                price: "Rp625.000.000",
                image: "/images/Hyundai-SANTA-Fe.png",
                categories: ["suv"]
            },
            {
                name: "HYUNDAI IONIQ 5",
                price: "Rp399.000.000",
                image: "/images/Hyundai-ioniq-5.png",
                categories: ["eco"]
            },
            {
                name: "ALL NEW SANTA FE",
                price: "Rp869.600.000",
                image: "/images/ALL-NEW-SANTA.png",
                categories: ["suv"]
            },
            {
                name: "HYUNDAI PALISADE",
                price: "Rp910.000.000",
                image: "/images/Hyundai-Palisade.png",
                categories: ["suv"]
            },
            {
                name: "HYUNDAI STARIA",
                price: "Rp924.000.000",
                image: "/images/Hyundai-Staria.png",
                categories: ["mpv"]
            },
            {
                name: "HYUNDAI IONIQ 6",
                price: "Rp1.220.000.000",
                image: "/images/Hyundai-IONIQ-6.png",
                categories: ["eco"]
            }
        ];        
    
        function displayCars() {
            document.getElementById('allCars').innerHTML = '';
            document.getElementById('ecoCars').innerHTML = '';
            document.getElementById('suvCars').innerHTML = '';
            document.getElementById('mpvCars').innerHTML = '';
    
            cars.forEach(car => {
                const carCard = `
                    <div class="col-md-4 col-lg-4 mb-4 d-flex align-items-stretch">
                        <div class="card text-center">
                            <img src="${car.image}" class="card-img-top car-image" alt="${car.name}">
                            <div class="card-body">
                                <h5 class="card-title font-weight-semibold">${car.name}</h5>
                                <p class="card-text">${car.price}</p>
                            </div>
                            <a href="#" class="btn btn-primary btn-full">Selengkapnya</a>
                        </div>
                    </div>
                `;
    
                document.getElementById('allCars').innerHTML += carCard;
                car.categories.forEach(category => {
                    document.getElementById(category + 'Cars').innerHTML += carCard;
                });
            });
        }
    
        document.addEventListener('DOMContentLoaded', displayCars);


        // Promo Images
        const promoImages = [];
        for (let i = 1; i <= 7; i++) {
            const formattedNumber = String(i).padStart(4, '0'); 
            promoImages.push(`/images/Promo/IMG-20240911-WA${formattedNumber}.jpg`);
        }

        function displayPromoImages() {
            const promoSwiperWrapper = document.querySelector('.mySwiper .swiper-wrapper');
            if (!promoSwiperWrapper) return; 
            promoSwiperWrapper.innerHTML = ''; 

            promoImages.forEach(image => {
                const slide = document.createElement('div');
                slide.classList.add('swiper-slide');
                slide.innerHTML = `<img src="${image}" alt="Slide Image" class="img-fluid">`;
                promoSwiperWrapper.appendChild(slide);
            });

            new Swiper(".mySwiper", {
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
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    },
                    480: {
                        slidesPerView: 2,
                        spaceBetween: 30
                    },
                    640: {
                        slidesPerView: 3,
                        spaceBetween: 40
                    }
                }
            });
        }
        document.addEventListener('DOMContentLoaded', displayPromoImages);


        // Gallery Images
        const galleryImages = [];
        const galleryImageCount = 7;

        for (let i = 1; i <= galleryImageCount; i++) {
            galleryImages.push(`/images/Galeri/Galeri-Hyundai-${i}.png`);
        }

        function displayGalleryImages() {
            const gallerySwiperWrapper = document.querySelector('.newSwiper .swiper-wrapper');
            if (!gallerySwiperWrapper) return; 
            gallerySwiperWrapper.innerHTML = '';

            galleryImages.forEach((image, index) => {
                const slide = document.createElement('div');
                slide.classList.add('swiper-slide');
                slide.innerHTML = `<img src="${image}" alt="Slide ${index + 1}" class="img-fluid">`;
                gallerySwiperWrapper.appendChild(slide);
            });

            new Swiper(".newSwiper", {
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
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    },
                    480: {
                        slidesPerView: 2,
                        spaceBetween: 30
                    },
                    640: {
                        slidesPerView: 3,
                        spaceBetween: 40
                    }
                }
            });
        }
        document.addEventListener('DOMContentLoaded', displayGalleryImages);
