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
		'eligibility' => "Eligibility",
		'gp' => "GP",
		'payment_id' => "Payment ID",
		'login_time' => "Login Time",
		'logout_time' => "Logout Time",
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

	if ($column == 'eligibility') {
        echo get_field('eligibility' , $post_id);
    }

	if ($column == 'gp') {
        echo get_field('gp_name' , $post_id);
    }

	if ($column == 'payment_id') {
        echo get_field('paypal_transaction_id' , $post_id);
    }

	if ($column == 'login_time') {
        echo $lastLoginTime ? $lastLoginTime : '-';
    }

	if ($column == 'logout_time') {
        echo $lastLogoutTime ? $lastLogoutTime : '-';
    }
}
add_action('manage_marucanna-patients_posts_custom_column', 'mc_booking_column_content', 10, 2);

function remove_view_link($actions, $post) {
	
    if ($post->post_type == 'marucanna-patients') {
        unset($actions['view']);
		unset($actions['trash']);

		$patient = get_field('patient' , $post->ID);
		$delete_patinet_url = admin_url( 'admin-post.php?action=delete_patient&patient='.$patient );
        $actions['delete_patinet'] = '<a href="#" data-patient="'.$patient.'">' . __('Delete Patient', 'textdomain') . '</a>';

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


function mc_patient_consent_sidebar_metabox() {
    add_meta_box(
        'mc_patient_consent_button',
        'Patient Consent',
        'mc_patient_consent_button_content',
        'marucanna-patients', // Replace with your custom post type slug
        'side',
        'default'
    );

	add_meta_box(
        'mc_patient_file_download',
        'Patient File',
        'mc_patient_file_download_content',
        'marucanna-patients', // Replace with your custom post type slug
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'mc_patient_consent_sidebar_metabox');

function mc_patient_consent_button_content($post) {

	$consent_url = admin_url( 'admin-post.php?action=sent_consent_form&patient='.get_the_ID() );
	$send_consent = get_post_meta( get_the_ID(), 'send_consent', true );
	$consent_date = get_field('consent_date' , get_the_ID());
	$patient = get_the_ID();

	if( $send_consent ) {
		if( $consent_date ) {
			echo '<p><strong>The patient has given consent.</strong></p>';
		} else {
			echo '<p><strong>The Patient Consent email has been sent.</strong></p><p><a href="#" class="button action" id="send_consent" data-patient="'.$patient.'">Resend</a></p>';
		}
	} else {
		echo '<a href="#" class="button action" id="send_consent" data-patient="'.$patient.'">Send Consent</a>';
	}
}

function mc_patient_file_download_content($post) {

	$patient_file_url = admin_url( 'admin-post.php?action=create_patient_file_pdf&patient='.get_the_ID() );

	echo '<a href="'.$patient_file_url.'" class="button action">Download Patient File</a>';
}

function filter_posts_by_meta_field() {
    global $typenow;

    // Ensure this is the correct post type
    if ($typenow == 'marucanna-patients') {
        $meta_field = 'patient_id'; // Replace with your actual meta field key

        // Display the input field for filtering
        echo '<input type="text" id="' . $meta_field . '" name="' . $meta_field . '" value="' . esc_attr($_GET[$meta_field]) . '" class="postform" placeholder="Patient ID" />';

        // Add the submit button
        echo '<input type="submit" name="filter_action" class="button" value="Filter by Patient ID" style="margin-right: 15px;">';
    }
}
add_action('restrict_manage_posts', 'filter_posts_by_meta_field');

// Step 4: Modify the main query to filter posts based on the entered meta field value
function filter_posts_by_meta_value($query) {
    global $pagenow;
    $meta_field = 'patient_id'; // Replace with your actual meta field key

    // Check if it's the admin and the main query
    if (is_admin() && $pagenow == 'edit.php' && isset($_GET[$meta_field]) && $_GET[$meta_field] != '') {
        $query->query_vars['meta_query'] = array(
            array(
                'key'     => $meta_field,
                'value'   => esc_attr($_GET[$meta_field]),
                'compare' => 'LIKE',
            ),
        );
    }
}
add_action('pre_get_posts', 'filter_posts_by_meta_value');