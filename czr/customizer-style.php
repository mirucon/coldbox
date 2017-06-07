<?php
if ( !function_exists ( 'cd_customizer_style' ) ) {
  function cd_customizer_style() { ?>
    <style id="customizer-style" type="text/css">
    <?php

    // Container Width
    if ( get_theme_mod( 'container_width', '1140' ) != '1140' ): ?>
    .container {
      max-width: <?php echo get_theme_mod( 'container_width' ); ?>px;
    }
    <?php endif;

    if ( get_theme_mod( 'global_font_size_pc', '16' ) != '16' ): ?>
    body {
      font-size: <?php echo get_theme_mod( 'global_font_size_pc' ); ?>px;
    }
    <?php endif;
    if ( get_theme_mod( 'global_font_size_mobile', '15' ) != '15' ): ?>
    @media screen and ( max-width: 767px ) {
      body {
        font-size: <?php echo get_theme_mod( 'global_font_size_mobile' ); ?>px;
      }
    }
    <?php endif;

    // Add decoration
    if ( get_theme_mod( 'decorate_htags', false ) ): ?>
    .entry h2 {
      margin-left: -40px; margin-right: -40px; padding: 1.3rem 30px; border-style: solid; border-width: 1px 0; overflow: hidden;
    }
    .entry h3 {
      margin-left: -10px; margin-right: -10px; padding: 0 5px .4rem; border-bottom: 2px solid rgba(0, 0, 0, .5); overflow: hidden;
    }
    .entry h4 {
      padding: 0 0 .4rem; border-bottom: 2px solid #bbb; overflow: hidden;
    }
    .entry h5 {
      padding: 0 0 .4rem; border-bottom: 1px dotted #bbb; overflow: hidden;
    }
    <?php endif;


    // Link Color
    if ( get_theme_mod( 'link_color', '#3399cc' ) != '#3399cc' ): ?>
    .entry-content a, .comment-body a,
    .page-nav ul.page-numbers,
    .related-posts .related-posts-inner .related-grid:hover .post-title,
    #back-to-top .fa {
      color: <?php echo get_theme_mod( 'link_color' ); ?>;
    }
    #comments input[type=submit],
    .post-tags a, .post-tags a,
    .main-archive .post-date {
      background-color: <?php echo get_theme_mod( 'link_color' ); ?>;
    }
    #comments textarea:focus,
    #comments input[type=text]:focus,
    .search-inner:focus,
    #back-to-top {
      border-color: <?php echo get_theme_mod( 'link_color' ); ?>;
    }
    .post-date::before {
      border-right-color: <?php echo get_theme_mod( 'link_color' ); ?>;
    }
    .wp-pagenavi span.current,
    .page-nav a.page-numbers:hover, .page-nav a.page-numbers:active,
    .page-nav span.page-numbers.current {
      border-bottom-color: <?php echo get_theme_mod( 'link_color' ); ?>;
    }
    ::selection { background-color: <?php echo get_theme_mod( 'link_color' ); ?> }
    ::moz-selection { background-color: <?php echo get_theme_mod( 'link_color' ); ?> }
    <?php endif;


    // Link Hover Color
    if( get_theme_mod( 'link_hover_color', '#cc0033' ) != '#cc0033' ): ?>
    .entry-content a:hover, .entry-content a:active,
    .comment-body a:hover, .comment-body a:active {
      color: <?php echo get_theme_mod( 'link_hover_color' ); ?>;
    }
    <?php endif;


    // Header Background Color
    if( get_theme_mod( 'header_color', '#33333B' ) != '#33333B' ):
      $hdrhex = get_theme_mod( 'header_color', '#33333B' );
      list($r, $g, $b) = sscanf($hdrhex, "#%02x%02x%02x");
      $r = $r - 10; $g = $g - 10; $b = $b - 10;
      if ( $r < 0 ) { $r = 0; } if ( $g < 0 ) { $g = 0; } if ( $b < 0 ) { $b = 0; }
      $r = dechex($r); $g = dechex($g); $b = dechex($b);
      if ( strlen($r) == 1 ) { $r = $r.$r; } if ( strlen($g) == 1 ) { $g = $g.$g; } if ( strlen($b) == 1 ) { $b = $b.$b; } ?>
      #header .bloginfo {
        background-color: <?php echo $hdrhex ?>;
      }
      .nav-toggle.open {
        background-color: <?php echo '#'.$r.$g.$b; ?>;
      }
      <?php endif;

      // Footer Background Color
      if ( get_theme_mod( 'footer_color', '#33333B' ) != '#33333B' ): ?>
      #footer {
        background-color: <?php echo get_theme_mod( 'footer_color' ); ?>;
      }
      <?php endif;


      // Header Menu Background Color
      if ( get_theme_mod( 'header_menu_color', '#4b4b4b' ) != '#4b4b4b' ): ?>
      #header-menu/*,
      #header-menu .sub-menu */ {
      background-color: <?php echo get_theme_mod( 'header_menu_color' ); ?>;
    }
    <?php endif;


    // Top Menu Backgrond Color
    if ( get_theme_mod( 'top_menu_color', '#ffffff' ) != '#ffffff' ): ?>
    # {
      background-color: <?php echo get_theme_mod( 'top_menu_color' ); ?>;
    }
    <?php endif;


    // Related Posts Columns
    if ( get_theme_mod( 'single_related_col', 2 ) != 2 ): ?>
    .related-posts .related-article {
      width: calc(100% / <?php echo get_theme_mod( 'single_related_col' ) ?>);
    }
    <?php endif;


    ?>
    </style>
    <?php
  }
}
add_action ( 'wp_head', 'cd_customizer_style' );
