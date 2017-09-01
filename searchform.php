<?php
/**
 * The template for the search form part
 *
 * @since 1.0.0
 * @package coldbox
 */

?>

<form method="get" class="search-form" action="<?php echo esc_attr( home_url( '/' ) ); ?>">
	<input type="search" class="search-inner" name="s" placeholder="<?php esc_attr_e( 'Search this site', 'coldbox' ); ?>" />
	<button type="submit" class="search-submit"><i class="icon search"></i></button>
</form>
