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
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="<?php echo esc_attr( get_theme_mod( 'link_color', '#00619f' ) ); ?>" name="theme-color">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php endif; ?>

	<header id="header" class="header">

		<div class="header-inner container">

			<div class="site-info">

				<?php cd_site_title(); ?>

				<?php if ( cd_is_site_desc() && display_header_text() ) : ?>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p>
				<?php endif; ?>
			</div>

			<div class="search-toggle"><span class="icon search"></span></div>
			<?php if ( has_nav_menu( 'header-menu' ) ) : ?>
				<button class="nav-toggle header-menu" on="tap:amp-sidebar.open"><span class="top"></span><span class="middle"></span><span class="bottom"></span></button>
			<?php endif; ?>

			<?php cd_header_menu(); ?>

		</div>

</header>
