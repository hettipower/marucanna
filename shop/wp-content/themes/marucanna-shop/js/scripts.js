/*! css 1.0.0 filename.js 2024-02-19 10:13:05 PM */

Fancybox.bind("[data-fancybox]", {});

jQuery(document).ready(function($) {
    toggle_mini_cart();
});

function toggle_mini_cart() {
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
}