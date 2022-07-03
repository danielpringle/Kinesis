<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <?php if (!function_exists('_wp_render_title_tag')) : ?>
        <title><?php wp_title('|', true, 'right'); ?></title>
    <?php endif; ?>

    <?php wp_head(); ?>

</head>
<?php
/**
 * Fires immediately after the `wp_body_open` action hook.
 *
 * @since 1.0.0
 */
do_action( 'nachalo_before' );
?>

<body <?php body_class(); ?> itemtype="https://schema.org/WebPage" itemscope="itemscope"  role="document" >

<?php wp_body_open(); ?>

<div id="site-container-id" class="site-container">
	
	<?php

	/**
	 * Fires immediately after the site container opening markup, before `nachalo_header` action hook.
	 *
	 * @since 1.0.0
	 */
	do_action( 'nachalo_before_header' );

	/**
	 * Fires to display the main header content.
	 *
	 * @since 1.0.2
	 */
	do_action( 'nachalo_header' );

	
	
	/**
	 * Fires immediately after the `nachalo_header` action hook, before the site inner opening markup.
	 *
	 * @since 1.0.0
	 */
	do_action( 'nachalo_after_header' );
	?>

	<div id="site-inner-id" class="site-inner <?php echo nachalo_container_attributes()['site-inner']; ?>">
		<div class="wrap <?php echo nachalo_container_attributes()['site-inner-wrap']; ?>">
		<?php
			/**
			 * Fires before the content, after the content sidebar wrap opening markup.
			 *
			 * @since 1.0.0
			 */
			do_action( 'nachalo_before_content' );
			?>
			<div class="content" id="content">
				<main id="nachalo-content" class="main-content" role="main">
				<?php
					/**
					 * Fires before the loop hook, after the main content opening markup.
					 *
					 * @since 1.0.0
					 */
					do_action( 'nachalo_before_loop' );
					?>






