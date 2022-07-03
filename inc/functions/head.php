<?php

/**
 * Return favicon URL.
 *
 *
 * @return string Path to favicon.
 */
function nachalo_get_favicon_url() {

	/**
	 * Filter to allow child theme to short-circuit this function.
	 *
	 * @since 1.1.2
	 *
	 * @param bool $favicon `false`.
	 */
	$pre = apply_filters( 'nachalo_pre_load_favicon', false );

	if ( false !== $pre ) {
		$favicon = $pre;
	} elseif ( file_exists( CHILD_DIR . '/images/favicon.ico' ) ) {
		$favicon = CHILD_URL . '/images/favicon.ico';
	} elseif ( file_exists( CHILD_DIR . '/images/favicon.gif' ) ) {
		$favicon = CHILD_URL . '/images/favicon.gif';
	} elseif ( file_exists( CHILD_DIR . '/images/favicon.png' ) ) {
		$favicon = CHILD_URL . '/images/favicon.png';
	} elseif ( file_exists( CHILD_DIR . '/images/favicon.jpg' ) ) {
		$favicon = CHILD_URL . '/images/favicon.jpg';
	} else {
		$favicon = get_template_directory_uri() . '/images/favicon.ico';
	}
    
	/**
	 * Filter the favicon URL.
	 *
	 * @since 1.0.0
	 *
	 * @param string $favicon Favicon URL.
	 */
	$favicon = apply_filters( 'nachalo_favicon_url', $favicon );

    

	return trim( $favicon );


}


//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
//add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info

function nachalo_insert_opengraph_in_head() {
    global $post;
    global $wp;
    ?>
    <meta property="site_name" content="<?php echo get_bloginfo( 'name' ); ?>" />
    <meta property="og:title" content="<?php echo get_the_title($post->ID); ?>" />
    <meta property="og:description" content="<?php echo get_bloginfo('description');?>" />
    <meta property="og:type" content="website" />

    <meta property="og:url" content="<?php echo home_url( $wp->request ); ?>" />

    <?php
    if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
        ?>
        <meta property="og:image" content="<?php echo get_theme_file_uri('/images/og-logo.jpg') ?>" />
        <?php
    }else{
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
        ?>
        <meta property="og:image" content="<?php echo esc_attr( $thumbnail_src[0] ) ?>" />
        <?php

    }

}
add_action( 'wp_head', 'nachalo_insert_opengraph_in_head', 5 );



function nachalo_skip_links(){
	?>

	<a class="skip-link screen-reader-text" id="skip"  href="#content"><?php esc_html_e( 'Skip to content', 'twentytwentyone' ); ?></a>

	<!-- <div id="skip" class="skip-link screen-reader-text sr-only sr-only-focusable">
    	<a href="#main-content">Skip to main content</a>
  	</div> -->
  <?php
}
add_action( 'nachalo_before_header', 'nachalo_skip_links', 5 );