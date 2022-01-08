<?php
	/**
	 * Created by PhpStorm.
	 * User: gabykaram
	 * Date: 1/7/22
	 * Time: 7:23 PM
	 * File: GenreTaxonomy.php
	 */
	
	namespace WPMusic\Taxonomies\Genre;
	
	
	class Genre {
		public function __construct() {
			add_action( 'init', [ $this, 'create_genre_tax' ] );
		}
		
		// Register Taxonomy Genre
		// Taxonomy Key: genre
		public function create_genre_tax() {
			
			$labels = array(
				'name'              => _x( 'Genres', 'taxonomy general name', 'wp-music'),
				'singular_name'     => _x( 'Genre', 'taxonomy singular name', 'wp-music'),
				'search_items'      => __( 'Search Genres', 'wp-music'),
				'all_items'         => __( 'All Genres', 'wp-music'),
				'parent_item'       => __( 'Parent Genre', 'wp-music'),
				'parent_item_colon' => __( 'Parent Genre:', 'wp-music'),
				'edit_item'         => __( 'Edit Genre', 'wp-music'),
				'update_item'       => __( 'Update Genre', 'wp-music'),
				'add_new_item'      => __( 'Add New Genre', 'wp-music'),
				'new_item_name'     => __( 'New Genre Name', 'wp-music'),
				'menu_name'         => __( 'Genre', 'wp-music'),
			);
			$args   = array(
				'labels'             => $labels,
				'description'        => __( 'Music Genres', 'wp-music'),
				'hierarchical'       => true,
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
			register_taxonomy( 'genre', array( 'music' ), $args );
			
		}
	}
