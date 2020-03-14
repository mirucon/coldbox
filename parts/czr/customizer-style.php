<?php
/**
 * The template for displaying the styles got from the theme customizer
 *
 * @since 1.0.0
 * @package Coldbox
 */

if ( ! function_exists( 'cd_customizer_style' ) ) {

	/**
	 * The inline styles that from the theme customizer.
	 *
	 * @since 1.0.0
	 */
	function cd_customizer_style() {

		$czr_style = '';

		/*
		 * -------------------------------------------------------------------------
		 *  Global
		 * -------------------------------------------------------------------------
		 */

		// Container Width.
		if ( get_theme_mod( 'container_width', '1140' ) !== '1140' ) {
			$container_width = absint( get_theme_mod( 'container_width' ) );
			$czr_style      .= ".container { max-width: ${container_width}px; } ";
		}

		// Font size for PC.
		if ( get_theme_mod( 'global_font_size_pc', 16 ) !== 16 ) {
			$font_size_pc = absint( get_theme_mod( 'global_font_size_pc' ) );
			$czr_style   .= "body { font-size: ${font_size_pc}px; } ";
		}

		// Font size for mobile devices.
		if ( get_theme_mod( 'global_font_size_mobile', 15 ) !== 15 ) {
			$font_size_mobile = get_theme_mod( 'global_font_size_mobile' );
			$czr_style       .= "@media screen and ( max-width: 767px ) {
				body {
					font-size: ${font_size_mobile}px;
				}
			}";
		}

		/*
		 * -------------------------------------------------------------------------
		 *  Header
		 * -------------------------------------------------------------------------
		 */

		// Whether to hide site title and description.
		if ( ! display_header_text() ) {
			$czr_style .= '.site-title, .site-description {
			   position: absolute;
			   width: 1px; height: 1px;
			   clip: rect(1px, 1px, 1px, 1px);
			   overflow: hidden;
			}';
		}

		// The font size for site title.
		if (
			get_theme_mod( 'site_title_size', 185 ) !== 185 ||
			get_theme_mod( 'site_title_size', '185' ) !== '185' &&
			get_theme_mod( 'site_title_size', 185 ) !== 0
		) {
			$size      = absint( get_theme_mod( 'site_title_size' ) );
			$size_em   = $size / 100;
			$czr_style = "body .site-title {
				font-size: ${size_em}em;
			}";
		}

		// Whether to add decoration to headings.
		if ( get_theme_mod( 'decorate_htags', false ) ) {
			$czr_style .= '.entry h2 { margin: 2em -40px 1.3em; padding: 1.3rem 30px; border-style: solid; border-width: 1px 0; overflow: hidden; }
			@media screen and (max-width: 640px) { .entry h2 { margin-left: -20px; margin-right: -20px; padding-left: 10px; padding-right: 10px; } }
			.entry h3 { margin: 1.6em -10px 1.1em; padding: 0 5px .4rem; border-bottom: 2px solid rgba(0, 0, 0, .5); overflow: hidden; }
			.entry h4 { padding: 0 0 .4rem; border-bottom: 2px solid #bbb; overflow: hidden; }
			.entry h5 { padding: 0 0 .4rem; border-bottom: 1px dotted #bbb; overflow: hidden; }';
		}

		// Change the number of grid columns for desktop & tablet.
		if ( get_theme_mod( 'grid_columns', 2 ) !== 2 ) {
			$grid_columns   = absint( get_theme_mod( 'grid_columns', 2 ) );
			$width_percents = 100 / $grid_columns . '%';
			$czr_style     .=
				".grid-view .article, .grid-view .page, .grid-view .post {
					width: $width_percents;
				}";
		}

		// Change the number of grid columns for mobile.
		// Always output this to avoid that the value above applies to mobile.
		$grid_columns   = absint( get_theme_mod( 'grid_columns_mobile', 1 ) );
		$width_percents = 100 / $grid_columns . '%';
		$czr_style     .= "@media screen and (max-width: 640px) {
			.grid-view .article, .grid-view .page, .grid-view .post {
				width: $width_percents;
			}
		}";

		// Related posts the number of columns.
		if ( get_theme_mod( 'single_related_col', 3 ) !== 3 ) {
			$rel_col    = esc_html( get_theme_mod( 'single_related_col', 3 ) );
			$czr_style .= " .related-posts .related-article { width: calc(100% / {$rel_col}); } ";
		}

		// Change .site-info padding.
		if ( get_theme_mod( 'header_padding', 30 ) !== 30 ) {
			$header_padding = absint( get_theme_mod( 'header_padding', 30 ) );
			$czr_style     .= "body .site-info { padding-top:${header_padding}px; padding-bottom:${header_padding}px }";
		}

		// Whether to use narrower padding when scrolling.
		if ( ! get_theme_mod( 'use_narrower_padding', true ) ) {
			$header_padding = absint( get_theme_mod( 'header_padding', 30 ) );
			$czr_style     .= "body.header-row .sticky .site-info {
				padding-top: ${header_padding}px;
				padding-bottom: ${header_padding}px;
			}";
		}

		// Custom Logo Sizing.
		if ( get_theme_mod( 'logo_width', 230 ) !== 230 ) {
			$logo_width = esc_html( get_theme_mod( 'logo_width', 230 ) );
			$czr_style .= ".site-info img { max-width: ${logo_width}px }";
		}

		/*
		 * ------------------------------------------------------------------------- *
		 *  COLOR SETTINGS
		 * --------------------------------------------------------------------------
		 */

		// Link Color.
		if ( get_theme_mod( 'link_color', '#00619f' ) !== '#00619f' ) {
			$color_link = esc_html( get_theme_mod( 'link_color' ) );
			$czr_style .= ".entry a, .title-box a:hover, .post-meta a:hover, .post-meta.content-box a:hover, .post-btm-tags a:hover, p.post-btm-cats a:hover,
			.related-posts .post-category a, .related-posts .post:hover .post-title, .post-pages, .grid-view .post-inner a:hover .post-title,
			.standard-view .post-title:hover, ul.page-numbers, .widget #wp-calendar a, .widget .widgets-list-layout li:hover a,
			#comment-list .comment-author .fn a, #respond .logged-in-as a:hover, .comment-pages, .comment-pages a,.comment-pages span,
			.comment-body a, .comment-tabmenu .active > a, .standard-view .post-inner:hover .post-title, .widget .textwidget a {
				color: ${color_link};
			}
			#comments input[type=submit], .post-tags a, .post-tags a, .main-archive .post-date, .action-bar,input[type=submit]:hover,
			input[type=submit]:focus, input[type=button]:hover, input[type=button]:focus, button[type=submit]:hover, button[type=submit]:focus,
			button[type=button]:hover, button[type=button]:focus {
				background-color: ${color_link};
			}
			.comment-pages > a:hover, .comment-pages span, .post-pages > a:hover>span,.post-pages>span,
			ul.page-numbers span.page-numbers.current,ul.page-numbers a.page-numbers:hover {
				border-bottom-color: ${color_link};
			}
			textarea:focus { border-color: ${color_link}; }
			::selection { background-color: ${color_link}; }
			::moz-selection { background-color: ${color_link}; }";
		}

		// Link Hover Color.
		if ( get_theme_mod( 'link_hover_color', '#2e4453' ) !== '#2e4453' ) {
			$color_hover = esc_html( get_theme_mod( 'link_hover_color' ) );
			$czr_style  .= ".entry a:hover, .comment-body a:hover, .sidebar #wp-calender a:hover, .widget .textwidget a:hover {
				color: ${color_hover};
			}";
		}

		// Header text color.
		if ( get_theme_mod( 'header_textcolor', '#444444' ) !== '#444444' ) {
			$header_textcolor  = esc_html( get_header_textcolor() );
			list( $r, $g, $b ) = sscanf( $header_textcolor, '%02x%02x%02x' );
			$r_h               = $r - 20;
			$g_h               = $g - 20;
			$b_h               = $b - 20;
			$r_h               = $r_h < 0 ? 0 : $r_h;
			$g_h               = $g_h < 0 ? 0 : $g_h;
			$b_h               = $b_h < 0 ? 0 : $b_h;
			$r                += 10;
			$g                += 10;
			$b                += 10;
			$r                 = $r > 255 ? 255 : $r;
			$g                 = $g > 255 ? 255 : $g;
			$b                 = $b > 255 ? 255 : $b;
			$czr_style        .= ".site-info,.site-title { color: #${header_textcolor}; }
			.site-description{ color: rgb(${r}, ${g}, ${b}); }
			.header-menu .menu-container > li > a { color: #${header_textcolor} }
			.header-menu .menu-container > li:hover > a { color: rgb(${r_h}, ${g_h}, ${b_h}) }
			:root body .search-toggle span.icon.search { border-color: #${header_textcolor} }
			:root body .search-toggle span.icon.search::before,.nav-toggle .bottom, .nav-toggle .middle, .nav-toggle .top {
				background-color: #${header_textcolor}
			}";
		}

		// Header Background Color.
		if ( get_theme_mod( 'header_color', '#ffffff' ) !== '#ffffff' ) {
			$color_header = esc_html( get_theme_mod( 'header_color' ) );
			$czr_style   .= "#header { background-color: $color_header; } ";
		}

		// Header menu text color for mobile.
		if ( get_theme_mod( 'header_menu_mobile', '#ffffff' ) !== '#ffffff' ) {
			$header_text_color = esc_html( get_theme_mod( 'header_menu_mobile' ) );
			$czr_style        .= "@media screen and (max-width: 767px) {
				body #header-nav.menu-container li a {
			        color: ${header_text_color};
		        }
			}";
		}

		// Header Menu Background Color for Mobile devices.
		if ( get_theme_mod( 'header_menu_background', '#51575d' ) !== '#51575d' ) {
			$header_menu_background = esc_html( get_theme_mod( 'header_menu_background' ) );
			$czr_style             .= "@media screen and (max-width: 767px) {
				#header-nav {
					background-color:${header_menu_background}
				}
			}";
		}

		// Footer Menu Background Color.
		if ( get_theme_mod( 'footer_menu_color', '#dddddd' ) !== '#dddddd' ) {
			$color_footer_menu = esc_html( get_theme_mod( 'footer_menu_color' ) );
			$czr_style        .= ".footer-menu { background-color: $color_footer_menu; } ";
		}

		// Footer Background Color.
		if ( get_theme_mod( 'footer_color', '#44463b' ) !== '#44463b' ) {
			$color_footer = esc_html( get_theme_mod( 'footer_color' ) );
			$czr_style   .= ".footer-bottom { background-color: $color_footer; } ";
		}

		// Title Box Color.
		if ( get_theme_mod( 'title_box_color', '#f8f8f8' ) !== '#f8f8f8' ) {
			$color_title_box = esc_html( get_theme_mod( 'title_box_color' ) );
			$czr_style      .= ".title-box { background-color: $color_title_box; }";
		}

		// Content Wrapper Color.
		if ( get_theme_mod( 'content_wrapper_color', '#fafafa' ) !== '#fafafa' ) {
			$color_content_wrapper = esc_html( get_theme_mod( 'content_wrapper_color' ) );
			$czr_style            .= ".content-inner { background-color: $color_content_wrapper; }";
		}

		// Sidebar Wrapper Color.
		if ( get_theme_mod( 'sidebar_wrapper_color', '#fafafa' ) !== '#fafafa' ) {
			$color_sidebar_wrapper = esc_html( get_theme_mod( 'sidebar_wrapper_color' ) );
			$czr_style            .= ".sidebar { background-color: $color_sidebar_wrapper; }";
		}

		$czr_style = cd_css_minify( $czr_style );
		wp_add_inline_style( 'cd-style', $czr_style );

	}
} // End if.
add_action( 'wp_enqueue_scripts', 'cd_customizer_style' );
