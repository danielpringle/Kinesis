<?php
function nachalo_setup() {


    // Define Theme Info Constants.
	// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
	define( 'PARENT_THEME_NAME', 'Nachalo' );
	define( 'PARENT_THEME_VERSION', '1.0.0' );
	// define( 'PARENT_THEME_BRANCH', '3.3' );
	// define( 'PARENT_DB_VERSION', '3301' );
	// define( 'PARENT_THEME_RELEASE_DATE', date_i18n( 'F j, Y', strtotime( '05 August 2021' ) ) );

	// Define Parent and Child Directory Location and URL Constants.
	define( 'PARENT_DIR', get_template_directory() );
	define( 'CHILD_DIR', get_stylesheet_directory() );
	define( 'PARENT_URL', get_template_directory_uri() );
	define( 'CHILD_URL', get_stylesheet_directory_uri() );
	// phpcs:enable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound

	// Define URL Location Constants.
	$inc_url = PARENT_URL . '/inc';


		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'nachalo', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );




    // Theme supports
		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );

				/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/*
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );


		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );


    // Add support for editor styles.
    add_theme_support('editor-styles');


    // Enqueue editor styles.
    //add_editor_style('dist/css/style-editor.css');

    // Custom image sizes
    add_image_size('pageBanner', 1572, 668, true);


        register_nav_menus(
            array(
                'primary' => esc_html__( 'Primary menu', 'twentytwentyone' ),
                'footer'  => __( 'Secondary menu', 'twentytwentyone' ),
            )
        );

	
}
add_action( 'after_setup_theme', 'nachalo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global int $content_width Content width.
 *
 * @return void
 */
function nachalo_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'nachalo_content_width', 750 );
}
add_action( 'after_setup_theme', 'nachalo_content_width', 0 );


/**
 * Add No-JS Class.
 * If we're missing JavaScript support, the HTML element will have a no-js class.
 */
function nachalo_no_js_class() {

	?>
	<script>document.documentElement.className = document.documentElement.className.replace( 'no-js', 'js' );</script>
	<?php

}
add_action( 'wp_head', 'nachalo_no_js_class' );


function nachalo_container_attributes(){

	// Use this function to add container classes as needed to the theme

	$args = array(
		'header'          => 'container',
		'site-inner'      => '',
		'site-inner-wrap' => 'container',
		'footer'          => 'container',
		'nav-wrap'          => '',
		'footer-nav-wrap'          => 'container',

	);

	if(has_filter('nachalo_container_attributes')) {
		$args = apply_filters('nachalo_container_attributes', $args);
	}

return $args;
}
nachalo_container_attributes();
