<?php
/*------------------------------------*\
    ACF Related Functions
\*------------------------------------*/

// Print image tag from ACF
function mc_acf_image($acf_obj, $size='full', $class=''){

	if (is_array($acf_obj)) {

		$image_url = ( $size=='full' ) ? $acf_obj['url'] : $acf_obj['sizes'][$size];
		$image_alt = $acf_obj['alt'];
		$image_class = !empty($class) ? 'class="'.$class.'"' : '';

		return '<img loading="lazy" src="'.$image_url.'" alt="'.$image_alt.'" '.$image_class.'>';

	} else if ( filter_var($acf_obj, FILTER_VALIDATE_URL) ) {

		return '<img loading="lazy" src="'.$acf_obj.'" '.$image_class.'>';

	} else {

		return 'Not a valid image.';

	}

}


function mc_acf_link($acf_obj, $class=''){

	if (is_array($acf_obj)) {

		$link_title = $acf_obj['title'];
		$link_url = !empty($acf_obj['url']) ? $acf_obj['url'] : '#';
		$link_target = !empty($acf_obj['target']) ? 'target="'.$acf_obj['target'].'"' : '';
		$link_class = !empty($class) ? 'class="'.$class.'"' : '';

		return '<a href="'.$link_url.'" '.$link_class.' '.$link_target.'>'.$link_title.'</a>';

	} else if ( filter_var($acf_obj, FILTER_VALIDATE_URL) ) {

		return '<a href="'.$acf_obj.'" '.$link_class.'>'.$link_title.'</a>';

	} else {

		return 'Not a valid link.';

	}

}



/* ACF Theme Options */

if( function_exists('acf_add_options_page') ) {
	
	
	acf_add_options_sub_page(array(

		'page_title' 	=> 'Theme Options',

		'menu_title'	=> 'Theme Options',

		'menu_slug' 	=> 'theme-options',

		'capability'	=> 'activate_plugins',

		'redirect'		=> false


	));
	
	
	
}