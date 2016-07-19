<?php
/**
 * The template for adding Customizer Custom Controls
 *
 * @package Clean Box Catch Themes
 * @subpackage Clean Box
 * @since Clean Box 0.1 
 */

if ( ! defined( 'CLEAN_BOX_THEME_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}
	//Custom control for dropdown category multiple select
	class Clean_Box_Customize_Dropdown_Categories_Control extends WP_Customize_Control {
		public $type = 'dropdown-categories';

		public $name;

		public function render_content() {
			$dropdown = wp_dropdown_categories(
				array(
					'name'             => $this->name,
					'echo'             => 0,
					'hide_empty'       => false,
					'show_option_none' => false,
					'hide_if_empty'    => false,
				)
			);

			$dropdown = str_replace('<select', '<select multiple = "multiple" style = "height:95px;" ' . $this->get_link(), $dropdown );

			printf(
				'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			);

			echo '<p class="description">'. __( 'Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.', 'clean-box' ) . '</p>';
		}
	}


	//Custom control for any note, use label as output description
	class Clean_Box_Note_Control extends WP_Customize_Control {
		public $type = 'description';

		public function render_content() {
			echo '<h2 class="description">' . $this->label . '</h2>';
		}
	}

	//Custom control for dropdown category multiple select
	class Clean_Box_Important_Links extends WP_Customize_Control {
        public $type = 'important-links'; 
        
        public function render_content() {
        	//Add Theme instruction, Support Forum, Changelog, Donate link, Review, Facebook, Twitter, Google+, Pinterest links
            $important_links = array(
							'theme_instructions' => array( 
								'link'	=> esc_url( 'http://catchthemes.com/theme-instructions/clean-box-pro/' ),
								'text' 	=> __( 'Theme Instructions', 'clean-box' ),
								),
							'support' => array( 
								'link'	=> esc_url( 'http://catchthemes.com/support/' ),
								'text' 	=> __( 'Support', 'clean-box' ),
								),
							'changelog' => array( 
								'link'	=> esc_url( 'http://catchthemes.com/changelogs/clean-box-pro-theme/' ),
								'text' 	=> __( 'Changelog', 'clean-box' ),
								),
							'facebook' => array( 
								'link'	=> esc_url( 'https://www.facebook.com/catchthemes/' ),
								'text' 	=> __( 'Facebook', 'clean-box' ),
								),
							'twitter' => array( 
								'link'	=> esc_url( 'https://twitter.com/catchthemes/' ),
								'text' 	=> __( 'Twitter', 'clean-box' ),
								),
							'gplus' => array( 
								'link'	=> esc_url( 'https://plus.google.com/+Catchthemes/' ),
								'text' 	=> __( 'Google+', 'clean-box' ),
								),
							'pinterest' => array( 
								'link'	=> esc_url( 'http://www.pinterest.com/catchthemes/' ),
								'text' 	=> __( 'Pinterest', 'clean-box' ),
								),
							);
			foreach ( $important_links as $important_link) {
				echo '<p><a target="_blank" href="' . $important_link['link'] .'" >' . esc_attr( $important_link['text'] ) .' </a></p>';
			}
        }
    }