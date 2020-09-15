<?php

/**
 * Services Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'custom-block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'custom-block';
$className .= ' projects';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$section_anchor = $id;

$blockview = get_field('view');

?>

<?php if( !empty($section_anchor) ){
	echo '<a class="anchor" id="' . $section_anchor . '"></a>';
	}
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
		<div class="container">
					<?php
						// The Query
						$columns = get_field('number_of_cols');
						$projects_sortby = get_field('sort_by');
						$projects_sortorder = get_field('sort_order');

						/*check of projects should be sorted by start date*/
						if  ( $projects_sortby == 'project_start_time' ) {
							$args = array (
								'post_type' => 'project',
								"posts_per_page" => -1,
								'meta_key' => $projects_sortby,
								'orderby' => 'meta_value_num',
								'order' => $projects_sortorder,
							);
						} elseif ( $projects_sortby == 'project_end_time' ) {
							$args = array (
								'post_type' => 'project',
								"posts_per_page" => -1,
								'order' => $projects_sortorder,
								'meta_key' => $projects_sortby,
								'orderby' => 'meta_value_num',
							);
						} elseif ( $projects_sortby == 'title' && 'random') {
							$args  = array (
								'post_type' => 'project',
								"posts_per_page" => -1,
								'order' => $projects_sortorder,
								'orderby' => $projects_sortby,
							);
						} else {
							$args = array (
							'post_type' => 'project',
							"posts_per_page" => -1,
							'order' => $projects_sortorder,
							);
						}

						$the_project_query = new WP_Query( $args );

						// The Loop
						if ( $the_project_query->have_posts() ) {
							if ($blockview == 'grid') {
								//echo '<div class="row row-cols-' . $columns . ' ">';
								echo '<div class="card-columns">';
							} elseif ($blockview == 'list') {
						    	echo '<div class="project-list">';
							}
						    while ( $the_project_query->have_posts() ) {
						        $the_project_query->the_post();
								get_template_part( 'loop-templates/content', 'project-'. $blockview );
						    }
						    echo '</div>';

						} else {
						    // no posts found
						}
						/* Restore original Post Data */
						wp_reset_postdata();
					?>

		</div>
</div>
