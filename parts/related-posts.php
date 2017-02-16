<?php
/* ------------------------------------------------------------------------- *
* Get Related Posts
* ------------------------------------------------------------------------- */
$categories = get_the_category($post->ID);
$category_ID = array();
foreach ( $categories as $category ) {
  array_push( $category_ID, $category -> cat_ID );
}
$args = array(
  'post__not_in' => array($post -> ID),
  'posts_per_page' => cd_single_related_max(), // You can change this value on the customizer.
  'category__in' => $category_ID,
  'orderby' => 'rand',
);
$query = new WP_Query($args); ?>

<?php if ( $query -> have_posts() ): ?>
  <section class="related-posts content-box">

    <h4 class="related-head"><?php _e( 'Related Posts', 'coldbox' ); ?></h4>
    <ul class="related-posts-list">
      <?php while ( $query -> have_posts() ): $query -> the_post(); ?>

        <li class="related-article">
          <article <?php post_class();?>>

            <figure class="post-thumbnail">
              <a href="<?php the_permalink(); ?>">
                <?php if ( has_post_thumbnail() ): ?>
                  <?php the_post_thumbnail('thumb-standard'); ?>
                <?php else: ?>
                  <img src="<?php echo get_template_directory_uri(); ?>/img/thumb-standard.png" alt="noimage">
                <?php endif; ?>
              </a>
            </figure>

            <div class="post-content">
              <div class="post-category"><?php the_category(' / ') ?></div>
              <h5 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            </div>

          </article>
        </a>
      </li>

    <?php endwhile;?>
  </ul>

</section>
<?php endif; ?>

<?php wp_reset_postdata(); ?>
