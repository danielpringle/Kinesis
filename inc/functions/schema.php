<?php

add_filter( 'nachalo_attr_site-title', 'site_title' );

/**
 * Add schema markup attributes for site title element.
 *
 * @since 3.1.0
 *
 * @param array $attributes Existing attributes for site title element.
 * @return array Amended attributes for site title element.
 */
function site_title( $attributes ) {
	$attributes['itemprop'] = 'headline';

	return $attributes;
}

/**
 * Merge array of attributes with defaults, and apply contextual filter on array.
 *
 * The contextual filter is of the form `genesis_attr_{context}`.
 *
 * @since 2.0.0
 *
 * @param string $context    The context, to build filter name.
 * @param array  $attributes Optional. Extra attributes to merge with defaults.
 * @param array  $args       Optional. Custom data to pass to filter.
 * @return array Merged and filtered attributes.
 */
function nachalo_parse_attr( $context, $attributes = [], $args = [] ) {

	$defaults = [
		'class' => sanitize_html_class( $context ),
	];

	$attributes = wp_parse_args( $attributes, $defaults );

	// Contextual filter.
	return apply_filters( "nachalo_attr_{$context}", $attributes, $context, $args );

}


/**
 * Helper function for use as a filter for when you want to add screen-reader-text class to an element.
 *
 * @since 2.2.1
 *
 * @param array $attributes Existing attributes.
 * @return array Attributes with `screen-reader-text` added to classes
 */
function genesis_attributes_screen_reader_class( $attributes ) {

	$attributes['class'] .= ' screen-reader-text';

	return $attributes;

}

/**
 * Build list of attributes into a string and apply contextual filter on string.
 *
 * The contextual filter is of the form `genesis_attr_{context}_output`.
 *
 * @since 2.0.0
 *
 * @param string $context    The context, to build filter name.
 * @param array  $attributes Optional. Extra attributes to merge with defaults.
 * @param array  $args       Optional. Custom data to pass to filter.
 * @return string String of HTML attributes and values.
 */
function nachalo_attr( $context, $attributes = [], $args = [] ) {

	$attributes = nachalo_parse_attr( $context, $attributes, $args );

	$output = '';

	// Cycle through attributes, build tag attribute string.
	foreach ( $attributes as $key => $value ) {

		if ( ! $value ) {
			continue;
		}

		if ( true === $value ) {
			$output .= esc_html( $key ) . ' ';
		} else {
			$output .= sprintf( '%s="%s" ', esc_html( $key ), esc_attr( $value ) );
		}
	}

	$output = apply_filters( "nachalo_attr_{$context}_output", $output, $attributes, $context, $args );

	return trim( $output );

}

// var_dump(nachalo_attr( 'site-title' ));