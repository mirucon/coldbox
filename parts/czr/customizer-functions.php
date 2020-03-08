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
	$sidebar_position = get_theme_mod( 'sidebar_position', 'right' );
	return apply_filters( 'cd_sidebar_stg', $sidebar_position );
}

/**
 * Returns theme_button.
 *
 * @since 1.5.0
 * @return bool
 */
function cd_show_theme_button() {
	$theme_button = get_theme_mod( 'theme_button', true );

	return apply_filters( 'cd_show_theme_button', $theme_button );
}

/**
 * Get whether using of the hljs or not.
 *
 * @since 1.0.0
 */
function cd_use_normal_hljs() {
	$hljs = get_theme_mod( 'does_use_hljs', false );

	return apply_filters( 'cd_use_normal_hljs', $hljs );
}

/**
 * Get whether using of the hljs with web package or not.
 *
 * @since 1.0.0
 */
function cd_use_web_hljs() {
	$hljs_web = get_theme_mod( 'use_hljs_web_pack', false );

	return apply_filters( 'cd_use_web_hljs', $hljs_web );
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
	$header_direction = get_theme_mod( 'header_direction', 'column' );

	return apply_filters( 'cd_header_direction', $header_direction );
}

/**
 * Get the header's sticky setting
 *
 * @since 1.0.0
 */
function cd_header_sticky() {
	$sticky = get_theme_mod( 'header_sticky', true );

	return apply_filters( 'cd_header_sticky', $sticky );
}

/**
 * Get whether displaying the site title or not
 *
 * @since 1.0.2
 */
function cd_is_site_title() {
	$title = get_theme_mod( 'site_title', true );

	return apply_filters( 'cd_is_site_title', $title );
}

/**
 * Get whether displaying the site tagline or not
 *
 * @since 1.0.0
 */
function cd_is_site_desc() {
	$desc = get_theme_mod( 'site_desc', true );

	return apply_filters( 'cd_is_site_desc', $desc );
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
 * @return bool
 */
function cd_is_theme_credit() {
	$credit = get_theme_mod( 'theme_credit', true );
	return apply_filters( 'cd_is_theme_credit', $credit );
}

/**
 * Get the contents of the theme credit text.
 *
 * @since 1.0.0
 * @return string
 */
function cd_theme_credit_text() {
	$text = get_theme_mod( 'theme_credit_text', __( 'Coldbox WordPress theme by', 'coldbox' ) . ' <a href="' . esc_url( __( 'https://miruc.co/', 'coldbox' ) ) . '">' . __( 'mirucon', 'coldbox' ) . '</a>' );
	return apply_filters( 'cd_theme_credit_text', $text );
}

/**
 * Get the contents of the credit text.
 *
 * @since 1.0.0
 * @return string
 */
function cd_credit() {
	$text = get_theme_mod( 'credit_text', '&copy;[year] <a href="[url]">[name]</a>' );
	// phpcs:ignore WordPress.DateTime.RestrictedFunctions.date_date
	$text = str_replace( '[year]', esc_html( date( 'Y' ) ), $text );
	$text = str_replace( '[url]', esc_url( home_url() ), $text );
	$text = str_replace( '[name]', esc_html( get_bloginfo( 'name' ) ), $text );

	return apply_filters( 'cd_credit', $text );
}

/**
 * Get whether it shows the privacy policy link in footer or not.
 *
 * @since 1.5.3
 * @return bool
 */
function cd_is_privacy_policy_link_shown() {
	$link = get_theme_mod( 'privacy_policy_page_link', true );
	return apply_filters( 'cd_is_privacy_policy_link_shown', $link );
}
