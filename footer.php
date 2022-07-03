<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

?>
				<?php
					/**
					 * Fires after the loop hook, before the main content closing markup.
					 *
					 * @since 1.0.0
					 */
					do_action( 'nachalo_after_loop' );
					?>
				</main><!-- #main -->
			</div><!-- #content -->
		</div><!-- wrap -->
	</div><!-- site-inner-->
	<?php
		/**
		 * Fires after the content, before the main content sidebar wrap closing markup.
		 *
		 * @since 1.0.0
		 */
		do_action( 'nachalo_after_content' );
	?>


<?php

/**
 * Fires immediately after the site inner closing markup, before `nachalo_footer` action hook.
 *
 * @since 1.0.0
 */
do_action( 'nachalo_before_footer' );


/**
 * Fires to display the main footer content.
 *
 * @since 1.0.1
 */
do_action( 'nachalo_footer' );

/**
 * Fires immediately after the `nachalo_footer` action hook, before the site container closing markup.
 *
 * @since 1.0.0
 */
do_action( 'nachalo_after_footer' );

?> 

</div><!-- #page -->

<?php 

/**
 * Fires immediately before wp_footer(), after the site container closing markup.
 *
 * @since 1.0.0
 */
do_action( 'nachalo_after' );

wp_footer(); // We need this for plugins.

?>

</body>
</html>


