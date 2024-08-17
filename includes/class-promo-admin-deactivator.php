<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.linkedin.com/in/arr-dev/
 * @since      1.0.0
 *
 * @package    Promo_Admin
 * @subpackage Promo_Admin/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Promo_Admin
 * @subpackage Promo_Admin/includes
 * @author     Lucas E. Arrejoria <arrejoria.work@gmail.com>
 */
class Promo_Admin_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}

}
