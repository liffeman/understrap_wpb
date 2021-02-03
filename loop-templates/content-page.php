<?php
/**
 * Partial template for content in page.php
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<?php
$show_title = get_field('sidrubrik');
$show_breadcrumb = get_field('brodsmulor');
$hide_featured = get_field('hide_featured');
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<?php if ( has_post_thumbnail() ) : ?>
	<?php if( !$hide_featured): ?>
		<figure class="alignfull">
			<div class="featured-image">
			<?php echo get_the_post_thumbnail( $post->ID, 'large', array( 'class' =>  'responsive' ) ); ?>
			</div>
		</figure>
	<?php endif ; ?>
<?php endif; ?>
<?php

if( get_field('sidrubrik') == 0 ): ?>
	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->
<?php endif ;?>


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

		<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
