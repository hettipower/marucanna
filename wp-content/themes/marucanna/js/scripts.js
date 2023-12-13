/*! css 1.0.0 filename.js 2023-12-13 10:24:21 PM */

jQuery(document).ready(function($) {
    our_team_slider();
    sticky_header();
});

function sticky_header() {
    jQuery(window).scroll(function() {
        var scrollPosition = jQuery(this).scrollTop();
        if (scrollPosition >= 510) {
            jQuery("body").addClass("sticky-header");
        } else {
            jQuery("body").removeClass("sticky-header");
        }
    });
}

function our_team_slider() {
    jQuery(".team_slider").slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false,
        arrow: true,
        responsive: [ {
            breakpoint: 600,
            settings: {
                slidesToShow: 2
            }
        }, {
            breakpoint: 480,
            settings: {
                slidesToShow: 1
            }
        } ]
    });
}