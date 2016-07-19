<?php
/**
 * The template for adding Additional Header Option in Customizer
 *
 * @package Catch Themes
 * @subpackage Clean Box
 * @since Clean Box 0.1 
 */

if ( ! defined( 'CLEAN_BOX_THEME_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

	// Header Options
	$wp_customize->add_setting( 'clean_box_theme_options[enable_featured_header_image]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['enable_featured_header_image'],
		'sanitize_callback' => 'clean_box_sanitize_select',
	) );

	$clean_box_enable_featured_header_image_options = clean_box_enable_featured_header_image_options();
	$choices = array();
	foreach ( $clean_box_enable_featured_header_image_options as $clean_box_enable_featured_header_image_option ) {
		$choices[$clean_box_enable_featured_header_image_option['value']] = $clean_box_enable_featured_header_image_option['label'];
	}

	$wp_customize->add_control( 'clean_box_theme_options[enable_featured_header_image]', array(
			'choices'  	=> $choices,
			'label'		=> __( 'Enable Featured Header Image on ', 'clean-box' ),
			'section'   => 'header_image',
	        'settings'  => 'clean_box_theme_options[enable_featured_header_image]',
	        'type'	  	=> 'select',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[featured_image_size]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_image_size'],
		'sanitize_callback' => 'clean_box_sanitize_select',
	) );

	$clean_box_featured_image_size_options = clean_box_featured_image_size_options();
	$choices = array();
	foreach ( $clean_box_featured_image_size_options as $clean_box_featured_image_size_option ) {
		$choices[$clean_box_featured_image_size_option['value']] = $clean_box_featured_image_size_option['label'];
	}

	$wp_customize->add_control( 'clean_box_theme_options[featured_image_size]', array(
			'choices'  	=> $choices,
			'label'		=> __( 'Page/Post Featured Header Image Size', 'clean-box' ),
			'section'   => 'header_image',
			'settings'  => 'clean_box_theme_options[featured_image_size]',
			'type'	  	=> 'select',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[featured_header_image_alt]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_header_image_alt'],
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'clean_box_theme_options[featured_header_image_alt]', array(
			'label'		=> __( 'Featured Header Image Alt/Title Tag ', 'clean-box' ),
			'section'   => 'header_image',
	        'settings'  => 'clean_box_theme_options[featured_header_image_alt]',
	        'type'	  	=> 'text',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[featured_header_image_url]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_header_image_url'],
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'clean_box_theme_options[featured_header_image_url]', array(
			'label'		=> __( 'Featured Header Image Link URL', 'clean-box' ),
			'section'   => 'header_image',
	        'settings'  => 'clean_box_theme_options[featured_header_image_url]',
	        'type'	  	=> 'text',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[featured_header_image_base]', array(
		'capability'		=> 'edit_theme_options',
		'default'	=> $defaults['featured_header_image_url'],
		'sanitize_callback' => 'clean_box_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'clean_box_theme_options[featured_header_image_base]', array(
		'label'    	=> __( 'Check to Open Link in New Window/Tab', 'clean-box' ),
		'section'  	=> 'header_image',
		'settings' 	=> 'clean_box_theme_options[featured_header_image_base]',
		'type'     	=> 'checkbox',
	) );	
// Header Options End