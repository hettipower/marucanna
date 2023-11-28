function sticky_header(){
    jQuery(window).scroll(function() {
        var scrollPosition = jQuery(this).scrollTop();
        if( scrollPosition >= 510 ) {
            jQuery('body').addClass('sticky-header');
        } else {
            jQuery('body').removeClass('sticky-header');
        }
    });
}