<?php

function cd_czr_style() {
  wp_enqueue_style( 'czr_style', get_template_directory_uri().'/czr/czr-style.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'cd_czr_style' );

/* ------------------------------------------------------------------------- *
*  Theme Customizer
* ------------------------------------------------------------------------- */
if ( !function_exists( 'cd_customize_register' ) ) {

  function cd_customize_register($wp_customize) {

    function cd_sanitize_checkbox( $checked ){ return ( ( isset( $checked ) && true == $checked ) ? true : false ); }
    function cd_sanitize_select( $input, $setting ){ $input = sanitize_key($input); $choices = $setting->manager->get_control( $setting->id )->choices; return ( array_key_exists( $input, $choices ) ? $input : $setting->default ); }
    function cd_sanitize_radio( $input, $setting ) { global $wp_customize; $control = $wp_customize->get_control( $setting->id ); if ( array_key_exists( $input, $control->choices ) ) { return $input; } else { return $setting->default; }
    function cd_sanitize_text( $text ) { return sanitize_text_field( $text ); }
  }

  /* ------------------------------------------------------------------------- *
  *  Global Settings
  * ------------------------------------------------------------------------- */
  $wp_customize->add_section( 'global', array(
    'title'  => __( 'Coldbox: Global Settings', 'coldbox' ),
    'priority' => 1,
  ));
  // Sidebar Position
  $wp_customize->add_setting( 'sidebar_position', array(
    'default'  => 'right',
    'sanitize_callback' => 'cd_sanitize_radio',
  ));
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sidebar_position', array(
    'label'    =>  __( 'Sidebar Position', 'coldbox' ),
    'section'  => 'global',
    'priority' => 1,
    'type'     => 'radio',
    'choices'  => array(
      'right'    => __( 'Right Sidebar (default)','coldbox' ),
      'left'     => __( 'Left Sidebar','coldbox' ),
      'bottom'   => __( 'Bottom Sidebar', 'coldbox' ),
      'hide'     => __( 'Hide Sidebar', 'coldbox' ),
    ),
  )));
  // Container Width
  $wp_customize->add_setting( 'container_width', array(
    'default'  => '1140',
    'sanitize_callback' => 'absint',
  ));
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'container_width', array(
    'label'    =>  __( 'Site Max-Width', 'coldbox' ),
    'section'  => 'global',
    'type'     => 'number',
    'input_attrs' => array(
      'step'     => '1',
      'min'      => '800',
      'max'      => '1980',
    ),
  )));
  // Global Font Select
  $wp_customize->add_setting( 'global_font', array(
    'default'  => 'opensans',
    'sanitize_callback' => 'cd_sanitize_select',
  ));
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'global_font', array(
    'label'    =>  __( 'Global Font Select', 'coldbox' ),
    'section'  => 'global',
    'type'     => 'select',
    'choices'  => array(
      'opensans'  => 'Open Sans',
      'lato'      => 'Lato',
      'roboto'    => 'Roboto',
      'robotocondensed' => 'Roboto Condensed',
      'ubuntu'    => 'Ubuntu',
      'raleway'   => 'Raleway',
      'sourcesanspro'=> 'Source Sans Pro',
      'josefinsans'=> 'Josefin Sans',
      'ptsans'    => 'PT Sans',
      'lora'      => 'Lora',
      'robotoslab'=> 'Roboto Slab',
      'arial'     => 'Arial',
      'helvetica' => 'Helvetica',
      'verdana'   => 'Verdana',
      'tahoma'    => 'Tahoma',
    ),
  )));
  $wp_customize->add_setting( 'global_font_size_pc', array(
    'default'  => 16,
    'sanitize_callback' => 'absint',
  ));
  $wp_customize->add_control( new WP_Customize_control( $wp_customize, 'global_font_size_pc', array(
    'label'    => __( 'Global Font Size For PC', 'coldbox' ),
    'section'  => 'global',
    'type'     => 'number',
    'input_attrs' => array(
      'step'     => '1',
      'min'      => '10',
      'max'      => '32',
    ),
  )));
  $wp_customize->add_setting( 'global_font_size_mobile', array(
    'default'  => 15,
    'sanitize_callback' => 'absint',
  ));
  $wp_customize->add_control( new WP_Customize_control( $wp_customize, 'global_font_size_mobile', array(
    'label'    => __( 'Global Font Size For Mobile', 'coldbox' ),
    'section'  => 'global',
    'type'     => 'number',
    'input_attrs' => array(
      'step'     => '1',
      'min'      => '10',
      'max'      => '32',
    ),
  )));
  // Use highlight.js
  $wp_customize->add_setting( 'does_use_hljs', array(
    'default'  => false,
    'sanitize_callback' => 'cd_sanitize_checkbox',
  ));
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'does_use_hljs', array(
    'label'  => __( 'Use highlight.js', 'coldbox'),
    'description'=> __('The package contains 23 common languages.', 'coldbox'),
    'section'  => 'global',
    'type'     => 'checkbox',
  )));
    $wp_customize->add_setting( 'use_hljs_web_pack', array(
      'default'  => false,
      'sanitize_callback' => 'cd_sanitize_checkbox',
    ));
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'use_hljs_web_pack', array(
      'label'  => __( 'Use highlight.js with Web Package', 'coldbox'),
      'description'=> __('The package contains languages which often be used for web development. To use other languages, you may go to <a href="https://highlightjs.org/">Highlight.js official site</a>.', 'coldbox'),
      'section'  => 'global',
      'type'     => 'checkbox',
    )));


    /* ------------------------------------------------------------------------- *
    *  Header Settings
    * -------------------------------------------------------------------------- */
    $wp_customize->add_section( 'header', array(
      'title'    => __( 'Coldbox: Header Settings','coldbox' ),
      'priority' => 1,
    ));
    // Site Description
    $wp_customize->add_setting( 'site_desc', array(
      'default'  => true,
      'sanitize_callback' => 'cd_sanitize_checkbox',
    ));
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'site_desc', array(
      'label'    =>  __( 'Display Site Description', 'coldbox' ),
      'section'  => 'header',
      'type'     => 'checkbox',
    )));
    // Header Direction
    $wp_customize->add_setting( 'header_direction', array(
      'default'  => 'column',
      'sanitize_callback' => 'cd_sanitize_radio',
    ));
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_direction', array(
      'label'    =>  __( 'Header Direction', 'coldbox' ),
      'section'  => 'header',
      'type'     => 'radio',
      'choices'  => array(
        'column'  => __( 'Vertical (flex-direction: column)', 'coldbox' ),
        'row'     => __( 'Horizontal (flex-direction: row)', 'coldbox' ),
        )
      )));


      /* ------------------------------------------------------------------------- *
      *  Index settings
      * ------------------------------------------------------------------------- */
      $wp_customize->add_section( 'index', array(
        'title'    => __( 'Coldbox: Index Settings','coldbox' ),
        'priority' => 2,
      ));
      // Front page style
      $wp_customize->add_setting( 'index_style', array(
        'default'  => 'grid',
        'sanitize_callback' => 'cd_sanitize_radio',
      ));
      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'index_style', array(
        'label'    => __( 'Front Page Style','coldbox' ),
        'section'  => 'index',
        'priority' => 1,
        'type'     => 'radio',
        'choices'  => array(
          'grid'     => __( 'Grid Style (default)','coldbox' ),
          'standard' => __( 'Standard Style','coldbox' ),
        ),
      )));
      // Archive page style
      $wp_customize->add_setting( 'archive_style', array(
        'default'  => 'grid',
        'sanitize_callback' => 'cd_sanitize_radio',
      ));
      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archive_style', array(
        'label'    => __( 'Archive Page Style','coldbox' ),
        'section'  => 'index',
        'priority' => 2,
        'type'     => 'radio',
        'choices'  => array(
          'grid'     => __( 'Grid Style (default)','coldbox' ),
          'standard' => __( 'Standard Style','coldbox' ),
        ),
      )));
      // Excerpt Length Setting
      $wp_customize->add_setting( 'excerpt_length', array(
        'default'  => '60',
        'sanitize_callback' => 'absint',
      ));
      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'excerpt_length', array(
        'label'    =>  __( 'Excerpt Length', 'coldbox' ),
        'section'  => 'index',
        'type'     => 'number',
        'input_attrs' => array(
          'min'      => '0',
        ),
      )));
      $wp_customize->add_setting( 'excerpt_ending', array(
        'default'  => '...',
        'sanitize_callback' => 'cd_sanitize_text',
      ));
      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'excerpt_ending', array(
        'label'    =>  __( 'Excerpt Ending', 'coldbox' ),
        'section'  => 'index',
        'type'     => 'text',
      )));


      /* ------------------------------------------------------------------------- *
      *  Single Settings
      * ------------------------------------------------------------------------- */
      $wp_customize->add_section( 'single', array(
        'title'    => __( 'Coldbox: Single Settings','coldbox' ),
        'priority' => 3,
      ));
      /*   Add a decoration to header Tags
      /* -------------------------------------------------- */
      $wp_customize->add_setting( 'decorate_htags', array(
        'default'  => false,
        'sanitize_callback' => 'cd_sanitize_checkbox',
      ));
      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'decorate_htags', array(
        'label'    => __( 'Add a decoration to H2-H5 Tags.','coldbox' ),
        'section'  => 'single',
        'type'     => 'checkbox',
      )));

      /*   Single Meta Settings
      /* -------------------------------------------------- */
      // Date
      $wp_customize->add_setting( 'single_meta_date', array(
        'default'  => true,
        'sanitize_callback' => 'cd_sanitize_checkbox',
      ));
      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_meta_date', array(
        'label'    => __( 'Display Post Dates','coldbox' ),
        'section'  => 'single',
        'type'     => 'checkbox',
      )));
      // Category
      $wp_customize->add_setting( 'single_meta_cat', array(
        'default'  => false,
        'sanitize_callback' => 'cd_sanitize_checkbox',
      ));
      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_meta_cat', array(
        'label'    => __( 'Display Post Categories','coldbox' ),
        'section'  => 'single',
        'type'     => 'checkbox',
        'description'=> 'Note: It\'s already showed on the breadcrum'
      )));
      // Author
      $wp_customize->add_setting( 'single_meta_author', array(
        'default'  => true,
        'sanitize_callback' => 'cd_sanitize_checkbox',
      ));
      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_meta_author', array(
        'label'    => __( 'Display Post Author','coldbox' ),
        'section'  => 'single',
        'type'     => 'checkbox',
      )));
      // Comment Count
      $wp_customize->add_setting( 'single_meta_com', array(
        'default'  => true,
        'sanitize_callback' => 'cd_sanitize_checkbox'
      ));
      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_meta_com', array(
        'label'    => __( 'Display Comments Count', 'coldbox' ),
        'section'  => 'single',
        'type'     => 'checkbox',
      )));
      // Bottom Tag
      $wp_customize->add_setting( 'single_meta_btm_tag', array(
        'default'  => true,
        'sanitize_callback' => 'cd_sanitize_checkbox',
      ));
      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_meta_btm_tag', array(
        'label'    => __( 'Display Post Tags on Bottom', 'coldbox' ),
        'section'  => 'single',
        'type'     => 'checkbox',
      )));
      // Bottom Category
      $wp_customize->add_setting( 'single_meta_btm_cat', array(
        'default'  => true,
        'sanitize_callback' => 'cd_sanitize_checkbox',
      ));
      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_meta_btm_cat', array(
        'label'    => __( 'Display Post Categories on Bottom', 'coldbox' ),
        'section'  => 'single',
        'type'     => 'checkbox',
      )));
      // Comment
      $wp_customize->add_setting( 'single_comment', array(
        'default'  => true,
        'sanitize_callback' => 'cd_sanitize_checkbox',
      ));
      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_comment', array(
        'label'    => __( 'Display Comments','coldbox' ),
        'section'  => 'single',
        'type'     => 'checkbox',
      )));
      // Post Nav
      $wp_customize->add_setting( 'single_post_nav', array(
        'default'  => true,
        'sanitize_callback' => 'cd_sanitize_checkbox',
      ));
      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_post_nav', array(
        'label'    => __( 'Display Post Navigation','coldbox' ),
        'section'  => 'single',
        'type'     => 'checkbox',
      )));

      /*   Related Posts Settings
      /* -------------------------------------------------- */
      // Related Post
      $wp_customize->add_setting( 'single_related_posts', array(
        'default'  => true,
        'sanitize_callback' => 'cd_sanitize_checkbox',
      ));
      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_related_posts', array(
        'label'    => __( 'Display Related Posts','coldbox' ),
        'section'  => 'single',
        'type'     => 'checkbox',
      )));
      // Max Article
      $wp_customize->add_setting( 'single_related_max', array(
        'default'  => 6,
        'sanitize_callback' => 'absint',
      ));
      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_related_max', array(
        'label'    => __( 'Related Posts Max Articles', 'coldbox' ),
        'section'  => 'single',
        'type'     => 'number',
        'input_attrs' => array(
          'min'      => '1',
        ),
      )));
      // Max Article
      $wp_customize->add_setting( 'single_related_col', array(
        'default'  => 3,
        'sanitize_callback' => 'absint',
      ));
      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_related_col', array(
        'label'    => __( 'Related Posts Columns', 'coldbox' ),
        'section'  => 'single',
        'type'     => 'number',
        'input_attrs' => array(
          'min'      => '1',
        ),
      )));


      /* ------------------------------------------------------------------------- *
      *  Footer Settings
      * ------------------------------------------------------------------------- */
      $wp_customize->add_section( 'footer', array(
        'title'    => __( 'Coldbox: Footer Settings', 'coldbox' ),
        'priority' => 4,
      ));
      $wp_customize->add_setting( 'theme_credit', array(
        'default'  => true,
        'sanitize_callback' => 'cd_sanitize_checkbox',
      ));
      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_credit', array(
        'label'    => __( 'Display Theme Credit','coldbox' ),
        'section'  => 'footer',
        'settings' => 'theme_credit',
        'type'     => 'checkbox',
      )));


      /* ------------------------------------------------------------------------- *
      *  Colors
      * ------------------------------------------------------------------------- */
      // Link Color
      $wp_customize->add_setting( 'link_color', array(
        'default'    => '#3399cc',
        'sanitize_callback' => 'sanitize_hex_color',
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
        'label'      => __( 'Primary Color', 'coldbox' ),
        'section'    => 'colors',
        'settings'   => 'link_color',
      )));
      // Hover Link Color
      $wp_customize->add_setting( 'link_hover_color', array(
        'default'   => '#cc0033',
        'sanitize_callback' => 'sanitize_hex_color',
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
        'label'     => __( 'Hover Link Color', 'coldbox' ),
        'section'   => 'colors',
        'settings'  => 'link_hover_color'
      )));
      // Top Menu Background Color
      $wp_customize->add_setting( 'top_menu_color', array(
        'default'  => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_menu_color', array(
        'label'  => __( 'Top Menu Background', 'coldbox' ),
        'section' => 'colors',
        'settings'  => 'top_menu_color',
      )));
      // Header Nav Menu Background Color
      $wp_customize->add_setting( 'header_menu_color', array(
        'default'  => '#4b4b4b',
        'sanitize_callback' => 'sanitize_hex_color',
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_menu_color', array(
        'label'  => __( 'Header Menu Background', 'coldbox' ),
        'section' => 'colors',
        'settings'  => 'header_menu_color',
      )));
      // Header Background Color
      $wp_customize->add_setting( 'header_color', array(
        'default'  => '#33333B',
        'sanitize_callback' => 'sanitize_hex_color',
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
        'label'     => __( 'Header Background', 'coldbox' ),
        'section'   => 'colors',
        'settings'  => 'header_color',
      )));
      // Footer Background Color
      $wp_customize->add_setting( 'footer_color', array(
        'default'  => '#33333B',
        'sanitize_callback' => 'sanitize_hex_color',
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_color', array(
        'label'  => __( 'Footer Background', 'coldbox' ),
        'section' => 'colors',
        'settings'  => 'footer_color',
      )));

    } // End Customizer



    // Sidebar Position
    function cd_sidebar_stg() { return ( get_theme_mod( 'sidebar_position', 'right' ) ); }
    // Page Style Settings
    function cd_index_style() { return ( get_theme_mod( 'index_style', 'grid' ) ); }
    function cd_archive_style() { return ( get_theme_mod( 'archive_style', 'grid' ) ); }
    function cd_is_sticky_top_menu() { return ( get_theme_mod( 'sticky_top_menu', true ) ); }
    function cd_is_site_desc() { return ( get_theme_mod( 'site_desc', true ) ); }
    function cd_header_direction() { return ( get_theme_mod( 'header_direction', 'column' ) ); }
    // Excerpt Settings
    function cd_czr_excerpt_length() { return ( get_theme_mod( 'excerpt_length', 60 ) ); }
    function cd_czr_excerpt_ending() { return ( get_theme_mod( 'excerpt_ending', '&#46;&#46;&#46;' ) ); }
    // Single Meta Settings
    function cd_is_meta_date() { return ( get_theme_mod( 'single_meta_date', true ) ); }
    function cd_is_meta_modified() { return ( get_theme_mod( 'single_meta_date', true ) ); }
    function cd_is_meta_cat() { return ( get_theme_mod( 'single_meta_cat', true ) ); }
    function cd_is_meta_author() { return ( get_theme_mod( 'single_meta_author', true ) ); }
    function cd_is_meta_com() { return ( get_theme_mod( 'single_meta_com', true ) ); }
    function cd_is_meta_btm_tag() { return ( get_theme_mod( 'single_meta_btm_tag', true ) ); }
    function cd_is_meta_btm_cat() { return ( get_theme_mod( 'single_meta_btm_cat', true ) ); }
    function cd_is_post_nav() { return ( get_theme_mod( 'single_post_nav', true ) ); }
    function cd_is_post_related() { return ( get_theme_mod( 'single_related_posts', true ) ); }
    function cd_is_post_single_comment() { return ( get_theme_mod( 'single_comment', true ) ); }
    // Related Posts Settings
    function cd_single_related_max() { return ( get_theme_mod( 'single_related_max', 6 ) ); }
    function cd_single_related_col() { return ( get_theme_mod( 'single_related_col', 3 ) ); }
    // Theme credit
    function cd_is_theme_credit() { return ( get_theme_mod( 'theme_credit', true ) ); }
    // Hightlight.js

  }
  add_action( 'customize_register', 'cd_customize_register' );

  //  Load Customizer css
  get_template_part( 'czr/customizer-style' );
  // Load Font Setting
  get_template_part( 'czr/customizer-font' );
  ?>
