<?php
/**
 * Class file for Cd_Admin_Notice_New_Install.
 *
 * @since   1.9.0
 * @package Coldbox
 */

/**
 * Handles initial install notice.
 *
 * @since 1.9.0
 */
class Cd_Admin_Notice_New_Install {
	/**
	 * Cd_Admin_Notice_Upgrades constructor.
	 */
	public function __construct() {
		add_action( 'after_switch_theme', array( $this, 'store_switched_theme_information_on_metadata' ) );
		add_action( 'admin_notices', array( $this, 'show_new_install_notice' ) );
		add_action( 'admin_head', array( $this, 'dismiss_new_install_notice' ) );
	}

	/**
	 * When user's switching to the theme, store the info to show the notice in metadata.
	 */
	public function store_switched_theme_information_on_metadata() {
		update_user_meta( get_current_user_id(), $this->get_dismissing_meta_key_for_new_install(), '0' );
	}

	/**
	 * Show new install notice on admin.
	 */
	public function show_new_install_notice() {
		$meta = get_user_meta( get_current_user_id(), $this->get_dismissing_meta_key_for_new_install(), true );
		if ( '0' !== $meta ) {
			return;
		}

		?>


		<div
			id="notice-coldbox-new-install"
			class="notice notice-coldbox-upgrade notice-success is-dismissible"
		>
			<p>
				<strong>
					<?php
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo esc_html(
						__( 'Welcome to the Coldbox theme!', 'coldbox' )
					);
					?>
				</strong>
			</p>
			<p>
				<?php
				printf(
				/* translators: %s: Page link to About Coldbox page. */
					esc_html__(
						'Thanks for installing the Coldbox theme! Please visit the %s page to learn how to get started with the theme.',
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
											'coldbox-dismiss-new-install-notice',
											'dismiss_admin_notice'
										),
										'coldbox-dismiss-new-install-notice-' . get_current_user_id()
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
	 * Dismiss handler for the notice of Coldbox new install.
	 *
	 * @since 1.9.0
	 */
	public function dismiss_new_install_notice() {
		if (
			isset( $_GET['coldbox-dismiss-new-install-notice'] )
			&& check_admin_referer( 'coldbox-dismiss-new-install-notice-' . get_current_user_id() )
		) {
			update_user_meta( get_current_user_id(), $this->get_dismissing_meta_key_for_new_install(), '1' );
		}
	}

	/**
	 * Returns dismissing meta key for new installs.
	 *
	 * @since 1.9.0
	 */
	private function get_dismissing_meta_key_for_new_install() {
		return 'coldbox_dismissed_new_install';
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
}
new Cd_Admin_Notice_New_Install();
