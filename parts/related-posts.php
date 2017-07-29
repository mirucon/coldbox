<?php
/**
 * The template for getting and display related posts from query
 *
 * @since 1.0.0
 * @package coldbox
 */

$max_articles = cd_single_related_max();
$posts_per_page = get_option( 'posts_per_page' );

// Uses the value of posts per page option as max articles if it's fewer than the value set on theme customizer.
if ( $posts_per_page < $max_articles ) {
	$max_articles = $posts_per_page;
}

$tags = wp_get_post_tags( $post -> ID );
$tag_ids = array();

// Gets related posts by tags first.
if ( has_tag() ) {
	foreach ( $tags as $tag ) {
		array_push( $tag_ids, $tag -> term_id );
	}

	$tag_args = array(
		'post__not_in' => array( $post -> ID ),
		'posts_per_page' => $max_articles,
		'tag__in' => $tag_ids,
		'orderby' => 'rand',
	);

	$related_posts = get_posts( $tag_args );
	$posts_by_cats_count = count( $related_posts );
}

// If article has no tag, gets by categories.
if ( empty( $tags ) ) {
	$categories = get_the_category( $post -> ID );
	$category_id = array();

	foreach ( $categories as $category ) {
		array_push( $category_id, $category -> cat_ID );
	}

	$cat_args = array(
		'post__not_in' => array( $post -> ID ),
		'posts_per_page' => $max_articles,
		'category__in' => $category_id,
		'orderby' => 'rand',
	);
	$related_posts = get_posts( $cat_args );
	$posts_by_cats_count = 0;
} elseif ( $max_articles > $posts_by_cats_count ) { // If hasn't got enought articles by tags, also gets by categories.

	$categories = get_the_category( $post -> ID );
	$category_id = array();

	foreach ( $categories as $category ) {
		array_push( $category_id, $category -> cat_ID );
	}

	$cat_args = array(
		'post__not_in' => array( $post -> ID ),
		'posts_per_page' => ( $max_articles - $posts_by_cats_count ),
		'category__in' => $category_id,
		'orderby' => 'rand',
	);
	$posts_by_cats = get_posts( $cat_args );

	$related_posts = array_merge( $related_posts, $posts_by_cats );
} ?>


<?php if ( count( $related_posts ) > 0 ) : ?>

	<section class="related-posts content-box">

		<h4 class="related-head"><?php esc_html_e( 'Related Posts', 'coldbox' ); ?></h4>
		<ul class="related-posts-list">


			<?php foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>

				<li class="related-article">
					<article <?php post_class();?>>

						<figure class="post-thumbnail">
							<a href="<?php the_permalink(); ?>">
								<?php cd_middle_thumbnail(); ?>
							</a>
						</figure>

						<div class="post-content">
							<div class="post-category"><?php the_category( ' / ' ) ?></div>
							<h5 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
						</div>

					</article>
				</li>

			<?php endforeach; ?>

		</ul>

	</section>

<?php endif; ?>

<?php wp_reset_postdata(); ?>
