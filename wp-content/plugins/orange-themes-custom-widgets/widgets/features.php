<?php

class ot_widgets_features extends WP_Widget {
	function __construct() {
		 parent:: __construct(false, $name = ot_widgets()->plugin_full_name.' '.esc_html__("Features",'orange-themes-custom-widgets'),array( 'description' => esc_html__("Widget With Icon And Text",'orange-themes-custom-widgets')));	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'icon' => '',
			'text' => '',
			'title' => '',
			'color' => '#23AD21',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$icon = $instance['icon'];
		$text = $instance['text'];
		$title = $instance['title'];
		$color = $instance['color'];


        ?>
 			<p>
 				<label for="<?php echo esc_attr($this->get_field_id('icon')); ?>"><?php esc_html_e('Icon:','orange-themes-custom-widgets');?>
					<?php $icons = ot_widgets()->icons->get_list(); ?> 	
					<select class="widefat" name="<?php echo esc_attr($this->get_field_name('icon')); ?>">
						<?php foreach($icons as $_icon) { ?>
							<option value="<?php echo esc_attr($_icon); ?>" <?php if($icon == $_icon) { echo 'selected="selected"'; } ?>><?php echo esc_html($_icon); ?></option>
						<?php } ?>
					</select>
				</label>
			</p>
	        <p>
	            <label for="<?php echo esc_attr($this->get_field_id( 'color' )); ?>"><?php esc_html_e( 'Color:', 'orange-themes-custom-widgets' ); ?></label><br>
	            <input type="text" name="<?php echo esc_attr($this->get_field_name( 'color' )); ?>" class="color-picker" id="<?php echo esc_attr($this->get_field_id( 'color' )); ?>" value="<?php echo esc_attr($color); ?>" data-default-color="#23AD21" />
	        </p>
        	<p>
        		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:','orange-themes-custom-widgets'); ?> 
        		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>
        	</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php  esc_html_e('Text:','orange-themes-custom-widgets'); ?> 
				<textarea rows="10" cols="15" class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>"><?php echo esc_html($text); ?></textarea></label>
			</p>

        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['icon'] = strip_tags($new_instance['icon']);
		$instance['text'] = strip_tags($new_instance['text']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['color'] = strip_tags($new_instance['color']);


		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );

		$icon = (isset($instance['icon'])) ? $instance['icon'] : '' ;
		$text = (isset($instance['text'])) ? $instance['text'] : '' ;
		$title = (isset($instance['title'])) ? $instance['title'] : '' ;
		$color = (isset($instance['color'])) ? $instance['color'] : '#23AD21' ;


?>		
	<?php echo $before_widget; ?>
		
		<div class="ot-features-item">
			<?php if( $icon && $icon != "no icon" ) { ?>
				<i class="fa <?php echo esc_attr($icon);?> ot-circle" style="background-color: <?php echo esc_attr( $color );?>"></i>
			<?php } ?>
			<?php if( $title ) { ?>
				<h3 class="ot-features-title"><?php echo esc_html( $title );?></h3>
			<?php } ?>
			<?php if($text) { echo wpautop(esc_html($text)); } ?>
		</div>

	<?php echo $after_widget; ?>
		
	
      <?php
	}
}