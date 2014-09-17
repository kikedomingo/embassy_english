<?php
/**
 * Extend Default Widgets
 *
 * Adds different formatting to the default WordPress Widgets
 */


/**
 * Extend Search Widget 
 */
 
Class emb_Search_Widget extends WP_Widget_Search {
 
	function widget($args, $instance) {
	
		extract($args);

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		// Use current theme search form if it exists
		// get_search_form();
		?>
			

			<form role="search" method="get" id="searchform" class="searchformform-search " action="/">
				<div class="input-append" style="width: 100%; margin-bottom: 0px; margin-top:5px">
					<label class="screen-reader-text" for="s" style="display:none">Search for:</label>
					<input type="text" value="" placeholder="Search the Embassy blog" name="s" id="s" class="search-query span12" style="width: 100%;">
					<button type="submit" id="searchsubmit" class="btn" style="display:none">Search</button>
				</div>
			</form>



		<?php
		echo $after_widget;
	}
}


/**
 * Extend Recent Comments Widget 
 */
 
Class emb_Recent_Comments_Widget extends WP_Widget_Recent_Comments {
 
	function widget( $args, $instance ) {
		global $comments, $comment;

		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get('widget_recent_comments', 'widget');
		}
		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		extract($args, EXTR_SKIP);
		$output = '';

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Comments' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;

		/**
		 * Filter the arguments for the Recent Comments widget.
		 *
		 * @since 3.4.0
		 *
		 * @see get_comments()
		 *
		 * @param array $comment_args An array of arguments used to retrieve the recent comments.
		 */
		$comments = get_comments( apply_filters( 'widget_comments_args', array(
			'number'      => $number,
			'status'      => 'approve',
			'post_status' => 'publish'
		) ) );

		$output .= $before_widget;
		if ( $title )
			$output .= $before_title . $title . $after_title;

		$output .= '<div id="recentcomments">';
		if ( $comments ) {
			// Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
			$post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
			_prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

			foreach ( (array) $comments as $comment) {
				$output .= get_avatar(get_the_author_meta( 'ID' ), 25) . '<span class="recentcomments">' . /* translators: comments widget: 1: comment author, 2: post link */ sprintf(_x('%1$s on %2$s', 'widgets'), get_comment_author_link(), '<a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">' . get_the_title($comment->comment_post_ID) . '</a>') . '</span>';
			}
		}
		$output .= '</div>';
		$output .= $after_widget;

		echo $output;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = $output;
			wp_cache_set( 'widget_recent_comments', $cache, 'widget' );
		}
	}
}


/**
 * Extend Recent Posts Widget 
 */
 
Class emb_Recent_Posts_Widget extends WP_Widget_Recent_Posts {
 
	function widget($args, $instance) {
	
		extract( $args );
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Latest News') : $instance['title'], $instance, $this->id_base);
				
		if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
			$number = 10;
					
		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if( $r->have_posts() ) :
			
			echo $before_widget;
			if( $title ) echo $before_title . $title . $after_title; ?>
			<div class="media recentposts">
				<?php while( $r->have_posts() ) : $r->the_post(); ?>	
				<?php 
							$category = get_the_category();
							$post = get_post();
						?>			
					

				 
						<?php if ( has_post_thumbnail() ) 
							{
						?>
							<a class="pull-left" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php echo get_the_post_thumbnail($post->ID, 'mini-thumb', array('class' => 'media-object') ); ?>
							</a>
						<?php
							} 
						?>

						<div <?php post_class('media-body'); ?>>
							<a class="pull-left" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<span class="cat-container"><?php echo $category[0]->cat_name;?></span>
							</a>
							<span class="date"><?php the_time('j F Y'); ?></span>
							<h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
					</div>
				
				<br />

					


									
				<?php endwhile; ?>
			</div>
			 
			<?php
			echo $after_widget;
		
		wp_reset_postdata();
		
		endif;
	}
}



/**
 * Extend Tag Cloud Widget 
 */
 
Class emb_Tag_Cloud_Widget extends WP_Widget_Tag_Cloud {
 
	function widget( $args, $instance ) {
		extract($args);
		$current_taxonomy = $this->_get_current_taxonomy($instance);
		if ( !empty($instance['title']) ) {
			$title = $instance['title'];
		} else {
			if ( 'post_tag' == $current_taxonomy ) {
				$title = __('Tags');
			} else {
				$tax = get_taxonomy($current_taxonomy);
				$title = $tax->labels->name;
			}
		}

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		echo '<div class="tagcloud">';

		/**
		 * Filter the taxonomy used in the Tag Cloud widget.
		 *
		 * @since 2.8.0
		 * @since 3.0.0 Added taxonomy drop-down.
		 *
		 * @see wp_tag_cloud()
		 *
		 * @param array $current_taxonomy The taxonomy to use in the tag cloud. Default 'tags'.
		 */
		wp_tag_cloud('smallest=11&largest=11&format=list', apply_filters( 'widget_tag_cloud_args', array(
			'taxonomy' => $current_taxonomy
		) ) );

		echo "</div>\n";
		echo $after_widget;
	}
}





function emb_widget_registration() {
	unregister_widget('WP_Widget_Tag_Cloud');
	register_widget('emb_Tag_Cloud_Widget');

	unregister_widget('WP_Widget_Recent_Posts');
	register_widget('emb_Recent_Posts_Widget');

	unregister_widget('WP_Widget_Search');
	register_widget('emb_Recent_Comments_Widget');

	unregister_widget('WP_Widget_Search');
	register_widget('emb_Search_Widget');
}
add_action('widgets_init', 'emb_widget_registration');

?>