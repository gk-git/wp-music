<?php
	/**
	 * Created by PhpStorm.
	 * User: gabykaram
	 * Date: 1/7/22
	 * Time: 3:05 PM
	 * File: WPMusic.php
	 */
	
	
	class WPMusic {
		private static $instance;
		
		/**
		 * The instance of the WPGraphQLBlockEditor object
		 *
		 * @return object|WPMusic - The one true WPGraphQL
		 * @since  0.0.1
		 */
		public static function instance() {
			
			if ( ! isset( self::$instance ) || ! ( self::$instance instanceof self ) ) {
				self::$instance = new self();
				self::$instance->setup_constants();
				self::$instance->includes();
				self::$instance->set_locale();
				self::$instance->actions();
				self::$instance->filters();
			}
			
			/**
			 * Return the WPGraphQL Instance
			 */
			return self::$instance;
		}
		
		/**
		 * Load the plugin text domain for translation.
		 *
		 * @since    1.0.0
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain(
				WP_MUSIC_DOMAIN,
				false,
				WP_MUSIC_PLUGIN_DIR . 'languages/'
			);
		}
		
		private function setup_constants() {
			
			// Set main file path.
			$main_file_path = dirname( __DIR__ ) . '/wp-music.php';
			
			if ( ! defined( 'WP_MUSIC_VERSION' ) ) {
				define( 'WP_MUSIC_VERSION', '1.0.0' );
			}
			if ( ! defined( 'WP_MUSIC_DOMAIN' ) ) {
				define( "WP_MUSIC_DOMAIN", 'wp-music' );
			}
			if ( ! defined( 'WP_MUSIC_AUTOLOAD' ) ) {
				define( "WP_MUSIC_AUTOLOAD", true );
			}
			if ( ! defined( 'WP_MUSIC_PLUGIN_DIR' ) ) {
				define( "WP_MUSIC_PLUGIN_DIR", plugin_dir_path( $main_file_path ) );
			}
			
		}
		
		private function includes() {
			if ( defined( 'WP_MUSIC_AUTOLOAD' ) && true === WP_MUSIC_AUTOLOAD && file_exists( WP_MUSIC_PLUGIN_DIR . 'vendor/autoload.php' ) ) {
				// Autoload Required Classes.
				require_once WP_MUSIC_PLUGIN_DIR . 'vendor/autoload.php';
			}
			
		}
		
		/**
		 * Define the locale for this plugin for internationalization.
		 *
		 * Uses the Wp_Music_i18n class in order to set the domain and to register the hook
		 * with WordPress.
		 *
		 * @since    1.0.0
		 * @access   private
		 */
		private function set_locale() {
			add_action( 'init', [ $this, 'load_plugin_textdomain' ] );
		}
		
		private function actions() {
			
		}
		
		private function filters() {
		
		}
	}
