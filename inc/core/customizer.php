<?php 
/**
 * Customizer integrations
 */


// Adding header ticker iframe field
function invd_register_theme_customizer($wp_customize)
{



  			// Add "display_title_and_tagline" setting for displaying the site-title & tagline.
        $wp_customize->add_setting(
          'display_title_and_tagline',
          array(
            'capability'        => 'edit_theme_options',
            'default'           => true,
            'sanitize_callback' => 'theme_slug_sanitize_checkbox',
          )
        );
  
        // Add control for the "display_title_and_tagline" setting.
        $wp_customize->add_control(
          'display_title_and_tagline',
          array(
            'type'    => 'checkbox',
            'section' => 'title_tagline',
            'label'   => esc_html__( 'Display Site Title & Tagline', 'twentytwentyone' ),
          )
        );


        function theme_slug_sanitize_checkbox( $input ){
                    
          //returns true if checkbox is checked
          return ( isset( $input ) ? true : false );
        }
}

// End invd Theme Register functiona
// Footer configuration
//add_action('customize_register', 'invd_register_theme_customizer');

/**
 * Customizer settings for this theme.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

if ( ! class_exists( 'Twenty_Twenty_One_Customize' ) ) {
	/**
	 * Customizer Settings.
	 *
	 * @since Twenty Twenty-One 1.0
	 */
	class Twenty_Twenty_One_Customize {

		/**
		 * Constructor. Instantiate the object.
		 *
		 * @since Twenty Twenty-One 1.0
		 */
		public function __construct() {
			add_action( 'customize_register', array( $this, 'register' ) );
		}

		/**
		 * Register customizer options.
		 *
		 * @since Twenty Twenty-One 1.0
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 * @return void
		 */
		public function register( $wp_customize ) {

			// Change site-title & description to postMessage.
			$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage'; // @phpstan-ignore-line. Assume that this setting exists.
			$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage'; // @phpstan-ignore-line. Assume that this setting exists.

			// Add partial for blogname.
			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '.site-title',
					'render_callback' => array( $this, 'partial_blogname' ),
				)
			);

			// Add partial for blogdescription.
			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '.site-description',
					'render_callback' => array( $this, 'partial_blogdescription' ),
				)
			);

			// Add "display_title_and_tagline" setting for displaying the site-title & tagline.
			$wp_customize->add_setting(
				'display_title_and_tagline',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => true,
					'sanitize_callback' => array( __CLASS__, 'sanitize_checkbox' ),
				)
			);

			// Add control for the "display_title_and_tagline" setting.
			$wp_customize->add_control(
				'display_title_and_tagline',
				array(
					'type'    => 'checkbox',
					'section' => 'title_tagline',
					'label'   => esc_html__( 'Display Site Title & Tagline', 'twentytwentyone' ),
				)
			);

			/**
			 * Add excerpt or full text selector to customizer
			 */
			$wp_customize->add_section(
				'excerpt_settings',
				array(
					'title'    => esc_html__( 'Excerpt Settings', 'twentytwentyone' ),
					'priority' => 120,
				)
			);

			$wp_customize->add_setting(
				'display_excerpt_or_full_post',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => 'excerpt',
					'sanitize_callback' => function( $value ) {
						return 'excerpt' === $value || 'full' === $value ? $value : 'excerpt';
					},
				)
			);

			$wp_customize->add_control(
				'display_excerpt_or_full_post',
				array(
					'type'    => 'radio',
					'section' => 'excerpt_settings',
					'label'   => esc_html__( 'On Archive Pages, posts show:', 'twentytwentyone' ),
					'choices' => array(
						'excerpt' => esc_html__( 'Summary', 'twentytwentyone' ),
						'full'    => esc_html__( 'Full text', 'twentytwentyone' ),
					),
				)
			);


		}

		/**
		 * Sanitize boolean for checkbox.
		 *
		 * @since Twenty Twenty-One 1.0
		 *
		 * @param bool $checked Whether or not a box is checked.
		 * @return bool
		 */
		public static function sanitize_checkbox( $checked = null ) {
			return (bool) isset( $checked ) && true === $checked;
		}

		/**
		 * Render the site title for the selective refresh partial.
		 *
		 * @since Twenty Twenty-One 1.0
		 *
		 * @return void
		 */
		public function partial_blogname() {
			bloginfo( 'name' );
		}

		/**
		 * Render the site tagline for the selective refresh partial.
		 *
		 * @since Twenty Twenty-One 1.0
		 *
		 * @return void
		 */
		public function partial_blogdescription() {
			bloginfo( 'description' );
		}
	}
}
