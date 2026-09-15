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

//Finance
const imageData = {
    images: [
        {
            src: "images/finance/LOGO-BAF.jpg",
            alt: "Slide 1",
            class: "img-fluid finance-logo",
        },
        {
            src: "images/finance/LOGO-BCA-FINANCE-1.jpg",
            alt: "Slide 2",
            class: "img-fluid finance-logo",
        },
        {
            src: "images/finance/LOGO-BRI-FINANCE.jpg",
            alt: "Slide 3",
            class: "img-fluid finance-logo",
        },
        {
            src: "images/finance/LOGO-CIMB-FINANCE.jpg",
            alt: "Slide 4",
            class: "img-fluid finance-logo",
        },
        {
            src: "images/finance/LOGO-CLIPAN-FINANCE.jpg",
            alt: "Slide 5",
            class: "img-fluid finance-logo",
        },
        {
            src: "images/finance/LOGO-IMFI.jpg",
            alt: "Slide 6",
            class: "img-fluid finance-logo",
        },
        {
            src: "images/finance/LOGO-INDOMOBIL-FINANCE.jpg",
            alt: "Slide 7",
            class: "img-fluid finance-logo",
        },
        {
            src: "images/finance/LOGO-MAF-1.jpg",
            alt: "Slide 8",
            class: "img-fluid finance-logo",
        },
        {
            src: "images/finance/LOGO-MANDIRI-TUNAS-FINANCE.jpg",
            alt: "Slide 9",
            class: "img-fluid finance-logo",
        },
        {
            src: "images/finance/LOGO-MAYBANK-1.jpg",
            alt: "Slide 10",
            class: "img-fluid finance-logo",
        },
    ],
};

const imageContainer = document.getElementById("imageContainer");
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

// Promo Images
const promoImages = [];
for (let i = 1; i <= 7; i++) {
    const formattedNumber = String(i).padStart(4, "0");
    promoImages.push(`/images/Promo/IMG-20240911-WA${formattedNumber}.jpg`);
}

function displayPromoImages() {
    const promoSwiperWrapper = document.querySelector(
        ".mySwiper .swiper-wrapper"
    );
    if (!promoSwiperWrapper) return;
    promoSwiperWrapper.innerHTML = "";

    promoImages.forEach((image) => {
        const slide = document.createElement("div");
        slide.classList.add("swiper-slide");
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
                spaceBetween: 20,
            },
            480: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            769: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1029: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
        },
    });
}
document.addEventListener("DOMContentLoaded", displayPromoImages);

// Gallery Images
const galleryImages = [];
const galleryImageCount = 7;

for (let i = 1; i <= galleryImageCount; i++) {
    galleryImages.push(`/images/Galeri/Galeri-Hyundai-${i}.png`);
}

function displayGalleryImages() {
    const gallerySwiperWrapper = document.querySelector(
        ".newSwiper .swiper-wrapper"
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
            spaceBetween: 5,
        },
        // when window width is >= 480px
        480: {
            slidesPerView: 3,
            spaceBetween: 5,
        },
        // when window width is >= 640px
        640: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        769: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        1029: {
            slidesPerView: 5,
            spaceBetween: 10,
        },
    },
});

// bublehead

function toggleDropup() {
    var dropup = document.getElementById("dropup");
    dropup.style.display = dropup.style.display === "block" ? "none" : "block";
}

window.onclick = function (event) {
    var dropup = document.getElementById("dropup");
    var bubbleHead = document.querySelector(".bubble-head");
    if (event.target !== bubbleHead && !bubbleHead.contains(event.target)) {
        dropup.style.display = "none";
    }
};
