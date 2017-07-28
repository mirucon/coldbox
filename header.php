<?php
/**
 * The template for displaying header
 *
 * @since 1.0.0
 * @package coldbox
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="<?php echo esc_attr( get_theme_mod( 'link_color', '#00619f' ) ); ?>" name="theme-color">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header id="header" class="header">

		<div class="header-inner container">

			<div class="site-info">
				<h1 class="site-title">
					<?php cd_site_title(); ?>
				</h1>
				<?php if ( cd_is_site_desc() && display_header_text() ) : ?>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p>
				<?php endif; ?>
			</div>

			<div class="search-toggle"><span class="icon search"></span></div>
			<?php if ( has_nav_menu( 'header-menu' ) ) : ?>
				<div class="nav-toggle header-menu"><span class="top"></span><span class="middle"></span><span class="bottom"></span></div>
			<?php endif; ?>
			
			<?php if ( has_nav_menu( 'header-menu' ) ) : ?>
				<nav id="header-menu">
					<?php wp_nav_menu( array(
						'theme_location' => 'header-menu',
						'container' => '',
						'menu_class' => '',
						'fallback_cb' => 'wp_page_menu',
						'items_wrap' => '<ul id="header-nav" class="menu-container">%3$s</ul><!--/#header-nav-->',
					) ); ?>
				</nav>
			<?php endif; ?>

		</div>

</header>
