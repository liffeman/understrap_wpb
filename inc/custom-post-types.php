<?php
/**
 * Register custom post types
 * @package understrap
 */

 function cpt_videos() {

	  $labels = array(
		  'name'                  => _x( 'Videos', 'Post Type General Name', 'understrap' ),
		  'singular_name'         => _x( 'Video', 'Post Type Singular Name', 'understrap' ),
		  'menu_name'             => __( 'Videos', 'understrap' ),
		  'name_admin_bar'        => __( 'Videos', 'understrap' ),
		  'archives'              => __( 'Video Archives', 'understrap' ),
		  'attributes'            => __( 'Video Attributes', 'understrap' ),
		  'parent_item_colon'     => __( 'Parent video:', 'understrap' ),
		  'all_items'             => __( 'All Videos', 'understrap' ),
		  'add_new_item'          => __( 'Add New Video', 'understrap' ),
		  'add_new'               => __( 'Add New', 'understrap' ),
		  'new_item'              => __( 'New Video', 'understrap' ),
		  'edit_item'             => __( 'Edit Video', 'understrap' ),
		  'update_item'           => __( 'Update Video', 'understrap' ),
		  'view_item'             => __( 'View Video', 'understrap' ),
		  'view_items'            => __( 'View Videos', 'understrap' ),
		  'search_items'          => __( 'Search Videos', 'understrap' ),
		  'not_found'             => __( 'Not found', 'understrap' ),
		  'not_found_in_trash'    => __( 'Not found in Trash', 'understrap' ),
		  'featured_image'        => __( 'Featured Image', 'understrap' ),
		  'set_featured_image'    => __( 'Set featured image', 'understrap' ),
		  'remove_featured_image' => __( 'Remove featured image', 'understrap' ),
		  'use_featured_image'    => __( 'Use as featured image', 'understrap' ),
		  'insert_into_item'      => __( 'Insert into Video', 'understrap' ),
		  'uploaded_to_this_item' => __( 'Uploaded to this Video', 'understrap' ),
		  'items_list'            => __( 'Video list', 'understrap' ),
		  'items_list_navigation' => __( 'Video list navigation', 'understrap' ),
		  'filter_items_list'     => __( 'Filter Videos list', 'understrap' ),
	  );
	  $args = array(
		  'label'                 => __( 'Video', 'understrap' ),
		  'description'           => __( 'Postformat for embedded videos and films', 'understrap' ),
		  'labels'                => $labels,
		  'supports'              => array( 'title', 'editor', 'thumbnail', ),
		  'taxonomies'			=> array( 'category', 'post_tag' ),
		  'hierarchical'          => false,
		  'public'                => true,
		  'show_ui'               => true,
		  'show_in_menu'          => true,
		  'menu_position'         => 5,
		  'menu_icon'             => 'dashicons-video-alt3',
		  'show_in_admin_bar'     => true,
		  'show_in_nav_menus'     => true,
		  'can_export'            => true,
		  //'has_archive'           => 'case-stories',
		  'exclude_from_search'   => false,
		  'publicly_queryable'    => true,
		  'capability_type'       => 'post',
		  'show_in_rest'          => true,
	  );
	  register_post_type( 'videos', $args );

  }
  add_action( 'init', 'cpt_videos', 0 );


// Register Custom Post Type
function cpt_team() {

	$labels = array(
		'name'                  => _x( 'Teams', 'Post Type General Name', 'understrap' ),
		'singular_name'         => _x( 'Team', 'Post Type Singular Name', 'understrap' ),
		'menu_name'             => __( 'Teams', 'understrap' ),
		'name_admin_bar'        => __( 'Teams', 'understrap' ),
		'archives'              => __( 'Teams Archives', 'understrap' ),
		'attributes'            => __( 'Team Attributes', 'understrap' ),
		'parent_item_colon'     => __( 'Parent team:', 'understrap' ),
		'all_items'             => __( 'All teams', 'understrap' ),
		'add_new_item'          => __( 'Add New team', 'understrap' ),
		'add_new'               => __( 'Add New', 'understrap' ),
		'new_item'              => __( 'New team', 'understrap' ),
		'edit_item'             => __( 'Edit team', 'understrap' ),
		'update_item'           => __( 'Update team', 'understrap' ),
		'view_item'             => __( 'View team', 'understrap' ),
		'view_items'            => __( 'View teams', 'understrap' ),
		'search_items'          => __( 'Search teams', 'understrap' ),
		'not_found'             => __( 'Not found', 'understrap' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'understrap' ),
		'featured_image'        => __( 'Featured Image', 'understrap' ),
		'set_featured_image'    => __( 'Set featured image', 'understrap' ),
		'remove_featured_image' => __( 'Remove featured image', 'understrap' ),
		'use_featured_image'    => __( 'Use as featured image', 'understrap' ),
		'insert_into_item'      => __( 'Insert into team', 'understrap' ),
		'uploaded_to_this_item' => __( 'Uploaded to this team', 'understrap' ),
		'items_list'            => __( 'Teams list', 'understrap' ),
		'items_list_navigation' => __( 'Teams list navigation', 'understrap' ),
		'filter_items_list'     => __( 'Filter teams list', 'understrap' ),
	);
	$args = array(
		'label'                 => __( 'Team', 'understrap' ),
		'description'           => __( 'A custom post type for teams', 'understrap' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-groups',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'teams', $args );

}
add_action( 'init', 'cpt_team', 0 );
