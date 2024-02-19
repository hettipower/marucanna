function toggle_mini_cart() {
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
}