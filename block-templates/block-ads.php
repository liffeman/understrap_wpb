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
$className .= ' ads';
$className .= ' d-flex flex-column flex-wrap justify-items-center';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}

$section_anchor = $id;

// ACF values
$ad_image = get_field ('ad_block_image');
$ad_link = get_field ('ad_block_link');

?>

<?php if( !empty($section_anchor) ){
echo '<a class="anchor" id="' . $section_anchor . '"></a>';
}
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<div class="row">
		<div class="container">
		<?php if ( $ad_link): ?>
			<?php if( $ad_image ): ?>
				<div class="adplace flex-column">
					<div class="ad-label">	<?php echo __('Annons', '_understrap');?></div>
					<a href="<?php echo $ad_link; ?>" target="_blank" class="ad-link mx-auto">
						<img src="<?php echo $ad_image['url'] ?>" alt="" class="ad-img"/>
					</a>
				</div>
			<?php endif;?>
		<?php endif; ?>
		</div>
	</div>
</div>
