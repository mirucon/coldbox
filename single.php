<?php get_header(); ?>

<?php while ( have_posts() ): the_post(); ?>
  <main id="main" class="main-single">
    <article id="post-<?php the_ID(); ?>" <?php post_class('main-inner'); ?>>

      <?php get_template_part('parts/title-box') ?>

      <div class="container-outer">
        <div class="container">

          <div class="content">

            <div class="content-inner">

              <footer class="post-meta content-box">
                <?php if ( has_post_format() ){ ?><span class="post-format"><?php echo get_post_format(); ?></span><?php } ?><?php if ( has_post_format('aside') ){ ?> <div class="post-date"><?php echo get_the_date(); ?></div><?php }
                if ( get_the_modified_time('c') != get_the_time('c') && cd_is_meta_modified() ) {
                  if ( cd_is_meta_date() ){ ?><span class="post-date"><?php echo get_the_date(); ?></span><?php } ?>
                  <time class="post-modified" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date(); ?></time>
                <?php }
                if ( get_the_modified_time('c') == get_the_time('c') && cd_is_meta_date() ) { ?>
                  <time class="post-date" datetime="<?php get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                <?php }
                if ( cd_is_meta_author() ){ ?><span class="post-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo $author = get_the_author(); ?></a></span><?php }
                if ( cd_is_meta_com() && comments_open() && cd_is_post_single_comment() ) { ?><span class="post-comment"><?php comments_popup_link('0', '1', '%'); ?></span><?php } ?>
              </footer>

              <div class="entry content-box">
                <div class="entry-inner"><?php the_content(); ?></div>
                <?php wp_link_pages( $defaults = array( 'before' => '<div class="post-pages">', 'after'=> '</div>', 'link_before' => '<span class="page-number">', 'link_after' => '</span>' ) ); ?>
                <div class="btm-post-meta">
                  <?php if ( cd_is_meta_btm_cat() ) { ?><p class="post-btm-cats"><span class="meta-label"><?php _e( 'Categories:', 'coldbox' ) ?></span><?php the_category('&#8203;'); ?> </p><?php } ?>
                  <?php if ( cd_is_meta_btm_tag() ) { the_tags( '<p class="post-btm-tags"> <span class="meta-label">' . __( 'Tags:', 'coldbox' ) . '</span>','',' </p>'); } ?>
                </div>
              </div>

              <?php get_template_part('parts/sns-button');
              if ( cd_is_post_related() ) { get_template_part('parts/related-posts'); }
              if ( cd_is_post_single_comment() ) { comments_template( '/comments.php', true ); }
              if ( cd_is_post_nav() ) { get_template_part('parts/post-nav'); } ?>

            </div><!--/.content-->

          </div><!--/.content-inner-->

          <?php get_sidebar(); ?>

        </div><!--/.container-->
      </div><!--/.container-outer-->

    </article>
  </main>
<?php endwhile; ?>

<?php get_footer(); ?>
