<?php
require 'includes/vendor/autoload.php';
include 'includes/functions/theme_scripts.php';
include 'includes/functions/theme_styles.php';
include 'includes/functions/theme_acf_functions.php';
include 'includes/shortcodes.php';
include 'includes/custom-posts.php';
include 'includes/functions/menus.php';
include 'includes/functions/woo_func.php';

add_image_size( 'reviews-thumb', 50, 49,true);
add_image_size( 'doc-home-thumb', 243, 297,true);
add_image_size( 'blog-home-thumb', 416, 276,true);
add_image_size( 'siderbar-thumb', 526, 9999);
//add_image_size( 'custom-thumb', 360, 182,true);


function api_url()
{
  $protocols = array('http://', 'http://www.', 'www.', 'https://', 'https://www.');
  $url = str_replace($protocols, '', get_bloginfo('wpurl'));
  if ($url) {
    return '//' . $url . '/wp-json/mcapi/';
  }
}


/**
 * Add HTML5 theme support.
 */
function mc_after_setup_theme() {
	add_theme_support( 'html5', array( 'search-form' ) );
  add_theme_support( 'post-thumbnails' ); 
  add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mc_after_setup_theme' );
