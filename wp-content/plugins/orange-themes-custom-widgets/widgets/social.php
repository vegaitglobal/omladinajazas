<?php

class ot_widgets_social extends WP_Widget {
	
	function __construct() {

		 parent:: __construct(false, $name = ot_widgets()->plugin_full_name.' '.esc_html__("Social",'orange-themes-custom-widgets'),array( 'classname' => 'ot-widget-socials', 'description' => esc_html__("Widget with social network links",'orange-themes-custom-widgets')));	
	
	}


	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => esc_html__("Follow Me",'orange-themes-custom-widgets'),
			'twitter' => 'http://www.twitter.com/orangethemes',
			'facebook' => 'http://www.facebook.com/orangethemes',
			'google' => 'http://www.orange-themes.com',
			'pinterest' => 'http://www.orange-themes.com',
			'tumblr' => 'http://www.orange-themes.com',
			'instagram' => 'http://www.orange-themes.com',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = $instance['title'];
		$twitter = $instance['twitter'];
		$facebook = $instance['facebook'];
		$google = $instance['google'];
		$pinterest = $instance['pinterest'];
		$tumblr = $instance['tumblr'];
		$instagram = $instance['instagram'];


        ?>

        	<p>
        		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
        			<?php esc_html_e('Title:','orange-themes-custom-widgets'); ?> 
        			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        		</label>
        	</p>

        	<p>
        		<label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>">
        			<?php esc_html_e('Twitter Account Url:','orange-themes-custom-widgets'); ?> 
        			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" />
        		</label>
        	</p>
        	<p>
        		<label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>">
        			<?php esc_html_e('Facebook Account Url:','orange-themes-custom-widgets'); ?> 
        			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" />
        		</label>
        	</p>
        	<p>
        		<label for="<?php echo esc_attr($this->get_field_id('google')); ?>">
        			<?php esc_html_e('Google+ Account Url:','orange-themes-custom-widgets'); ?> 
        			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('google')); ?>" name="<?php echo esc_attr($this->get_field_name('google')); ?>" type="text" value="<?php echo esc_attr($google); ?>" />
        		</label>
        	</p>
        	<p>
        		<label for="<?php echo esc_attr($this->get_field_id('pinterest')); ?>">
        			<?php esc_html_e('Pinterest Account Url:','orange-themes-custom-widgets'); ?> 
        			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>" />
        		</label>
        	</p>
        	<p>
        		<label for="<?php echo esc_attr($this->get_field_id('tumblr')); ?>">
        			<?php esc_html_e('Tumblr Account Url:','orange-themes-custom-widgets'); ?> 
        			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('tumblr')); ?>" name="<?php echo esc_attr($this->get_field_name('tumblr')); ?>" type="text" value="<?php echo esc_attr($tumblr); ?>" />
        		</label>
        	</p>

        	<p>
        		<label for="<?php echo esc_attr($this->get_field_id('instagram')); ?>">
        			<?php esc_html_e('Instagram Account Url:','orange-themes-custom-widgets'); ?> 
        			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram')); ?>" type="text" value="<?php echo esc_attr($instagram); ?>" />
        		</label>
        	</p>



        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter'] = esc_url($new_instance['twitter']);
		$instance['facebook'] = esc_url($new_instance['facebook']);
		$instance['google'] = esc_url($new_instance['google']);
		$instance['pinterest'] = esc_url($new_instance['pinterest']);
		$instance['tumblr'] = esc_url($new_instance['tumblr']);
		$instance['instagram'] = esc_url($new_instance['instagram']);


		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );


		$title = (isset($instance['title'])) ? $instance['title'] : '' ;
		$twitter = (isset($instance['twitter'])) ? $instance['twitter'] : '' ;
		$facebook = (isset($instance['facebook'])) ? $instance['facebook'] : '' ;
		$google = (isset($instance['google'])) ? $instance['google'] : '' ;
		$pinterest = (isset($instance['pinterest'])) ? $instance['pinterest'] : '' ;
		$tumblr = (isset($instance['tumblr'])) ? $instance['tumblr'] : '' ;
		$instagram = (isset($instance['instagram'])) ? $instance['instagram'] : '' ;


?>		
	<?php echo $before_widget; ?>
		<?php 
			if( $title ) { 
				echo $before_title;
				echo esc_html($title);
				echo $after_title;
			}
		?>


		<div class="widget-container">

			<div class="widget-socials">
				<?php if( $twitter ) : ?>
					<a href="<?php echo esc_url( $twitter );?>" title="<?php esc_attr_e("Twitter", "orange-themes-custom-widgets");?>" target="_blank">
						<i class="fa fa-twitter"></i>
					</a>
				<?php endif;?>
				<?php if( $facebook ) : ?>
					<a href="<?php echo esc_url( $facebook );?>" title="<?php esc_attr_e("Facebook", "orange-themes-custom-widgets");?>" target="_blank">
						<i class="fa fa-facebook"></i>
					</a>
				<?php endif;?>
				<?php if( $google ) : ?>
					<a href="<?php echo esc_url( $google );?>" title="<?php esc_attr_e("Google+", "orange-themes-custom-widgets");?>" target="_blank">
						<i class="fa fa-google-plus"></i>
					</a>
				<?php endif;?>
				<?php if( $pinterest ) : ?>
					<a href="<?php echo esc_url( $pinterest );?>" title="<?php esc_attr_e("Pinterest", "orange-themes-custom-widgets");?>" target="_blank">
						<i class="fa fa-pinterest"></i>
					</a>
				<?php endif;?>
				<?php if( $tumblr ) : ?>
					<a href="<?php echo esc_url( $tumblr );?>" title="<?php esc_attr_e("Tumblr", "orange-themes-custom-widgets");?>" target="_blank">
						<i class="fa fa-tumblr"></i>
					</a>
				<?php endif;?>
				<?php if( $instagram ) : ?>
					<a href="<?php echo esc_url( $instagram );?>" title="<?php esc_attr_e("Instagram", "orange-themes-custom-widgets");?>" target="_blank">
						<i class="fa fa-instagram"></i>
					</a>
				<?php endif;?>
				

			</div>

		</div>

	<?php echo $after_widget; ?>
		
	
      <?php
	}
}