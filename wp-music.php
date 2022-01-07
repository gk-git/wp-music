<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://gabykaram.com/
 * @since             1.0.0
 * @package           Wp_Music
 *
 * @wordpress-plugin
 * Plugin Name:       WP Music
 * Plugin URI:        https://github.com/gk-git/wp-music
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Gaby Karam
 * Author URI:        https://gabykaram.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-music
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
	if ( ! defined( 'ABSPATH' ) ) {
		die;
	}
	
	/**
	 * The code that runs during plugin activation.
	 * This action is documented in WPMusicActivator.php
	 */
	function activate_wp_music() {
		require_once plugin_dir_path( __FILE__ ) . 'WPMusicActivator.php';
		WPMusicActivator::activate();
	}
	
	/**
	 * The code that runs during plugin deactivation.
	 * This action is documented in WPMusicDeactivator.php
	 */
	function deactivate_wp_music() {
		require_once plugin_dir_path( __FILE__ ) . 'WPMusicDeactivator.php';
		WPMusicDeactivator::deactivate();
	}
	
	register_activation_hook( __FILE__, 'activate_wp_music' );
	register_deactivation_hook( __FILE__, 'deactivate_wp_music' );
	
	/**
	 * The core plugin class that is used to define internationalization,
	 * admin-specific hooks, and public-facing site hooks.
	 */
	if ( ! class_exists( 'WPMusic' ) ) {
		require_once __DIR__ . '/src/WPMusic.php';
	}
	/**
	 * Begins execution of the plugin.
	 *
	 * Since everything within the plugin is registered via hooks,
	 * then kicking off the plugin from this point in the file does
	 * not affect the page life cycle.
	 *
	 * @since    1.0.0
	 */
	if ( ! function_exists( 'wp_music__init' ) ) {
		/**
		 * Function that instantiates the plugins main class
		 *
		 * @return object
		 */
		function wp_music__init() {
			/**
			 * Return an instance of the action
			 */
			return \WPMusic::instance();
		}
	}
	add_action( 'plugins_loaded', 'wp_music__init', 15 );
