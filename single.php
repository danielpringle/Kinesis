<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

get_header();

?>

			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();

					get_template_part( 'template-parts/content/content-single' );
	
				}

				// If comments are open or there is at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

				// Link to next post.
			} ?>

<?php get_footer(); ?>


