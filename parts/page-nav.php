<?php
/**
 * The template for displaying paginate links
 *
 * @since 1.0.0
 * @package Coldbox
 */

global $wp_query;

$paginate_links = the_posts_pagination(
	array(
		'type'              => 'list',
		'end_size'          => '2',
		'mid_size'          => '3',
		'total'             => $wp_query->max_num_pages,
		'prev_text'         => '&laquo;',
		'next_text'         => '&raquo;',
		'after_page_number' => '',
	)
);

$allowed_html = array(
	'a'      => array(
		'href'    => array(),
		'onclick' => array(),
		'target'  => array(),
		'class'   => array(),
	),
	'p'      => array(
		'style'  => array(),
		'align'  => array(),
		'target' => array(),
		'class'  => array(),
	),
	'br'     => array(),
	'strong' => array(),
	'b'      => array(),
	'ul'     => array(
		'class' => array(),
	),
	'li'     => array(
		'class' => array(),
	),
	'span'   => array(
		'class' => array(),
	),
);

echo wp_kses( $paginate_links, $allowed_html );
