<?php
/**
 * The template for displaying the footer
 *
 * @package Catch Themes
 * @subpackage Clean Box
 * @since Clean Box 0.1 
 */
?>

<?php 
    /** 
     * clean_box_after_content hook
     *
     * @hooked clean_box__content_sidebar_wrap_end - 10
     * @hooked clean_box_content_end - 30
     * @hooked clean_box_featured_content_display (move featured content below homepage posts) - 40 
     *
     */
    do_action( 'clean_box_after_content' ); 
?>
            
<?php                
    /** 
     * clean_box_footer hook
     *
     * @hooked clean_box_footer_content_start - 10
     * @hooked clean_box_footer_sidebar - 20
     * @hooked clean_box_get_footer_content - 100
     * @hooked clean_box_footer_content_end - 110
     * @hooked clean_box_page_end - 200
     *
     */
    do_action( 'clean_box_footer' );
?>

<?php               
/** 
 * clean_box_after hook
 *
 * @hooked clean_box_scrollup - 10
 * @hooked clean_box_mobile_menus- 20
 *
 */
do_action( 'clean_box_after' );?>

<?php wp_footer(); ?>

</body>
</html>