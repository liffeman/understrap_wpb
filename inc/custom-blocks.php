<?php
/**
 * Custom blocks for this theme.
 *
 * ACF Pro 5.8.X is required
 *
 * @package _wpb
 */

function my_custom_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'custom',
				'title' => __( 'Custom Blocks', 'custom-blocks' ),
			),
		)
	);
}
add_filter( 'block_categories', 'my_custom_block_category', 10, 2);




function register_acf_block_types() {

    // register a post list block.
    acf_register_block_type(array(
        'name'              => 'coundown',
        'title'             => __('Countdown'),
        'description'       => __('A block with a countdown to date.'),
        'render_template'   => 'block-templates/block-countdown.php',
        'enqueue_style'     => get_template_directory_uri() . '/css/custom-editor-style.css',
        'category'          => 'custom',
        'icon'              => 'admin-post',
        'keywords'          => array( 'countdown'),
        'align'				=> 'wide',
    ));

	// register a post list block.
		acf_register_block_type(array(
			'name'              => 'services',
			'title'             => __('Services'),
			'description'       => __('A block with a list of services.'),
			'render_template'   => 'block-templates/services.php',
			'enqueue_style'     => get_template_directory_uri() . '/css/custom-editor-style.css',
			'category'          => 'custom',
			'icon'              => 'admin-post',
			'keywords'          => array( 'services','posts', 'list' ),
			'align'				=> 'wide',
		));

		// register a case stories block.
		acf_register_block_type(array(
			'name'              => 'casestories',
			'title'             => __('Case Stories'),
			'description'       => __('A block with a list of case stories in a grid layout.'),
			'render_template'   => 'block-templates/casestories.php',
			'enqueue_style'     => get_template_directory_uri() . '/css/custom-editor-style.css',
			'category'          => 'custom',
			'icon'              => 'admin-post',
			'keywords'          => array('casestories','cases','posts', 'list' ),
			'align'				=> 'wide',
		));

		// register a post list block.
		acf_register_block_type(array(
			'name'              => 'relatedposts',
			'title'             => __('Related posts'),
			'description'       => __('A block with posts grid layout.'),
			'render_template'   => 'block-templates/related-posts.php',
			'enqueue_style'     => get_template_directory_uri() . '/css/custom-editor-style.css',
			'category'          => 'custom',
			'icon'              => 'admin-post',
			'keywords'          => array('related', 'posts', 'list' ),
			'align'				=> 'wide',
		));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}
