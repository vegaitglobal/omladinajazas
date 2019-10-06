<?php 
/**
 * SKT Strong functions and definitions
 *
 * @package SKT Strong
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'skt_strong_setup' ) ) : 
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function skt_strong_setup() {
	if ( ! isset( $content_width ) )
		$content_width = 640; /* pixels */

	load_theme_textdomain( 'skt-strong', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('woocommerce');
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'title-tag' );
	add_image_size( 'skt-strong-logo', 350, 100 );
	add_theme_support( 'custom-logo', array( 'size' => 'skt-strong-logo' ) );
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'skt-strong' ),		
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_editor_style( 'editor-style.css' );
} 
endif; // skt_strong_setup
add_action( 'after_setup_theme', 'skt_strong_setup' );


function skt_strong_widgets_init() { 	
	
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'skt-strong' ),
		'description'   => __( 'Appears on blog page sidebar', 'skt-strong' ),
		'id'            => 'sidebar-1',
		'before_widget' => '',		
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Header Right Widget', 'skt-strong' ),
		'description'   => __( 'Appears on top of the header', 'skt-strong' ),
		'id'            => 'header-right-widget',
		'before_widget' => '',		
		'before_title'  => '<h3 class="widget-title" style="display:none">',
		'after_title'   => '</h3>',
		'after_widget'  => '',
	) );		
	
}
add_action( 'widgets_init', 'skt_strong_widgets_init' );


function skt_strong_font_url(){
		$font_url = '';		
		
		/* Translators: If there are any character that are not
		* supported by Roboto, trsnalate this to off, do not
		* translate into your own language.
		*/
		$roboto = _x('on','roboto:on or off','skt-strong');		
		
		
		/* Translators: If there has any character that are not supported 
		*  by Scada, translate this to off, do not translate
		*  into your own language.
		*/
		$scada = _x('on','Scada:on or off','skt-strong');	
		
		if('off' !== $roboto ){
			$font_family = array();
			
			if('off' !== $roboto){
				$font_family[] = 'Roboto:300,400,600,700,800,900';
			}
					
						
			$query_args = array(
				'family'	=> rawurlencode(implode('|',$font_family)),
			);
			
			$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
		}
		
	return $font_url;
	}


function skt_strong_scripts() {
	wp_enqueue_style('skt-strong-font', skt_strong_font_url(), array());
	wp_enqueue_style( 'skt-strong-basic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'nivo-slider', get_template_directory_uri()."/css/nivo-slider.css" );
    wp_enqueue_style( 'ojh', get_template_directory_uri()."/css/ojh.css" );
    wp_enqueue_style( 'skt-strong-main-style', get_template_directory_uri()."/css/responsive.css" );
	wp_enqueue_style( 'skt-strong-base-style', get_template_directory_uri()."/css/style_base.css" );
	wp_enqueue_script( 'jquery-nivo', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );
	wp_enqueue_script( 'skt-strong-custom-js', get_template_directory_uri() . '/js/custom.js' );
	wp_enqueue_script( 'skt-strong-quiz-js', get_template_directory_uri() . '/js/quiz.js' );	
	wp_enqueue_script( 'skt-strong-test-js', get_template_directory_uri() . '/js/test_znanja.js' );		
		

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'skt_strong_scripts' );

define('SKT_CREDIT','https://www.sktthemes.org/product-category/free-wordpress-themes/','skt-autocar');
define('SKT_URL','https://www.sktthemes.org','skt-strong');
define('SKT_PRO_THEME_URL','https://www.sktthemes.org/shop/crossfit-wordpress-theme/','skt-strong');
define('SKT_THEME_DOC','http://sktthemesdemo.net/documentation/strong-documentation/','skt-strong');
define('SKT_FREE_THEME_URL','https://www.sktthemes.org/shop/free-corporate-wordpress-theme/','skt-strong');
define('SKT_LIVE_DEMO','http://sktthemesdemo.net/strong/','skt-strong');
define('SKT_THEMES','https://www.sktthemes.org/themes/','skt-strong');

if ( ! function_exists( 'skt_strong_credit' ) ) {
function skt_strong_credit(){
		return "<a href=".esc_url(SKT_CREDIT)." target='_blank'>SKT Strong Themes</a>";
}
}

function skt_strong_new_excerpt_length($length) {
    return 50;
}
add_filter('excerpt_length', 'skt_strong_new_excerpt_length');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template for about theme.
 */
require get_template_directory() . '/inc/about-themes.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

if ( ! function_exists( 'skt_strong_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since  SKT Strong 1.0
 */
function skt_strong_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

require_once get_template_directory() . '/customize-pro/example-1/class-customize.php';