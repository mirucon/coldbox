<?php
/**
 * The template for displaying previous/next posts links
 *
 * @since 1.0.0
 * @package coldbox
 */

?>

<nav class="post-nav">

	<ul>
		<?php
		$prev_post = get_previous_post();

		if ( $prev_post ) :

			$prevthumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $prev_post -> ID ), array( 600, 600 ), false, '' );

			if ( has_post_thumbnail( $prev_post ) ) : ?>
				<li class="prev"><?php previous_post_link( '%link', '<div class="post-thumbnail" style="background-image: url( ' . $prevthumbnail[0] . ' )"></div> <span class="chevron-left" aria-hidden="true"></span> <p class="nav-title">' . __( 'Prev Post', 'coldbox' ) . '</p> <p class="post-title">%title</p>' ); ?></li>
			<?php else : ?>
				<li class="prev"><?php previous_post_link( '%link', '<span class="chevron-left" aria-hidden="true"></span> <p class="nav-title">' . __( 'Prev Post', 'coldbox' ) . '</p> <p class="post-title">%title</p>' ); ?> </li>
			<?php endif; ?>

		<?php endif;

		$next_post = get_next_post();

		if ( $next_post ) :

			$nextthumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $next_post -> ID ), array( 600, 600 ), false, '' );

			if ( has_post_thumbnail( $next_post ) ) : ?>
				<li class="next"><?php next_post_link( '%link', '<div class="post-thumbnail" style="background-image: url( ' . $nextthumbnail[0] . ' )"></div> <span class="chevron-right" aria-hidden="true"></span> <p class="nav-title">' . __( 'Next Post', 'coldbox' ) . '</p> <p class="post-title">%title</p>' ); ?></li>
			<?php else : ?>
				<li class="next"><?php next_post_link( '%link', '<span class="chevron-right" aria-hidden="true"></span> <p class="nav-title">' . __( 'Next Post', 'coldbox' ) . '</p> <p class="post-title">%title</p>' ); ?></li>
			<?php endif; ?>

		<?php endif; ?>

	</ul>

</nav>
