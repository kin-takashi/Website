<?php
/**
 * julie-two functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package julie-two
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function julie_two_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on julie-two, use a find and replace
		* to change 'julie-two' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'julie-two', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	// add_theme_support( 'automatic-feed-links' );

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
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'julie-two' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'julie_two_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'julie_two_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function julie_two_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'julie_two_content_width', 640 );
}
add_action( 'after_setup_theme', 'julie_two_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function julie_two_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'julie-two' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'julie-two' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'julie_two_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function julie_two_scripts() {

	// wp_enqueue_style('bootstrap-style', "https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css", array(), _S_VERSION );

	// wp_style_add_data( 'bootstrap', array( 'integrity', 'crossorigin' ) , array( 'sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T', 'anonymous' ) );

	wp_enqueue_style( 'julie-two-style', get_stylesheet_uri(), array(), _S_VERSION );
	// wp_style_add_data( 'julie-two-style', 'rtl', 'replace' );

	// wp_enqueue_script( 'julie-two-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'julie_two_scripts' );

// function add_style_attributes( $html, $handle ) {

// 	if ( 'bootstrap-style' === $handle ) {
// 			return str_replace( "media='all'", "media='all' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'", $html );
// 	}

// 	return $html;
// }
// add_filter( 'style_loader_tag', 'add_style_attributes', 10, 2 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Config theme
 */
require get_template_directory() . '/inc/config-theme.php';

/**
 * Config posttype
 */
require get_template_directory() . '/inc/post-type/product.php';
// require get_template_directory() . '/inc/post-type/news.php';
