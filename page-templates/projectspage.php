<?php
/**
* Template Name: Projects Archive Template
 * The template for displaying all projects
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

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php
					// The Query
					$columns = get_field('number_of_cols');
					$projects_sortby = get_field('sort_by');
					$projects_sortorder = get_field('sort_order');

					/*check of projects should be sorted by start date*/
					if  ( $projects_sortby == 'project_start_time' ) {
						$args = array (
							'post_type' => 'project',
							"posts_per_page" => -1,
							'meta_key' => $projects_sortby,
							'orderby' => 'meta_value_num',
							'order' => $projects_sortorder,
						);
					} elseif ( $projects_sortby == 'project_end_time' ) {
						$args = array (
							'post_type' => 'project',
							"posts_per_page" => -1,
							'order' => $projects_sortorder,
							'meta_key' => $projects_sortby,
							'orderby' => 'meta_value_num',
						);
					} elseif ( $projects_sortby == 'title' && 'random') {
						$args  = array (
							'post_type' => 'project',
							"posts_per_page" => -1,
							'order' => $projects_sortorder,
							'orderby' => $projects_sortby,
						);
					} else {
						$args = array (
						'post_type' => 'project',
						"posts_per_page" => -1,
						'order' => $projects_sortorder,
						);
					}

					$the_project_query = new WP_Query( $args );

					// The Loop
					echo 'sort by: ' . $projects_sortby;
					print_r ($args);
					if ( $the_project_query->have_posts() ) {
						echo '<div class="project-list">';
						echo 'sort by: ' . $projects_sortby;
						while ( $the_project_query->have_posts() ) {
							$the_project_query->the_post();
							get_template_part( 'loop-templates/content', 'project' );
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
