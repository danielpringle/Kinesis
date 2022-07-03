<?php


add_action( 'nachalo_entry_content', 'be_page_content' );

function be_page_content(){
    
    get_template_part( 'template-parts/content/content-page' );
}

/**
 * Child theme breadcrumb options
 */ 
function sedia_breadcrumbs($args){

	$args['labels']['prefix'] = '';
	$args['home'] = 'Home';
	$args['sep'] = '<span aria-label="breadcrumb separator" class="breadcrumb-seperator fa fa-caret-right fa-lg"></span>';
    $args['pages']['search'] = true;

	return $args;
}
//add_filter( 'nachalo_breadcrumb_args', __NAMESPACE__ . '\sedia_breadcrumbs' );

/**
 * Add the breadcrumbs
 */ 
function show_breadcrumbs(){


	echo get_nachalo_breadcrumbs();

	

    echo 'hello';

}

//add_action( 'nachalo_before_content', __NAMESPACE__ . '\show_breadcrumbs');
