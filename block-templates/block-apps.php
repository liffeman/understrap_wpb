<?php

/**
 * Ads Block Template.
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
$className .= ' apps';
$className .= ' d-flex flex-column flex-wrap justify-items-center';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}

$section_anchor = $id;

// ACF values
//$ad_image = get_field ('ad_block_image');
//$ad_link = get_field ('ad_block_link');

?>

<?php if( !empty($section_anchor) ){
echo '<a class="anchor" id="' . $section_anchor . '"></a>';
}
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<?php
	global $post;
	$posts = get_field('apps');
	if( $posts ): ?>
	<div class="row">
		<div class="container">
			<div class="apps">
				<?php foreach( $posts as $post): ?>
					<?php setup_postdata($post); ?>
					<div class="card app bg-dark text-white">
						<?php if ( has_post_thumbnail()) : ?>
							<?php the_post_thumbnail( 'large', array( 'class' => 'card-img' ) );?>
						<?php endif; ?>
						<div class="card-img-overlay">
							<a class="app-link stretched-link" href="<?php the_permalink(); ?>"><h5 class="app-title"><?php the_title(); ?></h5></a>
						</div>
					</div>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>
