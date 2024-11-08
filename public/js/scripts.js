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
            slidesPerView: 3,
            spaceBetween: 5
            },
            // when window width is >= 480px
            480: {
            slidesPerView: 3,
            spaceBetween: 5
            },
            // when window width is >= 640px
            640: {
            slidesPerView: 3,
            spaceBetween: 10
            },
            769: {
            slidesPerView: 3,
            spaceBetween: 10
            },
            1029: {
            slidesPerView: 5,
            spaceBetween: 5
            }
        }
    }
);

        // Display cars
        const cars = [
            {
                name: "HYUNDAI STARGAZER",
                price: "Rp249.600.000",
                image: "/images/car/Hyundai-Stargazer.png",
                categories: ["mpv"]
            },
            {
                name: "HYUNDAI CRETA",
                price: "Rp297.000.000",
                image: "/images/car/Hyundai-Creta.png",
                categories: ["suv"]
            },
            {
                name: "HYUNDAI STARGAZER X",
                price: "Rp335.800.000",
                image: "/images/car/Stargazer-X.png",
                categories: ["mpv"]
            },
            {
                name: "HYUNDAI KONA ELECTRIC",
                price: "Rp297.000.000",
                image: "/images/car/Hyundai-kona.png",
                categories: ["eco"]
            },
            {
                name: "HYUNDAI SANTA FE",
                price: "Rp625.000.000",
                image: "/images/car/Hyundai-SANTA-Fe.png",
                categories: ["suv"]
            },
            {
                name: "HYUNDAI IONIQ 5",
                price: "Rp399.000.000",
                image: "/images/car/Hyundai-ioniq-5.png",
                categories: ["eco"]
            },
            {
                name: "ALL NEW SANTA FE",
                price: "Rp869.600.000",
                image: "/images/car/ALL-NEW-SANTA.png",
                categories: ["suv"]
            },
            {
                name: "HYUNDAI PALISADE",
                price: "Rp910.000.000",
                image: "/images/car/Hyundai-Palisade.png",
                categories: ["suv"]
            },
            {
                name: "HYUNDAI STARIA",
                price: "Rp924.000.000",
                image: "/images/car/Hyundai-Staria.png",
                categories: ["mpv"]
            },
            {
                name: "HYUNDAI IONIQ 6",
                price: "Rp1.220.000.000",
                image: "/images/car/Hyundai-IONIQ-6.png",
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

        // Function untuk memanggil mobil di form simulasi
        function populateCarTypes() {
            const carTypeSelect = document.getElementById('carType');

            cars.forEach(car => {
                const option = document.createElement('option');
                option.value = car.name;
                option.textContent = car.name;
                carTypeSelect.appendChild(option);
            });
        }
        document.addEventListener('DOMContentLoaded', populateCarTypes);


        //Finance
        const imageData = {
            "images": [
                {
                    "src": "images/finance/LOGO-BAF.jpg",
                    "alt": "Slide 1",
                    "class": "img-fluid finance-logo"
                },
                {
                    "src": "images/finance/LOGO-BCA-FINANCE-1.jpg",
                    "alt": "Slide 2",
                    "class": "img-fluid finance-logo"
                },
                {
                    "src": "images/finance/LOGO-BRI-FINANCE.jpg",
                    "alt": "Slide 3",
                    "class": "img-fluid finance-logo"
                },
                {
                    "src": "images/finance/LOGO-CIMB-FINANCE.jpg",
                    "alt": "Slide 4",
                    "class": "img-fluid finance-logo"
                },
                {
                    "src": "images/finance/LOGO-CLIPAN-FINANCE.jpg",
                    "alt": "Slide 5",
                    "class": "img-fluid finance-logo"
                },
                {
                    "src": "images/finance/LOGO-IMFI.jpg",
                    "alt": "Slide 6",
                    "class": "img-fluid finance-logo"
                },
                {
                    "src": "images/finance/LOGO-INDOMOBIL-FINANCE.jpg",
                    "alt": "Slide 7",
                    "class": "img-fluid finance-logo"
                },
                {
                    "src": "images/finance/LOGO-MAF-1.jpg",
                    "alt": "Slide 8",
                    "class": "img-fluid finance-logo"
                },
                {
                    "src": "images/finance/LOGO-MANDIRI-TUNAS-FINANCE.jpg",
                    "alt": "Slide 9",
                    "class": "img-fluid finance-logo"
                },
                {
                    "src": "images/finance/LOGO-MAYBANK-1.jpg",
                    "alt": "Slide 10",
                    "class": "img-fluid finance-logo"
                }
            ]
        };
    
        const imageContainer = document.getElementById('imageContainer');
        imageData.images.forEach(image => {
            const slideDiv = document.createElement('div');
            slideDiv.className = 'swiper-slide';
    
            const img = document.createElement('img');
            img.src = image.src;
            img.alt = image.alt;
            img.className = image.class;
    
            slideDiv.appendChild(img);
            imageContainer.appendChild(slideDiv);
        });    

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
                    },
                    769: {
                        slidesPerView: 2,
                        spaceBetween: 30
                    },
                    1029: {
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
                        slidesPerView: 2,
                        spaceBetween: 40
                    },
                    769: {
                        slidesPerView: 2,
                        spaceBetween: 5
                    },
                    1029: {
                        slidesPerView: 3,
                        spaceBetween: 5
                    }
                }
            });
        }
        document.addEventListener('DOMContentLoaded', displayGalleryImages);
