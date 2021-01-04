<?php
/**
* Template Name: Show all posts with category filter
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


			<?php $categories = get_categories(); ?>

			<div class="cat-list btn-group flex-wrap" role="group" aria-label="Basic example">
				  <a class="cat-list_item active btn btn-dark" role="button" href="#!" data-slug="">Alla</a>
				  <?php foreach($categories as $category) : ?>
				  	<a class="cat-list_item btn btn-dark" role="button" href="#!" data-slug="<?= $category->slug; ?>">
						  <?= $category->name; ?>
						</a>
					<?php endforeach; ?>
			</div>

			<?php
			$catSlug = $_POST['category'];
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

			$args = array(
				//'post_type' => 'posts',
				'category_name' => $catSlug,
				'posts_per_page' => 5,
				'paged' => $paged,
				'order_by' => 'date',
				'order' => 'desc'
				);
			if($args['posts_per_page'] * $args['paged'] <= 100){
				$ajaxposts = new WP_Query( $args );
			}
			?>

			<?php if($ajaxposts->have_posts()): ?>
			  <div class="post-tiles">
				  <div class="card-columns">
				<?php
				  while($ajaxposts->have_posts()) : $ajaxposts->the_post();
				  	get_template_part( 'loop-templates/content', 'grid' );
				  endwhile;
				?>
			    </div>
				<div class="pagination--container">
					<?php
					global $wp;
					$base = home_url( $wp->request ); // Gets the current page we are on.

					// Fallback if there is not base set.
					$fallback_base = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );

					// Set the base.
					$base = isset( $_POST[ 'base' ] ) ? trailingslashit( $_POST[ 'base' ] ) . '%_%' : $fallback_base;

					paginate_links(
						array(
							'base'      => $base,
							'format'    => '?paged=%#%',
							'current'   => max( 1, get_query_var( 'paged' ) ),
							'total'     => $query->max_num_pages,
							'prev_text' => '1',
							'next_text' => '1',
						)
					);

					?>
				</div>
			  <?php// the_posts_pagination() ?>
			  <?php// if (function_exists("pagination")) {pagination($ajaxposts->max_num_pages);} ?>
			  <?php wp_reset_postdata(); ?>
			</div>

			<?php endif; ?>

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
