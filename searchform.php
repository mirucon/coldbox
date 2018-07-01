<?php
/**
 * The template for the search form part
 *
 * @since 1.0.0
 * @package Coldbox
 */

?>

<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<label for="s" class="screen-reader-text"><?php esc_html_e( 'Search', 'coldbox' ); ?></label>
	<input type="search" class="search-inner" name="s" placeholder="<?php esc_attr_e( 'Search this site', 'coldbox' ); ?>" value="<?php echo esc_attr( trim( get_search_query() ) ); ?>"/>
	<button type="submit" class="search-submit">
		<span class="icon search" aria-hidden="true"></span>
		<span class="screen-reader-text"><?php esc_html_e( 'Search', 'coldbox' ); ?></span>
	</button>
</form>
