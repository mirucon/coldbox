<?php
$root = dirname( __DIR__ );
$series = getenv( 'WP_VERSION' ) ?: '7.1';
$runtime = getenv( 'COLDBOX_TEST_RUNTIME' ) ?: $root . '/.test-runtime';
define( 'WP_TESTS_CONFIG_FILE_PATH', $runtime . '/wp-tests-config.php' );
define( 'WP_TESTS_PHPUNIT_POLYFILLS_PATH', $root . '/vendor/yoast/phpunit-polyfills' );
$includes = $runtime . '/wordpress-develop-' . $series . '/tests/phpunit/includes';
require_once $includes . '/functions.php';
tests_add_filter( 'muplugins_loaded', function () use ( $runtime ) {
  $addon = $runtime . '/wordpress/wp-content/plugins/coldbox-addon/coldbox-addon.php';
  if ( file_exists( $addon ) ) {
    require $addon;
  }
} );
tests_add_filter( 'setup_theme', function () {
  switch_theme( 'coldbox' );
} );
require $includes . '/bootstrap.php';
