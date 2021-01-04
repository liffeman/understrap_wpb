<?php
/**
 * Theme basic setup
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 1140; /* pixels */
}

add_action( 'after_setup_theme', 'understrap_setup' );

if ( ! function_exists( 'understrap_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function understrap_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on understrap, use a find and replace
		 * to change 'understrap' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'understrap', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'understrap' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		/*
		 * Adding Thumbnail basic support
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Adding support for Widget edit icons in customizer
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'understrap_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		register_block_style(
		  'core/cover',
		  array(
				'name'  => 'hero-header',
				'label' => __( 'Hero', 'understrap' ),
				'inline_style' => '.is-style-hero',
			)
	  );


	register_block_style(
		  'core/group',
		  array(
			  'name'  => 'section',
			  'label' => __( 'Section', 'understrap' ),
			  'inline_style' => '.is-style-section',
			)
	  );

	  register_block_style(
			  'core/group',
			  array(
					'name'  => 'page-header',
					'label' => __( 'Page Header', 'understrap' ),
					'inline_style' => '.is-style-page-header',
				)
		  );


		// Set up the WordPress Theme logo feature.
		add_theme_support( 'custom-logo' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		//Add support for wide images
		add_theme_support( 'align-wide' );

		// Check and setup theme default settings.
		understrap_setup_theme_default_settings();

		// Disable Custom Colors
		add_theme_support( 'disable-custom-colors' );

	  // Editor Color Palette
		  add_theme_support( 'editor-color-palette', array(
		  array(
			  'name'  => __( 'Blue', 'understrap' ),
			  'slug'  => 'blue',
			  'color'	=> '#00679c',
		  ),
		  array(
			  'name'  => __( 'Blue', 'understrap' ),
			  'slug'  => 'blue-100',
			  'color'	=> '#E5EFF5',
		  ),
		  array(
			  'name'  => __( 'Blue', 'understrap' ),
			  'slug'  => 'blue-300',
			  'color'	=> '#B2D0E2',
		  ),
		  array(
			  'name'  => __( 'Blue', 'understrap' ),
			  'slug'  => 'blue-500',
			  'color'	=> '#7FB2D0',
		  ),
		  array(
			  'name'  => __( 'Gray 100', 'understrap' ),
			  'slug'  => 'gray-100',
			  'color' => '#f8f9fa',
		  ),
		  array(
			  'name'  => __( 'Gray 300', 'understrap' ),
			  'slug'  => 'gray-300',
			  'color' => '#dee2e6',
		  ),
		  array(
			  'name'  => __( 'Gray 500', 'understrap' ),
			  'slug'  => 'gray-500',
			  'color' => '#adb5bd',
		  ),
		  array(
			  'name'  => __( 'Gray 700', 'understrap' ),
			  'slug'  => 'gray-700',
			  'color' => '#495057',
		  ),
		  array(
			  'name'  => __( 'Gray 900', 'understrap' ),
			  'slug'  => 'gray-900',
			  'color' => '#212529',
		  ),
		  array(
			  'name'  => __( 'Black', 'understrap' ),
			  'slug'  => 'black',
			  'color' => '#000000',
		  ),
		  array(
			  'name'  => __( 'White', 'understrap' ),
			  'slug'  => 'white',
			  'color' => '#ffffff',
		  ),
	  ) );
	}
}



function use_new_image_size() {
	if ( function_exists( 'add_image_size' ) ) {
		//add_image_size( 'heroimage', 1920 ); // 1920 pixels wide (and unlimited height)
		//add_image_size( 'puff', 400 ); // 400 pixels wide (and unlimited height)
		add_image_size( 'grid_image', 400, 300, true ); // 400 pixels wide and  200px height, cropped
		//add_image_size( 'gallery_image', 300, 300, true ); // 300 pixels wide and height, cropped
		//add_image_size( 'standard', 460 ); // 400 pixels wide (and unlimited height)
		add_image_size( 'header_image', 1150, 450, true ); // 1500 pixels wide and 640 px height, cropped
	}
}

add_action( 'after_setup_theme', 'use_new_image_size' );

function create_custom_image_size($sizes){
	$custom_sizes = array(
	'grid_image' => 'Grid Image size'
	);
	return array_merge( $sizes, $custom_sizes );
}
add_filter('image_size_names_choose', 'create_custom_image_size');





add_filter( 'excerpt_more', 'understrap_custom_excerpt_more' );

if ( ! function_exists( 'understrap_custom_excerpt_more' ) ) {
	/**
	 * Removes the ... from the excerpt read more link
	 *
	 * @param string $more The excerpt.
	 *
	 * @return string
	 */
	function understrap_custom_excerpt_more( $more ) {
		if ( ! is_admin() ) {
			$more = '';
		}
		return $more;
	}
}

add_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' );

if ( ! function_exists( 'understrap_all_excerpts_get_more_link' ) ) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function understrap_all_excerpts_get_more_link( $post_excerpt ) {
		if ( ! is_admin() ) {
			$post_excerpt = $post_excerpt . ' [...]<p><a class="btn btn-outline-primary understrap-read-more-link" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . __(
				'Read More...',
				'understrap'
			) . '</a></p>';
		}
		return $post_excerpt;
	}
}


/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );


if( ! function_exists('fix_no_editor_on_posts_page'))
{
	/**
	 * Add the wp-editor back into WordPress after it was removed in 4.2.2.
	 *
	 * @param $post
	 * @return void
	 */
	function fix_no_editor_on_posts_page($post)
	{
		if($post->ID != get_option('page_for_posts'))
			return;

		remove_action('edit_form_after_title', '_wp_posts_page_notice');
		add_post_type_support('page', 'editor');
	}
	add_action('edit_form_after_title', 'fix_no_editor_on_posts_page', 0);
}

/**
 * Add function for adding unsharp mask on images, using imagick
 * @param $radius, $sigma, $amount, $unsharpThreshold
 */
function imagick_sharpen_resized_files( $resized_file ) {
	if ( ! class_exists( 'Imagick' ) ) {
		return $resized_file;
	}
	$image = new Imagick( $resized_file );
	$size  = getimagesize( $resized_file );
	if ( ! $size ) {
		return new WP_Error( 'invalid_image', __( 'Could not read image size.' ), $resized_file );
	}
	list( $orig_w, $orig_h, $orig_type ) = $size;
	switch ( $orig_type ) {
		case IMAGETYPE_JPEG:
			$image->normalizeImage();
			$image->unsharpMaskImage( 0, 0.5, 1, 0.05 );
			$image->setImageFormat( 'jpg' );
			$image->setImageCompression( Imagick::COMPRESSION_JPEG );
			$image->setImageCompressionQuality( 0.92 );
			$image->writeImage( $resized_file );
			break;
		default:
			return $resized_file;
	}
	// Remove the JPG from memory
	$image->destroy();
	return $resized_file;
}
add_filter( 'image_make_intermediate_size', 'imagick_sharpen_resized_files', 900 );




function filter_projects() {
	  $catSlug = $_POST['category'];

	  $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

	  $args = array(
		//'post_type' => 'posts',
		//'category_name' => '2021',
		'posts_per_page' => 5,
		'paged' => $paged,
		'category_name' => $catSlug,
		'order_by' => 'date',
		'order' => 'desc'
		);

	  $ajaxposts = new WP_Query( $args );
	  $response = '';

	  if($ajaxposts->have_posts()) {
		echo '<div class="card-columns">';
		while($ajaxposts->have_posts()) : $ajaxposts->the_post();
			$response .= get_template_part('loop-templates/content-grid');
		endwhile;
	  } else {
		$response = 'empty';
	  }
	  echo '</div>';
	  echo $response;

	  if (function_exists("pagination")) {pagination($ajaxposts->max_num_pages);}

	exit;

	}
	add_action('wp_ajax_filter_projects', 'filter_projects');
	add_action('wp_ajax_nopriv_filter_projects', 'filter_projects');

	function wporg_remove_category_title( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		}
		return $title;
	}
	add_filter( 'remove_the_archive_title', 'wporg_remove_category_title' );

