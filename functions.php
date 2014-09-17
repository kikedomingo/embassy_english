<?php 

/***************************/
/* ENQUEUE STYLES AND SCRIPTS */
function wpbootstrap_scripts_with_jquery()
{
	// Register the script like this for a theme:
	wp_register_script( 'custom-script', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ) );
	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'custom-script' );

	// Register the script like this for a theme:
	wp_register_script( 'cookies-script', get_template_directory_uri() . '/js/AcceptCookies.js', array( 'jquery' ) );
	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'cookies-script' );
	
}
add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );
/***************************/

/***************************/
/* Register Sidebar */
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'before_widget' => '<div class="card widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3><hr>',
	));
/***************************/

/***************************/
// Let's create the menus
function register_menus() {
	$locations = array(
		'header-menu' => __( 'Main menu', 'text_domain' ),
		'cta-menu' => __( 'CTA Menu', 'text_domain' ),
		'footer-menu-left' => __( 'Footer Menu LEFT', 'text_domain' ),
		'footer-menu-right' => __( 'Footer Menu RIGHT', 'text_domain' ),
		'legal-menu' => __( 'Legal Menu', 'text_domain' ),
	);
	register_nav_menus( $locations );
}

// Hook into the 'init' action
add_action( 'init', 'register_menus' );
/***************************/


/***************************/
// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
	return '... <a class="moretag" href="'. get_permalink($post->ID) . '">Read more...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
/***************************/


/***************************/
// Excerpt lenght
function custom_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
/***************************/


/***************************/
// Register Theme Custom Header
function custom_theme_header()  {

	// Add theme support for Custom Header
	$header_args = array(
		'default-image'          => get_template_directory_uri() . '/images/default_header.jpg',
		'width'                  => 1170,
		'height'                 => 350,
		'flex-width'             => false,
		'flex-height'            => false,
		'random-default'         => false,
		'header-text'            => false,
		'default-text-color'     => '',
		'uploads'                => true,
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $header_args );
}

// Hook into the 'after_setup_theme' action
add_action( 'after_setup_theme', 'custom_theme_header' );
/***************************/

/***************************/
// Register Theme Post Thumbnail
function custom_theme_postthumbnail()  {
	global $wp_version;

	// Add theme support for Featured Images
	add_theme_support( 'post-thumbnails' );	
}

	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'homepage-thumb' );
	    set_post_thumbnail_size( 265, 265, true ); // default Post Thumbnail dimensions   
	    add_theme_support( 'single-full' );
	    set_post_thumbnail_size( 730, 400, true );   
	    add_theme_support( 'mini-thumb' );
	    set_post_thumbnail_size( 64, 64, true ); 
	}

	if ( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'homepage-thumb',265, 265, true ); //(cropped)
		add_image_size( 'single-full',730, 400, true ); //(cropped)
		add_image_size( 'mini-thumb',64, 64, true ); //(cropped)
	}

// Hook into the 'after_setup_theme' action
add_action( 'after_setup_theme', 'custom_theme_postthumbnail' );
/***************************/

/***************************/
// Creating admin menu
require get_template_directory() . '/inc/admin.php';
/***************************/

/***************************/
// Modifying default widgets output
require get_template_directory() . '/inc/widgets.php';
/***************************/

/***************************/
// Exclude pages from search
function SearchFilter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}
add_filter('pre_get_posts','SearchFilter');
/***************************/





?>