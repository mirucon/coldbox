<?php
/**
 * The custom class for output HTML on the customizer.
 *
 * @since 1.1.1
 * @package coldbox
 */

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'cd_Custom_Content' ) ) {
	class CD_Custom_Content extends WP_Customize_Control {
		public $content = '';
		public function render_content() {
			if ( isset( $this -> content ) ) {
				echo wp_kses_post( $this -> content );
			}
		}
	}
}
