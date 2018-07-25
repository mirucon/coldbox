<?php
/**
 * The template for getting the font setting from the customizer and return the font family
 *
 * @since 1.0.0
 * @package Coldbox
 */

if ( ! function_exists( 'cd_customizer_font' ) ) {

	/**
	 * Enqueue the font file selected on the theme customizer
	 *
	 * @since 1.0.0
	 */
	function cd_customizer_font() {
		$font = get_theme_mod( 'global_font', 'sourcesanspro' );

		if ( 'opensans' === $font ) {
			wp_enqueue_style( 'OpenSans', '//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i', array(), '1.0.0' );
		} elseif ( 'lato' === $font ) {
			wp_deregister_style( 'GoogleFonts' );
			wp_enqueue_style( 'Lato', '//fonts.googleapis.com/css?family=Lato:300,400,400i,600,600i,700', array(), '1.0.0' );
		} elseif ( 'roboto' === $font ) {
			wp_enqueue_style( 'Roboto', '//fonts.googleapis.com/css?family=Roboto:300,400,400i,600,600i,700', array(), '1.0.0' );
		} elseif ( 'robotocondensed' === $font ) {
			wp_enqueue_style( 'RobotoCondensed', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,400,400i,600,600i,700', array(), '1.0.0' );
		} elseif ( 'ubuntu' === $font ) {
			wp_enqueue_style( 'Ubuntu', '//fonts.googleapis.com/css?family=Ubuntu:300,400,400i,600,600i,700', array(), '1.0.0' );
		} elseif ( 'raleway' === $font ) {
			wp_enqueue_style( 'Raleway', '//fonts.googleapis.com/css?family=Raleway:300,400,400i,600,600i,700', array(), '1.0.0' );
		} elseif ( 'sourcesanspro' === $font ) {
			wp_enqueue_style( 'SourceSansPro', '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,600,600i,700', array(), '1.0.0' );
		} elseif ( 'josefinsans' === $font ) {
			wp_enqueue_style( 'JosefinSans', '//fonts.googleapis.com/css?family=Josefin+Sans:300,400,400i,600,600i,700', array(), '1.0.0' );
		} elseif ( 'ptsans' === $font ) {
			wp_enqueue_style( 'PTSans', '//fonts.googleapis.com/css?family=PT+Sans:300,400,400i,600,600i,700', array(), '1.0.0' );
		} elseif ( 'lora' === $font ) {
			wp_enqueue_style( 'Lora', '//fonts.googleapis.com/css?family=Lora:300,400,400i,600,600i,700', array(), '1.0.0' );
		} elseif ( 'robotoslab' === $font ) {
			wp_enqueue_style( 'RobotoSlab', '//fonts.googleapis.com/css?family=Roboto+Slab:300,400,400i,600,600i,700', array(), '1.0.0' );
		}

	}
} // End if.
add_action( 'wp_enqueue_scripts', 'cd_customizer_font' );


if ( ! function_exists( 'cd_customizer_font_set' ) ) {

	/**
	 * Set the font the user has selected.
	 *
	 * @since 1.0.0
	 */
	function cd_customizer_font_set() {

		$font      = esc_html( get_theme_mod( 'global_font', 'sourcesanspro' ) );
		$custom_ff = get_theme_mod( 'custom_font', '[font], -apple-system, BlinkMacSystemFont, \'Helvetica Neue\', Arial, sans-serif' );

		if ( 'sourcesanspro' === $font && '[font], -apple-system, BlinkMacSystemFont, \'Helvetica Neue\', Arial, sans-serif' === $custom_ff ) {
			return;
		}

		if ( 'opensans' === $font ) {
			$font = 'Open Sans';
		} elseif ( 'sourcesanspro' === $font ) {
			$font = '"Source Sans Pro"';
		} elseif ( 'josefinsans' === $font ) {
			$font = '"Josefin Sans"';
		} elseif ( 'ptsans' === $font ) {
			$font = '"PT Sans"';
		} elseif ( 'robotoslab' === $font ) {
			$font = '"Roboto Slab"';
		}

		$custom_ff   = str_replace( '[font]', ucfirst( $font ), $custom_ff );
		$font_family = "body { font-family: {$custom_ff} }";

		$font_family = cd_css_minify( $font_family );

		wp_add_inline_style( 'cd-style', $font_family );

	}
}
add_action( 'wp_enqueue_scripts', 'cd_customizer_font_set' );
