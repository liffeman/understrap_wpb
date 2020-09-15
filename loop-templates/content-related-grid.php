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
<div class="card h-100">
	<?php
	// Must be inside a loop.

	if ( has_post_thumbnail($post->ID) ) {
		the_post_thumbnail('grid_image', array('class' => 'card-img-top'));
	}
	?>
	<div class="card-body">

		<?php
		the_title(
			sprintf( '<h5 class="card-title text-center"><a href="%s" class="stretched-link" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></h5>'
		);
		?>
	</div>
</div>
</div>
