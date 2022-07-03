<?php


/**
 * Standard loop, meant to be executed without modification in most circumstances where content needs to be displayed.
 *
 * It outputs basic wrapping HTML, but uses hooks to do most of its content output like title, content, post information
 * and comments.
 *
 * The action hooks called are:
 *
 *  - `nachalo_before_entry`
 *  - `nachalo_entry_header`
 *  - `nachalo_before_entry_content`
 *  - `nachalo_entry_content`
 *  - `nachalo_after_entry_content`
 *  - `nachalo_entry_footer`
 *  - `nachalo_after_endwhile`
 *  - `nachalo_loop_else` (only if no posts were found)
 *
 * @since 1.1.0
 *
 * @return void Return early after legacy loop if not supporting HTML5.
 */
function nachalo_standard_loop() {

	if ( have_posts() ) {

		/**
		 * Fires inside the standard loop, before the while() block.
		 *
		 * @since 2.1.0
		 */
		do_action( 'nachalo_before_while' );

		while ( have_posts() ) {

			the_post();

			/**
			 * Fires inside the standard loop, before the entry opening markup.
			 *
			 * @since 2.0.0
			 */
			do_action( 'nachalo_before_entry' );

			/**
			 * Fires inside the standard loop, to display the entry header.
			 *
			 * @since 2.0.0
			 */
			do_action( 'nachalo_entry_header' );

			/**
			 * Fires inside the standard loop, after the entry header action hook, before the entry content.
			 * opening markup.
			 *
			 * @since 2.0.0
			 */
			do_action( 'nachalo_before_entry_content' );

			/**
			 * Fires inside the standard loop, inside the entry content markup.
			 *
			 * @since 2.0.0
			 */
			do_action( 'nachalo_entry_content' );

			/**
			 * Fires inside the standard loop, before the entry footer action hook, after the entry content.
			 * opening markup.
			 *
			 * @since 2.0.0
			 */
			do_action( 'nachalo_after_entry_content' );

			/**
			 * Fires inside the standard loop, to display the entry footer.
			 *
			 * @since 2.0.0
			 */
			do_action( 'nachalo_entry_footer' );


			/**
			 * Fires inside the standard loop, after the entry closing markup.
			 *
			 * @since 2.0.0
			 */
			do_action( 'nachalo_after_entry' );

		} // End of one post.

		/**
		 * Fires inside the standard loop, after the while() block.
		 *
		 * @since 1.0.0
		 */
		do_action( 'nachalo_after_endwhile' );

	} 

}

