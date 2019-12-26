<?php
/**
 * Inner part of the index pages when selecting standard style
 *
 * @since 1.0.0
 * @package Coldbox
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inner">

		<figure class="post-thumbnail">
			<?php cd_standard_thumbnail( false ); ?>
		</figure>

		<div class="post-content">

			<div class="post-header">

				<h2 class="post-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>

				<p class="post-meta">
					<?php if ( cd_index_meta_date() ) : ?>
						<span class="post-date">
							<span class="far fa-clock" aria-hidden="true"></span>
							<span class="screen-reader-text"><?php esc_html_e( 'Published date', 'coldbox' ); ?></span>
							<?php echo get_the_date(); ?>
						</span>
					<?php endif; ?>

					<?php if ( 'post' === get_post_type() && cd_index_meta_cat() ) : ?>
						<span class="post-category">
							<span class="fas fa-folder" aria-hidden="true"></span>
							<span class="screen-reader-text"><?php esc_html_e( 'Categories', 'coldbox' ); ?></span>
							<?php the_category( ' / ' ); ?>
						</span>
					<?php endif; ?>

					<?php if ( comments_open() && cd_is_post_single_comment() && cd_index_meta_comment() ) : ?>
						<span class="post-comment">
							<span class="far fa-comment" aria-hidden="true"></span>
						<?php
							comments_popup_link(
								esc_html__( 'Comments: 0', 'coldbox' ),
								esc_html__( 'Comment: 1', 'coldbox' ),
								esc_html__( 'Comments: %', 'coldbox' )
							);
						?>
						</span>
					<?php endif; ?>
				</p>

				<?php if ( get_the_excerpt() !== '' ) : ?>
					<div class="post-excerpt"><?php the_excerpt(); ?></div>
				<?php endif; ?>

			</div>

			<p class="more">
				<a href="<?php the_permalink(); ?>">
					<?php
						printf(
							/* translators: 1: Post title (screen render text) */
							esc_html__( 'READ MORE%s', 'coldbox' ),
							'<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>'
						);
						?>
					<span class="fas fa-arrow-right more-icon" aria-hidden="true"></span>
				</a>
			</p>

		</div>

	</div><!--/.post-inner-->
</article>
