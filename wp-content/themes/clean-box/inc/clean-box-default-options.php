<?php
/**
 * Implement Default Theme/Customizer Options
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
 * Returns the default options for clean-box.
 *
 * @since Clean Box 0.1
 */
function clean_box_get_default_theme_options() {

	$theme_data = wp_get_theme();

	$default_theme_options = array(
		//Site Title an Tagline
		'logo'												=> get_template_directory_uri() . '/images/headers/logo.png',
		'logo_alt_text' 									=> '',
		'logo_disable'										=> 1,
		'move_title_tagline'								=> 0,

		//Layout
		'theme_layout' 										=> 'right-sidebar',
		'content_layout'									=> 'excerpt-image-top',
		'single_post_image_layout'							=> 'featured',

		//Header Image
		'enable_featured_header_image'						=> 'disabled',
		'featured_image_size'								=> 'featured-header',
		'featured_header_image_url'							=> '',
		'featured_header_image_alt'							=> '',
		'featured_header_image_base'						=> 0,

		//Breadcrumb Options
		'breadcumb_option'									=> 0,
		'breadcumb_onhomepage'								=> 0,
		'breadcumb_seperator'								=> '&raquo;',

		//Custom CSS
		'custom_css'										=> '',

		//Scrollup Options
		'disable_scrollup'									=> 0,

		//Excerpt Options
		'excerpt_length'									=> '35',
		'excerpt_more_text'									=> __( 'Read More ...', 'clean-box' ),

		//Homepage / Frontpage Settings
		'front_page_category'								=> array(),

		//Pagination Options
		'pagination_type'									=> 'default',

		//Promotion Headline Options
		'promotion_headline_option'							=> 'disabled',
		'promotion_headline'								=> __( 'Clean Box Pro is a Premium Responsive WordPress Theme', 'clean-box' ),
		'promotion_subheadline'								=> __( 'This is promotion headline. You can edit this from Appearance -> Customize -> Theme Options -> Promotion Headline Options', 'clean-box' ),
		'promotion_headline_button_1'						=> __( 'Buy Now', 'clean-box' ),
		'promotion_headline_url_1'							=> esc_url( 'http://catchthemes.com/' ),
		'promotion_headline_target_1'						=> 1,
		'promotion_headline_button_2'						=> __( 'View More', 'clean-box' ),
		'promotion_headline_url_2'							=> esc_url( 'http://catchthemes.com/' ),
		'promotion_headline_target_2'						=> 1,

		//Search Options
		'search_text'										=> __( 'Search...', 'clean-box' ),

		//Footer Editor Options
		'footer_left_content'								=> sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved.', '1: Year, 2: Site Title with home URL', 'clean-box' ), '[the-year]', '[site-link]' ),
		'footer_right_content'								=> '<a target="_blank" href="'. esc_url( $theme_data->get( 'ThemeURI' ) ) .'">Theme: '. esc_attr( $theme_data->get( 'Name' ) ) .'</a>',

		//Basic Color Options
		'color_scheme' 										=> 'light',
		'background_color'									=> '#f2f2f2',
		'header_textcolor'									=> '#404040',

		//Featured Content Options
		'featured_content_option'							=> 'homepage',
		'featured_content_layout'							=> 'layout-three',
		'featured_content_position'							=> 0,
		'featured_content_headline'							=> '',
		'featured_content_subheadline'						=> '',
		'featured_content_type'								=> 'demo-featured-content',
		'featured_content_number'							=> '3',
		'featured_content_show'								=> 'excerpt',

		//Featured Grid Content Options
		'featured_grid_content_option'						=> 'disabled',
		'featured_grid_content_type'						=> 'demo-featured-grid-content',
		'featured_grid_content_number'						=> '3',

		//Featured Slider Options
		'featured_slider_option'							=> 'disabled',
		'featured_slider_image_loader'						=> 'true',
		'featured_slider_transition_effect'					=> 'fadeout',
		'featured_slider_transition_delay'					=> '4',
		'featured_slider_transition_length'					=> '1',
		'featured_slider_type'								=> 'demo-featured-slider',
		'featured_slider_number'							=> '4',

		//Reset all settings
		'reset_all_settings'								=> 0,
	);

	return apply_filters( 'clean_box_default_theme_options', $default_theme_options );
}


/**
 * Returns an array of color schemes registered for clean-box.
 *
 * @since Clean Box 0.1
 */
function clean_box_color_schemes() {
	$color_scheme_options = array(
		'light' => array(
			'value' 				=> 'light',
			'label' 				=> __( 'Light', 'clean-box' ),
		),
		'dark' => array(
			'value' 				=> 'dark',
			'label' 				=> __( 'Dark', 'clean-box' ),
		),
	);

	return apply_filters( 'clean_box_color_schemes', $color_scheme_options );
}


/**
 * Returns an array of layout options registered for clean-box.
 *
 * @since Clean Box 0.1
 */
function clean_box_layouts() {
	$layout_options = array(
		'left-sidebar' 	=> array(
			'value' => 'left-sidebar',
			'label' => __( 'Primary Sidebar, Content', 'clean-box' ),
		),
		'right-sidebar' => array(
			'value' => 'right-sidebar',
			'label' => __( 'Content, Primary Sidebar', 'clean-box' ),
		),
		'no-sidebar'	=> array(
			'value' => 'no-sidebar',
			'label' => __( 'No Sidebar ( Content Width )', 'clean-box' ),
		),
	);
	return apply_filters( 'clean_box_layouts', $layout_options );
}


/**
 * Returns an array of content layout options registered for clean-box.
 *
 * @since Clean Box 0.1
 */
function clean_box_get_archive_content_layout() {
	$layout_options = array(
		'excerpt-image-top' => array(
			'value' => 'excerpt-image-top',
			'label' => __( 'Show Excerpt (Image Top)', 'clean-box' ),
		),
		'full-content' => array(
			'value' => 'full-content',
			'label' => __( 'Show Full Content (No Featured Image)', 'clean-box' ),
		),
	);

	return apply_filters( 'clean_box_get_archive_content_layout', $layout_options );
}


/**
 * Returns an array of feature header enable options
 *
 * @since Clean Box 0.1
 */
function clean_box_enable_featured_header_image_options() {
	$enable_featured_header_image_options = array(
		'homepage' 		=> array(
			'value'	=> 'homepage',
			'label' => __( 'Homepage / Frontpage', 'clean-box' ),
		),
		'exclude-home'	=> array(
			'value'	=> 'exclude-home',
			'label' => __( 'Excluding Homepage', 'clean-box' ),
		),
		'exclude-home-page-post' 	=> array(
			'value' => 'exclude-home-page-post',
			'label' => __( 'Excluding Homepage, Page/Post Featured Image', 'clean-box' ),
		),
		'entire-site' 	=> array(
			'value' => 'entire-site',
			'label' => __( 'Entire Site', 'clean-box' ),
		),
		'entire-site-page-post' 	=> array(
			'value' => 'entire-site-page-post',
			'label' => __( 'Entire Site, Page/Post Featured Image', 'clean-box' ),
		),
		'pages-posts' 	=> array(
			'value' => 'pages-posts',
			'label' => __( 'Pages and Posts', 'clean-box' ),
		),
		'disabled'		=> array(
			'value' => 'disabled',
			'label' => __( 'Disabled', 'clean-box' ),
		),
	);

	return apply_filters( 'clean_box_enable_featured_header_image_options', $enable_featured_header_image_options );
}


/**
 * Returns an array of feature image size
 *
 * @since Clean Box 0.1
 */
function clean_box_featured_image_size_options() {
	$featured_image_size_options = array(
		'featured-header' => array(
			'value' => 'featured-header',
			'label' => __( 'Featured Header Size', 'clean-box' ),
		),
		'featured' => array(
			'value' => 'featured',
			'label' => __( 'Featured Size', 'clean-box' ),
		),
		'full-size' => array(
			'value' => 'full-size',
			'label' => __( 'Full Size', 'clean-box' ),
		),
	);

	return apply_filters( 'clean_box_featured_image_size_options', $featured_image_size_options );
}


/**
 * Returns an array of content and grid content layout options registered for clean-box.
 *
 * @since Clean Box 0.1
 */
function clean_box_featured_grid_content_options() {
	$featured_grid_content_content_options = array(
		'homepage' 		=> array(
			'value'	=> 'homepage',
			'label' => __( 'Homepage / Frontpage', 'clean-box' ),
		),
		'entire-site' 	=> array(
			'value' => 'entire-site',
			'label' => __( 'Entire Site', 'clean-box' ),
		),
		'disabled'		=> array(
			'value' => 'disabled',
			'label' => __( 'Disabled', 'clean-box' ),
		),
	);

	return apply_filters( 'clean_box_featured_grid_content_options', $featured_grid_content_content_options );
}


/**
 * Returns an array of feature content types registered for clean-box.
 *
 * @since Clean Box 0.1
 */
function clean_box_featured_content_types() {
	$featured_content_types = array(
		'demo-featured-content' => array(
			'value' => 'demo-featured-content',
			'label' => __( 'Demo Featured Content', 'clean-box' ),
		),
		'featured-page-content' => array(
			'value' => 'featured-page-content',
			'label' => __( 'Featured Page Content', 'clean-box' ),
		),
	);

	return apply_filters( 'clean_box_featured_content_types', $featured_content_types );
}


/**
 * Returns an array of featured content options registered for clean-box.
 *
 * @since Clean Box 0.1
 */
function clean_box_featured_content_layout_options() {
	$featured_content_layout_option = array(
		'layout-three' 		=> array(
			'value'	=> 'layout-three',
			'label' => __( '3 columns', 'clean-box' ),
		),
		'layout-four' 	=> array(
			'value' => 'layout-four',
			'label' => __( '4 columns', 'clean-box' ),
		),
	);

	return apply_filters( 'clean_box_featured_content_layout_options', $featured_content_layout_option );
}

/**
 * Returns an array of featured content show registered for clean-box.
 *
 * @since Clean Box 1.1
 */
function clean_box_featured_content_show() {
	$featured_content_show_option = array(
		'excerpt' 		=> array(
			'value'	=> 'excerpt',
			'label' => __( 'Show Excerpt', 'clean-box' ),
		),
		'full-content' 	=> array(
			'value' => 'full-content',
			'label' => __( 'Show Full Content', 'clean-box' ),
		),
		'hide-content' 	=> array(
			'value' => 'hide-content',
			'label' => __( 'Hide Content', 'clean-box' ),
		),
	);

	return apply_filters( 'clean_box_featured_content_show', $featured_content_show_option );
}


/**
 * Returns an array of feature grid content types registered for clean-box.
 *
 * @since Clean Box 0.1
 */
function clean_box_featured_grid_content_types() {
	$featured_grid_content_types = array(
		'demo-featured-grid-content' => array(
			'value' => 'demo-featured-grid-content',
			'label' => __( 'Demo Featured Grid Content', 'clean-box' ),
		),
		'featured-page-grid-content' => array(
			'value' => 'featured-page-grid-content',
			'label' => __( 'Featured Page Grid Content', 'clean-box' ),
		),
	);

	return apply_filters( 'clean_box_featured_grid_content_types', $featured_grid_content_types );
}

/**
 * Returns an array of feature slider types registered for fullframe.
 *
 * @since Clean Box 0.1
 */
function clean_box_featured_slider_types() {
	$options = array(
		'demo-featured-slider' => array(
			'value' => 'demo-featured-slider',
			'label' => __( 'Demo Featured Slider', 'clean-box' ),
		),
		'featured-page-slider' => array(
			'value' => 'featured-page-slider',
			'label' => __( 'Featured Page Slider', 'clean-box' ),
		),
	);

	return apply_filters( 'clean_box_featured_slider_types', $options );
}


/**
 * Returns an array of feature slider transition effects
 *
 * @since Clean Box 0.1
 */
function catch_box_featured_slider_transition_effects() {
	$options = array(
		'fade' 		=> array(
			'value'	=> 'fade',
			'label' => __( 'Fade', 'clean-box' ),
		),
		'fadeout' 	=> array(
			'value'	=> 'fadeout',
			'label' => __( 'Fade Out', 'clean-box' ),
		),
		'none' 		=> array(
			'value' => 'none',
			'label' => __( 'None', 'clean-box' ),
		),
		'scrollHorz'=> array(
			'value' => 'scrollHorz',
			'label' => __( 'Scroll Horizontal', 'clean-box' ),
		),
		'scrollVert'=> array(
			'value' => 'scrollVert',
			'label' => __( 'Scroll Vertical', 'clean-box' ),
		),
		'flipHorz'	=> array(
			'value' => 'flipHorz',
			'label' => __( 'Flip Horizontal', 'clean-box' ),
		),
		'flipVert'	=> array(
			'value' => 'flipVert',
			'label' => __( 'Flip Vertical', 'clean-box' ),
		),
		'tileSlide'	=> array(
			'value' => 'tileSlide',
			'label' => __( 'Tile Slide', 'clean-box' ),
		),
		'tileBlind'	=> array(
			'value' => 'tileBlind',
			'label' => __( 'Tile Blind', 'clean-box' ),
		),
		'shuffle'	=> array(
			'value' => 'shuffle',
			'label' => __( 'Suffle', 'clean-box' ),
		)
	);

	return apply_filters( 'catch_box_featured_slider_transition_effects', $options );
}


/**
 * Returns an array of featured slider image loader options
 *
 * @since Clean Box 0.1
 */
function clean_box_featured_slider_image_loader() {
	$options = array(
		'true' => array(
			'value' 				=> 'true',
			'label' 				=> __( 'True', 'clean-box' ),
		),
		'wait' => array(
			'value' 				=> 'wait',
			'label' 				=> __( 'Wait', 'clean-box' ),
		),
		'false' => array(
			'value' 				=> 'false',
			'label' 				=> __( 'False', 'clean-box' ),
		),
	);

	return apply_filters( 'clean_box_featured_slider_image_loader', $options );
}


/**
 * Returns an array of color schemes registered for clean-box.
 *
 * @since Clean Box 0.1
 */
function clean_box_get_pagination_types() {
	$pagination_types = array(
		'default' => array(
			'value' => 'default',
			'label' => __( 'Default(Older Posts/Newer Posts)', 'clean-box' ),
		),
		'numeric' => array(
			'value' => 'numeric',
			'label' => __( 'Numeric', 'clean-box' ),
		),
		'infinite-scroll-click' => array(
			'value' => 'infinite-scroll-click',
			'label' => __( 'Infinite Scroll (Click)', 'clean-box' ),
		),
		'infinite-scroll-scroll' => array(
			'value' => 'infinite-scroll-scroll',
			'label' => __( 'Infinite Scroll (Scroll)', 'clean-box' ),
		),
	);

	return apply_filters( 'clean_box_get_pagination_types', $pagination_types );
}


/**
 * Returns an array of content featured image size.
 *
 * @since Clean Box 0.1
 */
function clean_box_single_post_image_layout_options() {
	$single_post_image_layout_options = array(
		'featured' => array(
			'value' => 'featured',
			'label' => __( 'Featured', 'clean-box' ),
		),
		'full-size' => array(
			'value' => 'full-size',
			'label' => __( 'Full Size', 'clean-box' ),
		),
		'disabled' => array(
			'value' => 'disabled',
			'label' => __( 'Disabled', 'clean-box' ),
		),
	);
	return apply_filters( 'clean_box_single_post_image_layout_options', $single_post_image_layout_options );
}


/**
 * Returns an array of avaliable fonts registered for clean-box.
 *
 * @since Clean Box 0.1
 */
function clean_box_avaliable_fonts() {
	$avaliable_fonts = array(
		'arial-black' => array(
			'value' => 'arial-black',
			'label' => '"Arial Black", Gadget, sans-serif',
		),
		'allan' => array(
			'value' => 'allan',
			'label' => '"Allan", sans-serif',
		),
		'allerta' => array(
			'value' => 'allerta',
			'label' => '"Allerta", sans-serif',
		),
		'amaranth' => array(
			'value' => 'amaranth',
			'label' => '"Amaranth", sans-serif',
		),
		'arial' => array(
			'value' => 'arial',
			'label' => 'Arial, Helvetica, sans-serif',
		),
		'bitter' => array(
			'value' => 'bitter',
			'label' => '"Bitter", sans-serif',
		),
		'cabin' => array(
			'value' => 'cabin',
			'label' => '"Cabin", sans-serif',
		),
		'cantarell' => array(
			'value' => 'cantarell',
			'label' => '"Cantarell", sans-serif',
		),
		'century-gothic' => array(
			'value' => 'century-gothic',
			'label' => '"Century Gothic", sans-serif',
		),
		'courier-new' => array(
			'value' => 'courier-new',
			'label' => '"Courier New", Courier, monospace',
		),
		'crimson-text' => array(
			'value' => 'crimson-text',
			'label' => '"Crimson Text", sans-serif',
		),
		'cuprum' => array(
			'value' => 'cuprum',
			'label' => '"Cuprum", sans-serif',
		),
		'dancing-script' => array(
			'value' => 'dancing-script',
			'label' => '"Dancing Script", sans-serif',
		),
		'droid-sans' => array(
			'value' => 'droid-sans',
			'label' => '"Droid Sans", sans-serif',
		),
		'droid-serif' => array(
			'value' => 'droid-serif',
			'label' => '"Droid Serif", sans-serif',
		),
		'exo' => array(
			'value' => 'exo',
			'label' => '"Exo", sans-serif',
		),
		'exo-2' => array(
			'value' => 'exo-2',
			'label' => '"Exo 2", sans-serif',
		),
		'georgia' => array(
			'value' => 'georgia',
			'label' => 'Georgia, "Times New Roman", Times, serif',
		),
		'helvetica' => array(
			'value' => 'helvetica',
			'label' => 'Helvetica, "Helvetica Neue", Arial, sans-serif',
		),
		'helvetica-neue' => array(
			'value' => 'helvetica-neue',
			'label' => '"Helvetica Neue",Helvetica,Arial,sans-serif',
		),
		'istok-web' => array(
			'value' => 'istok-web',
			'label' => '"Istok Web", sans-serif',
		),
		'impact' => array(
			'value' => 'impact',
			'label' => 'Impact, Charcoal, sans-serif',
		),
		'josefin-sans' => array(
			'value' => 'josefin-sans',
			'label' => '"Josefin Sans", sans-serif',
		),
		'lato' => array(
			'value' => 'lato',
			'label' => '"Lato", sans-serif',
		),
		'libre-baskerville' => array(
			'value' => 'libre-baskerville',
			'label' => '"Libre Baskerville",serif'
		),
		'lucida-sans-unicode' => array(
			'value' => 'lucida-sans-unicode',
			'label' => '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
		),
		'lucida-grande' => array(
			'value' => 'lucida-grande',
			'label' => '"Lucida Grande", "Lucida Sans Unicode", sans-serif',
		),
		'lobster' => array(
			'value' => 'lobster',
			'label' => '"Lobster", sans-serif',
		),
		'lora' => array(
			'value' => 'lora',
			'label' => '"Lora", serif',
		),
		'monaco' => array(
			'value' => 'monaco',
			'label' => 'Monaco, Consolas, "Lucida Console", monospace, sans-serif',
		),
		'montserrat' => array(
			'value' => 'montserrat',
			'label' => '"Montserrat", sans-serif',
		),
		'nobile' => array(
			'value' => 'nobile',
			'label' => '"Nobile", sans-serif',
		),
		'noto-serif' => array(
			'value' => 'noto-serif',
			'label' => '"Noto Serif", serif',
		),
		'neuton' => array(
			'value' => 'neuton',
			'label' => '"Neuton", serif',
		),
		'open-sans' => array(
			'value' => 'open-sans',
			'label' => '"Open Sans", sans-serif',
		),
		'oswald' => array(
			'value' => 'oswald',
			'label' => '"Oswald", sans-serif',
		),
		'palatino' => array(
			'value' => 'palatino',
			'label' => 'Palatino, "Palatino Linotype", "Book Antiqua", serif',
		),
		'patua-one' => array(
			'value' => 'patua-one',
			'label' => '"Patua One", sans-serif',
		),
		'playfair-display' => array(
			'value' => 'playfair-display',
			'label' => '"Playfair Display", sans-serif',
		),
		'pt-sans' => array(
			'value' => 'pt-sans',
			'label' => '"PT Sans", sans-serif',
		),
		'pt-serif' => array(
			'value' => 'pt-serif',
			'label' => '"PT Serif", serif',
		),
		'quattrocento-sans' => array(
			'value' => 'quattrocento-sans',
			'label' => '"Quattrocento Sans", sans-serif',
		),
		'roboto' => array(
			'value' => 'roboto',
			'label' => '"Roboto", sans-serif',
		),
		'roboto-slab' => array(
			'value' => 'roboto-slab',
			'label' => '"Roboto Slab", serif',
		),
		'sans-serif' => array(
			'value' => 'sans-serif',
			'label' => 'Sans Serif, Arial',
		),
		'source-sans-pro' => array(
			'value' => 'source-sans-pro',
			'label' => '"Source Sans Pro", sans-serif',
		),
		'tahoma' => array(
			'value' => 'tahoma',
			'label' => 'Tahoma, Geneva, sans-serif',
		),
		'trebuchet-ms' => array(
			'value' => 'trebuchet-ms',
			'label' => '"Trebuchet MS", "Helvetica", sans-serif',
		),
		'times-new-roman' => array(
			'value' => 'times-new-roman',
			'label' => '"Times New Roman", Times, serif',
		),
		'ubuntu' => array(
			'value' => 'ubuntu',
			'label' => '"Ubuntu", sans-serif',
		),
		'varela' => array(
			'value' => 'varela',
			'label' => '"Varela", sans-serif',
		),
		'verdana' => array(
			'value' => 'verdana',
			'label' => 'Verdana, Geneva, sans-serif',
		),
		'yanone-kaffeesatz' => array(
			'value' => 'yanone-kaffeesatz',
			'label' => '"Yanone Kaffeesatz", sans-serif',
		),
	);

	return apply_filters( 'clean_box_avaliable_fonts', $avaliable_fonts );
}


/**
 * Returns list of social icons currently supported
 *
 * @since Clean Box 0.1
*/
function clean_box_get_social_icons_list() {
	$clean_box_social_icons_list = array(
		'facebook_link'		=> array(
			'genericon_class' 	=> 'facebook-alt',
			'label' 			=> esc_html__( 'Facebook', 'clean-box' )
			),
		'twitter_link'		=> array(
			'genericon_class' 	=> 'twitter',
			'label' 			=> esc_html__( 'Twitter', 'clean-box' )
			),
		'googleplus_link'	=> array(
			'genericon_class' 	=> 'googleplus-alt',
			'label' 			=> esc_html__( 'Googleplus', 'clean-box' )
			),
		'email_link'		=> array(
			'genericon_class' 	=> 'mail',
			'label' 			=> esc_html__( 'Email', 'clean-box' )
			),
		'feed_link'			=> array(
			'genericon_class' 	=> 'feed',
			'label' 			=> esc_html__( 'Feed', 'clean-box' )
			),
		'wordpress_link'	=> array(
			'genericon_class' 	=> 'wordpress',
			'label' 			=> esc_html__( 'WordPress', 'clean-box' )
			),
		'github_link'		=> array(
			'genericon_class' 	=> 'github',
			'label' 			=> esc_html__( 'GitHub', 'clean-box' )
			),
		'linkedin_link'		=> array(
			'genericon_class' 	=> 'linkedin',
			'label' 			=> esc_html__( 'LinkedIn', 'clean-box' )
			),
		'pinterest_link'	=> array(
			'genericon_class' 	=> 'pinterest',
			'label' 			=> esc_html__( 'Pinterest', 'clean-box' )
			),
		'flickr_link'		=> array(
			'genericon_class' 	=> 'flickr',
			'label' 			=> esc_html__( 'Flickr', 'clean-box' )
			),
		'vimeo_link'		=> array(
			'genericon_class' 	=> 'vimeo',
			'label' 			=> esc_html__( 'Vimeo', 'clean-box' )
			),
		'youtube_link'		=> array(
			'genericon_class' 	=> 'youtube',
			'label' 			=> esc_html__( 'YouTube', 'clean-box' )
			),
		'tumblr_link'		=> array(
			'genericon_class' 	=> 'tumblr',
			'label' 			=> esc_html__( 'Tumblr', 'clean-box' )
			),
		'instagram_link'	=> array(
			'genericon_class' 	=> 'instagram',
			'label' 			=> esc_html__( 'Instagram', 'clean-box' )
			),
		'polldaddy_link'	=> array(
			'genericon_class' 	=> 'polldaddy',
			'label' 			=> esc_html__( 'PollDaddy', 'clean-box' )
			),
		'codepen_link'		=> array(
			'genericon_class' 	=> 'codepen',
			'label' 			=> esc_html__( 'CodePen', 'clean-box' )
			),
		'path_link'			=> array(
			'genericon_class' 	=> 'path',
			'label' 			=> esc_html__( 'Path', 'clean-box' )
			),
		'dribbble_link'		=> array(
			'genericon_class' 	=> 'dribbble',
			'label' 			=> esc_html__( 'Dribbble', 'clean-box' )
			),
		'skype_link'		=> array(
			'genericon_class' 	=> 'skype',
			'label' 			=> esc_html__( 'Skype', 'clean-box' )
			),
		'digg_link'			=> array(
			'genericon_class' 	=> 'digg',
			'label' 			=> esc_html__( 'Digg', 'clean-box' )
			),
		'reddit_link'		=> array(
			'genericon_class' 	=> 'reddit',
			'label' 			=> esc_html__( 'Reddit', 'clean-box' )
			),
		'stumbleupon_link'	=> array(
			'genericon_class' 	=> 'stumbleupon',
			'label' 			=> esc_html__( 'Stumbleupon', 'clean-box' )
			),
		'pocket_link'		=> array(
			'genericon_class' 	=> 'pocket',
			'label' 			=> esc_html__( 'Pocket', 'clean-box' ),
			),
		'dropbox_link'		=> array(
			'genericon_class' 	=> 'dropbox',
			'label' 			=> esc_html__( 'DropBox', 'clean-box' ),
			),
		'spotify_link'		=> array(
			'genericon_class' 	=> 'spotify',
			'label' 			=> esc_html__( 'Spotify', 'clean-box' ),
			),
		'foursquare_link'	=> array(
			'genericon_class' 	=> 'foursquare',
			'label' 			=> esc_html__( 'Foursquare', 'clean-box' ),
			),
		'twitch_link'		=> array(
			'genericon_class' 	=> 'twitch',
			'label' 			=> esc_html__( 'Twitch', 'clean-box' ),
			),
		'website_link'		=> array(
			'genericon_class' 	=> 'website',
			'label' 			=> esc_html__( 'Website', 'clean-box' ),
			),
		'phone_link'		=> array(
			'genericon_class' 	=> 'phone',
			'label' 			=> esc_html__( 'Phone', 'clean-box' ),
			),
		'handset_link'		=> array(
			'genericon_class' 	=> 'handset',
			'label' 			=> esc_html__( 'Handset', 'clean-box' ),
			),
		'cart_link'			=> array(
			'genericon_class' 	=> 'cart',
			'label' 			=> esc_html__( 'Cart', 'clean-box' ),
			),
		'cloud_link'		=> array(
			'genericon_class' 	=> 'cloud',
			'label' 			=> esc_html__( 'Cloud', 'clean-box' ),
			),
		'link_link'		=> array(
			'genericon_class' 	=> 'link',
			'label' 			=> esc_html__( 'Link', 'clean-box' ),
			),
	);

	return apply_filters( 'clean_box_social_icons_list', $clean_box_social_icons_list );
}

/**
 * Returns an array of metabox layout options registered for clean-box.
 *
 * @since Clean Box 0.1
 */
function clean_box_metabox_layouts() {
	$layout_options = array(
		'default' 	=> array(
			'id' 	=> 'clean-box-layout-option',
			'value' => 'default',
			'label' => __( 'Default', 'clean-box' ),
		),
		'left-sidebar' 	=> array(
			'id' 	=> 'clean-box-layout-option',
			'value' => 'left-sidebar',
			'label' => __( 'Primary Sidebar, Content', 'clean-box' ),
		),
		'right-sidebar' => array(
			'id' 	=> 'clean-box-layout-option',
			'value' => 'right-sidebar',
			'label' => __( 'Content, Primary Sidebar', 'clean-box' ),
		),
		'no-sidebar'	=> array(
			'id' 	=> 'clean-box-layout-option',
			'value' => 'no-sidebar',
			'label' => __( 'No Sidebar ( Content Width )', 'clean-box' ),
		),
	);
	return apply_filters( 'clean_box_layouts', $layout_options );
}

/**
 * Returns an array of metabox header featured image options registered for clean-box.
 *
 * @since Clean Box 0.1
 */
function clean_box_metabox_header_featured_image_options() {
	$header_featured_image_options = array(
		'default' => array(
			'id'		=> 'clean-box-header-image',
			'value' 	=> 'default',
			'label' 	=> __( 'Default', 'clean-box' ),
		),
		'enable' => array(
			'id'		=> 'clean-box-header-image',
			'value' 	=> 'enable',
			'label' 	=> __( 'Enable', 'clean-box' ),
		),
		'disable' => array(
			'id'		=> 'clean-box-header-image',
			'value' 	=> 'disable',
			'label' 	=> __( 'Disable', 'clean-box' )
		)
	);
	return apply_filters( 'header_featured_image_options', $header_featured_image_options );
}


/**
 * Returns an array of metabox featured image options registered for clean-box.
 *
 * @since Clean Box 0.1
 */
function clean_box_metabox_featured_image_options() {
	$featured_image_options = array(
		'default' => array(
			'id'		=> 'clean-box-featured-image',
			'value' 	=> 'default',
			'label' 	=> __( 'Default', 'clean-box' ),
		),
		'featured' => array(
			'id'		=> 'clean-box-featured-image',
			'value' 	=> 'featured',
			'label' 	=> __( 'Featured Image', 'clean-box' )
		),
		'full' => array(
			'id' => 'clean-box-featured-image',
			'value' => 'full',
			'label' => __( 'Full Size', 'clean-box' )
		),
		'disable' => array(
			'id' => 'clean-box-featured-image',
			'value' => 'disable',
			'label' => __( 'Disable Image', 'clean-box' )
		)
	);
	return apply_filters( 'featured_image_options', $featured_image_options );
}

/**
 * Returns clean_box_contents registered for clean_box.
 *
 * @since Clean Box 0.1
 */
function clean_box_get_content() {
	$theme_data = wp_get_theme();

	$clean_box_content['left'] 	= sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved.', '1: Year, 2: Site Title with home URL', 'clean-box' ), date( 'Y' ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );

	$clean_box_content['right']	= esc_attr( $theme_data->get( 'Name') ) . '&nbsp;' . __( 'by', 'clean-box' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_attr( $theme_data->get( 'Author' ) ) .'</a>';

	return apply_filters( 'clean_box_get_content', $clean_box_content );
}


/**
 * Returns the default options for clean-box dark theme.
 *
 * @since Clean Box 0.1
 */
function clean_box_default_dark_color_options() {
	$default_dark_color_options = array(
		//Basic Color Options
		'background_color'									=> '#191919',
		'header_textcolor'									=> '#bebebe',
	);

	return apply_filters( 'clean_box_default_dark_color_options', $default_dark_color_options );
}