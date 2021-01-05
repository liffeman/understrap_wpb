<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<div class="col-12 mb-3 block-post-list">
		<a class="d-flex flex-column flex-md-row" href="<?php the_permalink( );?>">
		<?php
		// Must be inside a loop.
		if ( has_post_thumbnail($post->ID) ) {
			echo '<div class="card-image-top image-wrapper">';
			the_post_thumbnail('grid_image', array('class' => 'zoom-image'));
			echo '</div>';
		}
		?>
			<div class="card-body">
				<?php if (get_field('show_cats')):?>
					<div class="categories ">
						<?php
						foreach((get_the_category()) as $category){
							echo '<div class="cat-label">' . $category->name.'</div>';
							}
						?>
					</div>
				<?php endif; ?>
					<h3 class="card-title"><?php	the_title();?></h3>
				<div class="entry-meta mb-0">
					<?php understrap_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php if (get_field('show_excerpt')):?>
					<?php the_excerpt(); ?>
				<?php endif; ?>
			</div>
		</a>
</div>
