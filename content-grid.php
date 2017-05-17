<article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
  <div class="post-inner flex-column">

    <a class="post-link" href="<?php the_permalink(); ?>">

      <div class="post-thumbnail"><figure>
        <?php if ( has_post_thumbnail() ): ?>
          <?php the_post_thumbnail('thumb-medium'); ?>
        <?php else: ?>
          <img src="<?php echo get_template_directory_uri(); ?>/img/thumb-medium.png" alt="<?php the_title(); ?>">
        <?php endif; ?>
      </figure></div>

      <div class="post-content">
        <div class="post-date"><?php echo get_the_date(); ?></div>
        <h2 class="post-title"><?php echo get_the_title(); ?></h2>
        <?php if ( get_the_excerpt() != '' ): ?><div class="post-excerpt"><?php the_excerpt(); ?></div><?php endif; ?>
      </div>

    </a>

    <div class="post-meta">
      <span class="post-category"><?php the_category('/') ?></span>
      <?php if ( comments_open() && cd_is_post_single_comment() ) { ?><span class="post-comment"><?php comments_popup_link('Comments: 0', 'Comment: 1', 'Comments: %'); ?></span><?php } ?>
    </div>

  </div><!--/.post-inner-->
</article>
