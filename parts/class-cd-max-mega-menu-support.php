<?php
/**
 * File contains everything needed to support Max Mega Menu.
 *
 * @since 1.9.2
 * @package Coldbox
 */

/**
 * Class Cd_Max_Mega_Menu_Support
 *
 * @since 1.9.2
 */
class Cd_Max_Mega_Menu_Support {
	/**
	 * Returns if the Max Mega Menu is enabled for the header menu.
	 *
	 * @return bool
	 *
	 * @since 1.9.2
	 */
	public static function is_enabled_for_header_menu() {
		return function_exists( 'max_mega_menu_is_enabled' ) && max_mega_menu_is_enabled( 'header-menu' );
	}
}
