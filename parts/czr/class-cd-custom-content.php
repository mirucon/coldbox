<?php
/**
 * The custom class for output HTML on the customizer.
 *
 * @since 1.1.1
 * @package Coldbox
 */

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'CD_Custom_Content' ) ) {

	/**
	 * For adding HTML on the customizer.
	 *
	 * @since 1.1.1
	 */
	class CD_Custom_Content extends WP_Customize_Control {

		/**
		 * A variable described below.
		 *
		 * @var string $content The string that will be output on the customizer
		 */
		public $content = '';
		/**
		 * Output the contents
		 *
		 * @since 1.1.1
		 */
		public function render_content() {
			if ( isset( $this->content ) ) {
				echo $this->content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
}
