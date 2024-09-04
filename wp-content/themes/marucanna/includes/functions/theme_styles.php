<?php


/*------------------------------------*\
    THEME STYLES
\*------------------------------------*/

function html5blank_styles(){

    $minify_assets = get_field( 'minify_assets', 'option' );
    
    if( $minify_assets ) {
        wp_register_style('html5blank-minify', get_template_directory_uri() . '/css/theme.min.css', array(), false, 'all');
        wp_enqueue_style('html5blank-minify');
    } else {
        wp_register_style('html5blank', get_template_directory_uri() . '/css/theme.css', array(), false, 'all');
        wp_enqueue_style('html5blank');
    }
        
    
}
add_action('wp_enqueue_scripts', 'html5blank_styles',100);