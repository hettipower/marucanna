function header_ticker() {
    jQuery('#main_header .top_navbar .content_wrap').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 0,
        speed: 8000,
        cssEase:'linear',
        arrows: false,
        dots:false,
        infinite: true
    });
}