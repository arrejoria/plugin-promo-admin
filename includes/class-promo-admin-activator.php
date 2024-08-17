<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.linkedin.com/in/arr-dev/
 * @since      1.0.0
 *
 * @package    Promo_Admin
 * @subpackage Promo_Admin/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Promo_Admin
 * @subpackage Promo_Admin/includes
 * @author     Lucas E. Arrejoria <arrejoria.work@gmail.com>
 */
class Promo_Admin_Activator
{
	/**
	 * Activates the plugin, including creating necessary tables.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		self::prm_admin_tables();
		flush_rewrite_rules();
	}

	/**
	 * Creates necessary tables in the database.
	 *
	 * @since    1.0.0
	 */
	public static function prm_admin_tables()
	{
		global $wpdb;
		$table_prefix = $wpdb->prefix;

		// Especificar la codificación y la collation (charset)
		$charset_collate = $wpdb->get_charset_collate();

		$table_promos = $table_prefix . 'mgmt_promos';
		$table_forms = $table_prefix . 'mgmt_forms';
		$table_members = $table_prefix . 'mgmt_members';
		$table_members_promos = $table_prefix . 'mgmt_members_promos';

		// Consulta SQL para crear la tabla mgmt_promos
		$sql_queries[] = "CREATE TABLE IF NOT EXISTS $table_promos (
			id INT NOT NULL AUTO_INCREMENT,
    		promo_status INT NOT NULL,
    		promo_updated_date TIMESTAMP NOT NULL,
    		promo_created_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    		PRIMARY KEY (id)
 		)$charset_collate;";

		// Consulta SQL para crear la tabla mgmt_forms
		$sql_queries[] = "CREATE TABLE IF NOT EXISTS $table_forms (
		id INT NOT NULL AUTO_INCREMENT,
    	form_id MEDIUMINT NOT NULL UNIQUE,
    	form_data LONGTEXT NOT NULL,
    	PRIMARY KEY (id)
        )$charset_collate;";

		$sql_queries[] = "CREATE TABLE $table_members (
		id INT NOT NULL AUTO_INCREMENT,
		member_id MEDIUMINT NOT NULL UNIQUE,
		member_data LONGTEXT NOT NULL,
		form_id MEDIUMINT NOT NULL,
		PRIMARY KEY (id)
		)$charset_collate;";

		// Consulta SQL para crear la tabla mgmt_members_promos
		$sql_queries[]  = "CREATE TABLE $table_members_promos (
		id INT NOT NULL AUTO_INCREMENT,
		member_id MEDIUMINT NOT NULL,
		promo_id INT NOT NULL,
		promo_status TINYINT UNSIGNED NOT NULL DEFAULT '0',
		promo_updated_date TIMESTAMP NOT NULL,
		promo_created_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (id),
		INDEX (member_id),
		FOREIGN KEY (member_id) REFERENCES $table_members(member_id) ON DELETE CASCADE ON UPDATE CASCADE,
		INDEX (promo_id),
		FOREIGN KEY (promo_id) REFERENCES $table_promos(id) ON DELETE CASCADE ON UPDATE CASCADE
		)$charset_collate;";

		// Incluir el archivo necesario para ejecutar dbDelta
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		// Ejecutar dbDelta para crear las tablas
		foreach ($sql_queries as $query) {
			dbDelta($query);
		}
	}
}
