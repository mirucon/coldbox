<?php
/**
 * The template for displaying title box of each pages
 *
 * @since 1.0.0
 * @package Coldbox
 */

if ( is_single() && ! is_attachment() ) {
	?>
	<header class="title-box">
		<div class="title-box-inner container">
			<div class="breadcrumb"><?php cd_breadcrumb(); ?></div>
			<h1 class="post-title"><?php the_title(); ?></h1>
		</div>
	</header>
	<?php
} elseif ( is_attachment() ) {
	?>
	<header class="title-box">
		<div class="title-box-inner container">
			<div class="breadcrumb"><?php cd_breadcrumb(); ?></div>
			<h1 class="post-title"><?php the_title(); ?></h1>
		</div>
	</header>
	<?php
} elseif ( is_archive() ) {
	?>
	<div class="title-box">
		<div class="title-box-inner container">
			<div class="breadcrumb"><?php cd_breadcrumb(); ?></div>
			<?php get_template_part( 'parts/page-title' ); ?>
		</div>
	</div>
	<?php
} elseif ( is_search() ) {
	?>
	<div class="title-box">
		<div class="title-box-inner container">
			<?php get_template_part( 'parts/page-title' ); ?>
		</div>
	</div>
	<?php
} elseif ( is_404() ) {
	?>
	<div class="title-box">
		<div class="title-box-inner container">
			<?php get_template_part( 'parts/page-title' ); ?>
		</div>
	</div>
	<?php
} // End if.
