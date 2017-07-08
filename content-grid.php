<article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
  <div class="post-inner flex-column">

    <a class="post-link" href="<?php the_permalink(); ?>">

      <div class="post-thumbnail"><figure>
        <?php if ( has_post_thumbnail() ): ?>
          <?php the_post_thumbnail( 'cd-medium' ); ?>
        <?php else: ?>
          <img src="<?php echo esc_attr( get_template_directory_uri() . '/img/thumb-medium.png' ) ?>" alt="<?php the_title(); ?>">
        <?php endif; ?>
      </figure></div>

      <div class="post-content">
        <?php if ( cd_index_meta_cat() ): ?><div class="post-date"><?php echo get_the_date(); ?></div><?php endif; ?>
        <h2 class="post-title"><?php the_title(); ?></h2>
        <?php if ( get_the_excerpt() != '' ): ?><div class="post-excerpt"><?php the_excerpt(); ?></div><?php endif; ?>
      </div>

    </a>

    <div class="post-meta">
      <?php if ( get_post_type() === 'post' && cd_index_meta_cat() ) : ?><span class="post-category"><?php the_category('/') ?></span><?php endif; ?>
      <?php if ( comments_open() && cd_is_post_single_comment() && cd_index_meta_comment() ) { ?><span class="post-comment"><?php comments_popup_link( 'Comments: 0', 'Comment: 1', 'Comments: %' ); ?></span><?php } ?>
    </div>

  </div><!--/.post-inner-->
</article>
