<?php
/**
 * Custom login setup
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'login_enqueue_scripts', 'custom_login_logo' );

if ( ! function_exists( 'custom_login_logo' ) ) {
	function custom_login_logo() { ?>
		<style type="text/css">
			#login h1 a, .login h1 a {
				background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/login-logo.svg);
			height:100px;
			width:320px;
			background-size: 100px 100px;
			background-repeat: no-repeat;
				//padding-bottom: 30px;
			}
		</style>
	<?php }
}

function custom_login_logo_url() {
	return home_url();
}
add_filter( 'login_headerurl', 'custom_login_logo_url' );

function custom_login_logo_url_title() {
	return __('Login to dashboard');
}
add_filter( 'login_headertext', 'custom_login_logo_url_title' );


function custom_login_stylesheet() {
	wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/css/custom-login-style.min.css' );
	wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/js/custom-login.js' );
}
add_action( 'login_enqueue_scripts', 'custom_login_stylesheet' );
