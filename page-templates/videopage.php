<?php
/**
* Template Name: Video page
 *
 * This is the template for the video archive page
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="page-wrapper">
<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
	<?php if(function_exists('bcn_display'))
	{
		if(! get_field('hide_breadcrumb')) {
			bcn_display();
		}
	}?>
</div>
	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<?php if (is_front_page()) {
			echo '<div class="row">';
		} else {
			echo '<div class="row card">';
		}
		?>
		<?php get_template_part( 'loop-templates/content','featuredimage' ); ?>

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

			<?php if(! get_field('hide_pagelist')) : ?>
				<?php
				if ( $post->post_parent ) {
					$children = wp_list_pages( array(
						'title_li' => '',
						'child_of' => $post->post_parent,
						'echo'     => 0
						//'walker'          => new Understrap_WP_Bootstrap_Navwalker()
					) );
				} else {
					$children = wp_list_pages( array(
						'title_li' => '',
						'child_of' => $post->ID,
						'echo'     => 0
						//'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					) );
				}

				if ( $children ) : ?>
					<ul class="nav subpages">
						<?php echo $children; ?>
					</ul>
				<?php endif; ?>
				<?php endif; ?>
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'loop-templates/content', 'video' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				}
				?>

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
