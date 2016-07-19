<?php
/**
 * The template for displaying the Grid Content
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


if( !function_exists( 'clean_box_featured_grid_content' ) ) :
/**
 * Add grid_content.
 *
 * @uses action hook clean_box_before_content.
 *
 * @since Clean Box 0.1
 */
function clean_box_featured_grid_content() {
	global $post, $wp_query;
	//clean_box_flush_transients();

	// get data value from options
	$options 		= clean_box_get_theme_options();
	$enablegrid_content 	= $options['featured_grid_content_option'];
	$grid_contentselect 	= $options['featured_grid_content_type'];

	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();

	// Front page displays in Reading Settings
	$page_on_front = get_option('page_on_front') ;
	$page_for_posts = get_option('page_for_posts');

	if ( $enablegrid_content == 'entire-site' || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && $enablegrid_content == 'homepage' ) ) {
		if( ( !$clean_box_featured_grid_content = get_transient( 'clean_box_featured_grid_content' ) ) ) {
			echo '<!-- refreshing cache -->';

			$clean_box_featured_grid_content = '
				<section id="featured-grid-content" class="'. $grid_contentselect .'">
					<div class="wrapper">';
							// Select Grid Content
							if ( $grid_contentselect == 'demo-featured-grid-content' && function_exists( 'clean_box_demo_grid_content' ) ) {
								$clean_box_featured_grid_content .=  clean_box_demo_grid_content();
							}
							elseif ( $grid_contentselect == 'featured-page-grid-content' && function_exists( 'clean_box_page_grid_content' ) ) {
								$clean_box_featured_grid_content .=  clean_box_page_grid_content( $options );
							}

			$clean_box_featured_grid_content .= '
					</div><!-- .wrapper -->
				</section><!-- #feature-grid-content -->';

			set_transient( 'clean_box_featured_grid_content', $clean_box_featured_grid_content, 86940 );
		}
		echo $clean_box_featured_grid_content;
	}
}
endif;
add_action( 'clean_box_before_content', 'clean_box_featured_grid_content', 10 );


if ( ! function_exists( 'clean_box_demo_grid_content' ) ) :
/**
 * This function to display featured demo grid_content
 *
 * @since Clean Box 1.0
 *
 */
function clean_box_demo_grid_content() {
	$clean_box_demo_grid_content ='
								<a class="grid-box first" title="Grid Content Image 1" href="'. esc_url( home_url( '/' ) ) .'">
									<img src="' . get_template_directory_uri() . '/images/gallery/grid-800x600.jpg" class="wp-post-image" alt="Grid Content Image 1" title="Grid Content Image 1">
									<div class="caption">
										<span class="vcenter">
											<span class="entry-title">
												Grid Content Image 1
											</span>
											<span class="more">
												Read More ...
											</span>
										</span><!-- .vcenter -->
									</div><!-- .caption -->
								</a><!-- .grid-box -->

								<a class="grid-box" title="Grid Content Image 2" href="'. esc_url( home_url( '/' ) ) .'">
									<img src="' . get_template_directory_uri() . '/images/gallery/grid-400x300.jpg" class="wp-post-image" alt="Grid Content Image 2" title="Grid Content Image 2">
									<div class="caption">
										<span class="vcenter">
											<span class="entry-title">
												Grid Content Image 2
											</span>
											<span class="more">
												Read More ...
											</span>
										</span><!-- .vcenter -->
									</div><!-- .caption -->
								</a><!-- .grid-box -->

								<a class="grid-box" title="Grid Content Image 3" href="'. esc_url( home_url( '/' ) ) .'">
									<img src="' . get_template_directory_uri() . '/images/gallery/grid-400x300-2.jpg" class="wp-post-image" alt="Grid Content Image 3" title="Grid Content Image 3">
									<div class="caption">
										<span class="vcenter">
											<span class="entry-title">
												Grid Content Image 3
											</span>
											<span class="more">
												Read More ...
											</span>
										</span><!-- .vcenter -->
									</div><!-- .caption -->
								</a><!-- .grid-box -->';
	return $clean_box_demo_grid_content;
}
endif; // clean_box_demo_grid_content


if ( ! function_exists( 'clean_box_page_grid_content' ) ) :
/**
 * This function to display featured page grid_content
 *
 * @param $options: clean_box_theme_options from customizer
 *
 * @since Clean Box 0.1
 */
function clean_box_page_grid_content( $options ) {
	$quantity		= $options['featured_grid_content_number'];

	global $post;

    $clean_box_page_grid_content = '';
    $number_of_page 		= 0; 		// for number of pages
	$page_list				= array();	// list of valid page ids

	//Get number of valid pages
	for( $i = 1; $i <= $quantity; $i++ ){
		if( isset ( $options['featured_grid_content_page_' . $i] ) && $options['featured_grid_content_page_' . $i] > 0 ){
			$number_of_page++;

			$page_list	=	array_merge( $page_list, array( $options['featured_grid_content_page_' . $i] ) );
		}

	}

	if ( !empty( $page_list ) && $number_of_page > 0 ) {
		$get_featured_posts = new WP_Query( array(
			'posts_per_page'	=> $quantity,
			'post_type'			=> 'page',
			'post__in'			=> $page_list,
			'orderby' 			=> 'post__in'
		));

		$i=1;

		while ( $get_featured_posts->have_posts() ) {

			$get_featured_posts->the_post();

			$title_attribute = the_title_attribute( array( 'before' => __( 'Permalink to:', 'clean-box' ), 'echo' => false ) );

			$classes = 'page pageid-' . $post->ID;

			if ( 1 == $i ) {
				$classes .= ' first';
			}
			else if ( 1 == $i%3 ) {
				$classes .= ' first-cols';
			}

			$clean_box_page_grid_content .=
			'<a class="grid-box '. $classes .'" title="' . $title_attribute . '" href="' . get_permalink() . '">';

			if ( has_post_thumbnail() ) {
				if ( 1 == $i ) {
					$clean_box_page_grid_content .= get_the_post_thumbnail( $post->ID, 'clean-box-featured-grid', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class'	=> 'pngfix' ) );
				}
				else{
					$clean_box_page_grid_content .= get_the_post_thumbnail( $post->ID, 'clean-box-featured-content', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class'	=> 'pngfix' ) );
				}
			}
			else {
				//Default value if there is no first image
				$clean_box_image =
					'<img class="no-image pngfix" src="'.get_template_directory_uri().'/images/gallery/no-featured-image-800x450.jpg" />';

				//Get the first image in page, returns false if there is no image
				$clean_box_first_image = clean_box_get_first_image( $post->ID, 'medium', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class' => 'pngfix' ) );

				//Set value of image as first image if there is an image present in the post
				if ( '' != $clean_box_first_image ) {
					$clean_box_image =	$clean_box_first_image;
				}

				$clean_box_page_grid_content .= $clean_box_image;
			}

			$clean_box_page_grid_content .= '
				<div class="caption">
					<span class="vcenter">
						<span class="entry-title">
							' . the_title('', '', false) . '
						</span>
						<span class="more">';

						$clean_box_page_grid_content .=  $options['excerpt_more_text'];

				$clean_box_page_grid_content .= '
						</span><!-- .more -->
					</span><!-- .vcenter -->
				</div><!-- .caption -->
			</a><!-- .grid-box -->';

			$i++;
		}

		wp_reset_query();
	}

	return $clean_box_page_grid_content;
}
endif; // clean_box_page_grid_content