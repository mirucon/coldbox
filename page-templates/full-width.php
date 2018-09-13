<?php
/**
 * Template Name: Full Width Page
 *
 * @package coldbox
 * @since 1.2.0
 */

get_header(); ?>

<?php
while ( have_posts() ) :
	the_post();
	?>

	<main id="main" class="main-page" role="main">
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'main-inner' ); ?>>

			<header class="title-box">
				<div class="title-box-inner container">
					<div class="breadcrumb"><?php cd_breadcrumb(); ?></div>
					<h1 class="post-title">
						<?php the_title(); ?>
					</h1>
				</div>
			</header>


			<div class="container-outer">
				<div class="container">

					<div id="content" class="content">

						<div class="content-inner">

							<div class="content-inside">

								<?php if ( cd_pages_meta_date() || cd_pages_meta_author() || cd_pages_meta_comments_count() ) : ?>

									<div class="post-meta content-box">
										<?php if ( cd_pages_meta_date() ) : ?>
											<span class="post-date"><?php echo get_the_date(); ?></span>
										<?php endif; ?>

										<?php if ( cd_pages_meta_author() ) : ?>
											<span class="post-author"><?php the_author_posts_link(); ?></span>
										<?php endif; ?>

										<?php if ( cd_pages_meta_comments_count() && comments_open() && cd_is_post_single_comment() ) : ?>
											<span class="post-comment"><?php comments_popup_link( '0', '1', '%' ); ?></span>
										<?php endif; ?>
									</div>

								<?php endif; ?>

								<div class="entry content-box">
									<div class="entry-inner"><?php the_content(); ?></div>
									<?php
									$cd_defaults = array(
										'before'      => '<div class="post-pages">' . __( 'Pages:', 'coldbox' ),
										'after'       => '</div>',
										'link_before' => '<span class="page-number">',
										'link_after'  => '</span>',
									);
									wp_link_pages( $cd_defaults );
									?>
								</div>

								<?php
								// Call the bottom parts.
								apply_filters( 'cd_pages_bottom_contents', cd_pages_bottom_contents() );
								?>

							</div><!--/.content-inside-->

						</div><!--/.content-inner-->
					</div><!--/.content-->

				</div><!--/.container-->
			</div><!--/.container-outer-->

		</article>
	</main>
<?php endwhile; ?>

<?php get_footer(); ?>
