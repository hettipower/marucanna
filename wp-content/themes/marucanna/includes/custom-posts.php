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
		//'publicly_queryable'    => true,
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
		'rewrite' => array('slug' => 'doctor','with_front' => false),
	);
	register_post_type( 'marucanna-doctors', $args );

}
add_action( 'init', 'doctors_post_type', 0 );

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
		'menu_name'             => __( 'Patients', 'text_domain' ),
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