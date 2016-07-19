<?php
/**
 * The template for adding additional theme options in Customizer
 *
 * @package Catch Themes
 * @subpackage Clean Box
 * @since Clean Box 0.1
 */

// Additional Color Scheme (added to Color Scheme section in Theme Customizer)
if ( ! defined( 'CLEAN_BOX_THEME_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

//Theme Options
	$wp_customize->add_panel( 'clean_box_theme_options', array(
	    'description'    => __( 'Basic theme Options', 'clean-box' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => 200,
	    'title'    		 => __( 'Theme Options', 'clean-box' ),
	) );

	// Breadcrumb Option
	$wp_customize->add_section( 'clean_box_breadcumb_options', array(
		'description'	=> __( 'Breadcrumbs are a great way of letting your visitors find out where they are on your site with just a glance. You can enable/disable them on homepage and entire site.', 'clean-box' ),
		'panel'			=> 'clean_box_theme_options',
		'title'    		=> __( 'Breadcrumb Options', 'clean-box' ),
		'priority' 		=> 201,
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[breadcumb_option]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['breadcumb_option'],
		'sanitize_callback' => 'clean_box_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'clean_box_theme_options[breadcumb_option]', array(
		'label'    => __( 'Check to enable Breadcrumb', 'clean-box' ),
		'section'  => 'clean_box_breadcumb_options',
		'settings' => 'clean_box_theme_options[breadcumb_option]',
		'type'     => 'checkbox',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[breadcumb_onhomepage]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['breadcumb_onhomepage'],
		'sanitize_callback' => 'clean_box_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'clean_box_theme_options[breadcumb_onhomepage]', array(
		'label'    => __( 'Check to enable Breadcrumb on Homepage', 'clean-box' ),
		'section'  => 'clean_box_breadcumb_options',
		'settings' => 'clean_box_theme_options[breadcumb_onhomepage]',
		'type'     => 'checkbox',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[breadcumb_seperator]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['breadcumb_seperator'],
		'sanitize_callback'	=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'clean_box_theme_options[breadcumb_seperator]', array(
		'input_attrs' => array(
        		'style' => 'width: 40px;'
    		),
    	'label'    	=> __( 'Seperator between Breadcrumbs', 'clean-box' ),
		'section' 	=> 'clean_box_breadcumb_options',
		'settings' 	=> 'clean_box_theme_options[breadcumb_seperator]',
		'type'     	=> 'text'
		)
	);
   	// Breadcrumb Option End

   	// Custom CSS Option
	$wp_customize->add_section( 'clean_box_custom_css', array(
		'description'	=> __( 'Custom/Inline CSS', 'clean-box'),
		'panel'  		=> 'clean_box_theme_options',
		'priority' 		=> 203,
		'title'    		=> __( 'Custom CSS Options', 'clean-box' ),
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[custom_css]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['custom_css'],
		'sanitize_callback' => 'clean_box_sanitize_custom_css',
	) );

	$wp_customize->add_control( 'clean_box_theme_options[custom_css]', array(
			'label'		=> __( 'Enter Custom CSS', 'clean-box' ),
	        'priority'	=> 1,
			'section'   => 'clean_box_custom_css',
	        'settings'  => 'clean_box_theme_options[custom_css]',
			'type'		=> 'textarea',
	) );
   	// Custom CSS End

   	// Excerpt Options
	$wp_customize->add_section( 'clean_box_excerpt_options', array(
		'panel'  	=> 'clean_box_theme_options',
		'priority' 	=> 204,
		'title'    	=> __( 'Excerpt Options', 'clean-box' ),
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[excerpt_length]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['excerpt_length'],
		'sanitize_callback' => 'clean_box_sanitize_number_range',
	) );

	$wp_customize->add_control( 'clean_box_theme_options[excerpt_length]', array(
		'description' => __('Excerpt length. Default is 35 words', 'clean-box'),
		'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
            'style' => 'width: 60px;'
            ),
        'label'    => __( 'Excerpt Length (words)', 'clean-box' ),
		'section'  => 'clean_box_excerpt_options',
		'settings' => 'clean_box_theme_options[excerpt_length]',
		'type'	   => 'number',
		)
	);

	$wp_customize->add_setting( 'clean_box_theme_options[excerpt_more_text]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['excerpt_more_text'],
		'sanitize_callback'	=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'clean_box_theme_options[excerpt_more_text]', array(
		'label'    => __( 'Read More Text', 'clean-box' ),
		'section'  => 'clean_box_excerpt_options',
		'settings' => 'clean_box_theme_options[excerpt_more_text]',
		'type'	   => 'text',
	) );
	// Excerpt Options End

	//Homepage / Frontpage Options
	$wp_customize->add_section( 'clean_box_homepage_options', array(
		'description'	=> __( 'Only posts that belong to the categories selected here will be displayed on the front page', 'clean-box' ),
		'panel'			=> 'clean_box_theme_options',
		'priority' 		=> 210,
		'title'   	 	=> __( 'Homepage / Frontpage Options', 'clean-box' ),
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[front_page_category]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['front_page_category'],
		'sanitize_callback'	=> 'clean_box_sanitize_category_list',
	) );

	$wp_customize->add_control( new Clean_Box_Customize_Dropdown_Categories_Control( $wp_customize, 'clean_box_theme_options[front_page_category]', array(
        'label'   	=> __( 'Select Categories', 'clean-box' ),
        'name'	 	=> 'clean_box_theme_options[front_page_category]',
		'priority'	=> '6',
        'section'  	=> 'clean_box_homepage_options',
        'settings' 	=> 'clean_box_theme_options[front_page_category]',
        'type'     	=> 'dropdown-categories',
    ) ) );
	//Homepage / Frontpage Settings End


	// Layout Options
	$wp_customize->add_section( 'clean_box_layout', array(
		'capability'=> 'edit_theme_options',
		'panel'		=> 'clean_box_theme_options',
		'priority'	=> 211,
		'title'		=> __( 'Layout Options', 'clean-box' ),
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[theme_layout]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['theme_layout'],
		'sanitize_callback' => 'clean_box_sanitize_select',
	) );

	$layouts = clean_box_layouts();
	$choices = array();
	foreach ( $layouts as $layout ) {
		$choices[ $layout['value'] ] = $layout['label'];
	}

	$wp_customize->add_control( 'clean_box_theme_options[theme_layout]', array(
		'choices'	=> $choices,
		'label'		=> __( 'Default Layout', 'clean-box' ),
		'section'	=> 'clean_box_layout',
		'settings'   => 'clean_box_theme_options[theme_layout]',
		'type'		=> 'select',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[content_layout]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['content_layout'],
		'sanitize_callback' => 'clean_box_sanitize_select',
	) );

	$layouts = clean_box_get_archive_content_layout();
	$choices = array();
	foreach ( $layouts as $layout ) {
		$choices[ $layout['value'] ] = $layout['label'];
	}

	$wp_customize->add_control( 'clean_box_theme_options[content_layout]', array(
		'choices'   => $choices,
		'label'		=> __( 'Archive Content Layout', 'clean-box' ),
		'section'   => 'clean_box_layout',
		'settings'  => 'clean_box_theme_options[content_layout]',
		'type'      => 'select',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[single_post_image_layout]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['single_post_image_layout'],
		'sanitize_callback' => 'clean_box_sanitize_select',
	) );


	$single_post_image_layouts = clean_box_single_post_image_layout_options();
	$choices = array();
	foreach ( $single_post_image_layouts as $single_post_image_layout ) {
		$choices[$single_post_image_layout['value']] = $single_post_image_layout['label'];
	}

	$wp_customize->add_control( 'clean_box_theme_options[single_post_image_layout]', array(
			'label'		=> __( 'Single Page/Post Image Layout ', 'clean-box' ),
			'section'   => 'clean_box_layout',
	        'settings'  => 'clean_box_theme_options[single_post_image_layout]',
	        'type'	  	=> 'select',
			'choices'  	=> $choices,
	) );
   	// Layout Options End

	// Pagination Options
	$pagination_type	= $options['pagination_type'];

	$clean_box_navigation_description = sprintf( __( 'Numeric Option requires <a target="_blank" href="%s">WP-PageNavi Plugin</a>.<br/>Infinite Scroll Options requires <a target="_blank" href="%s">JetPack Plugin</a> with Infinite Scroll module Enabled.', 'clean-box' ), esc_url( 'https://wordpress.org/plugins/wp-pagenavi' ), esc_url( 'https://wordpress.org/plugins/jetpack/' ) );

	/**
	 * Check if navigation type is Jetpack Infinite Scroll and if it is enabled
	 */
	if ( ( 'infinite-scroll-click' == $pagination_type || 'infinite-scroll-scroll' == $pagination_type ) ) {
		if ( ! (class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) ) {
			$clean_box_navigation_description = sprintf( __( 'Infinite Scroll Options requires <a target="_blank" href="%s">JetPack Plugin</a> with Infinite Scroll module Enabled.', 'clean-box' ), esc_url( 'https://wordpress.org/plugins/jetpack/' ) );
		}
		else {
			$clean_box_navigation_description = '';
		}
	}
	/**
	* Check if navigation type is numeric and if Wp-PageNavi Plugin is enabled
	*/
	else if ( 'numeric' == $pagination_type ) {
		if ( !function_exists( 'wp_pagenavi' ) ) {
			$clean_box_navigation_description = sprintf( __( 'Numeric Option requires <a target="_blank" href="%s">WP-PageNavi Plugin</a>.', 'clean-box' ), esc_url( 'https://wordpress.org/plugins/wp-pagenavi' ) );
		}
		else {
			$clean_box_navigation_description = '';
		}
    }

	$wp_customize->add_section( 'clean_box_pagination_options', array(
		'description'	=> $clean_box_navigation_description,
		'panel'  		=> 'clean_box_theme_options',
		'priority'		=> 212,
		'title'    		=> __( 'Pagination Options', 'clean-box' ),
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[pagination_type]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['pagination_type'],
		'sanitize_callback' => 'clean_box_sanitize_select',
	) );

	$pagination_types = clean_box_get_pagination_types();
	$choices = array();
	foreach ( $pagination_types as $pagination_type ) {
		$choices[$pagination_type['value']] = $pagination_type['label'];
	}

	$wp_customize->add_control( 'clean_box_theme_options[pagination_type]', array(
		'choices'  => $choices,
		'label'    => __( 'Pagination type', 'clean-box' ),
		'section'  => 'clean_box_pagination_options',
		'settings' => 'clean_box_theme_options[pagination_type]',
		'type'	   => 'select',
	) );
	// Pagination Options End

	//Promotion Headline Options
    $wp_customize->add_section( 'clean_box_promotion_headline_options', array(
		'description'	=> __( 'To disable the fields, simply leave them empty.', 'clean-box' ),
		'panel'			=> 'clean_box_theme_options',
		'priority' 		=> 213,
		'title'   	 	=> __( 'Promotion Headline Options', 'clean-box' ),
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[promotion_headline_option]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['promotion_headline_option'],
		'sanitize_callback' => 'clean_box_sanitize_select',
	) );

	$clean_box_featured_grid_content_options = clean_box_featured_grid_content_options();
	$choices = array();
	foreach ( $clean_box_featured_grid_content_options as $clean_box_featured_grid_content_option ) {
		$choices[$clean_box_featured_grid_content_option['value']] = $clean_box_featured_grid_content_option['label'];
	}

	$wp_customize->add_control( 'clean_box_theme_options[promotion_headline_option]', array(
		'choices'  	=> $choices,
		'label'    	=> __( 'Enable Promotion Headline on', 'clean-box' ),
		'priority'	=> '0.5',
		'section'  	=> 'clean_box_promotion_headline_options',
		'settings' 	=> 'clean_box_theme_options[promotion_headline_option]',
		'type'	  	=> 'select',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[promotion_headline]', array(
		'capability'		=> 'edit_theme_options',
		'default' 			=> $defaults['promotion_headline'],
		'sanitize_callback'	=> 'wp_kses_post'
	) );

	$wp_customize->add_control( 'clean_box_theme_options[promotion_headline]', array(
		'description'	=> __( 'Appropriate Words: 10', 'clean-box' ),
		'label'    	=> __( 'Promotion Headline Text', 'clean-box' ),
		'priority'	=> '1',
		'section' 	=> 'clean_box_promotion_headline_options',
		'settings'	=> 'clean_box_theme_options[promotion_headline]',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[promotion_subheadline]', array(
		'capability'		=> 'edit_theme_options',
		'default' 			=> $defaults['promotion_subheadline'],
		'sanitize_callback'	=> 'wp_kses_post'
	) );

	$wp_customize->add_control( 'clean_box_theme_options[promotion_subheadline]', array(
		'description'	=> __( 'Appropriate Words: 15', 'clean-box' ),
		'label'    	=> __( 'Promotion Subheadline Text', 'clean-box' ),
		'priority'	=> '2',
		'section' 	=> 'clean_box_promotion_headline_options',
		'settings'	=> 'clean_box_theme_options[promotion_subheadline]',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[promotion_headline_button_1]', array(
		'capability'		=> 'edit_theme_options',
		'default' 			=> $defaults['promotion_headline_button_1'],
		'sanitize_callback'	=> 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'clean_box_theme_options[promotion_headline_button_1]', array(
		'description'	=> __( 'Appropriate Words: 3', 'clean-box' ),
		'label'    	=> __( 'Promotion Headline Button 1 Text ', 'clean-box' ),
		'priority'	=> '3',
		'section' 	=> 'clean_box_promotion_headline_options',
		'settings'	=> 'clean_box_theme_options[promotion_headline_button_1]',
		'type'		=> 'text',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[promotion_headline_url_1]', array(
		'capability'		=> 'edit_theme_options',
		'default' 			=> $defaults['promotion_headline_url_1'],
		'sanitize_callback'	=> 'esc_url_raw'
	) );

	$wp_customize->add_control( 'clean_box_theme_options[promotion_headline_url_1]', array(
		'label'    	=> __( 'Promotion Headline Button 1 Link', 'clean-box' ),
		'priority'	=> '4',
		'section' 	=> 'clean_box_promotion_headline_options',
		'settings'	=> 'clean_box_theme_options[promotion_headline_url_1]',
		'type'		=> 'text',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[promotion_headline_target_1]', array(
		'capability'		=> 'edit_theme_options',
		'default' 			=> $defaults['promotion_headline_target_1'],
		'sanitize_callback' => 'clean_box_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'clean_box_theme_options[promotion_headline_target_1]', array(
		'label'    	=> __( 'Check to Open Button 1 Link in New Window/Tab', 'clean-box' ),
		'priority'	=> '5',
		'section'  	=> 'clean_box_promotion_headline_options',
		'settings' 	=> 'clean_box_theme_options[promotion_headline_target_1]',
		'type'     	=> 'checkbox',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[promotion_headline_button_2]', array(
		'capability'		=> 'edit_theme_options',
		'default' 			=> $defaults['promotion_headline_button_2'],
		'sanitize_callback'	=> 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'clean_box_theme_options[promotion_headline_button_2]', array(
		'description'	=> __( 'Appropriate Words: 3', 'clean-box' ),
		'label'    	=> __( 'Promotion Headline Button 2 Text ', 'clean-box' ),
		'priority'	=> '6',
		'section' 	=> 'clean_box_promotion_headline_options',
		'settings'	=> 'clean_box_theme_options[promotion_headline_button_2]',
		'type'		=> 'text',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[promotion_headline_url_2]', array(
		'capability'		=> 'edit_theme_options',
		'default' 			=> $defaults['promotion_headline_url_2'],
		'sanitize_callback'	=> 'esc_url_raw'
	) );

	$wp_customize->add_control( 'clean_box_theme_options[promotion_headline_url_2]', array(
		'label'    	=> __( 'Promotion Headline Button 2 Link', 'clean-box' ),
		'priority'	=> '7',
		'section' 	=> 'clean_box_promotion_headline_options',
		'settings'	=> 'clean_box_theme_options[promotion_headline_url_2]',
		'type'		=> 'text',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[promotion_headline_target_2]', array(
		'capability'		=> 'edit_theme_options',
		'default' 			=> $defaults['promotion_headline_target_2'],
		'sanitize_callback' => 'clean_box_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'clean_box_theme_options[promotion_headline_target_2]', array(
		'label'    	=> __( 'Check to Open Button 2 Link in New Window/Tab', 'clean-box' ),
		'priority'	=> '8',
		'section'  	=> 'clean_box_promotion_headline_options',
		'settings' 	=> 'clean_box_theme_options[promotion_headline_target_2]',
		'type'     	=> 'checkbox',
	) );
	// Promotion Headline Options End

	// Scrollup
	$wp_customize->add_section( 'clean_box_scrollup', array(
		'panel'    => 'clean_box_theme_options',
		'priority' => 215,
		'title'    => __( 'Scrollup Options', 'clean-box' ),
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[disable_scrollup]', array(
		'capability'		=> 'edit_theme_options',
        'default'			=> $defaults['disable_scrollup'],
		'sanitize_callback' => 'clean_box_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'clean_box_theme_options[disable_scrollup]', array(
		'label'		=> __( 'Check to disable Scroll Up', 'clean-box' ),
		'section'   => 'clean_box_scrollup',
        'settings'  => 'clean_box_theme_options[disable_scrollup]',
		'type'		=> 'checkbox',
	) );
	// Scrollup End

	// Search Options
	$wp_customize->add_section( 'clean_box_search_options', array(
		'description'=> __( 'Change default placeholder text in Search.', 'clean-box'),
		'panel'  => 'clean_box_theme_options',
		'priority' => 216,
		'title'    => __( 'Search Options', 'clean-box' ),
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[search_text]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['search_text'],
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'clean_box_theme_options[search_text]', array(
		'label'		=> __( 'Default Display Text in Search', 'clean-box' ),
		'section'   => 'clean_box_search_options',
        'settings'  => 'clean_box_theme_options[search_text]',
		'type'		=> 'text',
	) );
	// Search Options End
//Theme Option End