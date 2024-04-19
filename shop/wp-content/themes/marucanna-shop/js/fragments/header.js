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

// Adding sticky header class to menu
function sticky_header(){
    jQuery(window).scroll(function(){
        //if ( jQuery(window).width() > 767) {
            toggle_sticky_header();
        //}
    });
    toggle_sticky_header();
}

function toggle_sticky_header(){
	
	if (window.innerWidth > 767){
		var topamount = 150
	}
	else{
		var topamount = 100
	}
	
    if ( (jQuery(window).scrollTop()) > topamount ) { 
                jQuery('body').addClass('sticky-nav');
    } else {
        jQuery('body').removeClass('sticky-nav');
    }
}