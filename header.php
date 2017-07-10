<?php
/**
* The template for displaying header
*
* @since 1.0.0
* @package coldbox
*/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="<?php echo get_theme_mod( 'link_color' ); ?>" name="theme-color">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header id="header">

		<div class="header-inner container">

			<div class="site-info">
				<h1 class="site-title">
					<?php cd_site_title(); ?>
				</h1>
				<?php if ( cd_is_site_desc() ) : ?>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p>
				<?php endif; ?>
			</div>

			<div class="search-toggle"><span class="icon search"></span></div>
			<?php if ( has_nav_menu( 'header-menu' ) ) { ?><div class="nav-toggle header-menu"><span class="top"></span><span class="middle"></span><span class="bottom"></span></div><?php } ?>
			<?php if ( has_nav_menu( 'header-menu' ) ): ?>
				<nav id="header-menu">
					<?php wp_nav_menu( array( 'theme_location'=>'header-menu', 'container'=>'', 'menu_class'=>'', 'items_wrap'=>'<ul id="header-nav" class="menu-container">%3$s</ul>') ); ?>
				</nav>
			<?php endif; ?>
			<div class="header-searchbar"><?php get_search_form(); ?></div>

		</div>

</header>
