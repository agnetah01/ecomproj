import Swiper from "swiper/bundle";
import "swiper/css/bundle";

const swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 1,
    loop: true,
    loopFillGroupWithBlank: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    breakpoints: {
        "@0.00": {
            slidesPerView: 1,
            spaceBetween: 1,
        },
        "@0.75": {
            slidesPerView: 2,
            spaceBetween: 2,
        },
        "@1.00": {
            slidesPerView: 3,
            spaceBetween: 4,
        },
        "@1.50": {
            slidesPerView: 4,
            spaceBetween: 5,
        },
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});

// ===================start header slider=================//

const items = [
    {
        position: 0,
        el: document.getElementById("carousel-item-1"),
    },
    {
        position: 1,
        el: document.getElementById("carousel-item-2"),
    },
    {
        position: 2,
        el: document.getElementById("carousel-item-3"),
    },
];

const options = {
    activeItemPosition: 1,
    interval: 3000,
};

const carousel = new Carousel(items, options);
carousel.cycle();
// ===================End header slider=================//

$(".image-wrapper").mouseenter(function () {
    $(this).find(".expand").removeClass("opacity-0");
});

$(".image-wrapper").mouseleave(function () {
    $(this).find(".expand").addClass("opacity-0");
});

$(".filter").click(function () {
    const id = $(this).attr("id");
    const element = $(`[data-filter-name=${id}]`);
    element.toggleClass("max-h-0");
    element.toggleClass("max-h-[100rem]");
    let sign = element.hasClass("max-h-0") ? "+" : "-";
    $(this).children("[id=sign]").text(sign);
});
