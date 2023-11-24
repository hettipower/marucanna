<?php


/*------------------------------------*\
    THEME STYLES
\*------------------------------------*/

function html5blank_styles(){

    wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.min.css', array(), false, 'all');
    wp_enqueue_style('normalize'); // Enqueue it!
    
    wp_register_style('html5blank', get_template_directory_uri() . '/css/theme.css', array(), false, 'all');
    wp_enqueue_style('html5blank'); // Enqueue it!

    wp_register_style('legacy-browsers', get_template_directory_uri() . '/css/legacy-browsers.css', array(), false, 'all');
    wp_enqueue_style('legacy-browsers'); 
        
    
}
add_action('wp_enqueue_scripts', 'html5blank_styles',100);