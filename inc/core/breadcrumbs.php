<?php

/**
 * Breadcrumbs: Here we build our flexible breadcrumbs
 */

/**
 * Breadcrumb args. To be filter as required in the child theme
 * example filter: $args['labels']['prefix'] = '';
 */

function nachalo_breadcrumb_args() {

	$args = array(
		'home'                    => __( 'Home', 'invd' ),
		'sep'                     => __( '<span aria-label="breadcrumb separator" class="breadcrumb-seperator"> / </span>', 'invd' ),
		'list_sep'                => ', ',
		'prefix'                  => '<section class="breadcrumbs"><div class="wrap"><div class="breadcrumb">',
		'suffix'                  => '</div></div></section>',
        'pages'                  => array(
			'search'    => false,
			'404'       => false,
		),
		'labels'                  => array(
			'prefix'    => __( 'You are here: ', 'invd' ),
            'search'    => __( 'Search for ', 'invd' ),
            '404'       => __( 'Not found: ', 'invd' ),
			'author'    => __( 'Archives for ', 'invd' ), // Not currently used
			'category'  => __( 'Archives for ', 'invd' ), // Not currently used
			'tag'       => __( 'Archives for ', 'invd' ), // Not currently used
			'date'      => __( 'Archives for ', 'invd' ), // Not currently used
			'tax'       => __( 'Archives for ', 'invd' ), // Not currently used
			'post_type' => __( 'Archives for ', 'invd' ), // Not currently used
		),

	);

	if(has_filter('nachalo_breadcrumb_args')) {
		$args = apply_filters('nachalo_breadcrumb_args', $args);
	}

return $args;
}

/**
 * Below is an example filter
 * 
 */

//add_filter( 'invd_breadcrumb_args', 'invd_example_filter' );
// function invd_example_filter($args){
// 	$args['labels']['prefix'] = '';
// 	$args['home'] = 'Sedia';
// 	$args['sep'] = '<span aria-label="breadcrumb separator" class="fa fa-caret-right fa-lg"></span>';
//  $args['pages']['search'] = true;
// 	return $args;
// }

/**
 * Breadcrumb Function
 * We'll use hooks to display the breadcrumbs from within the child theme.
 * 
 */
function get_nachalo_breadcrumbs() {

	$args = nachalo_breadcrumb_args();

    // Set variables for later use
	$prefix           = $args['prefix']; // Opening markup
	$suffix           = $args['suffix']; // Closing markup
    $here_text        = $args['labels']['prefix'];
    $home_link        = home_url('/');
    $home_text        = $args['home']; 
    $link_before      = '<span class="breadcrumb-part" typeof="v:Breadcrumb">';
    $link_after       = '</span>';
    $link_attr        = ' rel="v:url" property="v:title"';
    $link             = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
    $delimiter        = $args['sep'];             // Delimiter between crumbs
    $before           = '<span class="current-breadcrumb">'; // Tag before the current crumb
    $after            = '</span>';                // Tag after the current crumb
    $page_addon       = '';                       // Adds the page number if the query is paged
    $breadcrumb_trail = '';
    $category_links   = '';
	$error_page  	  = $args['labels']['404'];

    /** 
     * Set our own $wp_the_query variable. Do not use the global variable version due to 
     * reliability
     */
    $wp_the_query   = $GLOBALS['wp_the_query'];
    $queried_object = $wp_the_query->get_queried_object();

    // Handle single post requests which includes single pages, posts and attatchments
    if ( is_singular() ) {
        /** 
         * Set our own $post variable. Do not use the global variable version due to 
         * reliability. We will set $post_object variable to $GLOBALS['wp_the_query']
         */
        $post_object = sanitize_post( $queried_object );

        // Set variables 
        $grab_the_title          = apply_filters( 'the_title', $post_object->post_title );
        $title = strlen($grab_the_title ) > 30 ? substr($grab_the_title  ,0,25)."..." : $grab_the_title  ;
        $parent         = $post_object->post_parent;
        $post_type      = $post_object->post_type;
        $post_id        = $post_object->ID;
        $post_link      = $before . $title . $after;
        $parent_string  = '';
        $post_type_link = '';

		// var_dump('parent ' . $parent);
		// var_dump($post_type);

        if ( 'post' === $post_type ) {
            // Get the post categories
            $categories = get_the_category( $post_id ); 
            if ( $categories ) {
                // Lets grab the first category
                $category  = $categories[0];

                $category_links = get_category_parents( $category, true, $delimiter );
                $category_links = str_replace( '<a',   $link_before . '<a' . $link_attr, $category_links );
                $category_links = str_replace( '</a>', '</a>' . $link_after,             $category_links );
            }
        }

        if ( !in_array( $post_type, ['post', 'page', 'attachment'] ) ){
            $post_type_object = get_post_type_object( $post_type );
            $archive_link     = esc_url( get_post_type_archive_link( $post_type ) );
            $post_type_link   = sprintf( $link, $archive_link, $post_type_object->labels->singular_name );
        }
        // Specifically handle US Press release
        if( 'us-press-releases' === $post_type ) {
            // Grab the url of the press release parent.
            // We'll query the which posts are using the USPR template and add to an array. 
            $args = [
                'post_type' => 'page',
                'fields' => 'ids',
                'nopaging' => true,
                'meta_key' => '_wp_page_template',
                'meta_value' => 'template-us-press-releases.php'
            ];
            $uspr_pages = get_posts( $args );

            $uspr_template_pages = []; 

            foreach ( $uspr_pages as $uspr_page ) {

                $uspr_template_pages[] = $uspr_page;
            }

            // Check if the press release page has a parent
            $uspr_grandparent = wp_get_post_parent_id( $uspr_template_pages[0]);
            $uspr_grandparent_title = get_the_title($uspr_grandparent);
            $uspr_grandparent_url = get_permalink($uspr_grandparent);
            $uspr_grandparent_post_type_link   = sprintf( $link, $uspr_grandparent_url, $uspr_grandparent_title );

            $post_type_object = get_post_type_object( $post_type );
            $uspr_url = esc_url( get_permalink($uspr_template_pages[0]));
            $uspr_post_type_link   = sprintf( $link, $uspr_url, $post_type_object->labels->singular_name );


            if ($uspr_grandparent != null) {
                $post_type_link   = $uspr_grandparent_post_type_link . $delimiter . $uspr_post_type_link;
            } else {
                $post_type_link = $uspr_post_type_link;
            }

            // echo '<pre>';
            // var_dump($uspr_grandparent_title);
            // echo '</pre>';

        }

        // Get post parents if $parent !== 0
        if ( 0 !== $parent ) 
        {
            $parent_links = [];
            while ( $parent ) {
                $post_parent = get_post( $parent );

                $parent_links[] = sprintf( $link, esc_url( get_permalink( $post_parent->ID ) ), get_the_title( $post_parent->ID ) );

                $parent = $post_parent->post_parent;
            }

            $parent_links = array_reverse( $parent_links );

            $parent_string = implode( $delimiter, $parent_links );
        }

        // Lets build the breadcrumb trail
        if ( $parent_string ) {
            $breadcrumb_trail = $parent_string . $delimiter . $post_link;
        } else {
            $breadcrumb_trail = $post_link;
        }

        if ( $post_type_link )
            $breadcrumb_trail = $post_type_link . $delimiter . $breadcrumb_trail;

        if ( $category_links )
            $breadcrumb_trail = $category_links . $breadcrumb_trail;
    }

    // Handle archives which includes category-, tag-, taxonomy-, date-, custom post type archives and author archives
    if( is_archive() ) {
        if ( is_category() || is_tag() || is_tax() ) {
            // Set the variables for this section
            $term_object        = get_term( $queried_object );
            $taxonomy           = $term_object->taxonomy;
            $term_id            = $term_object->term_id;
            $term_name          = $term_object->name;
            $term_parent        = $term_object->parent;
            $taxonomy_object    = get_taxonomy( $taxonomy );
            $current_term_link  = $before . $taxonomy_object->labels->singular_name . ': ' . $term_name . $after;
            $parent_term_string = '';

            if ( 0 !== $term_parent ) {
                // Get all the current term ancestors
                $parent_term_links = [];
                while ( $term_parent ) {
                    $term = get_term( $term_parent, $taxonomy );

                    $parent_term_links[] = sprintf( $link, esc_url( get_term_link( $term ) ), $term->name );

                    $term_parent = $term->parent;
                }

                $parent_term_links  = array_reverse( $parent_term_links );
                $parent_term_string = implode( $delimiter, $parent_term_links );
            }

            if ( $parent_term_string ) {
                $breadcrumb_trail = $parent_term_string . $delimiter . $current_term_link;
            } else {
                $breadcrumb_trail = $current_term_link;
            }

        } elseif ( is_author() ) {

            $breadcrumb_trail = __( 'Author archive for ') .  $before . $queried_object->data->display_name . $after;

        } elseif ( is_date() ) {
            // Set default variables
            $year     = $wp_the_query->query_vars['year'];
            $monthnum = $wp_the_query->query_vars['monthnum'];
            $day      = $wp_the_query->query_vars['day'];

            // Get the month name if $monthnum has a value
            if ( $monthnum ) {
                $date_time  = DateTime::createFromFormat( '!m', $monthnum );
                $month_name = $date_time->format( 'F' );
            }

            if ( is_year() ) {

                $breadcrumb_trail = $before . $year . $after;

            } elseif( is_month() ) {

                $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ), $year );

                $breadcrumb_trail = $year_link . $delimiter . $before . $month_name . $after;

            } elseif( is_day() ) {

                $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ),             $year       );
                $month_link       = sprintf( $link, esc_url( get_month_link( $year, $monthnum ) ), $month_name );

                $breadcrumb_trail = $year_link . $delimiter . $month_link . $delimiter . $before . $day . $after;
            }

        } elseif ( is_post_type_archive() ) {

            $post_type        = $wp_the_query->query_vars['post_type'];
            $post_type_object = get_post_type_object( $post_type );

            $breadcrumb_trail = $before . $post_type_object->labels->singular_name . $after;
        }
    }   

    // Handle the search page
    if ( is_search() ) {
        
        if ( $args['pages']['search'] === true){
            $breadcrumb_trail = __( 'Search query for: ' ) . $before . get_search_query() . $after;
        } else {
            return;
        }
    }

    // Handle 404's
    if ( is_404() ) {

        if ( $args['pages']['search'] === true){
            $breadcrumb_trail = $before . $error_page  . $after;
        } else {
            return;
        }
    }

    // Handle paged pages
    // if ( is_paged() ) {
    //     $current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
    //     $page_addon   = $before . sprintf( __( ' ( Page %s )' ), number_format_i18n( $current_page ) ) . $after;
    // }

	// Build the breadcrumb
    $breadcrumb_output_link  = '';
    $breadcrumb_output_link .= $prefix; // Open the output
    if ( is_home() || is_front_page() ) {
        // Do not show breadcrumbs on page one of home and frontpage
        if ( is_paged() ) {
            $breadcrumb_output_link .= $here_text;
            $breadcrumb_output_link .= '<a href="' . $home_link . '">' . $home_text . '</a>';
            $breadcrumb_output_link .= $page_addon;
        }
    } else {
        $breadcrumb_output_link .= $here_text;
        $breadcrumb_output_link .= '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $home_text . '</a>';
        $breadcrumb_output_link .= $delimiter;
        $breadcrumb_output_link .= $breadcrumb_trail;
        $breadcrumb_output_link .= $page_addon;
    }
    $breadcrumb_output_link .= $suffix; // Close the output 

    return $breadcrumb_output_link;
}


/**
 * Add the breadcrumbs
 */ 
function nachalo_breadcrumbs(){

    echo get_nachalo_breadcrumbs();
   
}
