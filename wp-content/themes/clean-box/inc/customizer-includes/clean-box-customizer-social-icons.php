<?php
/**
 * The template for Social Links in Customizer
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

	// Social Icons
	$wp_customize->add_section( 'clean_box_social_links', array(
		'priority'	=> 600,
		'title'		=> __( 'Social Links', 'clean-box' ),
	) );

	$clean_box_social_icons 	=	clean_box_get_social_icons_list();

	foreach ( $clean_box_social_icons as $key => $value ){
		if( 'skype_link' == $key ){
			$wp_customize->add_setting( 'clean_box_theme_options['. $key .']', array(
					'capability'		=> 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				) );

			$wp_customize->add_control( 'clean_box_theme_options['. $key .']', array(
				'description'	=> __( 'Skype link can be of formats:<br>callto://+{number}<br> skype:{username}?{action}. More Information in readme file', 'clean-box' ),
				'label'    		=> $value['label'],
				'section'  		=> 'clean_box_social_links',
				'settings' 		=> 'clean_box_theme_options['. $key .']',
				'type'	   		=> 'url',
			) );
		}
		else {
			if( 'email_link' == $key ){
				$wp_customize->add_setting( 'clean_box_theme_options['. $key .']', array(
						'capability'		=> 'edit_theme_options',
						'sanitize_callback' => 'sanitize_email',
					) );
			}
			else if( 'handset_link' == $key || 'phone_link' == $key ){
				$wp_customize->add_setting( 'clean_box_theme_options['. $key .']', array(
						'capability'		=> 'edit_theme_options',
						'sanitize_callback' => 'sanitize_text_field',
					) );
			}
			else {
				$wp_customize->add_setting( 'clean_box_theme_options['. $key .']', array(
						'capability'		=> 'edit_theme_options',
						'sanitize_callback' => 'esc_url_raw',
					) );
			}

			$wp_customize->add_control( 'clean_box_theme_options['. $key .']', array(
				'label'    => $value['label'],
				'section'  => 'clean_box_social_links',
				'settings' => 'clean_box_theme_options['. $key .']',
				'type'	   => 'url',
			) );
		}
	}
	// Social Icons End