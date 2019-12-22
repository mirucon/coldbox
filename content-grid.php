<?php
/**
 * Inner part of the index pages when selecting grid style
 *
 * @since 1.0.0
 * @package Coldbox
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'article' ); ?>>
	<div class="post-inner flex-column">

		<a class="post-link" href="<?php the_permalink(); ?>">

			<div class="post-thumbnail"><figure>
				<?php cd_middle_thumbnail_template( false ); ?>
			</figure></div>

			<div class="post-content">
				<?php if ( 'post' === get_post_type() && cd_index_meta_date() ) : ?>
					<div class="post-date"><?php echo get_the_date(); ?></div>
				<?php endif; ?>

				<h2 class="post-title"><?php the_title(); ?></h2>

				<?php if ( get_the_excerpt() !== '' ) : ?>
					<div class="post-excerpt"><?php the_excerpt(); ?></div>
				<?php endif; ?>
			</div>

		</a>

		<div class="post-meta">
			<?php if ( 'post' === get_post_type() && cd_index_meta_cat() ) : ?>
				<span class="post-category">
					<span class="far fa-folder" aria-hidden="true"></span>
					<span class="screen-reader-text"><?php esc_html_e( 'Categories', 'coldbox' ); ?></span>
					<?php the_category( '/' ); ?>
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
		</div>

	</div><!--/.post-inner-->
</article>
