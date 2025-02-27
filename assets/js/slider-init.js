document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.swiper', {
        slidesPerView: 4,
        spaceBetween: 42,
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            1400: {
                slidesPerView: 4,
                spaceBetween: 42,
            },
            1201: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            0: {
                slidesPerView: 2,
                spaceBetween: 11,
            },
        }
    });
});