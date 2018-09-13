<?php
/**
 * Admin notices for the Coldbox theme
 *
 * @since 1.5.4
 * @package Coldbox
 */

/**
 * Notice of the Coldbox Ads Extension
 *
 * @since 1.5.4
 */
function cd_admin_notice_ads_extension() {

	if ( is_plugin_active( 'coldbox-ads-extension/coldbox-ads-extension.php' ) ) {
		return;
	}
	$meta = get_user_meta( get_current_user_id(), 'coldbox_dismissed_ads_ext', true );
	if ( $meta ) {
		return;
	}
	?>

	<div id="notice-coldbox-ads-extension" class="notice notice-coldbox-ads-extension notice-success is-dismissible">
		<p>
			<strong>
				<?php esc_html_e( 'We\'ve released new extension plugin!', 'coldbox' ); ?>
			</strong>
		</p>
		<p>
			<?php
				printf(
					/* translators: 1: opening a tag, 2: closing a tag */
					esc_html__(
						'Thanks for using the Coldbox theme! We have released an extension plugin called Coldbox Ads Extension for the easy Google AdSense management and getting high revenue with it.
					We believe this is the best choice to monetize your blog with the Coldbox theme. %1$sSee this article%2$s for more details.',
						'coldbox'
					),
					'<a href="' . esc_url( __( 'https://coldbox.miruc.co/addons/google-adsense-extension/', 'coldbox' ) ) . '">',
					'</a>'
				)
			?>
		</p>
		<p>
			<a href="<?php echo esc_url( __( 'https://coldbox.miruc.co/addons/google-adsense-extension/', 'coldbox' ) ); ?>">
				<?php esc_html_e( 'See more about the extension', 'coldbox' ); ?></a>
			<span> | </span>
			<a href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'coldbox-dismiss-ads', 'dismiss_admin_notice' ), 'coldbox-dismiss-ads-' . get_current_user_id() ) ); ?>" target="_parent">
				<?php esc_html_e( 'Dismiss this notice', 'coldbox' ); ?></a>
		</p>
	</div>
	<?php
}
add_action( 'admin_notices', 'cd_admin_notice_ads_extension' );

/**
 * Dismiss handler for the notice of Coldbox Ads Extension
 *
 * @since 1.5.4
 */
function cd_admin_notice_dismiss() {
	if ( isset( $_GET['coldbox-dismiss-ads'] ) && check_admin_referer( 'coldbox-dismiss-ads-' . get_current_user_id() ) ) {
		update_user_meta( get_current_user_id(), 'coldbox_dismissed_ads_ext', 1 );
	}
}
add_action( 'admin_head', 'cd_admin_notice_dismiss' );
