<?php
/**
 * The template for displaying search form
 *
 * @package Catch Themes
 * @subpackage Clean Box
 * @since Clean Box 0.1 
 */
?>

<?php $options 	= clean_box_get_theme_options(); // Get options ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'clean-box' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr( $options[ 'search_text' ] ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'clean-box' ); ?>">
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'clean-box' ); ?>">
</form>
