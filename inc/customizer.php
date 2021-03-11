<?php
/**
 * UnderStrap Theme Customizer
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'understrap_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function understrap_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'understrap_customize_register' );

if ( ! function_exists( 'understrap_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function understrap_theme_customize_register( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section(
			'understrap_theme_layout_options',
			array(
				'title'       => __( 'Theme Layout Settings', 'understrap' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Container width and sidebar defaults', 'understrap' ),
				'priority'    => apply_filters( 'understrap_theme_layout_options_priority', 160 ),
			)
		);

		/**
		 * Select sanitization function
		 *
		 * @param string               $input   Slug to sanitize.
		 * @param WP_Customize_Setting $setting Setting instance.
		 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
		 */
		function understrap_theme_slug_sanitize_select( $input, $setting ) {

			// Ensure input is a slug (lowercase alphanumeric characters, dashes and underscores are allowed only).
			$input = sanitize_key( $input );

			// Get the list of possible select options.
			$choices = $setting->manager->get_control( $setting->id )->choices;

			// If the input is a valid key, return it; otherwise, return the default.
			return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

		}

		$wp_customize->add_setting(
			'understrap_container_type',
			array(
				'default'           => 'container',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_container_type',
				array(
					'label'       => __( 'Container Width', 'understrap' ),
					'description' => __( 'Choose between Bootstrap\'s container and container-fluid', 'understrap' ),
					'section'     => 'understrap_theme_layout_options',
					'settings'    => 'understrap_container_type',
					'type'        => 'select',
					'choices'     => array(
						'container'       => __( 'Fixed width container', 'understrap' ),
						'container-fluid' => __( 'Full width container', 'understrap' ),
					),
					'priority'    => apply_filters( 'understrap_container_type_priority', 10 ),
				)
			)
		);

		$wp_customize->add_setting(
			'understrap_sidebar_position',
			array(
				'default'           => 'right',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_sidebar_position',
				array(
					'label'             => __( 'Sidebar Positioning', 'understrap' ),
					'description'       => __(
						'Set sidebar\'s default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.',
						'understrap'
					),
					'section'           => 'understrap_theme_layout_options',
					'settings'          => 'understrap_sidebar_position',
					'type'              => 'select',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
					'choices'           => array(
						'right' => __( 'Right sidebar', 'understrap' ),
						'left'  => __( 'Left sidebar', 'understrap' ),
						'both'  => __( 'Left & Right sidebars', 'understrap' ),
						'none'  => __( 'No sidebar', 'understrap' ),
					),
					'priority'          => apply_filters( 'understrap_sidebar_position_priority', 20 ),
				)
			)
		);

		$wp_customize->add_setting(
			'understrap_navbar_scheme',
			array(
				'default'           => 'navbar-dark bg-dark',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_setting(
			'understrap_blog_view',
			array(
				'default'           => 'grid',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_blog_view',
				array(
					'label'             => __( 'Blog view setting', 'understrap' ),
					'description'       => __(
						'Set the default view of the blog and archive page.',
						'understrap'
					),
					'section'           => 'understrap_theme_layout_options',
					'settings'          => 'understrap_blog_view',
					'type'              => 'select',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
					'choices'           => array(
						'grid' => __( 'Grid view', 'understrap' ),
						'list'  => __( 'List view', 'understrap' ),
					),
					'priority'          => apply_filters( 'understrap_blog_view_priority', 25 ),
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_navbar_scheme',
				array(
					'label'             => __( 'Choose color scheme on navbar', 'understrap' ),
					'description'       => __(
						'Choose dark or light color on navbar',
						'understrap'
					),
					'section'           => 'understrap_theme_layout_options',
					'settings'          => 'understrap_navbar_scheme',
					'type'              => 'select',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
					'choices'           => array(
						'navbar-dark bg-dark' => __( 'Dark theme', 'understrap' ),
						'navbar-light bg-light'  => __( 'Light theme', 'understrap' ),
						'navbar-dark bg-primary'  => __( 'Primary color theme', 'understrap' ),
					),
					'priority'          => apply_filters( 'understrap_sidebar_position_priority', 35 ),
				)
			)
		);

		$wp_customize->add_setting(
			'understrap_searchbox',
			array(
				'default'           => 'hide',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_searchbox',
				array(
					'label'             => __( 'Show search button in navbar', 'understrap' ),
					'description'       => __(
						'Set to show or hide the search button in the navbar',
						'understrap'
					),
					'section'           => 'understrap_theme_layout_options',
					'settings'          => 'understrap_searchbox',
					'type'              => 'select',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
					'choices'           => array(
						'show' => __( 'Show search button', 'understrap' ),
						'hide'  => __( 'Hide search button', 'understrap' ),
					),
					'priority'          => apply_filters( 'understrap_sidebar_position_priority', 30 ),
				)
			)
		);

		$wp_customize->add_setting(
			'understrap_offcanvas',
			array(
				'default'           => '1',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_offcanvas',
				array(
					'label'             => __( 'Off Canvas Menu', 'understrap' ),
					'description'       => __(
						'Set to user OffCanvas instead of bootstrap menu',
						'understrap'
					),
					'section'           => 'understrap_theme_layout_options',
					'settings'          => 'understrap_offcanvas',
					'type'              => 'radio',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
					'choices'           => array(
						'1' => __( 'Use Off Canvas', 'understrap' ),
						'0'  => __( 'Use standard Bootstrap', 'understrap' ),
					),
					'priority'          => apply_filters( 'understrap_sidebar_position_priority', 40 ),
				)
			)
		);
		$wp_customize->add_setting(
			'understrap_offcanvas_theme',
			array(
				'default'           => 'dark',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_offcanvas_theme',
				array(
					'label'             => __( 'Theme color', 'understrap' ),
					'description'       => __(
						'Set the theme color of the Off Canvas Menu',
						'understrap'
					),
					'section'           => 'understrap_theme_layout_options',
					'settings'          => 'understrap_offcanvas_theme',
					'type'              => 'select',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
					'choices'           => array(
						'dark' => __( 'Dark theme', 'understrap' ),
						'light'  => __( 'Light', 'understrap' ),
					),
					'priority'          => apply_filters( 'understrap_sidebar_position_priority', 45 ),
				)
			)
		);

		$wp_customize->add_setting(
			'understrap_offcanvas_submenu_slide',
			array(
				'default'           => 'true',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_offcanvas_submenu_slide',
				array(
					'label'             => __( 'Slide submenues', 'understrap' ),
					'description'       => __(
						'Set if submenues should be sliding or not',
						'understrap'
					),
					'section'           => 'understrap_theme_layout_options',
					'settings'          => 'understrap_offcanvas_submenu_slide',
					'type'              => 'select',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
					'choices'           => array(
						'true' => __( 'Slide', 'understrap' ),
						'false'  => __( 'Collapse', 'understrap' ),
					),
					'priority'          => apply_filters( 'understrap_sidebar_position_priority', 46 ),
				)
			)
		);

		$wp_customize->add_setting(
			'analytics_ua_id',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);


		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'analytics_ua_id',
				array(
					'label'             => __( 'Google Analytics Tracking ID', 'understrap' ),
					'description'       => __(
						'Add your Google Analytics Tracking ID (UA-XXXXX)',
						'understrap'
					),
					'section'           => 'analytics',
					'settings'          => 'analytics_ua_id',
					'type'              => 'text',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
				)
			)
		);

		$wp_customize->add_setting(
			'analytics_ga4_id',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);


		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'analytics_ga4_id',
				array(
					'label'             => __( 'Google Analytics 4 Tracking ID', 'understrap' ),
					'description'       => __(
						'Add your Google Analytics 4 Tracking ID (G-XXXXX)',
						'understrap'
					),
					'section'           => 'analytics',
					'settings'          => 'analytics_ga4_id',
					'type'              => 'text',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
				)
			)
		);

		$wp_customize->add_setting(
			'analytics_gtm_id',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);


		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'analytics_gtm_id',
				array(
					'label'             => __( 'Google Tag Manager ID', 'understrap' ),
					'description'       => __(
						'Add your Google Tag Manager ID (GTM-XXXXX)',
						'understrap'
					),
					'section'           => 'analytics',
					'settings'          => 'analytics_gtm_id',
					'type'              => 'text',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
				)
			)
		);
	}
} // End of if function_exists( 'understrap_theme_customize_register' ).

add_action( 'customize_register', 'understrap_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'understrap_customize_preview_js' ) ) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function understrap_customize_preview_js() {
		wp_enqueue_script(
			'understrap_customizer',
			get_template_directory_uri() . '/js/customizer.js',
			array( 'customize-preview' ),
			'20130508',
			true
		);
	}
}
add_action( 'customize_preview_init', 'understrap_customize_preview_js' );
