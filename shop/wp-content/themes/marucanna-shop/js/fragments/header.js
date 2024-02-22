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