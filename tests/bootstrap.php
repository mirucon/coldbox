<?php
/**
 * PHPUnit bootstrap file
 *
 * @package Coldbox
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
	$_tests_dir = '/tmp/wordpress-tests-lib';
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Register theme
 */
function _register_theme() {

	$theme_dir     = dirname( dirname( __FILE__ ) );
	$current_theme = basename( $theme_dir );

	register_theme_directory( dirname( $theme_dir ) );

	add_filter(
		'pre_option_template', function() use ( $current_theme ) {
			return $current_theme;
		}
	);
	add_filter(
		'pre_option_stylesheet', function() use ( $current_theme ) {
			return $current_theme;
		}
	);
}
tests_add_filter( 'muplugins_loaded', '_register_theme' );

function _manually_load_environment() {

	// Switch Coldbox theme.
	switch_theme( 'coldbox' );

	// Update array with plugins to include.
	$plugins_to_active = array(
		'coldbox-addon/coldbox-addon.php',
	);

	update_option( 'active_plugins', $plugins_to_active );

}
tests_add_filter( 'muplugins_loaded', '_manually_load_environment' );


// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';
