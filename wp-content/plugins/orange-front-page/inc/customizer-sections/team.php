<?php
// Set prefix
$prefix = ot_front_page()->plugin_prefix;
$option_name = 'Orange_Front_Page';
// Set section id
$section_id = $prefix.'_team_section';

/***********************************************/
/********************* Team  *****************/
/***********************************************/
$wp_customize->add_section( $section_id,
    array(
        'priority'          => 104,
        'capability'        => 'edit_theme_options',
        'theme_supports'    => '',
        'title'             => esc_html__( 'Team Section', 'orange-front-page' ),
        'description'       => esc_html__( 'Change team section information here.', 'orange-front-page' ),
    )
);



// Show this section
$wp_customize->add_setting( $option_name.'[team_show]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_checkbox' ),
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'type'              => 'option'
    )
);
$wp_customize->add_control(
    $option_name.'[team_show]',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Show this section?', 'orange-front-page' ),
        'section'   => $section_id,
        'priority'  => 1,
        'active_callback'   => array( ot_front_page()->customizer, 'ot_widgets_active_callback' )
    )
);

// Title
$wp_customize->add_setting( $option_name.'[team_title]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( 'Team', 'orange-front-page' ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[team_title]',
    array(
        'label'         => esc_html__( 'Title', 'orange-front-page' ),
        'description'   => esc_html__( 'Add the title for this section.', 'orange-front-page'),
        'section'       => $section_id,
        'priority'      => 2,
        'active_callback'   => array( ot_front_page()->customizer, 'ot_widgets_active_callback' )
    )
);
$wp_customize->selective_refresh->add_partial( $option_name.'[team_title]', 
    array(
        'selector'            => '#team .section-title',
        'container_inclusive' => true,
    ) 
);
// Text
$wp_customize->add_setting( $option_name.'[team_text]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_html' ),
        'default'           => esc_html__( 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.', 'orange-front-page' ),
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $option_name.'[team_text]',
    array(
        'label'         => esc_html__( 'Text', 'orange-front-page' ),
        'description'   => esc_html__( 'Add the content for this section.', 'orange-front-page'),
        'section'       => $section_id,
        'priority'      => 3,
        'type'          => 'textarea',
        'active_callback'   => array( ot_front_page()->customizer, 'ot_widgets_active_callback' )
    )
);

// background color
$wp_customize->add_setting( $option_name.'[team_bg_color]', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#f2f1f7',
    'capability'        => 'edit_theme_options',
    'type'              => 'option'
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $option_name.'[team_bg_color]', array(
    'label'       => esc_html__( 'Background color', 'orange-front-page' ),
    'description' => esc_html__( 'Team section background color', 'orange-front-page' ),
    'section'     => $section_id,
    'settings'    => $option_name.'[team_bg_color]',
    'priority'    => 4,
    'active_callback'   => array( ot_front_page()->customizer, 'ot_widgets_active_callback' )
) ) );


// text color
$wp_customize->add_setting( $option_name.'[team_text_color]',
    array(
        'sanitize_callback' => array( ot_front_page()->customizer, 'sanitize_checkbox' ),
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'type'              => 'option'
    )
);
$wp_customize->add_control(
    $option_name.'[team_text_color]',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Light text?', 'orange-front-page' ),
        'description' => esc_html__( 'Choose text color scheme, light or dark', 'orange-front-page' ),
        'section'   => $section_id,
        'priority'  => 5,
        'active_callback'   => array( ot_front_page()->customizer, 'ot_widgets_active_callback' )
    )
);


//ot widgets form installation
$wp_customize->add_setting(
    $option_name.'[ot_widgets_install]',
    array(
        'sanitize_callback' => 'esc_html',
        'default'           => ''
    )
);
$wp_customize->add_control(
    new OT_Front_Page_Custom_Text(
        $wp_customize, 
        $option_name.'[ot_widgets_install]',
        array(
            'label'             => esc_html__( 'Install Orange Themes Custom Widgets', 'orange-front-page' ),
            'description'       => sprintf( '%s %s %s', esc_html__( 'This option requires ', 'orange-front-page' ), '<a href="https://wordpress.org/plugins/orange-themes-custom-widgets" title="Orange Themes Custom Widgets" target="_blank">Orange Themes Custom Widgets</a>', esc_html__( ', please install it to enable team widgets.', 'orange-front-page' ) ),
            'section'           => $section_id,
            'settings'          => $option_name.'[ot_widgets_install]',
            'priority'          => 7,
            'active_callback'   => array( ot_front_page()->customizer, 'ot_widgets_inactive_callback' )
        )
    )
);