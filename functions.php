<?php
/**
 * Nachalo
 *
 */

/**
 * Calls the init.php file, but only if the child theme has not called it first.
 *
 * This method allows the child theme to load
 * the framework so it can use the framework
 * components immediately.
 */
require_once __DIR__ . '/inc/init.php';


require_once __DIR__ . '/inc/structure/header.php';
require_once __DIR__ . '/inc/structure/footer.php';
require_once __DIR__ . '/inc/structure/loop.php';
require_once __DIR__ . '/inc/structure/page.php';
require_once __DIR__ . '/inc/structure/nav.php';
require_once __DIR__ . '/inc/functions/head.php';
require_once __DIR__ . '/inc/functions/schema.php';
require_once __DIR__ . '/inc/core/enqueue.php';
require_once __DIR__ . '/inc/core/breadcrumbs.php';
require_once __DIR__ . '/inc/views/front-page.php';


// Customizer additions.
require get_template_directory() . '/inc/core/customizer.php';
new Twenty_Twenty_One_Customize();



wp_enqueue_style('theme-style', get_template_directory_uri() . '/css/style.css', null, date("Y-m-d-h:i-s"), 'all');

// Goolge Fonts
wp_enqueue_style('google-font-style', '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,600,700, 700i|Montserrat:300,400,400i,600,700,700i|Lato:300,300i,400,400i,700,700i');

