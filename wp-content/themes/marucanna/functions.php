<?php
include 'includes/functions/theme_scripts.php';
include 'includes/functions/theme_styles.php';
include 'includes/functions/theme_acf_functions.php';
include 'includes/shortcodes.php';
include 'includes/custom-posts.php';
include 'includes/functions/mc_api.php';

add_theme_support( 'post-thumbnails' ); 
add_image_size( 'reviews-thumb', 50, 49,true);
add_image_size( 'doc-home-thumb', 243, 297,true);
add_image_size( 'blog-home-thumb', 416, 276,true);
add_image_size( 'siderbar-thumb', 526, 9999);
//add_image_size( 'custom-thumb', 360, 182,true);

register_nav_menu( 'footer-menu-1', __( 'Footer Menu #1') );
register_nav_menu( 'footer-menu-2', __( 'Footer Menu #2') );

//Meta box to show reviews on home page
function sm_custom_meta() {
    add_meta_box( 'sm_meta', __( 'Show on Home Page', 'sm-textdomain' ), 'sm_meta_callback', 'marucanna-reviews' );
}
function sm_meta_callback( $post ) {
    $featured = get_post_meta( $post->ID );
    ?>
 
	<p>
    <div class="sm-row-content">
        <label for="meta-checkbox">
            <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $featured['meta-checkbox'] ) ) checked( $featured['meta-checkbox'][0], 'yes' ); ?> />
            <?php _e( 'Show', 'sm-textdomain' )?>
        </label>
        
    </div>
</p>
 
    <?php
}
add_action( 'add_meta_boxes', 'sm_custom_meta' );


/**
 * Saves the custom meta input
 */
function sm_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
 // Checks for input and saves
if( isset( $_POST[ 'meta-checkbox' ] ) ) {
    update_post_meta( $post_id, 'meta-checkbox', 'yes' );
} else {
    update_post_meta( $post_id, 'meta-checkbox', '' );
}
 
}
add_action( 'save_post', 'sm_meta_save' );



class Excerpt {

  // Default length (by WordPress)
  public static $length = 55;

  // So you can call: my_excerpt('short');
  public static $types = array(
      'short' => 25,
      'regular' => 55,
      'long' => 100
    );

  /**
   * Sets the length for the excerpt,
   * then it adds the WP filter
   * And automatically calls the_excerpt();
   *
   * @param string $new_length 
   * @return void
   * @author Baylor Rae'
   */
  public static function length($new_length = 55) {
    Excerpt::$length = $new_length;

    add_filter('excerpt_length', 'Excerpt::new_length');

    Excerpt::output();
  }

  // Tells WP the new length
  public static function new_length() {
    if( isset(Excerpt::$types[Excerpt::$length]) )
      return Excerpt::$types[Excerpt::$length];
    else
      return Excerpt::$length;
  }

  // Echoes out the excerpt
  public static function output() {
    the_excerpt();
  }

}

// An alias to the class
function my_excerpt($length = 55) {
  Excerpt::length($length);
}

function api_url()
{
  $protocols = array('http://', 'http://www.', 'www.', 'https://', 'https://www.');
  $url = str_replace($protocols, '', get_bloginfo('wpurl'));
  if ($url) {
    return '//' . $url . '/wp-json/mcapi/';
  }
}


//Pagination
function kriesi_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<ul class=pagination>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li class='page-item'><a href='".get_pagenum_link(1)."' class='page-link'>&laquo;</a></li>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li class='page-item active'><a href='".get_pagenum_link($i)."' class='page-link'>".$i."</a></li>":"<li class='page-item'><a href='".get_pagenum_link($i)."' class='page-link'>".$i."</a></li>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<li class='page-item'><a href='".get_pagenum_link($paged + 1)."' class='page-link'>&rsaquo;</a></li>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li class='page-item'><a href='".get_pagenum_link($pages)."' class='page-link'>&raquo;</a></li>";
         echo "</ul>";
     }
}

//Breadcrumb
function the_breadcrumb() {
	
	
		echo '<ol class="breadcrumb">';
	if (!is_home()) {
		echo '<li class="breadcrumb-item">
<a href=" ';
		echo get_option('home');
		echo '/">';
		echo 'Home';
		echo "</a></li> ";
		if (is_category() || is_single()) {
			echo '<li class="breadcrumb-item">';
			the_category(' </li><li class="breadcrumb-item"> ');
			if (is_single()) {
				echo "</li><li class='breadcrumb-item'>";
				the_title();
				echo '</li>';
			}
		} elseif (is_page()) {
			echo '<li class="breadcrumb-item active" aria-current="page">';
			echo the_title();
			echo '</li>';
		}
	}
	elseif (is_tag()) {single_tag_title();}
	elseif (is_day()) {echo"<li class='breadcrumb-item'>Archive for "; the_time('F jS, Y'); echo'</li>';}
	elseif (is_month()) {echo"<li class='breadcrumb-item'>Archive for "; the_time('F, Y'); echo'</li>';}
	elseif (is_year()) {echo"<li class='breadcrumb-item' >Archive for "; the_time('Y'); echo'</li>';}
	elseif (is_author()) {echo"<li class='breadcrumb-item'>Author Archive"; echo'</li>';}
	elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
	elseif (is_search()) {echo"<li class='breadcrumb-item'>Search Results"; echo'</li>';}
	echo '</ol>';
}