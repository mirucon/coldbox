<?php
class ThemeTest extends WP_UnitTestCase {
  public function test_title_size_does_not_discard_other_custom_styles() {
    set_theme_mod( 'container_width', 1200 );
    set_theme_mod( 'global_font_size_pc', 18 );
    set_theme_mod( 'site_title_size', 220 );
    $this->go_to( home_url( '/' ) );
    cd_scripts();
    cd_customizer_style();
    $css = implode( '\n', wp_styles()->get_data( 'cd-style', 'after' ) );
    $this->assertMatchesRegularExpression( '/max-width:\s*1200px/', $css );
    $this->assertMatchesRegularExpression( '/font-size:\s*18px/', $css );
    $this->assertMatchesRegularExpression( '/font-size:\s*2\.2em/', $css );
  }

  public function test_saved_options_and_script_order_survive() {
    set_theme_mod( 'link_color', '#123456' );
    set_theme_mod( 'sidebar_position', 'hide' );
    $before = get_theme_mods();
    $this->go_to( home_url( '/' ) );
    do_action( 'wp_enqueue_scripts' );
    $this->assertSame( $before, get_theme_mods() );
    $this->assertSame( 'hide', cd_sidebar_stg() );
    $this->assertTrue( wp_style_is( 'cd-style', 'enqueued' ) );
    $this->assertTrue( wp_script_is( 'cd-script', 'enqueued' ) );
    $this->assertSame( array( 'wp-polyfill' ), wp_scripts()->registered['cd-script']->deps );
    $this->assertFalse( cd_is_amp() );
  }

  public function test_standalone_highlighters_change_cache_url_with_theme_release() {
    set_theme_mod( 'does_use_hljs', true );
    set_theme_mod( 'concat_js', false );
    foreach ( array( false => 'hljs.js', true => 'hljs_web.js' ) as $web => $file ) {
      wp_deregister_script( 'hljs' );
      set_theme_mod( 'use_hljs_web_pack', (bool) $web );
      cd_load_hljs();
      ob_start();
      wp_print_scripts( 'hljs' );
      $html = ob_get_clean();
      $this->assertStringContainsString( '/assets/js/min/' . $file . '?ver=' . CD_VER, $html );
      wp_scripts()->done = array_diff( wp_scripts()->done, array( 'hljs' ) );
    }
  }

  public function test_old_amp_links_preserve_page_and_query_without_using_request_host() {
    $id = self::factory()->post->create( array( 'post_content' => 'First page<!--nextpage-->Second page' ) );
    foreach ( array( '', '/%postname%/' ) as $structure ) {
      $this->set_permalink_structure( $structure );
      $url = add_query_arg( array( 'amp' => '1', 'utm_source' => 'old-link', 'page' => '2' ), get_permalink( $id ) );
      $this->go_to( $url );
      $_GET['amp'] = '1';
      $_SERVER['REQUEST_URI'] = wp_parse_url( $url, PHP_URL_PATH ) . '?' . wp_parse_url( $url, PHP_URL_QUERY );
      $_SERVER['HTTP_HOST'] = 'untrusted.example';
      $target = cd_retired_amp_url();
      $this->assertSame( remove_query_arg( 'amp', $url ), $target );
      $this->assertFalse( cd_is_amp() );
      $_GET = array();
      $this->assertFalse( cd_retired_amp_url() );
    }
  }

  public function test_unrecognized_amp_queries_and_404_are_not_redirected() {
    $id = self::factory()->post->create();
    $this->go_to( get_permalink( $id ) );
    foreach ( array( array( '1' ), '0', '' ) as $amp ) {
      $_GET['amp'] = $amp;
      $this->assertFalse( cd_retired_amp_url() );
    }
    $this->go_to( '/?p=99999999&amp=1' );
    $this->assertFalse( cd_retired_amp_url() );
    $_GET = array();
  }

  public function test_about_page_has_no_support_invitation_or_ads_promotion() {
    require_once get_template_directory() . '/parts/about-coldbox.php';
    ob_start();
    cd_welcome_page_content();
    $html = ob_get_clean();
    $this->assertStringContainsString( 'Getting Started', $html );
    $this->assertStringContainsString( 'The Add-on Plugin', $html );
    $this->assertStringContainsString( 'https://wordpress.org/support/theme/coldbox/reviews/#new-post', $html );
    $this->assertStringContainsString( 'id="upgrade-notice"', $html );
    $this->assertStringContainsString( 'These notices describe past releases.', $html );
    $this->assertStringContainsString( '<h3>1.10.0</h3>', $html );
    $this->assertStringNotContainsString( '### 1.10.0', $html );
    // Historical release entries may name retired features; invitations and sales links must stay absent.
    $this->assertDoesNotMatchRegularExpression( '/mailto:|please let me know|Need Help\?|feel free to get in touch|https:\/\/coldbox\.miruc\.co\/(?:addons\/)?google-adsense-extension/i', $html );
  }

  public function test_untitled_posts_have_a_nonvisual_name_without_changing_titles() {
    $id = self::factory()->post->create( array( 'post_title' => '' ) );
    $GLOBALS['post'] = get_post( $id );
    ob_start(); cd_the_accessible_title(); $html = ob_get_clean();
    $this->assertStringContainsString( 'class="screen-reader-text"', $html );
    $this->assertStringContainsString( '(no title)', $html );
    $this->assertSame( '', get_the_title( $id ) );
    wp_update_post( array( 'ID' => $id, 'post_title' => 'Title <em>with markup</em>' ) );
    $GLOBALS['post'] = get_post( $id );
    ob_start(); cd_the_accessible_title(); $html = ob_get_clean();
    $this->assertSame( get_the_title( $id ), $html );
    wp_update_post( array( 'ID' => $id, 'post_title' => '0' ) );
    $GLOBALS['post'] = get_post( $id );
    ob_start(); cd_the_accessible_title(); $html = ob_get_clean();
    $this->assertSame( '0', $html );
  }

  public function test_social_link_default_does_not_depend_on_addon_attribute_hook() {
    set_theme_mod( 'twitter', 'https://example.org/twitter' );
    $addon = has_action( 'cd_social_links_attr', 'coldbox_addon_social_links_attr' );
    remove_action( 'cd_social_links_attr', 'coldbox_addon_social_links_attr' );
    ob_start(); cd_social_links(); $without = ob_get_clean();
    $this->assertStringContainsString( 'target="_blank"', $without );
    $this->assertStringContainsString( 'new-window-notice', $without );
    // Simulate the already-published Add-on, including when the companion is absent.
    $legacy = function () { echo 'target="_blank"'; };
    add_action( 'cd_social_links_attr', $legacy );
    ob_start(); cd_social_links(); $with = ob_get_clean();
    $this->assertSame( preg_replace( '/\s+/', ' ', $without ), preg_replace( '/\s+/', ' ', $with ) );
    remove_action( 'cd_social_links_attr', $legacy );
    if ( false !== $addon ) add_action( 'cd_social_links_attr', 'coldbox_addon_social_links_attr', $addon );
  }

  public function test_search_landmarks_honor_context_and_escape_names() {
    $default = get_search_form( array( 'echo' => false ) );
    $content = get_search_form( array( 'echo' => false, 'aria_label' => 'Content " test' ) );
    $this->assertStringContainsString( 'aria-label="Search"', $default );
    $this->assertStringContainsString( 'aria-label="Content &quot; test"', $content );
  }

  public function test_hiding_social_notices_preserves_target_and_accessible_name() {
    set_theme_mod( 'twitter', 'https://example.org/twitter' );
    $addon = has_action( 'cd_social_links_attr', 'coldbox_addon_social_links_attr' );
    remove_action( 'cd_social_links_attr', 'coldbox_addon_social_links_attr' );
    foreach ( array( false, true ) as $legacy_addon ) {
      $attributes = function () { echo 'target="_blank"'; };
      if ( $legacy_addon ) add_action( 'cd_social_links_attr', $attributes );
      foreach ( array( null, false, true ) as $show_icon ) {
        if ( null === $show_icon ) remove_theme_mod( 'social_links_new_tab_icon' );
        else set_theme_mod( 'social_links_new_tab_icon', $show_icon );
        ob_start(); cd_social_links(); $html = ob_get_clean();
        $this->assertStringContainsString( 'target="_blank"', $html );
        $this->assertStringContainsString( 'Twitter</span>', $html );
        $this->assertStringContainsString( 'Opens in a new tab', $html );
        $this->assertSame( false !== $show_icon, false !== strpos( $html, 'class="new-window-notice"' ) );
      }
      remove_action( 'cd_social_links_attr', $attributes );
    }
    remove_theme_mod( 'social_links_new_tab_icon' );
    if ( false !== $addon ) add_action( 'cd_social_links_attr', 'coldbox_addon_social_links_attr', $addon );
  }
}
