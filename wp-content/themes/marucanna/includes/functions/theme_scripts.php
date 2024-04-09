<?php


/*------------------------------------*\
    THEME SCRIPTS
\*------------------------------------*/
use Square\Environment;

function html5blank_header_scripts()
{

    wp_register_script('popper', get_template_directory_uri() . '/vendor/bootstrap/popper.min.js', array('jquery'), false, true); // Custom scripts
    wp_enqueue_script('popper'); // Enqueue it! 

    wp_register_script('bootstrap', get_template_directory_uri() . '/vendor/bootstrap/bootstrap.min.js', array('jquery'), false, true); // Custom scripts
    wp_enqueue_script('bootstrap'); // Enqueue it! 

    wp_register_script('slick', get_template_directory_uri() . '/vendor/slick/slick.min.js', array('jquery'), false, true); // Custom scripts
    wp_enqueue_script('slick');

    /* wp_register_script('datepicker', get_template_directory_uri() . '/vendor/datepicker/bootstrap-datepicker.min.js', array('jquery'), false, true); // Custom scripts
    wp_enqueue_script('datepicker'); */

    /* wp_register_script('dropzone', get_template_directory_uri() . '/vendor/dropzone/dropzone.min.js', array('jquery'), false, true); // Custom scripts
    wp_enqueue_script('dropzone'); */

    wp_register_script('datatable', get_template_directory_uri() . '/vendor/datatable/datatables.min.js', array('jquery'), false, true);
    wp_enqueue_script('datatable');

    wp_register_script('fancybox', get_template_directory_uri() . '/vendor/fancybox/fancybox.umd.js', array('jquery'), false, true);
    wp_enqueue_script('fancybox');

    //wp_register_script('phonemask', get_template_directory_uri() . '/vendor/phonemask/phonemask.js', array('jquery'), false, true);
    //wp_enqueue_script('phonemask');

    if( function_exists('get_field') ) {
        $google_map_key = get_field( 'google_map_key', 'option' );
        if( $google_map_key ) {
            wp_register_script('google-map', 'https://maps.googleapis.com/maps/api/js?key='.$google_map_key.'&callback=Function.prototype', array('jquery'), false, true);
            wp_enqueue_script('google-map');
        }
    }
    
    wp_register_script('themescript', get_template_directory_uri() . '/js/scripts.js', array('jquery'), false, true); // Custom scripts
    wp_enqueue_script('themescript'); // Enqueue it! 

    wp_localize_script('themescript', 'CUSTOM_PARAMS', array('ajaxUrl' => admin_url('admin-ajax.php')));
    
}
add_action('init', 'html5blank_header_scripts');

function mc_enqueue_custom_admin_style( $hook ) {

    /*if ( 'edit.php' != $hook ) {
        return;
    }*/
    
    wp_register_script('sweetalert2', get_template_directory_uri() . '/vendor/sweetalert2/sweetalert2.min.js', array('jquery'), false, true);
    wp_enqueue_script('sweetalert2');

    wp_register_script('themescript-admin', get_template_directory_uri() . '/js/scripts-admin.js', array('jquery'), false, true); // Custom scripts
    wp_enqueue_script('themescript-admin');

    wp_localize_script('themescript-admin', 'MC_ADMIN_PARAMS', array('ajaxUrl' => admin_url('admin-ajax.php')));
    
    wp_register_style('mc-theme-admin', get_template_directory_uri() . '/css/theme-admin.css', array(), false, 'all');
    wp_enqueue_style('mc-theme-admin'); 
}
add_action( 'admin_enqueue_scripts', 'mc_enqueue_custom_admin_style' );