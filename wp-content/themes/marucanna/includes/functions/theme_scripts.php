<?php


/*------------------------------------*\
    THEME SCRIPTS
\*------------------------------------*/
function html5blank_header_scripts()
{

    wp_register_script('popper', get_template_directory_uri() . '/vendor/bootstrap/popper.min.js', array('jquery'), false, true); // Custom scripts
    wp_enqueue_script('popper'); // Enqueue it! 

    wp_register_script('bootstrap', get_template_directory_uri() . '/vendor/bootstrap/bootstrap.min.js', array('jquery'), false, true); // Custom scripts
    wp_enqueue_script('bootstrap'); // Enqueue it! 

    wp_register_script('slick', get_template_directory_uri() . '/vendor/slick/slick.min.js', array('jquery'), false, true); // Custom scripts
    wp_enqueue_script('slick');

    wp_register_script('datepicker', get_template_directory_uri() . '/vendor/datepicker/bootstrap-datepicker.min.js', array('jquery'), false, true); // Custom scripts
    wp_enqueue_script('datepicker');

    wp_register_script('dropzone', get_template_directory_uri() . '/vendor/dropzone/dropzone.min.js', array('jquery'), false, true); // Custom scripts
    wp_enqueue_script('dropzone');
    
    wp_register_script('themescript', get_template_directory_uri() . '/js/scripts.js', array('jquery'), false, true); // Custom scripts
    wp_enqueue_script('themescript'); // Enqueue it! 

    wp_localize_script('themescript', 'CUSTOM_PARAMS', array('ajaxUrl' => admin_url('admin-ajax.php')));
    
}
add_action('init', 'html5blank_header_scripts');