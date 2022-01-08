<?php
	/**
	 * Created by PhpStorm.
	 * User: gabykaram
	 * Date: 1/8/22
	 * Time: 12:34 AM
	 * File: Shortcode.php
	 */
	
	namespace WPMusic\PostTypes\Music;
	
	use WPMusic\CustomTables\CustomPostMeta\CustomPostMeta;
	
	class Shortcode {
		public function __construct() {
			add_shortcode( 'music', [ $this, 'create_music_shortcode' ] );
		}
		
		public function create_music_shortcode( $attributes ) {
			$attributes = shortcode_atts(
				array(
					'year'  => '',
					'genre' => '',
				),
				$attributes,
				'music'
			);
			
			// Attributes in var
			$year     = $attributes['year'];
			$genre    = $attributes['genre'];
			$post_ids = [];
			if ( ! empty( $atts['year'] ) ) {
				$results = CustomPostMeta::filter_by_meta_key_and_meta_value( 'year_of_recording', $year );
				
				if ( ! empty( $results ) ) {
					$post_ids = wp_list_pluck( $results, 'post_id' );
				}
			}
			
			$paged = ( get_query_var( 'paged' ) ) ?: 1;
			
			$default_posts_per_page = get_option( 'posts_per_page' );
			$music_per_page         = get_option( 'music_per_page', $default_posts_per_page );
			$music_currency         = get_option( 'music_currency', 'Bitcoin' );
			
			$post_args = array(
				'post_type'      => "music",
				'posts_per_page' => $music_per_page,
				'post_status'    => 'publish',
				'paged'          => $paged,
			
			);
			if ( ! empty( $post_ids ) ) {
				$post_args['include'] = $post_ids;
			}
			
			if ( ! empty( $genre ) ) {
				$post_args['tax_query'] = array(
					array(
						'taxonomy' => 'genre',
						'field'    => 'slug',
						'terms'    => $genre,
					)
				);
			}
			
			$wp_query = new \WP_Query( $post_args );
			if ( $wp_query->have_posts() ) {
				ob_start();
				
				?>
				<div class="music-shortcode">
	                <div class="musics">
		                
		                <?php
			                while ( $wp_query->have_posts() ) {
				                $wp_query->the_post();
				                $post_id                 = get_the_ID();
				                $composer_name           = CustomPostMeta::get_post_meta( $post_id, 'composer_name' );
				                $publisher               = CustomPostMeta::get_post_meta( $post_id, 'publisher' );
				                $year_of_recording       = CustomPostMeta::get_post_meta( $post_id,
					                'year_of_recording' );
				                $additional_contributors = CustomPostMeta::get_post_meta( $post_id,
					                'additional_contributors' );
				                $url                     = CustomPostMeta::get_post_meta( $post_id, 'url' );
				                $price                   = CustomPostMeta::get_post_meta( $post_id, 'price' );
				
				                ?>
				                <div class="music">
					                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					                <div class="music__meta">
						                <span class="music__meta__label">Composer Name:</span>
						                <span class="music__meta__value"><?php echo $composer_name ?></span>
					                </div>
					                <div class="music__meta">
						                <span class="music__meta__label">Publisher:</span>
						                <span class="music__meta__value"><?php echo $publisher ?></span>
					                </div>
					                <div class="music__meta">
						                <span class="music__meta__label">Year of Recording:</span>
						                <span class="music__meta__value"><?php echo $year_of_recording ?></span>
					                </div>
					                <div class="music__meta">
						                <span class="music__meta__label">Additional Contributors:</span>
						                <span class="music__meta__value"><?php echo $additional_contributors ?></span>
					                </div>
					                
					                <div class="music__meta">
						                <span class="music__meta__label">URL:</span>
						                <span class="music__meta__value"><a href="<?php echo $url ?>"
                                                                            target="_blank"><?php echo $url ?></a></span>
					                </div>
					                
					                <div class="music__meta">
						                <span class="music__meta__label">Price:</span>
						                <span
                                                class="music__meta__value"><?php echo $price ?> <?php echo $music_currency ?></span>
					                </div>
					                
				                </div>
				
				
				                <?php
				                echo $this->render_pagination( $wp_query->max_num_pages, $paged );
			                }
		                ?>
	                </div>
				</div>
				<?php
				return ob_get_clean();
			} else {
				ob_start();
				?>
				<div class="music-shortcode not-music-found">
					No Musics are currently available
				</div>
				<?php
				return ob_get_clean();
			}
			
		}
		
		private function render_pagination( $num_pages = 1, $paged = 1 ) {
			$pagination_args = array(
				'format'       => 'page/%#%',
				'total'        => $num_pages,
				'current'      => $paged,
				'show_all'     => false,
				'end_size'     => 1,
				'mid_size'     => 3,
				'prev_next'    => true,
				'prev_text'    => __( '&laquo;' ),
				'next_text'    => __( '&raquo;' ),
				'type'         => 'plain',
				'add_args'     => false,
				'add_fragment' => ''
			);
			$paginate_links  = paginate_links( $pagination_args );
			ob_start();
			?>
			<div class="pagination">
				<?php echo $paginate_links; ?>
			</div>
			<?php
			return ob_get_clean();
			
		}
	}
