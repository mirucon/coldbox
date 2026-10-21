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

	<?php
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
}
add_action( 'admin_bar_menu', 'cd_customize_admin_bar_menu' );
