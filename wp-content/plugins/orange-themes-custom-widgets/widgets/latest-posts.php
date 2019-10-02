<?php

class ot_widgets_latest_posts extends WP_Widget {
	function __construct() {
		/* Widget settings */
		parent:: __construct(false, $name = ot_widgets()->plugin_full_name.' '.esc_html__("Latest Posts",'orange-themes-custom-widgets'),array( 'classname' => 'ot-recent-posts', 'description' => esc_html__("Latest post widget with category and tag filters",'orange-themes-custom-widgets')));	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => esc_html__("Latests News",'orange-themes-custom-widgets'),
			'cat' => array(),
			'tag' => array(),
			'offset' => '0',
			'count' => '3',
			'images' => 'show',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = $instance['title'];
		$cat = $instance['cat'];
		$tag = $instance['tag'];
		$offset = $instance['offset'];
		$count = $instance['count'];
		$images = $instance['images'];
		

        ?>
        	<p>
        		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:','orange-themes-custom-widgets'); ?> 
        		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>
        	</p>

 			<p>
 				<label for="<?php echo esc_attr($this->get_field_id('cat')); ?>">
 					<?php esc_html_e('Category:','orange-themes-custom-widgets');?>
					<?php
						$args = array(
								'type'                     => 'post',
								'child_of'                 => 0,
								'orderby'                  => 'name',
								'order'                    => 'ASC',
								'hide_empty'               => 1,
								'hierarchical'             => 1,
								'taxonomy'                 => 'category'
							);
						$args = get_categories( $args ); 
					?> 	
					<select multiple name="<?php echo esc_attr($this->get_field_name('cat')); ?>[]" style="height:150px; width: 100%; clear: both; margin: 0;">
						<?php foreach($args as $ar) : ?>
							<option value="<?php echo esc_attr($ar->term_id); ?>" <?php if( $cat && in_array($ar->term_id, $cat)) { echo 'selected="selected"'; } ?>>
								<?php echo esc_html($ar->cat_name); ?>
							</option>
						<?php endforeach; ?>
					</select>
				</label>
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('tag')); ?>">
					<?php esc_html_e('Tag:','orange-themes-custom-widgets');?>
					<?php
						$args = array(
							'child_of'                 => 0,
							'orderby'                  => 'name',
							'order'                    => 'ASC',
							'hide_empty'               => 1,
							'hierarchical'             => 1,
						);
						$args = get_tags( $args ); 
					?> 	
					<select multiple name="<?php echo esc_attr($this->get_field_name('tag')); ?>[]" style="height:150px; width: 100%; clear: both; margin: 0;">
						<?php foreach($args as $ar) { ?>
							<option value="<?php echo esc_attr($ar->term_id); ?>" <?php if( $tag && in_array($ar->term_id, $tag)) { echo 'selected="selected"'; } ?>>
								<?php echo esc_html($ar->name ); ?>
							</option>
						<?php } ?>
					</select>
				</label>
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('images')); ?>">
					<?php esc_html_e('Images:','orange-themes-custom-widgets');?>
					<select name="<?php echo esc_attr($this->get_field_name('images')); ?>" style="width: 100%; clear: both; margin: 0;">
						<option value="show" <?php if( "show" == $images )  { echo 'selected="selected"'; } ?>><?php esc_html_e("Show",'orange-themes-custom-widgets');?></option>
						<option value="hide" <?php if( "hide" == $images )  { echo 'selected="selected"'; } ?>><?php esc_html_e("Hide",'orange-themes-custom-widgets');?></option>
					</select>
				</label>
			</p>	

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('count')); ?>">
					<?php esc_html_e('Post count:','orange-themes-custom-widgets');?> 
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="number" value="<?php echo esc_attr($count); ?>" />
				</label>
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('offset')); ?>">
					<?php esc_html_e('Offset:','orange-themes-custom-widgets');?> 
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('offset')); ?>" name="<?php echo esc_attr($this->get_field_name('offset')); ?>" type="number" value="<?php echo esc_attr($offset); ?>" />
				</label>
			</p>

        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['cat'] = $new_instance['cat'];
		$instance['tag'] = $new_instance['tag'];
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['images'] = strip_tags($new_instance['images']);
		$instance['offset'] = strip_tags($new_instance['offset']);


		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );


		$title = $instance['title'];
		$count = $instance['count'];
		$cat = $instance['cat'];
		$images = $instance['images'];
		$tag = $instance['tag'];
		$offset = $instance['offset'];

		if(is_array($cat)) {
			$args['category__in'] = $cat;
			$category__in = $args['category__in'];
		} else if($cat) {
			$args['cat'] = $cat;
			$category__in = false;
		} else {
			$category__in = false;
		}

		if(is_array($tag)) {
			$args['tag__in'] = $tag;
			$tag__in = $args['tag__in'];
		} else if($cat) {
			$args['tag'] = $tag;
			$tag__in = false;
		} else {
			$tag__in = false;
		}

		$args = array(
			'offset' => $offset,
			'category__in' => $category__in,
			'tag__in' => $tag__in,
			'posts_per_page'=> $count,
			'ignore_sticky_posts' => true
		);

		$the_query = new WP_Query($args);
		$counter = 1;
?>		
	<?php echo $before_widget; ?>
		<?php 
			if( $title ) { 
				echo $before_title;
				echo esc_html($title);
				echo $after_title;
			}
		?>

		<!-- recent posts -->
		<div class="ot-widget-container">

			<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
			
				<!-- post -->
				<div class="ot-widget-post<?php echo ($images == "hide" || !has_post_thumbnail()) ? ' ot-no-image' : false ; ?>">
					<?php if( $images != "hide" && has_post_thumbnail() ) { ?>
						<!-- image -->
						<div class="post-image ">
							<a href="<?php the_permalink();?>">
								<?php the_post_thumbnail( 'ot-widgets-latest-posts-thumbnail' ); ?>			
							</a>
						</div> <!-- end post image -->
					<?php } ?>
					<!-- content -->
					<div class="post-body">

						<h2>
							<a href="<?php the_permalink();?>">
								<?php the_title();?>
							</a>
						</h2>
						<div class="post-meta">
							<span>
								<?php the_time( get_option('date_format') );?>
							</span>
							<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
								<span>
									<i class="fa fa-comment-o"></i> 
									<?php comments_number( '0', '1', '%' ); ?>.
								</span>
							<?Php endif;?>
						</div>

					</div><!-- end content -->

				</div><!-- end post -->


			<?php endwhile; else: ?>
				<p><?php  esc_html_e('No posts were found','orange-themes-custom-widgets');?></p>
			<?php endif; ?>

		</div>

	<?php echo $after_widget; ?>
		
	
      <?php
	}
}