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
			'title'             => __('Standings - Driver'),
			'description'       => __('A block with a table for results and standings for drivers.'),
			'render_template'   => 'block-templates/block-table.php',
			'enqueue_style'     => get_template_directory_uri() . '/css/custom-editor-style.css',
			'category'          => 'custom',
			'icon'              => 'editor-ol',
			'keywords'          => array( 'table','standings', 'result', 'driver' ),
			'align'				=> 'wide'
		));

	// register a standings table block.
	acf_register_block_type(array(
		'name'              => 'standings_team',
		'title'             => __('Standings  - Team/Manufacturer'),
		'description'       => __('A block with a table for results and standings for Teams and/or manufactors.'),
		'render_template'   => 'block-templates/block-table-team.php',
		'enqueue_style'     => get_template_directory_uri() . '/css/custom-editor-style.css',
		'category'          => 'custom',
		'icon'              => 'editor-ol',
		'keywords'          => array( 'table','standings', 'result', 'team', 'manufactor' ),
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

		// register a video gallery  block.
		acf_register_block_type(array(
			'name'              => 'videogallery',
			'title'             => __('Video Gallery'),
			'description'       => __('A block for showing videoposts as a grid view.'),
			'render_template'   => 'block-templates/block-showvideos.php',
			'enqueue_style'     => get_template_directory_uri() . '/css/custom-editor-style.css',
			'category'          => 'custom',
			'mode' => 'edit',
			'icon'              => 'grid-view',
			'supports' => array (
				'mode' => false,
			),
			'keywords'          => array( 'video' )
		));

		// register a video gallery  block.
		acf_register_block_type(array(
			'name'              => 'teamsgallery',
			'title'             => __('Show teams'),
			'description'       => __('A block for showing teams as a grid view.'),
			'render_template'   => 'block-templates/block-showteam.php',
			'enqueue_style'     => get_template_directory_uri() . '/css/custom-editor-style.css',
			'category'          => 'custom',
			'icon'              => 'groups',
			'keywords'          => array( 'team' )
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
