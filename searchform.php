<?php
/**
 * The template for displaying the search form.
 *
 * @package _s
 */

// Make sure our search forms have unique IDs in the event more than 1 is on a page.
$random_identifier = wp_rand();
?>

<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="search-field-<?php echo esc_attr( $random_identifier ); ?>">
		<span class="screen-reader-text"><?php esc_html_e( 'To search this site, enter a search term', '_s' ); ?></span>
		<input class="search-term"  id="search-term" type="text" name="s" value="<?php echo get_search_query(); ?>" aria-required="false" autocomplete="off" placeholder="<?php echo esc_attr_e( 'Looking for...', 'nachalo' ); ?>" />
	</label>
</form>

