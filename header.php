<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
$menu = get_theme_mod('understrap_offcanvas');
$nav_theme = get_theme_mod('understrap_navbar_scheme');
$searchbox = get_theme_mod('understrap_searchbox');
$offcanvastheme = get_theme_mod('understrap_offcanvas_theme');
$offcanvassubmenuslide = get_theme_mod('understrap_offcanvas_submenu_slide');

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<!-- ******************* The Navbar Area ******************* -->

	<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

	<div id="main-header" class="main-page-header">
	<?php if ( 'container' === $container ) : ?>
		<div class="container">
	<?php endif; ?>
	<div class="header-area">
	<!-- Your site title as branding in the menu -->
	<?php if ( ! has_custom_logo() ) { ?>

		<?php if ( is_front_page() && is_home() ) : ?>

			<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

		<?php else : ?>

			<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

		<?php endif; ?>

		<?php
	} else {
		the_custom_logo();
	}
	?>
		<?php get_template_part( 'sidebar-templates/sidebar', 'header' ); ?>
		<div class="adplaces">
		</div>
	</div>
	<!-- end custom logo -->
	<?php if ( 'container' === $container ) : ?>
	</div><!-- .container -->
	<?php endif; ?>
	</div>

	<nav id="main-nav" class="navbar <?php echo $nav_theme; ?> navbar-expand-md" aria-labelledby="main-nav-label">
	<h2 id="main-nav-label" class="sr-only">
		<?php esc_html_e( 'Main Navigation', 'understrap' ); ?>
	</h2>

		<?php if ( 'container' === $container ) : ?>
			<div class="container">
		<?php endif; ?>
		<!-- The WordPress Menu goes here -->
		<div class="main-navigation">
			<button class="navbar-toggler invisible" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
			<i class="fas fa-bars"></i>
		</button>
		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container_class' => 'collapse navbar-collapse',
				'container_id'    => 'navbarNavDropdown',
				'menu_class'      => 'navbar-nav',
				'fallback_cb'     => '',
				'menu_id'         => 'main-menu',
				'depth'           => 2,
				'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
			)
		);
		?>
		</div>
		<div class="second-navigation">
			<div class="nav-buttons">
			<?php if ( 'show' === $searchbox ) : ?>
			<span class="navbar-toggler-icon-2">
				<a class="navbar-toggler-search" role="button" data-toggle="collapse" href="#searchbox" aria-expanded="false" aria-controls="searchbox">
					<i class="fas fa-search"></i>
				  </a>
			</span>
			<?php endif; ?>
			<?php if ( '1' === $menu ) : ?>
			<span class="navbar-toggler-icon-2">
				<a class="navbar-toggler-offcanvas" href="#my-menu"><i class="fas fa-bars"></i></a>
			</span>
			<?php endif; ?>
		</div>
	</div>
	<?php if ( 'container' === $container ) : ?>
		</div><!-- .container -->
	<?php endif; ?>
</nav>

<?php if ( 'show' === $searchbox ) : ?>
	<div id="searchbox" class="collapse">
		<?php if ( 'container' === $container ) : ?>
		<div class="container">
		<?php endif; ?>
			<div class="searchbox-area">
				<?php get_search_form(); ?>
			</div>
		<?php if ( 'container' === $container ) : ?>
		</div><!-- .container -->
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<?php if ( '1' === $menu ) : ?>
	<nav id="my-menu">
		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'offcanvas',
				'depth'           => 4,
				//'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
			)
		);
		?>
	</nav>
	<?php if ( 'container' === $container ) : ?>
	</div><!-- .container -->
	<?php endif; ?>
	<script>
		document.addEventListener(
			"DOMContentLoaded", () => {
				const menu = new MmenuLight(
					document.querySelector( "#my-menu" ),
					"(min-width: 200px)"
				);

				const navigator = menu.navigation({
					theme: <?php echo json_encode(get_theme_mod('understrap_offcanvas_theme')); ?>,
					slidingSubmenus: <?php echo get_theme_mod('understrap_offcanvas_submenu_slide'); ?>,
					title: ""
				});

				const drawer = menu.offcanvas({
					position: "right"
				});
				document.querySelector( "a[href='#my-menu']" )
					.addEventListener( "click", ( event ) => {
						event.preventDefault();
						drawer.open();
					});
			}
		);
	</script>
<?php endif; ?>
<div class="site" id="page">
