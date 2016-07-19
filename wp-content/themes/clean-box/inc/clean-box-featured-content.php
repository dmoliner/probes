<?php
/**
 * The template for displaying the Featured Content
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


if( !function_exists( 'clean_box_featured_content_display' ) ) :
/**
* Add Featured content.
*
* @uses action hook clean_box_before_content.
*
* @since Clean Box 0.1
*/
function clean_box_featured_content_display() {
	//clean_box_flush_transients();

	global $post, $wp_query;

	// get data value from options
	$options 		= clean_box_get_theme_options();
	$enablecontent 	= $options['featured_content_option'];
	$contentselect 	= $options['featured_content_type'];

	// Front page displays in Reading Settings
	$page_on_front 	= get_option('page_on_front') ;
	$page_for_posts = get_option('page_for_posts');


	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();

	if ( $enablecontent == 'entire-site' || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && $enablecontent == 'homepage' ) ) {
		if( ( !$clean_box_featured_content = get_transient( 'clean_box_featured_content' ) ) ) {
			$layouts 	 = $options ['featured_content_layout'];
			$headline 	 = $options ['featured_content_headline'];
			$subheadline = $options ['featured_content_subheadline'];

			echo '<!-- refreshing cache -->';

			if ( !empty( $layouts ) ) {
				$classes = $layouts ;
			}

			if( $contentselect == 'demo-featured-content' ) {
				$headline 		= __( 'Featured Content', 'clean-box' );
				$subheadline 	= __( 'Here you can showcase the x number of Featured Content. You can edit this Headline, Subheadline and Feaured Content from "Appearance -> Customize -> Featured Content Options".', 'clean-box' );
			}

			$classes 	.= ' ' . $contentselect ;

			//Check Featured Content Position
			if ( isset( $options [ 'featured_content_position' ] ) ) {
				$featured_content_position = $options [ 'featured_content_position' ];
			}

			if ( '1' == $featured_content_position ) {
				$classes .= ' border-top' ;
			}

			$clean_box_featured_content ='
				<section id="featured-content" class="' . $classes . '">
					<div class="wrapper">';
						if ( !empty( $headline ) || !empty( $subheadline ) ) {
							$clean_box_featured_content .='<div class="featured-heading-wrap">';
								if ( !empty( $headline ) ) {
									$clean_box_featured_content .='<h1 id="featured-heading" class="entry-title">'. $headline .'</h1>';
								}
								if ( !empty( $subheadline ) ) {
									$clean_box_featured_content .='<p>'. $subheadline .'</p>';
								}
							$clean_box_featured_content .='</div><!-- .featured-heading-wrap -->';
						}
						$clean_box_featured_content .='
						<div class="featured-content-wrap">';

							// Select content
							if ( $contentselect == 'demo-featured-content'  && function_exists( 'clean_box_demo_content' ) ) {
								$clean_box_featured_content .= clean_box_demo_content( $options );
							}
							elseif ( $contentselect == 'featured-page-content' && function_exists( 'clean_box_page_content' ) ) {
								$clean_box_featured_content .= clean_box_page_content( $options );
							}

			$clean_box_featured_content .='
						</div><!-- .featured-content-wrap -->
					</div><!-- .wrapper -->
				</section><!-- #featured-content -->';

			set_transient( 'clean_box_featured_content', $clean_box_featured_content, 86940 );
		}
	echo $clean_box_featured_content;
	}
}
endif;


if ( ! function_exists( 'clean_box_featured_content_display_position' ) ) :
/**
 * Homepage Featured Content Position
 *
 * @action clean_box_content, clean_box_after_secondary
 *
 * @since Clean Box 0.1
 */
function clean_box_featured_content_display_position() {
	// Getting data from Theme Options
	$options 		= clean_box_get_theme_options();

	//Check Featured Content Position
	if ( isset( $options [ 'featured_content_position' ] ) ) {
		$featured_content_position = $options [ 'featured_content_position' ];
	}

	if ( '1' != $featured_content_position ) {
		add_action( 'clean_box_before_content', 'clean_box_featured_content_display', 40 );
	} else {
		add_action( 'clean_box_after_content', 'clean_box_featured_content_display', 40 );
	}

}
endif; // clean_box_featured_content_display_position
add_action( 'clean_box_before', 'clean_box_featured_content_display_position' );


if ( ! function_exists( 'clean_box_demo_content' ) ) :
/**
 * This function to display featured posts content
 *
 * @get the data value from customizer options
 *
 * @since Clean Box 1.0
 *
 */
function clean_box_demo_content( $options ) {
	$clean_box_demo_content = '
		<article id="featured-post-1" class="post hentry post-demo">
			<figure class="featured-content-image">
				<img alt="Central Park" class="wp-post-image" src="'.get_template_directory_uri() . '/images/gallery/featured1-400x300.jpg" />
			</figure>
			<div class="entry-container">
				<header class="entry-header">
					<h1 class="entry-title">
						<a href="#" rel="bookmark">Central Park</a>
					</h1>
				</header>
				<div class="entry-content">
					Central Park is is the most visited urban park in the United States as well as one of the most filmed locations in the world. It was opened in 1857 and is expanded in 843 acres of city-owned land.
				</div>
			</div><!-- .entry-container -->
		</article>

		<article id="featured-post-2" class="post hentry post-demo">
			<figure class="featured-content-image">
				<img alt="Antique Clock" class="wp-post-image" src="'.get_template_directory_uri() . '/images/gallery/featured2-400x300.jpg" />
			</figure>
			<div class="entry-container">
				<header class="entry-header">
					<h1 class="entry-title">
						<a href="#" rel="bookmark">Antique Clock</a>
					</h1>
				</header>
				<div class="entry-content">
					Antique clocks increase in value with the rarity of the design, their condition, and appeal in the market place. Many different materials were used in antique clocks.
				</div>
			</div><!-- .entry-container -->
		</article>

		<article id="featured-post-3" class="post hentry post-demo">
			<figure class="featured-content-image">
				<img alt="Vespa Scooter" class="wp-post-image" src="'.get_template_directory_uri() . '/images/gallery/featured3-400x300.jpg" />
			</figure>
			<div class="entry-container">
				<header class="entry-header">
					<h1 class="entry-title">
						<a href="#" rel="bookmark">Vespa Scooter</a>
					</h1>
				</header>
				<div class="entry-content">
					The Vespa has evolved from a single model motor scooter manufactured in 1946 by Piaggio & Co. S.p.A. of Pontedera, Italy-to a full line of scooters, today owned by Piaggio.
				</div>
			</div><!-- .entry-container -->
		</article>';

	if( 'layout-four' == $options ['featured_content_layout']) {
		$clean_box_demo_content .= '
		<article id="featured-post-4" class="post hentry post-demo">
			<figure class="featured-content-image">
				<img alt="Dhulikhel" class="wp-post-image" src="'.get_template_directory_uri() . '/images/gallery/featured4-400x300.jpg" />
			</figure>
			<div class="entry-container">
				<header class="entry-header">
					<h1 class="entry-title">
						<a href="#" rel="bookmark">Dhulikhel</a>
					</h1>
				</header>
				<div class="entry-content">
					Dhulikhel is a popular place to observe the high Himalaya - A Tourist Paradise: The spectacular snowfed mountains seen from Dhuklikhel must be one of the finest panoramic views in the world.
				</div>
			</div><!-- .entry-container -->
		</article>';
	}

	return $clean_box_demo_content;
}
endif; // clean_box_demo_content


if ( ! function_exists( 'clean_box_page_content' ) ) :
/**
 * This function to display featured page content
 *
 * @param $options: clean_box_theme_options from customizer
 *
 * @since Clean Box 0.1
 */
function clean_box_page_content( $options ) {
	global $post;

	$quantity 					= $options [ 'featured_content_number' ];

	$more_link_text				= $options['excerpt_more_text'];

	$show_content	= isset( $options['featured_content_show'] ) ? $options['featured_content_show'] : 'excerpt';

	$clean_box_page_content 	= '';

   	$number_of_page 			= 0; 		// for number of pages

	$page_list					= array();	// list of valid pages ids

	//Get valid pages
	for( $i = 1; $i <= $quantity; $i++ ){
		if( isset ( $options['featured_content_page_' . $i] ) && $options['featured_content_page_' . $i] > 0 ){
			$number_of_page++;

			$page_list	=	array_merge( $page_list, array( $options['featured_content_page_' . $i] ) );
		}

	}
	if ( !empty( $page_list ) && $number_of_page > 0 ) {
		$get_featured_posts = new WP_Query( array(
                    'posts_per_page' 		=> $number_of_page,
                    'post__in'       		=> $page_list,
                    'orderby'        		=> 'post__in',
                    'post_type'				=> 'page',
                ));

		$i=0;
		while ( $get_featured_posts->have_posts()) : $get_featured_posts->the_post(); $i++;
			$title_attribute = the_title_attribute( array( 'before' => __( 'Permalink to:', 'clean-box' ), 'echo' => false ) );

			$excerpt = get_the_excerpt();

			$clean_box_page_content .= '
				<article id="featured-post-' . $i . '" class="post hentry featured-page-content">';
				if ( has_post_thumbnail() ) {
					$clean_box_page_content .= '
					<figure class="featured-homepage-image">
						<a href="' . get_permalink() . '" title="' . $title_attribute . '">
						'. get_the_post_thumbnail( $post->ID, 'medium', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class' => 'pngfix' ) ) .'
						</a>
					</figure>';
				}
				else {
					$clean_box_first_image = clean_box_get_first_image( $post->ID, 'medium', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class' => 'pngfix' ) );

					if ( '' != $clean_box_first_image ) {
						$clean_box_page_content .= '
						<figure class="featured-homepage-image">
							<a href="' . get_permalink() . '" title="' . $title_attribute . '">
								'. $clean_box_first_image .'
							</a>
						</figure>';
					}
				}

				$clean_box_page_content .= '
					<div class="entry-container">
						<header class="entry-header">
							<h1 class="entry-title">
								<a href="' . get_permalink() . '" rel="bookmark">' . the_title( '','', false ) . '</a>
							</h1>
						</header>';
						if ( 'excerpt' == $show_content ) {
							$clean_box_page_content .= '<div class="entry-excerpt"><p>' . $excerpt . '</p></div><!-- .entry-excerpt -->';
						}
						elseif ( 'full-content' == $show_content ) {
							$content = apply_filters( 'the_content', get_the_content() );
							$content = str_replace( ']]>', ']]&gt;', $content );
							$clean_box_page_content .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
						}
						$clean_box_page_content .= '
					</div><!-- .entry-container -->
				</article><!-- .featured-post-'. $i .' -->';
		endwhile;

		wp_reset_query();
	}

	return $clean_box_page_content;
}
endif; // clean_box_page_content