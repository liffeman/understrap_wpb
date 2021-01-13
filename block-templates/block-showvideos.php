<?php

/**
 * Clients list Block Template.
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
$className .= ' videos';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}
$section_anchor = $id;
?>

<?php if( !empty($section_anchor) ){
	echo '<a class="anchor" id="' . $section_anchor . '"></a>';
	}
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<?php
		// The Query
		$number = get_field('number_of_posts');
		$cat = get_field('show_cat');
		if ($cat) {
			$filter = $cat;
		} else {
			$filter = -0;
		}

		$args = array (
			'post_type' => 'videos',
			'posts_per_page' => $number,
			'cat' => $filter,
		);

		$the_query = new WP_Query( $args);

		$columns = get_field('number_of_cols');

		$parentClass = 'row row-cols-1 row-cols-md-';
		$parentClass .= $columns;

		// The Loop

		if ( $the_query->have_posts() ) {
			echo '<div id="block-'.$block['id'].'" class="' . $parentClass . ' ">';
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					get_template_part( 'loop-templates/content', 'block-videogrid');
				}
				echo '</div>';
		}
		/* Restore original Post Data */
		wp_reset_postdata();
	?>
</div>










