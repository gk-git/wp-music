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
		private $domain = 'wp-music';
		
		public function __construct( $domain = null ) {
			if ( ! empty( $domain ) ) {
				$this->domain = $domain;
			}
			add_action( 'init', [ $this, 'create_genre_tax' ] );
		}
		
		// Register Taxonomy Genre
		// Taxonomy Key: genre
		public function create_genre_tax() {
			
			$labels = array(
				'name'              => _x( 'Genres', 'taxonomy general name', $this->domain ),
				'singular_name'     => _x( 'Genre', 'taxonomy singular name', $this->domain ),
				'search_items'      => __( 'Search Genres', $this->domain ),
				'all_items'         => __( 'All Genres', $this->domain ),
				'parent_item'       => __( 'Parent Genre', $this->domain ),
				'parent_item_colon' => __( 'Parent Genre:', $this->domain ),
				'edit_item'         => __( 'Edit Genre', $this->domain ),
				'update_item'       => __( 'Update Genre', $this->domain ),
				'add_new_item'      => __( 'Add New Genre', $this->domain ),
				'new_item_name'     => __( 'New Genre Name', $this->domain ),
				'menu_name'         => __( 'Genre', $this->domain ),
			);
			$args   = array(
				'labels'             => $labels,
				'description'        => __( 'Music Genres', $this->domain ),
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
