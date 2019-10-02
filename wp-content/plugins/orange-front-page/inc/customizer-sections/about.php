<?php
// Set prefix
$prefix = ot_front_page()->plugin_prefix;
$option_name = 'Orange_Front_Page';

// Set section id
$section_id = $prefix.'_about_section';

/***********************************************/
/********************* About  *****************/
/***********************************************/
$wp_customize->add_section( $section_id,
    array(
        'priority'          => 102,
        'capability'        => 'edit_theme_options',
        'theme_supports'    => '',
        'title'             => esc_html__( 'About Section', 'orange-front-page' ),
        'description'       => esc_html__( 'Change about section information here.', 'orange-front-page' ),
    )
);



// Show this section
$wp_customize->add_setting( $option_name.'[about_show]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_checkbox' ),
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'type'              => 'option'
    )
);
$wp_customize->add_control(
    $option_name.'[about_show]',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Show this section?', 'orange-front-page' ),
        'section'   => $section_id,
        'priority'  => 1
    )
);


// Title
$wp_customize->add_setting( $option_name.'[about_title]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( 'About', 'orange-front-page' ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[about_title]',
    array(
        'label'         => esc_html__( 'Title', 'orange-front-page' ),
        'description'   => esc_html__( 'Add the title for this section.', 'orange-front-page'),
        'section'       => $section_id,
        'priority'      => 2
    )
);
$wp_customize->selective_refresh->add_partial( $option_name.'[about_title]', 
    array(
        'selector'            => '#about .section-title',
        'container_inclusive' => true,
    ) 
);
// Text
$wp_customize->add_setting( $option_name.'[about_text]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.', 'orange-front-page' ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[about_text]',
    array(
        'label'         => esc_html__( 'Text', 'orange-front-page' ),
        'description'   => esc_html__( 'Add the content for this section.', 'orange-front-page'),
        'section'       => $section_id,
        'priority'      => 3,
        'type'          => 'textarea'
    )
);


// facebook
$wp_customize->add_setting( $option_name.'[about_facebook]',
    array(
        'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        //'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[about_facebook]',
    array(
        'label'         => esc_html__( 'Facebook', 'orange-front-page' ),
        'description'   => esc_html__( 'Facebook Account Link', 'orange-front-page'),
        'section'       => $section_id,
        'priority'      => 3,
    )
);


// twitter
$wp_customize->add_setting( $option_name.'[about_twitter]',
    array(
        'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        //'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[about_twitter]',
    array(
        'label'         => esc_html__( 'Twitter', 'orange-front-page' ),
        'description'   => esc_html__( 'Twitter Account Link', 'orange-front-page'),
        'section'       => $section_id,
        'priority'      => 3,
    )
);

// linkedin
$wp_customize->add_setting( $option_name.'[about_linkedin]',
    array(
        'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        //'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[about_linkedin]',
    array(
        'label'         => esc_html__( 'Linkedin', 'orange-front-page' ),
        'description'   => esc_html__( 'Linkedin Account Link', 'orange-front-page'),
        'section'       => $section_id,
        'priority'      => 3,
    )
);


// background color
$wp_customize->add_setting( $option_name.'[about_bg_color]', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#ffffff',
    'capability'        => 'edit_theme_options',
    'type'              => 'option',
    'transport'         => 'postMessage'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $option_name.'[about_bg_color]', array(
    'label'       => esc_html__( 'Background color', 'orange-front-page' ),
    'description' => esc_html__( 'About section background color', 'orange-front-page' ),
    'section'     => $section_id,
    'settings'    => $option_name.'[about_bg_color]',
    'priority'    => 4,
) ) );


// text color
$wp_customize->add_setting( $option_name.'[about_text_color]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_checkbox' ),
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[about_text_color]',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Light text?', 'orange-front-page' ),
        'description' => esc_html__( 'Choose text color scheme, light or dark', 'orange-front-page' ),
        'section'   => $section_id,
        'priority'  => 5
    )
);