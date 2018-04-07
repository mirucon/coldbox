<?php
/**
 * The template for displaying search results pages
 *
 * @since 1.0.0
 * @package Coldbox
 */

get_header(); ?>

<main id="main">

	<section class="main-inner">

		<?php get_template_part( 'parts/title-box' ); ?>

		<div class="container-outer">
			<div class="container">

				<div class="content">

					<div class="content-inner <?php echo esc_attr( cd_archive_style() ) . '-view'; ?>">

						<?php
						// Call the top parts.
						apply_filters( 'cd_archive_top_contents', cd_archive_top_contents() );
						?>

						<?php
						if ( have_posts() ) :
							while ( have_posts() ) :
								the_post();
							?>

							<?php if ( cd_archive_style() === 'grid' ) : ?>
								<?php get_template_part( 'content', 'grid' ); ?>
							<?php elseif ( cd_archive_style() === 'standard' ) : ?>
								<?php get_template_part( 'content', 'standard' ); ?>
							<?php endif; ?>

							<?php do_action( 'cd_archive_midst_content', $count ); ?>

						<?php endwhile; ?>

							<?php
							// Call the bottom parts.
							apply_filters( 'cd_archive_bottom_contents', cd_archive_bottom_contents() );
							?>

						<?php else : ?>

							<div class="error-messages">
								<h2><?php esc_html_e( 'No matches found.', 'coldbox' ); ?></h2>
							</div>

						<?php endif; ?>

					</div>

				</div><!--/.content-->

				<?php get_sidebar(); ?>

			</div><!--/.container-->
		</div><!--/.container-outer-->

	</section>

</main>

<?php get_footer(); ?>
