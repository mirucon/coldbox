<?php
/**
 * The template for getting and display related posts from query
 *
 * @since 1.0.0
 * @package Coldbox
 */

// phpcs:disable
// TODO- Redesign the logic


$max_articles   = cd_single_related_max(); // Its value can be changed on the theme customizer.
$posts_per_page = get_option( 'posts_per_page' );

// Uses the value of posts per page option as the number of max articles if the number set on the customizer is fewer than posts per page option.
if ( $posts_per_page < $max_articles ) {
	$max_articles = $posts_per_page;
}

$tags    = wp_get_post_tags( $post->ID );
$tag_ids = array();

// Gets related posts by tags first.
if ( has_tag() ) {

	foreach ( $tags as $tag ) {
		array_push( $tag_ids, $tag->term_id );
	}

	$tag_args = array(
		'post__not_in'     => array( $post->ID ),
		'posts_per_page'   => $max_articles,
		'tag__in'          => $tag_ids,
		'orderby'          => 'rand',
		'suppress_filters' => false,
		'lang'             => get_locale(),
	);

	$related_posts       = get_posts( $tag_args );
	$posts_by_cats_count = count( $related_posts );

	// Get the post IDs that were got by tags, so that the IDs will not be included in the query of category.
	foreach ( $related_posts as $post_id ) {
		$related_posts_not_in_id[] = $post_id->ID;
	}
	$related_posts_not_in_id[] = $post->ID;
}

// If article has no tag, gets by categories.
if ( empty( $tags ) ) {

	$categories  = get_the_category( $post->ID );
	$category_id = array();

	foreach ( $categories as $category ) {
		array_push( $category_id, $category->cat_ID );
	}
	$cat_args            = array(
		'post__not_in'     => array( $post->ID ),
		'posts_per_page'   => $max_articles,
		'category__in'     => $category_id,
		'orderby'          => 'rand',
		'suppress_filters' => false,
		'lang'             => get_locale(),
	);
	$related_posts       = get_posts( $cat_args );
	$posts_by_cats_count = 0;

} elseif ( $max_articles > $posts_by_cats_count ) { // If it hasn't got enough articles by tags, then gets by categories as well.

	$categories  = get_the_category( $post->ID );
	$category_id = array();

	foreach ( $categories as $category ) {
		array_push( $category_id, $category->cat_ID );
	}

	$cat_args      = array(
		'post__not_in'     => $related_posts_not_in_id,
		'posts_per_page'   => ( $max_articles - $posts_by_cats_count ),
		'category__in'     => $category_id,
		'orderby'          => 'rand',
		'suppress_filters' => false,
		'lang'             => get_locale(),
	);
	$posts_by_cats = get_posts( $cat_args );

	$related_posts = array_merge( $related_posts, $posts_by_cats );
}

/**
 * Get the content of the `cd_related_posts_bottom` action and return true if it has been hooked.
 *
 * @return bool
 */
function cd_is_action_related_posts_bottom_hooked() {
	ob_start();
	do_action( 'cd_related_posts_bottom' );
	$content = ob_get_clean();
	if ( $content ) {
		return true;
	} else {
		return false;
	}
}
?>


<?php if ( count( $related_posts ) > 0 ) : ?>

	<section class="related-posts content-box">

		<h2 class="related-head content-box-heading"><?php esc_html_e( 'Related Posts', 'coldbox' ); ?></h2>
		<ul class="related-posts-list">


			<?php
			foreach ( $related_posts as $post ) :
				setup_postdata( $post );
				?>

				<li class="related-article">
					<article <?php post_class(); ?>>

						<figure class="post-thumbnail">
							<a href="<?php the_permalink(); ?>">
								<?php cd_middle_thumbnail( false ); ?>
							</a>
						</figure>

						<div class="post-content">
							<div class="post-category"><?php the_category( ' / ' ); ?></div>
							<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						</div>

					</article>
				</li>

			<?php endforeach; ?>

		</ul>

		<?php do_action( 'cd_related_posts_bottom' ); ?>

	</section>

<?php elseif ( cd_is_action_related_posts_bottom_hooked() ) : ?>

	<section class="related-posts content-box">

		<h4 class="related-head"><?php esc_html_e( 'Related Posts', 'coldbox' ); ?></h4>

		<?php do_action( 'cd_related_posts_bottom' ); ?>

	</section>

<?php endif; ?>

<?php wp_reset_postdata(); ?>
