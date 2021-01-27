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

?>

<?php if( !empty($section_anchor) ){
echo '<a class="anchor" id="' . $section_anchor . '"></a>';
}
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

	<?php
	// The Query
		$args = array (
			'post_type' => 'faq',
		);

	$the_faq_query = new WP_Query( $args );
	?>

	<?php
	// The Loop
	if ( $the_faq_query->have_posts() ) : ?>
		<div class="accordion" id="accordion-<?php echo esc_attr($block['id']); ?>">
		<?php while ( $the_faq_query->have_posts() ): $the_faq_query->the_post(); ?>
			<?php $faq_id = get_the_ID();?>
			<div class="card faq">
			<div class="card-header p-0" id="heading-<?php echo esc_attr($faq_id); ?>">
				<button class="btn btn-lg btn-link btn-block text-left rounded-0 collapsed " type="button" data-toggle="collapse" data-target="#collapse<?php echo esc_attr($faq_id); ?>" aria-expanded="false" aria-controls="collapse<?php echo esc_attr($faq_id); ?>">
				  <h5 class="faq-title p-3 m-0"><?php the_title();?></h5>
				</button>
			</div>

			<div id="collapse<?php echo esc_attr($faq_id); ?>" class="collapse" aria-labelledby="heading<?php echo esc_attr($faq_id); ?>" data-parent="#accordion-<?php echo esc_attr($block['id']); ?>">
			  <div class="card-body">
			  	<?php the_content();?>
			 </div>
			</div>
		  </div>
		<?php endwhile; ?>
		</div>
<?php endif; ?>
<?php	wp_reset_postdata(); ?>
</div>
