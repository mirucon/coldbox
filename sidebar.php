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
?>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

	<aside id="sidebar-s1" class="sidebar-s1" aria-label="<?php esc_attr_e( 'Sidebar', 'coldbox' ); ?>">

		<div class="sidebar">

			<div class="sidebar-inner">

				<?php dynamic_sidebar( 'sidebar-1' ); ?>

			</div>

		</div>

	</aside><!--/.sidebar-->

<?php endif; ?>
