<?php
// Test-only endpoint installed by smoke.mjs into an ephemeral Playground.
require __DIR__ . '/wp-load.php';
$posts = get_posts( array( 'title' => 'Coldbox smoke fixture', 'numberposts' => 1 ) );
$post_id = $posts[0]->ID;
$mode = isset( $_GET['mode'] ) ? $_GET['mode'] : '';
if ( 'amp-off' === $mode ) {
	set_theme_mod( 'use_amp', false );
} elseif ( 'amp-excluded' === $mode ) {
	set_theme_mod( 'use_amp', true );
	set_theme_mod( 'no_amp_pages', (string) $post_id );
} elseif ( 'verification' === $mode ) {
	set_theme_mod( 'site_verification_code', 'coldbox-test"><script>coldboxInjected</script>' );
} elseif ( 'customizer' === $mode ) {
	wp_set_current_user( 1 );
	require_once ABSPATH . WPINC . '/class-wp-customize-manager.php';
	$manager = new WP_Customize_Manager();
	// The real Customizer creates its manager before the theme hooks register.
	$manager->register_controls();
	remove_action( 'customize_register', array( $manager, 'register_controls' ) );
	do_action( 'customize_register', $manager );
	echo wp_json_encode( array_keys( $manager->controls() ) );
	exit;
} elseif ( 'about' === $mode || 'notices' === $mode ) {
	wp_set_current_user( 1 );
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
	require_once get_theme_file_path( 'parts/about-coldbox.php' );
	require_once get_theme_file_path( 'parts/admin-notices.php' );
	if ( 'about' === $mode ) {
		cd_welcome_page_content();
	} else {
		do_action( 'admin_notices' );
		cd_admin_notice_ads_extension();
	}
	exit;
}
header( 'Content-Type: application/json' );
echo wp_json_encode( array(
	'wp' => $wp_version,
	'php' => PHP_VERSION,
	'theme' => get_stylesheet(),
	'plugins' => get_option( 'active_plugins' ),
	'post' => $post_id,
	'log' => file_exists( WP_CONTENT_DIR . '/debug.log' ) ? file_get_contents( WP_CONTENT_DIR . '/debug.log' ) : '',
) );
