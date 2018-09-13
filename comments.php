<?php
/**
 * The template for displaying comments
 *
 * @since 1.0.0
 * @package Coldbox
 */

if ( post_password_required() ) {
	return;
}
if ( have_comments() === false && comments_open() === false ) {
	return;
}
?>

<section id="comments" class="content-box">

	<?php if ( have_comments() ) : ?>

		<h2 class="comment-head content-box-heading"><?php comments_number( __( 'No Responses', 'coldbox' ), __( '1 Response', 'coldbox' ), __( '% Responses', 'coldbox' ) ); ?></h2>

		<?php
		$cd_comment_count = get_comments(
			array(
				'status'  => 'approve',
				'post_id' => get_the_ID(),
				'type'    => 'comment',
				'count'   => true,
			)
		);
		$cd_ping_count    = get_comments(
			array(
				'status'  => 'approve',
				'post_id' => get_the_ID(),
				'type'    => 'pings',
				'count'   => true,
			)
		);
		?>

		<ul class="comment-tabmenu">
			<li class="tabitem active">
				<a class="noscroll" href="#comment-list">
					<span class="fas fa-comment" aria-hidden="true"></span>
					<?php esc_html_e( 'Comments', 'coldbox' ); ?>
					<span class="count"><?php echo absint( $cd_comment_count ); ?></span>
				</a>
			</li>
			<li class="tabitem">
				<a class="noscroll" href="#ping-list">
					<span class="fas fa-share" aria-hidden="true"></span>
					<?php esc_html_e( 'Pingbacks', 'coldbox' ); ?>
					<span class="count"><?php echo absint( $cd_ping_count ); ?></span>
				</a>
			</li>
		</ul>

		<?php if ( ! empty( $comments_by_type['comment'] ) ) : ?>

			<ol id="comment-list">
				<?php
				wp_list_comments(
					array(
						'type'        => 'comment',
						'avatar_size' => 42,
					)
				);
				?>

				<?php if ( get_comment_pages_count() > 1 ) : ?>
					<div class="comment-pages">
						<?php
						paginate_comments_links(
							array(
								'prev_text' => '&laquo;',
								'next_text' => '&raquo;',
							)
						);
						?>
					</div>
				<?php endif; ?>
			</ol>

		<?php endif; ?>

		<?php if ( ! empty( $comments_by_type['pings'] ) ) : ?>
			<ol id="ping-list">
				<?php
				wp_list_comments(
					array(
						'type'        => 'pings',
						'avatar_size' => 50,
						'short_ping'  => true,
					)
				);
				?>
			</ol>
		<?php endif; ?>

	<?php endif; ?>

	<?php

	if ( comments_open() ) {
		comment_form(
			array(
				'submit_field'       => '<p class="form-submit">%1$s %2$s<span class="screen-reader-text">' . esc_html__( 'Post comment', 'coldbox' ) . '</span></p>',
				'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
				'title_reply_after'  => '</h2>',
			)
		);
	}
	?>

</section>
