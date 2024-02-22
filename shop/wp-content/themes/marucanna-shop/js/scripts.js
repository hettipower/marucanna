/*! css 1.0.0 filename.js 2024-02-23 1:13:20 AM */

jQuery(document).ready(function($) {
    toggle_mini_cart();
    menu_dropdown();
});

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

function toggle_mini_cart() {
    var targetElement = jQuery("#mp-minicart-wrap");
    jQuery("#sliding_cart").on("click", function() {
        jQuery("body").toggleClass("open-minicart");
        jQuery("#mp-minicart-wrap").toggleClass("active");
        return false;
    });
    jQuery("#minicart-close").on("click", function() {
        jQuery("body").toggleClass("open-minicart");
        jQuery("#mp-minicart-wrap").toggleClass("active");
        return false;
    });
    jQuery(document).click(function(event) {
        if (!targetElement.is(event.target) && !targetElement.has(event.target).length) {
            jQuery("body").removeClass("open-minicart");
            jQuery("#mp-minicart-wrap").removeClass("active");
        }
    });
    jQuery(document).ready(function($) {
        $(document).on("added_to_cart", function(event, fragments, cart_hash, $button) {
            jQuery("body").toggleClass("open-minicart");
            jQuery("#mp-minicart-wrap").toggleClass("active");
        });
    });
}