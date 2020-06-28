<?php
/**
 * The template for the Welcome page of the theme.
 *
 * @since 1.5.0
 * @package Coldbox
 */

/**
 * Adds a theme page called About Coldbox
 *
 * @since 1.5.0
 */
function cd_add_welcome_page() {
	add_theme_page(
		__( 'About Coldbox', 'coldbox' ),
		__( 'About Coldbox', 'coldbox' ),
		'edit_theme_options',
		'welcome.php',
		'cd_welcome_page_content'
	);
}
add_action( 'admin_menu', 'cd_add_welcome_page' );


/**
 * Loads a custom stylesheet for the welcome page.
 *
 * @since 1.5.0
 * @param string $hook Current location.
 */
function cd_enqueue_welcome_page_style( $hook ) {
	if ( 'appearance_page_welcome' !== $hook ) {
		return;
	}
	wp_enqueue_style( 'cd-welcome-page-style', get_theme_file_uri( 'assets/css/page-style.min.css' ), array(), CD_VER );
}
add_action( 'admin_enqueue_scripts', 'cd_enqueue_welcome_page_style' );

/**
 * Defines the content of the welcome page.
 *
 * @since 1.5.0
 */
function cd_welcome_page_content() {
	?>
	<header class="cdAdmin__header">
		<h1 class="cdAdmin__themeName"><?php echo esc_html( /* translators: %s: Theme version */ sprintf( esc_html__( 'Welcome to Coldbox %s', 'coldbox' ), CD_VER ) ); ?></h1>
		<div class="cdAdmin__screenshot">
			<img src="<?php echo esc_url( get_theme_file_uri( 'screenshot.jpg' ) ); ?>" width="1200" height="900" alt="<?php esc_attr_e( 'Theme screenshot', 'coldbox' ); ?>">
		</div>
	</header>

	<div class="cdAdmin__section">
		<h2 class="cdAdmin__h2"><?php esc_html_e( 'Getting Started', 'coldbox' ); ?></h2>
		<p><?php esc_html_e( 'Thanks so much for using the Coldbox theme! Here are some quick tips to help you get started with the theme.', 'coldbox' ); ?></p>
		<p>
			<?php
				echo wp_kses_data(
					sprintf(
						/* translators: %1$s: Opening strong tag, %2$s Closing strong tag, %3$s: Opening a tag, %4$s Closing a tag */
						__( '%1$sIf you have just switched from other theme%2$s, we recommend you to regenerate all of your thumbnails with the %3$sRegenerate Thumbnails%4$s plugin. It will create consistent sizes of your thumbnails, with the appropriate size for this theme.', 'coldbox' ),
						'<strong>',
						'</strong>',
						'<a href="' . esc_url( home_url() . '/wp-admin/plugin-install.php?s=regenerate+thumbnails&tab=search&type=term' ) . '">',
						'</a>'
					)
				);
			?>
		</p>
		<p>
			<?php
				echo wp_kses_data(
					sprintf(
						/* translators: %1$s: Opening strong tag, %2$s Closing strong tag */
						__( '%1$sIf you just started your WordPress life with this theme%2$s, then there\'s no need to regenerate thumbnails. The theme will automatically create the appropriate size of your thumbnail every time you set a new thumbnail image.', 'coldbox' ),
						'<strong>',
						'</strong>'
					)
				);
			?>
		</p>

		<p>
			<?php
				echo wp_kses_data(
					sprintf(
						/* translators: %1$s: Opening a tag of customizer link, %2$s Closing a tag, %3$s: Opening strong tag, %4$s Closing strong tag */
						__( 'Once you have regenerated the thumbnails, go ahead to the %1$sTheme Customizer%2$s to customize the theme as you like. Sections whose name started with "%3$sColdbox:%4$s" are the settings we have added for you to customize. Don\'t forget, there\'s also a section called Colors so you can customize some colors used in the theme.', 'coldbox' ),
						'<a href="' . esc_url( admin_url( 'customize.php' ) ) . '">',
						'</a>',
						'<strong>',
						'</strong>'
					)
				);
			?>
		</p>
	</div>

	<div class="cdAdmin__section">
		<h2 class="cdAdmin__h2"><?php esc_html_e( 'The Add-on Plugin', 'coldbox' ); ?></h2>
		<p>
			<?php esc_html_e( 'We are also developing the Addon plugin called Coldbox Addons, which is created and designed just for the Coldbox theme. We highly recommend you to always use the plugin to make the most of the theme. The latest version of the plugin has the following features: ', 'coldbox' ); ?>
		</p>
		<ul>
			<li><?php esc_html_e( 'Automatic AMP pages generation', 'coldbox' ); ?></li>
			<li><?php esc_html_e( 'Share buttons', 'coldbox' ); ?></li>
			<li><?php esc_html_e( 'Google Analytics integration', 'coldbox' ); ?></li>
			<li><?php esc_html_e( 'Automatic Open Graph Tag output', 'coldbox' ); ?></li>
		</ul>

		<?php
		if ( is_plugin_active( 'coldbox-addon/coldbox-addon.php' ) ) {
			?>
			<p><strong><?php esc_html_e( 'Great, you have already installed and activated the addon plugin! To customize some settings related to the addon plugin, go to the Theme Customizer.', 'coldbox' ); ?></strong></p>
			<?php
		} else {
			?>
			<p><?php esc_html_e( 'You have not installed or activated the addon plugin yet. Click the link below to proceed installing the plugin!', 'coldbox' ); ?></p>
			<a href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ); ?>" class="cdAdmin__button">
				<?php esc_html_e( 'Install Now', 'coldbox' ); ?>
			</a>
			<?php
		}
		?>
	</div>

	<div class="cdAdmin__section">
		<h2 class="cdAdmin__h2"><?php esc_html_e( 'Coldbox Ads Extension Plugin', 'coldbox' ); ?></h2>
		<p>
			<?php
				esc_html_e(
					'We\'ve developed an extension plugin for the Google AdSense ads for the Coldbox theme users. The plugin gives you the great experiences and engagements on Google AdSense without writing code at all.
				This currently supports in-article, in-feed, matched content, responsive ads, and the auto-ads settings with one-click. See the below article for more information:',
					'coldbox'
				);
			?>
		</p>

		<p>
			<a href="<?php echo esc_url( __( 'https://coldbox.miruc.co/addons/google-adsense-extension/', 'coldbox' ) ); ?>" class="cdAdmin__button">
				<?php esc_html_e( 'About the Coldbox Ads Extension', 'coldbox' ); ?>
			</a>
		</p>

		<?php
		if ( is_plugin_active( 'coldbox-ads-extension/coldbox-ads-extension.php' ) ) {
			?>
			<p>
				<strong>
					<?php
						esc_html__( 'Thanks for purchasing the ads extension plugin! If you need help about how to set up the ads, please contact me from the contact information below.', 'coldbox' );
					?>
				</strong>
			</p>
			<?php
		}
		?>
	</div>

	<div class="cdAdmin__section">
		<h2 class="cdAdmin__h2"><?php esc_html_e( 'Need Help?', 'coldbox' ); ?></h2>
		<p>
			<?php
				echo wp_kses_data(
					sprintf(
						/* translators: %1$s: forum link, %2$s: Opening a tag, %3$s: Closing a tag */
						__( 'If you need help with the theme, you can simply ask your query on the %1$s, or %2$s email me%3$s. Please also feel free to get in touch if you think you found a bug, or have a new feature request.', 'coldbox' ),
						'<a href="https://wordpress.org/support/theme/coldbox/">' . esc_html__( 'forum', 'coldbox' ) . '</a>',
						'<a href="mailto:i@miruc.co">',
						'</a>'
					)
				);

				echo ' ';
				esc_html_e(
					'Please first consider to post your question on the forum, as posting on forum can help the other users having the same problem. Email me if you want to share images with me or your question is private.',
					'coldbox'
				);
			?>
		</p>
		<p>
			<?php
				printf(
					/* translators: 1: Opening a tag, 2: Closing a tag */
					esc_html__(
						'If you are a developer, submitting an issue or pull request %1$son the GitHub repository%2$s is always welcome.',
						'coldbox'
					),
					'<a href="https://github.com/mirucon/coldbox" target="_blank" rel="nofollow">',
					'</a>'
				);
			?>
		</p>
	</div>

	<div class="cdAdmin__section">
		<h2 class="cdAdmin__h2"><?php esc_html_e( 'Rate this theme!', 'coldbox' ); ?></h2>
		<p>
			<?php
				echo wp_kses_data(
					sprintf(
						/* translators: %1$s: Link to this theme's review page on WP.org, %2$s: Closing a tag */
						__( 'If you liked this theme, please %1$spost your review on WordPress.org%2$s! Reviews definitely help to motivate me to continue support on this theme.', 'coldbox' ),
						'<a href="https://wordpress.org/support/theme/coldbox/reviews/#new-post">',
						'</a>'
					)
				);
			?>
		</p>
	</div>

	<?php
	if ( -1 === version_compare( phpversion(), '7.2.0' ) ) {
		?>
		<div id="upgrade-php" class="cdAdmin__section">
			<h2 class="cdAdmin__h2"><?php esc_html_e( 'Upgrade Your PHP!', 'coldbox' ); ?></h2>
			<p>
				<?php
					$allowed_html = array(
						'a' => array(
							'href',
						),
					);
					echo wp_kses(
						sprintf(
							/* translators: %1$s: PHP version, %2$s: Opening a tag, %3$s: Closing a tag. */
							__( 'We\'ve detected you are using PHP version %1$s which has already been unmaintained. Although WordPress core and the Coldbox theme still supports your PHP version, using unmaintained version of PHP means you have a big security risk. Please consider to upgrade your PHP version to PHP 7.2 or greater for the maximum compatibility (including theme, plugins and WordPress core) and your security. WordPress recommends you to use PHP 7.4 or greater. See %2$sRequirements %3$s on WordPress.org.', 'coldbox' ),
							phpversion(),
							'<a href="' . esc_url( __( 'https://wordpress.org/about/requirements/', 'coldbox' ) ) . '">',
							'</a>'
						),
						$allowed_html
					);
				?>
			</p>
		</div>
		<?php
	}
	?>

	<?php
		$upgrade_notices = array(
			array(
				'version'     => esc_html__( 'v1.9.0', 'coldbox' ),
				'description' =>
								sprintf(
									/* translators: This text shows as a upgrade notice of v1.9.0. / placeholders: 1: Starting a tag, 2: Ending a tag. */
									esc_html__(
										'Finally, the theme is fully compatible with the Gutenberg Block Editor! To find out how you can use the Block Editor with the Coldbox theme, please see the %1$sdemo pages%2$s. If you still see something is broken or looks not so nice, please let me know.',
										'coldbox'
									),
									'<a href="https://coldbox.miruc.co/demo/category/block/">',
									'</a>'
								)
							. '<br/>' .
								/* translators: This text shows as a upgrade notice of v1.9.0. */
								esc_html__(
									'Note: At this time, the AMP feature in my addon plugin does not support Block Editor yet. If you want to use the Block Editor\'s features a lot (like columns, buttons, or gallery), please disable generating the AMP pages as a workaround.',
									'coldbox'
								),
			),

			array(
				'version'     => esc_html__( 'v1.8.4', 'coldbox' ),
				'description' => esc_html__( 'I\'ve fixed a major issue that the grid column width for desktop/tablet option was always applied, even for mobile. The bug was introduced in v1.8.3 and affected users who have set the option other than 2. Sorry for the inconvenience this has caused.', 'coldbox' ),
			),
			array(
				'version'     => esc_html__( 'v1.8.0', 'coldbox' ),
				'description' => esc_html__( 'In this version, I made a fix that causing search and menu toggle button not working which affected number of users. The theme now requires WordPress version 5.0 or higher.', 'coldbox' ),
			),
			array(
				'version'     => esc_html__( 'v1.7.1', 'coldbox' ),
				'description' => esc_html__( 'Font Awesome icon fonts have been upgraded to version 5.7.0. There shouldn\'t be any breaking changes, but some icons have been added. Also added Telegram social button on the Social Links feature :)', 'coldbox' ),
			),
			array(
				'version'     => esc_html__( 'v1.7.0', 'coldbox' ),
				'description' => esc_html__( 'The Font Awesome icon fonts have been upgraded to version 5.2.0 for better compatibility with other plugins which use Font Awesome version 5. If you use Font Awesome font in your content, some changes might be required.', 'coldbox' ),
			),
			array(
				'version'     => esc_html__( 'v1.5.4', 'coldbox' ),
				'description' => esc_html__( 'I\'ve added the option to show thumbnail image on every single post which have been requested quite a few times!', 'coldbox' ),
			),
			array(
				'version'     => esc_html__( 'v1.5.3', 'coldbox' ),
				'description' => esc_html__( 'Feedly has changed its URL format. If you have Feedly subscription button in your Social Links, make sure to use the URL shown in the bottom of the "Social Links" section in the Customizer.', 'coldbox' ),
			),
			array(
				'version'     => esc_html__( 'v1.5.0', 'coldbox' ),
				'description' => esc_html__( 'In the version 1.5.0, we have added a new customizer option to adjust your logo width, and its default value has been set to 230px. If you are previously using the logo that the width is bigger than 230px, then your logo is now become smaller. To customize the width, go to the Theme Customizer, and proceed to "Coldbox: Header Settings" > "Custom Logo Width".', 'coldbox' ),
			),
		);
		?>

	<div id="upgrade-notice" class="cdAdmin__section">
		<h2 class="cdAdmin__h2"><?php esc_html_e( 'Upgrade Notice', 'coldbox' ); ?></h2>

		<?php
		foreach ( $upgrade_notices as $notice ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<h3 class="cdAdmin__h3">' . $notice['version'] . '</h3>';
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<p>' . $notice['description'] . '</p>';
		}
		?>

	<div class="cdAdmin__section">
		<h2 class="cdAdmin__h2"><?php esc_html_e( 'Changelog', 'coldbox' ); ?></h2>
	</div>

	<?php
	ob_start();
	require_once get_theme_file_path( 'assets/html/CHANGELOG.html' );
	$changelog = ob_get_contents();
	ob_end_clean();

	echo wp_kses_post( $changelog ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Adds "Coldbox" info to the admin bar.
 *
 * @param string $wp_admin_bar Menu item to add.
 */
function cd_customize_admin_bar_menu( $wp_admin_bar ) {
	if ( ! current_user_can( 'edit_theme_options' ) || ! cd_show_theme_button() ) {
		return;
	}
	global $wp_admin_bar;
	$title = sprintf(
		/* translators: %s: Theme version  */
		esc_html__( 'Coldbox v%s', 'coldbox' ),
		CD_VER
	);
	$wp_admin_bar->add_menu(
		array(
			'parent' => 'top-secondary',
			'id'     => 'coldbox-link',
			'meta'   => array(),
			'title'  => $title,
			'href'   => admin_url( 'themes.php?page=welcome.php' ),
		)
	);
	$wp_admin_bar->add_menu(
		array(
			'parent' => 'coldbox-link',
			'id'     => 'coldbox-upgrade-notice',
			'meta'   => array(),
			'title'  => esc_html__( 'Upgrade Notices', 'coldbox' ),
			'href'   => admin_url( 'themes.php?page=welcome.php#upgrade-notice' ),
		)
	);
}
add_action( 'admin_bar_menu', 'cd_customize_admin_bar_menu' );
