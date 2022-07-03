<?php
/**
 * Displays header site branding
 *
 */

$blog_info       = get_bloginfo( 'name' );
$description     = get_bloginfo( 'description', 'display' );
$show_title      = ( true === get_theme_mod( 'display_title_and_tagline', true ) );
$header_class    = $show_title ? 'site-title' : 'screen-reader-text';
$custom_logo_id  = get_theme_mod( 'custom_logo' );
$logo 			 = wp_get_attachment_image_src( $custom_logo_id , 'full' );
$parent_logo_url = get_theme_file_uri('/images/header-logo.png');
?>
<div class="site-branding">
	<?php
		if ( has_custom_logo() ) {
				if ( ! is_front_page() && ! is_home() ) {
					echo '<div class="site-logo"><a href="' . esc_url( home_url( '/' ) ) . '"><img src="' . esc_url( $logo[0] ) . '" title="' . get_bloginfo( 'name' ) . ' - Link to Homepage"  alt="' . get_bloginfo( 'name' ) . '"></a></div>';
			
				} else {
					echo '<div class="site-logo"><img itemprop="logo" src="' . esc_url( $logo[0] ) . '" title="' . get_bloginfo( 'name' ) . ' - Link to Homepage"  alt="' . get_bloginfo( 'name' ) . '"></div>';
				}
		} 

		// if (is_child_theme() === false ) {
		// 	if ( ! is_front_page() && ! is_home() ) {
		// 		echo '<div class="site-logo"><a href="' . esc_url( home_url( '/' ) ) . '"><img src="' . esc_url( $parent_logo_url ) . '" title="' . get_bloginfo( 'name' ) . ' - Link to Homepage"  alt="' . get_bloginfo( 'name' ) . '"></a></div>';

		// 		} else {
		// 		echo '<div class="site-logo"><img itemprop="logo" src="' . esc_url( $parent_logo_url ) . '" title="' . get_bloginfo( 'name' ) . ' - Link to Homepage"  alt="' . get_bloginfo( 'name' ) . '"></div>';
		// 		}
		// }
	?>
	<div class="title-area">
		<?php if ( $blog_info ) : ?>
			<?php if ( is_front_page() && ! is_paged() ) : ?>
				<h1 class="<?php echo esc_attr( $header_class ); ?>" itemprop="headline"><?php echo esc_html( $blog_info ); ?></h1>
			<?php elseif ( is_front_page() && ! is_home() ) : ?>
				<h1 class="<?php echo esc_attr( $header_class ); ?>" itemprop="headline"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $blog_info ); ?></a></h1>
			<?php else : ?>
				<p class="<?php echo esc_attr( $header_class ); ?> " itemprop="headline"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $blog_info ); ?></a></p>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( $description && true === get_theme_mod( 'display_title_and_tagline', true ) ) : ?>
			<p class="site-description" itemprop="description">
				<?php echo $description; // phpcs:ignore WordPress.Security.EscapeOutput ?>
			</p>
		<?php endif; ?>
	</div>
</div>







