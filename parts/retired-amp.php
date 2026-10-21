<?php
/**
 * Retired Coldbox AMP query URLs continue to reach the ordinary page.
 * Shared with Coldbox Add-ons so either package can be upgraded first.
 */
if ( ! function_exists( 'cd_retired_amp_url' ) ) {
	function cd_retired_amp_url() {
		if ( is_admin() || ! is_singular() || ! isset( $_GET['amp'] ) || '1' !== $_GET['amp'] ) {
			return false;
		}
		// Keep pagination and other query arguments; use WP's site host, not HTTP_HOST.
		$request = wp_unslash( $_SERVER['REQUEST_URI'] ?? '' );
		$parts   = wp_parse_url( $request );
		if ( ! is_array( $parts ) || empty( $parts['path'] ) ) {
			return false;
		}
		$home = wp_parse_url( home_url( '/' ) );
		$url  = $home['scheme'] . '://' . $home['host'];
		$url .= isset( $home['port'] ) ? ':' . $home['port'] : '';
		$url .= '/' . ltrim( $parts['path'], '/' );
		$url .= isset( $parts['query'] ) ? '?' . $parts['query'] : '';
		return remove_query_arg( 'amp', $url );
	}
	function cd_redirect_retired_amp() {
		$url = cd_retired_amp_url();
		if ( $url && wp_safe_redirect( $url, 301, 'Coldbox' ) ) {
			exit;
		}
	}
	add_action( 'template_redirect', 'cd_redirect_retired_amp', 1 );
}
// Prevent discovery links from a still-installed, older Add-on release.
remove_action( 'wp_head', 'cd_addon_amp_meta' );
