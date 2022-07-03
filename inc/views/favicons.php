<?php

/**
 * FAVICONS
 */
?>
	<?php if (get_option('invd_favicon_upload') != '') { ?>
        <link rel="shortcut icon" href="<?php echo get_option('invd_favicon_upload'); ?>"/>
	<?php } if (get_option('invd_iphone_favicon_upload') != '') { ?>
       <link href="<?php echo get_option('invd_iphone_favicon_upload'); ?>" rel="apple-touch-icon" />
	<?php } if (get_option('invd_iphone_favicon_upload') != '') { ?>
       <link href="<?php echo get_option('invd_iphone_favicon_upload'); ?>" rel="apple-touch-icon" sizes="120x120" />
	<?php } if (get_option('invd_ipad_favicon_upload') != '') { ?>
       <link href="<?php echo get_option('invd_ipad_favicon_upload'); ?>" rel="apple-touch-icon" sizes="152x152" />
	<?php } ?>

        <!-- Website name for pins -->
        <meta name="application-name" content="<?php bloginfo('name'); ?>">
        <!-- Win8 tile  -->
	<?php if (get_option('invd_tileimage_upload') != '') { ?>
        <meta name="msapplication-TileImage" content="<?php echo get_option('invd_tileimage_upload') ?>">
	<?php } ?>
        <?php if (get_option('invd_tilecolor') != '') { ?>
        <meta name="msapplication-TileColor" content="<?php echo get_option('invd_tilecolor') ?>"/>
        <?php } ?>
        <!-- IE11 tiles -->
	<?php if (get_option('invd_ms_tile_small_upload') != '') { ?>
       <meta name="msapplication-square70x70logo" content="<?php echo get_option('invd_ms_tile_small_upload') ?>"/>
	<?php } if (get_option('invd_ms_tile_medium_upload') != '') { ?>
       <meta name="msapplication-square150x150logo" content="<?php echo get_option('invd_ms_tile_medium_upload') ?>"/>
	<?php } if (get_option('invd_ms_tile_wide_upload') != '') { ?>
       <meta name="msapplication-wide310x150logo" content="<?php echo get_option('invd_ms_tile_wide_upload') ?>"/>
	<?php } if (get_option('invd_ms_tile_large_upload') != '') { ?>
       <meta name="msapplication-square310x310logo" content="<?php echo get_option('invd_ms_tile_large_upload') ?>"/>
	<?php } ?>
  