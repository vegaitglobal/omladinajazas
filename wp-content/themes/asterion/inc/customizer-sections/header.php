<?php
// Set prefix
$prefix = 'asterion';

// Set section id
$panel_id = $prefix.'_header_section';
// Set section id
$section_id = $prefix.'_main_header_section';
$section_id_2 = $prefix.'_blog_header_section';
$section_id_3 = $prefix.'_header_menu';


/***********************************************/
/********************* HEADER DETAILS  *****************/
/***********************************************/

$wp_customize->add_panel( $panel_id,
    array(
        'priority'          => 22,
        'capability'        => 'edit_theme_options',
        'theme_supports'    => '',
        'title'             => esc_html__( 'Header Settings', 'asterion' ),
        'description'       => esc_html__( 'Theme header options like front page, blog and archive page images', 'asterion' ),
    )
);


/***********************************************/
/************ MAIN HEADER DETAILS  **************/
/***********************************************/

$wp_customize->add_section( $section_id,
    array(
        'priority'          => 1,
        'theme_supports'    => '',
        'title'             => esc_html__( 'Front Page Header', 'asterion' ),
        'description'       => esc_html__( 'Front page header information here.', 'asterion' ),
        'panel'             => $panel_id
    )
);


/* Header Intro Image */
$wp_customize->add_setting( $prefix . '_intro_image', array(
    'sanitize_callback' => 'esc_url_raw',
    'default'           => esc_url_raw( get_template_directory_uri() . '/images/bg.jpg' ),
    'transport'         => 'postMessage',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix . '_intro_image', array(
    'label'       => esc_html__( 'Header image', 'asterion' ),
    'description' => esc_html__( 'Header intro image', 'asterion' ),
    'section'     => $section_id,
    'settings'    => $prefix . '_intro_image',
    'priority'    => 1,
) ) );
$wp_customize->selective_refresh->add_partial( $prefix . '_intro_image', 
    array(
        'selector'            => '#header .intro-text',
        'container_inclusive' => true,
    ) 
);

// Parallax effect
$wp_customize->add_setting( $prefix . '_intro_image_parallax',
    array(
        'sanitize_callback' => array( asterion()->customizer, 'sanitize_checkbox' ),
        'default'           => 1,
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix . '_intro_image_parallax',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Enable parallax effect?', 'asterion' ),
        'section'   => $section_id,
        'priority'  => 1
    )
);

// Image overlay
$wp_customize->add_setting( $prefix . '_intro_image_overlay',
    array(
        'sanitize_callback' => array( asterion()->customizer, 'sanitize_checkbox' ),
        'default'           => 1,
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix . '_intro_image_overlay',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Enable image overlay?', 'asterion' ),
        'section'   => $section_id,
        'priority'  => 1
    )
);


// Image title
$wp_customize->add_setting( $prefix .'_header_title_1',
    array(
        'sanitize_callback' => array( asterion()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( 'Welcome To MOOZ Themes!', 'asterion' ),
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix .'_header_title_1',
    array(
        'label'         => esc_html__( 'First title for header image', 'asterion' ),
        'section'       => $section_id,
        'priority'      => 2
    )
);

// Image title 2
$wp_customize->add_setting( $prefix .'_header_title_2',
    array(
        'sanitize_callback' => array( asterion()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( 'YOUR FAVORITE SOURCE OF FREE BOOTSTRAP THEMES', 'asterion' ),
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix .'_header_title_2',
    array(
        'label'         => esc_html__( 'Second title for header image', 'asterion' ),
        'section'       => $section_id,
        'priority'      => 3
    )
);

// Button title
$wp_customize->add_setting( $prefix .'_header_button_title',
    array(
        'sanitize_callback' => array( asterion()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( 'Tell me more', 'asterion' ),
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix .'_header_button_title',
    array(
        'label'         => esc_html__( 'Button title', 'asterion' ),
        'section'       => $section_id,
        'priority'      => 4
    )
);

// Button url
$wp_customize->add_setting( $prefix .'_header_button_url',
    array(
        'sanitize_callback' => 'esc_url_raw',
        'default'           => esc_html__( '#', 'asterion' ),
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix .'_header_button_url',
    array(
        'label'         => esc_html__( 'Button URL', 'asterion' ),
        'section'       => $section_id,
        'priority'      => 5
    )
);

// Button target
$wp_customize->add_setting( $prefix . '_header_button_target',
    array(
        'sanitize_callback' => array( asterion()->customizer, 'sanitize_checkbox' ),
        'default'           => 1,
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix . '_header_button_target',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Open link in new tab?', 'asterion' ),
        'section'   => $section_id,
        'priority'  => 6
    )
);


/***********************************************/
/************** BLOG HEADER DETAILS  ************/
/***********************************************/

$wp_customize->add_section( $section_id_2,
    array(
        'priority'          => 2,
        'theme_supports'    => '',
        'title'             => esc_html__( 'Blog/Archive Header Settings', 'asterion' ),
        'description'       => esc_html__( 'Blog/Archive header image.', 'asterion' ),
        'panel'             => $panel_id
    )
);

/***********************************************/
/************ HEADER MENU SETTINGS  ************/
/***********************************************/

$wp_customize->add_section( $section_id_3,
    array(
        'priority'          => 3,
        'theme_supports'    => '',
        'title'             => esc_html__( 'Main Menu', 'asterion' ),
        'description'       => esc_html__( 'Menu color settings', 'asterion' ),
        'panel'             => $panel_id
    )
);


// Menu style
$wp_customize->add_setting( $prefix . '_menu_style', 
    array(
        'sanitize_callback' => array( asterion()->customizer, 'sanitize_radio' ),
        'default'           => 2,
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( $prefix . '_menu_style', 
    array(
        'label'     => esc_html__( 'Main Menu Style', 'asterion' ),
        'section'   => $section_id_3,
        'settings'  => $prefix . '_menu_style',
        'type'      => 'radio',
        'choices'   => array(
                1   => esc_html__( 'Dark Menu', 'asterion' ),
                2   => esc_html__( 'Light Menu', 'asterion' )
            ),
        'priority'  => 1
    ) 
);


// Menu background style
$wp_customize->add_setting( $prefix . '_menu_bg_style', 
    array(
        'sanitize_callback' => array( asterion()->customizer, 'sanitize_radio' ),
        'default'           => 1,
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( $prefix . '_menu_bg_style', 
    array(
        'label'     => esc_html__( 'Main Menu Background Style', 'asterion' ),
        'section'   => $section_id_3,
        'settings'  => $prefix . '_menu_bg_style',
        'type'      => 'radio',
        'choices'   => array(
                1   => esc_html__( 'No Background', 'asterion' ),
                2   => esc_html__( 'Menu Overlay', 'asterion' )
            ),
        'priority'  => 1
    ) 
);


// Menu position
$wp_customize->add_setting( $prefix . '_menu_position', 
    array(
        'sanitize_callback' => array( asterion()->customizer, 'sanitize_radio' ),
        'default'           => 1,
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( $prefix . '_menu_position', 
    array(
        'label'     => esc_html__( 'Main Menu Position', 'asterion' ),
        'section'   => $section_id_3,
        'settings'  => $prefix . '_menu_position',
        'type'      => 'radio',
        'choices'   => array(
                1   => esc_html__( 'Sticky Menu', 'asterion' ),
                2   => esc_html__( 'Fixed Menu', 'asterion' )
            ),
        'priority'  => 1
    ) 
);


//blog image
$wp_customize->get_section( 'header_image' )->panel = $panel_id;
$wp_customize->get_section( 'header_image' )->title = esc_html__( 'Blog Archive Header Image', 'asterion' );

