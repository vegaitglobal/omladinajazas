<?php
// Set prefix
$prefix = 'asterion';

// Set section id
$section_id = $prefix.'_portfolio_section';

/***********************************************/
/********************* Portfolio  *****************/
/***********************************************/
$wp_customize->add_section( $section_id,
    array(
        'priority'          => 102,
        'capability'        => 'edit_theme_options',
        'theme_supports'    => '',
        'title'             => esc_html__( 'Portfolio Section', 'asterion' ),
        'description'       => esc_html__( 'Change portfolio section information here.', 'asterion' ),
    )
);



//ot widgets form installation
$wp_customize->add_setting(
    $prefix .'_ot_widgets_install_3',
    array(
        'sanitize_callback' => 'esc_html',
        'default'           => ''
    )
);
$wp_customize->add_control(
    new Asterion_Custom_Text(
        $wp_customize, 
        $prefix .'_ot_widgets_install_3',
        array(
            'label'             => esc_html__( 'Install Orange Front Page', 'asterion' ),
            'description'       => sprintf( '%s %s %s', esc_html__( 'This option requires ', 'asterion' ), '<a href="https://wordpress.org/plugins/orange-front-page/" title="Orange Front Page" target="_blank">Orange Front Page</a>', esc_html__( ', please install it to enable this section.', 'asterion' ) ),
            'section'           => $section_id,
            'settings'          => $prefix .'_ot_widgets_install_3',
            'priority'          => 7,
            'active_callback'   => array( asterion()->customizer, 'ot_orange_inactive_callback' )
        )
    )
);