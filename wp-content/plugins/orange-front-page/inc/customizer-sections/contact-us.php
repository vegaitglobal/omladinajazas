<?php
// Set prefix
$prefix = ot_front_page()->plugin_prefix;
$option_name = 'Orange_Front_Page';

// Set section id
$panel_id = $prefix.'_contact_section';
$section_id = $prefix.'_contact_section_general';
$section_id_2 = $prefix.'_contact_section_details';

/***********************************************/
/********************* Contact  *****************/
/***********************************************/

$wp_customize->add_panel( $panel_id,
    array(
        'priority'          => 105,
        'capability'        => 'edit_theme_options',
        'theme_supports'    => '',
        'title'             => esc_html__( 'Contact us', 'orange-front-page' ),
        'description'       => esc_html__( 'Change about section information here.', 'orange-front-page' ),
    )
);

/***********************************************/
/********************* GENERAL  *****************/
/***********************************************/

$wp_customize->add_section( $section_id,
    array(
        'priority'          => 105,
        'theme_supports'    => '',
        'title'             => esc_html__( 'General Data', 'orange-front-page' ),
        'description'       => esc_html__( 'Change contact section information here.', 'orange-front-page' ),
        'panel'             => $panel_id
    )
);



// Show this section
$wp_customize->add_setting( $option_name.'[contact_us_show]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_checkbox' ),
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        //'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[contact_us_show]',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Show this section?', 'orange-front-page' ),
        'section'   => $section_id,
        'priority'  => 1
    )
);

// Title
$wp_customize->add_setting( $option_name.'[contact_title]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( 'Contact Us', 'orange-front-page' ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[contact_title]',
    array(
        'label'         => esc_html__( 'Title', 'orange-front-page' ),
        'description'   => esc_html__( 'Add the title for this section.', 'orange-front-page'),
        'section'       => $section_id,
        'priority'      => 2
    )
);
$wp_customize->selective_refresh->add_partial( $option_name.'[contact_title]', 
    array(
        'selector'            => '#contact .section-title',
        'container_inclusive' => true,
    ) 
);
// Text
$wp_customize->add_setting( $option_name.'[contact_text]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( 'If you have some Questions or need Help! Please Contact Us! We make Cool and Clean Design for your Business', 'orange-front-page' ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[contact_text]',
    array(
        'label'         => esc_html__( 'Text', 'orange-front-page' ),
        'description'   => esc_html__( 'Add the content for this section.', 'orange-front-page'),
        'section'       => $section_id,
        'priority'      => 3,
        'type'          => 'textarea'
    )
);

// background color
$wp_customize->add_setting( $option_name.'[contact_bg_color]', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#ffffff',
    'capability'        => 'edit_theme_options',
    'type'              => 'option',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $option_name.'[contact_bg_color]', array(
    'label'       => esc_html__( 'Background color', 'orange-front-page' ),
    'description' => esc_html__( 'Contact section background color', 'orange-front-page' ),
    'section'     => $section_id,
    'settings'    => $option_name.'[contact_bg_color]',
    'priority'    => 4,
) ) );


// text color
$wp_customize->add_setting( $option_name.'[contact_text_color]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_checkbox' ),
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
    )
);
$wp_customize->add_control(
    $option_name.'[contact_text_color]',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Light text?', 'orange-front-page' ),
        'description' => esc_html__( 'Choose text color scheme, light or dark', 'orange-front-page' ),
        'section'   => $section_id,
        'priority'  => 5
    )
);

/***********************************************/
/**************** CONTACT DETAILS  *************/
/***********************************************/

$wp_customize->add_section( $section_id_2,
    array(
        'priority'          => 105,
        'theme_supports'    => '',
        'title'             => esc_html__( 'Contact Details', 'orange-front-page' ),
        'description'       => esc_html__( 'Change contact section information here.', 'orange-front-page' ),
        'panel'             => $panel_id
    )
);


// Address title
$wp_customize->add_setting( $option_name.'[contact_address_title]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( 'Our Business Office', 'orange-front-page' ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[contact_address_title]',
    array(
        'label'         => esc_html__( 'Title', 'orange-front-page' ),
        'description'   => esc_html__( 'Add the title for this section.', 'orange-front-page'),
        'section'       => $section_id_2,
        'priority'      => 2
    )
);
$wp_customize->selective_refresh->add_partial( $option_name.'[contact_address_title]', 
    array(
        'selector'            => '#contact .address-details',
        'container_inclusive' => true,
    ) 
);
// Address
$wp_customize->add_setting( $option_name.'[contact_address]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( '34522 Street, Barcelona 442 &#13;&#10;Spain, New Building North, 25th Floor', 'orange-front-page' ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[contact_address]',
    array(
        'label'         => esc_html__( 'Address', 'orange-front-page' ),
        'description'   => esc_html__( 'Add the content for this section.', 'orange-front-page'),
        'section'       => $section_id_2,
        'priority'      => 3,
        'type'          => 'textarea'
    )
);



// Contact info itle
$wp_customize->add_setting( $option_name.'[contact_info_title]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( 'Contacts', 'orange-front-page' ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[contact_info_title]',
    array(
        'label'         => esc_html__( 'Title', 'orange-front-page' ),
        'description'   => esc_html__( 'Add the title for this section.', 'orange-front-page'),
        'section'       => $section_id_2,
        'priority'      => 4
    )
);

// Contact info phone
$wp_customize->add_setting( $option_name.'[contact_info_phone]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( '+101 377 655 22127', 'orange-front-page' ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[contact_info_phone]',
    array(
        'label'         => esc_html__( 'Phone', 'orange-front-page' ),
        'description'   => esc_html__( 'Add a phone number.', 'orange-front-page'),
        'section'       => $section_id_2,
        'priority'      => 5
    )
);

// Contact info email
$wp_customize->add_setting( $option_name.'[contact_info_email]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( 'mail@yourcompany.com', 'orange-front-page' ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[contact_info_email]',
    array(
        'label'         => esc_html__( 'Email', 'orange-front-page' ),
        'description'   => esc_html__( 'Add a email address.', 'orange-front-page'),
        'section'       => $section_id_2,
        'priority'      => 6
    )
);


//contact Form 7
$wp_customize->add_setting( $option_name.'[contact_from]',
    array(
        'sanitize_callback' => 'sanitize_key',
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
    )
);
$wp_customize->add_control( new OT_Front_Page_Custom_WPCF7(
    $wp_customize,
    $option_name.'[contact_from]',
        array(
            'type'              => 'orange-front-page_contact_form_7',
            'label'             => esc_html__( 'Select a contact form to display it in the contact section', 'orange-front-page' ),
            'section'           => $section_id_2,
            'priority'          => 7,
            'active_callback'   => array( ot_front_page()->customizer, 'cf7_active_callback' )
        )
    )
);

//contact form installation
$wp_customize->add_setting(
    $option_name.'[contact_from_install]',
    array(
        'sanitize_callback' => 'esc_html',
        'default'           => ''
    )
);
$wp_customize->add_control(
    new OT_Front_Page_Custom_Text(
        $wp_customize, 
        $option_name.'[contact_from_install]',
        array(
            'label'             => esc_html__( 'Install Contact From 7', 'orange-front-page' ),
            'description'       => sprintf( '%s %s %s', esc_html__( 'This option requires ', 'orange-front-page' ), '<a href="https://wordpress.org/plugins/contact-form-7/" title="Contact Form 7" target="_blank">Contact Form 7</a>', esc_html__( ', please install it to enable this option.', 'orange-front-page' ) ),
            'section'           => $section_id_2,
            'settings'          => $option_name.'[contact_from_install]',
            'priority'          => 7,
            'active_callback'   => array( ot_front_page()->customizer, 'cf7_inactive_callback' )
        )
    )
);
