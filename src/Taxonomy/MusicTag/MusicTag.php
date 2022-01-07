<?php
	/**
	 * Created by PhpStorm.
	 * User: gabykaram
	 * Date: 1/7/22
	 * Time: 7:26 PM
	 * File: MusicTagTaxonomy.php
	 */
	
	namespace WPMusic\Taxonomies\MusicTag;
	
	
	class MusicTag {
		private $domain = 'wp-music';
		
		public function __construct( $domain = null ) {
			if ( ! empty( $domain ) ) {
				$this->domain = $domain;
			}
			add_action( 'init', [ $this, 'create_music_tag_tax' ] );
		}
		
		// Register Taxonomy Music Tag
		// Taxonomy Key: music-tag
		public function create_music_tag_tax() {
			
			$labels = array(
				'name'              => _x( 'Music Tags', 'taxonomy general name', $this->domain ),
				'singular_name'     => _x( 'Music Tag', 'taxonomy singular name', $this->domain ),
				'search_items'      => __( 'Search Music Tags', $this->domain ),
				'all_items'         => __( 'All Music Tags', $this->domain ),
				'parent_item'       => __( 'Parent Music Tag', $this->domain ),
				'parent_item_colon' => __( 'Parent Music Tag:', $this->domain ),
				'edit_item'         => __( 'Edit Music Tag', $this->domain ),
				'update_item'       => __( 'Update Music Tag', $this->domain ),
				'add_new_item'      => __( 'Add New Music Tag', $this->domain ),
				'new_item_name'     => __( 'New Music Tag Name', $this->domain ),
				'menu_name'         => __( 'Music Tag', $this->domain ),
			);
			$args   = array(
				'labels'             => $labels,
				'description'        => __( 'Where to add music tags', $this->domain ),
				'hierarchical'       => false,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_nav_menus'  => true,
				'show_tagcloud'      => true,
				'show_in_quick_edit' => true,
				'show_admin_column'  => true,
				'show_in_rest'       => true,
			);
			register_taxonomy( 'music-tag', array( 'music' ), $args );
			
		}
	}
