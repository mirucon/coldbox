<?php
class TgmpaTest extends WP_UnitTestCase {
  public function set_up() {
    parent::set_up();
    wp_set_current_user( self::factory()->user->create( array( 'role' => 'administrator' ) ) );
    set_current_screen( 'themes' );
    $GLOBALS['tgmpa']->init();
  }

  public function tear_down() {
    unset( $_GET['page'] );
    $GLOBALS['tgmpa']->is_automatic = false;
    set_current_screen( 'front' );
    parent::tear_down();
  }

  public function test_addon_is_optional_and_notice_can_be_dismissed() {
    $tgmpa = $GLOBALS['tgmpa'];
    $this->assertSame( array( 'coldbox-addon' ), array_keys( $tgmpa->plugins ) );
    $this->assertFalse( $tgmpa->plugins['coldbox-addon']['required'] );
    $this->assertFalse( $tgmpa->is_automatic );
    $this->assertTrue( $tgmpa->dismissable );
    update_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice_coldbox', 1 );
    ob_start();
    $tgmpa->notices();
    $this->assertSame( '', ob_get_clean() );
  }

  public function test_about_page_links_to_installer_when_addon_is_inactive() {
    require_once get_template_directory() . '/parts/about-coldbox.php';
    update_option( 'active_plugins', array() );
    ob_start();
    cd_welcome_page_content();
    $html = ob_get_clean();
    $this->assertStringContainsString( 'themes.php?page=tgmpa-install-plugins', $html );
    $this->assertStringContainsString( 'Share buttons', $html );
    $this->assertStringNotContainsString( 'Automatic AMP pages generation', $html );
  }

  public function test_install_completion_uses_wordpress_details_control() {
    $_GET['page'] = $GLOBALS['tgmpa']->menu;
    tgmpa_load_bulk_installer();
    foreach ( array( false, true ) as $automatic ) {
      $GLOBALS['tgmpa']->is_automatic = $automatic;
      $skin = new class( array( 'names' => array( 'Coldbox Addon' ) ) ) extends TGMPA_Bulk_Installer_Skin {
        public function flush_output() {}
      };
      $upgrader = new stdClass();
      $upgrader->strings = array();
      $upgrader->update_current = 1;
      $skin->set_upgrader( $upgrader );
      $skin->set_result( true );
      ob_start();
      try {
        $skin->after();
        $html = ob_get_contents();
      } finally {
        ob_end_clean();
      }
      $this->assertStringContainsString( 'Coldbox Addon installed', $html );
      $this->assertStringNotContainsString( '%2$s', $html );
    }
  }
}
