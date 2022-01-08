<?php
	/**
	 * Created by PhpStorm.
	 * User: gabykaram
	 * Date: 1/7/22
	 * Time: 7:09 PM
	 * File: MusicPostType.php
	 */
	
	namespace WPMusic\PostTypes\Music;
	
	
	
	class Music {
		public function __construct() {
			add_action( 'init', [ $this, 'create_custom_post_type_music' ], 0 );
			new MetaBoxes();
			new Shortcode();
		}
		
		// Register Custom Post Type Music
		// Post Type Key: music
		public function create_custom_post_type_music() {
			$labels = array(
				'name'                  => _x( 'Musics', 'Post Type General Name', 'wp-music' ),
				'singular_name'         => _x( 'Music', 'Post Type Singular Name', 'wp-music' ),
				'menu_name'             => _x( 'Musics', 'Admin Menu text', 'wp-music' ),
				'name_admin_bar'        => _x( 'Music', 'Add New on Toolbar', 'wp-music' ),
				'archives'              => __( 'Music Archives', 'wp-music' ),
				'attributes'            => __( 'Music Attributes', 'wp-music' ),
				'parent_item_colon'     => __( 'Parent Music:', 'wp-music' ),
				'all_items'             => __( 'All Musics', 'wp-music' ),
				'add_new_item'          => __( 'Add New Music', 'wp-music' ),
				'add_new'               => __( 'Add New', 'wp-music' ),
				'new_item'              => __( 'New Music', 'wp-music' ),
				'edit_item'             => __( 'Edit Music', 'wp-music' ),
				'update_item'           => __( 'Update Music', 'wp-music' ),
				'view_item'             => __( 'View Music', 'wp-music' ),
				'view_items'            => __( 'View Musics', 'wp-music' ),
				'search_items'          => __( 'Search Music', 'wp-music' ),
				'not_found'             => __( 'Not found', 'wp-music' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'wp-music' ),
				'featured_image'        => __( 'Featured Image', 'wp-music' ),
				'set_featured_image'    => __( 'Set featured image', 'wp-music' ),
				'remove_featured_image' => __( 'Remove featured image', 'wp-music' ),
				'use_featured_image'    => __( 'Use as featured image', 'wp-music' ),
				'insert_into_item'      => __( 'Insert into Music', 'wp-music' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Music', 'wp-music' ),
				'items_list'            => __( 'Musics list', 'wp-music' ),
				'items_list_navigation' => __( 'Musics list navigation', 'wp-music' ),
				'filter_items_list'     => __( 'Filter Musics list', 'wp-music' ),
			);
			$args   = array(
				'label'               => __( 'Music', 'wp-music' ),
				'description'         => __( 'Where to add music informations', 'wp-music' ),
				'labels'              => $labels,
				'menu_icon'           => '',
				'supports'            => array( 'title' ),
				'taxonomies'          => array(),
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 5,
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => true,
				'hierarchical'        => false,
				'exclude_from_search' => false,
				'show_in_rest'        => true,
				'publicly_queryable'  => true,
				'capability_type'     => 'post',
			);
			register_post_type( 'music', $args );
			
		}
	}
	
