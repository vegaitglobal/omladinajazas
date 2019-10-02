<?php
// Set prefix
$prefix = ot_front_page()->plugin_prefix;
$option_name = 'Orange_Front_Page';
// Set section id
$section_id = $prefix.'_portfolio_section';

/***********************************************/
/****************** Portfolio  *****************/
/***********************************************/
$wp_customize->add_section( $section_id,
    array(
        'priority'          => 102,
        'capability'        => 'edit_theme_options',
        'theme_supports'    => '',
        'title'             => esc_html__( 'Portfolio Section', 'orange-front-page' ),
        'description'       => esc_html__( 'Change portfolio section information here.', 'orange-front-page' ),
    )
);



// Show this section
$wp_customize->add_setting( $option_name.'[portfolio_show]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_checkbox' ),
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        //'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[portfolio_show]',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Show this section?', 'orange-front-page' ),
        'section'   => $section_id,
        'priority'  => 1,
        'active_callback'   => array( ot_front_page()->customizer, 'jetpack_portfolio_active_callback' )
    )
);

// Title
$wp_customize->add_setting( $option_name.'[portfolio_title]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( 'Portfolio', 'orange-front-page' ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[portfolio_title]',
    array(
        'label'         => esc_html__( 'Title', 'orange-front-page' ),
        'description'   => esc_html__( 'Add the title for this section.', 'orange-front-page'),
        'section'       => $section_id,
        'priority'      => 2,
        'active_callback'   => array( ot_front_page()->customizer, 'jetpack_portfolio_active_callback' )
    )
);
$wp_customize->selective_refresh->add_partial( $option_name.'[portfolio_title]', 
    array(
        'selector'            => '#portfolio .section-title',
        'container_inclusive' => true,
    ) 
);
// Text
$wp_customize->add_setting( $option_name.'[portfolio_text]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( 'Our portfolio is the best way to show our work, you can see here a big range of our work. Check them all and you will find what you are looking for.', 'orange-front-page' ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[portfolio_text]',
    array(
        'label'         => esc_html__( 'Text', 'orange-front-page' ),
        'description'   => esc_html__( 'Add the content for this section.', 'orange-front-page'),
        'section'       => $section_id,
        'priority'      => 3,
        'type'          => 'textarea',
        'active_callback'   => array( ot_front_page()->customizer, 'jetpack_portfolio_active_callback' )
    )
);

// Post count
$wp_customize->add_setting( $option_name.'[portfolio_count]',
    array(
        'sanitize_callback' => 'esc_html',
        'default'           => absint( 6 ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
    )
);
$wp_customize->add_control(
    $option_name.'[portfolio_count]',
    array(
        'label'             => esc_html__( 'Post Count', 'orange-front-page' ),
        'description'       => esc_html__( 'Add the number of posts to show in this section.', 'orange-front-page'),
        'section'           => $section_id,
        'priority'          => 4,
        'active_callback'   => array( ot_front_page()->customizer, 'jetpack_portfolio_active_callback' )
    )
);


//image hover effect
$wp_customize->add_setting( $option_name.'[portfolio_image_hover_effect]',
    array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'bubba',
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    $option_name.'[portfolio_image_hover_effect]',
    array(
        'label'         => esc_html__( 'Image hover effect', 'orange-front-page' ),
        'type'          => 'select',
        'section'       => $section_id,
        'priority'      => 4,
        'choices'       => array(
            'bubba'     => esc_html__( 'Bubba', 'orange-front-page' ),
            'apollo'    => esc_html__( 'Apollo', 'orange-front-page' ),
            'milo'      => esc_html__( 'Milo', 'orange-front-page' ),
            'jazz'      => esc_html__( 'Jazz', 'orange-front-page' ),
            'goliath'   => esc_html__( 'Goliath', 'orange-front-page' ),
        ),
        'active_callback'   => array( ot_front_page()->customizer, 'jetpack_portfolio_active_callback' )
    )
);

// hover background color
$wp_customize->add_setting( $option_name.'[portfolio_image_overlay_color]', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#1a1a1a',
    'capability'        => 'edit_theme_options',
    'type'              => 'option',
    'transport'         => 'postMessage'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $option_name.'[portfolio_image_overlay_color]', 
    array(
        'label'       => esc_html__( 'Image overlay', 'orange-front-page' ),
        'section'     => $section_id,
        'settings'    => $option_name.'[portfolio_image_overlay_color]',
        'priority'    => 5,
        'active_callback'   => array( ot_front_page()->customizer, 'jetpack_portfolio_active_callback' )
    ) 
) );

// background color
$wp_customize->add_setting( $option_name.'[portfolio_bg_color]', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#ffffff',
    'capability'        => 'edit_theme_options',
    'type'              => 'option'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $option_name.'[portfolio_bg_color]', 
    array(
        'label'       => esc_html__( 'Background color', 'orange-front-page' ),
        'description' => esc_html__( 'Portfolio section background color', 'orange-front-page' ),
        'section'     => $section_id,
        'settings'    => $option_name.'[portfolio_bg_color]',
        'priority'    => 5,
        'active_callback'   => array( ot_front_page()->customizer, 'jetpack_portfolio_active_callback' )
    ) 
) );

// text color
$wp_customize->add_setting( $option_name.'[portfolio_text_color]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_checkbox' ),
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'type'              => 'option'
    )
);
$wp_customize->add_control(
    $option_name.'[portfolio_text_color]',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Light text?', 'orange-front-page' ),
        'description' => esc_html__( 'Choose text color scheme, light or dark', 'orange-front-page' ),
        'section'   => $section_id,
        'priority'  => 6,
        'active_callback'   => array( ot_front_page()->customizer, 'jetpack_portfolio_active_callback' )
    )
);



//jetpack form installation
$wp_customize->add_setting(
    $option_name.'[jetpack_portfolio_install]',
    array(
        'sanitize_callback' => 'esc_html',
        'default'           => ''
    )
);
$wp_customize->add_control(
    new OT_Front_Page_Custom_Text(
        $wp_customize, 
        $option_name.'[jetpack_portfolio_install]',
        array(
            'label'             => esc_html__( 'Install JetPack', 'orange-front-page' ),
            'description'       => sprintf( '%s %s %s', esc_html__( 'This option requires ', 'orange-front-page' ), '<a href="https://wordpress.org/plugins/jetpack/" title="JetPack" target="_blank">JetPack</a>', esc_html__( ', please install it and enable Custom Post Type: Portfolio to enable this option.', 'orange-front-page' ) ),
            'section'           => $section_id,
            'settings'          => $option_name.'[jetpack_portfolio_install]',
            'priority'          => 7,
            'active_callback'   => array( ot_front_page()->customizer, 'jetpack_portfolio_inactive_callback' )
        )
    )
);