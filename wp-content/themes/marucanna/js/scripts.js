/*! css 1.0.0 filename.js 2024-09-10 11:39:00 PM */

if (jQuery("body").hasClass("author") || jQuery("body").hasClass("page-template-page-patient-dashboard")) {
    Fancybox.bind("[data-fancybox]", {});
}

jQuery(document).ready(function($) {
    our_team_slider();
    sticky_header();
    menu_dropdown();
    patients_datatable();
    mobile_menu();
    select_gp_postalcode();
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

function select_gp_postalcode() {
    if (jQuery("body").hasClass("page-template-page-appointment-booking")) {
        jQuery("#input_1_121").on("change", function() {
            var selectedValues = jQuery(this).val();
            var lists = jQuery.grep(CUSTOM_PARAMS.gpLists, function(item) {
                return item.postal_code === selectedValues;
            });
            create_gp_lists(lists);
        });
    }
}

function create_gp_lists(lists) {
    var listDiv = document.getElementById("gp_list_wrap");
    var gpListModalEle = document.getElementById("gpListModal");
    var gpListModal = new bootstrap.Modal(gpListModalEle);
    var item;
    listDiv.innerHTML = "";
    for (i = 0; i < lists.length; i++) {
        item = document.createElement("DIV");
        item.setAttribute("data-id", lists[i].ID);
        item.setAttribute("class", "item");
        item.innerHTML += "<p>" + lists[i].practice_name + "</p>";
        item.innerHTML += "<p>" + lists[i].address_line1 + "</p>";
        item.innerHTML += "<p>" + lists[i].address_line2 + "</p>";
        item.innerHTML += "<p>" + lists[i].address_line3 + "</p>";
        item.innerHTML += "<p>" + lists[i].address_line4 + "</p>";
        item.innerHTML += "<p>" + lists[i].town + "</p>";
        item.innerHTML += "<p>" + lists[i].phone + "</p>";
        item.innerHTML += "<p>" + lists[i].postal_code + "</p>";
        item.innerHTML += "<input type='hidden' value='" + lists[i].ID + "'>";
        item.addEventListener("click", function(e) {
            var clickedVal = parseInt(this.getElementsByTagName("input")[0].value);
            var selectedGP = jQuery.grep(CUSTOM_PARAMS.gpLists, function(item) {
                return item.ID === clickedVal;
            });
            jQuery("#input_1_103").val(selectedGP[0].practice_name);
            jQuery("#input_1_104_1").val(selectedGP[0].address_line1 + " " + selectedGP[0].address_line2);
            jQuery("#input_1_104_2").val(selectedGP[0].address_line3 + " " + selectedGP[0].address_line4);
            jQuery("#input_1_105").val(selectedGP[0].town);
            jQuery("#input_1_109").val(selectedGP[0].phone);
            gpListModal.hide();
        });
        listDiv.appendChild(item);
    }
    gpListModal.show();
}

function sticky_header() {
    jQuery(window).scroll(function() {
        var scrollPosition = jQuery(this).scrollTop();
        if (scrollPosition >= 2) {
            jQuery("body").addClass("sticky-header");
        } else {
            jQuery("body").removeClass("sticky-header");
        }
    });
}

function menu_dropdown() {
    var windowWidth = jQuery(window).width();
    if (windowWidth > 991) {
        jQuery(".nav-item.dropdown").hover(function() {
            jQuery(this).find(".dropdown-menu").addClass("show");
        }, function() {
            jQuery(this).find(".dropdown-menu").removeClass("show");
        });
    } else {
        jQuery("nav-item.dropdown .dropdown-click").on("click", function() {
            jQuery(this).find(".dropdown-menu").toggleClass("show");
            return false;
        });
    }
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