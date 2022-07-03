<?php
/**
 * Search results pages
 *
 */

get_header();

$searchQuery = get_search_query();

$included_mimes  = array( 
	'application/pdf',
	'application/mspowerpoint',
	'application/powerpoint',
	'application/vnd.ms-powerpoint', 
	'application/x-mspowerpoint',
	'application/msword',
	'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
 );
$unsupported_mimes  = array( 'image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/tiff', 'image/x-icon' );
$all_mimes          = get_allowed_mime_types();
$accepted_mimes     = array_diff( $all_mimes, $unsupported_mimes );

 $attachments_query = new WP_Query( array(
	's'                 => $searchQuery,
	'post_type'         => 'attachment',
	'post_mime_type'    => $accepted_mimes,
	'post_status'       => 'inherit',
	'posts_per_page'    => -1,
) );

$total_attachments_found = (int) $attachments_query->found_posts;
$number_wp_query_search_results = (int) $wp_query->found_posts;

?>

<main id="main-content">
	<div class="container search-results-container">
		<div class="body-content-inner">
			<div class="page-title">
					<h1>Search Results</h1>
			</div>
			<div>
			<?php $random_identifier = wp_rand(); ?>
				<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<label for="search-field-<?php echo esc_attr( $random_identifier ); ?>">
						<span class="screen-reader-text"><?php esc_html_e( 'To search this site, enter a search term', 'invd' ); ?></span>
						<input class="search-results-term" id="search-field-<?php echo esc_attr( $random_identifier ); ?>" type="text" name="s" value="<?php echo get_search_query(); ?>" aria-required="false" autocomplete="off" placeholder="<?php echo esc_attr_e( 'What are you looking for?', '_s' ); ?>" />
					</label>
						<input type="submit" id="search-submit" class="button button-search" tabindex="0" value="<?php esc_attr_e( 'Search', 'invd' ); ?>" />
						
				</form>
			</div>
			<div class="search-result-count">
				<p>
					<?php
					if ($number_wp_query_search_results < 1 && $total_attachments_found >=1 ) {
  
						printf( esc_html(
							_n(
								 'We found %s document for',
								  'We found %s documents for',
								   $total_attachments_found,
									'invd' 
								) 
							),
							$total_attachments_found
						); 
						?>:<strong> "<?php the_search_query(); ?>"</strong> <?php
					
					
					} elseif ($number_wp_query_search_results >=1 && $total_attachments_found <1 ) {
						
						printf( esc_html(
							_n(
								 'We found %s result for',
								  'We found %s results for',
								  $number_wp_query_search_results,
									'invd' 
								) 
							),
							$number_wp_query_search_results
						);
						?>:<strong> "<?php the_search_query(); ?>"</strong> <?php
					
					} elseif ($number_wp_query_search_results <1 && $total_attachments_found <1 ) {

						_e( 'No results were found matching your search term', 'invd' );

						?>:<strong> "<?php the_search_query(); ?>"</strong> <?php
					
					}else {
						printf( esc_html(
							_n(
								 'We found %s result',
								  'We found %s results',
								  $number_wp_query_search_results,
									'invd' 
								) 
							),
							$number_wp_query_search_results
						);
					
						printf( esc_html(
							_n(
								 ' and %s document for',
								  ' and %s documents for',
								   $total_attachments_found,
									'invd' 
								) 
							),
							$total_attachments_found
						); 
						?>:<strong> "<?php the_search_query(); ?>"</strong> <?php
					}
					?>
				</p>
			</div><!-- .search-result-count -->

			<!-- Tab links -->
      <div class= "wrapper">
				<div class="search-tabs">
					<button class="search-tab-links active" data-id="All" tabindex="0">All (<?php echo $number_wp_query_search_results ?>)</button>
					<button class="search-tab-links" data-id="Documents" tabindex="0">Documents (<?php echo $total_attachments_found ?>) </button>
				</div>
				<div class="search-tab-content active results-all" id="All">
				<?php 
				if ( have_posts() ){

					while (have_posts()) { 
						the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
								<?php
								$site_title = get_bloginfo( 'name' );
								$url        = esc_url( get_permalink($id));
								$title      = get_the_title();
								?>
								<h3 class="entry-title"><a href="<?php echo $url ?>"><?php echo $title ?> | <?php echo $site_title ?></a>  </h3> 
								<a class="search-result-url" href="<?php echo $url ?>"><?php echo $url ?></a> 
							</header><!-- .entry-header -->
							<div class="entry-content">
								<?php 
									the_excerpt();
								?>
							</div><!-- .entry-content -->
						</article>

					<?php 
					} // End the loop.

				} else {
					//_e( 'No results were found matching your search.', 'invd' );
				}

					?>
				
				</div>
				<div class="search-tab-content search-results-documents" id="Documents">
					
					<!-- <h2>Documents</h2> -->
					<?php 

						if ( $attachments_query->have_posts() ) {

							while ( $attachments_query->have_posts() ) {
									$attachments_query->the_post();
									?>
									<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<header class="entry-header">
										<?php
										$site_title = get_bloginfo( 'name' );
										$url        = esc_url( get_permalink());
										$title      = get_the_title();
										$attachmentUrl = wp_get_attachment_url();
										?>
										<h3 class="entry-title"><a href="<?php echo $url ?>"><?php echo $title ?> | <?php echo $site_title ?></a>  </h3> 
										<!-- <a href="<?php echo $url ?>"><?php echo $url ?></a> </br> -->
										<a class="search-result-url" target="_blank" href="<?php echo $attachmentUrl ?>"><span class="fa fa-download" aria-hidden="true"></span><?php echo $attachmentUrl ?></a> 

									</header><!-- .entry-header -->
									
									<div class="entry-content">
										<?php 
											// the_excerpt();
										?>
									</div><!-- .entry-content -->
								</article>
								<?php
								wp_reset_query();
							}
						} else {
							_e( 'No documents were found matching your search.', 'invd' );
						}
							
					?>
			</div>
		</div>
	</div>
</main>
			<?php 
get_footer();

?>