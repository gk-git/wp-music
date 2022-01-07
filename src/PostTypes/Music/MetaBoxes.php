<?php
	/**
	 * Created by PhpStorm.
	 * User: gabykaram
	 * Date: 1/7/22
	 * Time: 9:22 PM
	 * File: MusicPostTypeMetaBox.php
	 */
	
	namespace WPMusic\PostTypes\Music;
	
	// Meta Box Class: Music Information
	// Get the field value: $metavalue = get_post_meta( $post_id, $field_id, true );
	class MetaBoxes {
		private $screen = array(
			'music',
		);
		
		private $meta_fields = array(
			array(
				'label' => 'Composer Name',
				'id'    => 'composer_name',
				'type'  => 'text',
			),
			array(
				'label' => 'Publisher',
				'id'    => 'publisher',
				'type'  => 'text',
			),
			array(
				'label' => 'Year of recording',
				'id'    => 'year_of_recording',
				'type'  => 'number',
			),
			array(
				'label' => 'Additional Contributors',
				'id'    => 'additional_contributors',
				'type'  => 'textarea',
			),
			array(
				'label' => 'URL',
				'id'    => 'url',
				'type'  => 'url',
			),
			array(
				'label' => 'Price',
				'id'    => 'price',
				'type'  => 'number',
			),
		);
		
		public function __construct() {
			add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
			add_action( 'save_post', array( $this, 'save_fields' ) );
		}
		
		public function add_meta_boxes() {
			foreach ( $this->screen as $single_screen ) {
				add_meta_box(
					'musicinformation',
					__( 'Music Information', 'ssssss' ),
					array( $this, 'meta_box_callback' ),
					$single_screen,
					'advanced',
					'high'
				);
			}
		}
		
		public function meta_box_callback( $post ) {
			wp_nonce_field( 'musicinformation_data', 'musicinformation_nonce' );
			echo 'Where to add music information';
			$this->field_generator( $post );
		}
		
		public function field_generator( $post ) {
			$output = '';
			foreach ( $this->meta_fields as $meta_field ) {
				$label      = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
				$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
				if ( empty( $meta_value ) ) {
					if ( isset( $meta_field['default'] ) ) {
						$meta_value = $meta_field['default'];
					}
				}
				switch ( $meta_field['type'] ) {
					case 'textarea':
						$input = sprintf(
							'<textarea style="width: 100%%" id="%s" name="%s" rows="5">%s</textarea>',
							$meta_field['id'],
							$meta_field['id'],
							$meta_value
						);
						break;
					default:
						$input = sprintf(
							'<input %s id="%s" name="%s" type="%s" value="%s">',
							$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
							$meta_field['id'],
							$meta_field['id'],
							$meta_field['type'],
							$meta_value
						);
				}
				$output .= $this->format_rows( $label, $input );
			}
			echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
		}
		
		public function format_rows( $label, $input ) {
			return '<tr><th>' . $label . '</th><td>' . $input . '</td></tr>';
		}
		
		public function save_fields( $post_id ) {
			if ( ! isset( $_POST['musicinformation_nonce'] ) ) {
				return $post_id;
			}
			$nonce = $_POST['musicinformation_nonce'];
			if ( ! wp_verify_nonce( $nonce, 'musicinformation_data' ) ) {
				return $post_id;
			}
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return $post_id;
			}
			// TODO: add the code needed for saving to the database
			
		}
	}
	
	
