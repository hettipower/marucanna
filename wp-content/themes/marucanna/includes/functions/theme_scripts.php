<?php


/*------------------------------------*\
    THEME SCRIPTS
\*------------------------------------*/

use MatthiasMullie\Minify;

add_action('init', 'combine_all_js_func');
function combine_all_js_func()
{
    
    $last_minified = get_field('js_minified_time', 'option');
    $minify_assets = get_field( 'minify_assets', 'option' );

    $current_date = new DateTime('now');

    if (!empty($last_minified)) {
        $date = date_create_from_format('Y-m-d H:i:s', $last_minified);
        $date_differnce = $date->diff($current_date);
    }

    if ($minify_assets && (empty($last_minified) || $date_differnce->days >= 1)) {

        if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

            //Bootstrap Minify js
            $popper = get_theme_file_path('vendor/bootstrap/popper.min.js');
            $bootstrap_minifier = new Minify\JS($popper);

            $bootstrap = get_theme_file_path('vendor/bootstrap/bootstrap.min.js');
            $bootstrap_minifier->add($bootstrap);

            $bootstrap_minifiedPath = get_theme_file_path('js/bootstrap.combined.min.js');
            $bootstrap_minifier->minify($bootstrap_minifiedPath);

            //Main minify js
            $slick = get_theme_file_path('vendor/slick/slick.min.js');
            $minifier = new Minify\JS($slick);

            $phonemask = get_theme_file_path('vendor/phonemask/phonemask.js');
            $minifier->add($phonemask);

            $scripts = get_theme_file_path('js/scripts.js');
            $minifier->add($scripts);

            $minifiedPath = get_theme_file_path('js/scripts.combined.min.js');
            $minifier->minify($minifiedPath);

            update_field('js_minified_time', $current_date->format('Y-m-d H:i:s'), 'option');
        }
    }
    
    if(!$minify_assets) {
        update_field('js_minified_time', '', 'option');
    }
}

function html5blank_header_scripts()
{

    $minify_assets = get_field( 'minify_assets', 'option' );

    if( is_page_template( 'page-doctor-dashboard.php' ) ) {
        wp_register_script('datatable', get_template_directory_uri() . '/vendor/datatable/datatables.min.js', array('jquery'), false, true);
        wp_enqueue_script('datatable');
    }

    if( is_page_template( 'page-patient-dashboard.php' ) || is_author() ) {
        wp_register_script('fancybox', get_template_directory_uri() . '/vendor/fancybox/fancybox.umd.js', array('jquery'), false, true);
        wp_enqueue_script('fancybox');
    }

    if( function_exists('get_field') && is_page_template( 'page-contact.php' ) ) {
        $google_map_key = get_field( 'google_map_key', 'option' );
        if( $google_map_key ) {
            wp_register_script('google-map', 'https://maps.googleapis.com/maps/api/js?key='.$google_map_key.'&callback=Function.prototype', array('jquery'), false, true);
            wp_enqueue_script('google-map');
        }
    }

    if( is_page_template( 'page-patient-dashboard.php' ) || is_author() ) {
        wp_register_script('sweetalert2', get_template_directory_uri() . '/vendor/sweetalert2/sweetalert2.min.js', array('jquery'), true, true);
        wp_enqueue_script('sweetalert2');
    }

    if( $minify_assets ) {

        wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.combined.min.js', array('jquery'), false, false);
        wp_enqueue_script('bootstrap');

        wp_register_script('themescript', get_template_directory_uri() . '/js/scripts.combined.min.js', array('jquery'), false, true); 
        wp_enqueue_script('themescript');

    } else {
        wp_register_script('popper', get_template_directory_uri() . '/vendor/bootstrap/popper.min.js', array('jquery'), false, false); // Custom scripts
        wp_enqueue_script('popper'); // Enqueue it! 

        wp_register_script('bootstrap', get_template_directory_uri() . '/vendor/bootstrap/bootstrap.min.js', array('jquery'), false, false); // Custom scripts
        wp_enqueue_script('bootstrap'); // Enqueue it! 

        wp_register_script('slick', get_template_directory_uri() . '/vendor/slick/slick.min.js', array('jquery'), false, true); // Custom scripts
        wp_enqueue_script('slick');

        wp_register_script('phonemask', get_template_directory_uri() . '/vendor/phonemask/phonemask.js', array('jquery'), false, true);
        wp_enqueue_script('phonemask');
        
        wp_register_script('themescript', get_template_directory_uri() . '/js/scripts.js', array('jquery'), false, true); // Custom scripts
        wp_enqueue_script('themescript'); // Enqueue it! 
    }


    $localize_args = array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
    );

    if( is_page_template( 'page-appointment-booking.php' ) ) {
        $localize_args['gpLists'] = get_all_gp_list_data();
        $localize_args['gpPostalCodes'] = get_all_gp_postal_codes();
    }

    wp_localize_script('themescript', 'CUSTOM_PARAMS', $localize_args);
    
}
add_action('wp_enqueue_scripts', 'html5blank_header_scripts');

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