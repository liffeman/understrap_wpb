<?php

/**
 * Files (PDF) Block Template.
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
$className .= ' files';
$className .= ' d-flex flex-column flex-wrap justify-items-center';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}

$section_anchor = $id;

$filter = get_field('visa_filter');


?>
<?php if( !empty($section_anchor) ){
echo '<a class="anchor" id="' . $section_anchor . '"></a>';
}
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

	<div class="row row-cols-1 row-cols-md-4">

		<?php // Check rows exists.
		if( have_rows('files') ):

			// Loop through rows.
			while( have_rows('files') ) : the_row();

				// Load sub field value.
				$file = get_sub_field('file');
				if( $file ):

					// Extract variables.
					$id = $file['id'];
					$url = $file['url'];
					$title = $file['title'];
					$caption = $file['caption'];
					$icon = $file['icon'];
					$type = $file['subtype'];
					if ($type == 'pdf') {
						$the_thumb = '<i class="fas fa-file-pdf fa-2x mr-3"></i>';
					} else {
						$the_thumb = '<img src= " ' . esc_attr( $icon ) . ' ">';
					}
					?>
					<div class="col mb-4">
						<div class="card file">
							<div class="file-image">
								<?php echo wp_get_attachment_image( $id, $size = 'medium', "", array( "class" => "card-img-top" ) );  ?>
							</div>
							<div class="card-body filename">
								<a href="<?php echo esc_attr($url); ?>" title="<?php echo esc_attr($title); ?>" class="d-flex flex-row align-items-center stretched-link">
								<?php echo $the_thumb;?><span><?php echo esc_html($title); ?></span>
								</a>
							</div>
						</div>
					</div>
				<?php endif; ?>
			<?php
			// End loop.
			endwhile;

		// No value.
		else :
			// Do something...
		endif;
		?>
	</div>
</div>
