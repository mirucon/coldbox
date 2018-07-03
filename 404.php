<?php
/**
 * The template for displaying 404 not found pages
 *
 * @since 1.0.0
 * @package Coldbox
 */

get_header(); ?>

	<main id="main" role="main">

		<section class="main-inner">

			<?php get_template_part( 'parts/title-box' ); ?>

			<div class="container-outer">
				<div class="container">

					<div id="content" class="content">

						<div class="content-inner">

							<div class="error-messages">

								<p><?php esc_html_e( 'The page does not exist, or has been moved. Try search or use menus to find what you are looking for.', 'coldbox' ); ?></p>
								<?php get_search_form(); ?>

							</div>

						</div><!--/.content-->

					</div>

					<?php get_sidebar(); ?>

				</div><!--/.container-->
			</div><!--/.container-outer-->

		</section>

	</main>

<?php get_footer(); ?>
