<?php
/**
 * The template for displaying custom menus
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


if ( ! function_exists( 'clean_box_primary_menu' ) ) :
/**
 * Shows the Primary Menu
 *
 */
function clean_box_primary_menu() {
    $options  = clean_box_get_theme_options();
	?>
    <div id="fixed-header-top">
        <div class="wrapper">
            <div id="mobile-primary-menu" class="mobile-menu-anchor fixed-primary-menu">
                <a href="#mobile-primary-nav" id="primary-menu-anchor" class="genericon genericon-menu">
                    <span class="mobile-menu-text screen-reader-text">
                        <?php esc_html_e( 'Menu', 'clean-box' ); ?>
                    </span>
                </a>
            </div><!-- #mobile-primary-menu -->

            <?php
                $logo_alt = ( '' != $options['logo_alt_text'] ) ? $options['logo_alt_text'] : get_bloginfo( 'name', 'display' );

                if ( isset( $options[ 'logo_icon' ] ) &&  $options[ 'logo_icon' ] != '' &&  !empty( $options[ 'logo_icon' ] ) ){
                     echo '<div id="logo-icon"><a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">
                        <img src="' . esc_url( $options['logo_icon'] ) . '" alt="' . esc_attr( $logo_alt ). '">
                    </a></div>';
                }
            ?>

           <nav class="nav-primary search-enabled" role="navigation">
                <h1 class="assistive-text"><?php _e( 'Primary Menu', 'clean-box' ); ?></h1>
                <div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'clean-box' ); ?>"><?php _e( 'Skip to content', 'clean-box' ); ?></a></div>
                <?php
                    if ( has_nav_menu( 'primary' ) ) {
                        $clean_box_primary_menu_args = array(
                            'theme_location'    => 'primary',
                            'menu_class'        => 'menu clean-box-nav-menu',
                            'container'         => false
                        );
                        wp_nav_menu( $clean_box_primary_menu_args );
                    }
                    else {
                        wp_page_menu( array( 'menu_class'  => 'menu clean-box-nav-menu' ) );
                    }

                    ?>
            </nav><!-- .nav-primary -->

            <div id="header-toggle">
                <a href="#header-toggle-sidebar" class="genericon"><span class="header-toggle-text screen-reader-text"><?php _e( 'Show Header Sidebar Content', 'clean-box' ); ?></span></a>
            </div>

            <div id="header-toggle-sidebar" class="widget-area displaynone" role="complementary">
                <?php if ( is_active_sidebar( 'header-toggle' ) ) { ?>
                    <?php dynamic_sidebar( 'header-toggle' ); ?>
                <?php
                }
                else { ?>
                    <section class="widget widget_search" id="header-serach">
                        <?php get_search_form(); ?>
                    </section>

                    <?php

                    if ( '' != ( $clean_box_social_icons = clean_box_get_social_icons() ) ) { ?>
                        <section class="widget widget_clean_box_social_icons" id="header-social-icons">
                            <div class="widget-wrap">
                                <?php echo $clean_box_social_icons; ?>
                            </div>
                        </section>
                    <?php
                    }
                }
                ?>
            </div><!-- #header-toggle-sidebar -->
        </div><!-- .wrapper -->
    </div><!-- #fixed-header-top -->
    <?php
}
endif; //clean_box_primary_menu
add_action( 'clean_box_header', 'clean_box_primary_menu', 20 );


if ( ! function_exists( 'clean_box_secondary_menu' ) ) :
/**
 * Shows the Secondary Menu
 *
 */
function clean_box_secondary_menu() {
    if ( has_nav_menu( 'secondary' ) ) {
	?>
    	<nav class="nav-secondary" role="navigation">
            <div class="wrapper">
                <h1 class="assistive-text"><?php _e( 'Secondary Menu', 'clean-box' ); ?></h1>
                <div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'clean-box' ); ?>"><?php _e( 'Skip to content', 'clean-box' ); ?></a></div>
                <?php
                    $clean_box_secondary_menu_args = array(
                        'theme_location'    => 'secondary',
                        'menu_class' => 'menu clean-box-nav-menu'
                    );
                    wp_nav_menu( $clean_box_secondary_menu_args );
                ?>
        	</div><!-- .wrapper -->
        </nav><!-- .nav-secondary -->

<?php
    }
}
endif; //clean_box_secondary_menu
add_action( 'clean_box_after_header', 'clean_box_secondary_menu', 30 );


if ( ! function_exists( 'clean_box_mobile_menus' ) ) :
/**
 * This function loads Mobile Menus
 *
 * @get the data value from theme options
 * @uses clean_box_after action to add the code in the footer
 */
function clean_box_mobile_menus() {
    //Getting Ready to load options data
    $options                    = clean_box_get_theme_options();

    // Check Primary Menu
    echo '<nav id="mobile-primary-nav" class="mobile-menu" role="navigation">';
        if ( has_nav_menu( 'primary' ) ) {
            $clean_box_primary_menu_args = array(
                'theme_location'    => 'primary',
                'container'         => false,
                'items_wrap'        => '<ul id="fixed-primary-left-nav" class="menu">%3$s</ul>'
            );
            wp_nav_menu( $clean_box_primary_menu_args );
        }
        else {
            wp_page_menu( array( 'menu_class'  => 'page-menu-wrap' ) );
        }
    echo '</nav><!-- #mobile-primary-nav -->';

    // Check Header Left Mobile Menu
    if ( !has_nav_menu( 'secondary' ) ) {
        return;
    }

    echo '<nav id="mobile-header-left-nav" class="mobile-menu" role="navigation">';
        $args = array(
            'theme_location'    => 'secondary',
            'container'         => false,
            'items_wrap'        => '<ul id="header-left-nav" class="menu">%3$s</ul>'
        );
        wp_nav_menu( $args );
    echo '</nav><!-- #mobile-header-left-nav -->';
}
endif; //clean_box_mobile_menus

add_action( 'clean_box_after', 'clean_box_mobile_menus', 20 );


if ( ! function_exists( 'clean_box_mobile_header_nav_anchor' ) ) :
/**
 * This function loads Mobile Menus Left Anchor
 *
 * @get the data value from theme options
 * @uses clean_box_header action to add in the Header
 */
function clean_box_mobile_header_nav_anchor() {
    if ( !has_nav_menu( 'secondary' ) ) {
        return;
    }

    ?>

    <div id="mobile-header-left-menu" class="mobile-menu-anchor secondary-menu">
        <a href="#mobile-header-left-nav" id="header-left-menu-anchor" class="genericon genericon-menu">
            <span class="mobile-menu-text"><?php esc_html_e( 'Secondary Menu', 'clean-box' ); ?></span>
        </a>
    </div><!-- #mobile-header-menu -->
    <?php
}
endif; //clean_box_mobile_menus
add_action( 'clean_box_header', 'clean_box_mobile_header_nav_anchor', 60 );
