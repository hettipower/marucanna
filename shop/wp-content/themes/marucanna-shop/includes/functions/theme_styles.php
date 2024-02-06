<?php


/*------------------------------------*\
    THEME STYLES
\*------------------------------------*/

function html5blank_styles(){
    
    wp_register_style('html5blank', get_template_directory_uri() . '/css/theme.css', array(), false, 'all');
    wp_enqueue_style('html5blank'); // Enqueue it!
        
    
}
add_action('wp_enqueue_scripts', 'html5blank_styles',100);