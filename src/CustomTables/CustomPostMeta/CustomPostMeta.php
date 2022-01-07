<?php
	/**
	 * Created by PhpStorm.
	 * User: gabykaram
	 * Date: 1/7/22
	 * Time: 10:41 PM
	 * File: CustomPostMeta.php
	 */
	
	namespace WPMusic\CustomTables\CustomPostMeta;
	
	/**
	 * Simple class to update and read data from custom table of wordpress
	 * Still needs validation to be a true clone of WordPress existing system
	 * and it only a single value for each meta key
	 * */
	class CustomPostMeta {
		private static $table = 'custom_postmeta';
		
		
		/**
		 * Get the meta_value based on the post_id and meta_key
		 *
		 * @param $post_id
		 * @param  string  $meta_key
		 *
		 * @param  string  $default
		 *
		 * @return string
		 */
		public static function get_post_meta( $post_id, $meta_key, $default = '' ) {
			global $wpdb;
			$table    = $wpdb->prefix . self::$table;
			$meta_key = wp_unslash( $meta_key );
			$result   = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table WHERE post_id = %d AND meta_key = %s",
				$post_id, $meta_key )  );
			if ( ! empty( $result ) ) {
				return $result->meta_value;
			}
			
			return $default;
		}
		
		/**
		 * @param $meta_key
		 * @param $meta_value
		 *
		 * @return array|object|null
		 */
		public static function filter_by_meta_key_and_meta_value( $meta_key, $meta_value ) {
			global $wpdb;
			$table      = $wpdb->prefix . self::$table;
			$meta_key   = wp_unslash( $meta_key );
			$meta_value = wp_unslash( $meta_value );
			$results    = $wpdb->get_results( $wpdb->prepare( "SELECT post_id FROM $table WHERE meta_key = %s AND post_id = %d",
				$meta_key, $meta_value ) );
			
			return $results;
			
		}
		
		/**
		 * Update the post_id meta_key value based on the post_id, meta_key
		 * in case if the meta_key isn't available a meta_key would be created
		 *
		 * @param $post_id
		 * @param $meta_key
		 * @param $meta_value
		 *
		 * @return bool|int
		 */
		public static function update_post_meta( $post_id, $meta_key, $meta_value ) {
			global $wpdb;
			
			if ( ! $meta_key || ! is_numeric( $post_id ) ) {
				return false;
			}
			
			$post_id = absint( $post_id );
			if ( ! $post_id ) {
				return false;
			}
			
			$table      = $wpdb->prefix . self::$table;
			$meta_key   = wp_unslash( $meta_key );
			$meta_value = wp_unslash( $meta_value );
			
			
			$ids = $wpdb->get_col( $wpdb->prepare( "SELECT post_id FROM $table WHERE meta_key = %s AND post_id = %d",
				$meta_key, $post_id ) );
			
			if ( empty( $ids ) ) {
				return self::add_post_meta( $post_id, $meta_key, $meta_value );
			}
			
			$data  = compact( 'meta_value' );
			$where = array(
				'post_id'  => $post_id,
				'meta_key' => $meta_key,
			);
			
			return $wpdb->update( $table, $data, $where );
		}
		
		/**
		 * Create a post_meta based on meta_key, meta_value and post_id
		 * the validation isn't necessary here because it has been done on the update function and this function is only called inside the class
		 * @param $post_id
		 * @param $meta_key
		 * @param $meta_value
		 *
		 * @return bool|int
		 */
		private static function add_post_meta( $post_id, $meta_key, $meta_value ) {
			global $wpdb;
			$table = $wpdb->prefix . self::$table;
			$data  = array(
				'post_id'    => $post_id,
				'meta_key'   => $meta_key,
				'meta_value' => $meta_value,
			);
			
			return $wpdb->insert(
				$table,
				$data
			);
		}
	}
