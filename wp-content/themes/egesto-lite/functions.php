<?php
/**
 * Themes functions and definitions
 *
 * @package Egesto Lite
 */
function egesto_setup() {
	global $content_width;
		if ( ! isset( $content_width ) ){
      		$content_width = 1200;
		}
	load_theme_textdomain( 'egesto-lite', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo');
	add_theme_support( 'customize-selective-refresh-widgets' );
	register_nav_menus( array(
			'main-menu' => esc_html__( 'Primary Menu', 'egesto-lite' ),
			'front-menu' => esc_html__( 'Front Menu', 'egesto-lite' ),
			'social' 	=> esc_html__( 'Social', 'egesto-lite' )
		) );
	add_theme_support( 'custom-background', array(
		'default-color' => '212121',
	) );
	add_theme_support( 'post-thumbnails' );
	add_image_size('egesto-homeimg', 2000, 700, true);
	add_image_size('egesto-blogthumb', 300, 340, true);
}
add_action( 'after_setup_theme', 'egesto_setup' );

/**
 * Register widget areas.
 *
 */
function egesto_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'egesto-lite' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets', 'egesto-lite' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'egesto_widgets_init' );

/**
 * Register Lato Google font for Melograno Lite.
 *
 * @return string
 */
function egesto_lato_font_url() {
	$lato_font_url = '';

	/* translators: If there are characters in your language that are not supported
	   by this font, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'egesto-lite' ) ) {

		$lato_font_url = add_query_arg( 'family', urlencode( 'Lato:300,400,700,900' ), "https://fonts.googleapis.com/css" );
	}

	return $lato_font_url;
}


/**
 * Including theme scrips and styles.
 */
function egesto_scripts_styles() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	if (!is_admin()) {
		wp_enqueue_script( 'egesto-menu', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'egesto-mobile-menu', get_template_directory_uri() . '/js/reaktion.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'egesto-responsive-videos', get_template_directory_uri() . '/js/responsive-videos.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'egesto-animate', get_template_directory_uri() . '/js/css3-animate-it.js', array( 'jquery' ), '', true );
		wp_enqueue_style( 'egesto-lato', egesto_lato_font_url(), array(), null );
		wp_enqueue_style( 'animate', get_template_directory_uri() . '/animate.css', array(), '1.0' ); 
		wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );
		wp_enqueue_style( 'egesto-style', get_stylesheet_uri());
	}
}
add_action( 'wp_enqueue_scripts', 'egesto_scripts_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';