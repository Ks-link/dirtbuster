<?php
/**
 * School Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package School_Theme
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
function school_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on School Theme, use a find and replace
		* to change 'school-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'school-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );
	add_theme_support( 'align-wide' );
	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// Our custom img crop sizes for the school site!
	add_image_size( '300x200', 300, 200, true );
	add_image_size( '200x300', 200, 300, true );


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'school-theme' ),
			'footer-menu' => __( 'Footer Menu','school-theme' )
		)
	);
	// add_theme_support('custom-logo');
	

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
			'school_theme_custom_background_args',
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
add_action( 'after_setup_theme', 'school_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function school_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'school_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'school_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function school_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'school-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'school-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'school_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function school_theme_scripts() {
	// google fonts go here
	wp_enqueue_style(
		'school-googlefonts', // unique handle
		'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap', // url to css file (oswald and open sans fonts)
		array(), // dependancy array
		null // version num, for google fonts always set to null
	);


	wp_enqueue_style( 'school-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'school-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'school-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'school_theme_scripts' );
function add_aos_library() {
	// if (is_home()){
	// 	wp_enqueue_style( 'aos.css', get_stylesheet_uri().'/aos.css', array(), "2.3.1", true );
	// 	wp_enqueue_script( 'aos.js', get_stylesheet_uri().'/js/aos.js', array(),"2.3.1", true );
	// 	wp_add_inline_script('aos-js', 'AOS.init();');
	// 	print_r("hel");
	// }
	if (is_home()) {
		wp_enqueue_style( 
			'aos-css', 
			get_stylesheet_directory_uri(). '/aos.css',
			 array(), 
			'2.3.1',);
		
		wp_enqueue_script( 
			'aos-js', 
			get_stylesheet_directory_uri().'/js/aos.js', 
			array(), 
			'2.3.1', 
			true );
	
		wp_add_inline_script( 'aos-js', 'AOS.init();' );
	}
}
add_action( 'wp_enqueue_scripts', 'add_aos_library' );
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
 * Custom post types and taxonomies.
 */
require get_template_directory() . '/inc/cpt-taxonomy.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


// school theme filters and hooks go here
// following code pulled from https://wordpress.stackexchange.com/questions/167513/how-to-hook-into-the-cpts-title-placeholder
function change_placeholder_text_enter_title_here( $title, $post ) {
    if ( 'school-student' == $post->post_type ) {
        $title = 'Add Student Name';
    }
	if ( 'school-staff' == $post->post_type ) {
        $title = 'Add Staff Name';
    }
    return $title;
}
add_filter( 'enter_title_here', 'change_placeholder_text_enter_title_here', 10, 2 );


// rebuild the titles for archives
// Return an alternate title, without prefix, for every type used in the get_the_archive_title().
// code pulled from https://wordpress.stackexchange.com/questions/175884/how-to-customize-the-archive-title
function school_change_archive_title_structure( $title ) {
	if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_year() ) {
        $title = get_the_date( _x( 'Y', 'yearly archives date format' ) );
    } elseif ( is_month() ) {
        $title = get_the_date( _x( 'F Y', 'monthly archives date format' ) );
    } elseif ( is_day() ) {
        $title = get_the_date( _x( 'F j, Y', 'daily archives date format' ) );
    } elseif ( is_tax( 'post_format' ) ) {
        if ( is_tax( 'post_format', 'post-format-aside' ) ) {
            $title = _x( 'Asides', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
            $title = _x( 'Galleries', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
            $title = _x( 'Images', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
            $title = _x( 'Videos', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
            $title = _x( 'Quotes', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
            $title = _x( 'Links', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
            $title = _x( 'Statuses', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
            $title = _x( 'Audio', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
            $title = _x( 'Chats', 'post format archive title' );
        }
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    } else {
        $title = __( 'Archives' );
    }
    return $title;
}
add_filter('get_the_archive_title', 'school_change_archive_title_structure' );

// change excerpt length to 25 words
function school_excerpt_length( $length ) {
	// target students page
	if ( is_post_type_archive( 'school-student' ) ) {
		return 25;
    } else {
        return $length;
    }
}
add_filter( 'excerpt_length', 'school_excerpt_length', 999 );

// change the ending of the excerpt
function school_excerpt_more( $more ) {
	// target students page
	if ( is_post_type_archive( 'school-student' ) ) {
		$more = '<br><a class="read-more" href="' . esc_url( get_permalink() ) . '">'. __('Read more about the student...', 'school') .'</a>';
		return $more;
    }
}
add_filter( 'excerpt_more', 'school_excerpt_more' );
