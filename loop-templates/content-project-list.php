<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<?php
/* get project time values */
$project_start = get_field('project_start_time',  get_the_ID());
$project_end = get_field('project_end_time',  get_the_ID());
?>

<div class="row border-top border-light pt-5 pb-5">
	<div class="col-md-3">
			<div id="time" class="h4 pt-3">
				<?php echo $project_start; ?>
					<?php if ($project_end) {
						 if( $project_end !== $project_start) {
						 	echo ' - ' . $project_end ;
						 }
					}
					?>
			</div>
	</div>
	<div class="col">
		<header class="project-header">
			<h2 class="project-title">
			<?php	the_title() ; ?>
			</h2>
		</header><!-- .entry-header -->

		<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

		<div class="project-content">

			<?php the_content(); ?>

			<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
					'after'  => '</div>',
				)
			);
			?>

		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<?php understrap_entry_footer(); ?>

		</footer><!-- .entry-footer -->
	</div>
</div>
