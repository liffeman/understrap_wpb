<?php
/**
 * Register custom post types
 * @package understrap
 */

 function cpt_cases() {

	  $labels = array(
		  'name'                  => _x( 'Case Stories', 'Post Type General Name', 'understrap' ),
		  'singular_name'         => _x( 'Case Story', 'Post Type Singular Name', 'understrap' ),
		  'menu_name'             => __( 'Case Stories', 'understrap' ),
		  'name_admin_bar'        => __( 'Case Story', 'understrap' ),
		  'archives'              => __( 'Case Story Archives', 'understrap' ),
		  'attributes'            => __( 'Case Story Attributes', 'understrap' ),
		  'parent_item_colon'     => __( 'Parent Case Story:', 'understrap' ),
		  'all_items'             => __( 'All Case Stories', 'understrap' ),
		  'add_new_item'          => __( 'Add New Case Story', 'understrap' ),
		  'add_new'               => __( 'Add New', 'understrap' ),
		  'new_item'              => __( 'New Case Story', 'understrap' ),
		  'edit_item'             => __( 'Edit Case Story', 'understrap' ),
		  'update_item'           => __( 'Update Case Story', 'understrap' ),
		  'view_item'             => __( 'View Case Story', 'understrap' ),
		  'view_items'            => __( 'View Case Stories', 'understrap' ),
		  'search_items'          => __( 'Search Case Stories', 'understrap' ),
		  'not_found'             => __( 'Not found', 'understrap' ),
		  'not_found_in_trash'    => __( 'Not found in Trash', 'understrap' ),
		  'featured_image'        => __( 'Featured Image', 'understrap' ),
		  'set_featured_image'    => __( 'Set featured image', 'understrap' ),
		  'remove_featured_image' => __( 'Remove featured image', 'understrap' ),
		  'use_featured_image'    => __( 'Use as featured image', 'understrap' ),
		  'insert_into_item'      => __( 'Insert into Case Stoyr', 'understrap' ),
		  'uploaded_to_this_item' => __( 'Uploaded to this Case Stoyr', 'understrap' ),
		  'items_list'            => __( 'Case Stories list', 'understrap' ),
		  'items_list_navigation' => __( 'Case Stories list navigation', 'understrap' ),
		  'filter_items_list'     => __( 'Filter Case Stories list', 'understrap' ),
	  );
	  $args = array(
		  'label'                 => __( 'Case Story', 'understrap' ),
		  'description'           => __( 'Case Stories and references', 'understrap' ),
		  'labels'                => $labels,
		  'supports'              => array( 'title', 'editor', 'thumbnail', ),
		  'taxonomies'			=> array( 'category', 'post_tag' ),
		  'hierarchical'          => false,
		  'public'                => true,
		  'show_ui'               => true,
		  'show_in_menu'          => true,
		  'menu_position'         => 5,
		  'menu_icon'             => 'dashicons-portfolio',
		  'show_in_admin_bar'     => true,
		  'show_in_nav_menus'     => true,
		  'can_export'            => true,
		  //'has_archive'           => 'case-stories',
		  'exclude_from_search'   => false,
		  'publicly_queryable'    => true,
		  'capability_type'       => 'post',
		  'show_in_rest'          => true,
	  );
	  register_post_type( 'cases', $args );

  }
  add_action( 'init', 'cpt_cases', 0 );

  function cpt_projects() {

	$labels = array(
		'name'                  => _x( 'Projects', 'Post Type General Name', 'understrap' ),
		'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'understrap' ),
		'menu_name'             => __( 'Projects', 'understrap' ),
		'name_admin_bar'        => __( 'Project', 'understrap' ),
		'archives'              => __( 'Project Archives', 'understrap' ),
		'attributes'            => __( 'Projecs Attributes', 'understrap' ),
		'parent_item_colon'     => __( 'Parent Project:', 'understrap' ),
		'all_items'             => __( 'All Projects', 'understrap' ),
		'add_new_item'          => __( 'Add New Project', 'understrap' ),
		'add_new'               => __( 'Add New', 'understrap' ),
		'new_item'              => __( 'New Project', 'understrap' ),
		'edit_item'             => __( 'Edit Project', 'understrap' ),
		'update_item'           => __( 'Update Project', 'understrap' ),
		'view_item'             => __( 'View Project', 'understrap' ),
		'view_items'            => __( 'View Projects', 'understrap' ),
		'search_items'          => __( 'Search Project', 'understrap' ),
		'not_found'             => __( 'Not found', 'understrap' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'understrap' ),
		'featured_image'        => __( 'Featured Image', 'understrap' ),
		'set_featured_image'    => __( 'Set featured image', 'understrap' ),
		'remove_featured_image' => __( 'Remove featured image', 'understrap' ),
		'use_featured_image'    => __( 'Use as featured image', 'understrap' ),
		'insert_into_item'      => __( 'Insert into Project', 'understrap' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Project', 'understrap' ),
		'items_list'            => __( 'Projects list', 'understrap' ),
		'items_list_navigation' => __( 'Projects list navigation', 'understrap' ),
		'filter_items_list'     => __( 'Filter Projects list', 'understrap' ),
	);
	$args = array(
		'label'                 => __( 'Project', 'understrap' ),
		'description'           => __( 'Projects or portfolio', 'understrap' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'taxonomies'			=> array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 15,
		'menu_icon'             => 'dashicons-portfolio',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		//'has_archive'           => 'projects',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'project', $args );

}
add_action( 'init', 'cpt_projects', 0 );
