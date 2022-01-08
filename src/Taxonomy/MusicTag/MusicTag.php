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
		public function __construct() {
			add_action( 'init', [ $this, 'create_music_tag_tax' ] );
		}
		
		// Register Taxonomy Music Tag
		// Taxonomy Key: music-tag
		public function create_music_tag_tax() {
			
			$labels = array(
				'name'              => _x( 'Music Tags', 'taxonomy general name', 'wp-music' ),
				'singular_name'     => _x( 'Music Tag', 'taxonomy singular name', 'wp-music' ),
				'search_items'      => __( 'Search Music Tags', 'wp-music' ),
				'all_items'         => __( 'All Music Tags', 'wp-music' ),
				'parent_item'       => __( 'Parent Music Tag', 'wp-music' ),
				'parent_item_colon' => __( 'Parent Music Tag:', 'wp-music' ),
				'edit_item'         => __( 'Edit Music Tag', 'wp-music' ),
				'update_item'       => __( 'Update Music Tag', 'wp-music' ),
				'add_new_item'      => __( 'Add New Music Tag', 'wp-music' ),
				'new_item_name'     => __( 'New Music Tag Name', 'wp-music' ),
				'menu_name'         => __( 'Music Tag', 'wp-music' ),
			);
			$args   = array(
				'labels'             => $labels,
				'description'        => __( 'Where to add music tags', 'wp-music' ),
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
