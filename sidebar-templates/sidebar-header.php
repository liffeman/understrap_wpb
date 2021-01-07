<?php
/**
 * Sidebar - The Header Widget Area
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( is_active_sidebar( 'header_ad' ) ) {

	dynamic_sidebar( 'header_ad' );

}
