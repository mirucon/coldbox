<?php

function cd_czr_style() {
  wp_enqueue_style( 'czr_style', get_template_directory_uri().'/czr/czr-style.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'cd_czr_style' );

function cd_social_sites() {
  $social_sites;
  $social_sites = array(
    'twitter'       => 'cd_twitter_profile',
    'facebook'      => 'cd_facebook_profile',
    'google-plus'   => 'cd_googleplus_profile',
    'linkedin'      => 'cd_linkedin_profile',
    'youtube'       => 'cd_youtube_profile',
    'tumblr'        => 'cd_tumblr_profile',
    'instagram'     => 'cd_instagram_profile',
    '500px'         => 'cd_500px_profile',
    'codepen'       => 'cd_codepen_profile',
    'github'        => 'cd_github_profile',
    'steam'         => 'cd_steam_profile',
    'foursquare'    => 'cd_foursquare_profile',
    'slack'         => 'cd_slack_profile',
    'skype'         => 'cd_skype_profile',
    'paypal'        => 'cd_paypal_profile',
    'rss'           => 'cd_rss_profile',
    'feedly'        => 'cd_feedly_profile',
    'email-form'    => 'cd_email_form_profile',
    'bell'          => 'cd_push_profile',
  );
  return apply_filters( 'cd_social_sites', $social_sites );
}

/* ------------------------------------------------------------------------- *
*  Theme Customizer
* ------------------------------------------------------------------------- */
if ( !function_exists( 'cd_customize_register' ) ) {
  function cd_customize_register( $wp_customize ) {

    function cd_sanitize_checkbox( $checked ){ return ( ( isset( $checked ) && true == $checked ) ? true : false ); }
    function cd_sanitize_radio( $input, $setting ) { $input = sanitize_key( $input ); $choices = $setting->manager->get_control($setting->id)->choices; return ( array_key_exists( $input, $choices ) ? $input : $setting->default ); }
    function cd_sanitize_text( $text ) { return sanitize_text_field( $text ); }
    if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'cd_Custom_Content' ) ) {
      class cd_Custom_Content extends WP_Customize_Control {
        public $content = '';
        public function render_content() {
          if ( isset( $this->content ) ) {
            echo $this->content;
          }
        }
      }
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
      'sanitize_callback' => 'cd_sanitize_radio',
    ));
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'global_font', array(
      'label'    =>  __( 'Global Font Selecter', 'coldbox' ),
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
      'label'    => __( 'Global Font Size for PC', 'coldbox' ),
      'section'  => 'global',
      'type'     => 'number',
      'input_attrs' => array(
        'step'     => '1',
        'min'      => '10',
        'max'      => '32',
      ),
    )));
    $wp_customize->add_setting( 'global_font_size_mobile', array(
      'default'  => 16,
      'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control( new WP_Customize_control( $wp_customize, 'global_font_size_mobile', array(
      'label'    => __( 'Global Font Size for Mobile', 'coldbox' ),
      'section'  => 'global',
      'type'     => 'number',
      'input_attrs' => array(
        'step'     => '1',
        'min'      => '10',
        'max'      => '32',
      ),
    )));
    $wp_customize->add_setting( 'minified_css', array(
      'default'  => true,
      'sanitize_callback' => 'cd_sanitize_checkbox',
    ));
    $wp_customize->add_control( new WP_Customize_control( $wp_customize, 'minified_css', array(
      'label'    => __( 'Use minified CSS file', 'coldbox' ),
      'description' => __('The theme loads minified CSS file. Minifying css stylesheets improves loading speed of your website.', 'coldbox'),
      'section'  => 'global',
      'type'     => 'checkbox',
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
      'description'=> __('The package contains the languages which often be used for web development. To use other languages, you may go to <a href="https://highlightjs.org/">Highlight.js official site</a>.', 'coldbox'),
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
        'label'    =>  __( 'Header and Menu Direction', 'coldbox' ),
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
          'title'    => __( 'Coldbox: Archive Pages Settings','coldbox' ),
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
          'title'    => __( 'Coldbox: Single Settings', 'coldbox' ),
          'priority' => 3,
        ));
        /*   Add a decoration to header Tags
        /* -------------------------------------------------- */
        $wp_customize->add_setting( 'single_content', array( 'sanitize_callback'=>'cd_sanitize_text' ) );
        $wp_customize->add_control( new cd_Custom_Content( $wp_customize, 'single_content', array(
          'content' => '<h3 class="czr-heading first">' . __( 'Settings for Content', 'coldbox' ) . '</h3>', 'section' => 'single',
        ) ) );
        $wp_customize->add_setting( 'decorate_htags', array(
          'default'  => false,
          'sanitize_callback' => 'cd_sanitize_checkbox',
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'decorate_htags', array(
          'label'    => __( 'Add Decoration to H2-H5 Tags.', 'coldbox' ),
          'section'  => 'single',
          'type'     => 'checkbox',
        )));

        /*   Single Meta Settings
        /* -------------------------------------------------- */
        $wp_customize->add_setting( 'single_meta', array( 'sanitize_callback'=>'cd_sanitize_text' ) );
        $wp_customize->add_control( new cd_Custom_Content( $wp_customize, 'single_meta', array(
          'content' => '<h3 class="czr-heading">' . __( 'Settings for Metas', 'coldbox' ) . '</h3>', 'section' => 'single',
          ) ) );
        // Date
        $wp_customize->add_setting( 'single_meta_date', array(
          'default'  => true,
          'sanitize_callback' => 'cd_sanitize_checkbox',
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_meta_date', array(
          'label'    => __( 'Display Post Dates', 'coldbox' ),
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
          'description'=> __( 'Note: Categories are already showed on the breadcrum.', 'coldbox'),
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
        // Author Box
        $wp_customize->add_setting( 'single_author_box', array(
          'default'  => true,
          'sanitize_callback' => 'cd_sanitize_checkbox',
        ));
        $wp_customize->add_control( 'single_author_box', array(
          'label'    => __( 'Display Author Box','coldbox' ),
          'section'  => 'single',
          'type'     => 'checkbox',
        ));
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
        $wp_customize->add_setting( 'single_related', array( 'sanitize_callback'=>'cd_sanitize_text' ) );
        $wp_customize->add_control( new cd_Custom_Content( $wp_customize, 'single_related', array(
          'content' => '<h3 class="czr-heading">' . __( 'Settings for Related Posts', 'coldbox' ) . '</h3>', 'section' => 'single',
        ) ) );
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
          'label'    => __( 'Related Post - Max Articles', 'coldbox' ),
          'section'  => 'single',
          'type'     => 'number',
          'input_attrs' => array(
            'min'      => '1',
          ),
        )));
        // Max Article
        $wp_customize->add_setting( 'single_related_col', array(
          'default'  => 2,
          'sanitize_callback' => 'absint',
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_related_col', array(
          'label'    => __( 'Related Post - Columns', 'coldbox' ),
          'section'  => 'single',
          'type'     => 'number',
          'input_attrs' => array(
            'min'      => '1',
          ),
        )));
        /*   SNS Buttons
        /* -------------------------------------------------- */
        $wp_customize->add_setting( 'sns_buttons', array( 'sanitize_callback'=>'cd_sanitize_text' ) );
        $wp_customize->add_control( new cd_Custom_Content( $wp_customize, 'sns_buttons', array(
          'content' => '<h3 class="czr-heading">' . __( 'Settings for SNS Buttons', 'coldbox' ) . '</h3>', 'section' => 'single',
          ) ) );
        $wp_customize->add_setting( 'sns_button', array(
          'default'  => false,
          'sanitize_callback' => 'cd_sanitize_checkbox',
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sns_button', array(
          'label'    => __( 'Display SNS Buttons', 'coldbox' ),
          'description' => __( 'Requires SNS Count Cache plugin installed and enabled', 'coldbox'),
          'section'  => 'single',
          'type'     => 'checkbox',
        )));
        // Twitter
        $wp_customize->add_setting( 'sns_button_twitter', array(
          'default'  => true,
          'sanitize_callback' => 'cd_sanitize_checkbox',
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sns_button_twitter', array(
          'label'    => __( ' - Twitter', 'coldbox' ),
          'section'  => 'single',
          'type'     => 'checkbox',
        )));
        // Facebook
        $wp_customize->add_setting( 'sns_button_facebook', array(
          'default'  => true,
          'sanitize_callback' => 'cd_sanitize_checkbox',
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sns_button_facebook', array(
          'label'    => __( ' - Facebook', 'coldbox' ),
          'section'  => 'single',
          'type'     => 'checkbox',
        )));
        // hatena Bookmark
        $wp_customize->add_setting( 'sns_button_hatena', array(
          'default'  => false,
          'sanitize_callback' => 'cd_sanitize_checkbox',
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sns_button_hatena', array(
          'label'    => __( ' - Hatena Bookmark', 'coldbox' ),
          'section'  => 'single',
          'type'     => 'checkbox',
        )));
        // Google Plus
        $wp_customize->add_setting( 'sns_button_googleplus', array(
          'default'  => true,
          'sanitize_callback' => 'cd_sanitize_checkbox',
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sns_button_googleplus', array(
          'label'    => __( ' - Google Plus', 'coldbox' ),
          'section'  => 'single',
          'type'     => 'checkbox',
        )));
        // Pocket
        $wp_customize->add_setting( 'sns_button_pocket', array(
          'default'  => true,
          'sanitize_callback' => 'cd_sanitize_checkbox',
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sns_button_pocket', array(
          'label'    => __( ' - Pocket', 'coldbox' ),
          'section'  => 'single',
          'type'     => 'checkbox',
        )));
        // Feedly
        $wp_customize->add_setting( 'sns_button_feedly', array(
          'default'  => true,
          'sanitize_callback' => 'cd_sanitize_checkbox',
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sns_button_feedly', array(
          'label'    => __( ' - Feedly', 'coldbox' ),
          'section'  => 'single',
          'type'     => 'checkbox',
        )));
        // Twitter username
        $wp_customize->add_setting( 'twitter_username', array(
          'default'  => '',
          'sanitize_callback' => 'cd_sanitize_text',
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter_username', array(
          'label'    => 'Twitter Username',
          'description' => 'Enter your Twitter username without "@" suffix. The username will be shown in tweets.',
          'section'  => 'single',
          'type'     => 'text',
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
        $wp_customize->add_setting( 'theme_credit_text', array(
          'default'  => 'Powered by <a href="https://wordpress.org/" target="_blank">WordPress</a>, <a href="https://coldbox.miruc.co/" target="_blank">Coldbox</a> theme by <a href="https://miruc.co/" target="_blank">Mirucon</a>',
          'sanitize_callback' => 'wp_filter_post_kses',
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_credit_text', array(
          'label'    => __( 'Edit Theme Credit Contents','coldbox' ),
          'description' => __( 'It will be displayed when above checked. You can use the following HTML tags: &lt;a&gt;, &lt;b&gt;, &lt;strong&gt;, &lt;p&gt;, &lt;br&gt;', 'coldbox' ),
          'section'  => 'footer',
          'settings' => 'theme_credit_text',
          'type'     => 'textarea',
        )));


        /* ------------------------------------------------------------------------- *
        *  Colors
        * ------------------------------------------------------------------------- */
        // Link Color
        $wp_customize->add_setting( 'link_color', array(
          'default'    => '#00619f',
          'sanitize_callback' => 'sanitize_hex_color',
        ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
          'label'      => __( 'Primary Color', 'coldbox' ),
          'section'    => 'colors',
          'settings'   => 'link_color',
        )));
        // Hover Link Color
        $wp_customize->add_setting( 'link_hover_color', array(
          'default'   => '#2e4453',
          'sanitize_callback' => 'sanitize_hex_color',
        ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
          'label'     => __( 'Secondary Color', 'coldbox' ),
          'section'   => 'colors',
          'settings'  => 'link_hover_color'
        )));
        // Header Background Color
        $wp_customize->add_setting( 'header_color', array(
          'default'  => '#ffffff',
          'sanitize_callback' => 'sanitize_hex_color',
        ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
          'label'     => __( 'Header Background', 'coldbox' ),
          'section'   => 'colors',
          'settings'  => 'header_color',
        )));
        // Footer Background Color
        $wp_customize->add_setting( 'footer_color', array(
          'default'  => '#44463b',
          'sanitize_callback' => 'sanitize_hex_color',
        ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_color', array(
          'label'     => __( 'Footer Background', 'coldbox' ),
          'section'   => 'colors',
          'settings'  => 'footer_color',
        )));

      /* ------------------------------------------------------------------------- *
      *  Social Accounts
      * -------------------------------------------------------------------------- */
      $wp_customize->add_section( 'social_links', array(
        'title' => __( 'Coldbox: Social Links', 'coldbox' ),
        'description' => __( 'Add your social account profiles here. Please enter the full URL.', 'coldbox' ),
        'priority' => 5,
      ));

      $social_sites = cd_social_sites();

      foreach ( $social_sites as $social_site => $value ) {

        $label = ucfirst( $social_site );
        if ( $social_site == 'google-plus' ) {
          $label = 'Google+';
        } elseif ( $social_site == 'rss' ) {
          $label = 'RSS';
        } elseif ( $social_site == 'codepen' ) {
          $label = 'CodePen';
        } elseif ( $social_site == 'paypal' ) {
          $label = 'PayPal';
        } elseif ( $social_site == 'email-form' ) {
          $label = 'Contact Form';
        } elseif ( $social_site == 'bell' ) {
          $label = 'Push Notification';
        }

        $wp_customize->add_setting( $social_site, array(
          'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control( $social_site, array(
          'type'    => 'url',
          'label'   => $label,
          'section' => 'social_links',
        ));

      }


      } // End Customizer


      // Minified CSS
      function cd_use_minified_css() { return ( get_theme_mod( 'minified_css', true ) ); }
      // Sidebar Position
      function cd_sidebar_stg() { return ( get_theme_mod( 'sidebar_position', 'right' ) ); }
      // Page Style Settings
      function cd_index_style() { return ( get_theme_mod( 'index_style', 'grid' ) ); }
      function cd_archive_style() { return ( get_theme_mod( 'archive_style', 'grid' ) ); }
      function cd_is_site_desc() { return ( get_theme_mod( 'site_desc', true ) ); }
      function cd_header_direction() { return ( get_theme_mod( 'header_direction', 'column' ) ); }
      // Excerpt Settings
      function cd_czr_excerpt_length() { return ( get_theme_mod( 'excerpt_length', 60 ) ); }
      function cd_czr_excerpt_ending() { return ( get_theme_mod( 'excerpt_ending', '&#46;&#46;&#46;' ) ); }
      // Single Meta Settings
      function cd_is_meta_date() { return ( get_theme_mod( 'single_meta_date', true ) ); }
      function cd_is_meta_modified() { return ( get_theme_mod( 'single_meta_date', true ) ); }
      function cd_is_meta_cat() { return ( get_theme_mod( 'single_meta_cat', false ) ); }
      function cd_is_meta_author() { return ( get_theme_mod( 'single_meta_author', true ) ); }
      function cd_is_meta_com() { return ( get_theme_mod( 'single_meta_com', true ) ); }
      function cd_is_meta_btm_tag() { return ( get_theme_mod( 'single_meta_btm_tag', true ) ); }
      function cd_is_meta_btm_cat() { return ( get_theme_mod( 'single_meta_btm_cat', true ) ); }
      function cd_is_author_box() { return ( get_theme_mod( 'single_author_box', true ) ); }
      function cd_is_post_nav() { return ( get_theme_mod( 'single_post_nav', true ) ); }
      function cd_is_post_related() { return ( get_theme_mod( 'single_related_posts', true ) ); }
      function cd_is_post_single_comment() { return ( get_theme_mod( 'single_comment', true ) ); }
      // Related Posts Settings
      function cd_single_related_max() { return ( get_theme_mod( 'single_related_max', 6 ) ); }
      function cd_single_related_col() { return ( get_theme_mod( 'single_related_col', 2 ) ); }
      // Theme credit
      function cd_is_theme_credit() { return ( get_theme_mod( 'theme_credit', true ) ); }
      function cd_theme_credit_text() {
        $text = get_theme_mod( 'theme_credit_text', 'Powered by <a href="https://wordpress.org/" target="_blank">WordPress</a>, <a href="https://coldbox.miruc.co/" target="_blank">Coldbox</a> theme by <a href="https://miruc.co/" target="_blank">Mirucon</a>' ) ;
        $allowed_html = array( 'a' => array( 'href' => array (), 'onclick' => array (), 'target' => array() ), 'p' => array( 'style' => array (), 'align' => array (), 'target' => array() ), 'br' => array(), 'strong' => array(), 'b' => array(), );
        return wp_kses( $text, $allowed_html );
      }
      // Hightlight.js
      function cd_use_normal_hljs() { return ( get_theme_mod( 'does_use_hljs', false ) ); }
      function cd_use_web_hljs() { return ( get_theme_mod( 'use_hljs_web_pack', false ) ); }
      // SNS Buttons
      function cd_use_snsb() { return ( get_theme_mod( 'sns_button', false ) ); }
      function cd_use_snsb_twitter() { return ( get_theme_mod( 'sns_button_twitter', true ) ); }
      function cd_use_snsb_facebook() { return ( get_theme_mod( 'sns_button_facebook', true ) ); }
      function cd_use_snsb_hatena() { return ( get_theme_mod( 'sns_button_hatena', true ) ); }
      function cd_use_snsb_googleplus() { return ( get_theme_mod( 'sns_button_googleplus', true ) ); }
      function cd_use_snsb_pocket() { return ( get_theme_mod( 'sns_button_pocket', true ) ); }
      function cd_use_snsb_feedly() { return ( get_theme_mod( 'sns_button_feedly', true ) ); }
      function cd_twitter_username() { return ( get_theme_mod( 'twitter_username', '' ) ); }
      // Social Links
      function cd_social_links() {

      $social_sites = cd_social_sites();

        // Get the social account names and URLs
        foreach ( $social_sites as $key => $value ) {
          if ( strlen( get_theme_mod( $key ) ) > 0 ) {
            $active_links[$key] = get_theme_mod( $key );
          }
        }

        // If there is any registered URL
        if ( !empty( $active_links ) ) {

          echo '<ul class="social-links">';

          // $key has got the social account name, $value has got the URL
          foreach ( $active_links as $key => $value ) {
            if ( $key == 'feedly' ) {
              $class = 'icon-feedly';
              function load_icomoon() { wp_enqueue_style( 'icomoon', get_template_directory_uri() . '/fonts/icomoon/icomoon.min.css' ); }
              add_action( 'wp_enqueue_scripts', 'load_icomoon' );
            } else {
              $class = 'fa fa-'.$key;
            } ?>
            <li class="<?php echo esc_attr( $key ).'-container' ?>">
              <a class="<?php echo esc_attr( $key ); ?>" href="<?php echo esc_url( $value ); ?>" target="_blank">
                <i class="<?php echo esc_attr( $class ); ?>" title="<?php echo esc_attr( $key ); ?>"></i>
              </a>
            </li>
            <?php
          }

          echo "</ul>";

        }

      }

    }
    add_action( 'customize_register', 'cd_customize_register' );

    // Load Font Setting
    get_template_part( 'czr/customizer-font' );
    //  Load Customizer CSS
    get_template_part( 'czr/customizer-style' );
    ?>
