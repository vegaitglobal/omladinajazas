<?php
/**
 *	Custom Control: Contact Form 7
 */
if( !class_exists( 'OT_Front_Page_Custom_WPCF7' ) ) {
    class OT_Front_Page_Custom_WPCF7 extends WP_Customize_Control {

        public function active_callback() {

            if( class_exists( 'WPCF7' ) ) {
                return true;
            } else {
                return false;
            }

        }

        public function get_contact_forms() {
            global $wpdb;

            $contact_forms = array();

            // check if WPCF7 is activated
            if ( $this->active_callback() ) {
                $wpcf7 = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'wpcf7_contact_form' ");
                if ( $wpcf7 ) {

                    foreach ( $wpcf7 as $forms ) {
                        $contact_forms[$forms->ID] = $forms->post_title;
                    }
                } else {
                    $contact_forms[0] = esc_html__('No contact forms found', 'orange-front-page');
                }
            }
            return $contact_forms;
        }

        public function render_content() {

            $contact_forms = $this->get_contact_forms();

            if ( is_array( $contact_forms ) && !empty( $contact_forms ) ) : ?>
                
                <span class="customize-control-title">
                    <?php echo esc_html( $this->label ); ?>
                </span>
                <select <?php esc_url( $this->link() ); ?> style="width:100%;">
                    <option value="default"><?php esc_html_e('Select a contact form', 'orange-front-page');?></option>
                    <?php 
                        foreach ($contact_forms as $id => $title) {
                            echo '<option value="' . sanitize_key( $id ). '" >' . esc_html( $title ). '</option>';
                        }
                    ?>
                </select>
        <?php
            endif;
        }
    }
}

/**
 *  Custom Control: Text
 */
if( !class_exists( 'OT_Front_Page_Custom_Text' ) ) {
    class OT_Front_Page_Custom_Text extends WP_Customize_Control {
        public function render_content() {
 

            echo '<span class="customize-control-title">'. $this->label .'</span>';
            echo '<span class="description customize-control-description">'. $this->description .'</span>';

        }
    }
}

