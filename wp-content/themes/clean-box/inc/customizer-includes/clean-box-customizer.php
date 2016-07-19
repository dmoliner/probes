<?php
/**
 * The main template for implementing Theme/Customzer Options
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


/**
 * Implements Clean Box theme options into Theme Customizer.
 *
 * @param $wp_customize Theme Customizer object
 * @return void
 *
 * @since Clean Box 0.1
 */
function clean_box_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport			= 'postMessage';

	/**
	  * Set priority of blogname (Site Title) to 1.
	  *  Strangly, if more than two options is added, Site title is moved below Tagline. This rectifies this issue.
	  */
	$wp_customize->get_control( 'blogname' )->priority			= 1;

	$wp_customize->get_setting( 'blogdescription' )->transport	= 'postMessage';

	$options  = clean_box_get_theme_options();

	$defaults = clean_box_get_default_theme_options();

	//Custom Controls
	require get_template_directory() . '/inc/customizer-includes/clean-box-customizer-custom-controls.php';

	//@remove Remove this block when WordPress 4.8 is released
	if ( ! function_exists( 'has_custom_logo' ) ) {
		// Custom Logo (added to Site Title and Tagline section in Theme Customizer)
		$wp_customize->add_setting( 'clean_box_theme_options[logo]', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults['logo'],
			'sanitize_callback'	=> 'clean_box_sanitize_image'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array(
			'label'		=> __( 'Logo', 'clean-box' ),
			'priority'	=> 100,
			'section'   => 'title_tagline',
	        'settings'  => 'clean_box_theme_options[logo]',
	    ) ) );

	    $wp_customize->add_setting( 'clean_box_theme_options[logo_disable]', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults['logo_disable'],
			'sanitize_callback' => 'clean_box_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'clean_box_theme_options[logo_disable]', array(
			'label'    => __( 'Check to disable logo', 'clean-box' ),
			'priority' => 101,
			'section'  => 'title_tagline',
			'settings' => 'clean_box_theme_options[logo_disable]',
			'type'     => 'checkbox',
		) );

		$wp_customize->add_setting( 'clean_box_theme_options[logo_alt_text]', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults['logo_alt_text'],
			'sanitize_callback'	=> 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'clean_box_logo_alt_text', array(
			'label'    	=> __( 'Logo Alt Text', 'clean-box' ),
			'priority'	=> 102,
			'section' 	=> 'title_tagline',
			'settings' 	=> 'clean_box_theme_options[logo_alt_text]',
			'type'     	=> 'text',
		) );
	}

	$wp_customize->add_setting( 'clean_box_theme_options[move_title_tagline]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['move_title_tagline'],
		'sanitize_callback' => 'clean_box_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'clean_box_theme_options[move_title_tagline]', array(
		'label'    => __( 'Check to move Site Title and Tagline before logo', 'clean-box' ),
		'priority' => function_exists( 'has_custom_logo' ) ? 10 : 103,
		'section'  => 'title_tagline',
		'settings' => 'clean_box_theme_options[move_title_tagline]',
		'type'     => 'checkbox',
	) );
	// Custom Logo End

	//Fixed Header Options
   	$wp_customize->add_section( 'clean_box_fixed_header_options', array(
		'priority' 		=> 30,
		'title'    		=> __( 'Fixed Header Options', 'clean-box' ),
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[logo_icon]', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'clean_box_sanitize_image',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'clean_box_theme_options[logo_icon]', array(
		'label'		=> __( 'Select/Add Logo Icon', 'clean-box' ),
		'section'    => 'clean_box_fixed_header_options',
        'settings'   => 'clean_box_theme_options[logo_icon]',
	) ) );
	//Fixed Header Options End

	// Color Scheme
	$wp_customize->add_setting( 'clean_box_theme_options[color_scheme]', array(
		'capability' 		=> 'edit_theme_options',
		'default'    		=> $defaults['color_scheme'],
		'sanitize_callback'	=> 'clean_box_sanitize_select'
	) );

	$schemes = clean_box_color_schemes();

	$choices = array();

	foreach ( $schemes as $scheme ) {
		$choices[ $scheme['value'] ] = $scheme['label'];
	}

	$wp_customize->add_control( 'clean_box_theme_options[color_scheme]', array(
		'choices'  => $choices,
		'label'    => __( 'Color Scheme', 'clean-box' ),
		'priority' => 5,
		'section'  => 'colors',
		'settings' => 'clean_box_theme_options[color_scheme]',
		'type'     => 'radio',
	) );
	//End Color Scheme

	// Header Options (added to Header section in Theme Customizer)
	require get_template_directory() . '/inc/customizer-includes/clean-box-customizer-header-options.php';

	//Theme Options
	require get_template_directory() . '/inc/customizer-includes/clean-box-customizer-theme-options.php';

	//Featured Content Setting
	require get_template_directory() . '/inc/customizer-includes/clean-box-customizer-featured-content-setting.php';

	//Featured Grid Content
	require get_template_directory() . '/inc/customizer-includes/clean-box-customizer-featured-grid-content.php';

	//Featured Slider
	require get_template_directory() . '/inc/customizer-includes/clean-box-customizer-featured-slider-options.php';

	//Social Links
	require get_template_directory() . '/inc/customizer-includes/clean-box-customizer-social-icons.php';

	// Reset all settings to default
	$wp_customize->add_section( 'clean_box_reset_all_settings', array(
		'description'	=> __( 'Caution: Reset all settings to default. Refresh the page after save to view full effects.', 'clean-box' ),
		'priority' 		=> 700,
		'title'    		=> __( 'Reset all settings', 'clean-box' ),
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[reset_all_settings]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['reset_all_settings'],
		'sanitize_callback' => 'clean_box_reset_all_settings',
		'transport'			=> 'postMessage',
	) );

	$wp_customize->add_control( 'clean_box_theme_options[reset_all_settings]', array(
		'label'    => __( 'Check to reset all settings to default', 'clean-box' ),
		'section'  => 'clean_box_reset_all_settings',
		'settings' => 'clean_box_theme_options[reset_all_settings]',
		'type'     => 'checkbox',
	) );
	// Reset all settings to default end


	//Important Links
		$wp_customize->add_section( 'important_links', array(
			'priority' 		=> 999,
			'title'   	 	=> __( 'Important Links', 'clean-box' ),
		) );

		/**
		 * Has dummy Sanitizaition function as it contains no value to be sanitized
		 */
		$wp_customize->add_setting( 'important_links', array(
			'sanitize_callback'	=> 'clean_box_sanitize_important_link',
		) );

		$wp_customize->add_control( new Clean_Box_Important_Links( $wp_customize, 'important_links', array(
	        'label'   	=> __( 'Important Links', 'clean-box' ),
	         'section'  	=> 'important_links',
	        'settings' 	=> 'important_links',
	        'type'     	=> 'important_links',
	    ) ) );
	   //Important Links End
}
add_action( 'customize_register', 'clean_box_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously for clean-box.
 * And flushes out all transient data on preview
 *
 * @since Clean Box 0.1
 */
function clean_box_customize_preview() {
	wp_enqueue_script( 'clean_box_customizer', get_template_directory_uri() . '/js/clean-box-customizer.min.js', array( 'customize-preview' ), '20120827', true );

	//Flush transients
	clean_box_flush_transients();
}
add_action( 'customize_preview_init', 'clean_box_customize_preview' );


/**
 * Custom scripts and styles on customize.php for clean_box.
 *
 * @since Clean Box 0.1
 */
function clean_box_customize_scripts() {
	wp_enqueue_script( 'clean_box_customizer_custom', get_template_directory_uri() . '/js/clean-box-customizer-custom-scripts.min.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20150630', true );

	$clean_box_misc_links = array(
							'upgrade_link' 				=> esc_url( 'http://catchthemes.com/themes/clean-box-pro/' ),
							'upgrade_text'	 			=> __( 'Upgrade To Pro &raquo;', 'clean-box' ),
							'WP_version'				=> get_bloginfo( 'version' ),
							'old_version_message'		=> __( 'Some settings might be missing or disorganized in this version of WordPress. So we suggest you to upgrade to version 4.0 or better.', 'clean-box' )
		);

	$clean_box_misc_links['color_list'] = clean_box_color_list();

	//Add Upgrade Button and old WordPress message via localized script
	wp_localize_script( 'clean_box_customizer_custom', 'clean_box_misc_links', $clean_box_misc_links );

	wp_enqueue_style( 'clean_box_customizer_custom_css', get_template_directory_uri() . '/css/clean-box-customizer.css');
}
add_action( 'customize_controls_enqueue_scripts', 'clean_box_customize_scripts');


/**
 * Returns list of color keys of array with default values for each color scheme as index
 *
 * @since Clean Box 0.1
 */
function clean_box_color_list() {
	// Get default color scheme values
	$default 		= clean_box_get_default_theme_options();
	// Get default dark color scheme valies
	$default_dark 	= clean_box_default_dark_color_options();

	$clean_box_color_list['background_color']['light']	= $default['background_color'];
	$clean_box_color_list['background_color']['dark']	= $default_dark['background_color'];

	$clean_box_color_list['header_textcolor']['light']	= $default['header_textcolor'];
	$clean_box_color_list['header_textcolor']['dark']	= $default_dark['header_textcolor'];

	return $clean_box_color_list;
}


//Active callbacks for customizer
require get_template_directory() . '/inc/customizer-includes/clean-box-customizer-active-callbacks.php';


//Sanitize functions for customizer
require get_template_directory() . '/inc/customizer-includes/clean-box-customizer-sanitize-functions.php';