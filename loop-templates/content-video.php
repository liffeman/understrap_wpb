<?php
/**
 * Partial template for content in page.php
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php if ( !is_front_page()) : ?>

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<?php endif; ?>

	<div class="entry-content">

		<?php the_content(); ?>
		<?php
		// The Query
		$number = get_field('number_of_posts');
		$cat = get_field('show_cat');
		if ($cat) {
			$filter = $cat;
		} else {
			$filter = -0;
		}

		$args = array (
			'post_type' => 'videos',
			'posts_per_page' => $number,
			'cat' => $filter,
		);

		$the_query = new WP_Query( $args);

		$columns = get_field('number_of_cols');

		$parentClass = 'row row-cols-1 row-cols-md-';
		$parentClass .= $columns;

		// The Loop
		if ( $the_query->have_posts() ) {
			global $pagenow;
			if (( $pagenow == 'admin-ajax.php' ) ) {
				echo '<div class="alert alert-info w-100" role="alert">' . __('List of videos') . '</div>';
			} else {
				echo '<div id="block-'.$block['id'].'" class="' . $parentClass . ' ">';
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						get_template_part( 'loop-templates/content', 'block-videogrid');
					}
				echo '</div>';
				}
			}
		/* Restore original Post Data */
		wp_reset_postdata();
		?>

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

		<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
