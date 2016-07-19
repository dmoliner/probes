 <?php
/**
 * The default template for displaying header
 *
 * @package Catch Themes
 * @subpackage Clean Box
 * @since Clean Box 0.1 
 */

	/** 
	 * clean_box_doctype hook
	 *
	 * @hooked clean_box_doctype -  10
	 *
	 */
	do_action( 'clean_box_doctype' );?>

<head>
<?php	
	/** 
	 * clean_box_before_wp_head hook
	 *
	 * @hooked clean_box_head -  10
	 * 
	 */
	do_action( 'clean_box_before_wp_head' );

	wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php 
	/** 
     * clean_box_before_header hook
     *
     */
    do_action( 'clean_box_before' );
	
	/** 
	 * clean_box_site_branding hook
	 *
	 * @hooked clean_box_page_start - 10
	 * @hooked clean_box_primary_menu - 20
	 * @hooked clean_box_featured_slider - 30
	 * @hooked clean_box_featured_overall_image (before-header) - 40
	 * @hooked clean_box_header_start- 50
	 * @hooked clean_box_mobile_header_nav_anchor - 60
	 * @hooked clean_box_site_branding - 70
	 * @hooked clean_box_header_end - 100
	 * 
	 */
	do_action( 'clean_box_header' );

	/** 
     * clean_box_after_header hook
     * 
     * @hooked clean_box_featured_overall_image (before-menu) - 10
     * @hooked clean_box_secondary_menu - 30
     * @hooked clean_box_featured_overall_image (after-menu) - 40
     * @hooked clean_box_add_breadcrumb - 50
     */
	do_action( 'clean_box_after_header' ); 

	/** 
	 * clean_box_before_content hook
	 *
	 * @hooked clean_box_grid_content - 10
	 * @hooked clean_box_featured_overall_image (after-grid-content)  - 20
	 * @hooked clean_box_promotion_headline - 30
	 * @hooked clean_box_featured_content_display (move featured content above homepage posts - default option) - 40
	 */
	do_action( 'clean_box_before_content' );
	
	/** 
     * clean_box_main hook
     *
     *  @hooked clean_box_content_start - 10
     *  @hooked clean_box_add_breadcrumb - 20
     *  @hooked clean_box_content_sidebar_wrap_start - 40
     *
     */
	do_action( 'clean_box_content' );
		