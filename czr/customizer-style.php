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
    .entry a, .title-box a:hover, .post-meta a:hover, .post-meta.content-box a:hover,
    .post-btm-tags a:hover, p.post-btm-cats a:hover, .related-posts .post-category a,
    .related-posts .post:hover .post-title, .post-pages, .grid-view .post-inner a:hover .post-title,
    .standard-view .post-title:hover, ul.page-numbers,
    .widget #wp-calendar a, .widget .widgets-list-layout li:hover a,
    #comment-list .comment-author .fn a, #respond .logged-in-as a:hover, .comment-pages,
    .comment-pages a,.comment-pages span, .comment-body a, .comment-tabmenu .active > a {
      color: <?php echo get_theme_mod( 'link_color' ); ?>;
    }
    #comments input[type=submit],
    .post-tags a, .post-tags a,
    .main-archive .post-date, .action-bar {
      background-color: <?php echo get_theme_mod( 'link_color' ); ?>;
    }
    textarea:focus {
      border-color: <?php echo get_theme_mod( 'link_color' ); ?>;
    }
    .comment-pages > a:hover, .comment-pages span,
    .post-pages > a:hover>span,.post-pages>span,
    ul.page-numbers span.page-numbers.current,
    ul.page-numbers a.page-numbers:hover {
      border-bottom-color: <?php echo get_theme_mod( 'link_color' ); ?>;
    }
    ::selection { background-color: <?php echo get_theme_mod( 'link_color' ); ?> }
    ::moz-selection { background-color: <?php echo get_theme_mod( 'link_color' ); ?> }
    <?php endif;


    // Link Hover Color
    if( get_theme_mod( 'link_hover_color', '#0f5373' ) != '#0f5373' ): ?>
    .entry a:hover, .comment-body a:hover {
      color: <?php echo get_theme_mod( 'link_hover_color' ); ?>;
    }
    <?php endif;


    // Header Background Color
    if( get_theme_mod( 'header_color', '#ffffff' ) != '#ffffff' ): ?>
    #header {
      background-color: <?php echo get_theme_mod( 'header_color' ); ?>;
    }
    <?php endif;

    // Footer Background Color
    if ( get_theme_mod( 'footer_color', '#44463B' ) != '#44463B' ): ?>
    #footer {
      background-color: <?php echo get_theme_mod( 'footer_color' ); ?>;
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
