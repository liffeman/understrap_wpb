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
	$content_width = 640; /* pixels */
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
				'footer' => __('Footer Menu', 'understrap'),
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

		// Set up the WordPress Theme logo feature.
		add_theme_support( 'custom-logo' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		//Add support for wide images
		add_theme_support( 'align-wide' );

		// Check and setup theme default settings.
		understrap_setup_theme_default_settings();

	}
}


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
			$post_excerpt = $post_excerpt . ' [...]<p><a class="btn btn-secondary understrap-read-more-link" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . __(
				'Read More...',
				'understrap'
			) . '</a></p>';
		}
		return $post_excerpt;
	}
}


/**
 * Filter the excerpt length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function understrap_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'understrap_excerpt_length');


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


/*
 * Add Google Analytics  and Tag Manager IDs *
 */

/* Google Universal Analytics */
function _wpb_google_analytics_ua_script() {
	$ua_id = get_theme_mod( 'analytics_ua_id' );
	if($ua_id){
	?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $ua_id;?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo $ua_id;?>');
</script>
<!-- End Google Analytics  -->
<?php } }

/* Google Analytics 4 */
function _wpb_google_analytics_ga4_script() {
	$ga4_id = get_theme_mod( 'analytics_ga4_id' );
	if($ga4_id){
	?>
<!-- Global site tag (gtag.js) - Google Analytics 4 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $ga4_id;?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo $ga4_id;?>');
</script>
<!-- End Google Analytics 4 -->
<?php } }

/* Google Tag Manager */
function _wpb_google_tagmanager_script() {
	$gtm_id = get_theme_mod( 'analytics_gtm_id' );
	if ($gtm_id) {
?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo $gtm_id;?>');</script>
<!-- End Google Tag Manager -->
<?php  } }


if (!current_user_can('manage_options')) {
	$ua_id = get_theme_mod( 'analytics_ua_id' );
	$ga4_id = get_theme_mod( 'analytics_ga4_id' );
	$gtm_id = get_theme_mod( 'analytics_gtm_id' );
	 if ($ua_id) {
	 add_action('wp_head', '_wpb_google_analytics_ua_script', 5);
	}
	if ($ga4_id) {
		 add_action('wp_head', '_wpb_google_analytics_ga4_script', 5);
	}
	if ($gtm_id) {
		add_action('wp_head', '_wpb_google_tagmanager_script', 25);
	}
}


function _wpb_google_tagmanager_body_script() {
	$gtm_id = get_theme_mod( 'analytics_gtm_id' );
	if ($gtm_id) {
?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $gtm_id;?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php } }
if (!current_user_can('manage_options')) {
	$gtm_id = get_theme_mod( 'analytics_gtm_id' );
	if ($gtm_id) {
	add_action('wp_body_open', '_wpb_google_tagmanager_body_script', 1);
	}
}
