<?php
/**
 * Coldbox functions and definitions
 *
 * @since   1.0.0
 * @package Coldbox
 */

if ( ! function_exists( 'cd_scripts' ) ) {

	/**
	 * Enqueue theme styles and scripts
	 *
	 * @since 1.0.0
	 **/
	function cd_scripts() {

		wp_enqueue_style( 'GoogleFonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), '1.0.0' );
		wp_enqueue_script( 'comment-reply' );

		wp_enqueue_style( 'cd-style', get_theme_file_uri( 'assets/css/style.min.css' ), array(), CD_VER );
		wp_enqueue_script( 'cd-script', get_theme_file_uri( 'assets/js/min/scripts.js' ), array( 'wp-polyfill' ), CD_VER, false );

		// Load Masonry for responsive sidebar.
		wp_enqueue_script( 'masonry', 'masonry', array(), '3.3.2', true );
	}
} // End if.
add_action( 'wp_enqueue_scripts', 'cd_scripts' );

if ( ! function_exists( 'cd_load_hljs' ) ) {

	/**
	 * Loads highlight.js
	 *
	 * @since 1.0.0
	 */
	function cd_load_hljs() {

		if ( cd_use_normal_hljs() || cd_use_web_hljs() ) {

			if ( cd_use_normal_hljs() && ! cd_use_web_hljs() ) {
				if ( cd_use_concat_js() ) { // Normal hljs with concat JS.
					wp_enqueue_script( 'scripts-hljs', get_theme_file_uri( 'assets/js/min/scripts+hljs.js' ), array( 'wp-polyfill' ), CD_VER, false );
					wp_dequeue_script( 'cd-script' );
				} else {
					wp_enqueue_script( 'hljs', get_theme_file_uri( 'assets/js/min/hljs.js' ), array(), '9.12.0', false );
				}
			} elseif ( cd_use_web_hljs() && ! cd_use_normal_hljs() || cd_use_web_hljs() && cd_use_normal_hljs() ) {
				if ( cd_use_concat_js() ) { // Web hljs with concat JS.
					wp_enqueue_script( 'scripts-hljs-web', get_theme_file_uri( 'assets/js/min/scripts+hljs_web.js' ), array( 'wp-polyfill' ), CD_VER, false );
					wp_dequeue_script( 'cd-script' );
				} else {
					wp_enqueue_script( 'hljs', get_theme_file_uri( 'assets/js/min/hljs_web.js' ), array(), '9.12.0', false );
				}
			}
		}
	}
} // End if.
add_action( 'wp_enqueue_scripts', 'cd_load_hljs' );

if ( ! function_exists( 'cd_add_attribute_defer' ) ) {

	/**
	 * Add `defer` to the enqueued scripts.
	 *
	 * @param string $tag Tag name.
	 * @param string $handle Handle name.
	 * @return string
	 */
	function cd_add_attribute_defer( $tag, $handle ) {
		$scripts_to_defer = array( 'cd-script', 'scripts-hljs', 'scripts-hljs-web' );

		foreach ( $scripts_to_defer as $defer_script ) {
			if ( $defer_script === $handle ) {
				return str_replace( ' src', ' defer src', $tag );
			}
		}

		return $tag;
	}
}
add_filter( 'script_loader_tag', 'cd_add_attribute_defer', 10, 2 );

if ( ! function_exists( 'cd_add_attribute_async' ) ) {

	/**
	 * Add `async` to the enqueued scripts.
	 *
	 * @param string $tag Tag name.
	 * @param string $handle Handle name.
	 * @return string
	 */
	function cd_add_attribute_async( $tag, $handle ) {
		$scripts_to_async = array( 'masonry', 'imagesloaded' );

		foreach ( $scripts_to_async as $async_script ) {
			if ( $async_script === $handle ) {
				return str_replace( ' src', ' async src', $tag );
			}
		}

		return $tag;
	}
}
add_filter( 'script_loader_tag', 'cd_add_attribute_async', 10, 2 );

if ( ! function_exists( 'cd_loads' ) ) {

	/**
	 * Load the language domain and editor style
	 *
	 * @since 1.0.0
	 **/
	function cd_loads() {
		load_theme_textdomain( 'coldbox', get_theme_file_path( 'languages' ) );
		add_editor_style( 'assets/css/editor-style.min.css' );
	}
}
add_action( 'after_setup_theme', 'cd_loads' );


if ( ! function_exists( 'cd_czr' ) ) {

	/**
	 * Load the theme customizer
	 *
	 * @since 1.0.0
	 **/
	function cd_czr() {
		include_once get_theme_file_path( 'parts/czr/customizer.php' );
		require_once get_theme_file_path( 'parts/czr/customizer-functions.php' );
	}
}
add_action( 'after_setup_theme', 'cd_czr' );


if ( ! function_exists( 'cd_supports' ) ) {

	/**
	 * Load the supported functions provided by WordPress
	 *
	 * @since 1.0.0
	 **/
	function cd_supports() {

		// Title tag.
		add_theme_support( 'title-tag' );

		// Support thumbnail.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 500, 250, true );
		add_image_size( 'cd-small', 150, 150, true );
		add_image_size( 'cd-medium', 500, 250, true );
		add_image_size( 'cd-standard', 500, 500, true );

		// Support RSS link.
		add_theme_support( 'automatic-feed-links' );

		// Support direct widgets editing shortcut on customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Support all post format.
		add_theme_support( 'post-formats', array( 'audio', 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );

		// Support HTML5.
		add_theme_support( 'html5', array( 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		// Support custom header.
		add_theme_support(
			'custom-header',
			array(
				'width'       => 980,
				'height'      => 100,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		// Support custom logo.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 80,
				'width'       => 230,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		// Support custom background color and image.
		$custom_background_defaults = array(
			'default-color' => '#f8f8f8',
			'default-image' => '',
		);
		add_theme_support( 'custom-background', $custom_background_defaults );

		// Register nav menu.
		register_nav_menus(
			array(
				'header-menu' => __( 'Header Menu', 'coldbox' ),
				'footer-menu' => __( 'Footer Menu', 'coldbox' ),
			)
		);
	}
} // End if.
add_action( 'after_setup_theme', 'cd_supports' );

if ( ! function_exists( 'cd_pingback_header' ) ) {

	/**
	 * Adds a pingback url when necessary.
	 *
	 * @since 1.2.0
	 */
	function cd_pingback_header() {

		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
		}

	}
	add_action( 'wp_head', 'cd_pingback_header' );
}

// Set the content width.
if ( ! isset( $content_width ) ) {
	// phpcs:ignore
	$content_width = 680;
}

/*
 * ----------------------------------------------------------------------
 * Theme Functions
 * ----------------------------------------------------------------------
 */

if ( ! function_exists( 'cd_header_menu' ) ) {

	/**
	 * Call the header menu through a filter
	 *
	 * @since 1.1.6
	 */
	function cd_header_menu() {

		if ( has_nav_menu( 'header-menu' ) ) {

			$close_button = __( 'Close menu', 'coldbox' );
			$menu         = '<nav id="header-menu" class="header-menu" role="navigation" aria-label="' . esc_attr__( 'Header Menu', 'coldbox' ) . '">';
			$menu        .= wp_nav_menu(
				array(
					'theme_location' => 'header-menu',
					'container'      => '',
					'menu_class'     => '',
					'fallback_cb'    => 'wp_page_menu',
					'echo'           => false,
					'items_wrap'     => '<ul id="header-nav" class="menu-container">%3$s<li class="menu-item"><button id="close-mobile-menu" class="screen-reader-text close-mobile-menu">' . esc_html( $close_button ) . '</button></li></ul><!--/#header-nav-->',
				)
			);
			$menu        .= '</nav>';
			echo apply_filters( 'cd_header_menu', $menu ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}

if ( ! function_exists( 'cd_footer_menu' ) ) {

	/**
	 * Call the footer menu through a filter
	 *
	 * @since 1.3.0
	 */
	function cd_footer_menu() {

		if ( has_nav_menu( 'footer-menu' ) ) {

			$menu  = '<nav id="footer-menu" class="footer-menu" role="navigation" aria-label="' . esc_attr__( 'Footer Menu', 'coldbox' ) . '"><div class="container">';
			$menu .= wp_nav_menu(
				array(
					'theme_location' => 'footer-menu',
					'container'      => '',
					'menu_class'     => '',
					'fallback_cb'    => 'wp_page_menu',
					'echo'           => false,
					'items_wrap'     => '<ul id="footer-nav" class="menu-container">%3$s</ul><!--/#footer-nav-->',
				)
			);
			$menu .= '</div></nav>';
			echo apply_filters( 'cd_footer_menu', $menu ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}

if ( ! function_exists( 'cd_standard_thumbnail' ) ) {

	/**
	 * Echo the middle size thumbnail.
	 *
	 * @since 1.1.6
	 * @param bool $alt Whether or not to include alt string.
	 */
	function cd_standard_thumbnail( $alt = true ) {

		if ( ! $alt ) {
			$thumbnail_attr = array(
				'alt' => '',
			);
			$noimage_alt    = '';
		} else {
			$thumbnail_attr = array();
			$noimage_alt    = 'noimage';
			$noimage_alt    = apply_filters( 'cd_noimage_alt_text', $noimage_alt );
		}

		if ( has_post_thumbnail() ) {
			$thumbnail = get_the_post_thumbnail( get_the_ID(), 'cd-standard', $thumbnail_attr );
		} else {
			$thumbnail = '<img src="' . esc_url( get_theme_file_uri( 'assets/img/thumb-standard.png' ) ) . '" alt="' . $noimage_alt . '" height="250" width="500">';
		}
		echo apply_filters( 'cd_standard_thumbnail', $thumbnail ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'cd_middle_thumbnail' ) ) {

	/**
	 * Echo the standard size thumbnail.
	 *
	 * @since 1.1.6
	 * @param bool $alt Whether or not to include alt string.
	 */
	function cd_middle_thumbnail( $alt = true ) {

		if ( ! $alt ) {
			$thumbnail_attr = array(
				'alt' => '',
			);
			$noimage_alt    = '';
		} else {
			$thumbnail_attr = array();
			$noimage_alt    = 'noimage';
			$noimage_alt    = apply_filters( 'cd_noimage_alt_text', $noimage_alt );
		}

		if ( has_post_thumbnail() ) {
			$thumbnail = get_the_post_thumbnail( get_the_ID(), 'cd-medium', $thumbnail_attr );
		} else {
			$thumbnail = '<img src="' . esc_url( get_theme_file_uri( 'assets/img/thumb-medium.png' ) ) . '" alt="' . $noimage_alt . '" height="250" width="500">';
		}
		echo apply_filters( 'cd_middle_thumbnail', $thumbnail ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'cd_middle_thumbnail_template' ) ) {

	/**
	 * Echo the middle size thumbnail for template.
	 *
	 * @since 1.2.3
	 * @param bool $alt Whether or not to include alt string.
	 */
	function cd_middle_thumbnail_template( $alt = true ) {

		if ( ! $alt ) {
			$thumbnail_attr = array(
				'alt' => '',
			);
			$noimage_alt    = '';
		} else {
			$thumbnail_attr = array();
			$noimage_alt    = 'noimage';
			$noimage_alt    = apply_filters( 'cd_noimage_alt_text', $noimage_alt );
		}

		if ( has_post_thumbnail() ) {
			$thumbnail = get_the_post_thumbnail( get_the_ID(), 'cd-medium', $thumbnail_attr );
		} elseif ( cd_index_placefolder_image() ) {
			$thumbnail = '<img src="' . esc_url( get_theme_file_uri( 'assets/img/thumb-medium.png' ) ) . '" alt="' . $noimage_alt . '" height="250" width="500">';
		} else {
			return;
		}
		echo apply_filters( 'cd_middle_thumbnail_template', $thumbnail ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'cd_standard_thumbnail_template' ) ) {

	/**
	 * Echo the standard size thumbnail for template.
	 *
	 * @since 1.2.3
	 * @param bool $alt Whether or not to include alt string.
	 */
	function cd_standard_thumbnail_template( $alt = true ) {

		if ( ! $alt ) {
			$thumbnail_attr = array(
				'alt' => '',
			);
			$noimage_alt    = '';
		} else {
			$thumbnail_attr = array();
			$noimage_alt    = 'noimage';
			$noimage_alt    = apply_filters( 'cd_noimage_alt_text', $noimage_alt );
		}

		if ( has_post_thumbnail() ) {
			$thumbnail = get_the_post_thumbnail( get_the_ID(), 'cd-standard', $thumbnail_attr );
		} elseif ( cd_index_placefolder_image() ) {
			$thumbnail = '<img src="' . esc_url( get_theme_file_uri( 'assets/img/thumb-standard.png' ) ) . '" alt="' . $noimage_alt . '" height="250" width="500">';
		} else {
			return;
		}
		echo apply_filters( 'cd_standard_thumbnail_template', $thumbnail ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'cd_large_thumbnail_template' ) ) {

	/**
	 * Echo the large size thumbnail for template.
	 *
	 * @since 1.5.4
	 * @param bool $alt Whether or not to include alt string.
	 */
	function cd_large_thumbnail_template( $alt = true ) {

		if ( ! $alt ) {
			$thumbnail_attr = array(
				'alt' => '',
			);
		} else {
			$thumbnail_attr = array();
		}

		if ( has_post_thumbnail() ) {
			$thumbnail = get_the_post_thumbnail( get_the_ID(), 'large', $thumbnail_attr );
		} else {
			return;
		}
		echo apply_filters( 'cd_large_thumbnail_template', $thumbnail ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'cd_comments_template' ) ) {

	/**
	 * Echo the comments template through action hook.
	 *
	 * @since 1.2.0
	 */
	function cd_comments_template() {
		ob_start();
		comments_template( '/comments.php', true );
		$template = ob_get_clean();
		echo apply_filters( 'cd_comments_template', $template ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'cd_get_avatar' ) ) {

	/**
	 * Echo user avatar for the author box.
	 *
	 * @since 1.1.6
	 */
	function cd_get_avatar() {

		$avatar = get_avatar( get_the_author_meta( 'ID' ), 74 );
		echo apply_filters( 'cd_get_avatar', $avatar ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'cd_body_class' ) ) {

	/**
	 * Adds classes to the body tag.
	 *
	 * @param  string $classes The classes add to the body class.
	 * @return array custom body classes.
	 * @since  1.0.0
	 **/
	function cd_body_class( $classes ) {

		if ( has_nav_menu( 'header-menu' ) ) {
			$classes[] = 'header-menu-enabled';
		}if ( has_nav_menu( 'footer-menu' ) ) {
			$classes[] = 'footer-menu-enabled';
		}
		if ( cd_header_sticky() ) {
			$classes[] = 'sticky-header';
		}
		if ( cd_sidebar_stg() === 'right' ) {
			$classes[] = 'right-sidebar-s1';
		} elseif ( cd_sidebar_stg() === 'left' ) {
			$classes[] = 'left-sidebar-s1';
		} elseif ( cd_sidebar_stg() === 'bottom' ) {
			$classes[] = 'bottom-sidebar-s1';
		} elseif ( cd_sidebar_stg() === 'hide' ) {
			$classes[] = 'hide-sidebar-s1';
		}
		if ( cd_header_direction() === 'column' ) {
			$classes[] = 'header-column';
		} elseif ( cd_header_direction() === 'row' ) {
			$classes[] = 'header-row';
		}
		return $classes;
	}
}
add_filter( 'body_class', 'cd_body_class' );

if ( ! function_exists( 'cd_load_welcome_page' ) ) {
	/**
	 * Loads the Welcome page.
	 *
	 * @since 1.5.0
	 */
	function cd_load_welcome_page() {
		require_once get_theme_file_path( 'parts/about-coldbox.php' );
		require_once get_theme_file_path( 'parts/admin-notices.php' );
	}

	add_action( 'init', 'cd_load_welcome_page' );
}

if ( ! function_exists( 'cd_css_minify' ) ) {
	/**
	 * Quick and dirty way to mostly minify CSS.
	 *
	 * @since   1.5.0
	 * @author  Gary Jones
	 * @see     https://github.com/GaryJones/Simple-PHP-CSS-Minification/blob/master/minify.php
	 * @license GPL
	 *
	 * @param string $css CSS to minify.
	 *
	 * @return string Minified CSS
	 */
	function cd_css_minify( $css ) {
		$css = preg_replace( '/\s+/', ' ', $css );
		$css = preg_replace( '/(\s+)(\/\*(.*?)\*\/)(\s+)/', '$2', $css );
		$css = preg_replace( '~/\*(?![\!|\*])(.*?)\*/~', '', $css );
		$css = preg_replace( '/;(?=\s*})/', '', $css );
		$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );
		$css = preg_replace( '/ (,|;|\{|}|\)|>)/', '$1', $css );
		$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
		$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );
		$css = preg_replace( '/0 0 0 0/', '0', $css );
		$css = preg_replace( '/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i', '#\1\2\3', $css );

		return trim( $css );
	}
}

/*
 * ----------------------------------------------------------------------
 * Widgets
 * ----------------------------------------------------------------------
 */

if ( ! function_exists( 'cd_widgets_init' ) ) {

	/**
	 * Init widgets area.
	 *
	 * @since 1.0.0
	 **/
	function cd_widgets_init() {
		register_sidebar(
			array(
				'name'          => __( 'Sidebar', 'coldbox' ),
				'id'            => 'sidebar-1',
				'description'   => __( 'Add widgets here', 'coldbox' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => __( 'Footer Sidebar One', 'coldbox' ),
				'id'            => 'footer-1',
				'description'   => __( 'Add widgets here', 'coldbox' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => __( 'Footer Sidebar Two', 'coldbox' ),
				'id'            => 'footer-2',
				'description'   => __( 'Add widgets here', 'coldbox' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => __( 'Footer Sidebar Three', 'coldbox' ),
				'id'            => 'footer-3',
				'description'   => __( 'Add widgets here', 'coldbox' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => __( 'Footer Sidebar Four', 'coldbox' ),
				'id'            => 'footer-4',
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


if ( ! function_exists( 'cd_get_number_of_footer_sidebar' ) ) {

	/**
	 * Get number of footer sidebar used.
	 *
	 * @return int
	 */
	function cd_get_number_of_footer_sidebar() {
		$num = 0;
		for ( $i = 1; $i <= 4; $i++ ) {
			if ( is_active_sidebar( 'footer-' . $i ) ) {
				$num++;
			}
		}
		$num = apply_filters( 'cd_number_of_footer_sidebar', $num );
		return $num;
	}
}


if ( ! function_exists( 'cd_cat_widget_count' ) ) {

	/**
	 * Make the counts surround with brackets on category widgets.
	 *
	 * @param  string $output Return the count with brackets.
	 * @param  string $args   The widget arguments.
	 * @return string $output and $args with .count class.
	 * @since  1.0.0
	 */
	function cd_cat_widget_count( $output, $args ) {
		$replaced_text = preg_replace( '/<\/a> \(([0-9,]*)\)/', ' <span class="count">(${1})</span></a>', $output );
		if ( null !== $replaced_text ) {
			return $replaced_text;
		} else {
			return $output;
		}
	}
}
add_filter( 'wp_list_categories', 'cd_cat_widget_count', 10, 2 );


if ( ! function_exists( 'cd_archive_widget_count' ) ) {

	/**
	 * Make the counts surround with parentheses on archive widgets.
	 *
	 * @param  string $output return the count with parentheses.
	 * @since  1.0.0
	 * @return string Number of posts with parentheses.
	 */
	function cd_archive_widget_count( $output ) {
		$output = str_replace( '</a>&nbsp;(', ' <span class="count">(', $output );
		$output = str_replace( ')', ')</span></a>', $output );
		return $output;
	}
}
add_filter( 'get_archives_link', 'cd_archive_widget_count', 10, 2 );


if ( ! function_exists( 'cd_remove_current_post_on_recent_widgets' ) ) {

	/**
	 * Remove the current post when showing a single article from the recent posts widgets.
	 *
	 * @param  string $args return widget's argument without current post.
	 * @since  1.0.0
	 * @return array
	 */
	function cd_remove_current_post_on_recent_widgets( $args ) {
		if ( is_single() ) {
			$args['post_not_in'] = array( get_the_ID() );
		}
		return $args;
	}
}
add_filter( 'widget_posts_args', 'cd_remove_current_post_on_recent_widgets', 10, 3 );


/*
 * -------------------------------------------------------------------------
 *  Call the bottom parts for each page
 * -------------------------------------------------------------------------
 */
if ( ! function_exists( 'cd_single_middle_contents' ) ) {

	include_once get_theme_file_path( 'parts/class-cd-preg-replace-callback.php' );

	/**
	 * The action hook for adding custom content on the first h2 or h3 tag on each single article through filter.
	 *
	 * @since  1.1.6
	 * @param  string $the_content The post contents which are hooked.
	 * @return string
	 */
	function cd_single_middle_of_content( $the_content ) {

		if ( is_single() ) {

			preg_match_all( '/<h2.*?>/i', $the_content, $h2_result ); // Whether or not h2 tag is used.
			preg_match_all( '/<h3.*?>/i', $the_content, $h3_result ); // Whether or not h3 tag is used.
			$h2_result = $h2_result[0];
			$h3_result = $h3_result[0];
			$h2_count  = count( $h2_result );
			$h3_count  = count( $h3_result );

			ob_start();
			do_action( 'cd_single_middle_of_content' );
			$middle_content = ob_get_clean();

			if ( ! empty( $h2_result[1] ) ) { // If h2 tag is present.
				$count       = 0;
				$callback    = new Cd_Preg_Replace_Callback( $count, $middle_content );
				$the_content = preg_replace_callback(
					'/<h2.*?>/i',
					array( $callback, 'cd_single_content_replace' ),
					$the_content,
					2
				);
			} elseif ( ! empty( $h3_result[1] ) ) { // If no h2 tag, but h3 tag is found.
				$count       = 0;
				$callback    = new Cd_Preg_Replace_Callback( $count, $middle_content );
				$the_content = preg_replace_callback(
					'/<h3.*?>/i',
					array( $callback, 'cd_single_content_replace' ),
					$the_content,
					2
				);
			}

			ob_start();
			do_action( 'cd_single_last_of_content' );
			$last_content = ob_get_clean();

			if ( ! empty( $h2_result ) && $h2_count >= 3 ) { // If h2 tag is present.
				$count       = 0;
				$callback    = new Cd_Preg_Replace_Callback( $count, $last_content, $h2_count );
				$the_content = preg_replace_callback(
					'/<h2.*?>/i',
					array( $callback, 'cd_single_content_replace_last' ),
					$the_content
				);
			} elseif ( ! empty( $h3_result ) && $h3_count >= 3 ) { // If no h2 tag, but h3 tag is found.
				$count       = 0;
				$callback    = new Cd_Preg_Replace_Callback( $count, $last_content, $h3_count );
				$the_content = preg_replace_callback(
					'/<h3.*?>/i',
					array( $callback, 'cd_single_content_replace_last' ),
					$the_content
				);
			}
		}
		return $the_content;
	}
	add_filter( 'the_content', 'cd_single_middle_of_content' );
}

if ( ! function_exists( 'cd_single_bottom_contents' ) ) {

	/**
	 * Call the the bottom parts of the single articles through filter.
	 *
	 * @since 1.1.0
	 */
	function cd_single_bottom_contents() {
		if ( function_exists( 'cd_addon_sns_buttons' ) && function_exists( 'cd_use_snsb' ) ) {
			if ( cd_use_snsb() ) {
				cd_addon_sns_buttons_list( 'single-bottom' );
			}
		}
		if ( cd_is_post_related() ) {
			get_template_part( 'parts/related-posts' );
		}
		if ( cd_is_post_single_comment() ) {
			cd_comments_template();
		}
		if ( cd_is_post_nav() ) {
			get_template_part( 'parts/post-nav' );
		}
	}
}

if ( ! function_exists( 'cd_single_after_contents' ) ) {

	/**
	 * The action hook for adding some contents after the article contents through filter.
	 *
	 * @since  1.1.6
	 * @param  string $contents The contents will be shown after the article contents.
	 * @return string
	 */
	function cd_single_after_contents( $contents = null ) {
		// You can add something here through the `cd_single_after_contents` filter.
		do_action( 'cd_single_after' );
		return $contents;
	}
}

if ( ! function_exists( 'cd_attachment_bottom_contents' ) ) {

	/**
	 * Call the the bottom parts of the attachment pages through filter.
	 *
	 * @since 1.1.2
	 */
	function cd_attachment_bottom_contents() {
		if ( cd_is_post_single_comment() ) {
			cd_comments_template();
		}
		if ( cd_is_post_nav() ) {
			get_template_part( 'parts/post-nav' );
		}
	}
}

if ( ! function_exists( 'cd_pages_bottom_contents' ) ) {

	/**
	 * Call the the bottom parts of the static pages through filter.
	 *
	 * @since 1.1.1
	 */
	function cd_pages_bottom_contents() {
		if ( cd_is_post_single_comment() ) {
			cd_comments_template();
		}
	}
}

if ( ! function_exists( 'cd_archive_top_contents' ) ) {
	/**
	 * Call the top parts of the archive pages through filter.
	 *
	 * @since  1.1.6
	 * @param  string $contents The contents will be shown on top of the article contents.
	 * @return string
	 */
	function cd_archive_top_contents( $contents = null ) {
		// You can add something here through `cd_archive_top_contents` filter.
		do_action( 'cd_archive_top' );
		return $contents;
	}
}

if ( ! function_exists( 'cd_archive_bottom_contents' ) ) {

	/**
	 * Call the the bottom parts of the archive pages through filter.
	 *
	 * @since 1.1.1
	 */
	function cd_archive_bottom_contents() {
		get_template_part( 'parts/page-nav' );
		do_action( 'cd_archive_bottom' );
	}
}


/*
 * -------------------------------------------------------------------------
 *  Breadcrumbs
 * -------------------------------------------------------------------------
 */
if ( ! function_exists( 'cd_breadcrumb' ) ) {

	/**
	 * Returns suitable breadcrumb
	 *
	 * @since 1.0.0
	 **/
	function cd_breadcrumb() {
		echo '<a href="' . esc_url( home_url() ) . '">' . esc_html__( 'Home', 'coldbox' ) . '</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;';
		if ( is_attachment() ) {
			esc_html_e( 'Attachment', 'coldbox' );
		} elseif ( is_single() ) {
			the_category( ' &#47; ' );
		} elseif ( is_category() ) {
			global $wp_query;
			$current_cat = $wp_query->get_queried_object();
			$cat         = $wp_query->get_queried_object();

			if ( $cat->parent ) { // If the category has parent category.
				$parent = array();
				while ( $cat->parent ) {
					$cat      = get_category( $cat->parent );
					$cat_name = $cat->name;
					$cat_url  = get_category_link( $cat->cat_ID );
					$parent   = array_merge(
						$parent,
						array(
							$cat_name => $cat_url,
						)
					);
				}
				$parent_rev = array_reverse( $parent );
				foreach ( $parent_rev as $key => $value ) {
					echo '<a href="' . esc_url( $value ) . '">' . esc_html( $key ) . '</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;';
				}
				echo '<span>' . esc_html( $current_cat->name ) . '</span>';
			} else {
				echo esc_html( $cat->name );
			}
		} elseif ( is_author() ) {
			the_author();
		} elseif ( is_page() ) {
			the_title();
		}
	}
} // End if.

/*
 * -------------------------------------------------------------------------
 *  Appearance
 * -------------------------------------------------------------------------
 */

/*
 * the_excerpt
 * --------------------------------------------------
 */
if ( ! function_exists( 'cd_excerpt_length' ) ) {
	/**
	 * The length of the excerpt which set on the customizer.
	 *
	 * @since  1.0.0
	 * @param  int $length The length.
	 * @return int
	 */
	function cd_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		return cd_czr_excerpt_length( $length );
	}
}
add_filter( 'excerpt_length', 'cd_excerpt_length', 999 );

if ( ! function_exists( 'cd_excerpt_more' ) ) {

	/**
	 * The ending of the excerpt which set on the customizer.
	 *
	 * @since  1.0.0
	 * @param  string $more The ending strings.
	 * @return string
	 */
	function cd_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		return cd_czr_excerpt_ending( $more );
	}
}
add_filter( 'excerpt_more', 'cd_excerpt_more' );


/*
 * Site Title
 * --------------------------------------------------
 */
if ( ! function_exists( 'cd_site_title' ) ) {

	/**
	 * Return the site name or logo if set.
	 *
	 * @since 1.0.0
	 **/
	function cd_site_title() {

		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {

			$logo  = '<a href="' . esc_url( home_url() ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
			$logo .= '<div class="site-logo">';
			$image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
			$logo .= '<img src="' . esc_url( $image[0] ) . '" width="' . absint( $image[1] ) . '" height="' . absint( $image[2] ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" />';
			$logo .= '</div>';
			$logo .= '</a>';

			echo apply_filters( 'cd_custom_logo', $logo ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		}

		if ( cd_is_site_title() ) {

			if ( is_front_page() ) {
				$title_tagname = 'h1';
			} else {
				$title_tagname = 'h2';
			}

			$logo  = '<a href="' . esc_url( home_url() ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
			$logo .= "<${title_tagname} class=\"site-title\">" . esc_html( get_bloginfo( 'name' ) ) . "</${title_tagname}>";
			$logo .= '</a>';

			echo apply_filters( 'cd_site_title', $logo ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}

if ( ! function_exists( 'cd_header_image' ) ) {
	if ( has_header_image() ) {

		/**
		 * Appear the header background image as CSS background image.
		 *
		 * @since 1.0.0
		 */
		function cd_header_image() {
			$style = "#header { background-image: url('" . get_header_image() . "'); }";
			echo '<style>' . $style . '</style>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		add_action( 'wp_head', 'cd_header_image' );
	}
}


if ( ! function_exists( 'cd_prev_post_thumbnail' ) ) {
	/**
	 * Echo next / previous post thumbnail URL
	 *
	 * @since 1.1.6
	 */
	function cd_prev_post_thumbnail() {

		$prev_post = get_previous_post();
		$next_post = get_next_post();

		if ( ! empty( $prev_post ) && is_single() && cd_is_post_nav() ) {
			$prev_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_previous_post()->ID ), array( 600, 600 ), false );

			if ( $prev_thumbnail ) {
				wp_add_inline_style( 'cd-style', '.prev .post-thumbnail{background-image:url("' . $prev_thumbnail[0] . '")}' );
			}
		}
		if ( ! empty( $next_post ) && is_single() && cd_is_post_nav() ) {
			$next_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_next_post()->ID ), array( 600, 600 ), false );

			if ( $next_thumbnail ) {
				wp_add_inline_style( 'cd-style', '.next .post-thumbnail{background-image:url("' . $next_thumbnail[0] . '")}' );
			}
		}

	}
}
add_action( 'wp_enqueue_scripts', 'cd_prev_post_thumbnail' );

if ( ! function_exists( 'cd_modify_archive_title' ) ) {
	/**
	 * Modify `the_archive_title()` function to output.
	 *
	 * @param  string $title The archive title name.
	 * @return string
	 **/
	function cd_modify_archive_title( $title ) {
		if ( is_category() ) {
			$title = '<h1><span class="title-description">' . esc_html__( 'Category:', 'coldbox' ) . '&#32;</span>' . single_cat_title( '', false ) . '</h1>';
		} elseif ( is_tag() ) {
			$title = '<h1><span class="title-description">' . esc_html__( 'Tag:', 'coldbox' ) . '&#32;</span>' . single_tag_title( '', false ) . '</h1>';
		} elseif ( is_day() ) {
			$title = '<h1><span class="title-description">' . esc_html__( 'Daily Archive:', 'coldbox' ) . '&#32;</span>' . get_the_date( get_option( 'date_format' ) ) . '</h1>';
		} elseif ( is_month() ) {
			$title = '<h1><span class="title-description">' . esc_html__( 'Monthly Archive:', 'coldbox' ) . '&#32;</span>' . get_the_date( _x( 'F, Y', 'Date Format', 'coldbox' ) ) . '</h1>';
		} elseif ( is_year() ) {
			$title = '<h1><span class="title-description">' . esc_html__( 'Yearly Archive:', 'coldbox' ) . '&#32;</span>' . get_the_date( 'Y' ) . '</h1>';
		} elseif ( is_author() ) {
			$title = '<h1><span class="title-description">' . esc_html__( 'Author:', 'coldbox' ) . '&#32;</span>' . get_the_author_meta( 'display_name' ) . '</h1>';
		}
		return $title;
	}
}
add_filter( 'get_the_archive_title', 'cd_modify_archive_title' );

/*
 *  FontAwesome Icon
 * --------------------------------------------------
 */
if ( ! function_exists( 'cd_post_format_icon' ) ) {

	/**
	 * Get FontAwesome icon class for specific post format.
	 *
	 * @param string $format Name of post format.
	 *
	 * @return string
	 *
	 * @since 1.7.0
	 */
	function cd_post_format_icon( $format ) {
		if ( 'aside' === $format ) {
			$icon = 'fas fa-circle';
		} elseif ( 'gallery' === $format ) {
			$icon = 'fas fa-file-image';
		} elseif ( 'icon' === $format ) {
			$icon = 'fas fa-link';
		} elseif ( 'image' === $format ) {
			$icon = 'fas fa-image';
		} elseif ( 'quote' === $format ) {
			$icon = 'fas fa-quote-left';
		} elseif ( 'status' === $format ) {
			$icon = 'fas fa-star';
		} elseif ( 'video' === $format ) {
			$icon = 'fas fa-video';
		} elseif ( 'audio' === $format ) {
			$icon = 'fas fa-file-audio';
		} elseif ( 'chat' === $format ) {
			$icon = 'fas fa-comment-alt';
		} elseif ( 'link' === $format ) {
			$icon = 'fas fa-link';
		} else {
			$icon = '';
		}
		return $icon;
	}
}

/*
 * -------------------------------------------------------------------------
 *  Theme definitions
 * -------------------------------------------------------------------------
 */
define( 'CD_VER', '1.8.4' );

/*
 * -------------------------------------------------------------------------
 *  Addon plugin integrations
 * -------------------------------------------------------------------------
 */

// Load TGM plugin activation file.
require_once get_template_directory() . '/parts/tgm/load-tgm.php';

if ( ! function_exists( 'cd_is_active_addon' ) ) {
	/**
	 * Whether or not addon plugin is active.
	 *
	 * @since 1.2.0
	 */
	function cd_is_active_addon() {
		$is_active = false;
		return apply_filters( 'cd_is_active_addon', $is_active );
	}
	add_action( 'plugins_loaded', 'cd_is_active_addon', 1 );
}

if ( ! function_exists( 'cd_is_amp' ) ) {

	/**
	 * Whether or not AMP page.
	 *
	 * @since 1.2.0
	 */
	function cd_is_amp() {
		$is_amp = false;
		return apply_filters( 'cd_is_amp', $is_amp );
	}
	add_action( 'wp', 'cd_is_amp', 1 );
}
