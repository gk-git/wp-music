<?php
	// If this file is called directly, abort.
	if ( ! defined( 'ABSPATH' ) ) {
		die;
	}
	
	/**
	 * Fired during plugin activation
	 *
	 * @link       https://gabykaram.com/
	 * @since      1.0.0
	 * @package    Wp_Music
	 */
	class WPMusicActivator {
		
		/**
		 * Short Description. (use period)
		 *
		 * Long Description.
		 *
		 * @since    1.0.0
		 */
		public static function activate() {
			global $wpdb;
			
			// Let's not break the site with exception messages
			$wpdb->hide_errors();
			
			if ( ! function_exists( 'dbDelta' ) ) {
				require_once ABSPATH . 'wp-admin/includes/upgrade.php';
			}
			
			$collate = '';
			
			if ( $wpdb->has_cap( 'collation' ) ) {
				$collate = $wpdb->get_charset_collate();
			}
			
			$schema = "
				CREATE TABLE {$wpdb->prefix}custom_postmeta (
				  `meta_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
				  `post_id` BIGINT UNSIGNED NOT NULL,
				  `meta_key` VARCHAR(255) DEFAULT NULL,
				  `meta_value` longtext,
				  PRIMARY KEY  (meta_id)
				) $collate;";
			
			dbDelta( $schema );
		}
		
	}
