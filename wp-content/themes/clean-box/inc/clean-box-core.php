<?php
/**
 * Core functions and definitions
 *
 * Sets up the theme
 *
 * The first function, clean_box_initial_setup(), sets up the theme by registering support
 * for various features in WordPress, such as theme support, post thumbnails, navigation menu, and the like.
 *
 * Clean Box functions and definitions
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


if ( ! function_exists( 'clean_box_content_width' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function clean_box_content_width() {
		$content_width = 780; /* pixels */

		$GLOBALS['content_width'] = apply_filters( 'clean_box_content_width', $content_width );
	}
endif;
add_action( 'after_setup_theme', 'clean_box_content_width', 0 );


if ( ! function_exists( 'clean_box_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 */
	function clean_box_setup() {
		/**
		 * Get Theme Options Values
		 */
		$options 	= clean_box_get_theme_options();
		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on clean-box, use a find and replace
		 * to change 'clean-box' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'clean-box', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails on posts and pages
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		// Add Clean Box custom image sizes uses Ratio 16:9
        add_image_size( 'clean-box-featured', 778, 438, true);

        // 4:3 ratio
        // Used for Featured Grid Content - 1st Image
        add_image_size( 'clean-box-featured-grid', 800, 600, true);

        // Used for Featured Content, Featured Grid Content and Archive/blog Featured Image
        add_image_size( 'clean-box-featured-content', 400, 300, true);

        // Featured Header Image
        add_image_size( 'clean-box-featured-header', 1200, 514, true);

        // Used for Featured Slider Ratio 21:9
        add_image_size( 'clean-box-slider', 1680, 720, true);

		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array(
			'primary'		=> __( 'Primary Menu', 'clean-box' ),
			'secondary'		=> __( 'Secondary Menu', 'clean-box' ),
		) );

		/**
		 * Enable support for Post Formats
		 */
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

		/**
		 * Setup the WordPress core custom background feature.
		 */
		if ( 'light' == $options['color_scheme'] ) {
			$default_bg_color = clean_box_get_default_theme_options();
			$default_bg_color = $default_bg_color['background_color'];
		}
		else if ( 'dark' == $options['color_scheme'] ) {
			$default_bg_color = clean_box_default_dark_color_options();
			$default_bg_color = $default_bg_color['background_color'];
		}

		add_theme_support( 'custom-background', apply_filters( 'clean_box_custom_background_args', array(
			'default-color' => $default_bg_color
		) ) );

		/**
		 * Setup Editor style
		 */
		add_editor_style( 'css/editor-style.css' );

		/**
		 * Setup title support for theme
		 * Supported from WordPress version 4.1 onwards
		 * More Info: https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
		 */
		add_theme_support( 'title-tag' );

		//@remove Remove check when WordPress 4.8 is released
		if ( function_exists( 'has_custom_logo' ) ) {
			/**
			* Setup Custom Logo Support for theme
			* Supported from WordPress version 4.5 onwards
			* More Info: https://make.wordpress.org/core/2016/03/10/custom-logo/
			*/
			add_theme_support( 'custom-logo' );
		}

		/**
		 * Setup Infinite Scroll using JetPack if navigation type is set
		 */
		$pagination_type	= isset( $options['pagination_type'] ) ? $options['pagination_type'] : '';

		if( 'infinite-scroll-click' == $pagination_type ) {
			add_theme_support( 'infinite-scroll', array(
				'type'		=> 'click',
				'container' => 'main',
				'footer'    => 'page'
			) );
		}
		else if ( 'infinite-scroll-scroll' == $pagination_type ) {
			//Override infinite scroll disable scroll option
        	update_option('infinite_scroll', true);

			add_theme_support( 'infinite-scroll', array(
				'type'		=> 'scroll',
				'container' => 'main',
				'footer'    => 'page'
			) );
		}

		/**
		* Add theme support for Responsive Videos.
		*/
		add_theme_support( 'jetpack-responsive-videos' );
	}
endif; // clean_box_setup
add_action( 'after_setup_theme', 'clean_box_setup' );


/**
 * Enqueue scripts and styles
 *
 * @uses  wp_register_script, wp_enqueue_script, wp_register_style, wp_enqueue_style, wp_localize_script
 * @action wp_enqueue_scripts
 *
 * @since  Clean Box 1.0
 */
function clean_box_scripts() {
	$options			= clean_box_get_theme_options();

	//For genericons
	wp_register_style( 'genericons', get_template_directory_uri() . '/css/genericons/genericons.css', false, '3.4.1' );

	$clean_box_deps = array( 'genericons' );

	wp_enqueue_style( 'clean-box-style', get_stylesheet_uri(), $clean_box_deps, CLEAN_BOX_THEME_VERSION );

	wp_enqueue_script( 'clean-box-navigation', get_template_directory_uri() . '/js/navigation.min.js', array(), '20120206', true );

	wp_enqueue_script( 'clean-box-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), '20130115', true );

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/**
	 * Enqueue the styles for the current color scheme for clean-box.
	 */
	if ( $options['color_scheme'] != 'light' )
		wp_enqueue_style( 'clean-box-dark', get_template_directory_uri() . '/css/colors/'. $options['color_scheme'] .'.css', array(), null );

	/**
	 * Loads up Cycle JS
	 */
	if( 'disabled' != $options['featured_slider_option'] ) {
		wp_register_script( 'jquery.cycle2', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.min.js', array( 'jquery' ), '2.1.5', true );

		/**
		 * Condition checks for additional slider transition plugins
		 */
		// Scroll Vertical transition plugin addition
		if ( 'scrollVert' ==  $options['featured_slider_transition_effect'] ){
			wp_enqueue_script( 'jquery.cycle2.scrollVert', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.scrollVert.min.js', array( 'jquery.cycle2' ), '20140128', true );
		}
		// Flip transition plugin addition
		else if ( 'flipHorz' ==  $options['featured_slider_transition_effect'] || 'flipVert' ==  $options['featured_slider_transition_effect'] ){
			wp_enqueue_script( 'jquery.cycle2.flip', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.flip.min.js', array( 'jquery.cycle2' ), '20140128', true );
		}
		// Suffle transition plugin addition
		else if ( 'tileSlide' ==  $options['featured_slider_transition_effect'] || 'tileBlind' ==  $options['featured_slider_transition_effect'] ){
			wp_enqueue_script( 'jquery.cycle2.tile', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.tile.min.js', array( 'jquery.cycle2' ), '20140128', true );
		}
		// Suffle transition plugin addition
		else if ( 'shuffle' ==  $options['featured_slider_transition_effect'] ){
			wp_enqueue_script( 'jquery.cycle2.shuffle', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.shuffle.min.js', array( 'jquery.cycle2' ), '20140128 ', true );
		}
		else {
			wp_enqueue_script( 'jquery.cycle2' );
		}
	}

	/**
	 * Loads up Responsive Menu
	 */
	wp_register_script('sidr', get_template_directory_uri() . '/js/jquery.sidr.min.js', array('jquery'), '2.2.1.1 - 2016-03-03', false );


	/**
	 * Loads up Scroll Up script
	 */
	if ( ! $options['disable_scrollup'] ) {
		wp_enqueue_script( 'clean-box-scrollup', get_template_directory_uri() . '/js/clean-box-scrollup.min.js', array( 'jquery' ), '20072014', true  );
	}

	/**
	 * Enqueue custom script for clean-box.
	 */
	wp_enqueue_script( 'clean-box-custom-scripts', get_template_directory_uri() . '/js/clean-box-custom-scripts.min.js', array( 'jquery', 'sidr' ), null );
}
add_action( 'wp_enqueue_scripts', 'clean_box_scripts' );


/**
 * Enqueue scripts and styles for Metaboxes
 * @uses wp_register_script, wp_enqueue_script, and  wp_enqueue_style
 *
 * @action admin_print_scripts-post-new, admin_print_scripts-post, admin_print_scripts-page-new, admin_print_scripts-page
 *
 * @since Clean Box 0.1
 */
function clean_box_enqueue_metabox_scripts() {
    //Scripts
	wp_enqueue_script( 'clean-box-metabox', get_template_directory_uri() . '/js/clean-box-metabox.min.js', array( 'jquery', 'jquery-ui-tabs' ), '2013-10-05' );

	//CSS Styles
	wp_enqueue_style( 'clean-box-metabox-tabs', get_template_directory_uri() . '/css/clean-box-metabox-tabs.css' );
}
add_action( 'admin_print_scripts-post-new.php', 'clean_box_enqueue_metabox_scripts', 11 );
add_action( 'admin_print_scripts-post.php', 'clean_box_enqueue_metabox_scripts', 11 );
add_action( 'admin_print_scripts-page-new.php', 'clean_box_enqueue_metabox_scripts', 11 );
add_action( 'admin_print_scripts-page.php', 'clean_box_enqueue_metabox_scripts', 11 );


/**
 * Default Options.
 */
require get_template_directory() . '/inc/clean-box-default-options.php';

/**
 * Custom Header.
 */
require get_template_directory() . '/inc/clean-box-custom-header.php';


/**
 * Structure for clean-box
 */
require get_template_directory() . '/inc/clean-box-structure.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer-includes/clean-box-customizer.php';


/**
 * Custom Menus
 */
require get_template_directory() . '/inc/clean-box-menus.php';


/**
 * Load Featured Content.
 */
require get_template_directory() . '/inc/clean-box-featured-content.php';


/**
 * Load Featured Grid file.
 */
require get_template_directory() . '/inc/clean-box-featured-grid-content.php';


/**
 * Load Featured Content.
 */
require get_template_directory() . '/inc/clean-box-featured-slider.php';


/**
 * Load Breadcrumb file.
 */
require get_template_directory() . '/inc/clean-box-breadcrumb.php';


/**
 * Load Widgets and Sidebars
 */
require get_template_directory() . '/inc/clean-box-widgets.php';


/**
 * Load Social Icons
 */
require get_template_directory() . '/inc/clean-box-social-icons.php';


/**
 * Load Metaboxes
 */
require get_template_directory() . '/inc/clean-box-metabox.php';


/**
 * Returns the options array for clean-box.
 * @uses  get_theme_mod
 *
 * @since Clean Box 0.1
 */
function clean_box_get_theme_options() {
	$clean_box_default_options = clean_box_get_default_theme_options();

	return array_merge( $clean_box_default_options , get_theme_mod( 'clean_box_theme_options', $clean_box_default_options ) ) ;
}


/**
 * Flush out all transients
 *
 * @uses delete_transient
 *
 * @action customize_save, clean_box_customize_preview (see clean_box_customizer function: clean_box_customize_preview)
 *
 * @since  Clean Box 1.0
 */
function clean_box_flush_transients(){
	delete_transient( 'clean_box_featured_content' );

	delete_transient( 'clean_box_featured_grid_content' );

	delete_transient( 'clean_box_featured_slider' );

	delete_transient( 'clean_box_custom_css' );

	delete_transient( 'clean_box_promotion_headline' );

	delete_transient( 'clean_box_featured_image' );

	delete_transient( 'clean_box_social_icons' );

	delete_transient( 'clean_box_scrollup' );

	delete_transient( 'all_the_cool_cats' );

	//Add Clean Box default themes if there is no values
	if ( !get_theme_mod('clean_box_theme_options') ) {
		set_theme_mod( 'clean_box_theme_options', clean_box_get_default_theme_options() );
	}
}
add_action( 'customize_save', 'clean_box_flush_transients' );

/**
 * Flush out category transients
 *
 * @uses delete_transient
 *
 * @action edit_category
 *
 * @since  Clean Box 1.0
 */
function clean_box_flush_category_transients(){
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'clean_box_flush_category_transients' );


/**
 * Flush out post related transients
 *
 * @uses delete_transient
 *
 * @action save_post
 *
 * @since  Clean Box 1.0
 */
function clean_box_flush_post_transients(){
	delete_transient( 'clean_box_featured_content' );

	delete_transient( 'clean_box_featured_grid_content' );

	delete_transient( 'clean_box_featured_slider' );

	delete_transient( 'clean_box_featured_image' );

	delete_transient( 'all_the_cool_cats' );
}
add_action( 'save_post', 'clean_box_flush_post_transients' );


if ( ! function_exists( 'clean_box_custom_css' ) ) :
	/**
	 * Enqueue Custon CSS
	 *
	 * @uses  set_transient, wp_head, wp_enqueue_style
	 *
	 * @action wp_enqueue_scripts
	 *
	 * @since Clean Box 0.1
	 */
	function clean_box_custom_css() {
		//clean_box_flush_transients();
		$options 	= clean_box_get_theme_options();

		$defaults 	= clean_box_get_default_theme_options();

		if ( ( !$clean_box_custom_css = get_transient( 'clean_box_custom_css' ) ) ) {
			$clean_box_custom_css ='';

			// Has the text been hidden?
			if ( ! display_header_text() ) {
				$clean_box_custom_css    .=  ".site-title a, .site-description { position: absolute !important; clip: rect(1px 1px 1px 1px); clip: rect(1px, 1px, 1px, 1px); }". "\n";
			}

			//Custom CSS Option
			if( !empty( $options[ 'custom_css' ] ) ) {
				$clean_box_custom_css	.=  $options[ 'custom_css'] . "\n";
			}

			if ( '' != $clean_box_custom_css ){
				echo '<!-- refreshing cache -->' . "\n";

				$clean_box_custom_css = '<!-- '.get_bloginfo('name').' inline CSS Styles -->' . "\n" . '<style type="text/css" media="screen">' . "\n" . $clean_box_custom_css;

				$clean_box_custom_css .= '</style>' . "\n";

			}

			set_transient( 'clean_box_custom_css', htmlspecialchars_decode( $clean_box_custom_css ), 86940 );
		}

		echo $clean_box_custom_css;
	}
endif; //clean_box_custom_css
add_action( 'wp_head', 'clean_box_custom_css', 101  );


/**
 * Alter the query for the main loop in homepage
 *
 * @action pre_get_posts
 *
 * @since Clean Box 0.1
 */
function clean_box_alter_home( $query ){
	$options 			= clean_box_get_theme_options();

    $cats 				= $options[ 'front_page_category' ];

	if ( is_array( $cats ) && !in_array( '0', $cats ) ) {
		if( $query->is_main_query() && $query->is_home() ) {
			$query->query_vars['category__in'] =  $cats;
		}
	}
}
add_action( 'pre_get_posts','clean_box_alter_home' );


if ( ! function_exists( 'clean_box_content_nav' ) ) :
	/**
	 * Display navigation to next/previous pages when applicable
	 *
	 * @since Clean Box 0.1
	 */
	function clean_box_content_nav( $nav_id ) {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous )
				return;
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$options			= clean_box_get_theme_options();

		$pagination_type	= $options['pagination_type'];

		$nav_class = ( is_single() ) ? 'site-navigation post-navigation' : 'site-navigation paging-navigation';

		/**
		 * Check if navigation type is Jetpack Infinite Scroll and if it is enabled, else goto default pagination
		 * if it's active then disable pagination
		 */
		if ( ( 'infinite-scroll-click' == $pagination_type || 'infinite-scroll-scroll' == $pagination_type ) && class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
			return false;
		}

		?>
	        <nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>">
	        	<h3 class="screen-reader-text"><?php _e( 'Post navigation', 'clean-box' ); ?></h3>
				<?php
				/**
				 * Check if navigation type is numeric and if Wp-PageNavi Plugin is enabled
				 */
				if ( 'numeric' == $pagination_type && function_exists( 'wp_pagenavi' ) ) {
					wp_pagenavi();
	            }
	            else { ?>
	                <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'clean-box' ) ); ?></div>
	                <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'clean-box' ) ); ?></div>
	            <?php
	            } ?>
	        </nav><!-- #nav -->
		<?php
	}
endif; // clean_box_content_nav


if ( ! function_exists( 'clean_box_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Clean Box 0.1
	 */
	function clean_box_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;

		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="comment-body">
				<?php _e( 'Pingback:', 'clean-box' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'clean-box' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		<?php else : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
						<?php printf( __( '%s <span class="says">says:</span>', 'clean-box' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					</div><!-- .comment-author -->

					<div class="comment-metadata">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'clean-box' ), get_comment_date(), get_comment_time() ); ?>
							</time>
						</a>
						<?php edit_comment_link( __( 'Edit', 'clean-box' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .comment-metadata -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'clean-box' ); ?></p>
					<?php endif; ?>
				</footer><!-- .comment-meta -->

				<div class="comment-content">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

				<?php
					comment_reply_link( array_merge( $args, array(
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<div class="reply">',
						'after'     => '</div>',
					) ) );
				?>
			</article><!-- .comment-body -->

		<?php
		endif;
	}
endif; // clean_box_comment()


if ( ! function_exists( 'clean_box_the_attached_image' ) ) :
	/**
	 * Prints the attached image with a link to the next attached image.
	 *
	 * @since Clean Box 0.1
	 */
	function clean_box_the_attached_image() {
		$post                = get_post();
		$attachment_size     = apply_filters( 'clean_box_attachment_size', array( 1200, 1200 ) );
		$next_attachment_url = wp_get_attachment_url();

		/**
		 * Grab the IDs of all the image attachments in a gallery so we can get the
		 * URL of the next adjacent image in a gallery, or the first image (if
		 * we're looking at the last image in a gallery), or, in a gallery of one,
		 * just the link to that image file.
		 */
		$attachment_ids = get_posts( array(
			'post_parent'    => $post->post_parent,
			'fields'         => 'ids',
			'numberposts'    => 1,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID'
		) );

		// If there is more than 1 attachment in a gallery...
		if ( count( $attachment_ids ) > 1 ) {
			foreach ( $attachment_ids as $attachment_id ) {
				if ( $attachment_id == $post->ID ) {
					$next_id = current( $attachment_ids );
					break;
				}
			}

			// get the URL of the next image attachment...
			if ( $next_id )
				$next_attachment_url = get_attachment_link( $next_id );

			// or get the URL of the first image attachment.
			else
				$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}

		printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
			esc_url( $next_attachment_url ),
			the_title_attribute( array( 'echo' => false ) ),
			wp_get_attachment_image( $post->ID, $attachment_size )
		);
	}
endif; //clean_box_the_attached_image


if ( ! function_exists( 'clean_box_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @since Clean Box 0.1
	 */
	function clean_box_entry_meta() {
		echo '<p class="entry-meta">';

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		printf( '<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
			sprintf( _x( '<span class="screen-reader-text">Posted on</span>', 'Used before publish date.', 'clean-box' ) ),
			esc_url( get_permalink() ),
			$time_string
		);

		if ( is_singular() || is_multi_author() ) {
			printf( '<span class="byline"><span class="author vcard">%1$s<a class="url fn n" href="%2$s">%3$s</a></span></span>',
				sprintf( _x( '<span class="screen-reader-text">Author</span>', 'Used before post author name.', 'clean-box' ) ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			);
		}

		if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'clean-box' ), esc_html__( '1 Comment', 'clean-box' ), esc_html__( '% Comments', 'clean-box' ) );
			echo '</span>';
		}

		edit_post_link( esc_html__( 'Edit', 'clean-box' ), '<span class="edit-link">', '</span>' );

		echo '</p><!-- .entry-meta -->';
	}
endif; //clean_box_entry_meta


if ( ! function_exists( 'clean_box_tag_category' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags.
	 *
	 * @since Clean Box 0.1
	 */
	function clean_box_tag_category() {
		echo '<p class="entry-meta">';

		if ( 'post' == get_post_type() ) {
			$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'clean-box' ) );
			if ( $categories_list && clean_box_categorized_blog() ) {
				printf( '<span class="cat-links">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Categories</span>', 'Used before category names.', 'clean-box' ) ),
					$categories_list
				);
			}

			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'clean-box' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Tags</span>', 'Used before tag names.', 'clean-box' ) ),
					$tags_list
				);
			}
		}

		echo '</p><!-- .entry-meta -->';
	}
endif; //clean_box_tag_category


/**
 * Returns true if a blog has more than 1 category
 *
 * @since Clean Box 0.1
 */
function clean_box_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so clean_box_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so clean_box_categorized_blog should return false
		return false;
	}
}


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since Clean Box 0.1
 */
function clean_box_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'clean_box_page_menu_args' );


/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since Clean Box 0.1
 */
function clean_box_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'clean_box_enhanced_image_navigation', 10, 2 );


/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since Clean Box 0.1
 */
function clean_box_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'footer-1' ) )
		$count++;

	if ( is_active_sidebar( 'footer-2' ) )
		$count++;

	if ( is_active_sidebar( 'footer-3' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}


if ( ! function_exists( 'clean_box_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * @since Clean Box 0.1
	 */
	function clean_box_excerpt_length( $length ) {
		// Getting data from Customizer Options
		$options	= clean_box_get_theme_options();
		$length	= $options['excerpt_length'];
		return $length;
	}
endif; //clean_box_excerpt_length
add_filter( 'excerpt_length', 'clean_box_excerpt_length' );


/**
 * Change the defult excerpt length of 30 to whatever passed as value
 *
 * @use excerpt(10) or excerpt (..)  if excerpt length needs only 10 or whatevere
 * @uses get_permalink, get_the_excerpt
 */
function clean_box_excerpt_desired( $num ) {
    $limit = $num+1;
    $excerpt = explode( ' ', get_the_excerpt(), $limit );
    array_pop( $excerpt );
    $excerpt = implode( " ",$excerpt )."<a href='" .get_permalink() ." '></a>";
    return $excerpt;
}


if ( ! function_exists( 'clean_box_continue_reading' ) ) :
	/**
	 * Returns a "Custom Continue Reading" link for excerpts
	 *
	 * @since Clean Box 0.1
	 */
	function clean_box_continue_reading() {
		// Getting data from Customizer Options
		$options		=	clean_box_get_theme_options();
		$more_tag_text	= $options['excerpt_more_text'];

		return ' <a class="more-link" href="' . esc_url( get_permalink() ) . '">' .  sprintf( __( '%s', 'clean-box' ) , $more_tag_text ) . '</a>';
	}
endif; //clean_box_continue_reading
add_filter( 'excerpt_more', 'clean_box_continue_reading' );


if ( ! function_exists( 'clean_box_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with clean_box_continue_reading().
	 *
	 * @since Clean Box 0.1
	 */
	function clean_box_excerpt_more( $more ) {
		return clean_box_continue_reading();
	}
endif; //clean_box_excerpt_more
add_filter( 'excerpt_more', 'clean_box_excerpt_more' );


if ( ! function_exists( 'clean_box_custom_excerpt' ) ) :
	/**
	 * Adds Continue Reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 *
	 * @since Clean Box 0.1
	 */
	function clean_box_custom_excerpt( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$output .= clean_box_continue_reading();
		}
		return $output;
	}
endif; //clean_box_custom_excerpt
add_filter( 'get_the_excerpt', 'clean_box_custom_excerpt' );


if ( ! function_exists( 'clean_box_more_link' ) ) :
	/**
	 * Replacing Continue Reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 *
	 * @since Clean Box 0.1
	 */
	function clean_box_more_link( $more_link, $more_link_text ) {
	 	$options		=	clean_box_get_theme_options();
		$more_tag_text	= $options['excerpt_more_text'];

		return str_replace( $more_link_text, $more_tag_text, $more_link );
	}
endif; //clean_box_more_link
add_filter( 'the_content_more_link', 'clean_box_more_link', 10, 2 );


if ( ! function_exists( 'clean_box_body_classes' ) ) :
	/**
	 * Adds Clean Box layout classes to the array of body classes.
	 *
	 * @since Clean Box 0.1
	 */
	function clean_box_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		$options = clean_box_get_theme_options();

		$layout  = clean_box_get_theme_layout();

		switch ( $layout ) {
			case 'left-sidebar':
				$classes[] = 'two-columns content-right';
			break;

			case 'right-sidebar':
				$classes[] = 'two-columns content-left';
			break;

			case 'no-sidebar':
				$classes[] = 'no-sidebar content-width';
			break;
		}

		if( "" != $options['content_layout'] ) {
			$classes[] = $options['content_layout'];
		}

		//Count number of menus avaliable and set class accordingly
		$mobile_menu_count = 0;

		if ( has_nav_menu( 'secondary' ) ) {
			$classes[] = 'mobile-menu-one';
		}

		if ( is_active_sidebar( 'header-right' ) ) {
			$classes[] = 'header-right-active';
		}

		$classes 	= apply_filters( 'clean_box_body_classes', $classes );

		return $classes;
	}
endif; //clean_box_body_classes
add_filter( 'body_class', 'clean_box_body_classes' );


if ( ! function_exists( 'clean_box_post_classes' ) ) :
	/**
	 * Adds Clean Box post classes to the array of post classes.
	 * used for supporting different content layouts
	 *
	 * @since Clean Box 0.1
	 */
	function clean_box_post_classes( $classes ) {
		//Getting Ready to load data from Theme Options Panel
		$options 		= clean_box_get_theme_options();

		$contentlayout = $options['content_layout'];

		if ( is_archive() || is_home() ) {
			$classes[] = $contentlayout;
		}

		return $classes;
	}
endif; //clean_box_post_classes
add_filter( 'post_class', 'clean_box_post_classes' );


if ( ! function_exists( 'clean_box_get_theme_layout' ) ) :
	/**
	 * Returns Theme Layout prioritizing the meta box layouts
	 *
	 * @uses  get_theme_mod
	 *
	 * @action wp_head
	 *
	 * @since Clean Box 1.2
	 */
	function clean_box_get_theme_layout() {
		$id = '';

		global $post, $wp_query;

	    // Front page displays in Reading Settings
		$page_on_front  = get_option('page_on_front') ;
		$page_for_posts = get_option('page_for_posts');

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		// Blog Page or Front Page setting in Reading Settings
		if ( $page_id == $page_for_posts || $page_id == $page_on_front ) {
	        $id = $page_id;
	    }
	    else if ( is_singular() ) {
	 		if ( is_attachment() ) {
				$id = $post->post_parent;
			}
			else {
				$id = $post->ID;
			}
		}

		//Get appropriate metabox value of layout
		if ( '' != $id ) {
			$layout = get_post_meta( $id, 'clean-box-layout-option', true );
		}
		else {
			$layout = 'default';
		}

		//Load options data
		$options = clean_box_get_theme_options();

		//check empty and load default
		if ( empty( $layout ) || 'default' == $layout ) {
			$layout = $options['theme_layout'];
		}

		return $layout;
	}
endif; //clean_box_get_theme_layout


if ( ! function_exists( 'clean_box_responsive' ) ) :
	/**
	 * Responsive Layout
	 *
	 * @get the data value of responsive layout from theme options
	 * @display responsive meta tag
	 * @action wp_head
	 *
	 * @since Clean Box 0.1
	 */
	function clean_box_responsive() {
		$clean_box_responsive = '<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">';

		echo $clean_box_responsive;
	}
endif; //clean_box_responsive
add_filter( 'wp_head', 'clean_box_responsive', 1 );


if ( ! function_exists( 'clean_box_archive_content_image' ) ) :
	/**
	 * Template for Featured Image in Archive Content
	 *
	 * To override this in a child theme
	 * simply create your own clean_box_archive_content_image(), and that function will be used instead.
	 *
	 * @since Clean Box 0.1
	 */
	function clean_box_archive_content_image() {
		$options 			= clean_box_get_theme_options();

		$featured_image = $options['content_layout'];

		if ( has_post_thumbnail() && 'excerpt-image-top' == $featured_image ) { ?>
			<figure class="featured-image">
	            <a rel="bookmark" href="<?php the_permalink(); ?>">
	                <?php the_post_thumbnail( 'clean-box-featured' ); ?>
				</a>
	        </figure>
	   	<?php
		}
	}
endif; //clean_box_archive_content_image
add_action( 'clean_box_before_entry_container', 'clean_box_archive_content_image', 10 );


if ( ! function_exists( 'clean_box_single_content_image' ) ) :
	/**
	 * Template for Featured Image in Single Post
	 *
	 * To override this in a child theme
	 * simply create your own clean_box_single_content_image(), and that function will be used instead.
	 *
	 * @since Clean Box 0.1
	 */
	function clean_box_single_content_image() {
		global $post, $wp_query;

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		if( $post) {
	 		if ( is_attachment() ) {
				$parent = $post->post_parent;
				$individual_featured_image = get_post_meta( $parent,'clean-box-featured-image', true );
			} else {
				$individual_featured_image = get_post_meta( $page_id,'clean-box-featured-image', true );
			}
		}

		if( empty( $individual_featured_image ) || ( !is_page() && !is_single() ) ) {
			$individual_featured_image = 'default';
		}

		// Getting data from Theme Options
	   	$options = clean_box_get_theme_options();

		$featured_image = $options['single_post_image_layout'];

		if ( ( $individual_featured_image == 'disable' || '' == get_the_post_thumbnail() || ( $individual_featured_image=='default' && $featured_image == 'disabled') ) ) {
			echo '<!-- Page/Post Single Image Disabled or No Image set in Post Thumbnail -->';
			return false;
		}
		else {
			$class = '';

			if ( 'default' == $individual_featured_image ) {
				$class = $featured_image;
			}
			else {
				$class = 'from-metabox ' . $individual_featured_image;
			}

			?>
			<figure class="featured-image <?php echo $class; ?>">
                <?php
				if ( $individual_featured_image == 'featured' || ( $individual_featured_image=='default' && $featured_image == 'featured' ) ) {
                     the_post_thumbnail( 'clean-box-featured' );
                }
                else {
					the_post_thumbnail( 'full' );
				} ?>
	        </figure>
	   	<?php
		}
	}
endif; //clean_box_single_content_image
add_action( 'clean_box_before_post_container', 'clean_box_single_content_image', 10 );
add_action( 'clean_box_before_page_container', 'clean_box_single_content_image', 10 );


if ( ! function_exists( 'clean_box_get_comment_section' ) ) :
	/**
	 * Comment Section
	 *
	 * @display comments_template
	 * @action clean_box_comment_section
	 *
	 * @since Catch Responsive 1.0
	 */
	function clean_box_get_comment_section() {
		if ( comments_open() || '0' != get_comments_number() )
			comments_template();
	}
endif;
add_action( 'clean_box_comment_section', 'clean_box_get_comment_section', 10 );


if ( ! function_exists( 'clean_box_promotion_headline' ) ) :
	/**
	 * Template for Promotion Headline
	 *
	 * To override this in a child theme
	 * simply create your own clean_box_promotion_headline(), and that function will be used instead.
	 *
	 * @uses clean_box_before_main action to add it in the header
	 * @since Clean Box 1.0
	 */
	function clean_box_promotion_headline() {
		delete_transient( 'clean_box_promotion_headline' );

		global $post, $wp_query;
	   	$options 	= clean_box_get_theme_options();

		$promotion_headline 		= $options['promotion_headline'];
		$promotion_subheadline 		= $options['promotion_subheadline'];
		$promotion_headline_button_1= $options['promotion_headline_button_1'];
		$promotion_headline_target_1= $options['promotion_headline_target_1'];
		$promotion_headline_button_2= $options['promotion_headline_button_2'];
		$promotion_headline_target_2= $options['promotion_headline_target_2'];
		$enablepromotion 			= $options['promotion_headline_option'];

		$promotion_headline_url_1= $options[ 'promotion_headline_url_1' ];
		$promotion_headline_url_2= $options[ 'promotion_headline_url_2' ];

		//support qTranslate plugin
		if ( function_exists( 'qtrans_convertURL' ) ) {
			$promotion_headline_url_1 = qtrans_convertURL( $promotion_headline_url_1 );
			$promotion_headline_url_2 = qtrans_convertURL( $promotion_headline_url_2 );
		}

		// Front page displays in Reading Settings
		$page_on_front = get_option( 'page_on_front' ) ;
		$page_for_posts = get_option('page_for_posts');

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		 if ( ( "" != $promotion_headline || "" != $promotion_subheadline || "" != $promotion_headline_url_1 || "" != $promotion_headline_url_2 ) && ( $enablepromotion == 'entire-site' || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && $enablepromotion == 'homepage' ) ) ) {

			if ( !$clean_box_promotion_headline = get_transient( 'clean_box_promotion_headline' ) ) {

				echo '<!-- refreshing cache -->';

				$clean_box_promotion_headline = '
				<div id="promotion-message">
					<div class="wrapper">
						<div class="section left">';

						if ( "" != $promotion_headline ) {
							$clean_box_promotion_headline .= '<h2>' . $promotion_headline . '</h2>';
						}

						if ( "" != $promotion_subheadline ) {
							$clean_box_promotion_headline .= '<p>' . $promotion_subheadline . '</p>';
						}

						$clean_box_promotion_headline .= '
						</div><!-- .section.left -->';

						if ( "" != $promotion_headline_url_1 || "" != $promotion_headline_url_2 ) {
							$clean_box_promotion_headline .= '
							<div class="section right">';

							if( "" != $promotion_headline_url_1 ) {
								if ( "1" == $promotion_headline_target_1 ) {
									$headlinetarget_1 = '_blank';
								}
								else {
									$headlinetarget_1 = '_self';
								}
								$clean_box_promotion_headline .= '
								<a class="button button-blue" href="' . esc_url( $promotion_headline_url_1 ) . '" target="' . $headlinetarget_1 . '">' . esc_attr( $promotion_headline_button_1 ) . '
								</a>';

							}

							if( "" != $promotion_headline_url_2 ) {
								if ( "1" == $promotion_headline_target_2 ) {
									$headlinetarget_2 = '_blank';
								}
								else {
									$headlinetarget_2 = '_self';
								}
								$clean_box_promotion_headline .= '
								<a class="button button-green" href="' . esc_url( $promotion_headline_url_2 ) . '" target="' . $headlinetarget_2 . '">' . esc_attr( $promotion_headline_button_2 ) . '
								</a>';

							}

							$clean_box_promotion_headline .= '
							</div><!-- .section.right -->';
						}

				$clean_box_promotion_headline .= '
					</div><!-- .wrapper -->
				</div><!-- #promotion-message -->';

				set_transient( 'clean_box_promotion_headline', $clean_box_promotion_headline, 86940 );
			}
			echo $clean_box_promotion_headline;
		 }
	}
endif; // clean_box_promotion_featured_content
add_action( 'clean_box_before_content', 'clean_box_promotion_headline', 30 );

/**
 * Footer Text
 *
 * @get footer text from theme options and display them accordingly
 * @display footer_text
 * @action clean_box_footer
 *
 * @since Gridalicious 0.1
 */
function clean_box_footer_content() {
	if ( ( !$clean_box_footer_content = get_transient( 'clean_box_footer_content' ) ) ) {
		echo '<!-- refreshing cache -->';

		$clean_box_content = clean_box_get_content();

		$clean_box_footer_content =  '
    	<div id="site-generator" class="two">
    		<div class="wrapper">
    			<div id="footer-left-content" class="copyright">' . $clean_box_content['left'] . '</div>

    			<div id="footer-right-content" class="powered">' . $clean_box_content['right'] . '</div>
			</div><!-- .wrapper -->
		</div><!-- #site-generator -->';

    	set_transient( 'clean_box_footer_content', $clean_box_footer_content, 86940 );
    }

    echo $clean_box_footer_content;
}
add_action( 'clean_box_footer', 'clean_box_footer_content', 100 );


/**
 * Return the first image in a post. Works inside a loop.
 * @param [integer] $post_id [Post or page id]
 * @param [string/array] $size Image size. Either a string keyword (thumbnail, medium, large or full) or a 2-item array representing width and height in pixels, e.g. array(32,32).
 * @param [string/array] $attr Query string or array of attributes.
 * @return [string] image html
 *
 * @since Clean Box 0.1
 */

function clean_box_get_first_image( $postID, $size, $attr ) {
	ob_start();

	ob_end_clean();

	$image 	= '';

	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post_field('post_content', $postID ) , $matches);

	if( isset( $matches [1] [0] ) ) {
		//Get first image
		$first_img = $matches [1] [0];

		return '<img class="pngfix wp-post-image" src="'. $first_img .'">';
	}

	return false;
}


if ( ! function_exists( 'clean_box_scrollup' ) ) {
	/**
	 * This function loads Scroll Up Navigation
	 *
	 * @action clean_box_footer action
	 * @uses set_transient and delete_transient
	 */
	function clean_box_scrollup() {
		//clean_box_flush_transients();
		if ( !$clean_box_scrollup = get_transient( 'clean_box_scrollup' ) ) {

			// get the data value from theme options
			$options = clean_box_get_theme_options();
			echo '<!-- refreshing cache -->';

			//site stats, analytics header code
			if ( ! $options['disable_scrollup'] ) {
				$clean_box_scrollup =  '<a href="#masthead" id="scrollup" class="genericon"><span class="screen-reader-text">' . __( 'Scroll Up', 'clean-box' ) . '</span></a>' ;
			}

			set_transient( 'clean_box_scrollup', $clean_box_scrollup, 86940 );
		}
		echo $clean_box_scrollup;
	}
}
add_action( 'clean_box_after', 'clean_box_scrollup', 10 );


if ( ! function_exists( 'clean_box_page_post_meta' ) ) :
	/**
	 * Post/Page Meta for Google Structure Data
	 */
	function clean_box_page_post_meta() {
		$clean_box_author_url = esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) );

		$clean_box_page_post_meta = '<span class="post-time">' . __( 'Posted on', 'clean-box' ) . ' <time class="entry-date updated" datetime="' . esc_attr( get_the_date( 'c' ) ) . '" pubdate>' . esc_html( get_the_date() ) . '</time></span>';
	    $clean_box_page_post_meta .= '<span class="post-author">' . __( 'By', 'clean-box' ) . ' <span class="author vcard"><a class="url fn n" href="' . $clean_box_author_url . '" title="View all posts by ' . get_the_author() . '" rel="author">' .get_the_author() . '</a></span>';

		return $clean_box_page_post_meta;
	}
endif; //clean_box_page_post_meta


// retrieves the attachment ID from the file URL
function clean_box_get_image_id( $image_url ) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
        return $attachment[0];
}


if ( ! function_exists( 'clean_box_truncate_phrase' ) ) :
	/**
	 * Return a phrase shortened in length to a maximum number of characters.
	 *
	 * Result will be truncated at the last white space in the original string. In this function the word separator is a
	 * single space. Other white space characters (like newlines and tabs) are ignored.
	 *
	 * If the first `$max_characters` of the string does not contain a space character, an empty string will be returned.
	 *
	 * @since 2.4.1
	 *
	 * @param string $text            A string to be shortened.
	 * @param integer $max_characters The maximum number of characters to return.
	 *
	 * @return string Truncated string
	 */
	function clean_box_truncate_phrase( $text, $max_characters ) {

		$text = trim( $text );

		if ( mb_strlen( $text ) > $max_characters ) {
			//* Truncate $text to $max_characters + 1
			$text = mb_substr( $text, 0, $max_characters + 1 );

			//* Truncate to the last space in the truncated string
			$text = trim( mb_substr( $text, 0, mb_strrpos( $text, ' ' ) ) );
		}

		return $text;
	}
endif; //clean_box_truncate_phrase


if ( ! function_exists( 'clean_box_get_the_content_limit' ) ) :
	/**
	 * Return content stripped down and limited content.
	 *
	 * Strips out tags and shortcodes, limits the output to `$max_char` characters, and appends an ellipsis and more link to the end.
	 *
	 * @since 2.4.1
	 *
	 * @param integer $max_characters The maximum number of characters to return.
	 * @param string  $more_link_text Optional. Text of the more link. Default is "(more...)".
	 * @param bool    $stripteaser    Optional. Strip teaser content before the more text. Default is false.
	 *
	 * @return string Limited content.
	 */
	function clean_box_get_the_content_limit( $max_characters, $more_link_text = '(more...)', $stripteaser = false ) {

		$content = get_the_content( '', $stripteaser );

		//* Strip tags and shortcodes so the content truncation count is done correctly
		$content = strip_tags( strip_shortcodes( $content ), apply_filters( 'get_the_content_limit_allowedtags', '<script>,<style>' ) );

		//* Remove inline styles / scripts
		$content = trim( preg_replace( '#<(s(cript|tyle)).*?</\1>#si', '', $content ) );

		//* Truncate $content to $max_char
		$content = clean_box_truncate_phrase( $content, $max_characters );

		//* More link?
		if ( $more_link_text ) {
			$link   = apply_filters( 'get_the_content_more_link', sprintf( '<a href="%s" class="more-link">%s</a>', get_permalink(), $more_link_text ), $more_link_text );
			$output = sprintf( '<p>%s %s</p>', $content, $link );
		} else {
			$output = sprintf( '<p>%s</p>', $content );
			$link = '';
		}

		return apply_filters( 'clean_box_get_the_content_limit', $output, $content, $link, $max_characters );

	}
endif; //clean_box_get_the_content_limit


if ( ! function_exists( 'clean_box_post_navigation' ) ) :
	/**
	 * Displays Single post Navigation
	 *
	 * @uses  the_post_navigation
	 *
	 * @action clean_box_after_post
	 *
	 * @since Clean Box 0.1
	 */
	function clean_box_post_navigation() {
		the_post_navigation( array(
			'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next &rarr;', 'clean-box' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( 'Next post:', 'clean-box' ) . '</span> ' .
				'<span class="post-title">%title</span>',
			'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( '&larr; Previous', 'clean-box' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( 'Previous post:', 'clean-box' ) . '</span> ' .
				'<span class="post-title">%title</span>',
		) );
	}
endif; //clean_box_post_navigation
add_action( 'clean_box_after_post', 'clean_box_post_navigation', 10 );

/**
 * Migrate Logo to New WordPress core Custom Logo
 *
 *
 * Runs if version number saved in theme_mod "logo_version" doesn't match current theme version.
 */
function clean_box_logo_migrate() {
	$ver = get_theme_mod( 'logo_version', false );

	// Return if update has already been run
	if ( version_compare( $ver, '2.8' ) >= 0 ) {
		return;
	}

	/**
	 * Get Theme Options Values
	 */
	$options 	= clean_box_get_theme_options();

	// If a logo has been set previously, update to use logo feature introduced in WordPress 4.5
	if ( function_exists( 'the_custom_logo' ) ) {
		if( isset( $options['logo'] ) && '' != $options['logo'] ) {
			// Since previous logo was stored a URL, convert it to an attachment ID
			$logo = attachment_url_to_postid( $options['logo'] );

			if ( is_int( $logo ) ) {
				set_theme_mod( 'custom_logo', $logo );
			}
		}

  		// Update to match logo_version so that script is not executed continously
		set_theme_mod( 'logo_version', '2.8' );
	}

}
add_action( 'after_setup_theme', 'clean_box_logo_migrate' );