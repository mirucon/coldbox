<?php
/**
 * The template for displaying sidebar
 *
 * @since 1.0.0
 * @package Coldbox
 */

if ( 'hide' === cd_sidebar_stg() ) {
	return;
}
if ( function_exists( 'cd_is_amp' ) ) {
	if ( cd_is_amp() ) {
		return;
	}
} ?>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

	<aside id="sidebar-s1" class="sidebar-s1" role="complementary">

		<div class="sidebar">

			<div class="sidebar-inner">

				<?php dynamic_sidebar( 'sidebar-1' ); ?>

			</div>

		</div>

	</aside><!--/.sidebar-->

<?php endif; ?>
