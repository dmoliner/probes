<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Catch Themes
 * @subpackage Clean Box
 * @since Clean Box 0.1
 */
?>
<section class="hentry search-not-found">
	<div class="entry-container">
		<header class="entry-header">
			<h1 class="page-title"><?php _e( 'Error 404-Page NOT Found', 'clean-box' ); ?></h1>
		</header>

		<div class="entry-content no-results">

			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'clean-box' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

			<?php elseif ( is_search() ) : ?>

				<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'clean-box' ); ?></p>
				<?php get_search_form(); ?>

			<?php else : ?>

				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'clean-box' ); ?></p>
				<?php get_search_form(); ?>

			<?php endif; ?>
		</div><!-- .entry-content -->
	</div><!-- .entry-container -->
</section><!-- .no-results -->