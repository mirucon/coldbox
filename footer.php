<?php 
/**
* The template for displaying footer
*
* @since 1.0.0
* @package coldbox
*/
?>

<footer id="footer">
	<div class="container">

		<div class="copyright">

			<p><?php echo wp_kses( cd_credit(), array( 'a' => array( 'href' => array (), 'onclick' => array (), 'target' => array() ), 'p' => array( 'style' => array (), 'align' => array (), 'target' => array() ), 'br' => array(), 'strong' => array(), 'b' => array(), 'small' => array(), ) ); ?></p>

			<?php if ( cd_is_theme_credit() ) : ?>
				<p><?php echo wp_kses( cd_theme_credit_text(), array( 'a' => array( 'href' => array (), 'onclick' => array (), 'target' => array() ), 'p' => array( 'style' => array (), 'align' => array (), 'target' => array() ), 'br' => array(), 'strong' => array(), 'b' => array(), 'small' => array(), ) ); ?></p>
			<?php endif; ?>

		</div>

		<?php cd_social_links();  ?>

	</div><!--/.container-->

	<a id="back-to-top" href="#"><span class="chevron-up"></span></a>

</footer>


<?php wp_footer(); ?>
</body></html>
