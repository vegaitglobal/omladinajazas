<?php

class ot_widgets_about_author extends WP_Widget {
	
	function __construct() {

		 parent:: __construct(false, $name = ot_widgets()->plugin_full_name.' '.esc_html__("About Blog Author",'orange-themes-custom-widgets'),array( 'classname' => 'ot-widget-about-author', 'description' => esc_html__("Widget with image, name, subtitle and author description.",'orange-themes-custom-widgets')));	
	
	}


	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => esc_html__("About Blog Author",'orange-themes-custom-widgets'),
			'image' => '',
			'text' => '',
			'name' => '',
			'subtitle' => '',
			'read_more_url' => '',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		$title = $instance['title'];
		$image = $instance['image'];
		$text = $instance['text'];
		$name = $instance['name'];
		$subtitle = $instance['subtitle'];
		$read_more_url = $instance['read_more_url'];


        ?>
        	<p>
        		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
        			<?php esc_html_e('Title:','orange-themes-custom-widgets'); ?> 
        			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        		</label>
        	</p>
            <p>
            	<label for="<?php echo esc_attr($this->get_field_id('image')); ?>" style="float:left; width:100%;">
            		<?php esc_html_e('Image:','orange-themes-custom-widgets'); ?> 
            		<input class="widefat ot-upload-field" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('image')); ?>" type="text" value="<?php echo esc_attr($image); ?>" />
            	</label>
            	<span id="<?php echo esc_attr($this->get_field_id('image')); ?>_button" class="action ot-upload ot-upload-button button button-primary" style="margin-top:10px;">
            		<?php esc_html_e("Choose File",'orange-themes-custom-widgets');?>
            	</span>
            </p>

        	<p>
        		<label for="<?php echo esc_attr($this->get_field_id('name')); ?>">
        			<?php esc_html_e('Name:','orange-themes-custom-widgets'); ?> 
        			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('name')); ?>" name="<?php echo esc_attr($this->get_field_name('name')); ?>" type="text" value="<?php echo esc_attr($name); ?>" />
        		</label>
        	</p>
        	<p>
        		<label for="<?php echo esc_attr($this->get_field_id('subtitle')); ?>"><?php esc_html_e('Subtitle:','orange-themes-custom-widgets'); ?> 
        		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('subtitle')); ?>" name="<?php echo esc_attr($this->get_field_name('subtitle')); ?>" type="text" value="<?php echo esc_attr($subtitle); ?>" /></label>
        	</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('text')); ?>">
					<?php  esc_html_e('Desciprion:','orange-themes-custom-widgets'); ?> 
					<textarea rows="10" cols="15" class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>"><?php echo esc_html($text); ?></textarea>
				</label>
			</p>
        	<p>
        		<label for="<?php echo esc_attr($this->get_field_id('read_more_url')); ?>"><?php esc_html_e('Read More Url:','orange-themes-custom-widgets'); ?> 
        		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('read_more_url')); ?>" name="<?php echo esc_attr($this->get_field_name('read_more_url')); ?>" type="text" value="<?php echo esc_attr($read_more_url); ?>" /></label>
        	</p>
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['image'] = esc_url($new_instance['image']);
		$instance['text'] = strip_tags($new_instance['text']);
		$instance['name'] = strip_tags($new_instance['name']);
		$instance['subtitle'] = strip_tags($new_instance['subtitle']);
		$instance['read_more_url'] = esc_url($new_instance['read_more_url']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );

		$title = (isset($instance['title'])) ? $instance['title'] : '' ;
		$image = (isset($instance['image'])) ? $instance['image'] : '' ;
		$text = (isset($instance['text'])) ? $instance['text'] : '' ;
		$name = (isset($instance['name'])) ? $instance['name'] : '' ;
		$subtitle = (isset($instance['subtitle'])) ? $instance['subtitle'] : '' ;
		$read_more_url = (isset($instance['read_more_url'])) ? $instance['read_more_url'] : '' ;


?>		
	<?php echo $before_widget; ?>
		<?php 
			if( $title ) { 
				echo $before_title;
				echo esc_html($title);
				echo $after_title;
			}
		?>


		<div class="author-item">
			<?php if( $image ) : ?>
				<div class="author-image">
					<img src="<?php echo esc_url( $image );?>" alt="<?php echo esc_attr( $name );?>">
				</div>
			<?php endif;?>

			<div class="author-post">

				<?php if( $name ) : ?>
					<h3>
						<?php echo esc_html( $name );?>
					</h3>
				<?php endif;?>

				<?php if( $subtitle ) : ?>
					<div class="author-position">
						<?php echo esc_html( $subtitle );?>
					</div>
				<?php endif;?>

				<?php if( $text ) : ?>
					<?php echo wpautop( do_shortcode( $text ) );?>
				<?php endif;?>

				<?php if( $read_more_url ) : ?>
					<div class="read-more">
						<a href="<?php echo esc_url( $read_more_url );?>" class="btn">
							<?php esc_html_e("Read More", 'orange-themes-custom-widgets');?>
						</a>
					</div>
				<?php endif;?>

			</div>

		</div>

	<?php echo $after_widget; ?>
		
	
      <?php
	}
}