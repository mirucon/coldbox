<?php
/**
 * The template for displaying the title part of the archive pages
 *
 * @since 1.0.0
 * @package Coldbox
 */

if ( is_category() ) : ?>
	<?php the_archive_title(); ?>
	<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>


<?php elseif ( is_tag() ) : ?>
	<?php the_archive_title(); ?>
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
	<?php the_archive_title(); ?>


<?php elseif ( is_month() ) : ?>
	<?php the_archive_title(); ?>


<?php elseif ( is_year() ) : ?>
	<?php the_archive_title(); ?>


<?php elseif ( is_author() ) : ?>
	<?php the_archive_title(); ?>
	<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>


<?php elseif ( is_404() ) : ?>
	<h1>
		<span class="title-description"><?php esc_html_e( 'ERROR 404.', 'coldbox' ); ?>&#32;</span>
		<?php esc_html_e( 'Sorry, Page Not Found.', 'coldbox' ); ?>
	</h1>

<?php endif; ?>
