<?php
/**
 * Wrapper for the body start.
 * Allows for override and keeps things clean
 */

?>

<body itemtype="https://schema.org/WebPage" itemscope="itemscope"  role="document" <?php body_class(); ?>>
<?php echo get_option( 'options_gtm_scripts' ); ?>
<!--site wrap-->
<div class="wrap">
    <!-- boxed or wide layout set container here -->
