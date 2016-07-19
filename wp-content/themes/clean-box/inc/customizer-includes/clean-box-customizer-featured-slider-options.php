<?php
/**
 * The template for adding Featured Slider Options in Customizer
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
	// Featured Slider
	if ( 4.3 > get_bloginfo( 'version' ) ) {
		$wp_customize->add_panel( 'clean_box_featured_slider', array(
		    'capability'     => 'edit_theme_options',
		    'description'    => __( 'Featured Slider Options', 'clean-box' ),
		    'priority'       => 500,
			'title'    		 => __( 'Featured Slider', 'clean-box' ),
		) );

		$wp_customize->add_section( 'clean_box_featured_slider', array(
			'panel'			=> 'clean_box_featured_slider',
			'priority'		=> 1,
			'title'			=> __( 'Featured Slider Options', 'clean-box' ),
		) );
	}
	else {
		$wp_customize->add_section( 'clean_box_featured_slider', array(
			'priority'		=> 500,
			'title'			=> __( 'Featured Slider', 'clean-box' ),
		) );
	}

	$wp_customize->add_setting( 'clean_box_theme_options[featured_slider_option]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slider_option'],
		'sanitize_callback' => 'clean_box_sanitize_select',
	) );

	$featured_slider_content_options = clean_box_featured_grid_content_options();
	$choices = array();
	foreach ( $featured_slider_content_options as $featured_slider_content_option ) {
		$choices[$featured_slider_content_option['value']] = $featured_slider_content_option['label'];
	}

	$wp_customize->add_control( 'clean_box_theme_options[featured_slider_option]', array(
		'choices'   => $choices,
		'label'    	=> __( 'Enable Slider on', 'clean-box' ),
		'priority'	=> '1.1',
		'section'  	=> 'clean_box_featured_slider',
		'settings' 	=> 'clean_box_theme_options[featured_slider_option]',
		'type'    	=> 'select',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[featured_slider_transition_effect]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slider_transition_effect'],
		'sanitize_callback'	=> 'clean_box_sanitize_select',
	) );

	$clean_box_featured_slider_transition_effects = catch_box_featured_slider_transition_effects();
	$choices = array();
	foreach ( $clean_box_featured_slider_transition_effects as $clean_box_featured_slider_transition_effect ) {
		$choices[$clean_box_featured_slider_transition_effect['value']] = $clean_box_featured_slider_transition_effect['label'];
	}

	$wp_customize->add_control( 'clean_box_theme_options[featured_slider_transition_effect]' , array(
		'active_callback'	=> 'clean_box_is_slider_active',
		'choices'  			=> $choices,
		'label'				=> __( 'Transition Effect', 'clean-box' ),
		'priority'			=> '2',
		'section'  			=> 'clean_box_featured_slider',
		'settings' 			=> 'clean_box_theme_options[featured_slider_transition_effect]',
		'type'	  			=> 'select',
		)
	);

	$wp_customize->add_setting( 'clean_box_theme_options[featured_slider_transition_delay]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slider_transition_delay'],
		'sanitize_callback'	=> 'clean_box_sanitize_number_range',
	) );

	$wp_customize->add_control( 'clean_box_theme_options[featured_slider_transition_delay]' , array(
		'active_callback'	=> 'clean_box_is_slider_active',
		'description'		=> __( 'seconds(s)', 'clean-box' ),
		'input_attrs' 		=> array(
        	'style' => 'width: 40px;'
    	),
    	'label'    			=> __( 'Transition Delay', 'clean-box' ),
		'priority'			=> '2.1.1',
		'section'  			=> 'clean_box_featured_slider',
		'settings' 			=> 'clean_box_theme_options[featured_slider_transition_delay]',
		)
	);

	$wp_customize->add_setting( 'clean_box_theme_options[featured_slider_transition_length]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slider_transition_length'],
		'sanitize_callback'	=> 'clean_box_sanitize_number_range',
	) );

	$wp_customize->add_control( 'clean_box_theme_options[featured_slider_transition_length]' , array(
		'active_callback'	=> 'clean_box_is_slider_active',
		'description'	=> __( 'seconds(s)', 'clean-box' ),
		'input_attrs' => array(
        	'style' => 'width: 40px;'
    	),
    	'label'    		=> __( 'Transition Length', 'clean-box' ),
		'priority'		=> '2.1.2',
		'section'  		=> 'clean_box_featured_slider',
		'settings' 		=> 'clean_box_theme_options[featured_slider_transition_length]',
		)
	);

	$wp_customize->add_setting( 'clean_box_theme_options[featured_slider_image_loader]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slider_image_loader'],
		'sanitize_callback' => 'clean_box_sanitize_select',
	) );

	$featured_slider_image_loader_options = clean_box_featured_slider_image_loader();
	$choices = array();
	foreach ( $featured_slider_image_loader_options as $featured_slider_image_loader_option ) {
		$choices[$featured_slider_image_loader_option['value']] = $featured_slider_image_loader_option['label'];
	}

	$wp_customize->add_control( 'clean_box_theme_options[featured_slider_image_loader]', array(
		'active_callback'	=> 'clean_box_is_slider_active',
		'description'		=> __( 'True: Fixes the height overlap issue. Slideshow will start as soon as two slider are available. Slide may display in random, as image is fetch.<br>Wait: Fixes the height overlap issue.<br> Slideshow will start only after all images are available.', 'clean-box' ),
		'choices'   => $choices,
		'label'    	=> __( 'Image Loader', 'clean-box' ),
		'priority'	=> '2.1.3',
		'section'  	=> 'clean_box_featured_slider',
		'settings' 	=> 'clean_box_theme_options[featured_slider_image_loader]',
		'type'    	=> 'select',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[featured_slider_type]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slider_type'],
		'sanitize_callback' => 'clean_box_sanitize_select',
	) );

	$featured_slider_types = clean_box_featured_slider_types();
	$choices = array();
	foreach ( $featured_slider_types as $featured_slider_type ) {
		$choices[$featured_slider_type['value']] = $featured_slider_type['label'];
	}

	$wp_customize->add_control( 'clean_box_theme_options[featured_slider_type]', array(
		'active_callback'	=> 'clean_box_is_slider_active',
		'choices'  	=> $choices,
		'label'    	=> __( 'Select Slider Type', 'clean-box' ),
		'priority'	=> '2.1.3',
		'section'  	=> 'clean_box_featured_slider',
		'settings' 	=> 'clean_box_theme_options[featured_slider_type]',
		'type'	  	=> 'select',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[featured_slider_number]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slider_number'],
		'sanitize_callback'	=> 'clean_box_sanitize_number_range',
	) );

	$wp_customize->add_control( 'clean_box_theme_options[featured_slider_number]' , array(
		'active_callback'	=> 'clean_box_is_demo_slider_inactive',
		'description'	=> __( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'clean-box' ),
		'input_attrs' 	=> array(
            'style' => 'width: 45px;',
            'min'   => 0,
            'max'   => 20,
            'step'  => 1,
        	),
		'label'    		=> __( 'No of Slides', 'clean-box' ),
		'priority'		=> '2.1.4',
		'section'  		=> 'clean_box_featured_slider',
		'settings' 		=> 'clean_box_theme_options[featured_slider_number]',
		'type'	   		=> 'number',
		)
	);

	//loop for featured post sliders
	for ( $i=1; $i <=  $options['featured_slider_number'] ; $i++ ) {
		$wp_customize->add_setting( 'clean_box_theme_options[featured_slider_page_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'clean_box_sanitize_page',
		) );

		$wp_customize->add_control( 'clean_box_theme_options[featured_slider_page_'. $i .']', array(
			'active_callback'	=> 'clean_box_is_demo_slider_inactive',
			'label'    	=> __( 'Featured Page', 'clean-box' ) . ' # ' . $i ,
			'priority'	=> '4' . $i,
			'section'  	=> 'clean_box_featured_slider',
			'settings' 	=> 'clean_box_theme_options[featured_slider_page_'. $i .']',
			'type'	   	=> 'dropdown-pages',
		) );
	}
// Featured Slider End