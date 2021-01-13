<?php
/**
 * Partial template for content in page.php
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<?php echo get_the_post_thumbnail( $post->ID, 'large', array( 'class' => 'card-img-top' ) ) ; ?>
<?php if (get_post(get_post_thumbnail_id())->post_excerpt) { // search for if the image has caption added on it ?>
<div class="featured-image-caption">
	<?php echo wp_kses_post(get_post(get_post_thumbnail_id())->post_excerpt); // displays the image caption ?>
</div>
<?php } ?>
