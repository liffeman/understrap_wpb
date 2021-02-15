<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<div class="col mb-4">
<div class="card ajax-post h-100">
	<div class="categories">
		<?php
		foreach((get_the_category()) as $category){
			echo '<div class="cat-label">' . $category->name.'</div>';
			}
		?>
	</div>
	<a href="<?php the_permalink( );?>">
	<?php
	// Must be inside a loop.

	if ( has_post_thumbnail($post->ID) ) {
		echo '<div class="card-image-top image-wrapper">';
		the_post_thumbnail('grid_image', array('class' => 'zoom-image'));
		echo '</div>';
	}
	?>
	<div class="card-body">

		<h5 class="card-title"><?php	the_title();?></h5>

			<div class="entry-meta mb-0">
				<?php understrap_posted_on(); ?>
			</div><!-- .entry-meta -->
	</div>
	</a>
</div>
</div>
