<?php
// Router for PHP's loopback development server; not included in distribution.
$path = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
$root = $_SERVER['DOCUMENT_ROOT'];
if ( is_file( $root . $path ) ) {
  return false;
}
require $root . '/index.php';
