<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
$view = get_theme_mod( 'understrap_blog_view' );
$current_category = single_cat_title("", false);
?>

<div class="wrapper" id="archive-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">
			<header class="page-header">
				<h1 class="page-title"><?php echo $current_category ; ?></h1>
				<?php
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php// understrap_category_filter () ;?>

			<?php
			// get the category object for the current category
			$thisTrueCat = get_category( get_query_var( 'cat' ) );
			//print $thisTrueCat->term_id;
			?>

			<div class="cat-list flex-wrap" role="group" aria-label="Category button group">
			<!-- call submenu -->
			<?php
				// get the category object for the current category
				$thisCat = get_category( get_query_var( 'cat' ) );

				// if not top-level, track it up the chain to find its ancestor
				while ( intval($thisCat->parent) > 0 ) {
					$thisCat = get_category ( $thisCat->parent );
				}

				//by now $thisCat will be the top-level category, proceed as before
				$args=array(
					'child_of' => $thisCat->term_id,
					'hide_empty' => 0,
					'orderby' => 'name',
					'order' => 'ASC'
				);

				$categories=get_categories( $args );
				foreach( $categories as $category ) {
					if ($thisTrueCat->term_id == $category->term_id) {
						$btn_class = ' btn-primary';
					} else {
						$btn_class = ' btn-dark';
					}
				?>
					<a class="cat-list_item btn<?php echo $btn_class;?>" href="<?php echo get_category_link( $category->term_id ) ?>" ><?php echo $category->name ?></a>
				<?php
				};
			?>
			</div>

			<?php
			if ( have_posts() ) {
				if ($view == 'grid') {
					echo '<div class="card-columns">';
					}
				// Start the Loop.
				while ( have_posts() ) {
					the_post();
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					 if ($view == 'grid') {
						 get_template_part( 'loop-templates/content', 'grid' );
					 } else {
						 get_template_part( 'loop-templates/content', get_post_format() );
					}
				}
			} else {
				get_template_part( 'loop-templates/content', 'none' );
			}
			if ($view == 'grid') {
				echo '</div>';
			}

			?>

			</main><!-- #main -->

			<?php
			// Display the pagination component.
			understrap_pagination();
			// Do the right sidebar check.
			get_template_part( 'global-templates/right-sidebar-check' );
			?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php
get_footer();
