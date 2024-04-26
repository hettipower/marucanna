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

function menu_dropdown() {
    jQuery('.nav-item.dropdown').hover(function() {
        jQuery(this).find('.dropdown-menu').addClass('show');
    }, function() {
        jQuery(this).find('.dropdown-menu').removeClass('show');
    });

    jQuery('.nav-item.dropdown .dropdown-toggle').on('click' , function(){

        var link = jQuery(this).attr('href');
        window.location.href = link;

    });
}

function mobile_menu(){

    jQuery('header .navbar .container-fluid .navbar-toggler').on('click' , function(){

        jQuery('html').toggleClass('menu-open');

    });

}