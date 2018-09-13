<?php
/**
 * The template for displaying footer
 *
 * @since 1.0.0
 * @package Coldbox
 */

if ( cd_is_amp() ) :
	cd_addon_amp_footer();
else :
	?>

<footer id="footer" class="footer" role="contentinfo">

	<?php if ( cd_get_number_of_footer_sidebar() ) : ?>

		<div class="footer-widget-area has-<?php echo absint( cd_get_number_of_footer_sidebar() ); ?>">

			<div class="container">

				<?php for ( $cd_i = 1; $cd_i <= 4; $cd_i++ ) : ?>

					<?php if ( is_active_sidebar( 'footer-' . $cd_i ) ) : ?>

						<aside id="footer-<?php echo absint( $cd_i ); ?>" class="footer-sidebar-container footer-s<?php echo absint( $cd_i ); ?>" role="complementary">

							<div class="footer-sidebar sidebar">

								<div class="sidebar-inner">

									<?php dynamic_sidebar( 'footer-' . $cd_i ); ?>

								</div>

							</div>

						</aside><!--/.sidebar-->

					<?php endif; ?>

				<?php endfor; ?>

			</div>

		</div>

	<?php endif; ?>

	<?php cd_footer_menu(); ?>

	<div class="footer-bottom">

		<div class="container">

			<div class="copyright">

				<p>
					<?php
					$cd_allowed_html = array(
						'a'      => array(
							'href'    => array(),
							'onclick' => array(),
							'target'  => array(),
						),
						'p'      => array(
							'style'  => array(),
							'align'  => array(),
							'target' => array(),
						),
						'br'     => array(),
						'strong' => array(),
						'b'      => array(),
						'small'  => array(),
					);
					?>

					<?php echo wp_kses( cd_credit(), $cd_allowed_html ); ?>

					<?php if ( function_exists( 'the_privacy_policy_link' ) && cd_is_privacy_policy_link_shown() ) : ?>
						<?php the_privacy_policy_link( ' / ', '<span role="separator" aria-hidden="true"></span>' ); ?>
					<?php endif; ?>

				</p>

				<?php if ( cd_is_theme_credit() ) : ?>
					<p>
						<?php echo wp_kses( cd_theme_credit_text(), $cd_allowed_html ); ?>
					</p>
				<?php endif; ?>

			</div>

			<?php cd_social_links(); ?>

		</div>

	</div><!--/.footer-bottom-->

	<a id="back-to-top" class="noscroll is-hidden back-to-top" href="#">
		<span class="chevron-up" aria-hidden="true"></span>
		<span class="screen-reader-text"><?php esc_html_e( 'Back To Top', 'coldbox' ); ?></span>
	</a>

</footer>

<div class="modal-search-form" id="modal-search-form" role="dialog" aria-modal="true">
	<?php get_search_form(); ?>

	<button class="close-toggle">
		<span class="top" aria-hidden="true"></span>
		<span class="bottom" aria-hidden="true"></span>
		<span class="label"><?php esc_html_e( 'Close', 'coldbox' ); ?></span>
	</button>
</div>

	<?php wp_footer(); ?>

</body></html>

<?php endif; ?>
