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
        'icon'              => 'backup',
        'keywords'          => array( 'countdown'),
        'align'				=> 'full'
    ));

	// register a standings table block.
		acf_register_block_type(array(
			'name'              => 'standings',
			'title'             => __('Standings table'),
			'description'       => __('A block with a table for results and standings.'),
			'render_template'   => 'block-templates/block-table.php',
			'enqueue_style'     => get_template_directory_uri() . '/css/custom-editor-style.css',
			'category'          => 'custom',
			'icon'              => 'editor-ol',
			'keywords'          => array( 'table','standings', 'result' ),
			'align'				=> 'wide'
		));

		// register a standings table block.
		acf_register_block_type(array(
			'name'              => 'files',
			'title'             => __('Files (PDF)'),
			'description'       => __('A block for listing files.'),
			'render_template'   => 'block-templates/block-files.php',
			'enqueue_style'     => get_template_directory_uri() . '/css/custom-editor-style.css',
			'category'          => 'custom',
			'icon'              => 'pdf',
			'keywords'          => array( 'files','pdf', 'media' )
		));

		// register a standings table block.
		acf_register_block_type(array(
			'name'              => 'showposts',
			'title'             => __('Show posts'),
			'description'       => __('A block for listing posts.'),
			'render_template'   => 'block-templates/block-showposts.php',
			'enqueue_style'     => get_template_directory_uri() . '/css/custom-editor-style.css',
			'category'          => 'custom',
			'icon'              => 'admin-post',
			'keywords'          => array( 'posts' )
		));

		// register a standings table block.
		acf_register_block_type(array(
			'name'              => 'ads',
			'title'             => __('Ads'),
			'description'       => __('A block for adding space for ads.'),
			'render_template'   => 'block-templates/block-ads.php',
			'enqueue_style'     => get_template_directory_uri() . '/css/custom-editor-style.css',
			'category'          => 'custom',
			'icon'              => 'megaphone',
			'keywords'          => array( 'ads' ),
			'align'				=> 'wide'
		));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}
