<?php
/**
 * Theme Asset management
 */




 // Define and call CSS/JS files.


function invd_enqueue()
{
    $theme = get_option('stylesheet');
    if ( $theme && $theme=='invd' ){
        wp_enqueue_style('invd_base_styles', get_template_directory_uri() . '/dist/css/style.css' );
    }
    
   //Global JS Files 
   wp_enqueue_script('invd_main_scripts', get_template_directory_uri() . '/src/js/top-of-page.js', ['jquery'], '1.0.16', true);

   wp_enqueue_script('mmconfig', get_template_directory_uri() . '/src/js/menu-config.js',array(), '1.0.16', true);



   wp_enqueue_style( 'dashicons' );

}
add_action('wp_enqueue_scripts', 'invd_enqueue');


