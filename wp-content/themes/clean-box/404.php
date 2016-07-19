<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package Catch Themes
 * @subpackage Clean Box
 * @since Clean Box 0.1 
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<section class="hentry error-404">
				<div class="entry-container">
					<header class="entry-header">
						<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'clean-box' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content not-found">
						<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'clean-box' ); ?></p>

						<?php get_search_form(); ?>

					</div><!-- .entry-content -->
				</div><!-- .entry-container -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>