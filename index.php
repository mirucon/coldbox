<?php
/**
 * The template for displaying index pages.
 *
 * @since 1.0.0
 * @package Coldbox
 */

get_header(); ?>

<main id="main" class="home">

	<div class="container-outer">

		<div class="container">

			<div class="content">

				<div class="content-inner <?php echo esc_attr( cd_index_style() ) . '-view'; ?>">

					<?php
					// Call the top parts.
					apply_filters( 'cd_archive_top_contents', cd_archive_top_contents() );
					?>

					<?php
					if ( have_posts() ) :
						$count = 0;
						while ( have_posts() ) :
							$count++;
							the_post();
						?>

						<?php if ( cd_index_style() === 'grid' ) : ?>
							<?php get_template_part( 'content', 'grid' ); ?>
						<?php elseif ( cd_index_style() === 'standard' ) : ?>
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
							<h2><?php esc_html_e( 'Posts Not Found!', 'coldbox' ); ?></h2>
						</div>

					<?php endif; ?>

				</div>

			</div><!--/.content-->

			<?php get_sidebar(); ?>

		</div>

	</div>

</main>

<?php get_footer(); ?>
