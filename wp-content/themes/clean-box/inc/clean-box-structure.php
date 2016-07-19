<?php
/**
 * The template for Managing Theme Structure
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


if ( ! function_exists( 'clean_box_doctype' ) ) :
	/**
	 * Doctype Declaration
	 *
	 * @since Clean Box 0.1 
	 *
	 */
	function clean_box_doctype() {
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<?php
	}
endif;
add_action( 'clean_box_doctype', 'clean_box_doctype', 10 );


if ( ! function_exists( 'clean_box_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Clean Box 0.1 
	 *
	 */
	function clean_box_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<!--[if lt IE 9]>
			<script src="<?php echo get_template_directory_uri(); ?>/js/html5.min.js"></script>
		<![endif]-->
		<?php
	}
endif;
add_action( 'clean_box_before_wp_head', 'clean_box_head', 10 );


if ( ! function_exists( 'clean_box_doctype_start' ) ) :
	/**
	 * Start div id #page
	 *
	 * @since Clean Box 0.1 
	 *
	 */
	function clean_box_page_start() {
		?>
		<div id="page" class="hfeed site">
		<?php
	}
endif;
add_action( 'clean_box_header', 'clean_box_page_start', 10 );


if ( ! function_exists( 'clean_box_page_end' ) ) :
	/**
	 * End div id #page
	 *
	 * @since Clean Box 0.1 
	 *
	 */
	function clean_box_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'clean_box_footer', 'clean_box_page_end', 200 );


if ( ! function_exists( 'clean_box_header_start' ) ) :
	/**
	 * Start Header id #masthead and class .wrapper
	 *
	 * @since Clean Box 0.1 
	 *
	 */
	function clean_box_header_start() {
		?>
		<header id="masthead" role="banner">
    		<div class="wrapper">
		<?php
	}
endif;
add_action( 'clean_box_header', 'clean_box_header_start', 50 );


if ( ! function_exists( 'clean_box_header_end' ) ) :
	/**
	 * End Header id #masthead and class .wrapper
	 *
	 * @since Clean Box 0.1 
	 *
	 */
	function clean_box_header_end() {
		?>
			</div><!-- .wrapper -->
		</header><!-- #masthead -->
		<?php
	}
endif;
add_action( 'clean_box_header', 'clean_box_header_end', 100 );


if ( ! function_exists( 'clean_box_content_start' ) ) :
	/**
	 * Start div id #content and class .wrapper
	 *
	 * @since Clean Box 0.1 
	 *
	 */
	function clean_box_content_start() {
		?>
		<div id="content" class="site-content">
			<div class="wrapper">
	<?php
	}
endif;
add_action('clean_box_content', 'clean_box_content_start', 10 );

if ( ! function_exists( 'clean_box_content_end' ) ) :
	/**
	 * End div id #content and class .wrapper
	 *
	 * @since Clean Box 0.1 
	 */
	function clean_box_content_end() {
		?>
			</div><!-- .wrapper -->
	    </div><!-- #content -->
		<?php
	}

endif;
add_action( 'clean_box_after_content', 'clean_box_content_end', 30 );


if ( ! function_exists( 'clean_box_sidebar_secondary' ) ) :
	/**
	 * Secondary Sidebar
	 * 
	 * @since Clean Box 0.1 
	 */
	function clean_box_sidebar_secondary() {
		get_sidebar( 'secondary' );
	}
endif;


if ( ! function_exists( 'clean_box_footer_content_start' ) ) :
/**
 * Start footer id #colophon
 *
 * @since Clean Box 0.1 
 */
function clean_box_footer_content_start() {
	?>
	<footer id="colophon" class="site-footer" role="contentinfo">
    <?php
}
endif;
add_action('clean_box_footer', 'clean_box_footer_content_start', 10 );


if ( ! function_exists( 'clean_box_footer_sidebar' ) ) :
/**
 * Footer Sidebar
 *
 * @since Clean Box 0.1 
 */
function clean_box_footer_sidebar() {
	get_sidebar( 'footer' );
}
endif;
add_action( 'clean_box_footer', 'clean_box_footer_sidebar', 20 );


if ( ! function_exists( 'clean_box_footer_content_end' ) ) :
/**
 * End footer id #colophon
 *
 * @since Clean Box 0.1 
 */
function clean_box_footer_content_end() {
	?>
	</footer><!-- #colophon -->
	<?php
}
endif;
add_action( 'clean_box_footer', 'clean_box_footer_content_end', 110 );