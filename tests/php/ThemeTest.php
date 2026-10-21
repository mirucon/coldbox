<?php
class ThemeTest extends WP_UnitTestCase {
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
    $this->assertDoesNotMatchRegularExpression( '/>AMP|Analytics|Ads Extension|mailto:|please let me know|tgmpa|CHANGELOG.html/i', $html );
  }
}
