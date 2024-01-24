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
		'date' => "Date"
	);

    return $columns;
}
add_filter('manage_marucanna-patients_posts_columns', 'mc_booking_column_header');

// Display content for custom column
function mc_booking_column_content($column, $post_id) {
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
}
add_action('manage_marucanna-patients_posts_custom_column', 'mc_booking_column_content', 10, 2);

function remove_view_link($actions, $post) {
	
    if ($post->post_type == 'marucanna-patients') {
        unset($actions['view']);
    }

    return $actions;
}
add_filter('post_row_actions', 'remove_view_link', 10, 2);