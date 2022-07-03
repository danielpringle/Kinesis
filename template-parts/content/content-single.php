<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> aria-label="<?php the_title(); ?>" itemscope="" itemtype="https://schema.org/CreativeWork">

	<header class="entry-header">
	<h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1> 
	<?php the_post_thumbnail(); ?>
	</header><!-- .entry-header -->

	<div class="entry-content" itemprop="text">
		<?php
		the_content();
		?>
	</div><!-- .entry-content -->

</article>
