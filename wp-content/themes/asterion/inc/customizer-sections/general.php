<?php
// Set prefix
$prefix = 'asterion';

// Set section id
$panel_id = $prefix.'_general_section';
$section_id = $prefix.'_copyright';
$section_id_3 = $prefix.'_color_options';


/***********************************************/
/**************** General Settings  ************/
/***********************************************/

$wp_customize->add_panel( $panel_id,
    array(
        'priority'          => 21,
        'capability'        => 'edit_theme_options',
        'theme_supports'    => '',
        'title'             => esc_html__( 'General Settings', 'asterion' ),
        'description'       => esc_html__( 'Theme general options like header and footer settings, copyright information etc.', 'asterion' ),
    )
);


/***********************************************/
/****************** COPYRIGHT  *****************/
/***********************************************/

$wp_customize->add_section( $section_id,
    array(
        'priority'          => 2,
        'theme_supports'    => '',
        'title'             => esc_html__( 'Copyright', 'asterion' ),
        'description'       => esc_html__( 'Change copyright here.', 'asterion' ),
        'panel'             => $panel_id
    )
);



// Title
$wp_customize->add_setting( $prefix .'_copyright',
    array(
        'sanitize_callback' => array( asterion()->customizer, 'sanitize_html' ),
        'default'           => sprintf( __( '&copy; Copyright %s. All Rights Reserved.', 'asterion' ), date('Y')),
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix .'_copyright',
    array(
        'label'         => esc_html__( 'Copyright', 'asterion' ),
        'description'   => esc_html__( 'Add your copyright message here.', 'asterion'),
        'section'       => $section_id,
        'priority'      => 1
    )
);
$wp_customize->selective_refresh->add_partial( $prefix . '_copyright', 
    array(
        'selector'            => '.ot-footer .ot-copyright',
        'container_inclusive' => true
    ) 
);

/***********************************************/
/****************** COLORS  *****************/
/***********************************************/

$wp_customize->add_section( $section_id_3,
    array(
        'priority'          => 2,
        'theme_supports'    => '',
        'title'             => esc_html__( 'Colors', 'asterion' ),
        'description'       => esc_html__( 'Customize theme colors here.', 'asterion' ),
        'panel'             => $panel_id
    )
);



// accent color
$wp_customize->add_setting( $prefix .'_accent_color',
    array(
        'sanitize_callback' => 'sanitize_hex_color',
        'default'           => '#00afa4'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
    $prefix .'_accent_color',
    array(
        'label'         => esc_html__( 'Accent Color', 'asterion' ),
        'description'   => esc_html__( 'Theme accent colors', 'asterion'),
        'section'       => $section_id_3,
        'priority'      => 1
    )
));

// hover color
$wp_customize->add_setting( $prefix .'_hover_color',
    array(
        'sanitize_callback' => 'sanitize_hex_color',
        'default'           => '#fbcc3f'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
    $prefix .'_hover_color',
    array(
        'label'         => esc_html__( 'Hover Color', 'asterion' ),
        'description'   => esc_html__( 'Theme hover colors', 'asterion'),
        'section'       => $section_id_3,
        'priority'      => 2
    )
));


