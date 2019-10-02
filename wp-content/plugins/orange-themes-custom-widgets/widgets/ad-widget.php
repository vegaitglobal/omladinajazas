<?php

/*
 * Widget class.
 */
class ot_widgets_ad_widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	function __construct() {
	
		/* Widget settings */
		$widget_ops = array( 'classname' => 'ot-aspace-block', 'description' => esc_html__('A widget that allows the display and configuration of of a single 300x250,300x600','orange-themes-custom-widgets') );

		/* Widget control settings */
		$control_ops = array( 'width' => 300, 'height' => 250, 'id_base' => 'ot_widgets_ad_widget' );

		/* Create the widget */
		parent::__construct( 'ot_widgets_ad_widget',  $name = ot_widgets()->plugin_full_name.' '.esc_html__('Custom 300x250/300x600 Ads', 'orange-themes-custom-widgets'), $widget_ops, $control_ops );
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );

		$ad = $instance['ad'];
		$link = $instance['link'];


		/* Before widget (defined by themes). */
		echo balanceTags($before_widget, false);
		if($title) echo balanceTags($before_title.esc_html($title).$after_title,true);



		echo '<div class="ot-widget-container">';
			/* Display Ad */
			if ( $link ) {
				echo '<a href="'.esc_url($link).'" target="_blank"><img src="'.esc_attr($ad).'" alt="Banner"/></a>';
			} elseif ( $ad ) {
				echo '<img src="'.esc_url($ad).'" alt="Banner"/>';
			}


		echo '</div>';

		/* After widget (defined by themes). */
		echo balanceTags($after_widget, false);
	}

	/* ---------------------------- */
	/* ------- Update Widget -------- */
	/* ---------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );

		/* No need to strip tags */
		$instance['ad'] = $new_instance['ad'];
		$instance['link'] = $new_instance['link'];

		return $instance;
	}
	
	/* ---------------------------- */
	/* ------- Widget Settings ------- */
	/* ---------------------------- */
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	
	function form( $instance ) {
	
		/* Set up some default widget settings. */
		$defaults = array(
		'title' => '',
		'ad' => plugins_url( 'images/orange-336x280.jpg', dirname(__FILE__) ),
		'link' => 'https://www.orange-themes.com',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:','orange-themes-custom-widgets') ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<!-- Ad image url: Text Input -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'ad' )); ?>"><?php esc_html_e('Ad image url:','orange-themes-custom-widgets') ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'ad' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'ad' )); ?>" value="<?php echo esc_attr($instance['ad']); ?>" />
		</p>
		
		<!-- Ad link url: Text Input -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'link' )); ?>"><?php esc_html_e('Ad link url:','orange-themes-custom-widgets') ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'link' )); ?>" value="<?php echo esc_attr($instance['link']); ?>" />
		</p>
		
	<?php
	}
}
?>