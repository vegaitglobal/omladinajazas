<?php
// Set prefix
$prefix = 'asterion';

// Set section id
$panel_id = $prefix.'_blog_section';
$section_id = $prefix.'_blog_section_single_post';
$section_id_2 = $prefix.'_blog_section_blog_listing';


/***********************************************/
/********************* Contact  *****************/
/***********************************************/

$wp_customize->add_panel( $panel_id,
    array(
        'priority'          => 101,
        'capability'        => 'edit_theme_options',
        'theme_supports'    => '',
        'title'             => esc_html__( 'Blog Settings', 'asterion' ),
        'description'       => esc_html__( 'Customize blog page here.', 'asterion' ),
    )
);

/***********************************************/
/****************** SINGLE POST  ***************/
/***********************************************/

$wp_customize->add_section( $section_id,
    array(
        'priority'          => 1,
        'theme_supports'    => '',
        'title'             => esc_html__( 'Single Post', 'asterion' ),
        'description'       => esc_html__( 'Change single post settings', 'asterion' ),
        'panel'             => $panel_id
    )
);



// image in single post
$wp_customize->add_setting( $prefix . '_single_post_image',
    array(
        'sanitize_callback' => array( asterion()->customizer, 'sanitize_checkbox' ),
        'default'           => 1,
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix . '_single_post_image',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Show image in single post page?', 'asterion' ),
        'section'   => $section_id,
        'priority'  => 1
    )
);
$wp_customize->selective_refresh->add_partial( $prefix . '_single_post_image', 
    array(
        'selector'            => '.single-post .blog-post-image',
        'container_inclusive' => true,
    ) 
);


// date in single post
$wp_customize->add_setting( $prefix . '_single_post_date',
    array(
        'sanitize_callback' => array( asterion()->customizer, 'sanitize_checkbox' ),
        'default'           => 1,
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix . '_single_post_date',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Show date in single post page?', 'asterion' ),
        'section'   => $section_id,
        'priority'  => 2
    )
);
$wp_customize->selective_refresh->add_partial( $prefix . '_single_post_date', 
    array(
        'selector'            => '.single-post .post-date',
        'container_inclusive' => true,
    ) 
);

// author in single post
$wp_customize->add_setting( $prefix . '_single_post_author',
    array(
        'sanitize_callback' => array( asterion()->customizer, 'sanitize_checkbox' ),
        'default'           => 1,
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix . '_single_post_author',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Show post author in single post page?', 'asterion' ),
        'section'   => $section_id,
        'priority'  => 3
    )
);


// tags in single post
$wp_customize->add_setting( $prefix . '_single_post_tags',
    array(
        'sanitize_callback' => array( asterion()->customizer, 'sanitize_checkbox' ),
        'default'           => 1,
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix . '_single_post_tags',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Show post tags in single post page?', 'asterion' ),
        'section'   => $section_id,
        'priority'  => 4
    )
);
$wp_customize->selective_refresh->add_partial( $prefix . '_single_post_tags', 
    array(
        'selector'            => '.single-post .mz-entry-tags',
        'container_inclusive' => true,
    ) 
);
// categories in single post
$wp_customize->add_setting( $prefix . '_single_post_cat',
    array(
        'sanitize_callback' => array( asterion()->customizer, 'sanitize_checkbox' ),
        'default'           => 1,
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix . '_single_post_cat',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Show post categories in single post page?', 'asterion' ),
        'section'   => $section_id,
        'priority'  => 5
    )
);

/***********************************************/
/***************** BLOG LISTING  ***************/
/***********************************************/

$wp_customize->add_section( $section_id_2,
    array(
        'priority'          => 2,
        'theme_supports'    => '',
        'title'             => esc_html__( 'Blog Listing', 'asterion' ),
        'description'       => esc_html__( 'Change blog listing settings', 'asterion' ),
        'panel'             => $panel_id
    )
);



// image in single post
$wp_customize->add_setting( $prefix . '_blog_post_image',
    array(
        'sanitize_callback' => array( asterion()->customizer, 'sanitize_checkbox' ),
        'default'           => 1,
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix . '_blog_post_image',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Show post image in blog listing page?', 'asterion' ),
        'section'   => $section_id_2,
        'priority'  => 1
    )
);
$wp_customize->selective_refresh->add_partial( $prefix . '_blog_post_image', 
    array(
        'selector'            => '.blog #primary .blog-post-image',
        'container_inclusive' => true,
    ) 
);

// date in single post
$wp_customize->add_setting( $prefix . '_blog_post_date',
    array(
        'sanitize_callback' => array( asterion()->customizer, 'sanitize_checkbox' ),
        'default'           => 1,
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix . '_blog_post_date',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Show post date in blog listing page?', 'asterion' ),
        'section'   => $section_id_2,
        'priority'  => 2
    )
);
$wp_customize->selective_refresh->add_partial( $prefix . '_blog_post_date', 
    array(
        'selector'            => '.blog #primary .post-meta',
        'container_inclusive' => true,
    ) 
);


// author in single post
$wp_customize->add_setting( $prefix . '_blog_post_comment',
    array(
        'sanitize_callback' => array( asterion()->customizer, 'sanitize_checkbox' ),
        'default'           => 1,
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix . '_blog_post_comment',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Show post comment count in blog listing page?', 'asterion' ),
        'section'   => $section_id_2,
        'priority'  => 3
    )
);

// categories in single post
$wp_customize->add_setting( $prefix . '_blog_post_cat',
    array(
        'sanitize_callback' => array( asterion()->customizer, 'sanitize_checkbox' ),
        'default'           => 1,
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix . '_blog_post_cat',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__( 'Show blog post categories in blog listing page?', 'asterion' ),
        'section'   => $section_id_2,
        'priority'  => 4
    )
);
