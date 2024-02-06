/*! css 1.0.0 filename.js 2024-02-03 12:32:39 AM */

Fancybox.bind("[data-fancybox]", {});

jQuery(document).ready(function($) {
    our_team_slider();
    sticky_header();
    menu_dropdown();
    patients_datatable();
});

function patients_datatable() {
    new DataTable("#patients_details", {
        language: {
            emptyTable: "No patients available."
        }
    });
}

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

function menu_dropdown() {
    jQuery(".nav-item.dropdown").hover(function() {
        jQuery(this).find(".dropdown-menu").addClass("show");
    }, function() {
        jQuery(this).find(".dropdown-menu").removeClass("show");
    });
    jQuery(".nav-item.dropdown .dropdown-toggle").on("click", function() {
        var link = jQuery(this).attr("href");
        window.location.href = link;
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