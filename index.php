<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
$view = get_theme_mod( 'understrap_blog_view' );
$our_title = get_the_title( get_option('page_for_posts', true) );
$posts_page = get_post( get_option( 'page_for_posts' ) );
$the_content = apply_filters( 'the_content', $posts_page->post_content );
?>

<?php if ( is_front_page() && is_home() ) : ?>
	<?php get_template_part( 'global-templates/hero' ); ?>
<?php endif; ?>

<div class="wrapper pb-0" id="index-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">
			<?php
			if ( !empty($our_title) ) {
				echo '<header class="entry-header"><h1 class="entry-title">' . $our_title . '</h1></header>';
				}
			?>
			<?php
				if ( !empty($the_content) ) {
					echo '<div class="entry-content pb-5">' . $the_content . '</div>';
					}
			 ?>

			<?php understrap_category_filter () ;?>

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

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();
