<?php
/**
 * Single post partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">
		<?php echo get_the_post_thumbnail( $post->ID, 'header_image' ); ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php
			if( get_post_type() == 'project' )	:?>
			<?php
				$project_start = get_field('project_start_time');
				$project_end = get_field('project_end_time');

				if( $project_start ): ?>
					<div id="time" class="h3">
							<?php echo $project_start; ?>
							<?php if ($project_end) {
								 if( $project_end !== $project_start) {
									 echo ' - ' . $project_end ;
								 }
							}
							?>
					</div>
				<?php endif; ?>
			<?php else: ?>
			<?php understrap_posted_on(); ?>
			<?php endif; ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<div class="entry-content">

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

</article><!-- #post-## -->
