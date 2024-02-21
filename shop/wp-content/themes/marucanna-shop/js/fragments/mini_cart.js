function toggle_mini_cart() {

    var targetElement = jQuery('#mp-minicart-wrap');

    jQuery('#sliding_cart').on('click' , function() {
        jQuery('body').toggleClass('open-minicart');
        jQuery('#mp-minicart-wrap').toggleClass('active');

        return false;
    });

    jQuery('#minicart-close').on('click' , function() {
        jQuery('body').toggleClass('open-minicart');
        jQuery('#mp-minicart-wrap').toggleClass('active');

        return false;
    });

    // Handle click events on the document
    jQuery(document).click(function(event) {
        // Check if the click occurred outside the target element
        if (!targetElement.is(event.target) && !targetElement.has(event.target).length) {
            jQuery('body').removeClass('open-minicart');
            jQuery('#mp-minicart-wrap').removeClass('active');
        }
    });

    // Open Cart after add to cart
    jQuery(document).ready(function($) {
        // Bind to the added_to_cart event
        $(document).on('added_to_cart', function(event, fragments, cart_hash, $button) {
            jQuery('body').toggleClass('open-minicart');
            jQuery('#mp-minicart-wrap').toggleClass('active');
        });
    });
}