<?php
/**
 * The template for displaying header
 *
 * @since 1.0.0
 * @package Coldbox
 */

if ( cd_is_amp() ) :
	cd_addon_amp_head();
else :
	?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="<?php echo esc_attr( get_theme_mod( 'link_color', '#00619f' ) ); ?>" name="theme-color">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<a class="skip-link screen-reader-text noscroll" href="#content">
	<?php esc_html_e( 'Skip to content', 'coldbox' ); ?>
</a>

<?php endif; ?>

	<header id="header" class="header" role="banner">

		<div class="header-inner container">

			<div class="site-info">

				<?php cd_site_title(); ?>

				<?php if ( cd_is_site_desc() ) : ?>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p>
				<?php endif; ?>
			</div>

			<?php
			$cd_nav_toggle    =
				'<button id="header-nav-toggle" class="nav-toggle header-menu" on="tap:amp-sidebar.open">
					<span class="top" aria-hidden="true"></span>
					<span class="middle" aria-hidden="true"></span>
					<span class="bottom" aria-hidden="true"></span>
					<span class="screen-reader-text">' . esc_html__( 'Menu', 'coldbox' ) . '</span>
				</button>';
			$cd_search_toggle =
				'<button class="search-toggle">
					<span class="icon search" aria-hidden="true"></span>
					<span class="screen-reader-text">' . esc_html__( 'Search Toggle', 'coldbox' ) . '</span>
				</button>';
			?>

			<?php if ( wp_is_mobile() ) : ?>

				<?php echo $cd_search_toggle; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

				<?php if ( has_nav_menu( 'header-menu' ) ) : ?>
					<?php echo $cd_nav_toggle; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?php endif; ?>

				<?php cd_header_menu(); ?>

			<?php else : ?>

				<?php cd_header_menu(); ?>

				<?php echo $cd_search_toggle; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

				<?php if ( has_nav_menu( 'header-menu' ) ) : ?>
					<?php echo $cd_nav_toggle; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?php endif; ?>

			<?php endif; ?>


		</div>

</header>
