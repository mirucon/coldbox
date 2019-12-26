<?php
/**
 * The template for displaying single articles.
 *
 * @since 1.0.0
 * @package Coldbox
 */

get_header(); ?>

<?php
while ( have_posts() ) :
	the_post();
	?>

	<main id="main" class="main-single" role="main">

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'main-inner' ); ?>>

			<?php get_template_part( 'parts/title-box' ); ?>

			<div class="container-outer">

				<div class="container">

					<div id="content" class="content">

						<div class="content-inner">

							<div class="content-inside">

								<footer class="post-meta content-box">

									<?php if ( has_post_format() ) : ?>
										<span class="post-format">
											<span class="<?php echo esc_attr( cd_post_format_icon( get_post_format() ) ); ?>" aria-hidden="true"></span>
											<?php echo esc_html( get_post_format() ); ?>
										</span>
									<?php endif; ?>

									<?php // If the modified date and the published date are NOT same and showing modified date, show both published and modified dates. ?>
									<?php if ( get_the_modified_time( 'c' ) !== get_the_time( 'c' ) && cd_is_meta_modified() ) : ?>

										<?php if ( cd_is_meta_date() ) : ?>
											<p class="post-date-wrapper">
												<span class="far fa-clock" aria-hidden="true"></span>
												<span class="screen-reader-text"><?php esc_html_e( 'Published date', 'coldbox' ); ?></span>
												<time class="post-date" datetime="<?php the_date( 'c' ); ?>"><?php echo esc_html( get_the_date( get_option( 'date_format' ) ) ); ?></time>
											</p>
										<?php endif; ?>
										<p class="post-modified-wrapper">
											<span class="fas fa-history" aria-hidden="true"></span>
											<span class="screen-reader-text"><?php esc_html_e( 'Last modified date', 'coldbox' ); ?></span>
											<time class="post-modified" datetime="<?php the_modified_time( 'c' ); ?>"><?php the_modified_date(); ?></time>
										</p>

										<?php // If the modified date and the published date are NOT same and NOT showing modified date, only show the published date. ?>
									<?php elseif ( get_the_modified_time( 'c' ) !== get_the_time( 'c' ) && ! cd_is_meta_modified() ) : ?>

										<?php if ( cd_is_meta_date() ) : ?>
											<p class="post-date-wrapper">
												<span class="far fa-clock" aria-hidden="true"></span>
												<span class="screen-reader-text"><?php esc_html_e( 'Published date', 'coldbox' ); ?></span>
												<time class="post-date" datetime="<?php the_date( 'c' ); ?>"><?php echo esc_html( get_the_date( get_option( 'date_format' ) ) ); ?></time>
											</p>
										<?php endif; ?>

										<?php // If the last modified date and the published date are same and showing either the modified or published date, show the date as published date. ?>
									<?php elseif ( get_the_modified_time( 'c' ) === get_the_time( 'c' ) && cd_is_meta_date() || cd_is_meta_modified() ) : ?>
										<p class="post-date-wrapper">
											<span class="far fa-clock" aria-hidden="true"></span>
											<span class="screen-reader-text"><?php esc_html_e( 'Published date', 'coldbox' ); ?></span>
											<time class="post-date" datetime="<?php the_date( 'c' ); ?>"><?php echo esc_html( get_the_date( get_option( 'date_format' ) ) ); ?></time>
										</p>

									<?php endif; ?>

									<?php if ( cd_is_meta_cat() ) : ?>
										<p class="post-category">
											<span class="fas fa-folder" aria-hidden="true"></span>
											<span class="screen-reader-text"><?php esc_html_e( 'Categories', 'coldbox' ); ?></span>
											<?php the_category( ' / ' ); ?>
										</p>
									<?php endif; ?>

									<?php if ( cd_is_meta_author() ) : ?>
										<p class="post-author">
											<span class="fas fa-user" aria-hidden="true"></span>
											<span class="screen-reader-text"><?php esc_html_e( 'Author', 'coldbox' ); ?></span>
											<?php the_author_posts_link(); ?>
										</p>
									<?php endif; ?>

									<?php if ( cd_is_meta_com() && comments_open() && cd_is_post_single_comment() ) : ?>
										<p class="post-comment">
											<span class="fas fa-comment" aria-hidden="true"></span>
											<?php
												comments_popup_link(
													esc_html__( 'Comments: 0', 'coldbox' ),
													esc_html__( 'Comment: 1', 'coldbox' ),
													esc_html__( 'Comments: %', 'coldbox' )
												);
											?>
										</p>
									<?php endif; ?>
								</footer>

								<?php if ( cd_is_thumbnail_image_shown() && has_post_thumbnail() ) : ?>
									<div class="entry-thumbnail-image content-box">
										<?php cd_large_thumbnail_template(); ?>
									</div>
								<?php endif; ?>


								<div class="entry content-box">
									<div class="entry-inner"><?php the_content(); ?></div>
									<?php
									$cd_defaults = array(
										'before'      => '<div class="post-pages">',
										'after'       => '</div>',
										'link_before' => '<span class="page-number">',
										'link_after'  => '</span>',
									);
									wp_link_pages( $cd_defaults );
									?>
									<div class="btm-post-meta">
										<?php if ( cd_is_meta_btm_cat() && ! is_attachment() ) : ?>
											<p class="post-btm-cats"><span class="meta-label"><?php esc_html_e( 'Categories:', 'coldbox' ); ?></span><?php the_category( '&#8203;' ); ?> </p>
										<?php endif; ?>
										<?php if ( cd_is_meta_btm_tag() ) : ?>
											<?php the_tags( '<p class="post-btm-tags"> <span class="meta-label">' . __( 'Tags:', 'coldbox' ) . '</span>', '', ' </p>' ); ?>
										<?php endif; ?>
									</div>
									<?php if ( cd_is_author_box() ) : ?>
										<?php get_template_part( 'parts/author-box' ); ?>
									<?php endif; ?>
								</div>


								<?php
								apply_filters( 'cd_single_after_contents', cd_single_after_contents() );
								if ( is_attachment() ) {
									apply_filters( 'cd_attachment_bottom_contents', cd_attachment_bottom_contents() ); // Call the bottom parts for single pages.
								} elseif ( is_single() ) {
									apply_filters( 'cd_single_bottom_contents', cd_single_bottom_contents() ); // Call the bottom parts for single articles.
								}
								?>


							</div><!--/.content-inside-->

						</div><!--/.content-inner-->

					</div><!--/.content-->

					<?php get_sidebar(); ?>

				</div><!--/.container-->

			</div><!--/.container-outer-->

		</article>

	</main>

<?php endwhile; ?>

<?php get_footer(); ?>
