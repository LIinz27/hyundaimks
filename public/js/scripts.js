let lastScrollTop = 0; // Keeps track of the last scroll position
const header = document.getElementById("header"); // Get the header element

window.addEventListener("scroll", function () {
    let currentScroll =
        window.pageYOffset || document.documentElement.scrollTop;

    if (currentScroll > lastScrollTop) {
        // If user scrolls down, hide the header
        header.classList.add("hidden");
    } else {
        // If user scrolls up, show the header
        header.classList.remove("hidden");
    }

    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Prevent negative values
});

// Display cars — uses server-provided list if available (homepage), else fallback
const cars =
    typeof window._cars !== "undefined" && window._cars.length
        ? window._cars
        : [
              {
                  name: "HYUNDAI STARGAZER",
                  price: "Rp249.600.000",
                  image: "/images/car/Hyundai-Stargazer.png",
                  categories: ["mpv"],
                  url: "/product/stargazer",
              },
              {
                  name: "HYUNDAI CRETA",
                  price: "Rp297.000.000",
                  image: "/images/car/Hyundai-Creta.png",
                  categories: ["suv"],
                  url: "/product/creta",
              },
              {
                  name: "HYUNDAI STARGAZER X",
                  price: "Rp335.800.000",
                  image: "/images/car/Stargazer-X.png",
                  categories: ["mpv"],
                  url: "/product/stargazer-x",
              },
              {
                  name: "HYUNDAI KONA ELECTRIC",
                  price: "Rp297.000.000",
                  image: "/images/car/Hyundai-kona.png",
                  categories: ["eco"],
                  url: "/product/hyundai-kona",
              },
              {
                  name: "HYUNDAI SANTA FE",
                  price: "Rp625.000.000",
                  image: "/images/car/Hyundai-SANTA-Fe.png",
                  categories: ["suv"],
                  url: "/product/santa-fe",
              },
              {
                  name: "HYUNDAI IONIQ 5",
                  price: "Rp399.000.000",
                  image: "/images/car/Hyundai-ioniq-5.png",
                  categories: ["eco"],
                  url: "/product/ioniq-5",
              },
              {
                  name: "ALL NEW SANTA FE",
                  price: "Rp869.600.000",
                  image: "/images/car/ALL-NEW-SANTA.png",
                  categories: ["suv"],
                  url: "/product/all-new-santa-fe",
              },
              {
                  name: "HYUNDAI PALISADE",
                  price: "Rp910.000.000",
                  image: "/images/car/Hyundai-Palisade.png",
                  categories: ["suv"],
                  url: "/product/palisade",
              },
              {
                  name: "HYUNDAI STARIA",
                  price: "Rp924.000.000",
                  image: "/images/car/Hyundai-Staria.png",
                  categories: ["mpv"],
                  url: "/product/staria",
              },
              {
                  name: "HYUNDAI IONIQ 6",
                  price: "Rp1.220.000.000",
                  image: "/images/car/Hyundai-IONIQ-6.png",
                  categories: ["eco"],
                  url: "/product/ioniq-6",
              },
          ];

function displayCars() {
    if (!document.getElementById("allCars")) return;
    document.getElementById("allCars").innerHTML = "";
    document.getElementById("ecoCars").innerHTML = "";
    document.getElementById("suvCars").innerHTML = "";
    document.getElementById("mpvCars").innerHTML = "";

    cars.forEach((car) => {
        const carCard = `
            <div class="col-md-4 col-lg-4 mb-4 d-flex align-items-stretch">
                <div class="card text-center">
                    <img src="${car.image}" class="card-img-top car-image" alt="${car.name}">
                    <div class="card-body">
                        <h5 class="card-title font-weight-semibold">${car.name}</h5>
                        <p class="card-text">${car.price}</p>
                    </div>
                    <a href="${car.url}" class="btn btn-primary btn-full">Selengkapnya</a>
                </div>
            </div>
        `;

        document.getElementById("allCars").innerHTML += carCard;
        car.categories.forEach((category) => {
            document.getElementById(category + "Cars").innerHTML += carCard;
        });
    });
}

document.addEventListener("DOMContentLoaded", displayCars);

//Finance — uses server-provided list if available, else fallback
const _partnerFallback = [
    {
        src: "images/finance/LOGO-BAF.jpg",
        alt: "BAF",
        class: "img-fluid finance-logo",
    },
    {
        src: "images/finance/LOGO-BCA-FINANCE-1.jpg",
        alt: "BCA Finance",
        class: "img-fluid finance-logo",
    },
    {
        src: "images/finance/LOGO-BRI-FINANCE.jpg",
        alt: "BRI Finance",
        class: "img-fluid finance-logo",
    },
    {
        src: "images/finance/LOGO-CIMB-FINANCE.jpg",
        alt: "CIMB Finance",
        class: "img-fluid finance-logo",
    },
    {
        src: "images/finance/LOGO-CLIPAN-FINANCE.jpg",
        alt: "Clipan Finance",
        class: "img-fluid finance-logo",
    },
    {
        src: "images/finance/LOGO-IMFI.jpg",
        alt: "IMFI",
        class: "img-fluid finance-logo",
    },
    {
        src: "images/finance/LOGO-INDOMOBIL-FINANCE.jpg",
        alt: "Indomobil",
        class: "img-fluid finance-logo",
    },
    {
        src: "images/finance/LOGO-MAF-1.jpg",
        alt: "MAF",
        class: "img-fluid finance-logo",
    },
    {
        src: "images/finance/LOGO-MANDIRI-TUNAS-FINANCE.jpg",
        alt: "Mandiri Tunas",
        class: "img-fluid finance-logo",
    },
    {
        src: "images/finance/LOGO-MAYBANK-1.jpg",
        alt: "Maybank",
        class: "img-fluid finance-logo",
    },
];
const imageData = {
    images:
        typeof window._partnerImages !== "undefined" &&
        window._partnerImages.length
            ? window._partnerImages
            : _partnerFallback,
};

const imageContainer = document.getElementById("imageContainer");
if (imageContainer) {
    imageData.images.forEach((image) => {
        const slideDiv = document.createElement("div");
        slideDiv.className = "swiper-slide";
        const img = document.createElement("img");
        img.src = image.src;
        img.alt = image.alt;
        img.className = image.class;
        slideDiv.appendChild(img);
        imageContainer.appendChild(slideDiv);
    });
}

// Promo — sama persis polanya dengan displayGalleryImages
const promoImages =
    typeof window._promoImages !== "undefined" && window._promoImages.length
        ? window._promoImages
        : [];

function displayPromoImages() {
    const promoSwiperWrapper = document.querySelector(
        ".mySwiper .swiper-wrapper",
    );
    if (!promoSwiperWrapper || !promoImages.length) return;
    promoSwiperWrapper.innerHTML = "";
    promoImages.forEach(function (src) {
        const slide = document.createElement("div");
        slide.classList.add("swiper-slide");
        slide.innerHTML = `<img src="${src}" alt="Promo" class="img-fluid">`;
        promoSwiperWrapper.appendChild(slide);
    });
    new Swiper(".mySwiper", {
        autoplay: { delay: 3000, disableOnInteraction: false },
        loop: promoImages.length >= 6,
        slidesPerView: 3,
        spaceBetween: 30,
        pagination: { el: ".mySwiper .swiper-pagination", clickable: true },
        breakpoints: {
            320: { slidesPerView: 1, spaceBetween: 20 },
            480: { slidesPerView: 2, spaceBetween: 30 },
            640: { slidesPerView: 2, spaceBetween: 30 },
            769: { slidesPerView: 2, spaceBetween: 30 },
            1029: { slidesPerView: 3, spaceBetween: 40 },
        },
    });
}
document.addEventListener("DOMContentLoaded", displayPromoImages);

// Gallery Images — uses server-provided list if available (homepage), else fallback
const galleryImages =
    typeof window._galleryImages !== "undefined" && window._galleryImages.length
        ? window._galleryImages
        : (() => {
              const imgs = [];
              for (let i = 1; i <= 7; i++)
                  imgs.push(`/images/Galeri/Galeri-Hyundai-${i}.png`);
              return imgs;
          })();

function displayGalleryImages() {
    const gallerySwiperWrapper = document.querySelector(
        ".newSwiper .swiper-wrapper",
    );
    if (!gallerySwiperWrapper) return;
    gallerySwiperWrapper.innerHTML = "";

    galleryImages.forEach((image, index) => {
        const slide = document.createElement("div");
        slide.classList.add("swiper-slide");
        slide.innerHTML = `<img src="${image}" alt="Slide ${
            index + 1
        }" class="img-fluid">`;
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
                spaceBetween: 20,
            },
            480: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 40,
            },
            769: {
                slidesPerView: 2,
                spaceBetween: 5,
            },
            1029: {
                slidesPerView: 3,
                spaceBetween: 5,
            },
        },
    });
}
document.addEventListener("DOMContentLoaded", displayGalleryImages);

if (document.querySelector(".PartnerSwiper")) {
    new Swiper(".PartnerSwiper", {
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
            320: { slidesPerView: 3, spaceBetween: 5 },
            480: { slidesPerView: 3, spaceBetween: 5 },
            640: { slidesPerView: 3, spaceBetween: 10 },
            769: { slidesPerView: 3, spaceBetween: 10 },
            1029: { slidesPerView: 5, spaceBetween: 10 },
        },
    });
}
