<?php
/**
 * Registration logic for the new ACF field type.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'mc_include_acf_field_hidden_field' );
/**
 * Registers the ACF field type.
 */
function mc_include_acf_field_hidden_field() {
	if ( ! function_exists( 'acf_register_field_type' ) ) {
		return;
	}

	require_once __DIR__ . '/class-mc-acf-field-hidden-field.php';

	acf_register_field_type( 'mc_acf_field_hidden_field' );
}
