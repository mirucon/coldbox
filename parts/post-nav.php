<?php
/**
 * The template for displaying previous/next posts link
 *
 * @since 1.0.0
 * @package Coldbox
 */

?>

<nav class="post-nav">

	<ul>

		<?php

		$cd_prev_post = get_previous_post();

		if ( $cd_prev_post ) {

			echo '<li class="prev">';
			previous_post_link( '%link', '<div class="post-thumbnail"></div> <span class="chevron-left" aria-hidden="true"></span> <p class="nav-title">' . __( 'Prev Post', 'coldbox' ) . '</p> <p class="post-title">%title</p>' );
			echo '</li>';

		}

		$cd_next_post = get_next_post();

		if ( $cd_next_post ) {

			echo '<li class="next">';
			next_post_link( '%link', '<div class="post-thumbnail"></div> <span class="chevron-right" aria-hidden="true"></span> <p class="nav-title">' . __( 'Next Post', 'coldbox' ) . '</p> <p class="post-title">%title</p>' );
			echo '</li>';

		}

		?>

	</ul>

</nav>
