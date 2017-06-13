<?php
global $wp_query;
echo paginate_links( array(
  'type'               => 'list',
  'end_size'           => '2',
  'mid_size'           => '3',
  'total'              => $wp_query->max_num_pages,
  'prev_text'          => '&laquo;',
  'next_text'          => '&raquo;',
  'after_page_number'  => ''
) );
