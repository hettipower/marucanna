<?php


/*------------------------------------*\
    THEME STYLES
\*------------------------------------*/

use MatthiasMullie\Minify;
function combine_all_css_func(){

    $minify_assets = get_field( 'minify_assets', 'option' );
    $last_minified = get_field('css_minified_time','option');

    $current_date = new DateTime('now');

    if (!empty($last_minified)) {
        $date = date_create_from_format('Y-m-d H:i:s', $last_minified);
        $date_differnce = $date->diff($current_date); 
    }

    if ($minify_assets && (empty($last_minified) || $date_differnce->days >= 1)) {

        if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

            $theme = get_theme_file_path('css/theme.css');
            $minifier = new Minify\CSS($theme);

            // save minified file to disk
            $minifiedPath = get_theme_file_path('css/theme.min.css');
            $minifier->minify($minifiedPath);

            update_field('css_minified_time', $current_date->format('Y-m-d H:i:s'), 'option');
        }
    }

    if(!$minify_assets) {
        update_field('css_minified_time', '', 'option');
    }

}
add_action('init' , 'combine_all_css_func');

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