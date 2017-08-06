<?php
/**
 * The template for displaying footer
 *
 * @since 1.0.0
 * @package coldbox
 */

if ( cd_is_amp() ) :
	cd_addon_amp_footer();
else :
?>

<footer id="footer" class="footer">
	<div class="container">

		<div class="copyright">

			<p>
				<?php
				echo wp_kses(
					cd_credit(), array(
						'a' => array(
							'href' => array(),
							'onclick' => array(),
							'target' => array(),
						),
						'p' => array(
							'style' => array(),
							'align' => array(),
							'target' => array(),
						),
						'br' => array(),
						'strong' => array(),
						'b' => array(),
						'small' => array(),
					)
				);
				?>
			</p>

			<?php if ( cd_is_theme_credit() ) : ?>
				<p>
					<?php
					echo wp_kses(
						cd_theme_credit_text(), array(
							'a' => array(
								'href' => array(),
								'onclick' => array(),
								'target' => array(),
							),
							'p' => array(
								'style' => array(),
								'align' => array(),
								'target' => array(),
							),
							'br' => array(),
							'strong' => array(),
							'b' => array(),
							'small' => array(),
						)
					);
					?>
				</p>
			<?php endif; ?>

		</div>

		<?php cd_social_links(); ?>

	</div><!--/.container-->

	<a id="back-to-top" class="noscroll" href="#"><span class="chevron-up"></span></a>

</footer>

<div class="modal-search-form"><?php get_search_form(); ?><div class="close-toggle"><span class="top"></span><span class="bottom"></span><span class="label">Close</span></div></div>


<?php wp_footer(); ?>
</body></html>

<?php endif; ?>
