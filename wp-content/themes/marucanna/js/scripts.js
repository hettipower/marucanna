/*! css 1.0.0 filename.js 2024-05-30 9:21:59 PM */

if (jQuery("body").hasClass("author") || jQuery("body").hasClass("page-template-page-patient-dashboard")) {
    Fancybox.bind("[data-fancybox]", {});
}

jQuery(document).ready(function($) {
    our_team_slider();
    sticky_header();
    menu_dropdown();
    patients_datatable();
    mobile_menu();
});

function patients_datatable() {
    if (jQuery("body").hasClass("page-template-page-doctor-dashboard")) {
        new DataTable("#patients_details", {
            language: {
                emptyTable: "No patients available."
            }
        });
    }
}

(function($) {
    function initMap($el) {
        var $markers = $el.find(".marker");
        var mapArgs = {
            zoom: $el.data("zoom") || 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map($el[0], mapArgs);
        map.markers = [];
        $markers.each(function() {
            initMarker($(this), map);
        });
        centerMap(map);
        return map;
    }
    function initMarker($marker, map) {
        var lat = $marker.data("lat");
        var lng = $marker.data("lng");
        var latLng = {
            lat: parseFloat(lat),
            lng: parseFloat(lng)
        };
        var marker = new google.maps.Marker({
            position: latLng,
            map: map
        });
        map.markers.push(marker);
        if ($marker.html()) {
            var infowindow = new google.maps.InfoWindow({
                content: $marker.html()
            });
            google.maps.event.addListener(marker, "click", function() {
                infowindow.open(map, marker);
            });
        }
    }
    function centerMap(map) {
        var bounds = new google.maps.LatLngBounds();
        map.markers.forEach(function(marker) {
            bounds.extend({
                lat: marker.position.lat(),
                lng: marker.position.lng()
            });
        });
        if (map.markers.length == 1) {
            map.setCenter(bounds.getCenter());
        } else {
            map.fitBounds(bounds);
        }
    }
    $(document).ready(function() {
        $(".acf-map").each(function() {
            var map = initMap($(this));
        });
    });
})(jQuery);

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

function mobile_menu() {
    jQuery("header .navbar .container-fluid .navbar-toggler").on("click", function() {
        jQuery("html").toggleClass("menu-open");
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