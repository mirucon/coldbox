<?php
/**
 * The template for displaying paginate links
 *
 * @since 1.0.0
 * @package Coldbox
 */

global $wp_query;

the_posts_pagination(
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
