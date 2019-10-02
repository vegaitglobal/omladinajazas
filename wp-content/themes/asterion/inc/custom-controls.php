<?php


/**
 *  Custom Control: Text
 */
if( !class_exists( 'Asterion_Custom_Text' ) ) {
    class Asterion_Custom_Text extends WP_Customize_Control {
        public function render_content() {
 

            echo '<span class="customize-control-title">'. $this->label .'</span>';
            echo '<span class="description customize-control-description">'. $this->description .'</span>';

        }
    }
}

