<?php
/**
 * ZuGGy Reality functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ZuGGy_Reality
 */

if ( ! function_exists( 'zuggy_reality_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function zuggy_reality_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ZuGGy Reality, use a find and replace
		 * to change 'zuggy-reality' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'zuggy-reality', get_template_directory() . '/languages' );

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
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'zuggy-reality' ),
			'primary' => __('Custom menu'),
			'footer'  => __('Custom Footer'),
		) );
		register_nav_menus( array(
			'header' => esc_html__( 'Header', 'zuggy-reality' ),
			'test-menu' => esc_html__( 'Tester', 'zuggy-reality' )
		) );
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'zuggy_reality_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'zuggy_reality_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function zuggy_reality_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'zuggy_reality_content_width', 640 );
}
add_action( 'after_setup_theme', 'zuggy_reality_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function zuggy_reality_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog', 'zuggy-reality' ),
		'id'            => 'blog-sidebar',
		'description'   => esc_html__( 'Sidebar for the blogs page, main sidebar', 'zuggy-reality' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
		register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'zuggy-reality' ),
		'id'            => 'footer-sidebar',
		'description'   => esc_html__( 'Sidebar for the footer', 'zuggy-reality' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
		register_sidebar( array(
		'name'          => esc_html__( 'Home', 'zuggy-reality' ),
		'id'            => 'home-sidebar',
		'description'   => esc_html__( 'Sidebar for the blogs page, main sidebar', 'zuggy-reality' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

		register_sidebar( array(
		'name'          => esc_html__( 'Header', 'zuggy-reality' ),
		'id'            => 'header-sidebar',
		'description'   => esc_html__( 'Sidebar for header', 'zuggy-reality' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Books', 'zuggy-reality' ),
		'id'            => 'books-sidebar',
		'description'   => esc_html__( 'This is the sidebar for the books page.', 'zuggy-reality' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Trailer', 'zuggy-reality' ),
		'id'            => 'trailers-sidebar',
		'description'   => esc_html__( 'Sidebar for trailers page', 'zuggy-reality' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'zuggy_reality_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function zuggy_reality_scripts() {
	wp_enqueue_style( 'zuggy-reality-style', get_stylesheet_uri() );

	wp_enqueue_script( 'zuggy-reality-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'zuggy-reality-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'zuggy_reality_scripts' );


/*CUSTOM Functions*/

function wpbeginner_remove_version() {
return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');

/*SET 'post-thumbnail' SIZE*/


add_image_size( 'custom-size', 450, 200, true);

add_image_size('custom-size-2', 600, 300, false);

add_image_size('single-page', 1200, 600, true);

/**
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function custom_read_more( $more ) {
    return sprintf( '<a class="read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( 'Read More', 'textdomain' )
    );
}
add_filter( 'excerpt_more', 'custom_read_more' );



/* Load Custom CSS stylesheets */

wp_enqueue_style('custom-stylesheet', get_stylesheet_directory_uri().'/css/styles.css');

wp_enqueue_style('custom-stylesheet-2', get_stylesheet_directory_uri().'/css/header.css');

wp_enqueue_style('custom-stylesheet-3', get_stylesheet_directory_uri().'/css/footer.css');





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

