<?php
/**
 * File for storing validator functions for theme customizer.
 *
 * @since 1.6.2
 * @package Coldbox
 */

/**
 * Validator function for grid columns.
 *
 * @param array $validity Validity.
 * @param int   $value Number of columns to be validated.
 * @return array
 */
function cd_validator_grid_columns( $validity, $value ) {
	if ( $value < 1 ) {
		$validity->add( 'no_negative_num', esc_html__( 'The value must be greater than zero.', 'coldbox' ) );
	}
	return $validity;
}
