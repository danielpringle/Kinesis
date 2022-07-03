<?php 

/**
 * Display the hero banner
 */
function front_page_header(){

    $hero_title          = esc_html( get_post_meta( get_the_ID(), 'hero_title', true ) );
    $hero_text           = esc_html( get_post_meta( get_the_ID(), 'hero_text ', true ) );
    $hero_image_id       = get_post_meta( get_the_ID(), 'hero_image', true );
    $hero_image_size     = 'full';
    $hero_image_array    = wp_get_attachment_image_src($hero_image_id, $hero_image_size );
    $hero_image_url      = $hero_image_array[0];
    $hero_image_alt_text = get_post_meta($hero_image_id , '_wp_attachment_image_alt', true);

    ?>
    <div class="hero">
        <div class="hero-wrap-1 home-entry-text block -secondary-color edge--bottom--reverse">
            <div class="hero-inner container">            
                <div class="hero-content">         
                    <h2><?php echo $hero_title; ?></h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vulputate vehicula tortor eu varius. In volutpat erat vitae vulputate pretium.</p>
                </div>
            </div>    
        </div>
        <div class="hero-wrap-2">
            <div class="hero-inner container">            
                <div class="hero-image">         
                    <img src="<?php echo $hero_image_url; ?>" alt="<?php echo $hero_image_alt_text; ?>">
                </div>
            </div>    
        </div>
    </div>    
    <?php      
}
add_action( 'nachalo_after_header', 'front_page_header');



/**
 * Helper function to get product category ID
 */
function get_product_cat_id($cat_name) { 
    $cat = get_term_by( 'name', $cat_name, 'product_cat' );

    if ( $cat ) {
        return $cat->term_id;
    }

    return 0;
}
/**
 * Display WooCommerce product categories
 */
function display_woo_product_cats() {

    if( get_field('display_product_categories') ) {
    
    // Adding as fallback    
    $uncategorised_product_id = get_product_cat_id('Uncategorised');

    $product_categories = get_terms([
    'taxonomy'    => 'product_cat',
    'hide_empty'  => false,
    'orderby'     => 'name',
    'order'       => 'ASC',
    'exclude'     => array($uncategorised_product_id), 
    ]);

        if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) {
        ?>
            <div class ="category-container">
        <?php
                foreach ( $product_categories as $category ) {

                $thumbnail_id     = get_term_meta( $category->term_id, 'thumbnail_id', true );
                $image            = wp_get_attachment_url( $thumbnail_id );
                $cat_link_title   = 'See more';
                ?>
                <div class="category-item">
                <?php 
                if ( $image ) : ?>
                    <div class="category-image">
                        <img src="<?php echo esc_url( $image ); ?>" alt="" />
                    </div>
                <?php endif; 
                ?> 
                    <div class="category-content">
                        <h3><?php echo esc_html( $category->name ); ?> </h3>
                        <p><?php echo esc_html( $category->description ); ?> </p>
                        <a href="<?php echo esc_url( get_term_link( $category ) ); ?>"><?php echo $cat_link_title; ?></a>  
                    </div>         
                </div>
                <?php
                }
            ?>
            </div>
            <?php
        }
    }
}
add_action( 'nachalo_before_entry_content', 'display_woo_product_cats');

/**
 * Display signposts
 */
function display_signposts() {

    $signpost_repeater = get_post_meta( get_the_ID(), 'signposts', true );
    if( $signpost_repeater ) {
      ?>
        <section class="signposts">
        <?php
        $signpost_title = get_post_meta( get_the_ID(), 'signpost_title', true );
        ?>
            <div class="signpost-title">
                <h2> <?php echo $signpost_title; ?></h2>
            </div>
            <div class="signpost-contiainer">
            <?php
            for( $i = 0; $i < $signpost_repeater; $i++ ) {
                $signpost_title          = esc_html( get_post_meta( get_the_ID(), 'signposts_' . $i . '_title', true ) );
                $signpost_text           = esc_html( get_post_meta( get_the_ID(), 'signposts_' . $i . '_text', true ) );
                $signpost_image_id       = get_post_meta( get_the_ID(), 'signposts_' . $i . '_icon', true );
                $signpost_image_size     = 'full';
                $signpost_image_array    = wp_get_attachment_image_src($signpost_image_id, $signpost_image_size );
                $signpost_image_url      = $signpost_image_array[0];
                $signpost_image_alt_text = get_post_meta($signpost_image_id , '_wp_attachment_image_alt', true);
                $signpost_image_dis      = wp_get_attachment_image($signpost_image_id, $signpost_image_size );

            ?>
            <div class="signpost-contiainer-content">
                <div class="signpost-contiainer-icon">
                <img src="<?php echo $signpost_image_url; ?>" alt="<?php echo $signpost_image_alt_text; ?>">
                </div>
                <div class="signpost-contiainer-title">
                <h3><?php echo $signpost_title ?></h3>
                </div>
                <div class="signpost-contiainer-text">
                    <p><?php echo $signpost_text ?></p>
                </div>
            </div>
            <?php
            }  
        ?>
            </div>
        </section> 
    <?php   
    }
}
add_action( 'nachalo_before_entry_content', 'display_signposts');

/**
 * Display Featured Products
 */
function display_featured_products() {
    if( get_field('display_featured_products') ) {
        $meta_query  = WC()->query->get_meta_query();
        $tax_query   = WC()->query->get_tax_query();
        $tax_query[] = array(
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'featured',
            'operator' => 'IN',
        );
 
        $featured_product_quantity = get_post_meta( get_the_ID(), 'featured_product_quantity', true );

        $args = array(
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'posts_per_page'      => $featured_product_quantity,
            'meta_query'          => $meta_query,
            'tax_query'           => $tax_query,
            'orderby'             => 'name',
            'order'               => 'DSC',
        );
        
        $featured_query = new WP_Query( $args );
  
        if ($featured_query->have_posts()) {
            ?>
            <div class="featured-products-container">
            <?php
                $featured_products_title = get_post_meta( get_the_ID(), 'featured_products_title', true );
                if( $featured_products_title ){
                    ?>
                    <div class="featured_products_title container">
                        <h2> <?php echo $featured_products_title; ?></h2>
                    </div>
                    <?php
                } 
                ?>
                <div class="featured-products-container-wrap container">
                    <?php    
                    while ($featured_query->have_posts()) : 
            
                    $featured_query->the_post();
                    $product = get_product( $featured_query->post->ID );
                    $price = $product->get_price_html();
                    $url = site_url();
                    $product_id = get_the_ID();
                    $atc = $url . '/?add-to-cart=' . $product_id . '&quantity=1' ;
                        ?>
                        <div class="featured-product">
                            <div class="featured-product-inner">
                                <div class="featured-product-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php echo woocommerce_get_product_thumbnail(); ?>
                                    </a>
                                </div>
                                <div class="featured-product-title">
                                    <?php the_title(); ?>
                                </div>
                                <div class="featured-product-price">
                                    <?php echo $price; ?>
                                </div>
                                <div class="featured-product-btns">
                                    <a class="kinesis-btn view-product-button" href="<?php the_permalink(); ?>">View product</a>
                                    <a class="kinesis-btn add-to-cart-button" href="<?php echo $atc ?>">Add to cart</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
            ?>
                </div>
            </div>
            <?php
        }
    }
}
add_action( 'nachalo_before_footer', 'display_featured_products');