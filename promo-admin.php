<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.linkedin.com/in/arr-dev/
 * @since             1.0.0
 * @package           Promo_Admin
 *
 * @wordpress-plugin
 * Plugin Name:       Promociones BOLDT
 * Plugin URI:        https://www.linkedin.com/in/arr-dev/
 * Description:       Este plugin será de ayuda para reflejar los datos de los usuarios registrados con gravityforms en templates personalizados a medida.
 * Version:           1.0.0
 * Author:            Lucas E. Arrejoria
 * Author URI:        https://www.linkedin.com/in/arr-dev//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       promo-admin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PROMO_ADMIN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-promo-admin-activator.php
 */
function activate_promo_admin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-promo-admin-activator.php';
	Promo_Admin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-promo-admin-deactivator.php
 */
function deactivate_promo_admin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-promo-admin-deactivator.php';
	Promo_Admin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_promo_admin' );
register_deactivation_hook( __FILE__, 'deactivate_promo_admin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-promo-admin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_promo_admin() {

	$plugin = new Promo_Admin();
	$plugin->run();

}
run_promo_admin();
