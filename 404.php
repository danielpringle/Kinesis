<?php

get_header();
?>
  <section class="hero-banner">
    <div class="page-banner">
      <div class="container">
        <div class="page-banner-contents">
          <div class="fade-in-text">
            <div class="page-title">
             <h1 class="page-title"><?php esc_html_e( 'Page not found', 'nachalo' ); ?></h1>
            </div>
        </div>
      </div>
    </div>
  </section>

  <div class="container">
    <div class="body-content">

      <div class="content-404">

        <p>You've come to a page of the <?php echo get_bloginfo('name') ?> website that doesn't exist.</p>
        <p>If you entered a web address please check it was correct. Or maybe you followed a link to a page that we've removed.</p>
        <h2>Suggestions</h2>
        <p>To find what you're looking for you might try:</p>
        <ul>
          <li><a href="<?php echo site_url('/sitemap') ?>">Site Map</a></li>
          <li><a href="<?php echo site_url('/') ?>">Homepage</a></li>
        </ul>
        <p><a href="<?php echo site_url('/') ?>">Click here</a> to go back to the Homepage OR you will be automatically redirected to the homepage in: <span id="countdown">30</span> seconds.</p>

      </div>

    </div>
  </div>

<?php
get_footer();
