<?php
/* ------------------------------------------------------------------------- *
*  Enqueue Files
* ------------------------------------------------------------------------- */
if ( !function_exists ( 'cd_scripts' ) ) {

  function cd_scripts() {
    if ( cd_use_minified_css() ) {
      wp_enqueue_style ( 'main-style', get_template_directory_uri().'/style.min.css', array(), '1.0.2' );
    } else {
      wp_enqueue_style ( 'main-style', get_template_directory_uri().'/style.css', array(), '1.0.2' );
    }
    if ( cd_use_minified_js() ) {
      wp_enqueue_script( 'scripts', get_template_directory_uri().'/js/scripts.min.js', array('jquery') );
    } else {
      wp_enqueue_script( 'scripts', get_template_directory_uri().'/js/scripts.js', array('jquery') );
    }
    wp_enqueue_style ( 'FontAwesome', get_template_directory_uri().'/fonts/fontawesome/css/font-awesome.min.css' );
    wp_enqueue_style ( 'GoogleFonts', '//fonts.googleapis.com/css?family=Lato:300,400,700' );
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'cd_scripts' );


if ( !function_exists ( 'cd_loads' ) ) {

  function cd_loads() {
    load_theme_textdomain( 'coldbox', get_template_directory().'/languages');
    add_editor_style( 'parts/editor-style.min.css' );
  }

}
add_action( 'after_setup_theme', 'cd_loads' );


if ( !function_exists ( 'cd_czr' ) ) {

  function cd_czr() {
    get_template_part ( 'czr/customizer' );
  }

}
add_action( 'after_setup_theme', 'cd_czr' );

/* ------------------------------------------------------------------------- *
*  Theme Function
* ------------------------------------------------------------------------- */
if ( !function_exists ( 'cd_supports' ) ) {

  function cd_supports() {

    // Title tag
    add_theme_support( 'title-tag' );

    // Support thumbnail
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 500, 250, true );
    add_image_size( 'cd-small', 150, 150, true );
    add_image_size( 'cd-medium', 500, 250, true );
    add_image_size( 'cd-standard', 500, 500, true );

    // Support RSS link
    add_theme_support( 'automatic-feed-links' );

    // Support all post format
    add_theme_support( 'post-formats', array( 'audio', 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );

    // Support HTML5
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

    // Support custom header
    add_theme_support( 'custom-header', array(
      'width'       => 980,
      'height'      => 100,
      'flex-height' => true,
      'flex-width'  => true,
    ) );

    add_theme_support( 'custom-logo', array(
      'height'      => 80,
      'width'       => 270,
      'flex-height' => true,
    ) );

    // Support custom background color and image
    $custom_background_defaults = array(
      'default-color' => '#f8f8f8',
      'default-image' => '',
    );
    add_theme_support( 'custom-background', $custom_background_defaults );

    // Nav menu
    register_nav_menus( array(
      'header-menu' => 'Header Menu',
    ) );


  }

}
add_action( 'after_setup_theme', 'cd_supports' );

// Content width
if ( !isset( $content_width ) ) $content_width = 680;


/* ------------------------------------------------------------------------- *
*  Body class
* ------------------------------------------------------------------------- */
if ( !function_exists ( 'cd_body_class' ) ) {

  function cd_body_class( $classes ) {

    if ( has_nav_menu('header-menu') ) { $classes[] = 'header-menu-enabled'; }
    if ( cd_sidebar_stg() == 'right' ) { $classes[] = 'right-sidebar-s1'; }
    elseif ( cd_sidebar_stg() == 'left' ) { $classes[] = 'left-sidebar-s1'; }
    elseif ( cd_sidebar_stg() == 'bottom' ) { $classes[] = 'bottom-sidebar-s1'; }
    elseif ( cd_sidebar_stg() == 'hide' ) { $classes[] = 'hide-sidebar-s1'; }
    if ( cd_header_direction() == 'column' ) { $classes[] = 'header-column'; }
    elseif ( cd_header_direction() == 'row' ) { $classes[] = 'header-row'; }
    $ua = getenv( 'HTTP_USER_AGENT' );
    if ( strstr( $ua, "MSIE 9.0" ) ) { $classes[] = "ie9"; }
    if ( strstr( $ua, "MSIE 10.0" ) ) { $classes[] = "ie10"; }
    return $classes;

  }

}
add_filter( 'body_class', 'cd_body_class' );

/* ------------------------------------------------------------------------- *
*  Sidebars
* ------------------------------------------------------------------------- */
if ( !function_exists ( 'cd_widgets_init' ) ) {

  function cd_widgets_init() {
    register_sidebar( array(
      'name'          => 'Sidebar',
      'id'            => 'sidebar-1',
      'description'   => __( 'Add widgets here', 'coldbox' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
      )
    );
  }

}
add_action( 'widgets_init', 'cd_widgets_init' );

/* ------------------------------------------------------------------------- *
*  Widgets Customize
* -------------------------------------------------------------------------- */
/*   Category Widget
/* -------------------------------------------------- */
if ( !function_exists ( 'cd_cat_widget_count' ) ) {

  function cd_cat_widget_count( $output, $args ) {
    $replaced_text = preg_replace('/<\/a> \(([0-9,]*)\)/', ' <span class="count">(${1})</span></a>', $output);
    if ( $replaced_text != NULL ) {
      return $replaced_text;
    } else {
      return $output;
    }
  }

}
add_filter( 'wp_list_categories', 'cd_cat_widget_count', 10, 2);

/*   Archive Widget
/* -------------------------------------------------- */
if ( !function_exists ( 'cd_archive_widget_count' ) ) {

  function cd_archive_widget_count( $links ) {
    $links = str_replace( '</a>&nbsp;(', ' <span class="count">(', $links );
    $links = str_replace( ')', ')</span></a>', $links );
    return $links;
  }

}
add_filter( 'get_archives_link', 'cd_archive_widget_count', 10, 2 );

/*   Recently Posts Widget
/* -------------------------------------------------- */
if ( !function_exists ( 'cd_remove_current_post_on_recent_widget' ) ) {

  function cd_remove_current_post_on_recent_widget( $args ) {
    if ( is_single() ) {
      $args['post_not_in'] = array( get_the_ID() );
    }
    return $args;
  }

}
add_filter( 'widget_posts_args', 'cd_remove_current_post_on_recent_widget', 10, 3 );

/*  TagCloud Widget
/* -------------------------------------------------- */
if ( !is_admin() ) {
  if ( !function_exists ( 'cd_tag_widget_count' ) ) {

    function cd_tag_widget_count( $content, $tags, $args ) {
      $count = 0;
      $output = preg_replace_callback( '(</a\s*>)',
      function( $match ) use ( $tags, &$count ) {
        return "<span class=\"count\">(".$tags[$count++]->count.")</span></a>";
      }, $content);

      return $output;
    }
  }

  add_filter( 'wp_generate_tag_cloud','cd_tag_widget_count', 10, 3 );
}

/* ------------------------------------------------------------------------- *
*  Breadcrumbs
* -------------------------------------------------------------------------- */
if ( !function_exists ( 'cd_breadcrumb' ) ) {

  function cd_breadcrumb() {
    echo '<a href="'.esc_url(home_url()).'">Home</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;';
    if ( is_attachment() ) {
      the_title();
    } elseif ( is_single() ) {
      the_category(' &#47; ');
    } elseif ( is_category() ) {
      global $wp_query;
      $current_cat = $wp_query->get_queried_object();
      $cat = $wp_query->get_queried_object();

      if ( $cat->parent ) { // If a category has parent category
        $parent = array();
        $parent_url = array();
        while ( $cat->parent ) {
          $cat = get_category( $cat->parent );
          $cat_name = $cat->name;
          $cat_url = get_category_link( $cat->cat_ID );
          $parent = array_merge( $parent, array( $cat_name => $cat_url ) );
        }
        $parent_rev = array_reverse( $parent );
        foreach ( $parent_rev as $key => $value ){
          echo '<a href="'.esc_html( $value ).'">'.esc_html( $key ).'</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;';
        }
        echo '<span>'.esc_html( $current_cat->name )."</span>";

      } else {
        echo esc_html( $cat->name );
      }
    } elseif ( is_author() ) {
      the_author();
    } elseif ( is_page() ) {
      the_title();
    }
  }

}


/* ------------------------------------------------------------------------- *
*  Highlight.js
* -------------------------------------------------------------------------- */
if ( !function_exists ( 'cd_load_hljs' ) ) {
  function cd_load_hljs() {

    if ( cd_use_normal_hljs() || cd_use_web_hljs() ) {

      if ( cd_use_normal_hljs() && !cd_use_web_hljs() ) {
        wp_enqueue_script( 'hljs', '//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js', array(), '9.12.0' );
      }
      elseif ( cd_use_web_hljs() && !cd_use_normal_hljs() ) {
        wp_enqueue_script( 'hljs', get_template_directory_uri().'/js/highlight-web.js', array(), '9.12.0' );
      }
      elseif ( cd_use_web_hljs() && cd_use_normal_hljs() ) {
        wp_enqueue_script( 'hljs', get_template_directory_uri().'/js/highlight-web.js', array(), '9.12.0' );
      }

      wp_add_inline_script( 'hljs', 'jQuery(document).ready(function(a){a("pre").each(function(b,c){hljs.highlightBlock(c)})});' );

    }

  }
}
add_action( 'wp_enqueue_scripts', 'cd_load_hljs' );


/* ------------------------------------------------------------------------- *
*  Apparence
* -------------------------------------------------------------------------- */
/*   the_excerpt
/* -------------------------------------------------- */
/* Excerpt length */
if ( !function_exists ( 'cd_excerpt_length' ) ) {

  function cd_excerpt_length( $length ) {
    return cd_czr_excerpt_length( $length );
  }

}
add_filter( 'excerpt_length', 'cd_excerpt_length', 999 );

/* Excerpt ending */
if ( !function_exists ( 'cd_excerpt_more' ) ) {

  function cd_excerpt_more( $more ) {
    return cd_czr_excerpt_ending( $more );
  }

}
add_filter( 'excerpt_more', 'cd_excerpt_more' );


/*   Site Title
/* -------------------------------------------------- */
if ( !function_exists ( 'cd_site_title' ) ) {

  function cd_site_title() {
    echo '<a href="'.esc_url(home_url()).'" title="',bloginfo('name'),'">';
    if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ):
      $image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
      echo '<img src="'.esc_attr( $image[0] ).'" alt="',bloginfo('name'),'" />';
    else:
      echo bloginfo('name');
    endif;
    echo '</a>';
  }

}

if ( !function_exists ( 'cd_header_image' ) ) {
  if ( has_header_image() ) {

    function cd_header_image() {
      $style = "#header { background-image: url('".get_header_image()."'); }";
      wp_add_inline_style( 'main-style', $style );
    }
    add_action( 'wp_enqueue_scripts', 'cd_header_image' );

  }
}
