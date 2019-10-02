<?php

class ot_widgets_team extends WP_Widget {
	
	function __construct() {

		 parent:: __construct(false, $name = ot_widgets()->plugin_full_name.' '.esc_html__("Team",'orange-themes-custom-widgets'),array( 'description' => esc_html__("Widget with image, text, name and subtitle.",'orange-themes-custom-widgets')));	
	
	}


	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'image' => '',
			'text' => '',
			'title' => '',
			'subtitle' => '',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$image = $instance['image'];
		$text = $instance['text'];
		$title = $instance['title'];
		$subtitle = $instance['subtitle'];


        ?>
            <p>
            	<label for="<?php echo esc_attr($this->get_field_id('image')); ?>" style="float:left; width:100%;"><?php esc_html_e('Image:','orange-themes-custom-widgets'); ?> 
            	<input class="widefat ot-upload-field" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('image')); ?>" type="text" value="<?php echo esc_attr($image); ?>" /></label>
            	<span id="<?php echo esc_attr($this->get_field_id('image')); ?>_button" class="action ot-upload ot-upload-button button button-primary" style="margin-top:10px;">
            		<?php esc_html_e("Choose File",'orange-themes-custom-widgets');?>
            	</span>
            </p>
        	<p>
        		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:','orange-themes-custom-widgets'); ?> 
        		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>
        	</p>

        	<p>
        		<label for="<?php echo esc_attr($this->get_field_id('subtitle')); ?>"><?php esc_html_e('Subtitle:','orange-themes-custom-widgets'); ?> 
        		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('subtitle')); ?>" name="<?php echo esc_attr($this->get_field_name('subtitle')); ?>" type="text" value="<?php echo esc_attr($subtitle); ?>" /></label>
        	</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php  esc_html_e('Text:','orange-themes-custom-widgets'); ?> 
				<textarea rows="10" cols="15" class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>"><?php echo esc_html($text); ?></textarea></label>
			</p>

        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['image'] = strip_tags($new_instance['image']);
		$instance['text'] = strip_tags($new_instance['text']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['subtitle'] = strip_tags($new_instance['subtitle']);


		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );

		$image = (isset($instance['image'])) ? $instance['image'] : '' ;
		$text = (isset($instance['text'])) ? $instance['text'] : '' ;
		$title = (isset($instance['title'])) ? $instance['title'] : '' ;
		$subtitle = (isset($instance['subtitle'])) ? $instance['subtitle'] : '' ;


?>		
	<?php echo $before_widget; ?>
		
		<div class="ot-team-item">
			<?php if( $image ) { ?>
				<div class="ot-team-image">
					<img src="<?php echo esc_url($image);?>" alt="<?php echo esc_attr($title);?>">
				</div>
			<?php } ?>

			<?php if( $title || $subtitle || $text ) { ?>
				<div class="ot-team-text">

					<?php if( $title ) { ?>
						<h3 class="ot-team-title"><?php echo esc_html( $title );?></h3>
					<?php } ?>

					<?php if( $subtitle ) { ?>
						<div class="ot-team-position"><?php echo esc_html( $subtitle );?></div>
					<?php } ?>

					<?php if( $text ) { echo wpautop( esc_html( $text ) ); } ?>

				</div>
			<?php } ?>
		</div>
		
	<?php echo $after_widget; ?>
		
	
      <?php
	}
}