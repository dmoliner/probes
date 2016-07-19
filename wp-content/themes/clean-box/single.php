<?php
/**
 * The Template for displaying all single posts
 *
 * @package Catch Themes
 * @subpackage Clean Box
 * @since Clean Box 0.1 
 */

get_header(); ?>

	<main id="main" class="site-main" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single' ); ?>

		<?php 
			/** 
			 * clean_box_after_post hook
			 *
			 * @hooked clean_box_post_navigation - 10
			 */
			do_action( 'clean_box_after_post' ); 
			
			/** 
			 * clean_box_comment_section hook
			 *
			 * @hooked clean_box_get_comment_section - 10
			 */
			do_action( 'clean_box_comment_section' ); 
		?>
	<?php endwhile; // end of the loop. ?>

	</main><!-- #main -->
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>