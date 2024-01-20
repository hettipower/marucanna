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

  $fname = isset($_POST['fname']) ? $_POST['fname'] : false;
  $email = isset($_POST['email']) ? $_POST['email'] : false;
  $contact_no = isset($_POST['contact_no']) ? $_POST['contact_no'] : false;
  $eligibility_q1 = isset($_POST['eligibility_q1']) ? $_POST['eligibility_q1'] : false;
  $eligibility_q2 = isset($_POST['eligibility_q2']) ? $_POST['eligibility_q2'] : false;
  $eligibility_q3 = isset($_POST['eligibility_q3']) ? $_POST['eligibility_q3'] : false;
  $eligibility_q4 = isset($_POST['eligibility_q4']) ? $_POST['eligibility_q4'] : false;
  $eligibility_q5 = isset($_POST['eligibility_q5']) ? $_POST['eligibility_q5'] : false;
  $last_user_ID = get_last_user_ID();
  $new_user_ID = intval($last_user_ID) + 1;

  $patient_ID = "MP-".$new_user_ID;
  $password = wp_generate_password();

  if($fname && $email && $contact_no) {
    if(email_exists($email)) {
      $return_url = get_field('check_eligibility_page' , 'option').'?status=0&mgs=User exists.';
    } else {
      // Create Patient Object
      $patient = array(
        'post_title'    => wp_strip_all_tags($fname),
        'post_status'   => 'publish',
        'post_type' => 'marucanna-patients',
      );
  
      $patient_post_id = wp_insert_post($patient);
  
      if(!is_wp_error($patient_post_id)) {
  
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
    }
  } else {
    $return_url = get_field('check_eligibility_page' , 'option').'?status=0&mgs=Please fill in all required fields.';
  }
  
  wp_redirect( $return_url );
  exit;
  
}

add_action( 'gform_after_submission_1', 'mc_patient_booking_post_type_update', 10, 2 );
function mc_patient_booking_post_type_update( $entry, $form ) {

  $patient = rgar( $entry, '84' );
  $booking = rgar( $entry, '85' );
  $gender = rgar( $entry, '80' );
  $address = rgar( $entry, '82.1' );
  $address_2 = rgar( $entry, '82.2' );
  $town = rgar( $entry, '86' );
  $country = rgar( $entry, '83.6' );
  $postcode = rgar( $entry, '87' );
  $dob = rgar( $entry, '81' );
  $treatment = rgar( $entry, '88' );
  $additional_note = rgar( $entry, '89' );
  $medical_history_1 = rgar( $entry, '90' );
  $medical_history_2 = rgar( $entry, '91' );
  $medical_history_3 = rgar( $entry, '92' );
  $medical_history_4 = rgar( $entry, '93' );
  $current_medical_condition_1 = rgar( $entry, '94' );
  $current_medical_condition_2 = rgar( $entry, '95' );
  $current_medical_condition_3 = rgar( $entry, '96' );
  $referred_clinic = rgar( $entry, '97' );
  $clinic_name = rgar( $entry, '98' );
  $clinic_postcode = rgar( $entry, '100' );
  $clinic_phone_number = rgar( $entry, '101' );
  $gp_name = rgar( $entry, '102' );
  $practice_name = rgar( $entry, '103' );
  $gp_address_line_1 = rgar( $entry, '104.1' );
  $gp_address_line_2 = rgar( $entry, '104.2' );
  $gp_town = rgar( $entry, '105' );
  $gp_country = rgar( $entry, '108.6' );
  $gp_postal_code = rgar( $entry, '106' );
  $gp_phone = rgar( $entry, '109' );
  $csr_file = rgar( $entry, '110' );
  $photo_id = rgar( $entry, '111' );

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

function get_last_user_ID(){
  $last_user = get_users(array(
    'number' => 1,
    'orderby' => 'registered',
    'order' => 'DESC',
  ));

  // Check if there is any user
  if (!empty($last_user)) {
    return $last_user[0]->ID;
  } else {
    return false;
  }
}

//prioritize pagination over displaying custom post type content (Used this to fix conditions page pagination 404 issue #LWP)
add_action('init', function() {
  add_rewrite_rule(
    '(.?.+?)/page/?([0-9]{1,})/?$',
    'index.php?pagename=$matches[1]&paged=$matches[2]',
    'top'
  );
});

function get_patient_ids() {
  $patients = get_users( array(
		'role__in' => array( 'patient' )
	));
  $options = array();

  foreach ($patients as $patient) {
    $item = array('text' => $patient->data->user_login, 'value' => $patient->data->user_login);
    array_push($options , $item);
  }

  return $options;
}

add_filter('gform_pre_render', 'populate_patient_ids_field');
function populate_patient_ids_field($form) {
  // Specify the form ID and the field ID of the dropdown you want to populate
  $form_id = 2; // Change to your form ID
  $field_id = 51; // Change to your field ID

  // Check if the current form matches the specified form ID
  if ($form['id'] == $form_id) {
    $dynamic_options = get_patient_ids();
    
    // Find the target field by its ID
    foreach ($form['fields'] as &$field) {
      if ($field['id'] == $field_id && $field['type'] == 'select') {
        $field['choices'] = $dynamic_options;
        break;
      }
    }
  }
  
  return $form;
}

add_action( 'gform_after_submission_2', 'mc_consultant_post_type_update', 10, 2 );
function mc_consultant_post_type_update( $entry, $form ) {

  $patient = rgar( $entry, '51' );
  $full_name = rgar( $entry, '3' );
  $date_of_birth = rgar( $entry, '5' );
  $address_line_1 = rgar( $entry, '7.1' );
  $address_line_2 = rgar( $entry, '7.2' );
  $phone = rgar( $entry, '8' );
  $information_1 = rgar( $entry, '9' );
  $medical_history_1 = rgar( $entry, '11' );
  $medical_history_2 = rgar( $entry, '12' );
  $medical_history_3 = rgar( $entry, '13' );
  $medical_history_4 = rgar( $entry, '14' );
  $medical_history_5 = rgar( $entry, '15' );
  $medical_condition_1 = rgar( $entry, '17' );
  $medical_condition_2 = rgar( $entry, '18' );
  $medical_condition_3 = rgar( $entry, '19' );
  $previous_treatments_1 = rgar( $entry, '20' );
  $previous_treatments_2 = rgar( $entry, '22' );
  $previous_treatments_3 = rgar( $entry, '23' );
  $expectations_1 = rgar( $entry, '24' );
  $expectations_2 = rgar( $entry, '26' );
  $expectations_3 = rgar( $entry, '27' );
  $allergies_1 = rgar( $entry, '29' );
  $allergies_2 = rgar( $entry, '30' );
  $family_medical_history_1 = rgar( $entry, '32' );
  $family_medical_history_2 = rgar( $entry, '33' );
  $habits_1 = rgar( $entry, '35' );
  $habits_2 = rgar( $entry, '36' );
  $habits_3 = rgar( $entry, '37' );
  $psychosocial_assessment_1 = rgar( $entry, '39' );
  $psychosocial_assessment_2 = rgar( $entry, '40' );
  $psychosocial_assessment_3 = rgar( $entry, '41' );
  $legal_1 = rgar( $entry, '43' );
  $legal_2 = rgar( $entry, '44' );
  $complementary_medicines_1 = rgar( $entry, '46' );
  $complementary_medicines_2 = rgar( $entry, '47' );
  $patient_preferences_1 = rgar( $entry, '49' );
  $additional_notes = rgar( $entry, '50' );

  // Create Patient Object
  $title = "$patient : $full_name";
  $consultant_arg = array(
    'post_title'    => wp_strip_all_tags($title),
    'post_status'   => 'publish',
    'post_type' => 'consultation',
  );

  $consultant_post_id = wp_insert_post($consultant_arg);
  
  if(!is_wp_error($consultant_post_id)) {
    update_field('patient', $patient , $consultant_post_id);
    update_field('full_name', $full_name , $consultant_post_id);
    update_field('date_of_birth', $date_of_birth , $consultant_post_id);
    update_field('address_line_1', $address_line_1 , $consultant_post_id);
    update_field('address_line_2', $address_line_2 , $consultant_post_id);
    update_field('phone', $phone , $consultant_post_id);
    update_field('information_1', $information_1 , $consultant_post_id);
    update_field('medical_history_1', $medical_history_1 , $consultant_post_id);
    update_field('medical_history_2', $medical_history_2 , $consultant_post_id);
    update_field('medical_history_3', $medical_history_3 , $consultant_post_id);
    update_field('medical_history_4', $medical_history_4 , $consultant_post_id);
    update_field('medical_history_5', $medical_history_5 , $consultant_post_id);
    update_field('medical_condition_1', $medical_condition_1 , $consultant_post_id);
    update_field('medical_condition_2', $medical_condition_2 , $consultant_post_id);
    update_field('medical_condition_3', $medical_condition_3 , $consultant_post_id);
    update_field('previous_treatments_1', $previous_treatments_1 , $consultant_post_id);
    update_field('previous_treatments_2', $previous_treatments_2 , $consultant_post_id);
    update_field('previous_treatments_3', $previous_treatments_3 , $consultant_post_id);
    update_field('expectations_1', $expectations_1 , $consultant_post_id);
    update_field('expectations_2', $expectations_2 , $consultant_post_id);
    update_field('expectations_3', $expectations_3 , $consultant_post_id);
    update_field('allergies_1', $allergies_1 , $consultant_post_id);
    update_field('allergies_2', $allergies_2 , $consultant_post_id);
    update_field('family_medical_history_1', $family_medical_history_1 , $consultant_post_id);
    update_field('family_medical_history_2', $family_medical_history_2 , $consultant_post_id);
    update_field('habits_1', $habits_1 , $consultant_post_id);
    update_field('habits_2', $habits_2 , $consultant_post_id);
    update_field('habits_3', $habits_3 , $consultant_post_id);
    update_field('psychosocial_assessment_1', $psychosocial_assessment_1 , $consultant_post_id);
    update_field('psychosocial_assessment_2', $psychosocial_assessment_2 , $consultant_post_id);
    update_field('psychosocial_assessment_3', $psychosocial_assessment_3 , $consultant_post_id);
    update_field('legal_1', $legal_1 , $consultant_post_id);
    update_field('legal_2', $legal_2 , $consultant_post_id);
    update_field('complementary_medicines_1', $complementary_medicines_1 , $consultant_post_id);
    update_field('complementary_medicines_2', $complementary_medicines_2 , $consultant_post_id);
    update_field('patient_preferences_1', $patient_preferences_1 , $consultant_post_id);
    update_field('additional_notes', $additional_notes , $consultant_post_id);
  }
  
}