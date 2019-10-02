<?php
// Set prefix
$prefix = ot_front_page()->plugin_prefix;
$option_name = 'Orange_Front_Page';
// Set section id
$section_id = $prefix.'_section_order';



/***********************************************/
/**************** SECTION ORDER  ***************/
/***********************************************/

$wp_customize->add_section( $section_id,
    array(
        'priority'          => 101,
        'theme_supports'    => '',
        'capability'        => 'edit_theme_options',
        'title'             => esc_html__( 'Section Order', 'orange-front-page' ),
        'description'       => esc_html__( 'Reorder the front page sections.', 'orange-front-page' )
    )
);


$section_order = ot_front_page()->home->section_order();

$sections = ot_front_page()->home->sections();
//update the array key 
foreach ($sections as $key => $section) {
    $_sections[$key+1] = $section;
}

$sections = $_sections;

foreach ( $section_order as $key => $section) {


    $wp_customize->add_setting( $option_name.'[section_order_'.$key.']',
        array(
            'sanitize_callback' => 'esc_attr',
            'capability'        => 'edit_theme_options',
            'type'              => 'option',
            'default'           => $key
        )
    );

    $wp_customize->add_control(
        $option_name.'[section_order_'.$key.']',
        array(
            'label'         => sprintf( '%s %s', $section[1]." ", esc_html__( 'section', 'orange-front-page' ) ),
            'description'   => sprintf( '%s %s %s', esc_html__( 'Select what section you would like see', 'orange-front-page' )," ".strtolower($section[1])." ", esc_html__( 'on the front page.', 'orange-front-page' ) ),
            'type'          => 'select',
            'section'       => $section_id,
            'choices'       => $sections
        )
    );

}
