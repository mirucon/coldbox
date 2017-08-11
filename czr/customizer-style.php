<?php
/**
 * The template for displaying the styles got from the theme customizer
 *
 * @since 1.0.0
 * @package coldbox
 */

if ( ! function_exists( 'cd_customizer_style' ) ) {

	/**
	 * The inline styles that from the theme customizer.
	 *
	 * @since 1.0.0
	 */
	function cd_customizer_style() {

		// Container Width.
		if ( get_theme_mod( 'container_width', '1140' ) !== '1140' ) {
			$container_width = get_theme_mod( 'container_width' );
			$czr_container_width = ".container { max-width: ${container_width}px; } ";
			wp_add_inline_style( 'main-style', $czr_container_width );
		}

		// Font size for PC.
		if ( get_theme_mod( 'global_font_size_pc', '17' ) !== '17' ) {
			$font_size_pc = get_theme_mod( 'global_font_size_pc' );
			$czr_font_size_pc = "body { font-size: ${font_size_pc}px; } ";
			wp_add_inline_style( 'main-style', $czr_font_size_pc );
		}

		// Font size for mobile devices.
		if ( get_theme_mod( 'global_font_size_mobile', '16' ) !== '16' ) {
			$font_size_mobile = get_theme_mod( 'global_font_size_mobile' );
			$czr_font_size_mobile = "@media screen and ( max-width: 767px ) { body { font-size: ${font_size_mobile}px; } } ";
			wp_add_inline_style( 'main-style', $czr_font_size_mobile );
		}

		// Add decorations to h tags.
		if ( get_theme_mod( 'decorate_htags', false ) ) {
			$czr_style_htags = '.entry h2 { margin: 2em -40px 1.3em; padding: 1.3rem 30px; border-style: solid; border-width: 1px 0; overflow: hidden; }
			@media screen and (max-width: 640px) { .entry h2 { margin-left: -20px; margin-right: -20px; padding-left: 10px; padding-right: 10px; } }
			.entry h3 { margin: 1.6em -10px 1.1em; padding: 0 5px .4rem; border-bottom: 2px solid rgba(0, 0, 0, .5); overflow: hidden; }
			.entry h4 { padding: 0 0 .4rem; border-bottom: 2px solid #bbb; overflow: hidden; }
			.entry h5 { padding: 0 0 .4rem; border-bottom: 1px dotted #bbb; overflow: hidden; }';
			wp_add_inline_style( 'main-style', $czr_style_htags );
		}

		// Link Color.
		if ( get_theme_mod( 'link_color', '#00619f' ) !== '#00619f' ) {
			$color_link = get_theme_mod( 'link_color' );
			$czr_color_link = ".entry a, .title-box a:hover, .post-meta a:hover, .post-meta.content-box a:hover, .post-btm-tags a:hover, p.post-btm-cats a:hover, .related-posts .post-category a, .related-posts .post:hover .post-title, .post-pages, .grid-view .post-inner a:hover .post-title, .standard-view .post-title:hover, ul.page-numbers, .widget #wp-calendar a, .widget .widgets-list-layout li:hover a, #comment-list .comment-author .fn a, #respond .logged-in-as a:hover, .comment-pages, .comment-pages a,.comment-pages span, .comment-body a, .comment-tabmenu .active > a, .standard-view .post-inner:hover .post-title, .widget .textwidget a { color: $color_link; }
			#comments input[type=submit], .post-tags a, .post-tags a, .main-archive .post-date, .action-bar { background-color: $color_link; }
			textarea:focus { border-color: $color_link; }
			.comment-pages > a:hover, .comment-pages span, .post-pages > a:hover>span,.post-pages>span, ul.page-numbers span.page-numbers.current, ul.page-numbers a.page-numbers:hover { border-bottom-color: $color_link; }
			::selection { background-color: $color_link; }
			::moz-selection { background-color: $color_link; }";
			wp_add_inline_style( 'main-style', $czr_color_link );
		}

		// Link Hover Color.
		if ( get_theme_mod( 'link_hover_color', '#2e4453' ) !== '#2e4453' ) {
			$color_hover = get_theme_mod( 'link_hover_color' );
			$czr_color_hover = ".entry a:hover, .comment-body a:hover, .sidebar #wp-calender a:hover, .widget .textwidget a:hover { color: $color_hover; }";
			wp_add_inline_style( 'main-style', $czr_color_hover );
		}

		// Header Background Color.
		if ( get_theme_mod( 'header_color', '#ffffff' ) !== '#ffffff' ) {
			$color_header = get_theme_mod( 'header_color' );
			$czr_color_header = "#header { background-color: $color_header; } ";
			wp_add_inline_style( 'main-style', $czr_color_header );
		}

		// Header text color.
		if ( get_header_textcolor() !== '444444' ) {
			$header_textcolor = get_header_textcolor();
			list( $r, $g, $b ) = sscanf( $header_textcolor, '%02x%02x%02x' );
			$r_h = $r - 20;
			$g_h = $g - 20;
			$b_h = $b - 20;
			$r_h = $r_h < 0 ? 0 : $r_h;
			$g_h = $g_h < 0 ? 0 : $g_h;
			$r_h = $r_h < 0 ? 0 : $r_h;
			$r += 10;
			$g += 10;
			$b += 10;
			$r = $r > 255 ? 255 : $r;
			$g = $g > 255 ? 255 : $g;
			$b = $b > 255 ? 255 : $b;
			$czr_header_textcolor = ".site-info,.site-title{color:#${header_textcolor};}.site-description{color:rgb(${r}, ${g}, ${b});}
			#header-menu .menu-container > li > a{color:#${header_textcolor}}#header-menu .menu-container >  li:hover > a{color:rgb(${r_h}, ${g_h}, ${b_h})}
			:root body .search-toggle span.icon.search{border-color:#${header_textcolor}}:root body .search-toggle span.icon.search::before,.nav-toggle .bottom, .nav-toggle .middle, .nav-toggle .top{background-color:#${header_textcolor}}";
			wp_add_inline_style( 'main-style', $czr_header_textcolor );
		}

		// Footer Background Color.
		if ( get_theme_mod( 'footer_color', '#44463b' ) !== '#44463b' ) {
			$color_footer = get_theme_mod( 'footer_color' );
			$czr_color_footer = ".footer { background-color: $color_footer; } ";
			wp_add_inline_style( 'main-style', $czr_color_footer );
		}

		// Related Posts Columns.
		if ( get_theme_mod( 'single_related_col', 3 ) !== 3 ) {
			$rel_col = get_theme_mod( 'single_related_col' );
			$czr_rel_col = " .related-posts .related-article { width: calc(100% / {$rel_col}); } ";
			wp_add_inline_style( 'main-style', $czr_rel_col );
		}

	}
} // End if().
add_action( 'wp_enqueue_scripts', 'cd_customizer_style' );
