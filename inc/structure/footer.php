<?php

add_action( 'nachalo_footer', 'nachalo_footer_markup', 5 );
/**
 * Echo the opening div tag for the footer.
 *
 * Also optionally adds wrapping div opening tag.
 *
 * @since 1.2.0
 */
function nachalo_footer_markup() {
    ?> 
	<footer id="colophon" class="site-footer" role="contentinfo" itemscope="" itemtype="https://schema.org/WPFooter">
		<div class ="wrap <?php echo nachalo_container_attributes()['footer']; ?>"> 
    <?php
    /**
    *  Echo the contents of the footer 
    *
    * @since 1.0.0
    */
    do_action( 'nachalo_footer_contents' );

    ?> 
		</div>
	</footer><!-- #colophon -->
    <?php
}



add_action( 'nachalo_footer_contents', 'nachalo_do_footer' );
/**
 * Echo the contents of the footer including processed shortcodes.
 *
 * Applies `genesis_footer_creds_text` and `genesis_footer_output` filters.
 *
 * @since 3.0.0 Removed `[footer_backtotop]` shortcode and `genesis_footer_backtotop_text` filter.
 * @since 1.0.1
 */
function nachalo_do_footer() {

    if ( has_nav_menu( 'footer' ) ) : ?>
			<nav aria-label="<?php esc_attr_e( 'Secondary menu', 'twentytwentyone' ); ?>" class="footer-navigation" itemscope="" itemtype="https://schema.org/SiteNavigationElement">
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'menu_class'      => 'menu nachala-nav-menu',
							'container_class' => 'wrap '. nachalo_container_attributes()['footer-nav-wrap'],
							'container_id'    => 'menu-footer-menu-container',
							'items_wrap'      => '<ul id="footer-menu-list" class="%2$s">%3$s</ul>',
							'fallback_cb'     => false,
							'depth' => '1'
						)
					);
					?>
			</nav><!-- .footer-navigation -->
		<?php endif; ?>
		<div class="site-info">
			<div class="site-name">
				<?php if ( has_custom_logo() ) : ?>
					<!-- <div class="site-logo"><?php the_custom_logo(); ?></div> -->
				<?php else : ?>
					<?php if ( get_bloginfo( 'name' ) && get_theme_mod( 'display_title_and_tagline', true ) ) : ?>
						<?php if ( is_front_page() && ! is_paged() ) : ?>
							<?php bloginfo( 'name' ); ?>
						<?php else : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			</div><!-- .site-name -->
			<div class="powered-by">
				<?php
				printf(
					/* translators: %s: WordPress. */
					esc_html__( 'DELIVERED BY %s.', 'nachalo' ),
					'<a href="' . esc_url( __( 'https://danielpringle.co.uk/', 'nachalo' ) ) . '" target="_blank">Daniel Pringle</a>'
				);
				?>
			</div><!-- .powered-by -->

		</div><!-- .site-info -->
    <?php

}