<?php
/**
 * Functions and definitions
 *
 * Sets up the theme using core clean-box-core and provides some helper functions using clean-box-custon-functions.
 * Others are attached to action and
 * filter hooks in WordPress to change core functionality
 *
 * @package Catch Themes
 * @subpackage Clean Box
 * @since Clean Box 0.1 
 */

//define theme version
if ( !defined( 'CLEAN_BOX_THEME_VERSION' ) ) {
	$theme_data = wp_get_theme();
	
	define ( 'CLEAN_BOX_THEME_VERSION', $theme_data->get( 'Version' ) );
}

/**
 * Implement the core functions
 */
require get_template_directory() . '/inc/clean-box-core.php';