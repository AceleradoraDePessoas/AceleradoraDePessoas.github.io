<?php
/**
 * sensible-wp functions and definitions
 *
 * @package sensible-wp 
 */

/**
 * Set the content width based on the theme's design and stylesheet. 
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'sensiblewp_setup' ) ) : 
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails. 
 */
function sensiblewp_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on sensiblewpwp, use a find and replace
	 * to change 'sensible-wp' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'sensible-wp', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'sensible-wp-home-blog', 400, 250, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'sensible-wp' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sensiblewp_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // sensiblewp_setup
add_action( 'after_setup_theme', 'sensiblewp_setup' ); 

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function sensiblewp_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'sensible-wp' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Home Widget', 'sensible-wp' ),
		'id'            => 'home-widget',
		'description'   => __( 'The widget area for your home page.', 'sensible-wp' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',  
		'before_title'  => '<h6>',
		'after_title'   => '</h6>', 
	) );
	
	//Register the sidebar widgets   
	register_widget( 'sensiblewp_Video_Widget' ); 
	register_widget( 'sensiblewp_Contact_Info' ); 
	
}
add_action( 'widgets_init', 'sensiblewp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sensiblewp_scripts() {
	wp_enqueue_style( 'sensiblewp-style', get_stylesheet_uri() ); 
	
	$headings_font = esc_html(get_theme_mod('headings_fonts'));
	$body_font = esc_html(get_theme_mod('body_fonts'));
	
	if( $headings_font ) {
		wp_enqueue_style( 'sensiblewp-headings-fonts', '//fonts.googleapis.com/css?family='. $headings_font );	
	} else {
		wp_enqueue_style( 'sensiblewp-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700');   
	}	
	if( $body_font ) {
		wp_enqueue_style( 'sensiblewp-body-fonts', '//fonts.googleapis.com/css?family='. $body_font ); 	
	} else {
		wp_enqueue_style( 'sensiblewp-open-body', '//fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700');  
	}
	
	wp_enqueue_style( 'sensiblewp-font-awesome', get_template_directory_uri() . '/fonts/font-awesome.css' );
	wp_enqueue_style( 'sensiblewp-menu-css', get_template_directory_uri() . '/css/jPushMenu.css' );
	
	if ( get_theme_mod('sensiblewp_animate') != 1 ) { 
		
		wp_enqueue_script( 'sensiblewp-wow', get_template_directory_uri() . '/js/wow.js', array('jquery'), true );
		wp_enqueue_style( 'sensiblewp-animate-css', get_stylesheet_directory_uri() . '/css/animate.css', array() );
		wp_enqueue_script( 'sensiblewp-wow-init', get_template_directory_uri() .  '/js/wow-init.js', array( 'jquery' ), true );
	}
	
	if ( is_admin() ) { 
    wp_enqueue_style( 'sensiblewp-control', get_template_directory_uri() . '/js/sensible_control.js', array(), false, true );   
	} 

	wp_enqueue_script( 'sensiblewp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'sensiblewp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'sensiblewp-parallax', get_template_directory_uri() . '/js/parallax.js', array('jquery'), false, false );
	wp_enqueue_script( 'sensiblewp-menu', get_template_directory_uri() . '/js/jPushMenu.js', array('jquery'), false, true );
	wp_enqueue_script( 'sensiblewp-placeholder', get_template_directory_uri() . '/js/jquery.placeholder.js', array('jquery'), false, true); 
 	wp_enqueue_script( 'sensiblewp-placeholdertext', get_template_directory_uri() . '/js/placeholdertext.js', array('jquery'), false, true);

	wp_enqueue_script( 'sensiblewp-scripts', get_template_directory_uri() . '/js/sensible.scripts.js', array(), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sensiblewp_scripts' );

/**
 * Load html5shiv
 */
function sensiblewp_html5shiv() {
    echo '<!--[if lt IE 9]>' . "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5shiv.js' ) . '"></script>' . "\n";
    echo '<![endif]-->' . "\n";
}
add_action( 'wp_head', 'sensiblewp_html5shiv' );

/**
 * Change the excerpt length
 */
function sensiblewp_excerpt_length( $length ) {
	
	$excerpt = esc_attr( get_theme_mod('exc_length', '30'));
	return $excerpt; 

}

add_filter( 'excerpt_length', 'sensiblewp_excerpt_length', 999 );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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

/**
 * Include additional custom admin panel features. 
 */
require get_template_directory() . '/panel/functions-admin.php';
require get_template_directory() . '/panel/sensiblewp-admin_page.php'; 

/**
 * Google Fonts  
 */
require get_template_directory() . '/inc/gfonts.php';  

/**
 * register your custom widgets
 */ 
require get_template_directory() . "/widgets/contact-info.php"; 
require get_template_directory() . "/widgets/video-widget.php";

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';