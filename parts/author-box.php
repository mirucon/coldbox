<?php
/**
 * The template for displaying author meta box.
 *
 * @since 1.0.2
 * @package Coldbox
 */

?>

<div class="author-box">
	<div class="author-thumbnail">
		<?php cd_get_avatar(); ?>
	</div>
	<div class="author-content">
		<div class="author-infomation">
			<p class="author-name"><?php the_author_meta( 'display_name' ); ?></p>
			<div class="author-links">
				<?php
				if ( cd_is_links_on_author_box() ) :
					cd_social_links();
				endif;
				?>
			</div>
		</div>
		<p class="author-description"><?php the_author_meta( 'description' ); ?></p>
	</div>
</div>
