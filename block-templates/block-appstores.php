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
$appstore = get_field ('appstore');
$googleplay = get_field ('googleplay');
?>

<?php if( !empty($section_anchor) ){
echo '<a class="anchor" id="' . $section_anchor . '"></a>';
}
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
		<div class="appstores d-flex flex-column flex-md-row mt-3 mb-3">
					<?php if ($appstore) {
						echo '<a class="appstore-link" href="'. $appstore .'" alt="Ladda ned på AppStore"><img class="app-badge-img" src="'. get_stylesheet_directory_uri() . '/img/download_badges/appstore.svg"></a>';
					} ?>
					<?php if ($googleplay) {
						echo '<a class="appstore-link" href="'. $googleplay .'" alt="Ladda ned på GooglePlay"><img class="app-badge-img" src="'. get_stylesheet_directory_uri(). '/img/download_badges/googleplay.svg"></a>';
					} ?>
		</div>
</div>
