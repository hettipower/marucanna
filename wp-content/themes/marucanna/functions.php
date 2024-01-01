<?php
include 'includes/functions/theme_scripts.php';
include 'includes/functions/theme_styles.php';
include 'includes/functions/theme_acf_functions.php';
include 'includes/shortcodes.php';
include 'includes/custom-posts.php';
include 'includes/functions/mc_api.php';
include 'includes/functions/menus.php';
include_once __DIR__ . '/includes/acf/acf-hidden-field/init.php';    

add_theme_support( 'post-thumbnails' ); 
add_image_size( 'reviews-thumb', 50, 49,true);
add_image_size( 'doc-home-thumb', 243, 297,true);
add_image_size( 'blog-home-thumb', 416, 276,true);
add_image_size( 'siderbar-thumb', 526, 9999);
//add_image_size( 'custom-thumb', 360, 182,true);

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

/**
 * Add HTML5 theme support.
 */
function mc_after_setup_theme() {
	add_theme_support( 'html5', array( 'search-form' ) );
}
add_action( 'after_setup_theme', 'mc_after_setup_theme' );

/**
 * Create Custom User Roles
 */
add_action('init', 'add_mc_user_roles');
function add_mc_user_roles() {
  add_role(
    'patient',
    __('Patient'),
    array(
      // Define capabilities here
      'read'         => true,
      'edit_posts'   => true,
      'delete_posts' => false,
    )
  );
}

add_action( 'admin_post_mc_eligibility_checker', 'admin_mc_eligibility_checker' );
add_action( 'admin_post_nopriv_mc_eligibility_checker', 'admin_mc_eligibility_checker' );
function admin_mc_eligibility_checker() {

  $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $contact_no = isset($_POST['contact_no']) ? $_POST['contact_no'] : '';
  $eligibility_q1 = isset($_POST['eligibility_q1']) ? $_POST['eligibility_q1'] : false;
  $eligibility_q2 = isset($_POST['eligibility_q2']) ? $_POST['eligibility_q2'] : false;
  $eligibility_q3 = isset($_POST['eligibility_q3']) ? $_POST['eligibility_q3'] : false;
  $eligibility_q4 = isset($_POST['eligibility_q4']) ? $_POST['eligibility_q4'] : false;
  $eligibility_q5 = isset($_POST['eligibility_q5']) ? $_POST['eligibility_q5'] : false;

  // Create Patient Object
  $patient = array(
    'post_title'    => wp_strip_all_tags("Patient $fname"),
    'post_status'   => 'publish',
    'post_type' => 'marucanna-patients',
  );

  $patient_post_id = wp_insert_post($patient);

  if(!is_wp_error($patient_post_id)) {

    $patient_ID = "MP-$patient_post_id";

    update_post_meta( $patient_post_id, 'eligibility_q1', wp_slash( $eligibility_q1 ) );
    update_post_meta( $patient_post_id, 'eligibility_q2', wp_slash( $eligibility_q2 ) );
    update_post_meta( $patient_post_id, 'eligibility_q3', wp_slash( $eligibility_q3 ) );
    update_post_meta( $patient_post_id, 'eligibility_q4', wp_slash( $eligibility_q4 ) );
    update_post_meta( $patient_post_id, 'eligibility_q5', wp_slash( $eligibility_q5 ) );

    update_field('name', $fname , $patient_post_id);
    update_field('email', $email , $patient_post_id);
    update_field('phone', $contact_no , $patient_post_id);
    update_field('patient_id', $patient_ID , $patient_post_id);

    if($eligibility_q1 && !$eligibility_q5) {
      $eligibility = 'Eligible';
    }else{
      $eligibility = 'Unqualified Patients';
    }

    update_field('eligibility', $eligibility , $patient_post_id);

    if($eligibility_q1 && !$eligibility_q5) {

      //Create User
      $password = wp_generate_password();
      $user_data = array(
        'user_login' => $patient_ID,
        'user_pass'  => $password,
        'user_email' => $email,
        'role'       => 'patient',
      );

      // Insert the user into the database
      $user_id = wp_insert_user($user_data);

      if( !is_wp_error($user_id) ) {
        
        // Add user meta data
        add_user_meta($user_id, 'patient_password', $password);
        update_field('patient', $user_id , $patient_post_id);

        $return_url = get_field('booking_page' , 'option').'?patient='.$user_id.'&booking='.$patient_post_id;

      } else {
        $return_url = get_field('check_eligibility_page' , 'option').'?status=0&mgs='.$user_id->get_error_message();
      }

    }else{
      $return_url = get_field('check_eligibility_page' , 'option').'?status=2&mgs=You are not Eligible.';
    }

  } else {
    $return_url = get_field('check_eligibility_page' , 'option').'?status=0&mgs='.$patient_post_id->get_error_message();
  }
  
  wp_redirect( $return_url );
  exit;
  
}

add_action( 'admin_post_mc_patient_booking', 'admin_mc_patient_booking' );
add_action( 'admin_post_nopriv_mc_patient_booking', 'admin_mc_patient_booking' );
function admin_mc_patient_booking() {

  $patient = isset($_POST['patient']) ? $_POST['patient'] : false;
  $booking = isset($_POST['booking']) ? $_POST['booking'] : false;
  $gender = isset($_POST['gender']) ? $_POST['gender'] : false;
  $address = isset($_POST['address']) ? $_POST['address'] : false;
  $address_2 = isset($_POST['address_2']) ? $_POST['address_2'] : false;
  $town = isset($_POST['town']) ? $_POST['town'] : false;
  $country = isset($_POST['country']) ? $_POST['country'] : false;
  $postcode = isset($_POST['postcode']) ? $_POST['postcode'] : false;
  $dob = isset($_POST['dob']) ? $_POST['dob'] : false;
  $treatment = isset($_POST['treatment']) ? $_POST['treatment'] : false;
  $additional_note = isset($_POST['additional_note']) ? $_POST['additional_note'] : false;
  $medical_history_1 = isset($_POST['medical_history_1']) ? $_POST['medical_history_1'] : false;
  $medical_history_2 = isset($_POST['medical_history_2']) ? $_POST['medical_history_2'] : false;
  $medical_history_3 = isset($_POST['medical_history_3']) ? $_POST['medical_history_3'] : false;
  $medical_history_4 = isset($_POST['medical_history_4']) ? $_POST['medical_history_4'] : false;
  $current_medical_condition_1 = isset($_POST['current_medical_condition_1']) ? $_POST['current_medical_condition_1'] : false;
  $current_medical_condition_2 = isset($_POST['current_medical_condition_2']) ? $_POST['current_medical_condition_2'] : false;
  $current_medical_condition_3 = isset($_POST['current_medical_condition_3']) ? $_POST['current_medical_condition_3'] : false;
  $referred_clinic = isset($_POST['referred_clinic']) ? $_POST['referred_clinic'] : false;
  $clinic_name = isset($_POST['clinic_name']) ? $_POST['clinic_name'] : false;
  $clinic_postcode = isset($_POST['clinic_postcode']) ? $_POST['clinic_postcode'] : false;
  $clinic_phone_number = isset($_POST['clinic_phone_number']) ? $_POST['clinic_phone_number'] : false;
  $gp_name = isset($_POST['gp_name']) ? $_POST['gp_name'] : false;
  $practice_name = isset($_POST['practice_name']) ? $_POST['practice_name'] : false;
  $gp_address_line_1 = isset($_POST['gp_address_line_1']) ? $_POST['gp_address_line_1'] : false;
  $gp_address_line_2 = isset($_POST['gp_address_line_2']) ? $_POST['gp_address_line_2'] : false;
  $gp_town = isset($_POST['gp_town']) ? $_POST['gp_town'] : false;
  $gp_country = isset($_POST['gp_country']) ? $_POST['gp_country'] : false;
  $gp_postal_code = isset($_POST['gp_postal_code']) ? $_POST['gp_postal_code'] : false;
  $gp_phone = isset($_POST['gp_phone']) ? $_POST['gp_phone'] : false;
  $csr_file = isset($_POST['csr_file']) ? $_POST['csr_file'] : false;
  $photo_id = isset($_POST['photo_id']) ? $_POST['photo_id'] : false;
  
  if( $patient && $booking ) {
    update_field('gender', $gender , $booking);
    update_field('address_line_1', $address , $booking);
    update_field('address_line_2', $address_2 , $booking);
    update_field('town', $town , $booking);
    update_field('country', $country , $booking);
    update_field('postcode', $postcode , $booking);
    update_field('dob', $dob , $booking);
    update_field('treatment', $treatment , $booking);
    update_field('additional_note', $additional_note , $booking);
    update_field('medical_history_1', $medical_history_1 , $booking);
    update_field('medical_history_2', $medical_history_2 , $booking);
    update_field('medical_history_3', $medical_history_3 , $booking);
    update_field('medical_history_4', $medical_history_4 , $booking);
    update_field('current_medical_condition_1', $current_medical_condition_1 , $booking);
    update_field('current_medical_condition_2', $current_medical_condition_2 , $booking);
    update_field('current_medical_condition_3', $current_medical_condition_3 , $booking);
    update_field('referred_clinic', $referred_clinic , $booking);
    update_field('clinic_name', $clinic_name , $booking);
    update_field('clinic_postcode', $clinic_postcode , $booking);
    update_field('clinic_phone_number', $clinic_phone_number , $booking);
    update_field('gp_name', $gp_name , $booking);
    update_field('practice_name', $practice_name , $booking);
    update_field('gp_address_line_1', $gp_address_line_1 , $booking);
    update_field('gp_address_line_2', $gp_address_line_2 , $booking);
    update_field('gp_town', $gp_town , $booking);
    update_field('gp_country', $gp_country , $booking);
    update_field('gp_postal_code', $gp_postal_code , $booking);
    update_field('gp_phone', $gp_phone , $booking);
    update_field('csr_file', $csr_file , $booking);
    update_field('photo_id', $photo_id , $booking);
  }

}