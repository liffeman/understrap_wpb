<?php
/**
 * Register custom post types
 * @package understrap
 */

// Register Custom Post Type
function cpt_apps() {

	$labels = array(
		'name'                  => _x( 'Apps', 'Post Type General Name', 'understrap' ),
		'singular_name'         => _x( 'App', 'Post Type Singular Name', 'understrap' ),
		'menu_name'             => __( 'Apps', 'understrap' ),
		'name_admin_bar'        => __( 'Apps', 'understrap' ),
		'archives'              => __( 'App archives', 'understrap' ),
		'attributes'            => __( 'App Attributes', 'understrap' ),
		'parent_item_colon'     => __( 'Parent App:', 'understrap' ),
		'all_items'             => __( 'All Apps', 'understrap' ),
		'add_new_item'          => __( 'Add New App', 'understrap' ),
		'add_new'               => __( 'Add New', 'understrap' ),
		'new_item'              => __( 'New App', 'understrap' ),
		'edit_item'             => __( 'Edit App', 'understrap' ),
		'update_item'           => __( 'Update App', 'understrap' ),
		'view_item'             => __( 'View App', 'understrap' ),
		'view_items'            => __( 'View Apps', 'understrap' ),
		'search_items'          => __( 'Search Apps', 'understrap' ),
		'not_found'             => __( 'Not found', 'understrap' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'understrap' ),
		'featured_image'        => __( 'Featured Image', 'understrap' ),
		'set_featured_image'    => __( 'Set featured image', 'understrap' ),
		'remove_featured_image' => __( 'Remove featured image', 'understrap' ),
		'use_featured_image'    => __( 'Use as featured image', 'understrap' ),
		'insert_into_item'      => __( 'Insert into App', 'understrap' ),
		'uploaded_to_this_item' => __( 'Uploaded to this App', 'understrap' ),
		'items_list'            => __( 'Apps list', 'understrap' ),
		'items_list_navigation' => __( 'Apps list navigation', 'understrap' ),
		'filter_items_list'     => __( 'Filter Apps list', 'understrap' ),
	);
	$args = array(
		'label'                 => __( 'App', 'understrap' ),
		'description'           => __( 'App from Bryta punkt nu', 'understrap' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-tide',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'app', $args );

}
add_action( 'init', 'cpt_apps', 0 );
