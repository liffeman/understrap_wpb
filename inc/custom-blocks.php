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
add_filter( 'block_categories', 'my_custom_block_category', 0, 2);




function register_acf_block_types() {

    // register a post list block.
    acf_register_block_type(array(
        'name'              => 'apps',
        'title'             => __('Apps'),
        'description'       => __('A block to whow apps.'),
        'render_template'   => 'block-templates/block-apps.php',
        'enqueue_style'     => get_template_directory_uri() . '/css/custom-editor-style.css',
        'category'          => 'custom',
        'icon'              => 'tide',
        'keywords'          => array( 'apps')
	));
	// register a post list block.
	acf_register_block_type(array(
		'name'              => 'faq',
		'title'             => __('FAQs'),
		'description'       => __('A block to whow FAQs.'),
		'render_template'   => 'block-templates/block-faqs.php',
		'enqueue_style'     => get_template_directory_uri() . '/css/custom-editor-style.css',
		'category'          => 'custom',
		'icon'              => 'editor-help',
		'keywords'          => array( 'faq')
	));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}
