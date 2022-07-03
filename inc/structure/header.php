<?php

add_action( 'wp_head', 'nachalo_load_favicon' );
/**
 * Echo favicon link.
 *
 * @since 1.0.0
 * @since 2.4.0 Logic moved to `genesis_get_favicon_url()`.
 *
 * @see genesis_get_favicon_url()
 *
 * @return void Return early if WP Site Icon is used.
 */
function nachalo_load_favicon() {

	// Use WP site icon, if available.
	if ( function_exists( 'has_site_icon' ) && has_site_icon() ) {
		return true;
	}

    if ( function_exists( 'has_site_icon' ) && ! has_site_icon() ) {

        $favicon = nachalo_get_favicon_url();

        if ( $favicon ) {
            echo '<link rel="icon" href="' . esc_url( $favicon ) . '" />' . "\n";
        }
    }
}





add_action( 'wp_head', 'nachalo_do_meta_pingback' );
/**
 * Adds the pingback meta tag to the head so that other sites can know how to send a pingback to our site.
 *
 * @since 1.3.0
 */
function nachalo_do_meta_pingback() {

	if ( 'open' === get_option( 'default_ping_status' ) ) {
		echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '" />' . "\n";
	}

}


add_action( 'wp_head', 'genesis_paged_rel' );
/**
 * Output rel links in the head to indicate previous and next pages in paginated archives and posts.
 *
 * @link https://webmasters.googleblog.com/2011/09/pagination-with-relnext-and-relprev.html
 *
 * @since 2.2.0
 *
 * @return void Return early if doing a Customizer preview.
 */
function genesis_paged_rel() {

	global $wp_query;

	$next = '';
	$prev = $next;

	$paged = (int) get_query_var( 'paged' );
	$page  = (int) get_query_var( 'page' );

	if ( ! is_singular() ) {
		$prev = $paged > 1 ? get_previous_posts_page_link() : $prev;
		$next = $paged < $wp_query->max_num_pages ? get_next_posts_page_link( $wp_query->max_num_pages ) : $next;
	} else {
		// No need for this on previews.
		if ( is_preview() ) {
			return;
		}

		$numpages = substr_count( $wp_query->post->post_content, '<!--nextpage-->' ) + 1;

		if ( $numpages && ! $page ) {
			$page = 1;
		}

		if ( $page > 1 ) {
			$prev = genesis_paged_post_url( $page - 1 );
		}

		if ( $page < $numpages ) {
			$next = genesis_paged_post_url( $page + 1 );
		}
	}

	if ( $prev ) {
		printf( '<link rel="prev" href="%s" />' . "\n", esc_url( $prev ) );
	}

	if ( $next ) {
		printf( '<link rel="next" href="%s" />' . "\n", esc_url( $next ) );
	}

}

//add_action( 'nachalo_header_content', 'nachalo_custom_logo', 5 );
/**
 * Echo the site title into the header.
 *
 * Depending on the SEO option set by the user, this will either be wrapped in an `h1` or `p` element.
 * The Site Title will be wrapped in a link to the homepage, if a custom logo is not in use.
 *
 * Applies the `genesis_seo_title` filter before echoing.
 *
 * @since 1.1.0
 */
function nachalo_custom_logo() {

    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
    $parent_logo_url = get_theme_file_uri('/images/header-logo.png');



    if ( has_custom_logo() ) {
        if ( ! is_front_page() && ! is_home() ) {
            echo '<div class="site-logo"><a href="' . esc_url( home_url( '/' ) ) . '"><img src="' . esc_url( $logo[0] ) . '" title="' . get_bloginfo( 'name' ) . ' - Link to Homepage"  alt="' . get_bloginfo( 'name' ) . '"></a></div>';
    
         } else {
            echo '<div class="site-logo"><img itemprop="logo" src="' . esc_url( $logo[0] ) . '" title="' . get_bloginfo( 'name' ) . ' - Link to Homepage"  alt="' . get_bloginfo( 'name' ) . '"></div>';
         }
    } 

    if (is_child_theme() === false ) {
        if ( ! is_front_page() && ! is_home() ) {
            echo '<div class="site-logo"><a href="' . esc_url( home_url( '/' ) ) . '"><img src="' . esc_url( $parent_logo_url ) . '" title="' . get_bloginfo( 'name' ) . ' - Link to Homepage"  alt="' . get_bloginfo( 'name' ) . '"></a></div>';
    
         } else {
            echo '<div class="site-logo"><img itemprop="logo" src="' . esc_url( $parent_logo_url ) . '" title="' . get_bloginfo( 'name' ) . ' - Link to Homepage"  alt="' . get_bloginfo( 'name' ) . '"></div>';
         }
    }
}

add_action( 'nachalo_header_content', 'nachalo_title_area', 10 );
/**
 * Echo the site description into the header.
 *
 * Depending on the SEO option set by the user, this will either be wrapped in an `h1` or `p` element.
 *
 * Applies the `genesis_seo_description` filter before echoing.
 *
 * @since 1.1.0
 */
function nachalo_title_area() {

	get_template_part( 'template-parts/header/site-branding' ); 
}

add_action( 'nachalo_header_content', 'nachalo_primary_nav', 15 );
function nachalo_primary_nav() {
	 get_template_part( 'template-parts/header/site-nav' ); 

}


add_action( 'nachalo_header', 'nachalo_header_markup');
/**
 * Echo the opening structural markup for the header.
 *
 * @since 1.2.0
 */
function nachalo_header_markup() {

	/**
	 * Displays the site header.
	 *
	 * @package WordPress
	 * @subpackage Twenty_Twenty_One
	 * @since Twenty Twenty-One 1.0
	 */
	
	$wrapper_classes  = 'site-header';
	$wrapper_classes .= has_custom_logo() ? ' has-logo' : '';
	$wrapper_classes .= ( true === get_theme_mod( 'display_title_and_tagline', true ) ) ? ' has-title-and-tagline' : '';
	$wrapper_classes .= has_nav_menu( 'primary' ) ? ' has-menu' : '';

	
	?>
	
	<header id="masthead" class="<?php echo esc_attr( $wrapper_classes ); ?>" role="banner" itemscope="" itemtype="https://schema.org/WPHeader">
		<div class="wrap <?php echo nachalo_container_attributes()['header']; ?>">
	
		<?php do_action( 'nachalo_header_content' ); ?>

	<?php

	?>
		</div><!-- .wrap -->
	</header><!-- #masthead -->
	<?php

}




