$(document).ready(function () {
    var swiper_block_sliders_mobile = new Swiper('.product-gallery-swiper-mobile', {
        direction: 'horizontal',
        slidesPerView: 3,
        slidesPerGroup: 3,
        spaceBetween: 10,
        height: 88,
        loop: true,
        navigation: {
            nextEl: '.product-gallery__swiper-button-next-mobile',
            prevEl: '.product-gallery__swiper-button-prev-mobile',
        },
        on: {
            init: function () {
                checkNavigationVisibilityMobile(this);
            },
            resize: function () {
                checkNavigationVisibilityMobile(this);
            },
        },
    });

    function checkNavigationVisibilityMobile(swiper) {
        var slidesPerView = 3;
        if (swiper.slides.length <= slidesPerView) {
            $(swiper.navigation.nextEl).hide();
            $(swiper.navigation.prevEl).hide();
        } else {
            $(swiper.navigation.nextEl).show();
            $(swiper.navigation.prevEl).show();
        }
    }
});