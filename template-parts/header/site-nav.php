<?php
/**
 * Displays the site navigation.
 *
 */

?>

<?php if ( has_nav_menu( 'primary' ) ) : ?>

	
	<nav id="menu" class="navigation primary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'twentytwentyone' ); ?>">
	<!-- <button class="menu-toggle dashicons-before dashicons-menu" aria-expanded="false" aria-pressed="false" id="nachalo-mobile-nav-primary">Menu</button> -->
	<a href="javascript:void(0);" class="icon menu-toggle dashicons-before dashicons-menu" onclick="myFunction()">MENU</a>
		<?php

		$defaults = array(
			'menu'                 => '',
			'container'            => 'div',
			'container_class'      => 'wrap',
			'container_id'         => '',
			'container_aria_label' => '',
			'menu_class'           => 'menu nachala-nav-menu',
			'menu_id'              => '',
			'echo'                 => true,
			'fallback_cb'          => 'false',
			'before'               => '',
			'after'                => '',
			'link_before'          => '',
			'link_after'           => '',
			'items_wrap'           => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
			'item_spacing'         => 'preserve',
			'depth'                => 3,
			'walker'               => '',
			'theme_location'       => 'primary',
		);

		//wp_nav_menu($defaults);

		wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'menu_class'      => 'menu nachala-nav-menu',
				'container_class' => 'wrap '. nachalo_container_attributes()['nav-wrap'],
				'container_id'    => 'menu-header-menu-container',
				'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
				'fallback_cb'     => false,
				'depth' => '3'
			)
		);
		?>
	</nav><!-- #site-navigation -->
<?php endif; ?>
