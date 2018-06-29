<?php
/**
 * Theme mods returner functions for theme customizer
 *
 * @since 1.6.0
 * @package Coldbox
 */

/*
 * -------------------------------------------------------------------------
 *  Global
 * -------------------------------------------------------------------------
 */

/**
 * Get the sidebar position
 *
 * @since 1.0.0
 */
function cd_sidebar_stg() {
	return ( get_theme_mod( 'sidebar_position', 'right' ) );
}

/**
 * Returns theme_button.
 *
 * @since 1.5.0
 * @return bool
 */
function cd_show_theme_button() {
	$theme_button = get_theme_mod( 'theme_button', true );

	return $theme_button;
}

/**
 * Get whether using minified CSS or not
 *
 * @since 1.0.0
 * @return string Return ".min" for true, empty for false.
 */
function cd_use_minified_css() {
	$minified_css = get_theme_mod( 'minified_css', true );
	$css_min      = $minified_css ? '.min' : '';
	$css_min      = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : $css_min;

	return apply_filters( 'cd_use_minified_css', $css_min );
}

/**
 * Get whether using minified JS or not
 *
 * @since 1.0.0
 * @return string Return ".min" for true, empty for false.
 */
function cd_use_minified_js() {
	$minified_js = get_theme_mod( 'minified_js', true );
	$js_min      = $minified_js ? '.min' : '';
	$js_min      = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : $js_min; // If the SCRIPT_DEBUG is defined and set true, this should return empty value.

	return apply_filters( 'cd_use_minified_js', $js_min );
}

/**
 * Get whether not to load jQuery or not
 *
 * @since 1.6.0
 */
function cd_do_not_load_jquery() {
	$do_not_load_jquery = get_theme_mod( 'do_not_load_jquery', true );

	return apply_filters( 'cd_do_not_load_jquery', $do_not_load_jquery );
}

/**
 * Get whether using of the hljs or not.
 *
 * @since 1.0.0
 */
function cd_use_normal_hljs() {
	return ( get_theme_mod( 'does_use_hljs', false ) );
}

/**
 * Get whether using of the hljs with web package or not.
 *
 * @since 1.0.0
 */
function cd_use_web_hljs() {
	return ( get_theme_mod( 'use_hljs_web_pack', false ) );
}

/**
 * Get whether using minified JS or not
 *
 * @since 1.5.0
 */
function cd_use_concat_js() {
	$concat_js = get_theme_mod( 'concat_js', true );

	return apply_filters( 'cd_use_concat_js', $concat_js );
}

/*
 * -------------------------------------------------------------------------
 *  Header
 * -------------------------------------------------------------------------
 */

/**
 * Get the header direction
 *
 * @since 1.0.0
 */
function cd_header_direction() {
	return ( get_theme_mod( 'header_direction', 'column' ) );
}

/**
 * Get the header's sticky setting
 *
 * @since 1.0.0
 */
function cd_header_sticky() {
	return ( get_theme_mod( 'header_sticky', true ) );
}

/**
 * Get whether displaying the site title or not
 *
 * @since 1.0.2
 */
function cd_is_site_title() {
	return ( get_theme_mod( 'site_title', true ) );
}

/**
 * Get whether displaying the site tagline or not
 *
 * @since 1.0.0
 */
function cd_is_site_desc() {
	return ( get_theme_mod( 'site_desc', true ) );
}

/*
 * -------------------------------------------------------------------------
 *  Archive
 * -------------------------------------------------------------------------
 */

/**
 * Get page style for index pages
 *
 * @since 1.0.0
 */
function cd_index_style() {
	return ( get_theme_mod( 'index_style', 'grid' ) );
}

/**
 * Get page style for archive pages
 *
 * @since 1.0.0
 */
function cd_archive_style() {
	return ( get_theme_mod( 'archive_style', 'grid' ) );
}

/**
 * Get the length of the excerpt.
 *
 * @since 1.0.0
 */
function cd_czr_excerpt_length() {
	return ( get_theme_mod( 'excerpt_length', 60 ) );
}

/**
 * Get the ending strings of the excerpt.
 *
 * @since 1.0.0
 */
function cd_czr_excerpt_ending() {
	return ( get_theme_mod( 'excerpt_ending', '&#46;&#46;&#46;' ) );
}

/**
 * Get whether using placeholder image or not.
 *
 * @since 1.1.2
 */
function cd_index_placefolder_image() {
	return ( get_theme_mod( 'index_placefolder_image', true ) );
}

/**
 * Get whether displaying the date on index pages.
 *
 * @since 1.0.0
 */
function cd_index_meta_date() {
	return ( get_theme_mod( 'index_meta_date', true ) );
}

/**
 * Get whether displaying the categories on index pages.
 *
 * @since 1.0.0
 */
function cd_index_meta_cat() {
	return ( get_theme_mod( 'index_meta_cat', true ) );
}

/**
 * Get whether displaying the comments count on index pages.
 *
 * @since 1.0.0
 */
function cd_index_meta_comment() {
	return ( get_theme_mod( 'index_meta_comment', true ) );
}

/*
 * -------------------------------------------------------------------------
 *  Single
 * -------------------------------------------------------------------------
 */

/**
 * Get whether displaying thumbnail image on single pages.
 *
 * @since 1.5.4
 **/
function cd_is_thumbnail_image_shown() {
	return get_theme_mod( 'thumbnail_image_on_single', false );
}

/**
 * Get whether displaying the date on single pages.
 *
 * @since 1.0.0
 */
function cd_is_meta_date() {
	return ( get_theme_mod( 'single_meta_date', true ) );
}

/**
 * Get whether displaying the modified date on single pages.
 *
 * @since 1.0.0
 */
function cd_is_meta_modified() {
	return ( get_theme_mod( 'single_meta_modified_date', true ) );
}

/**
 * Get whether displaying the categories on single pages.
 *
 * @since 1.0.0
 */
function cd_is_meta_cat() {
	return ( get_theme_mod( 'single_meta_cat', false ) );
}

/**
 * Get whether displaying the author on single pages.
 *
 * @since 1.0.0
 */
function cd_is_meta_author() {
	return ( get_theme_mod( 'single_meta_author', true ) );
}

/**
 * Get whether displaying the comments count on single pages.
 *
 * @since 1.0.0
 */
function cd_is_meta_com() {
	return ( get_theme_mod( 'single_meta_com', true ) );
}

/**
 * Get whether displaying the tags on bottom of single pages.
 *
 * @since 1.0.0
 */
function cd_is_meta_btm_tag() {
	return ( get_theme_mod( 'single_meta_btm_tag', true ) );
}

/**
 * Get whether displaying the categories on bottom of single pages.
 *
 * @since 1.0.0
 */
function cd_is_meta_btm_cat() {
	return ( get_theme_mod( 'single_meta_btm_cat', true ) );
}

/**
 * Get whether displaying the author box on single pages.
 *
 * @since 1.0.0
 */
function cd_is_author_box() {
	return ( get_theme_mod( 'single_author_box', true ) );
}

/**
 * Get whether displaying the comments on single pages.
 *
 * @since 1.0.0
 */
function cd_is_post_single_comment() {
	return ( get_theme_mod( 'single_comment', true ) );
}

/**
 * Get whether displaying the post navigation on single pages.
 *
 * @since 1.0.0
 */
function cd_is_post_nav() {
	return ( get_theme_mod( 'single_post_nav', true ) );
}

/**
 * Get whether displaying the related posts on single pages.
 *
 * @since 1.0.0
 */
function cd_is_post_related() {
	return ( get_theme_mod( 'single_related_posts', true ) );
}

/**
 * Get the max articles shown on related posts.
 *
 * @since 1.0.0
 */
function cd_single_related_max() {
	return ( get_theme_mod( 'single_related_max', 6 ) );
}

/**
 * Get the column number of related posts.
 *
 * @since 1.0.0
 */
function cd_single_related_col() {
	return ( get_theme_mod( 'single_related_col', 2 ) );
}

/*
 * -------------------------------------------------------------------------
 *  Pages
 * -------------------------------------------------------------------------
 */

/**
 * Get whether displaying the data on static pages.
 *
 * @since 1.1.1
 */
function cd_pages_meta_date() {
	return ( get_theme_mod( 'pages_meta_date', false ) );
}

/**
 * Get whether displaying the author on static pages.
 *
 * @since 1.1.1
 */
function cd_pages_meta_author() {
	return ( get_theme_mod( 'pages_meta_author', false ) );
}

/**
 * Get whether displaying the comments count on static pages.
 *
 * @since 1.1.1
 */
function cd_pages_meta_comments_count() {
	return ( get_theme_mod( 'pages_meta_comments_count', false ) );
}

/*
 * -------------------------------------------------------------------------
 *  Footer
 * -------------------------------------------------------------------------
 */

/**
 * Get whether displaying theme credit or not.
 *
 * @since 1.0.0
 */
function cd_is_theme_credit() {
	return ( get_theme_mod( 'theme_credit', true ) );
}

/**
 * Get the contents of the theme credit text.
 *
 * @since 1.0.0
 */
function cd_theme_credit_text() {
	return get_theme_mod( 'theme_credit_text', __( 'Coldbox WordPress theme by', 'coldbox' ) . ' <a href="' . esc_url( __( 'https://miruc.co/', 'coldbox' ) ) . '">' . __( 'Mirucon', 'coldbox' ) . '</a>' );
}

/**
 * Get the contents of the credit text.
 *
 * @since 1.0.0
 */
function cd_credit() {
	$text = get_theme_mod( 'credit_text', '&copy;[year] <a href="[url]">[name]</a>' );
	$text = str_replace( '[year]', esc_html( date( 'Y' ) ), $text );
	$text = str_replace( '[url]', esc_url( home_url() ), $text );
	$text = str_replace( '[name]', esc_html( get_bloginfo( 'name' ) ), $text );

	return $text;
}

/**
 * Get whether it shows the privacy policy link in footer or not.
 *
 * @since 1.5.3
 * @return bool
 */
function cd_is_privacy_policy_link_shown() {
	return get_theme_mod( 'privacy_policy_page_link', true );
}