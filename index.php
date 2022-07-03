<?php

get_header(); ?>
<!-- Main content
================================================== -->

<main id="main-content">
    <?php get_template_part( '/inc/hero-banner'); ?>
  <div class="body-content">
    <div class="general-content">
      <?php
      while (have_posts()) {
        the_post(); ?>
        <div class="body-type">
          <div class="body-type-title">
            <a href="<?php the_permalink(); ?>">
              <h4><?php the_title(); ?></h4>
            </a>
            <div class="meta-box">
              <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('j F, Y'); ?> in <?php echo get_the_category_list(', '); ?></p>
            </div>
            <div class="post">
              <?php the_excerpt(); ?>
              <a href="<?php the_permalink(); ?>">
                <p>Read more</p>
              </a>
            </div>
          </div>
        </div>
        <hr>
      <?php }
      echo paginate_links();
      ?>
    </div>
  </div>
</main>
<?php get_footer();

?>