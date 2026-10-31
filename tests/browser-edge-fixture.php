<?php
// Edge cases from the official accessibility dataset, kept small for CI.
$edge_content = '<!-- wp:file --><div class="wp-block-file"><a href="#download">Fixture file</a><a href="#download" class="wp-block-file__button wp-element-button" download>Download</a></div><!-- /wp:file -->'
  . '<div class="wp-block-file"><a href="#custom" class="wp-block-file__button has-text-color" style="color:#ffeebb">Custom download</a></div>'
  . '<pre id="wide-code">' . str_repeat( 'long code line ', 50 ) . '</pre>'
  . '<pre id="short-code">Short code</pre><pre id="author-tabindex" tabindex="-1">Author-controlled focus</pre>';
$edge_content .= '<!-- wp:gallery {"columns":3} --><figure class="wp-block-gallery has-nested-images columns-3 is-cropped"><!-- wp:image --><figure class="wp-block-image"><img src="' . get_template_directory_uri() . '/assets/img/thumb-standard.png" alt="Gallery fixture" width="500" height="500"><figcaption class="wp-element-caption">' . str_repeat( 'A long gallery caption. ', 300 ) . '</figcaption></figure><!-- /wp:image --></figure><!-- /wp:gallery -->';
foreach ( array(
  'fixture-edge' => array( 'post_title' => 'Content edge cases', 'post_content' => $edge_content ),
  'fixture-protected' => array( 'post_title' => 'Protected fixture', 'post_content' => 'Protected text', 'post_password' => 'fixture' ),
  'fixture-untitled' => array( 'post_title' => '', 'post_content' => '<p>Intentionally untitled article.</p>' ),
) as $slug => $fields ) {
  $existing_edge = get_page_by_path( $slug, OBJECT, 'post' );
  wp_insert_post( array_merge( array( 'ID' => $existing_edge ? $existing_edge->ID : 0, 'post_name' => $slug, 'post_status' => 'publish' ), $fields ) );
}
