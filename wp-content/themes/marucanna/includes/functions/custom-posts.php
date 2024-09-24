<?php 
// Register Custom Post Type - Reviews
function reviews_post_type() {

	$labels = array(
		'name'                  => _x( 'Reviews', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Reviews', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Reviews', 'text_domain' ),
		'name_admin_bar'        => __( 'Reviews', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent', 'text_domain' ),
		'all_items'             => __( 'All Reviews', 'text_domain' ),
		'add_new_item'          => __( 'Add New', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit', 'text_domain' ),
		'update_item'           => __( 'Update', 'text_domain' ),
		'view_item'             => __( 'View', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Profile Picture', 'text_domain' ),
		'remove_featured_image' => __( 'Remove Profile Picture', 'text_domain' ),
		'use_featured_image'    => __( 'Use as Profile Picture', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Reviews', 'text_domain' ),
		'description'           => __( 'Reviews.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail'),
		/*'taxonomies'            => array( 'category', 'post_tag' ),*/
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
		'menu_icon'             => 'dashicons-format-status',
		//'rewrite' => array('slug' => 'reviews','with_front' => false),
	);
	register_post_type( 'marucanna-reviews', $args );

}
add_action( 'init', 'reviews_post_type', 0 );

// Register Custom Post Type - Doctors
function doctors_post_type() {

	$labels = array(
		'name'                  => _x( 'Doctors', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Doctors', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Doctors', 'text_domain' ),
		'name_admin_bar'        => __( 'Doctors', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent', 'text_domain' ),
		'all_items'             => __( 'All Doctors', 'text_domain' ),
		'add_new_item'          => __( 'Add New', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit', 'text_domain' ),
		'update_item'           => __( 'Update', 'text_domain' ),
		'view_item'             => __( 'View', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Profile Picture', 'text_domain' ),
		'set_featured_image'    => __( 'Profile Picture', 'text_domain' ),
		'remove_featured_image' => __( 'Remove Profile Picture', 'text_domain' ),
		'use_featured_image'    => __( 'Use as Profile Picture', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Doctors', 'text_domain' ),
		'description'           => __( 'Doctors.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail'),
		/*'taxonomies'            => array( 'category', 'post_tag' ),*/
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'menu_icon'             => 'dashicons-businessperson',
		'rewrite' => array('slug' => 'team','with_front' => false),
	);
	register_post_type( 'marucanna-doctors', $args );

}
add_action( 'init', 'doctors_post_type', 0 );

// Register Custom Category - Doctord
function custom_taxonomy_marucanna_gp_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Categories', 'Category General Name', 'text_domain' ),
		'singular_name'              => _x( 'Category', 'Category Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Categories', 'text_domain' ),
		'all_items'                  => __( 'All', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'gp-category', array( 'marucanna-doctors' ), $args );

}
add_action( 'init', 'custom_taxonomy_marucanna_gp_taxonomy', 0 );

// Register Custom Post Type - Conditions
function conditions_post_type() {

	$labels = array(
		'name'                  => _x( 'Conditions', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Conditions', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Conditions', 'text_domain' ),
		'name_admin_bar'        => __( 'Conditions', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent', 'text_domain' ),
		'all_items'             => __( 'All Conditions', 'text_domain' ),
		'add_new_item'          => __( 'Add New', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit', 'text_domain' ),
		'update_item'           => __( 'Update', 'text_domain' ),
		'view_item'             => __( 'View', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured image', 'text_domain' ),
		'set_featured_image'    => __( 'Featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove Featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as Featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Conditions', 'text_domain' ),
		'description'           => __( 'Conditions.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail'),
		/*'taxonomies'            => array( 'category', 'post_tag' ),*/
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'menu_icon'             => 'dashicons-pressthis',
		'rewrite' => array('slug' => 'medical-cannabis-for-pain','with_front' => false),
	);
	register_post_type( 'marucanna-conditions', $args );

}
add_action( 'init', 'conditions_post_type', 0 );

// Register Custom Post Type - Patients
function patients_post_type() {

	$labels = array(
		'name'                  => _x( 'Patients', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Patients', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Manage Patients', 'text_domain' ),
		'name_admin_bar'        => __( 'Patients', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent', 'text_domain' ),
		'all_items'             => __( 'Manage Patients', 'text_domain' ),
		'add_new_item'          => __( 'Add New', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit', 'text_domain' ),
		'update_item'           => __( 'Update', 'text_domain' ),
		'view_item'             => __( 'View', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured image', 'text_domain' ),
		'set_featured_image'    => __( 'Featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove Featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as Featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Patients', 'text_domain' ),
		'description'           => __( 'Patients.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'menu_icon'             => 'dashicons-businessperson',
	);
	register_post_type( 'marucanna-patients', $args );

}
add_action( 'init', 'patients_post_type', 0 );

// Add custom column header
function mc_booking_column_header($columns) {

	$columns = array(
		'title' => "Title",
		'patient_id' => "Patient ID",
		'nhs_number' => "NHS Number",
		'eligibility' => "Eligibility",
		'gp' => "GP",
		'payment_id' => "Payment ID",
		'login_time' => "Login Time",
		'logout_time' => "Logout Time",
		'valid' => "Valid Patient",
		'status' => "Status",
		'date' => "Date"
	);

    return $columns;
}
add_filter('manage_marucanna-patients_posts_columns', 'mc_booking_column_header');

// Display content for custom column
function mc_booking_column_content($column, $post_id) {
	$patient = get_field('patient' , $post_id);
	$lastLoginTime = get_user_meta($patient, 'last_login_time', true);
    $lastLogoutTime = get_user_meta($patient, 'last_logout_time', true);

    if ($column == 'patient_id') {
        echo get_field('patient_id' , $post_id);
    }

	if ($column == 'nhs_number') {
        echo get_field('nhs_number' , $post_id);
    }

	if ($column == 'eligibility') {
        echo get_field('eligibility' , $post_id);
    }

	if ($column == 'gp') {
        echo get_field('gp_name' , $post_id);
    }

	if ($column == 'payment_id') {
        echo get_last_payment_date($post_id);
    }

	if ($column == 'login_time') {
        echo $lastLoginTime ? $lastLoginTime : '-';
    }

	if ($column == 'logout_time') {
        echo $lastLogoutTime ? $lastLogoutTime : '-';
    }

	if ($column == 'valid') {
		$is_valid_patient = check_valid_patinet($patient);
		if( $is_valid_patient ) {
			echo 'Yes';
		} else {
			echo 'No';
		}
    }

	if ($column == 'status') {
		$patient_status = get_field('patient_status', $post_id) ? get_field('patient_status', $post_id) : 'active';
		echo '<span style="text-transform: capitalize;">'.$patient_status.'</span>';
    }
}
add_action('manage_marucanna-patients_posts_custom_column', 'mc_booking_column_content', 10, 2);

function remove_view_link($actions, $post) {
	
    if ($post->post_type == 'marucanna-patients') {
        unset($actions['view']);
		unset($actions['trash']);

		$patient = get_field('patient' , $post->ID);
		
		if( is_array($patient) ) {
			$actions['delete_patinet'] = '<a href="#" data-patient="'.$patient['ID'].'">' . __('Delete Patient', 'textdomain') . '</a>';
		} else {
			$actions['delete_patinet'] = '<a href="#" data-patient="'.$patient.'">' . __('Delete Patient', 'textdomain') . '</a>';
		}

    }

    return $actions;
}
add_filter('post_row_actions', 'remove_view_link', 10, 2);

// Filter to hide the permalink in the post editor
add_filter('get_sample_permalink_html', 'hide_custom_post_type_permalink', 10, 5);
function hide_custom_post_type_permalink($return, $id, $new_title, $new_slug, $post) {
	
    if ($post->post_type === 'marucanna-patients') {
        return '';
    }
    return $return;
}

add_action('wp_ajax_mc_patient_delete_action', 'mc_patient_delete_handler');
function mc_patient_delete_handler() {
	
	require_once( ABSPATH.'wp-admin/includes/user.php' );

	$results = array();
	$patient = isset($_REQUEST['patient']) ? $_REQUEST['patient'] : false ;

	if( $patient ) {
		$patient_post_id = get_user_meta( $patient, 'patient_info', true );

		$response = wp_delete_user( $patient );

		if( $response ) {
			wp_delete_post($patient_post_id, true);

			$results['status'] = true;
			$results['msg'] = 'Patinet file has been deleted.';
		} else {
			$results['status'] = false;
			$results['msg'] = 'Patinet file not deleted.';
		}
	} else {
		$results['status'] = false;
		$results['msg'] = 'Somethings went wrong. Please try again.';
	}

    echo json_encode($results);
    wp_die();
}

function filter_posts_by_meta_field() {
    global $typenow;

    // Ensure this is the correct post type
    if ($typenow == 'marucanna-patients') {

		$patient_id = isset($_GET['patient_id']) ? $_GET['patient_id'] : '';
		$nhs_number = isset($_GET['nhs_number']) ? $_GET['nhs_number'] : '';

        // Display the input field for filtering
        echo '<input type="text" id="patient_id" name="patient_id" value="' . esc_attr($patient_id) . '" class="postform" placeholder="Patient ID" />';

        // Add the submit button
        echo '<input type="submit" name="filter_action" class="button" value="Filter by Patient ID" style="margin-right: 15px;">';

		// Display the input field for filtering
        echo '<input type="text" id="nhs_number" name="nhs_number" value="' . esc_attr($nhs_number) . '" class="postform" placeholder="NHS Number" />';

        // Add the submit button
        echo '<input type="submit" name="filter_action" class="button" value="Filter by NHS Number" style="margin-right: 15px;">';
    }
}
add_action('restrict_manage_posts', 'filter_posts_by_meta_field');

// Step 4: Modify the main query to filter posts based on the entered meta field value
function filter_posts_by_meta_value($query) {
    global $pagenow;
    $patient_id = 'patient_id';
    $nhs_number = 'nhs_number';

    // Check if it's the admin and the main query
    if (is_admin() && $pagenow == 'edit.php' && isset($_GET[$patient_id]) && $_GET[$patient_id] != '') {
        $query->query_vars['meta_query'] = array(
            array(
                'key'     => $patient_id,
                'value'   => esc_attr($_GET[$patient_id]),
                'compare' => 'LIKE',
            ),
        );
    }

	if (is_admin() && $pagenow == 'edit.php' && isset($_GET[$nhs_number]) && $_GET[$nhs_number] != '') {
        $query->query_vars['meta_query'] = array(
            array(
                'key'     => $nhs_number,
                'value'   => esc_attr($_GET[$nhs_number]),
                'compare' => 'LIKE',
            ),
        );
    }
}
add_action('pre_get_posts', 'filter_posts_by_meta_value');

// Register Custom Post Type - GP List
function gp_list_post_type() {

	$labels = array(
		'name'                  => _x( 'GP List', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'GP List', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'GP List', 'text_domain' ),
		'name_admin_bar'        => __( 'GP List', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent', 'text_domain' ),
		'all_items'             => __( 'All GP List', 'text_domain' ),
		'add_new_item'          => __( 'Add New', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit', 'text_domain' ),
		'update_item'           => __( 'Update', 'text_domain' ),
		'view_item'             => __( 'View', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Profile Picture', 'text_domain' ),
		'remove_featured_image' => __( 'Remove Profile Picture', 'text_domain' ),
		'use_featured_image'    => __( 'Use as Profile Picture', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'GP List', 'text_domain' ),
		'description'           => __( 'GP List.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
		'rewrite' => array('slug' => 'gp-list','with_front' => false),
	);
	register_post_type( 'gp_list', $args );

}
add_action( 'init', 'gp_list_post_type', 0 );

// Register Custom Post Type - GP List
function feedback_submissions_post_type() {

	$labels = array(
		'name'                  => _x( 'Feedback Submission', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Feedback Submission', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Feedback Submissions', 'text_domain' ),
		'name_admin_bar'        => __( 'Feedback Submissions', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent', 'text_domain' ),
		'all_items'             => __( 'All Feedback Submissions', 'text_domain' ),
		'add_new_item'          => __( 'Add New', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit', 'text_domain' ),
		'update_item'           => __( 'Update', 'text_domain' ),
		'view_item'             => __( 'View', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Profile Picture', 'text_domain' ),
		'remove_featured_image' => __( 'Remove Profile Picture', 'text_domain' ),
		'use_featured_image'    => __( 'Use as Profile Picture', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Feedback Submission', 'text_domain' ),
		'description'           => __( 'Feedback Submission.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
		'rewrite' => array('slug' => 'feedback-submissions','with_front' => false),
	);
	register_post_type( 'feedback_submissions', $args );

}
add_action( 'init', 'feedback_submissions_post_type', 0 );