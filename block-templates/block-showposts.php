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
$className .= ' showposts';
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
						$skip_posts = get_field('skip_posts');
						if ($skip_posts) {
							$offset = $skip_posts;
						} else {
							$offset = 0;
						}
						$cat = get_field('show_cat');
						if ($cat) {
							$filter = $cat;
						} else {
							$filter = -0;
						}
						$show_sticky = get_field('show_only_sticky');

						if ($show_sticky) {
							$sticky = get_option( 'sticky_posts' );
							$args = array (
								'post_type' => 'post',
								'posts_per_page' => $number,
								'post_in' => $sticky,
								'ignore_sticky_posts' => 1,
								'cat' => $filter,
								'offset' => $offset,
							);
						} else {
							$args = array (
								'post_type' => 'post',
								'posts_per_page' => $number,
								'cat' => $filter,
								'offset' => $offset,
							);
						}
						$the_query = new WP_Query( $args);

						$columns = get_field('number_of_cols');

						$view = get_field('visa_som');
						if($view == 'carousel') {
							$parentClass = 'carousel slide" data-ride="carousel';
						} elseif($view == 'grid') {
							$parentClass = 'row row-cols-1 row-cols-md-';
							$parentClass .= $columns;
						} elseif($view == 'list') {
							$parentClass = 'row bg-white';
						}

						// The Loop
						if ($show_sticky) {
							if ( isset( $sticky[0] ) ) {
								if ( $the_query->have_posts() ) {
									echo '<div id="block-'.$block['id'].'" class="' . $parentClass . ' ">';
									while ( $the_query->have_posts() ) {
										$the_query->the_post();
										get_template_part( 'loop-templates/content', 'block-'.$view);
									}
									if($view == 'carousel') {
										echo '<a class="carousel-control-prev" href="#block-'.$block['id'].'" role="button" data-slide="prev">
										<span class="carousel-control-prev-icon" aria-hidden="true"></span>
										<i class="fas fa-chevron-left"></i>
										<span class="sr-only">Previous</span>
									  </a>';
									  echo '
									  <a class="carousel-control-next" href="#block-'.$block['id'].'" role="button" data-slide="next">
										<span class="carousel-control-next-icon" aria-hidden="true"></span>
										<i class="fas fa-chevron-right"></i>
										<span class="sr-only">Next</span>
									  </a>';
								  }
								echo '</div>';
								}
							}
						} else {
							if ( $the_query->have_posts() ) {
								echo '<div id="block-'.$block['id'].'" class="' . $parentClass . ' ">';
								if($view == 'carousel') {
									echo '<div class="carousel-inner">';
								}
								while ( $the_query->have_posts() ) {
									$the_query->the_post();
									get_template_part( 'loop-templates/content', 'block-'.$view);
								}
								if($view == 'carousel') {
									echo '</div>';
									echo '<a class="carousel-control-prev" href="#block-'.$block['id'].'" role="button" data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
									<span class="sr-only">Previous</span>
								  </a>';
								  echo '
								  <a class="carousel-control-next" href="#block-'.$block['id'].'" role="button" data-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
									<span class="sr-only">Next</span>
								  </a>';
							  }
							echo '</div>';
							}
						}
						/* Restore original Post Data */
						wp_reset_postdata();
					?>
</div>










