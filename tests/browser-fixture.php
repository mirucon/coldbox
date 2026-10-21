<?php
// Executed by WP-CLI against the disposable browser database, never via HTTP.
$content = '<!-- wp:paragraph --><p>Coldbox fixture paragraph. <a href="#section-two"><strong>Jump to section</strong></a> <a href="#missing-target">Missing anchor</a></p><!-- /wp:paragraph -->'
  . '<!-- wp:heading --><h2 class="wp-block-heading" id="section-two">Section two</h2><!-- /wp:heading -->'
  . '<!-- wp:code --><pre class="wp-block-code"><code class="language-javascript">const answer = 42;</code></pre><!-- /wp:code -->'
  . '<!-- wp:table --><figure class="wp-block-table"><table><tbody><tr><td>First cell</td><td>Second cell</td></tr></tbody></table></figure><!-- /wp:table -->'
  . '<p><img src="' . get_template_directory_uri() . '/assets/img/thumb-standard.png" alt="Fixture thumbnail" width="500" height="500"></p>';
$existing = get_page_by_path( 'coldbox-fixture', OBJECT, 'post' );
$id = wp_insert_post( array( 'ID' => $existing ? $existing->ID : 0, 'post_name' => 'coldbox-fixture', 'post_title' => 'Coldbox fixture', 'post_content' => $content, 'post_status' => 'publish' ) );
$title = 'Literal &lt;img src=x onerror=alert(1)&gt; title';
$existing = get_page_by_path( 'literal-title', OBJECT, 'post' );
wp_insert_post( array( 'ID' => $existing ? $existing->ID : 0, 'post_name' => 'literal-title', 'post_title' => $title, 'post_content' => '<p>Another article.</p>', 'post_status' => 'publish' ) );
$menu = wp_get_nav_menu_object( 'Coldbox test menu' );
$menu_id = $menu ? $menu->term_id : wp_create_nav_menu( 'Coldbox test menu' );
if ( ! wp_get_nav_menu_items( $menu_id ) ) {
  wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => 'Fixture article', 'menu-item-object-id' => $id, 'menu-item-object' => 'post', 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ) );
}
set_theme_mod( 'nav_menu_locations', array( 'header-menu' => $menu_id ) );
set_theme_mod( 'link_color', '#00619f' );
set_theme_mod( 'does_use_hljs', true );
set_theme_mod( 'do_not_load_jquery', false );
// Shared settings make the visual baseline comparable before and after removal.
set_theme_mod( 'sns_button_pocket', false );
set_theme_mod( 'sns_button_count_badges', false );
update_option( 'widget_recent-posts', array( 2 => array( 'title' => 'Recent posts', 'number' => 5, 'show_date' => true ), '_multiwidget' => 1 ) );
update_option( 'sidebars_widgets', array( 'sidebar-1' => array( 'recent-posts-2' ), 'wp_inactive_widgets' => array(), 'array_version' => 3 ) );
global $wp_rewrite;
$wp_rewrite->set_permalink_structure( '/%postname%/' );
flush_rewrite_rules( false );
echo "Browser fixture ready: /coldbox-fixture/\n";
