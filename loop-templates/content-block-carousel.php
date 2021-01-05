<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<div class="carousel-item">
	<?php
	// Must be inside a loop.
	if ( has_post_thumbnail($post->ID) ) {
		the_post_thumbnail('slider-image', array('class' => 'd-block w-100'));
	}
	?>

	<div class="carousel-caption d-none d-md-block">

	<div class="categories">
		<?php
		foreach((get_the_category()) as $category){
			echo '<div class="cat-label">' . $category->name.'</div>';
			}
		?>
	</div>
	<h2 class="carousel-title"><?php	the_title();?></h2>
	<div class="entry-meta mb-0">
		<?php understrap_posted_on(); ?>
	</div><!-- .entry-meta -->
		<?php if (get_field('show_excerpt')):?>
		<?php the_excerpt(); ?>
	<?php endif; ?>
		<a class="btn btn-primary" href="<?php the_permalink( );?>"> Läs mer</a>
	</div>
</div>
