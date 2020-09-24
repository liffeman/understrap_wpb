<?php
/**
* Template Name: Case Stories Archive Template
 * The template for displaying all Case Stories
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper pb-0" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php
					// The Query
					$columns = get_field('number_of_cols');
			//		$cases_sortby = get_field('sort_by');
			//		$cases_sortorder = get_field('sort_order');

					$args = array (
					'post_type' => 'cases',
					"posts_per_page" => -1,
					//'order' => $projects_sortorder,
					);

					$the_cases_query = new WP_Query( $args );

					// The Loop
					if ( $the_cases_query->have_posts() ) {
						echo '<div class="card-columns">';
						while ( $the_cases_query->have_posts() ) {
							$the_cases_query->the_post();
							get_template_part( 'loop-templates/content', 'grid' );
						}
						echo '</div>';
						//wp_reset_postdata();

					} else {
						// no posts found
					}
					/* Restore original Post Data */
					wp_reset_postdata();
				?>

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
