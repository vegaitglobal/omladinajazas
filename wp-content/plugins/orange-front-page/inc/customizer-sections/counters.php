<?php
// Set prefix
$prefix = ot_front_page()->plugin_prefix;
$option_name = 'Orange_Front_Page';
// Set section id
$section_id = $prefix.'_counters_section';

/***********************************************/
/****************** COUNTERS  *****************/
/***********************************************/
$wp_customize->add_section( $section_id,
    array(
        'priority'          => 102,
        'capability'        => 'edit_theme_options',
        'theme_supports'    => '',
        'title'             => esc_html__( 'Counters Section', 'orange-front-page' ),
        'description'       => esc_html__( 'Change counters section information here.', 'orange-front-page' ),
    )
);



// Show this section
$wp_customize->add_setting( $option_name.'[counters_show]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_checkbox' ),
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'type'              => 'option'
        //'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[counters_show]',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Show this section?', 'orange-front-page' ),
        'section'   => $section_id,
        'priority'  => 1
    )
);

$wp_customize->selective_refresh->add_partial( $option_name.'[counters_show]', 
    array(
        'selector'            => '#counters .ot-container',
        'container_inclusive' => true,
    ) 
);

// Title 1
$wp_customize->add_setting( $option_name.'[counters_title_1]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( 'Awards', 'orange-front-page' ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[counters_title_1]',
    array(
        'label'         => esc_html__( 'First Counter Title', 'orange-front-page' ),
        'section'       => $section_id,
        'priority'      => 2,
    )
);


// counter count 1
$wp_customize->add_setting( $option_name.'[counters_count_1]',
    array(
        'sanitize_callback' => 'esc_html',
        'default'           => absint( 16 ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[counters_count_1]',
    array(
        'label'             => esc_html__( 'First Counter Count', 'orange-front-page' ),
        'description'       => esc_html__( 'Add a number to the counter', 'orange-front-page'),
        'section'           => $section_id,
        'priority'          => 3
    )
);

// Title 2
$wp_customize->add_setting( $option_name.'[counters_title_2]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( 'Clients', 'orange-front-page' ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[counters_title_2]',
    array(
        'label'         => esc_html__( 'Second Counter Title', 'orange-front-page' ),
        'section'       => $section_id,
        'priority'      => 4,
    )
);

// counter count 2
$wp_customize->add_setting( $option_name.'[counters_count_2]',
    array(
        'sanitize_callback' => 'esc_html',
        'default'           => absint( 453 ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[counters_count_2]',
    array(
        'label'             => esc_html__( 'Second Counter Count', 'orange-front-page' ),
        'description'       => esc_html__( 'Add a number to the counter', 'orange-front-page'),
        'section'           => $section_id,
        'priority'          => 5
    )
);

// Title 3
$wp_customize->add_setting( $option_name.'[counters_title_3]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( 'Team', 'orange-front-page' ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[counters_title_3]',
    array(
        'label'         => esc_html__( 'Third Counter Title', 'orange-front-page' ),
        'section'       => $section_id,
        'priority'      => 6,
    )
);

// counter count 2
$wp_customize->add_setting( $option_name.'[counters_count_3]',
    array(
        'sanitize_callback' => 'esc_html',
        'default'           => absint( 7 ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[counters_count_3]',
    array(
        'label'             => esc_html__( 'Third Counter Count', 'orange-front-page' ),
        'description'       => esc_html__( 'Add a number to the counter', 'orange-front-page'),
        'section'           => $section_id,
        'priority'          => 6
    )
);

// Title 4
$wp_customize->add_setting( $option_name.'[counters_title_4]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( 'Projects', 'orange-front-page' ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[counters_title_4]',
    array(
        'label'         => esc_html__( 'Forth Counter Title', 'orange-front-page' ),
        'section'       => $section_id,
        'priority'      => 7,
    )
);

// counter count 2
$wp_customize->add_setting( $option_name.'[counters_count_4]',
    array(
        'sanitize_callback' => 'esc_html',
        'default'           => absint( 24 ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[counters_count_4]',
    array(
        'label'             => esc_html__( 'Forth Counter Count', 'orange-front-page' ),
        'description'       => esc_html__( 'Add a number to the counter', 'orange-front-page'),
        'section'           => $section_id,
        'priority'          => 8
    )
);



// Background Type
$wp_customize->add_setting( $option_name.'[counters_bg_type]', 
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_radio' ),
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( $option_name.'[counters_bg_type]', 
    array(
        'label'     => esc_html__( 'Background Type', 'orange-front-page' ),
        'section'   => $section_id,
        'settings'  => $option_name.'[counters_bg_type]',
        'type'      => 'radio',
        'choices'   => array(
                1   => esc_html__( 'Image', 'orange-front-page' ),
                2   => esc_html__( 'Color', 'orange-front-page' )
            ),
        'priority'  => 9
    ) 
);


/* Background Image */
$wp_customize->add_setting( $option_name.'[counters_bg_image]', 
    array(
        'sanitize_callback' => 'esc_url_raw',
        'default'           => esc_url_raw( plugin_dir_url( __FILE__ ) .'../../images/counters-bg.jpg' ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    ) 
);

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $option_name.'[counters_bg_image]', 
    array(
        'label'       => esc_html__( 'Background image', 'orange-front-page' ),
        'section'     => $section_id,
        'settings'    => $option_name.'[counters_bg_image]',
        'priority'    => 10,
    ) 
) );


// Parallax effect
$wp_customize->add_setting( $option_name.'[counters_image_parallax]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_checkbox' ),
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[counters_image_parallax]',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Enable background image parallax effect?', 'orange-front-page' ),
        'section'   => $section_id,
        'priority'  => 11
    )
);

// Image overlay
$wp_customize->add_setting( $option_name.'[counters_image_overlay]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_checkbox' ),
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[counters_image_overlay]',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Enable background image overlay?', 'orange-front-page' ),
        'section'   => $section_id,
        'priority'  => 12
    )
);



// background color
$wp_customize->add_setting( $option_name.'[counters_bg_color]',
    array(
        'sanitize_callback' => 'sanitize_hex_color',
        'default'           => '#ffffff',
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $option_name.'[counters_bg_color]', 
    array(
        'label'       => esc_html__( 'Background color', 'orange-front-page' ),
        'description' => esc_html__( 'Counters section background color', 'orange-front-page' ),
        'section'     => $section_id,
        'settings'    => $option_name.'[counters_bg_color]',
        'priority'    => 13,
    ) 
) );

// text color
$wp_customize->add_setting( $option_name.'[counters_text_color]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_checkbox' ),
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[counters_text_color]',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Light text?', 'orange-front-page' ),
        'description' => esc_html__( 'Choose text color scheme, light or dark', 'orange-front-page' ),
        'section'   => $section_id,
        'priority'  => 14,
    )
);



