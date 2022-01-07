<?php
	/**
	 * Created by PhpStorm.
	 * User: gabykaram
	 * Date: 1/7/22
	 * Time: 7:09 PM
	 * File: MusicPostType.php
	 */
	
	namespace WpMusic\PostTypes;
	
	
	class MusicPostType {
		private $domain = 'wp-music';
		
		public function __construct( $domain = null ) {
			if ( ! empty( $domain ) ) {
				$this->domain = $domain;
			}
			
			add_action( 'init', [ $this, 'create_custom_post_type_music' ], 0 );
		}
		
		// Register Custom Post Type Music
		// Post Type Key: music
		public function create_custom_post_type_music() {
			$labels = array(
				'name'                  => _x( 'Musics', 'Post Type General Name', $this->domain ),
				'singular_name'         => _x( 'Music', 'Post Type Singular Name', $this->domain ),
				'menu_name'             => _x( 'Musics', 'Admin Menu text', $this->domain ),
				'name_admin_bar'        => _x( 'Music', 'Add New on Toolbar', $this->domain ),
				'archives'              => __( 'Music Archives', $this->domain ),
				'attributes'            => __( 'Music Attributes', $this->domain ),
				'parent_item_colon'     => __( 'Parent Music:', $this->domain ),
				'all_items'             => __( 'All Musics', $this->domain ),
				'add_new_item'          => __( 'Add New Music', $this->domain ),
				'add_new'               => __( 'Add New', $this->domain ),
				'new_item'              => __( 'New Music', $this->domain ),
				'edit_item'             => __( 'Edit Music', $this->domain ),
				'update_item'           => __( 'Update Music', $this->domain ),
				'view_item'             => __( 'View Music', $this->domain ),
				'view_items'            => __( 'View Musics', $this->domain ),
				'search_items'          => __( 'Search Music', $this->domain ),
				'not_found'             => __( 'Not found', $this->domain ),
				'not_found_in_trash'    => __( 'Not found in Trash', $this->domain ),
				'featured_image'        => __( 'Featured Image', $this->domain ),
				'set_featured_image'    => __( 'Set featured image', $this->domain ),
				'remove_featured_image' => __( 'Remove featured image', $this->domain ),
				'use_featured_image'    => __( 'Use as featured image', $this->domain ),
				'insert_into_item'      => __( 'Insert into Music', $this->domain ),
				'uploaded_to_this_item' => __( 'Uploaded to this Music', $this->domain ),
				'items_list'            => __( 'Musics list', $this->domain ),
				'items_list_navigation' => __( 'Musics list navigation', $this->domain ),
				'filter_items_list'     => __( 'Filter Musics list', $this->domain ),
			);
			$args   = array(
				'label'               => __( 'Music', $this->domain ),
				'description'         => __( 'Where to add music informations', $this->domain ),
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
	
