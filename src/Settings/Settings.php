<?php
	/**
	 * Created by PhpStorm.
	 * User: gabykaram
	 * Date: 1/8/22
	 * Time: 12:21 AM
	 * File: Settings.php
	 */
	namespace WPMusic\Settings;
	/**
     * Settings page for the music custom post type
	 * */
	class Settings {
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'create_settings' ) );
			add_action( 'admin_init', array( $this, 'setup_sections' ) );
			add_action( 'admin_init', array( $this, 'setup_fields' ) );
		}
		
		public function create_settings() {
			$page_title = __( 'Music Settings', 'wp-music' );
			$menu_title = __( 'Settings', 'wp-music' );
			$capability = 'manage_options';
			$slug       = 'music_settings';
			$callback   = array( $this, 'settings_content' );
			add_submenu_page( 'edit.php?post_type=music', $page_title, $menu_title, $capability, $slug, $callback );
		}
		
		public function settings_content() { ?>
            <div class="wrap">
                <h1><?php echo __( 'Music Settings', 'wp-music' ); ?></h1>
				<?php settings_errors(); ?>
                <!--                //TODO: fix the options.php url because some systems might have different url for options.php-->
                <form method="POST" action="options.php">
				<?php
					settings_fields( 'music_settings' );
					do_settings_sections( 'music_settings' );
					submit_button();
				?>
                </form>
            </div>
			<?php
		}
		
		public function setup_sections() {
			add_settings_section( 'music_settings_section', __( 'Change the ', 'wp-music' ), array(),
				'music_settings' );
		}
		
		public function setup_fields() {
			$fields = array(
				array(
					'label'   => __( 'Music currency', 'wp-music' ),
					'id'      => 'music_currency',
					'type'    => 'text',
					'section' => 'music_settings_section',
				),
				array(
					'label'   => __( 'Number of musics displayed per page', 'wp-music' ),
					'id'      => 'music_per_page',
					'type'    => 'number',
					'section' => 'music_settings_section',
				),
			);
			foreach( $fields as $field ){
				add_settings_field( $field['id'], $field['label'], array( $this, 'field_callback' ), 'music_settings', $field['section'], $field );
				register_setting( 'music_settings', $field['id'] );
			}
		}
		
		public function field_callback( $field ) {
			$value = get_option( $field['id'] );
			$placeholder = '';
			if ( isset($field['placeholder']) ) {
				$placeholder = $field['placeholder'];
			}
			switch ( $field['type'] ) {
				default:
					printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />',
						$field['id'],
						$field['type'],
						$placeholder,
						$value
					);
			}
			if( isset($field['desc']) ) {
				if( $desc = $field['desc'] ) {
					printf( '<p class="description">%s </p>', $desc );
				}
			}
		}
	}
