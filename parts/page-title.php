<?php
/**
 * The template for displaying the title part of the archive pages
 *
 * @since 1.0.0
 * @package coldbox
 */

if ( is_category() ) : ?>
	<h1><span class="title-description"><?php esc_html_e( 'Category:', 'coldbox' ); ?>&#32;</span><?php echo single_cat_title(); ?></h1>
	<?php if ( term_description() !== '' ) : ?>
		<div class="taxonomy-description">
			<?php echo term_description(); ?>
		</div>
	<?php endif; ?>


<?php elseif ( is_tag() ) : ?>
	<h1><span class="title-description"><?php esc_html_e( 'Tag:', 'coldbox' ); ?>&#32;</span><?php echo single_tag_title(); ?></h1>
	<?php if ( term_description() !== '' ) : ?>
		<div class="taxonomy-description">
			<?php echo term_description(); ?>
		</div>
	<?php endif; ?>


<?php elseif ( is_search() ) : ?>
	<h1><span class="title-description"><?php esc_html_e( 'Search Results for:', 'coldbox' ); ?>&#32;</span><?php the_search_query(); ?></h1>
		<div class="taxonomy-description">
			<?php get_search_form(); ?>
		</div>


	<?php elseif ( is_day() ) : ?>
		<h1><span class="title-description"><?php esc_html_e( 'Daily Archive:', 'coldbox' ); ?>&#32;</span><?php the_time( _x( 'jS F, Y', 'Date Format', 'coldbox' ) ); ?></h1>


	<?php elseif ( is_month() ) : ?>
		<h1><span class="title-description"><?php esc_html_e( 'Monthly Archive:', 'coldbox' ); ?>&#32;</span><?php the_time( _x( 'F, Y', 'Date Format', 'coldbox' ) ); ?></h1>


	<?php elseif ( is_year() ) : ?>
		<h1><span class="title-description"><?php esc_html_e( 'Yearly Archive:', 'coldbox' ); ?>&#32;</span><?php the_time( 'Y' ); ?></h1>


	<?php elseif ( is_author() ) : ?>
		<h1><span class="title-description"><?php esc_html_e( 'Author:', 'coldbox' ); ?>&#32;</span><?php the_author_meta( 'display_name' ); ?></h1>
		<?php if ( strlen( the_author_meta( 'description' ) ) > 0 ) : ?>
			<div class="taxonomy-description">
				<?php the_author_meta( 'description' ); ?>
			</div>
		<?php endif; ?>


	<?php elseif ( is_404() ) : ?>
		<h1><span class="title-description"><?php esc_html_e( 'ERROR 404.', 'coldbox' ); ?>&#32;</span><?php esc_html_e( 'Sorry, Page Not Found.', 'coldbox' ); ?></h1>

	<?php endif; ?>
