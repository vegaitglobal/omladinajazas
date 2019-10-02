<?php
// Set prefix
$prefix = ot_front_page()->plugin_prefix;
$option_name = 'Orange_Front_Page';
// Set section id
$section_id = $prefix.'_latest_posts_section';

/***********************************************/
/****************** Latest Posts  *****************/
/***********************************************/
$wp_customize->add_section( $section_id,
    array(
        'priority'          => 102,
        'capability'        => 'edit_theme_options',
        'theme_supports'    => '',
        'title'             => esc_html__( 'Latest Posts Section', 'orange-front-page' ),
        'description'       => esc_html__( 'Change latest posts section information here.', 'orange-front-page' ),
    )
);



// Show this section
$wp_customize->add_setting( $option_name.'[latest_posts_show]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_checkbox' ),
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        //'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[latest_posts_show]',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Show this section?', 'orange-front-page' ),
        'section'   => $section_id,
        'priority'  => 1
    )
);

// Title
$wp_customize->add_setting( $option_name.'[latest_posts_title]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( 'Latest Posts', 'orange-front-page' ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[latest_posts_title]',
    array(
        'label'         => esc_html__( 'Title', 'orange-front-page' ),
        'description'   => esc_html__( 'Add the title for this section.', 'orange-front-page'),
        'section'       => $section_id,
        'priority'      => 2
    )
);
$wp_customize->selective_refresh->add_partial( $option_name.'[latest_posts_title]', 
    array(
        'selector'            => '#latest-posts .section-title',
        'container_inclusive' => true,
    ) 
);


// Text
$wp_customize->add_setting( $option_name.'[latest_posts_text]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.', 'orange-front-page' ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[latest_posts_text]',
    array(
        'label'         => esc_html__( 'Text', 'orange-front-page' ),
        'description'   => esc_html__( 'Add the content for this section.', 'orange-front-page'),
        'section'       => $section_id,
        'priority'      => 3,
        'type'          => 'textarea'
    )
);

// Post count
$wp_customize->add_setting( $option_name.'[latest_posts_count]', 
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_radio' ),
        'default'           => 3,
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        //'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( $option_name.'[latest_posts_count]', 
    array(
        'label'     => esc_html__( 'Post Count', 'orange-front-page' ),
        'section'   => $section_id,
        'settings'  => $option_name.'[latest_posts_count]',
        'type'      => 'radio',
        'choices'   => array(
                3   => esc_html__( '3 Posts', 'orange-front-page' ),
                4   => esc_html__( '4 Posts', 'orange-front-page' )
            ),
        'priority'  => 3
    ) 
);

// Post offset
$wp_customize->add_setting( $option_name.'[latest_posts_offset]',
    array(
        'sanitize_callback' => 'esc_html',
        'default'           => absint( 0 ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
    )
);
$wp_customize->add_control(
    $option_name.'[latest_posts_offset]',
    array(
        'label'             => esc_html__( 'Post Offset', 'orange-front-page' ),
        'description'       => esc_html__( 'Post listing offset, the listing will start from the post you entered.', 'orange-front-page'),
        'section'           => $section_id,
        'priority'          => 4
    )
);
// Post images
$wp_customize->add_setting( $option_name.'[latest_posts_images]',
    array(
        'sanitize_callback' => 'esc_html',
        'default'           => absint( 1 ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
    )
);
$wp_customize->add_control( $option_name.'[latest_posts_images]', 
    array(
        'label'     => esc_html__( 'Post Images', 'orange-front-page' ),
        'section'   => $section_id,
        'settings'  => $option_name.'[latest_posts_images]',
        'type'      => 'radio',
        'choices'   => array(
                1   => esc_html__( 'Show Images', 'orange-front-page' ),
                2   => esc_html__( 'Hide Images', 'orange-front-page' )
            ),
        'priority'  => 4
    ) 
);

// background color
$wp_customize->add_setting( $option_name.'[latest_posts_bg_color]', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#ffffff',
    'capability'        => 'edit_theme_options',
    'type'              => 'option'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $option_name.'[latest_posts_bg_color]', 
    array(
        'label'       => esc_html__( 'Background color', 'orange-front-page' ),
        'description' => esc_html__( 'Latest posts section background color', 'orange-front-page' ),
        'section'     => $section_id,
        'settings'    => $option_name.'[latest_posts_bg_color]',
        'priority'    => 5
    ) 
) );

// text color
$wp_customize->add_setting( $option_name.'[latest_posts_text_color]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_checkbox' ),
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'type'              => 'option'
    )
);
$wp_customize->add_control(
    $option_name.'[latest_posts_text_color]',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Light text?', 'orange-front-page' ),
        'description' => esc_html__( 'Choose text color scheme, light or dark', 'orange-front-page' ),
        'section'   => $section_id,
        'priority'  => 6
    )
);
