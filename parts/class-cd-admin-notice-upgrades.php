<?php
/**
 * Class file for Cd_Admin_Notice_Upgrades.
 *
 * @since   1.9.0
 * @package Coldbox
 */

/**
 * Handles upgrade notice.
 *
 * @since 1.9.0
 */
class Cd_Admin_Notice_Upgrades {
	/**
	 * Cd_Admin_Notice_Upgrades constructor.
	 */
	public function __construct() {
		add_action( 'upgrader_process_complete', array( $this, 'store_upgrade_information_on_metadata' ), 10, 2 );
		add_action( 'admin_notices', array( $this, 'show_upgrade_notice' ) );
		add_action( 'admin_head', array( $this, 'dismiss_upgrade_notice' ) );
	}

	/**
	 * When an update is fired and updating the coldbox theme, store the upgraded version to show notice.
	 *
	 * @param \WP_Upgrader $upgrader Upgrader. Returned by hook.
	 * @param mixed[]      $info     Extra information of the update.
	 */
	public function store_upgrade_information_on_metadata( WP_Upgrader $upgrader, $info ) {
		if ( ! $upgrader instanceof Theme_Upgrader ) {
			return;
		}

		if ( ! ( 'update' === $info['action'] && 'theme' === $info['type'] ) ) {
			return;
		}

		if ( array_search( 'coldbox', $info['themes'], true ) === false ) {
			return;
		}

		update_user_meta( get_current_user_id(), $this->get_dismissing_meta_key_for_upgrade(), '0' );
	}

	/**
	 * Show upgrade notice on admin when update happens.
	 */
	public function show_upgrade_notice() {
		$meta = get_user_meta( get_current_user_id(), $this->get_dismissing_meta_key_for_upgrade(), true );
		if ( '0' !== $meta ) {
			return;
		}

		$version = $this->get_current_theme_version();
		?>

		<div
						id="notice-coldbox-upgrade"
						class="notice notice-coldbox-upgrade notice-success is-dismissible"
		>
			<p>
				<strong>
					<?php
					echo esc_html(
						sprintf(
									/* translators: %s: Version number. */
							__( 'Coldbox theme has been upgraded to %s!', 'coldbox' ),
							$version
						)
					);
					?>
				</strong>
			</p>
			<p>
				<?php
				printf(
				/* translators: %s: Page link to About Coldbox page. */
					esc_html__(
						'Your theme has just been updated. Please check the %s page to see what has been changed in this version.',
						'coldbox'
					),
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					$this->get_page_link_text_for_about_coldbox()
				)
				?>
			</p>
			<p>
				<?php
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo $this->get_page_link_text_for_about_coldbox();
				?>
				<span> | </span>
				<a
								href="
								<?php
								echo esc_url(
									wp_nonce_url(
										add_query_arg(
											'coldbox-dismiss-upgrade-notice',
											'dismiss_admin_notice'
										),
										'coldbox-dismiss-upgrade-notice-' . get_current_user_id()
									)
								);
								?>
												"
								target="_parent"
				>
					<?php esc_html_e( 'Dismiss this notice', 'coldbox' ); ?></a>
			</p>
		</div>
		<?php
	}

	/**
	 * Dismiss handler for the notice of Coldbox upgrade.
	 *
	 * @since 1.9.0
	 */
	public function dismiss_upgrade_notice() {
		if (
						isset( $_GET['coldbox-dismiss-upgrade-notice'] )
						&& check_admin_referer( 'coldbox-dismiss-upgrade-notice-' . get_current_user_id() )
		) {
			update_user_meta( get_current_user_id(), $this->get_dismissing_meta_key_for_upgrade(), '1' );
		}
	}

	/**
	 * Returns page link to the about coldbox theme.
	 *
	 * @since 1.9.0
	 */
	private function get_page_link_text_for_about_coldbox() {
		$link = esc_url( admin_url( 'themes.php?page=welcome.php' ) );

		return '<a href="' . $link . '">' . esc_html__( 'About Coldbox', 'coldbox' ) . '</a>';
	}

	/**
	 * Returns dismissing meta key for upgrades.
	 *
	 * @since 1.9.0
	 */
	private function get_dismissing_meta_key_for_upgrade() {
		return 'coldbox_dismissed_upgrade_' . $this->get_current_theme_version();
	}

	/**
	 * Returns current (means upgraded) version of the theme.
	 *
	 * @since 1.9.0
	 */
	private function get_current_theme_version() {
		$theme = wp_get_theme( 'coldbox' );

		return $theme->get( 'Version' );
	}
}

new Cd_Admin_Notice_Upgrades();
