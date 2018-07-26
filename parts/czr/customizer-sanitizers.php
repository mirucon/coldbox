<?php
/**
 * Sanitization functions for theme customizer.
 *
 * @since 1.6.2
 * @package Coldbox
 */

/**
 * Define the sanitization function for checkboxes.
 *
 * @since 1.0.0
 * @param bool $checked The strings that will be checked.
 * @return bool
 */
function cd_sanitize_checkbox( $checked ) {
	return ( isset( $checked ) && true === $checked ) ? true : false;
}
/**
 * Define the sanitization function for radio button / select boxes.
 *
 * @since 1.0.0
 * @param string $input The strings that will be checked.
 * @param string $setting The possible choices.
 * @return string
 */
function cd_sanitize_radio( $input, $setting ) {
	$input   = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return array_key_exists( $input, $choices ) ? $input : $setting->default;
}
