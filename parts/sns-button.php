<?php
/* ----------------------------------------------------------------------------- *
*  SNS Button
*  Need to install "SNS Count Cache" Plugin
*  Followed SNS : Twitter, Hatena Bookmark, Facebook, Google Plus, Pocket, Feedly.
* ------------------------------------------------------------------------------ */

if ( function_exists( 'scc_get_share_total' ) && cd_use_snsb() ) :
  wp_enqueue_style ( 'icomoon', get_template_directory_uri() . '/fonts/icomoon/icomoon.min.css' );
  $canonical_url = get_permalink();
  $title = wp_title( '', false, 'right' ).'| '.get_bloginfo('name');
  $canonical_url_encode = urlencode( $canonical_url );
  $title_encode = urlencode( $title );
  $cd_twitter_via_username = cd_twitter_username() ? '&via='.cd_twitter_username() : '' ;
  ?>
  <section id="social-links" class="content-box">
    <h4 id="sns-btn-bottom-head"><?php esc_html_e('Share', 'coldbox') ?></h4>
    <ul class="share-list-container">

      <?php if ( function_exists( 'scc_get_share_twitter' ) && cd_use_snsb_twitter() ): ?>
        <li class="twitter balloon-btn">
          <div class="share">
            <a class="share-inner" href="http://twitter.com/intent/tweet?url=<?php echo esc_attr( $canonical_url_encode ); ?>&text=<?php echo esc_attr( $title_encode ); ?>&tw_p=tweetbutton<?php echo esc_attr( $cd_twitter_via_username ); ?>" target="_blank">
              <i class="icon-twitter"></i>
            </a>
          </div>
          <span class="count">
            <a class="count-inner" href="http://twitter.com/intent/tweet?url=<?php echo esc_attr( $canonical_url_encode ); ?>&text=<?php echo esc_attr( $title_encode ); ?>&tw_p=tweetbutton" target="_blank">
              <?php echo absint( scc_get_share_twitter() ); ?>
            </a>
          </span>
        </li>
      <?php endif; ?>

      <?php if ( function_exists( 'scc_get_share_hatebu' ) && cd_use_snsb_hatena() ): ?>
        <li class="hatena balloon-btn">
          <div class="share">
            <a class="share-inner" href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php echo esc_attr( $canonical_url_encode ); ?>&title=<?php echo esc_attr( $title_encode );?>" target="_blank">
              <i class="icon-hatena"></i>
            </a>
          </div>
          <span class="count">
            <a class="count-inner" href="http://b.hatena.ne.jp/entry/<?php echo esc_attr( $canonical_url_encode ); ?>" target="_blank">
              <?php echo absint( scc_get_share_hatebu() ); ?>
            </a>
          </span>
        </li>
      <?php endif; ?>

      <?php if ( function_exists( 'scc_get_share_facebook' ) && cd_use_snsb_facebook() ): ?>
        <li class="facebook balloon-btn">
          <div class="share">
            <a class="share-inner" href="http://www.facebook.com/sharer.php?src=bm&u=<?php echo esc_attr( $canonical_url_encode ); ?>&t=<?php echo esc_attr( $title_encode ); ?>" target="_blank">
              <i class="icon-facebook"></i>
            </a>
          </div>
          <span class="count">
            <a class="count-inner" href="http://www.facebook.com/sharer.php?src=bm&u=<?php echo esc_attr( $canonical_url_encode ); ?>&t=<?php echo esc_attr( $title_encode ); ?>" target="_blank">
              <?php echo absint( scc_get_share_facebook() ); ?>
            </a>
          </span>
        </li>
      <?php endif; ?>

      <?php if ( function_exists( 'scc_get_share_gplus' ) && cd_use_snsb_googleplus() ): ?>
        <li class="googleplus balloon-btn">
          <div class="share">
            <a class="share-inner" href="https://plus.google.com/share?url=<?php echo esc_attr( $canonical_url_encode ); ?>" target="_blank">
              <i class="icon-googleplus"></i>
            </a>
          </div>
          <span class="count">
            <a class="count-inner" href="https://plus.google.com/share?url=<?php echo esc_attr( $canonical_url_encode ); ?>" target="_blank">
              <?php echo absint( scc_get_share_gplus() ); ?>
            </a>
          </span>
        </li>
      <?php endif; ?>

      <?php if ( function_exists( 'scc_get_share_pocket' ) && cd_use_snsb_pocket() ): ?>
        <li class="pocket balloon-btn">
          <div class="share">
            <a class="share-inner" href="https://getpocket.com/edit?url=<?php echo esc_attr( $canonical_url_encode ); ?>&title=<?php echo esc_attr( $title_encode ); ?>" target="_blank">
              <i class="icon-pocket"></i>
            </a>
          </div>
          <span class="count">
            <a class="count-inner" href="https://getpocket.com/edit?url=<?php echo esc_attr( $canonical_url_encode ); ?>&title=<?php echo esc_attr( $title_encode ); ?>" target="_blank">
              <?php echo absint( scc_get_share_pocket() ); ?>
            </a>
          </span>
        </li>
      <?php endif; ?>

      <?php if ( function_exists( 'scc_get_follow_feedly' ) && cd_use_snsb_feedly() ): ?>
        <li class="feedly balloon-btn">
          <div class="share">
            <a class="share-inner" href="https://cloud.feedly.com/#subscription%2Ffeed%2F<?php bloginfo('rss2_url'); ?>" target="_blank">
              <i class="icon-feedly"></i>
            </a>
          </div>
          <span class="count">
            <a class="count-inner" href="https://cloud.feedly.com/#subscription%2Ffeed%2F<?php bloginfo('rss2_url'); ?>" target="_blank">
              <?php echo absint( scc_get_follow_feedly() ); ?>
            </a>
          </span>
        </li>
      <?php endif; ?>

    </ul>
  </section>
<?php endif; ?>
