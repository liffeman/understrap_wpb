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
$className .= ' related-posts';
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
$number = get_field('number_of_posts');
$columns = get_field('number_of_cols');
$related_posts = get_field('related_posts');
if( $related_posts ): ?>
<div class="row row-cols-<?php echo $columns ;?> ">
	<?php
	$i = 0;
	foreach( $related_posts as $related_post ):
		if ($i++ == $number) { break; }
		$permalink = get_permalink( $related_post->ID );
		$title = get_the_title( $related_post->ID );
		$image = get_the_post_thumbnail( $related_post->ID, 'grid_image', array('class' => 'card-img-top' ));
		?>
		<div class="col mb-4">
				<div class="card h-100">
					<?php
					// Must be inside a loop.

					if ( has_post_thumbnail($related_post->ID) ) {
						echo  $image ;
						//the_post_thumbnail( $related_post->ID ,'grid_image', array('class' => 'card-img-top'));
					}
					?>
					<div class="card-body">
						<h5 class="card-title text-center">
							<a href="<?php echo esc_url( $permalink ); ?>" class="stretched-link" rel="bookmark">
								<?php echo esc_html( $title ); ?>
							</a>
						</h5>
					</div>
				</div>
				</div>
	<?php	endforeach; ?>
	</div>
<?php endif; ?>

</div>
